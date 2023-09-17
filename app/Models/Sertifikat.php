<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Sertifikat extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table = 'ta_sertifikat';
    protected $guarded = [];
    protected $primaryKey = 'id_sertifikat';

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_sertifikat',
                'onUpdate' => true,
            ]
        ];
    }
    protected function file(): Attribute
    {
        return Attribute::make(
            get: fn ($file) => asset('/storage/sertifikat/' . $file),
        );
    }
}
