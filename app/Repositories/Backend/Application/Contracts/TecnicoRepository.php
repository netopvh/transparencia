<?php

namespace App\Repositories\Backend\Application\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface BackendApplicationCasaRepository
 * @package namespace App\Contracts\Repositories;
 */
interface TecnicoRepository extends RepositoryInterface
{

    public function findById($id);
    public function cleanDatabase();
    public function importRecords(array $attributes);
    public function getAll($casa);

}
