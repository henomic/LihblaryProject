<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ulasan extends Model
{
    //

    protected $table = 'ulasan_buku';
    protected $guarded = ['ulasanId'];
    protected $primaryKey = "ulasanId";


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
    public function buku(): BelongsTo
    {
        return $this->belongsTo(buku::class, 'bukuId', 'bukuId');
    }
}
