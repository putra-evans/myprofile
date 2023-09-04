<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Organisasi extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table = 'tbl_organisasi';
    protected $guarded = [];
    protected $primaryKey = 'id_organisasi';

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_organisasi',
                'onUpdate' => true,
            ]
        ];
    }
    protected function logo(): Attribute
    {
        return Attribute::make(
            get: fn ($logo) => asset('/storage/organisasi/' . $logo),
        );
    }
}
