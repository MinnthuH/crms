<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cinema_id',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cinema()
    {
        return $this->belongsTo(Cinema::class, 'cinema_id', 'id');
    }
    protected function acsrStatus(): Attribute
    {
        return Attribute::make(
            get: function ($value, array $attributes) {
                return match ($attributes['status'] ?? null) {
                    1 => ['text' => 'Active', 'color' => '16a34a'],
                    0 => ['text' => 'Inactive', 'color' => 'dc2626'],
                    default => ['text' => 'Unknown', 'color' => '000000'],
                };
            }
        );
    }
    
    
}
