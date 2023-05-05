<?php

namespace App\Models\applicant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class applicants_gender extends Model
{
    use HasFactory;
    protected $connection = 'e-hris';
    protected $table = 'applicants_gender';
    protected $primaryKey = 'id';

    protected $fillable = [
        'gender',
        'active',
    ];
}
