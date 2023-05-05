<?php

namespace App\Models\PDS;

use App\Models\Hiring\tbl_hiringlist;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pds_family_bg extends Model
{
    use HasFactory;
    protected $table = 'pds_family_bg';
    protected $guarded = [];
    protected $fillable = [
        'user_id',
        'spouse_surname',
        'spouse_firstname',
        'spouse_mi',
        'spouse_ext',

        'father_surname',
        'father_firstname',
        'father_mi',
        'father_ext',

        'mother_maidenname',
        'mother_surname',
        'mother_firstname',
        'mother_mi',

        'occupation',
        'employer_name',
        'business_address',
        'tel_no',
        'active',

    ];

    public function get_employee_child()
    {
        return $this->hasMany(pds_child_list::class,'user_id','user_id')->where('active', true);
    }
}
