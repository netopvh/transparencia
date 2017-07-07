<?php
/**
 * Created by PhpStorm.
 * User: angelo.neto
 * Date: 18/04/2017
 * Time: 10:59
 */

namespace App\Enum;


use Greg0ire\Enum\AbstractEnum;

class ContabilTipos extends AbstractEnum
{

    const A = "Balanço Patrimonial";
    const B = "Balanço Orçamentário";
    const C = "Balanço Financeiro";
    const D = "Demonstração das Variações Patrimoniais";
    const E = "Demonstração de Fluxo de Caixa";
    const F = "Notas Explicativas";

}