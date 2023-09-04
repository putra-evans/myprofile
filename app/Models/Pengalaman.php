<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Pengalaman extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table = 'tbl_pengalaman_kerja';
    protected $guarded = [];
    protected $primaryKey = 'id_pengalaman';

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_perusahaan',
                'onUpdate' => true,
            ]
        ];
    }
    protected function logo(): Attribute
    {
        return Attribute::make(
            get: fn ($logo) => asset('/storage/pengalamankerja/' . $logo),
        );
    }
    protected function file(): Attribute
    {
        return Attribute::make(
            get: fn ($file) => asset('/storage/pengalamankerja/' . $file),
        );
    }
}
