<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OPD extends Authenticatable
{
    use HasFactory;
    protected $table = "opd";
    protected $primaryKey = 'id_opd';
}