<?php

namespace App\Repositories\Backend\Application\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface BackendApplicationCasaRepository
 * @package namespace App\Contracts\Repositories;
 */
interface MenuRepository extends RepositoryInterface
{
    public function getMenuCentroSesi();
    public function getDescritivoSesi();
}
