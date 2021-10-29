<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Client
 *
 * @property int $id
 * @property string|null $enterprise_name
 * @property string|null $firstname
 * @property string|null $lastname
 * @property string|null $telephone
 * @property string|null $email
 * @property string $rating
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reservation[] $reservations
 * @property-read int|null $reservations_count
 * @method static \Illuminate\Database\Eloquent\Builder|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereEnterpriseName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

    public function getClientName()
    {
        if (!empty($this->enterprise_name)) {
            $name[] = $this->enterprise_name;
        }
        if (!empty($this->firstname) || !empty($this->lastname)) {
            $name[] = $this->firstname . ' ' . $this->lastname;
        }
        return implode(' - ', $name);
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
