<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'title_uz',
        'title_ru',
        'description_uz',
        'description_ru',
        'image'
    ];

    public $translatable = ['title', 'description'];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }
}
