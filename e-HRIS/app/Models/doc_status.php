<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doc_status extends Model
{
    use HasFactory;
    protected $connection = 'e-hris';
    protected $table = 'status_codes';
    protected $primaryKey = 'id';

}
