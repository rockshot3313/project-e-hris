<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hiring\tblpanels;

class doc_notification extends Model
{
    use HasFactory;
    protected $connection = 'e-hris';
    protected $table = 'admin_notification';

       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'target_id', 'target_type', 'seen','notif_content','purpose','active','created_by',
        'subject', 'subject_id', 'sender_type','sender_id'
    ];

    public function getDocDetails()
    {
        return $this->hasOne(doc_file::class, 'track_number', 'subject_id')->where('active', 1);
    }
    public function getGroupDetails()
    {
        return $this->hasOne(doc_groups::class, 'id', 'subject_id')->where('active', 1);
    }
    public function getUserDetails()
    {
        return $this->hasOne(tblemployee::class, 'agencyid', 'created_by')->where('active', 1);
    }

    public function getUser_Details()
    {
        return $this->hasMany(tblemployee::class, 'agencyid','created_by')->where('active',true);
    }

    //check for the panels

    public function check_Panels()
    {
        return $this->hasMany(tblpanels::class, 'panel_id','target_id')->where('active',true);
    }

}
