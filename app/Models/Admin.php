<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    /**
     * Get admin data by ID.
     *
     * @param int|null $adminId
     * @return Admin|null
     */
    public static function getAdminData($adminId = null)
    {
        if ($adminId === null) {
            return null; // You can handle null ID logic here if needed
        }

        return self::find($adminId);
    }
}
