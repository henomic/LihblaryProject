<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class peminjaman extends Model
{
    //




    protected $primaryKey = 'peminjamanId';

    protected $table = 'peminjaman';
    protected $guarded = [
        'peminjamanId'
    ];



    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function buku(): BelongsTo
    {
        return $this->belongsTo(buku::class, 'bukuId', 'bukuId');
    }


    public function denda(): HasMany
    {
        return $this->hasMany(denda::class, 'id_peminjaman', 'peminjamanId');
    }
}
