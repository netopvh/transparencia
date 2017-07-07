<?php

namespace App\Repositories\Backend\Application;

use App\Exceptions\Access\GeneralException;
use Illuminate\Support\Facades\Storage;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Backend\Application\Contracts\IntegridadeRepository;
use App\Models\Integridade;
use App\Enum\IntegridadeTipos;
use Prettus\Repository\Events\RepositoryEntityDeleted;

/**
 * Class BackendApplicationCasaRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class IntegridadeRepositoryEloquent extends BaseRepository implements IntegridadeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Integridade::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll()
    {
        $result = $this->model
            ->newQuery()
            ->join('casas','integridades.casa_id','=','casas.id')
            ->select('integridades.id','integridades.type','integridades.year','integridades.file','integridades.published','casas.name')
            ->orderBy('year','desc')
            ->paginate(8);

        return $result;
    }

    /**
     * @param $casa
     */
    public function getAllCasa($casa)
    {
        $result = $this->model
            ->newQuery()
            ->join('casas','integridades.casa_id','=','casas.id')
            ->where('casas.name',$casa)
            ->where('published', 'S')
            ->select('integridades.id','integridades.type','integridades.year','integridades.file','integridades.published','casas.name')
            ->orderBy('type','asc')
            ->get();
        return $result;
    }

    /**
     * @param array $attributes
     * @return bool
     * @throws GeneralException
     */
    public function create(array $attributes)
    {
        //Remove item do array
        $data = $this->removeFieldArray('files',$attributes);
        //Veririca se existe no banco de dados
        //Caso tenha registro irá lançar uma exceção
        $result = $this->model->newQuery()
            ->where('casa_id',$attributes['casa_id'])
            ->where('year',$attributes['year'])
            ->where('type',$attributes['type'])
            ->get()->count();
        if ($result >= 1){
            throw new GeneralException("Já possui um registro no banco de dados para o ano ". $attributes['year']);
        }


        //Cadastra regustri no banco de dados
        $model = $this->model->newInstance($data);
        if ($model->save()){
            return true;
        }else{
            throw new GeneralException("Não foi possível inserir registro no banco de dados");
        }
    }

    /**
     * Update a entity in repository by id
     *
     *
     * @param array $attributes
     * @param       $id
     *
     * @return mixed
     */
    public function update(array $attributes, $id)
    {

        $data = $this->removeFieldArray('files',$attributes);

        $result = $this->model->newQuery()
            ->where('casa_id',$attributes['casa_id'])
            ->where('year',$attributes['year'])
            ->where('type',$attributes['type'])
            ->get()->count();
        if ($result >= 1){
            throw new GeneralException("Já possui um registro no banco de dados para o ano ". $attributes['year']);
        }

        $model = $this->model->find($id);
        $model->fill($data);
        if ($model->save()){
            return true;
        }else{
            throw new GeneralException("Não foi possível inserir registro no banco de dados");
        }
    }



    /**
     * Delete a entity in repository by id
     *
     * @param $id
     *
     * @return int
     */
    public function delete($id)
    {
        $this->applyScope();

        $temporarySkipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);

        $model = $this->find($id);
        //Á verificar a Remoção de arquivos da Integridade
        //$array = explode('/',$model->file);
        //$file = $array[1];
        //Storage::disk('integridade')->delete($file);
        $originalModel = clone $model;

        $this->skipPresenter($temporarySkipPresenter);
        $this->resetModel();

        $deleted = $model->delete();

        event(new RepositoryEntityDeleted($this, $originalModel));

        return $deleted;
    }

    public function publish($id)
    {
        $tipos = IntegridadeTipos::getConstants();
        $model = $this->model->find($id);

        $all = $this->model
            ->newQuery()
            ->where('casa_id', $model->casa_id)
            ->where('type',$model->type)
            ->where('published','S')
            ->get();

        if (count($all) >= 1){
            throw new GeneralException('Já existe um arquivo do tipo '. $tipos[$model->type] .' publicado, despublique para publicar um novo.');
        }else{
            $model->published = 'S';
            $model->save();
        }
    }

    public function unpublish($id)
    {

        $model = $this->model->find($id);
        $model->published = 'N';
        $model->save();

    }

    /**
     *
     *
     * MÉTODOS PRIVADOS
     *
     */

    private function removeFieldArray($field, array $array){
        if (is_array($field)){
            foreach ($field as $key => $value) {
                if (in_array($key,$array)){
                    unset($array[$key]);
                }
            }
        }else{
            if (in_array($field,array_keys($array))){
                unset($array[$field]);
            }
        }
        return $array;
    }

}
