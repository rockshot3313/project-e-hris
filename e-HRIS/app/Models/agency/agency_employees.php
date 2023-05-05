<?php

namespace App\Models\agency;

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
            'employee_id',
            'agency_id',
            'designation_id',
            'position_id',
            'agencycode_id',
            'agencycode_id',
            'office_id',
            'employment_type',
            'start_date',
            'end_date',
            'salary_amount',
            'regular_status',
            'rank',
            'tranch',
            'status',
            'created_by',
            'active',
        ];

    public function get_user_profile()
    {
        return $this->hasOne(tblemployee::class, 'profile_id', 'id')->where('active', 1);
    }

    public function get_employment_status()
    {
        return $this->hasOne(doc_status::class, 'code', 'status')->where('active', 1);
    }

    public function get_position()
    {
        return $this->hasone(tblposition::class, 'id', 'position_id');
    }

    public function get_designation()
    {
        return $this->hasone(tbluserassignment::class, 'id', 'designation_id');
    }




}

