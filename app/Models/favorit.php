<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class favorit extends Model
{
    protected $table = 'koleksi';
    protected $guarded = ['koleksi_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function buku(): BelongsTo
    {
        return $this->belongsTo(buku::class, 'bukuId', 'bukuId');
    }

    //
}
