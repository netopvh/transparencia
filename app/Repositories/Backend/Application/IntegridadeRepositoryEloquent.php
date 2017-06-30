<?php

namespace App\Repositories\Backend\Application;

use App\Exceptions\Access\GeneralException;
use Illuminate\Support\Facades\Storage;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Backend\Application\Contracts\IntegridadeRepository;
use App\Models\Integridade;
use Illuminate\Support\Facades\DB;
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

    public function getAll($casa)
    {
        $result = $this->model
            ->newQuery()
            ->select('id','type','year','file','published')
            ->where('casa_id', getCasaId($casa))
            ->orderBy('year','desc')
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
        $data = $this->removeFieldArray('files',$attributes);
        $result = $this->model->newQuery()
            ->where('casa_id',$attributes['casa_id'])
            ->where('year',$attributes['year'])
            ->where('type',$attributes['type'])
            ->get()->count();
        if ($result >= 1){
            throw new GeneralException("Já possui um registro no banco de dados");
        }

        $model = $this->model->newInstance($attributes);
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
