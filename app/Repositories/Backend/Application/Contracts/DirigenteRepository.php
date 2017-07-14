<?php

namespace App\Repositories\Backend\Application\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface BackendApplicationCasaRepository
 * @package namespace App\Contracts\Repositories;
 */
interface DirigenteRepository extends RepositoryInterface
{
    public function findById($id);
    public function cleanDatabase();
    public function importRecords(array $attributes);
    public function getAll($casa);
    public function getNote($casa);
    public function createNote(array $attributes, array $values = []);
    public function getFiles($casa);
    public function createFile(array $attributes);
}
