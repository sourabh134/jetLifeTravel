<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlightBooking extends Model
{
    /**
     * Get admin data by ID.
     *
     * @param int|null $bookingId
     * @return FlightBooking|null
     */
    public static function getFlightBookingData($bookingId = null){
        if ($bookingId === null) {
            return null; // You can handle null ID logic here if needed
        }

        return self::find($bookingId);
    }

    public static function getAllFlightBookingData(){
        return self::get();
    }
}
