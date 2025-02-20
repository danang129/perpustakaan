<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'bukus';
    protected $primaryKey = 'id';
    protected $fillable = ['id','judul','kategori_id','penulis','tahun','jumlah'];

    public function kategori():BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }
}
