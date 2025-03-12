<?php

namespace App\Models;

use App\Models\Hall;
use App\Models\ShowTime;
use App\Models\TicketPrice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cinema extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'hall_id',
        'showtime_id',
        'ticketprice_id',
    ];

    public function hall() {
        return $this->belongsTo(Hall::class, 'hall_id','id');
    }
    public function showtime() {
        return $this->belongsTo(ShowTime::class, 'showtime_id','id');
    }
    public function ticketprice() {
        return $this->belongsTo(TicketPrice::class, 'ticketprice_id','id');
    }
}
