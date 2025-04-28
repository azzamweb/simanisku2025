<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KibTanah extends Model
{
    use HasFactory;
    protected $table = "kib";
    protected $primaryKey = 'id_kib';
}
