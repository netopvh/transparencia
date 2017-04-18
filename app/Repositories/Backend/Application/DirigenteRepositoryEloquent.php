<?php

namespace App\Repositories\Backend\Application;

use App\Exceptions\Access\GeneralException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Backend\Application\Contracts\DirigenteRepository;
use App\Models\Dirigente;
use Prettus\Validator\Contracts\ValidatorInterface;
//use App\Validators\CasaValidator;

/**
 * Class BackendApplicationCasaRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class DirigenteRepositoryEloquent extends BaseRepository implements DirigenteRepository
{
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

}
