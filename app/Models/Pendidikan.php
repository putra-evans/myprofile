<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table = 'tbl_pendidikan';
    protected $guarded = [];
    protected $primaryKey = 'id_pendidikan';

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_pendidikan',
                'onUpdate' => true,
            ]
        ];
    }
    protected function logo(): Attribute
    {
        return Attribute::make(
            get: fn ($logo) => asset('/storage/pendidikan/' . $logo),
        );
    }
}
