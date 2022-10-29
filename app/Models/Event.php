<?php

namespace App\Models;

use App\Contracts\Likeable;
use App\Models\Concerns\Likes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;



class Event extends Model implements Likeable
{
    use HasFactory, UuidTrait, Likes;
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
