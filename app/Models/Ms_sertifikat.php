<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ms_sertifikat extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table = 'ms_sertifikat';
    protected $guarded = [];
    protected $primaryKey = 'id_kategori';

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_kategori',
                'onUpdate' => true,
            ]
        ];
    }
}
