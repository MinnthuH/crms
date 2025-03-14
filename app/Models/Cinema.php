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
        'hall_ids',
        'showtime_ids',
        'ticketprice_ids',
    ];

    public function hall() {
        return $this->belongsTo(Hall::class, 'hall_ids','id');
    }
    public function showtime() {
        return $this->belongsTo(ShowTime::class, 'showtime_ids','id');
    }
    public function ticketprice() {
        return $this->belongsTo(TicketPrice::class, 'ticketprice_ids','id');
    }
}
