<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use App\Models\FlightBooking;
use App\Models\FlightPassenger;

class BookingController extends Controller
{
    public function flightbooking(){
        $admin_id = Session::get('jet_admin_user_id');
        $admin = Admin::getAdminData($admin_id);
        $FlightBooking = FlightBooking::getAllFlightBookingData();
        return view('admin.flightbooking', compact('admin','FlightBooking'));
    }


}
