<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\Http\Models\Buku;
use app\Http\Models\User;
class Transaksi extends Model
{
    //
    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'user_id',
        'id_buku',
        'tgl_pinjam',
        'tgl_pengembalian',
    ];

     protected $casts = [
        'tgl_pinjam' => 'date',
        'tgl_pengembalian' => 'date',
        'tgl_pengembalian_aktual' => 'date',
    ];

    public function buku()
    {
        return $this->belongsTo(buku::class,'id_buku'  );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id')->where('role', 'siswa');
    }

    public function scopeSiswa($query)
    {
        return $query->whereHas('user', function ($q) {
            $q->where('role', 'siswa');
        });
    }
}
