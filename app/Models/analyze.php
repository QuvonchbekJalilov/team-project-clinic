<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class analyze extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_unique_id',
        'analyze_info_uz',
        'analyze_info_ru',
    ];

    
}
