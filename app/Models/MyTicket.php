<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class MyTicket extends Model
{
    use HasFactory, UuidTrait;
    protected $fillable = [
        'id', 
        'user_id',
        'event_id',
        'ticket_id',
        'transaction_id',
        'quantity',
        'first_name',
        'last_name',
        'email',
        'phone_number'
    ];
}
