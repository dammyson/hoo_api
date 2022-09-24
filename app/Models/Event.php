<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class Event extends Model
{
    use HasFactory, UuidTrait;
    protected $fillable = [
        'id', 
        'user_id',
        'title',
        'location',
        'description',
        'category',
        'start_date',
        'end_date',
        'type',
        'banner',
        'tickets',
        'city',
        'longitude',
        'latitude'
    ];

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }
}
