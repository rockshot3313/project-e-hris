<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_responsibilitycenter extends Model
{
    use HasFactory;

    protected $connection = 'e-hris';
    protected $table = 'responsibilitycenter';
    protected $primaryKey = 'responid';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'centername', 'descriptions', 'department', 'head', 'accounts',
    ];

    public function sub_employeeinf()
    {
        return $this->hasOne(tblemployee::class, 'agencyid', 'head')->where('active', 1);
    }
}
