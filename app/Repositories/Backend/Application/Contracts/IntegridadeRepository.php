<?php

namespace App\Repositories\Backend\Application\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface BackendApplicationCasaRepository
 * @package namespace App\Contracts\Repositories;
 */
interface IntegridadeRepository extends RepositoryInterface
{

    public function getAll();
    public function getAllCasa($casa);
    public function publish($id);
    public function unpublish($id);

}
