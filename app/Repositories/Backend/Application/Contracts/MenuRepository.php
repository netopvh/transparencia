<?php

namespace App\Repositories\Backend\Application\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface BackendApplicationCasaRepository
 * @package namespace App\Contracts\Repositories;
 */
interface MenuRepository extends RepositoryInterface
{
    public function getDescritivo($casa);
    public function getMenuCentro($casa);
}
