<?php

namespace App\Repositories\Backend\Application;

use App\Exceptions\Access\GeneralException;
use App\Models\Infraestrutura;
use App\Repositories\Backend\Application\Contracts\InfraestruturaRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class BackendApplicationCasaRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class InfraestruturaRepositoryEloquent extends BaseRepository implements InfraestruturaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Infraestrutura::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


}
