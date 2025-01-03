<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class relasiKategoriBuku extends Model
{
    // use LogsActivity;
    protected $table = 'kategori_relasi';
    protected $primaryKey = 'kategoriBukuId';
    protected $guarded = ['kategoriBukuId'];
}
