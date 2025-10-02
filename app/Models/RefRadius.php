<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefRadius extends Model
{
    use HasFactory;

    /**
     * Nama tabel secara eksplisit
     *
     * @var string
     */
    protected $table = 'ref_radius';

    /**
     * Kolom yang dapat diisi secara massal
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'latitude',
        'longitude',
        'radius',
    ];

    /**
     * Tipe data yang perlu di-cast otomatis
     *
     * @var array<string, string>
     */
    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'radius' => 'integer',
    ];
}
