<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expence extends Model
{
    use HasFactory;
    protected $table = 'expence';
    protected $fillable = [
        'date',
        'description',
        'amount',
        'type'
    ];
}
