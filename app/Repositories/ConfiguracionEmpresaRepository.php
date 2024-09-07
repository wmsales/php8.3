<?php

namespace App\Repositories;

use App\Core\Database;

class ConfiguracionEmpresaRepository extends BaseRepository
{
    public function __construct(Database $database)
    {
        parent::__construct($database, 'configuracion_empresa');
    }
}
