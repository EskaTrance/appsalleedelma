<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'enterprise_name',
        'firstname',
        'lastname',
        'telephone',
        'email',
        'rating',
        'notes'
    ];
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
