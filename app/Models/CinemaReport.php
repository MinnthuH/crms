<?php

namespace App\Models;

use App\Models\AdminUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CinemaReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cinema_id',
        'hall_id',
        'movie_id',
        'show_date',
        'showtime_id',
        '2000',
        '2500',
        '3000',
        '3500',
        '4000',
        '4500',
        '5000',
        '5500',
        '6000',
        '6500',
        '7000',
        '7500',
        '8000',
        '8500',
        '9000',
        '9500',
        '10000',
        '10500',
        '12000',
        '16000',
        '17500',
        '20000',
        '22500',
        '25000',
        '30000',
        'total_seats',
        'total_revenue',
        'epc_id',
    ];

    public function user()
    {
        return $this->belongsTo(AdminUser::class,'user_id','id');
    }

    public function cinema()
    {
        return $this->belongsTo(Cinema::class,'cinema_id','id');
    }

    public function hall()
    {
        return $this->belongsTo(Hall::class,'hall_id','id');
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class,'movie_id','id');
    }

    public function showtime()
    {
        return $this->belongsTo(ShowTime::class,'showtime_id','id');
    }

    public function ticketprice()
    {
        return $this->belongsTo(TicketPrice::class,'ticketprice_id','id');
    }
    public function epc()
    {
        return $this->belongsTo(EPC::class,'epc_id','id');
    }
}
