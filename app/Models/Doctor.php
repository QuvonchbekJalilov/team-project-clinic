<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Doctor extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'first_name_uz',
        'first_name_ru',
        'last_name_uz',
        'last_name_ru',
        'email',
        'telegram_url',
        'instagram_url',
        'cost',
        'experience',
        'image',
        'service_id'
    ];

    public $translatable = ['first_name', 'last_name'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function timetables()
    {
        return $this->hasMany(Timetable::class);
    }

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }
}
