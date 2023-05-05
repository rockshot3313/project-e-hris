<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_position extends Model
{
    use HasFactory;
    protected $connection = 'e-hris';
    protected $table = 'tbl_position';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'emp_position',
        'level',
        'type',
        'status',
        'descriptions',
        'entrydate',
        'durationlimit',
        'maxyears',
        'role',
        'unitdeload',
        'maxload',
        'overload',
        'minload',

    ];



}
