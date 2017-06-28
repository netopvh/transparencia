<?php

namespace App\Repositories\Backend\Application;

use App\Exceptions\Access\GeneralException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Backend\Application\Contracts\PaginaRepository;
use App\Models\Pagina;
use Prettus\Validator\Contracts\ValidatorInterface;
//use App\Validators\CasaValidator;

/**
 * Class BackendApplicationCasaRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class PaginaRepositoryEloquent extends BaseRepository implements PaginaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Pagina::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param array $attributes
     * @return bool
     * @throws GeneralException
     */
    public function create(array $attributes)
    {
        if (!is_null($this->validator)) {

            $attributes = $this->model->newInstance()->forceFill($attributes)->toArray();

            $this->validator->with($attributes)->passesOrFail(ValidatorInterface::RULE_CREATE);
        }

        $pagina = $this->model->query()->where('title',$attributes['title'])->where('casa_id',$attributes['casa_id'])->get()->count();
        if ($pagina >= 1){
            throw new GeneralException("Ops, já existe um registro para o bloco e casa selecionada");
        }

        $model = $this->model->newInstance($attributes);
        if ($model->save()){
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

            $attributes = $this->model->newInstance()->forceFill($attributes)->toArray();

            $this->validator->with($attributes)->passesOrFail(ValidatorInterface::RULE_CREATE);
        }



        $pagina = $this->model->find($id);
        $pagina->slug = null;
        $pagina->fill($attributes);;

        if ($pagina->save()){
            return true;
        }else{
            throw new GeneralException('Erro ao gravar registro no banco');
        }

    }

    /**
     * Localiza registro no banco de dados
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     * @throws GeneralException
     */
    public function findById($id)
    {
        $result = $this->model->with('casa')->find($id);
        if(is_null($result)){
            throw new GeneralException('Nenhum registro localizado no banco de dados!');
        }

        return $result;
    }
    public function findBySlug($slug,$casa)
    {
        $result = $this->model->where('slug',$slug)->where('casa_id',$casa)->first();
        if (is_null($result)){
            throw new GeneralException('Página não localizada');
        }
        return $result;
    }

    public function getCasaContent($casa)
    {
        $result = $this->model->where('casa_id',$casa)->first();
        if (is_null($result)){
            throw new GeneralException('Conteúdo não localizado');
        }
        return $result;
    }

    /**
     * @param $casa
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getPageByCasa($casa)
    {
        return $this->model->query()
            ->where('casa_id',getCasaId($casa))
            ->get();
    }
}
