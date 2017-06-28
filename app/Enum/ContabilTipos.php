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

    const P = "Balanço Patrimonial";
    const O = "Balanço Orçamentário";
    const F = "Balanço Financeiro";
    const V = "Demonstração das Variações Patrimoniais";
    const C = "Demonstração de Fluxo de Caixa";
    const E = "Notas Explicativas";

}