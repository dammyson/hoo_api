<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class Transaction extends Model
{
    use HasFactory, UuidTrait;
    protected $fillable = [
        'id', 
        'user_id',
        'cost',
        'type',
        'ref',
        'status'
    ];
}
