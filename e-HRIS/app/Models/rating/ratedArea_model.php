<?php

namespace App\Models\rating;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ratedArea_model extends Model
{
    use HasFactory;
    protected $connection = 'e-hris';
    protected $table = 'rated_area';
    protected $primaryKey = 'id';

    protected $fillable = [
        'applicant_id',
        'position_id',
        'criteria_id',
        'areas_id',
        'rate',
        'rated_by',
        'active',
        
    ];
    public function get_area()
    {
        return $this->hasMany(areas_model::class, 'id', 'areas_id');
    }
}
