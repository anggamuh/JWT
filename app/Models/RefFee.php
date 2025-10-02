<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefFee extends Model
{
    use HasFactory;

    /**
     * Nama tabel secara eksplisit
     *
     * @var string
     */
    protected $table = 'ref_fee';

    /**
     * Kolom yang dapat diisi secara massal
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'registration_fee',
        'monthly_fee',
    ];

    /**
     * Tipe data yang perlu di-cast otomatis
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
        'registration_fee' => 'decimal:2',
        'monthly_fee' => 'decimal:2',
    ];
}
