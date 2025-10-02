<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    /**
     * Nama tabel (opsional, bisa dihapus karena nama model dan tabel sudah sesuai konvensi)
     *
     * @var string
     */
    protected $table = 'members';

    /**
     * Kolom yang dapat diisi secara massal
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parent_id',
        'user_id',
        'name',
        'email',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'school',
        'school_grade',
        'disease',
        'has_joined_other_club',
        'photo',
        'status',
    ];

    /**
     * Tipe data yang perlu di-cast otomatis
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'date',
        'has_joined_other_club' => 'boolean',
    ];

    /**
     * Relasi ke ParentModel (many to one)
     */
    public function parent()
    {
        return $this->belongsTo(ParentModel::class, 'parent_id');
    }

    /**
     * Relasi ke User (many to one)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
