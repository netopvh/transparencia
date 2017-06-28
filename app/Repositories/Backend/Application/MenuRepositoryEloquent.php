<?php

namespace App\Repositories\Backend\Application;

use App\Exceptions\Access\GeneralException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Backend\Application\Contracts\MenuRepository;
use App\Models\Menu;
use Prettus\Validator\Contracts\ValidatorInterface;

//use App\Validators\CasaValidator;

/**
 * Class BackendApplicationCasaRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class MenuRepositoryEloquent extends BaseRepository implements MenuRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Menu::class;
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
        if (!is_null($this->validator)) {

            $attributes = $this->model->newInstance()->forceFill($attributes)->toArray();

            $this->validator->with($attributes)->passesOrFail(ValidatorInterface::RULE_CREATE);
        }

        $menu = $this->model->query()->where('title', $attributes['title'])->where('casa_id', $attributes['casa_id'])->get()->count();
        if ($menu >= 1) {
            throw new GeneralException("Ops, já existe um registro para a casa selecionada");
        }

        $model = $this->model->newInstance($attributes);
        if ($model->save()) {
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

            $attributes = $this->model->newInstance()->forceFill($attributes)->toArray();

            $this->validator->with($attributes)->passesOrFail(ValidatorInterface::RULE_CREATE);
        }


        $casa = $this->model->find($id);
        $casa->fill($attributes);;

        if ($casa->save()) {
            return true;
        } else {
            throw new GeneralException('Erro ao gravar registro no banco');
        }

    }

    /**
     * @param $casa
     * @return mixed
     */
    public function getDescritivo($casa)
    {
        return $this->model->query()
            ->join('casas', 'casas.id', 'menus.casa_id')
            ->select('menus.script',
                'menus.bloco')
            ->where('casas.name', $casa)
            ->where('menus.bloco', 'D')
            ->orderBy('casas.name', 'desc')
            ->first();
    }

    /**
     * @param $casa
     * @return mixed
     */
    public function getMenuCentro($casa)
    {
        return $this->model->query()
            ->join('casas', 'casas.id', 'menus.casa_id')
            ->select('menus.title',
                'menus.path',
                'menus.slug',
                'menus.type')
            ->where('casas.name', $casa)
            ->get();
    }

    /**
     * @param $casa
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getMenuLateral($casa)
    {
        return $this->model->query()
            ->join('casas', 'casas.id', 'menus.casa_id')
            ->select('menus.title',
                'menus.path',
                'menus.slug',
                'menus.type')
            ->where('casas.name', $casa)
            ->where('menus.sidebar','S')
            ->get();
    }

    /**
     * @param $casa
     * @return mixed
     */
    public function getMenuCasa($casa)
    {
        $result = $this->model->query()
        ->join('casas', 'casas.id', 'menus.casa_id')
        ->select('menus.script',
            'menus.bloco')
        ->where('casas.name', $casa)
        ->where('menus.bloco', 'D')
        ->orderBy('casas.name', 'desc')
        ->first();

        return $result;
    }

    /**
     * @param $casa
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllMenuCasa($casa)
    {
        return $this->model->query()
            ->where('casa_id',getCasaId($casa))
            ->get();
    }
}
