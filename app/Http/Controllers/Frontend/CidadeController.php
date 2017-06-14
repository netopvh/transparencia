<?php

namespace App\Http\Controllers\Frontend;

use App\Exceptions\Access\GeneralException;
use App\Http\Controllers\Controller;
use App\Models\Estado;
use App\Repositories\Backend\Application\Contracts\DirigenteRepository;


class CidadeController extends Controller
{

    private $estadoModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Estado $estado)
    {
        $this->estadoModel = $estado;
    }

    public function getCidades($idEstado)
    {
        $estado = $this->estadoModel->find($idEstado);
        $cidades = $estado->cidades()->getQuery()->get(['id','name']);

        return response()->json($cidades);
    }


}
