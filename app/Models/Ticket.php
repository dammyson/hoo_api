<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class Ticket extends Model
{
    use HasFactory, UuidTrait;
    protected $fillable = [
        'id', 
        'event_id',
        'title',
        'cost',
        'min_allow',
        'max_allow',
        'quantity'
    ];
}
