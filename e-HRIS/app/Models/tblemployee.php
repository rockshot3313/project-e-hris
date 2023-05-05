<?php

namespace App\Models;

use App\Models\tblposition;
use App\Models\tbluserassignment;
use App\Models\Leave\employee_hr_details;

use App\Models\PDS\pds_address;
use App\Models\PDS\pds_educational_bg;
use App\Models\PDS\pds_family_bg;
use App\Models\Leave\employee_leave_available;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblemployee extends Model
{
    use HasFactory;
    protected $connection = 'e-hris';
    protected $table = 'profile';
    protected $primaryKey = 'id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'agencyid', 'bioid', 'lastname', 'firstname', 'mi', 'extension', 'dateofbirth'
        , 'civilstatus', 'religion', 'spouse', 'govissueid', 'contact', 'address'
        , 'citizenship', 'dual_citizenship_type', 'dual_citizenship_country', 'tribe', 'entrydate', 'sex', 'placeofbirth', 'height'
        , 'weight', 'bloodtype', 'gsis', 'pagibig', 'philhealth', 'sss', 'tin'
        , 'civilserviceid', 'telephone', 'mobile_number', 'mobile', 'email', 'image','employee_id',
        'created_by',

    ];

    public function getOffice()
    {
        return $this->hasOne(tbl_responsibilitycenter::class, 'head', 'agencyid')->where('active', 1);
    }

    public function getHRdetails()
    {
        return $this->hasOne(employee_hr_details::class, 'employeeid', 'agencyid')->where('active', 1);
    }
    public function getUsername()
    {
        return $this->hasOne(User::class, 'employee', 'agencyid')->where('active', 1);
    }

    public function res_address()
    {
        return $this->hasOne(pds_address::class, 'user_id', 'user_id')->where('address_type', 'RESIDENTIAL')->where('active', 1);
    }

    public function per_address()
    {
        return $this->hasOne(pds_address::class, 'user_id', 'user_id')->where('address_type', 'PERMANENT')->where('active', 1);
    }

    public function family_bg()
    {
        return $this->hasOne(pds_family_bg::class, 'user_id', 'user_id')->where('active', 1);
    }

    public function educ_bg()
    {
        return $this->hasOne(pds_educational_bg::class, 'user_id', 'user_id')->where('active', 1);
    }




}
