<?php

namespace App\Repositories\Backend\Application;

use App\Exceptions\Access\GeneralException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Backend\Application\Contracts\RemuneratoriaRepository;
use App\Models\EstruturaRemuneratoria;
use Prettus\Validator\Contracts\ValidatorInterface;
//use App\Validators\CasaValidator;

/**
 * Class BackendApplicationCasaRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class RemuneratoriaRepositoryEloquent extends BaseRepository implements RemuneratoriaRepository
{
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
        $result = $this->model->query()->where('cargo',$attributes['cargo'])->get()->count();

        if ($result >= 1){
            throw new GeneralException('Registro já cadastrado no sistema!');
        }


        $model = $this->model->newInstance($attributes);
        if ($model->save()){
            return true;
        }else{
            throw new GeneralException('Erro ao cadastrar registro no banco de dados');
        }
    }

}
