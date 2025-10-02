<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefGroupWhatsapp extends Model
{
    use HasFactory;

    /**
     * Nama tabel secara eksplisit (karena tidak mengikuti konvensi plural)
     *
     * @var string
     */
    protected $table = 'ref_group_whatsapp';

    /**
     * Kolom yang dapat diisi secara massal
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'year',
        'link',
        'description',
    ];

    /**
     * Tipe data yang perlu di-cast otomatis
     *
     * @var array<string, string>
     */
    protected $casts = [
        'year' => 'integer',
    ];
}
