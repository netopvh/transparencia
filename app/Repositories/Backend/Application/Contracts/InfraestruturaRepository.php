<?php

namespace App\Repositories\Backend\Application\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface BackendApplicationCasaRepository
 * @package namespace App\Contracts\Repositories;
 */
interface InfraestruturaRepository extends RepositoryInterface
{

    public function import($attributes);
    public function getAll($perPage);
    public function getAllCasa($casa,$categoria);
    public function getAllCasaAtuacao($casa,$atuacao);
    public function getByAtuacao($casa, $atuacao, $categoria);

}
