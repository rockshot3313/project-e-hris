<?php

namespace App\Models\PDS;

use App\Models\ref_brgy;
use App\Models\ref_citymun;
use App\Models\ref_province;
use App\Models\ref_region;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pds_address extends Model
{
    use HasFactory;
    protected $table = 'pds_address';
    protected $guarded = [];
    protected $fillable = [
        'user_id',
        'address_type',
        'house_block_no',
        'street',
        'subdivision_village',
        'brgy',
        'city_mun',
        'province',
        'zip_code',
        'active',

    ];

    public function get_province()
    {
        return $this->hasOne(ref_province::class, 'provCode', 'province');
    }

    public function get_city_mun()
    {
        return $this->hasOne(ref_citymun::class, 'citymunCode', 'city_mun');
    }
    public function get_brgy()
    {
        return $this->hasOne(ref_brgy::class, 'brgyCode', 'brgy');
    }

}
