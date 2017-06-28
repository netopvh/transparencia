<?php

namespace App\Repositories\Backend\Application\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface BackendApplicationCasaRepository
 * @package namespace App\Contracts\Repositories;
 */
interface OrcamentoRepository extends RepositoryInterface
{

    public function create(array $attributes);
    public function getAllOrder($casa);
    public function getOrcamentoActualYear($casa);
    public function getOrcamentoThreeYear($casa);
    
}
