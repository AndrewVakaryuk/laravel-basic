<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static insert(array $array)
 */
class Multipic extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'created_at'
    ];
}
