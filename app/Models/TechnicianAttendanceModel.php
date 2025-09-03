<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class TechnicianAttendanceModel extends Model
{
    // Define table name if different from the default
    protected $table = 'technician_attendance';

    // Define fillable fields
    protected $fillable = [
        // ...define fillable fields...
    ];
}
