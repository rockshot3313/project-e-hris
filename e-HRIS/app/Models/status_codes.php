<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class status_codes extends Model
{
    use HasFactory;
    protected $connection = 'e-hris';
    protected $table = 'status_codes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'desc',
        'class',
        'code',
        'stag',
        'active',
    ];

}
