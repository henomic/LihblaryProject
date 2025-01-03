<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class pencatatanStok extends Model
{
    protected $guarded = ['id'];
    protected $table = 'pencatatan_stok';
    //


    public function buku(): BelongsTo
    {
        return $this->belongsTo(buku::class, 'bukuId', 'bukuId');
    }
}
