<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static latest()
 * @method static insert(array $array)
 * @method static find($id)
 */
class HomeAbout extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'short_dis',
        'long_dis',
        'created_at'
    ];
}
