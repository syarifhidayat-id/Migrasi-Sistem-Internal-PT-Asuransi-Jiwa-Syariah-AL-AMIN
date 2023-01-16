<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komisi extends Model
{
    use HasFactory;

    public
        $primaryKey = 'tkomh_pk', // setup primaryKey
        $incrementing = false, // setup autoincrement primarykey visibility
        $timestamps = false; // setup timestamps visibility

    protected
        $connection = 'etrs',
        $table = 'trs_komisi_hdr',
        $keyType = 'string';
}
