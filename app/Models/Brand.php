<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static latest()
 * @method static insert(array $array)
 * @method static find($id)
 */
class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand_name',
        'brand_image',
        'created_at'
    ];
}
