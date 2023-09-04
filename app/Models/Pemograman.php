<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Pemograman extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table = 'ms_pemograman';
    protected $guarded = [];
    protected $primaryKey = 'id_bhs_pemograman';

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_bahasa',
                'onUpdate' => true,
            ]
        ];
    }
    protected function foto(): Attribute
    {
        return Attribute::make(
            get: fn ($foto) => asset('/storage/pemograman/' . $foto),
        );
    }
}
