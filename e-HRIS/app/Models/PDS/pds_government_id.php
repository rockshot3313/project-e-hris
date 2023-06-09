<?php

namespace App\Models\PDS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pds_government_id extends Model
{
    use HasFactory;
    protected $table = 'pds_government_id';
    protected $guarded = [];
    protected $fillable = [
        'user_id',
        'gvt_issued_id',
        'id_license_passport_no',
        'date_place_issuance',
        'active',
    ];
}
