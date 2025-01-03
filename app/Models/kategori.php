<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class kategori extends Model
{
    //
    protected $table = 'kategori';
    protected $primaryKey = 'kategoriId';

    protected $guarded = [
        'kategoriId'
    ];


    public function relasiBuku(): BelongsToMany
    {
        return $this->belongsToMany(buku::class, 'kategori_relasi', 'id_kategori', 'bukuId');
    }
}
