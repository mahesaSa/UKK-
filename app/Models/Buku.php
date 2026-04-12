<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    //
    protected $primaryKey = 'id_buku';

    protected $fillable = [
        'judul_buku',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'stok',
    ];
}
