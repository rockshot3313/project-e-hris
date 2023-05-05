<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doc_tempfiles extends Model
{
    use HasFactory;
    protected $connection = 'e-hris';
    protected $table = 'admin_tempfiles';
    protected $primaryKey = 'id';

    protected $fillable = [
        'folder',
        'filename',
    ];
}
