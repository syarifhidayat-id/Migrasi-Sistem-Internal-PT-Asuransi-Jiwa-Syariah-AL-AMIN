<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WewenangJabatan extends Model
{
    use HasFactory;

    public
        $primaryKey = 'wmj_pk', // setup primaryKey
        $incrementing = false, // setup autoincrement primarykey visibility
        $timestamps = false; // setup timestamps visibility

    protected
        $table = 'web_menu_jabatan',
        $fillable = [
            'wmj_pk',
            'wmj_wmn_kode',
            'wmj_group',
            'wmj_sjab_kode',
            'wmj_aktif',
        ],
        $keyType = 'string';
}
