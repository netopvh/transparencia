<?php
/**
 * Created by PhpStorm.
 * User: angelo.neto
 * Date: 18/04/2017
 * Time: 10:59
 */

namespace App\Enum;


use Greg0ire\Enum\AbstractEnum;

class IntegridadeTipos extends AbstractEnum
{

    const A = "TCU Relatório de Gestão";
    const B = "Auditoria Independente";
    const C = "Código de Ética";
    const D = "Comitê de Ética";
    const E = "Ouvidoria";

}