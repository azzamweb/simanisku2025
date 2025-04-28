<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class AkunDinas extends Authenticatable
{
    protected $table = 'akun_dinas';
    protected $primaryKey = 'id_akun_dinas';
}