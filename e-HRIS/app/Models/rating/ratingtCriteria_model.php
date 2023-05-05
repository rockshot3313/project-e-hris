<?php

namespace App\Models\rating;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hiring\tbl_positionType;

class ratingtCriteria_model extends Model
{
    use HasFactory;
    protected $connection = 'e-hris';
    protected $table = 'tbl_applicant_ratingcriteria';
    protected $primaryKey = 'id';

    protected $fillable = [
        'creteria',
        'position',
        'maxrate',
        'active',
    ];

    public function getPosition_category()
    {
        return $this->hasMany(tbl_positionType::class, 'id', 'position');
    }
    public function get_areas(){
        return $this->hasMany(areas_model::class, 'criteria_id', 'id');
    }

    // public function rated_aria()
    // {
    //     return $this->hasMany(ratedArea_model::class, 'criteria_id', 'id')->where('position_id');
    // }

}
