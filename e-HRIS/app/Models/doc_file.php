<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doc_file extends Model
{
    use HasFactory;
    protected $connection = 'dsscd85_qrdts';
    protected $table = 'doc_file';
    protected $primaryKey = 'id';

    protected $fillable = [
        'track_number',
        'name',
        'desc',
        'note',
        'type',
        'level',
        'status',
        'active',
        'type_submitted',
        'send_to_all',
        'show_author',
        'created_by',
        'created_at',
        'updated_at',
        'trail_release',
        'holder_type',
        'holder_id',
        'holder_user_id',
        'display_type'
    ];

    public function getDocType()
    {
        return $this->hasOne(doc_type::class, 'id', 'type')->where('active', 1);
    }

    public function getDocLevel()
    {
        return $this->hasOne(doc_level::class, 'id', 'level')->where('active', 1);
    }

    public function getDocTypeSubmitted()
    {
        return $this->hasOne(doc_type_submitted::class, 'id', 'type_submitted')->where('active', 1);
    }

    public function getDocStatus()
    {
        return $this->hasOne(doc_status::class, 'id', 'status')->where('active', 1);
    }

    public function getAttachments()
    {
        return $this->hasMany(doc_file_attachment::class, 'doc_file_id', 'track_number')->where('active', 1);
    }

    public function countUsersToReceive()
    {
        return $this->hasMany(doc_track::class, 'track_number', 'track_number')->where('active', 1)->where('for_status', 3);
    }

    public function getAuthor()
    {
        return $this->hasOne(tblemployee::class, 'agencyid', 'created_by')->where('active', 1);
    }
    public function getAddress()
    {
        return $this->hasOne(employee_address::class, 'employeeid', 'agencyid')->where('active', 1);
    }
    public function getHolder()
    {
        return $this->hasOne(tblemployee::class, 'agencyid', 'holder_id')->where('active', 1);
    }
    public function getTrackdetails()
    {
        return $this->hasMany(doc_track::class, 'track_number', 'track_number')->where('active', 1);
    }

    public function get_track_creator()
    {
        return $this->hasMany(doc_track::class, 'track_number', 'track_number')->where('active', 1);
    }
}
