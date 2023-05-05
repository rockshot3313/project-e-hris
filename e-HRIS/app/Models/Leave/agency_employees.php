<?php

namespace App\Models\Leave;

use App\Models\doc_status;
use App\Models\tblemployee;
use App\Models\tblposition;
use App\Models\tbluserassignment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class agency_employees extends Model
{
    use HasFactory;

    protected $connection = 'e-hris';
    protected $table = 'agency_employees';
    protected $primaryKey = 'id';

    protected $fillable =
        [
            'user_id',
            'profile_id',
            'agency_id',
            'designation_id',
            'posistion_id',
            'agencycode_id',
            'office_id',
            'employee_id',
            'employment_type',
            'start_date',
            'end_date',
            'status',
            'active',
            'created_by',
        ];


    public function get_user_profile()
    {
        return $this->hasOne(tblemployee::class, 'id', 'profile_id')->where('active', 1);
    }

    public function get_employment_status()
    {
        return $this->hasOne(doc_status::class, 'code', 'status')->where('active', 1);
    }



    public function get_employee_profile(){
        return $this->hasone(tblemployee::class, 'agencyid', 'agency_id');
    }



    public function get_position()
    {
        return $this->hasone(tblposition::class, 'id', 'posistion_id');
    }

    public function get_designation()
    {
        return $this->hasone(tbluserassignment::class, 'id', 'designation_id');
    }



}

