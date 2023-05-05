<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class global_signatories extends Model
{
    use HasFactory;

    protected $connection = 'e-hris';
    protected $table = 'global_signatories';
    protected $primaryKey = 'id';

    protected $fillable =
        [
            'name',
            'type',
            'type_id',
            'employee_id',
            'for',
            'description',
            'created_by',
            'active',
        ];

        public function getUserinfo()
        {
            return $this->hasOne(tblemployee::class, 'agencyid', 'employee_id')->where('active', 1);
        }

}
