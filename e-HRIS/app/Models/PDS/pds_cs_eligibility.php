<?php

namespace App\Models\PDS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pds_cs_eligibility extends Model
{
    use HasFactory;
    protected $table = 'pds_cs_eligibility';
    protected $guarded = [];
    protected $fillable = [
        'user_id',
        'eligibility_type',
        'rating',
        'date_examination',
        'place_examination',
        'license_number',
        'license_validity',
        'active',

    ];
}
