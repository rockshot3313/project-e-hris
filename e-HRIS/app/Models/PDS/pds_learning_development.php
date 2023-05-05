<?php

namespace App\Models\PDS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pds_learning_development extends Model
{
    use HasFactory;
    protected $table = 'pds_learning_development';
    protected $guarded = [];
    protected $fillable = [
        'user_id',
        'learning_dev_title',
        'from',
        'to',
        'hours_number',
        'learning_dev_type',
        'conducted_sponsored',
        'active',

    ];
}
