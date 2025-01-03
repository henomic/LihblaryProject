<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;

class buku extends Model
{


    protected $table = 'buku';
    protected $primaryKey = 'bukuId';
    protected $guarded = [
        'bukuId'
    ];



    public function kategori(): BelongsToMany
    {
        return $this->belongsToMany(kategori::class, 'kategori_relasi', 'bukuId', 'id_kategori')
            ->withPivot('id_kategori');
    }


    public function ulasan(): HasMany
    {
        return $this->hasMany(ulasan::class, 'bukuId', 'bukuId');
    }
    public function peminjaman(): HasMany
    {
        return $this->hasMany(peminjaman::class, 'bukuId', 'bukuId');
    }
}
