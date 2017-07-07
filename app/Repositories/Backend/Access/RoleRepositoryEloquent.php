<?php

namespace App\Repositories\Backend\Access;

use App\Exceptions\Access\GeneralException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Backend\Access\Contracts\RoleRepository;
use App\Models\Access\Role;
use Prettus\Validator\Contracts\ValidatorInterface;

//use App\Validators\Access\RoleValidator;

/**
 * Class RoleRepositoryEloquent
 * @package namespace App\Repositories\Access;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getCount()
    {
        return $this->model->query()->count();
    }

    /**
     * Insere Registro no Banco de Dados
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        if (!is_null($this->validator)) {
            $attributes = $this->model->newInstance()->forceFill($attributes)->toArray();

            $this->validator->with($attributes)->passesOrFail(ValidatorInterface::RULE_CREATE);
        }
        if ($this->model->query()->where('name', $attributes['name'])->first()) {
            throw new GeneralException('Registro já cadastrado no sistema!');
        }

        if (!isset($attributes['permissions'])) {
            $attributes['permissions'] = [];
        }

        //Essa verificação só é requirida se o all for falso.
        if (count($attributes['permissions']) == 0) {
            throw new GeneralException('É obrigatório inserir permissões');
        }

        $this->model->name = $attributes['name'];
        $this->model->sort = isset($attributes['sort']) && strlen($attributes['sort']) > 0 && is_numeric($attributes['sort']) ? (int)$attributes['sort'] : 0;


        if ($this->model->save()) {

            $permissions = [];

            if (is_array($attributes['permissions']) && count($attributes['permissions'])) {
                foreach ($attributes['permissions'] as $perm) {
                    if (is_numeric($perm)) {
                        array_push($permissions, $perm);
                    }
                }
                $this->model->attachPermissions($permissions);
            }

            return true;

        } else {
            throw new GeneralException('Erro ao gravar registro no banco');
        }
    }

    /**
     * Salva as modificações no banco de dados
     *
     * @param array $attributes
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function update(array $attributes, $id)
    {
        $role = $this->model->find($id);


        if (!isset($attributes['permissions'])) {
            $attributes['permissions'] = [];
        }

        if (count($attributes['permissions']) == 0) {
            throw new GeneralException('É obrigatório inserir permissões');
        }

        $role->name = $attributes['name'];
        $role->sort = isset($attributes['sort']) && strlen($attributes['sort']) > 0 && is_numeric($attributes['sort']) ? (int)$attributes['sort'] : 0;


        if ($role->save()) {
            //Remove todas as permissões
            $role->perms()->sync([]);

            //atribui permissões se o perfil não tiver todos os direitos de acesso
            $permissions = [];

            if (is_array($attributes['permissions']) && count($attributes['permissions'])) {
                foreach ($attributes['permissions'] as $perm) {
                    if (is_numeric($perm)) {
                        array_push($permissions, $perm);
                    }
                }
            }
            $role->attachPermissions($permissions);
            return true;
        } else {
            throw new GeneralException('Erro ao gravar registro no banco');
        }
    }
}
