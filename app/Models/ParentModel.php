<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentModel extends Model
{
    use HasFactory;

    /**
     * Nama tabel secara eksplisit (karena modelnya tidak bernama "Parent")
     *
     * @var string
     */
    protected $table = 'parents';

    /**
     * Kolom yang dapat diisi secara massal
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'address',
        'phone_number_r',
        'phone_number_f',
        'emergency_number',
    ];

    /**
     * Relasi ke model User (many to one)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
