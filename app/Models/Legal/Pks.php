<?php

namespace App\Models\Legal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pks extends Model
{
    use HasFactory;

    public
    $primaryKey = 'mpks_pk', // setup primaryKey
    $incrementing = false, // setup autoincrement primarykey visibility
    $timestamps = false; // setup timestamps visibility

    protected
    $connection = 'eopr',
        $table = 'mst_pks',
        $fillable = [],
        $keyType = 'string';
}
