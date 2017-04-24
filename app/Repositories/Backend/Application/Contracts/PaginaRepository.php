<?php

namespace App\Repositories\Backend\Application\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface BackendApplicationCasaRepository
 * @package namespace App\Contracts\Repositories;
 */
interface PaginaRepository extends RepositoryInterface
{
    public function findById($id);
    public function findBySlug($slug,$casa);
}
