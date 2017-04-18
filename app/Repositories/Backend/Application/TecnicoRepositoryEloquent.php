<?php

namespace App\Repositories\Backend\Application;

use App\Exceptions\Access\GeneralException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Backend\Application\Contracts\TecnicoRepository;
use App\Models\CorpoTecnico;
use Prettus\Validator\Contracts\ValidatorInterface;
//use App\Validators\CasaValidator;

/**
 * Class BackendApplicationCasaRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class TecnicoRepositoryEloquent extends BaseRepository implements TecnicoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CorpoTecnico::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    

}
