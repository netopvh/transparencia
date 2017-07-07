<?php

namespace App\Repositories\Backend\Access;

use App\Exceptions\Access\GeneralException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Backend\Access\Contracts\UserRepository;
use App\Models\Access\User;
use Prettus\Validator\Contracts\ValidatorInterface;
use Illuminate\Support\Facades\Hash;
//use App\Validators\Access\UserValidator;

/**
 * Class UserRepositoryEloquent
 * @package namespace App\Repositories\Access;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
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
        if (count($this->verifyUser($attributes)) >= 1){
            throw new GeneralException('Email '. $attributes['email'].' já Cadastrado no Sistema');
        }

        $this->model->name = ucfirst($attributes['name']);
        $this->model->username = $attributes['username'];
        $this->model->password = bcrypt($attributes['password']);
        $this->model->email = $attributes['email'];

        if ($this->model->save()){

            $this->model->attachRole($attributes['role']);

            //$this->model->

            return true;
        }else{
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


        $user = $this->model->with('roles')->find($id);
        $user->name = ucfirst($attributes['name']);
        $user->username = $attributes['username'];
        $user->email = $attributes['email'];
        $user->active = $attributes['active'];

        if ($user->save()){

            $user->roles()->detach();
            $user->roles()->attach($attributes['role']);

            return true;
        }else{
            throw new GeneralException('Erro ao gravar registro no banco');
        }

    }

    /**
     * Retornar todos os registros com relacionamentos
     *
     * @param array $columns
     * @return mixed
     */
    public function getAllWithRoles($columns = ['*'])
    {
        return $this->model->with('roles')->paginate(8, $columns);
    }

    /**
     * Efetua a busca no Banco de dados e retorna com relacionamento
     *
     * @param $field
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function searchWithRoles($field, $value, $columns = ['*']){
        return $this->model->query()
            ->where($field,'like','%'. $value .'%')
            ->paginate(8);
    }

    /**
     *
     * Métodos Privados da Classe
     *
     */

    private function verifyUser(array $attributes)
    {

        $user = $this->model->query()
            ->where('name',$attributes['name'])
            ->orWhere('username',$attributes['username'])
            ->orWhere('email',$attributes['email'])
            ->get();

        return $user;

    }

    public function changePassword($attributes)
    {

        $model = $this->model->find(auth()->user()->id);

        if(! Hash::check($attributes['actual'],$model->password)) {
            throw new GeneralException('A senha digitada não corresponde com a senha atual');
        }else{
            $model->password = bcrypt($attributes['password']);

            if ($model->save()){
                return true;
            }else{
                throw new GeneralException('Ocorreu um erro ao alterar a senha');
            }
        }
    }
}
