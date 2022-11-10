<?php

namespace App\Imports\Tehnik\Soc;

use App\Http\Controllers\Library\KodeController;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class UploadTarifSocImport implements ToCollection, WithStartRow
{
    /**
    * @param Collection $collection
    */

    // private $rows = 0;

    public function __construct(string $kodeImportTarif, $kolom, $baris)
    {
        $this->kodeImportTarif = $kodeImportTarif;
        $this->kolom = $kolom;
        $this->baris = $baris;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row) {
            $vtable = DB::table('emst.mst_tarif_usia_jwaktu');
            $jsonArr = array();
            $jsonArr['mstuj_pk'] = KodeController::__getpx($vtable->max('mstuj_pk'), 18);
            $jsonArr['mstuj_mth_pk'] = $this->kodeImportTarif;
            for ($colsx=0; $colsx <= $this->kolom+1; $colsx++) {
                $scol="mstuj_".($colsx-1);
                if ($colsx==0) {
                    $scol="mstuj_usia";
                }
                $jsonArr[$scol] = $row[($colsx)];
            }
            $vtable->insert($jsonArr);
        }
    }

    public function startRow(): int
    {
        return 2;
    }

}
