<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    /**
     * Nama tabel secara eksplisit (opsional, karena nama tabel sudah sesuai konvensi)
     *
     * @var string
     */
    protected $table = 'files';

    /**
     * Kolom yang dapat diisi secara massal
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'member_id',
        'id_card',
        'birth_certificate',
        'family_card',
        'club_release_letter',
    ];

    /**
     * Relasi ke model Member (many to one)
     */
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
