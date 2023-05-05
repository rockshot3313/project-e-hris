<?php

namespace App\Models\PDS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pds_voluntary_work extends Model
{
    use HasFactory;
    protected $table = 'pds_voluntary_work';
    protected $guarded = [];
    protected $fillable = [
        'user_id',
        'org_name_address',
        'from',
        'to',
        'hours_number',
        'work_position_nature',
        'active',

    ];
}
