<?php

namespace App\Repositories\Backend\Application;

use App\Exceptions\Access\GeneralException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Backend\Application\Contracts\CasaRepository;
use App\Models\Casa;
use Prettus\Validator\Contracts\ValidatorInterface;
use Zizaco\Entrust\EntrustFacade;

//use App\Validators\CasaValidator;

/**
 * Class BackendApplicationCasaRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class CasaRepositoryEloquent extends BaseRepository implements CasaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Casa::class;
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
     * @return bool
     * @throws GeneralException
     */
    public function create(array $attributes)
    {
        if (!is_null($this->validator)) {
            // we should pass data that has been casts by the model
            // to make sure data type are same because validator may need to use
            // this data to compare with data that fetch from database.
            $attributes = $this->model->newInstance()->forceFill($attributes)->toArray();

            $this->validator->with($attributes)->passesOrFail(ValidatorInterface::RULE_CREATE);
        }
        if ($this->verifyCasa($attributes) > 1) {
            throw new GeneralException('Casa ' . $attributes['name'] . ' já Cadastrada no Sistema');
        }

        $this->model->name = strtoupper($attributes['name']);

        if ($this->model->save()) {
            return true;
        } else {
            throw new GeneralException('Erro ao gravar registro no banco');
        }
    }

    /**
     * Atualiza registros do banco de dados
     *
     * @param array $attributes
     * @param $id
     * @return bool
     */
    public function update(array $attributes, $id)
    {
        if (!is_null($this->validator)) {
            // we should pass data that has been casts by the model
            // to make sure data type are same because validator may need to use
            // this data to compare with data that fetch from database.
            $attributes = $this->model->newInstance()->forceFill($attributes)->toArray();

            $this->validator->with($attributes)->passesOrFail(ValidatorInterface::RULE_CREATE);
        }


        if (empty($casa = $this->verifyCasaId($id))){
            throw new GeneralException('Não foi localizado registro no banco de dados');
        }
            $casa->name = strtoupper($attributes['name']);

        if ($casa->save()) {
            return true;
        } else {
            throw new GeneralException('Erro ao gravar registro no banco');
        }

    }

    public function findCasa($id)
    {
        if (is_null($casa = $this->verifyCasaId($id))){
            throw new GeneralException('Não foi localizado registro no banco de dados');
        }
        return $casa;
    }

    /**
     *
     * Métodos Privados da Classe
     *
     */

    private function verifyCasa(array $attributes)
    {
        $casa = $this->model->query()
            ->where('name', $attributes['name'])
            ->count();

        return $casa;
    }

    private function verifyCasaId($id)
    {
        $casa = $this->model->find($id);

        return $casa;
    }
}
