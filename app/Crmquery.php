<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crmquery extends Model
{
    //
    protected $connection = 'mysql';

    protected $table = ['vouchers','afiliados','caso_servicios','casos','clientes_corporativos','clientes_estados','coberturas_planes','estados','operaciones_subservicio','planes_de_coberturas','servicios_estados','servicios','tipos_de_pago','tipos_servicios_caso'];
}
