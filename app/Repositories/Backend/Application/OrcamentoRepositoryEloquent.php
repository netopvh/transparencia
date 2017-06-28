<?php

namespace App\Repositories\Backend\Application;

use App\Exceptions\Access\GeneralException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Backend\Application\Contracts\OrcamentoRepository;
use App\Models\Orcamento;
use Carbon\Carbon;
use Prettus\Validator\Contracts\ValidatorInterface;

//use App\Validators\CasaValidator;

/**
 * Class BackendApplicationCasaRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class OrcamentoRepositoryEloquent extends BaseRepository implements OrcamentoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Orcamento::class;
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
            ->where('type', $attributes['type'])
            ->where('year', $attributes['year'])
            ->where('casa_id', $attributes['casa_id'])
            ->get();

        if (count($result) >= 1) {
            throw new GeneralException("Já possui um registro cadastrado!");
        }

        $model = $this->model->newInstance($attributes);

        if ($model->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllOrder($casa)
    {
        return $this->model->newQuery()
            ->where('casa_id', getCasaId($casa))
            ->orderBy('year', 'desc')
            ->get();
    }

    /*
     *
     * FRONTEND METHODS
     *
     */

    public function getOrcamentoActualYear($casa)
    {
        $result = $this->model->newQuery()
            ->where('type', 'A')
            ->where('year', date('Y'))
            ->where('casa_id', getCasaId($casa))
            ->first();

        if (count($result) >= 1) {
            return $result;
        } else {
            return false;
        }
    }

    public function getOrcamentoThreeYear($casa)
    {
        $anoAnterior = Carbon::now()->subYear(1)->format('Y');
        $anoMeio = Carbon::now()->subYears(2)->format('Y');
        $ultimoAno = Carbon::now()->subYears(3)->format('Y');
        //dd($ultimoAno);

        $result = $this->model->newQuery()
            ->whereIn('year',[$anoAnterior, $anoMeio ,$ultimoAno])
            ->where('type', 'B')
            ->where('casa_id', getCasaId($casa))
            ->orderBy('year','desc')
            ->get();

        if (count($result) >= 1) {
            return $result;
        } else {
            return false;
        }
    }

}
