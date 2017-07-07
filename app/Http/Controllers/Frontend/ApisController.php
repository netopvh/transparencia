<?php

namespace App\Http\Controllers\Frontend;

use App\Exceptions\Access\GeneralException;
use App\Http\Controllers\Controller;
use App\Models\Estado;
use App\Repositories\Backend\Application\Contracts\InfraestruturaRepository;


class ApisController extends Controller
{

    private $infra;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(InfraestruturaRepository $infraestruturaRepository)
    {
        $this->infra = $infraestruturaRepository;
    }

    public function getCategorias($idCasa, $idCategoria)
    {
        $result = $this->infra->findWhere([
            'codigo_entidade' => $idCasa,
            'codigo_categoria' => $idCategoria
        ]);

        $table = "<table width='100%'>";
        $table .= "<thead>";
        $table .= "<tr>";
        $table .= "<th>Nome</th>";
        $table .= "<th>Endereço</th>";
        $table .= "<th>Bairro</th>";
        $table .= "<th>Cidade</th>";
        $table .= "<th>Cep</th>";
        $table .= "<th>Telefone</th>";
        $table .= "</tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        if (count($result) >= 1)
        {
            foreach ($result as $item) {
                $table .= "<tr>";
                $table .= "<td>". $item->unidade ."</td>";
                $table .= "<td>". $item->endereco ."</td>";
                $table .= "<td>". $item->bairro ."</td>";
                $table .= "<td>". $item->cidade ."</td>";
                $table .= "<td>". $item->cep ."</td>";
                $table .= "<td>". $item->telefone ."</td>";
                $table .= "</tr>";
            }
        }else{
            $table .= "<tr>";
            $table .= "<td colspan='6'>Sem Registros a serem exibidos</td>";
            $table .= "</tr>";
        }
        $table .= "</tbody>";
        $table .= "</table>";


        return $table;
    }

    public function getAtuacao($casa, $atuacao, $categoria)
    {
        $result = $this->infra->getByAtuacao($casa, $atuacao, $categoria);

        $table = "<table width='100%'>";
        $table .= "<thead>";
        $table .= "<tr>";
        $table .= "<th>Nome</th>";
        $table .= "<th>Endereço</th>";
        $table .= "<th>Bairro</th>";
        $table .= "<th>Cidade</th>";
        $table .= "<th>Cep</th>";
        $table .= "<th>Telefone</th>";
        $table .= "</tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        if (count($result) >= 1)
        {
            foreach ($result as $item) {
                $table .= "<tr>";
                $table .= "<td>". $item['unidade'] ."</td>";
                $table .= "<td>". $item['endereco'] ."</td>";
                $table .= "<td>". $item['bairro'] ."</td>";
                $table .= "<td>". $item['cidade'] ."</td>";
                $table .= "<td>". $item['cep'] ."</td>";
                $table .= "<td>". $item['telefone'] ."</td>";
                $table .= "</tr>";
            }
        }else{
            $table .= "<tr>";
            $table .= "<td colspan='6'>Sem Registros a serem exibidos</td>";
            $table .= "</tr>";
        }
        $table .= "</tbody>";
        $table .= "</table>";


        return $table;
    }


}
