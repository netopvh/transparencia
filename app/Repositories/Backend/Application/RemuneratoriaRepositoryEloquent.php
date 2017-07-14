<?php

namespace App\Repositories\Backend\Application;

use App\Exceptions\Access\GeneralException;
use App\Models\EstruturaFile;
use Illuminate\Database\QueryException;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Backend\Application\Contracts\RemuneratoriaRepository;
use App\Models\EstruturaRemuneratoria;
use Prettus\Validator\Contracts\ValidatorInterface;
use Illuminate\Container\Container as Application;
use App\Models\EstruturaNota;

/**
 * Class BackendApplicationCasaRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class RemuneratoriaRepositoryEloquent extends BaseRepository implements RemuneratoriaRepository
{

    /**
     * RemuneratoriaRepositoryEloquent constructor.
     * @param Application $app
     * @param EstruturaNota $nota
     */
    public function __construct(Application $app, EstruturaNota $nota, EstruturaFile $estruturaFile)
    {
        parent::__construct($app, $nota, $estruturaFile);
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EstruturaRemuneratoria::class;
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
        $result = $this->model->query()->where('cargo', $attributes['cargo'])->get()->count();

        if ($result >= 1) {
            throw new GeneralException('Registro já cadastrado no sistema!');
        }


        $model = $this->model->newInstance($attributes);
        if ($model->save()) {
            return true;
        } else {
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
        if ($model->save()) {
            return true;
        } else {
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
        if (is_null($result)) {
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
        try {
            $data['casa_id'] = getCasaId($attributes['casa']);
            $data['cargo'] = $attributes['cargo'];
            $data['ponto_ini'] = $attributes['ponto_inicial'];
            $data['ponto_fin'] = $attributes['ponto_final'];
            $data['empregados'] = (int) $attributes['empregados'];
            $this->model->create($data);
        } catch (QueryException $e) {
            throw new GeneralException('Não foi possível importar registros! - Cod:' . $e->getMessage());
        }
    }


    /**
     * Busca todos os registros da casa
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
