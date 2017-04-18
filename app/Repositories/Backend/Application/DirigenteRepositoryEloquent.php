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

    

}
