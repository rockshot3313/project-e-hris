<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbluserassignment extends Model
{
    use HasFactory;
    protected $connection = 'e-hris';
    protected $table = 'tbluserassignment';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'userauthority',
        'level',
        'entrydate',
        'active',
    ];

}
