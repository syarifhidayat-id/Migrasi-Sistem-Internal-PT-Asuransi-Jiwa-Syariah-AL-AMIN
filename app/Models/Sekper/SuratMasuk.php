<?php

namespace App\Models\Sekper;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    public
        $primaryKey = 'tsm_pk', // setup primaryKey
        $incrementing = true, // setup autoincrement primarykey visibility
        $timestamps = false; // setup timestamps visibility

    protected
        $guarded = [],
        $table = 'trs_surat_masuk',
        $keyType = 'string';

    // const CREATED_AT = 'tsm_ins_date';
    // const UPDATED_AT = 'tsm_upd_date';

    protected static function booted()
    {

        // static::creating(function ($column) {
        //     $column->tsm_ins_user = auth()->id();
        // });

        // static::updating(function ($column){
        //     $column->tsm_upd_user = auth()->id();
        // });

        // static::retrieved(function($column) {
        //     $column->tsm_tanggal = date('Y-m-d', strtotime($column->tsm_tanggal));
        //     $column->tsm_ins_date = date('Y-m-d', strtotime($column->tsm_ins_date));
        //     $column->tsm_upd_date = date('Y-m-d', strtotime($column->tsm_upd_date));
        // });
    }

    // public function userInsert()
    // {
    //     return $this->belongsTo(User::class, 'tsm_ins_user', 'id');
    // }

    // public function userUpdate()
    // {
    //     return $this->belongsTo(User::class, 'tsm_upd_user', 'id');
    // }
}
