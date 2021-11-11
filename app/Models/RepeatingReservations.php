<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RepeatingReservations
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $repeat_start
 * @property \Illuminate\Support\Carbon $repeat_end
 * @property int $repeat_weekday
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reservation[] $reservations
 * @property-read int|null $reservations_count
 * @method static \Illuminate\Database\Eloquent\Builder|RepeatingReservations newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RepeatingReservations newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RepeatingReservations query()
 * @method static \Illuminate\Database\Eloquent\Builder|RepeatingReservations whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepeatingReservations whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepeatingReservations whereRepeatEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepeatingReservations whereRepeatStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepeatingReservations whereRepeatWeekday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepeatingReservations whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RepeatingReservations extends Model
{
    use HasFactory;

    protected $fillable = [
        'repeat_start',
        'repeat_end',
        'repeat_weekday'
    ];
    protected $casts = [
        'repeat_start' => 'datetime',
        'repeat_end' => 'datetime'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
