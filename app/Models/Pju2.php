<?php

// app/Models/Pju2.php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Pju2 extends Model
{
    protected $table = 'pju_2'; 
    protected $fillable = [
        'daya',
        'daya_harian',
        'arus',
        'profit_harian',
        'daya_total',
        'profit_total',
        'bebas_emisi',
    ];
}