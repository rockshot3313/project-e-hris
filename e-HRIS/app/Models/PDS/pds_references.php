<?php

namespace App\Models\PDS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pds_references extends Model
{
    use HasFactory;
    protected $table = 'pds_references';
    protected $guarded = [];
    protected $fillable = [
        'user_id',
        'name',
        'address',
        'tel_no',
        'active',

    ];
}
