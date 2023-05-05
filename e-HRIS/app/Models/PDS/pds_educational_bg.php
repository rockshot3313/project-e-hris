<?php

namespace App\Models\PDS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pds_educational_bg extends Model
{
    use HasFactory;
    protected $table = 'pds_educational_bg';
    protected $guarded = [];
    protected $fillable = [
        'user_id',
        'level',
        'school_name',
        'degreee_course',
        'attendance_from',
        'attendance_to',
        'units_earned',
        'year_graduated',
        'acad_honors',
        'active',

    ];
}
