<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuJabatan extends Model
{
    use HasFactory;

    public
        $primaryKey = 'wmj_pk', // setup primaryKey
        $incrementing = false, // setup autoincrement primarykey visibility
        $timestamps = false; // setup timestamps visibility

    protected
        $table = 'web_menu_jabatan',
        $keyType = 'string';
}
