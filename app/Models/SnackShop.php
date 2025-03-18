<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SnackShop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cinema_id',
    ];

    public function cinema()
    {
        return $this->belongsTo(Cinema::class, 'cinema_id', 'id');
    }
}
