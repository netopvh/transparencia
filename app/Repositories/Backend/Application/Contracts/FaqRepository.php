<?php

namespace App\Repositories\Backend\Application\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface BackendApplicationCasaRepository
 * @package namespace App\Contracts\Repositories;
 */
interface FaqRepository extends RepositoryInterface
{

    public function create(array $attributes);
    public function getAllCasa($casa);
    
}
