<?php

namespace App\Repositories\Backend\Access\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface RoleRepository
 * @package namespace App\Repositories\Access;
 */
interface RoleRepository extends RepositoryInterface
{
    public function getAll();
    public function getCount();
}
