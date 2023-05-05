<?php

namespace App\Models\travel_order;

use App\Models\global_signatories;
use App\Models\tblposition;
use App\Models\tbluserassignment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class to_travel_orders extends Model
{
    use HasFactory;

    protected $connection = 'e-hris';
    protected $table = 'to_travel_order';
    protected $primaryKey = 'id';

    protected $fillable =
        [
            'name_id',
            'name',
            'date',
            'departure_date',
            'return_date',
            'pos_des_id',
            'pos_des_type',
            'station',
            'station_id',
            'destination',
            'destination_id',
            'purpose',
            'active',
            'created_by',
        ];

        public function get_signatories()
        {
            return $this->hasMany(global_signatories::class, 'type_id', 'id')->where('type', 'to')->where('active', 1);
        }

        public function get_desig()
        {
            return $this->hasMany(tbluserassignment::class, 'id', 'pos_des_id');
        }

        public function get_position()
        {
            return $this->hasMany(tblposition::class, 'id', 'pos_des_id');
        }
}
