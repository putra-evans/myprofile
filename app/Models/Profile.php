<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table = 'tbl_profile';
    protected $guarded = [];
    protected $primaryKey = 'id_profile';

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_lengkap',
                'onUpdate' => true,
            ]
        ];
    }
    protected function foto(): Attribute
    {
        return Attribute::make(
            get: fn ($foto) => asset('/storage/img/' . $foto),
        );
    }
}
