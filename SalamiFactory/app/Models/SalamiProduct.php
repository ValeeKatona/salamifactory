<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalamiProduct extends Model
{
    use HasFactory;
    protected $fillable = ['product_type'];
}
