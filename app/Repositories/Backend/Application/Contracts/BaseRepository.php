<?php
/**
 * Created by PhpStorm.
 * User: angelo.neto
 * Date: 14/07/2017
 * Time: 12:16
 */

namespace App\Repositories\Backend\Application\Contracts;


interface BaseRepository
{

    public function getFiles($casa);

    public function createFile(array $attributes);

    public function getNote($casa);

    public function createNote(array $attributes, array $values = []);

}