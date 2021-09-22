<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static latest()
 * @method static insert(array $array)
 */
class Slider extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'image',
        'created_at'
    ];
}
