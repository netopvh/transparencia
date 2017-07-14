<?php

namespace App\Repositories\Backend\Application;

use App\Exceptions\Access\GeneralException;
use Illuminate\Database\QueryException;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Backend\Application\Contracts\DirigenteRepository;
use Illuminate\Container\Container as Application;
use App\Models\Dirigente;
use App\Models\DirigenteFile;
use App\Models\DirigenteNota;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class BackendApplicationCasaRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class DirigenteRepositoryEloquent extends BaseRepository implements DirigenteRepository
{

    /**
     * DirigenteRepositoryEloquent constructor.
     * @param Application $app
     * @param DirigenteNota $nota
     * @param DirigenteFile $file
     */
    public function __construct(Application $app, DirigenteNota $nota, DirigenteFile $file)
    {
        parent::__construct($app, $nota, $file);
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Dirigente::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Insere um novo registro no banco de dados
     *
     * @param array $attributes
     * @throws GeneralException
     */
    public function create(array $attributes)
    {
        //Efetua Validação do Registro
        if (!is_null($this->validator)) {

            $attributes = $this->model->newInstance()->forceFill($attributes)->makeVisible($this->model->getHidden())->toArray();

            $this->validator->with($attributes)->passesOrFail(ValidatorInterface::RULE_CREATE);
        }

        // Verifica se existe o registro no banco
        $result = $this->model->query()->where('nome',$attributes['nome'])->get()->count();

        if ($result >= 1){
            throw new GeneralException('Registro já cadastrado no sistema!');
        }

        //Insere registro no DB
        $model = $this->model->newInstance($attributes);
        if ($model->save()){
            return true;
        }else{
            throw new GeneralException('Erro ao cadastrar registro no banco de dados');
        }
    }

    /**
     * Atualiza Registro do Banco de Dadnos
     *
     * @param array $attributes
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function update(array $attributes, $id)
    {
        //Efetua Validação do Registro
        if (!is_null($this->validator)) {

            $attributes = $this->model->newInstance()->forceFill($attributes)->makeVisible($this->model->getHidden())->toArray();

            $this->validator->with($attributes)->passesOrFail(ValidatorInterface::RULE_CREATE);
        }

        $model = $this->model->find($id);
        $model->fill($attributes);
        if ($model->save()){
            return true;
        }else{
            throw new GeneralException('Erro ao gravar registro no banco de dados');
        }
    }

    /**
     * Localiza registro no banco de dados
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     * @throws GeneralException
     */
    public function findById($id)
    {
        $result = $this->model->with('casa')->find($id);
        if(is_null($result)){
            throw new GeneralException('Nenhum registro localizado no banco de dados!');
        }

        return $result;
    }

    /**
     * Limpa todos os registros do banco de dados
     *
     * @return bool
     */
    public function cleanDatabase()
    {
        $this->model->query()->truncate();

        return true;
    }

    /**
     * Importa todos os registros para o banco de dados
     *
     * @param array $attributes
     * @throws GeneralException
     */
    public function importRecords(array $attributes)
    {
        try{
            $data['casa_id'] = getCasaId($attributes['casa']);
            $data['nome'] = strtoupper($attributes['nome']);
            $this->model->create($data);
        }catch (QueryException $e){
            throw new GeneralException('Não foi possível importar registros! - Cod:'.$e->getCode());
        }
    }

    /**
     * Retorna todos os registros do banco de dados
     *
     * @param $casa
     * @return mixed
     * @throws GeneralException
     */
    public function getAll($casa)
    {
        $result = $this->model->where('casa_id',$casa)->get();
        if (is_null($result)){
            throw new GeneralException('Sem Registros Localizados');
        }
        return $result;
    }

}
