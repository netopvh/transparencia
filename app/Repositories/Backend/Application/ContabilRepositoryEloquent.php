<?php

namespace App\Repositories\Backend\Application;

use App\Exceptions\Access\GeneralException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Backend\Application\Contracts\ContabilRepository;
use App\Models\Contabil;
use App\Enum\ContabilTipos;
use Prettus\Validator\Contracts\ValidatorInterface;

//use App\Validators\CasaValidator;

/**
 * Class BackendApplicationCasaRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class ContabilRepositoryEloquent extends BaseRepository implements ContabilRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Contabil::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function create(array $attributes)
    {
        $result = $this->model
            ->newQuery()
            ->where('casa_id',$attributes['casa_id'])
            ->where('type',$attributes['type'])
            ->get();
        if (count($result) >= 1){
            throw new GeneralException("Já possui um registro cadastrado!");
        }

        $model = $this->model->newInstance($attributes);

        if($model->save()){
            return true;
        }else{
            return false;
        }
    }

}
