<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlightPassenger extends Model
{
    /**
     * Get admin data by ID.
     *
     * @param int|null $passengerId
     * @return FlightPassenger|null
     */
    public static function getFlightBookingData($passengerId = null){
        if ($passengerId === null) {
            return null; // You can handle null ID logic here if needed
        }

        return self::find($passengerId);
    }
}
