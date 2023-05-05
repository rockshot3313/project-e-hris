<?php

namespace App\Models\PDS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pds_child_list extends Model
{
    use HasFactory;
    protected $table = 'pds_child_list';
    protected $guarded = [];
    protected $fillable = [
        'user_id',
        'name',
        'birth_date',
        'active',

    ];
}
