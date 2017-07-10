<?php

namespace App\Repositories\Backend\Application;

use App\Exceptions\Access\GeneralException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Backend\Application\Contracts\ConvenioRepository;
use App\Models\Convenio;
use Carbon\Carbon;

//use App\Validators\CasaValidator;

/**
 * Class ConvenioRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class ConvenioRepositoryEloquent extends BaseRepository implements ConvenioRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Convenio::class;
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
        if ($this->verifyExistis($attributes['numero'])){
            throw new GeneralException('Já existe um convênio cadastrado com este número');
        }

        $model = $this->model->newInstance($attributes);
        if ($model->save()){
            return true;
        }else{
            throw new GeneralException('Erro ao inserir registro');
        }
    }

    private function verifyExistis($identify)
    {
        $result = $this->model->newQuery()->where('numero', $identify)->get()->count();

        if ($result >= 1){
            return true;
        }else{
            return false;
        }
    }


}
