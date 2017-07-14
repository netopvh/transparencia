<?php
/**
 * Created by PhpStorm.
 * User: angelo.neto
 * Date: 14/07/2017
 * Time: 12:11
 */

namespace App\Repositories\Backend\Application;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Eloquent\BaseRepository as BaseEloquent;
use App\Repositories\Backend\Application\Contracts\BaseRepository as BaseRepositoryContract;
use App\Exceptions\Access\GeneralException;
use Illuminate\Container\Container as Application;

class BaseRepository extends BaseEloquent implements BaseRepositoryContract
{

    protected $nota;

    protected $file;

    public function __construct(Application $app ,Model $nota ,Model $file)
    {
        parent::__construct($app);
        $this->nota = $nota;
        $this->file = $file;
    }
    
    public function model()
    {
        return $this->model;
    }

    /**
     * Busca todos os arquivos no banco de dados
     *
     * @param $casa
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getFiles($casa)
    {
        if (count($instance = $this->file->newQuery()->where('casa_id',$casa)->orderBy('type','asc')->get()) >= 1){
            return $instance;
        }else{
            return ['file' => '', 'casa_id'=> $casa];
        }
    }

    /**
     * Cria ou atualiza arquivo no banco de dados
     *
     * @param array $attributes
     * @return bool
     * @throws GeneralException
     */
    public function createFile(array $attributes)
    {
        if (count($instance = $this->file->newQuery()->where('type',$attributes['type'])->where('casa_id',$attributes['casa_id'])->first()) >= 1) {
            $model = $instance->fill($attributes);
            if ($model->save()){
                return true;
            }else{
                throw new GeneralException('Erro ao gravar registro no banco de dados');
            }
        }else{
            $model = $this->file->newInstance($attributes);
            if ($model->save()){
                return true;
            }else{
                throw new GeneralException('Erro ao gravar registro no banco de dados');
            }
        }
    }

    /**
     * Localiza a Nota de acordo com a Casa
     *
     * @param $casa
     * @return array|mixed
     */
    public function getNote($casa)
    {
        if (! is_null($instance = $this->nota->newQuery()->where('casa_id',$casa)->whereNotNull('notas')->first())) {
            return $instance;
        }else{
            return ['notas'=>'','casa_id'=>$casa];
        }
    }

    /**
     * Cria ou atualiza registro no banco de dados de acordo com a Casa
     *
     * @param array $attributes
     * @param array $values
     * @return bool
     * @throws GeneralException
     */
    public function createNote(array $attributes, array $values = [])
    {
        if (! is_null($instance = $this->nota->newQuery()->whereNotNull('notas')->where('casa_id',$attributes['casa_id'])->first())) {
            $model = $instance->fill($attributes);
            if ($model->save()){
                return true;
            }else{
                throw new GeneralException('Erro ao gravar registro no banco de dados');
            }
        }else{
            $model = $this->nota->newInstance($attributes);
            if ($model->save()){
                return true;
            }else{
                throw new GeneralException('Erro ao gravar registro no banco de dados');
            }
        }
    }

}