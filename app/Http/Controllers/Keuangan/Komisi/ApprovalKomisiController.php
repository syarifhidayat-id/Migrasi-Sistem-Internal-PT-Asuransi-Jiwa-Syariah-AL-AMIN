<?php

namespace App\Http\Controllers\Keuangan\Komisi;

use App\Http\Controllers\Controller;
use App\Models\Keuangan\Komisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class ApprovalKomisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $caricabang = DB::table('emst.mst_lokasi')
        ->select('mlok_kode','mlok_nama')
        ->where([
            ['mlok_kode','<>','']
        ])->get();

        $caribank = DB::table('eacc.mst_giro')
        ->select(DB::raw("CONCAT(mgro_bank,' ',UPPER(mgro_bank_cabang),' (',mgro_rekening_fix,')') nama,
        mgro_pk kode"))
        ->where('mgro_pk','B012')
        ->get();

        $carikar =  DB::table('esdm.sdm_karyawan_new')
        ->select(DB::raw("skar_pk kode, upper(skar_nama) nama"))
        ->where('skar_mlok_kode','!=','01')
        ->whereNotIn('skar_status_kary', [3,2,1])
        ->get();

        return view('pages.keuangan.komisi.index', [
            'cabang' => $caricabang,
            'bankgiro' => $caribank,
            'karyawan' => $carikar
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validasi = Validator::make($request->all(), [
            'tkomh_penerima' => 'required',
            'x_giro' => 'required',
            'x_status' => 'required',
        ],
        [
            'tkomh_penerima.required'=>'Penerima Komisi tidak boleh kosong!',
            'x_giro.required'=>'Rekening Pembayaran tidak boleh kosong!',
            'x_status.required'=>'Status Approval tidak boleh kosong!',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'error' => $validasi->errors()
            ]);
        } else {
        if (Auth::user()->jabatan=='KBGKEU' || Auth::user()->jabatan=='KBGIT'){
        $vtable = DB::table('etrs.trs_komisi_hdr')->where('tkomh_pk', $request->tkomh_pk.'K')->where('tkomh_sts1','<',1);
        $data['tkomh_penerima'] = $request->tkomh_penerima;
        $data['tkomh_mgro_pk'] = $request->x_giro;
        $data['tkomh_sts1'] = $request->x_status;
        $data['tkomh_sts1_date'] = date('Y-m-d H:i:s');
        $data['tkomh_sts1_user'] = Auth::user()->email;
        $vtable->update($data);

        if($request->tkomh_penerima_o!=''){
            $vtable_o = DB::table('etrs.trs_over_hdr')->where('tovh_pk', $request->tkomh_pk.'O')->where('tovh_sts1','<',1);
            $data_o['tovh_penerima'] = $request->tkomh_penerima_o;
            $data_o['tovh_mgro_pk'] = $request->x_giro;
            $data_o['tovh_sts1'] = $request->x_status;
            $data_o['tovh_sts1_date'] = date('Y-m-d H:i:s');
            $data_o['tovh_sts1_user'] = Auth::user()->email;
            $vtable_o->update($data_o);
        }

        return response()->json([
            'success' => 'Data berhasil di Update dengan Kode '.$request->tkomh_pk.' !'
        ]);
        }
        if (Auth::user()->jabatan=='KDVKEU' || Auth::user()->jabatan=='KBGIT'){
            $vtablekdv = DB::table('etrs.trs_komisi_hdr')->where('tkomh_pk', $request->tkomh_pk.'K')->where('tkomh_sts2','!=',$request->x_status);
            $datakdv['tkomh_sts2_date'] = date('Y-m-d H:i:s');
            $datakdv['tkomh_sts2_user'] = Auth::user()->email;
            $datakdv['tkomh_sts2'] = $request->x_status;
            $vtablekdv->update($datakdv);

            if($request->tkomh_penerima_o!='')
            {
                $vtablekdv_o = DB::table('etrs.trs_over_hdr')->where('tovh_pk', $tkomh_pk.'O');
                $datakdv_o['tovh_sts2'] = $request->x_status;
                $datakdv_o['tovh_sts2_date'] = date('Y-m-d H:i:s');
                $datakdv_o['tovh_sts2_user'] = Auth::user()->email;
                $vtablekdv_o->update($datakdv_o);
            }
            return response()->json([
                'success' => 'Data berhasil di Update dengan Kode '.$request->tkomh_pk.' !'
            ]);
        }
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Komisi  $komisi
     * @return \Illuminate\Http\Response
     */
    public function show(Komisi $komisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Komisi  $komisi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tkom_header = DB::table('etrs.trs_komisi_hdr')
        ->select(DB::raw("REPLACE(tkomh_pk,'K','') tkomh_pk, tkomh_mgro_pk x_giro, tkomh_penerima, tovh_penerima tkomh_penerima_o"))
        ->leftJoin('etrs.trs_over_hdr', DB::raw("REPLACE(tovh_pk,'O','')"), '=', DB::raw("REPLACE(tkomh_pk,'K','')"))
        ->where('tkomh_pk', $id.'K')
        ->first();
        return response()->json($tkom_header);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Komisi  $komisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Komisi $komisi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Komisi  $komisi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DB::table('etrs.trs_komisi_hdr')->where('tkomh_pk',$id.'K');
        $data->delete();

        return response()->json([
            'success' => 'Data berhasil dihapus dengan Kode '.$id.'!'
        ]);
    }

    public function listKomisi(Request $request)
    {
        //  if ($request->ajax()) {
            $vtable = DB::table('etrs.trs_komisi_hdr')
                ->select(DB::raw("REPLACE(tkomd_tkomh_pk,'K','') id,
                mpol_kode kdpolis,
	            mpol_mrkn_nama nama,
                COUNT(tkomd_pk) tpst,
                FORMAT(IFNULL(SUM(tkomd_up),0),2) tup,
                FORMAT(IFNULL(SUM(tpprd_premi_bayar),0),2) ttagih,
                FORMAT(IFNULL(SUM(tkomd_komisi),0),2) tkomisi,
                FORMAT(IFNULL(SUM(tkomd_tax),0),2) ttax,
                FORMAT(IFNULL(SUM(`tovd_over`),0),2) toverreding,
                FORMAT(IFNULL(SUM(`tovd_tax`),0),2) ttax_overr,
                CONCAT(mjns_keterangan,'/ ',mjm_nama) ket,
                tkomh_crud,
                tpprd_insert_fix,
                mlok_nama cabang,tkomh_sts1_user,tkomh_sts2_user,tkomh_sts3_user,
                FORMAT(IFNULL(SUM(tkomd_komisi),0) - IFNULL(SUM(tkomd_tax),0),2) as tkomisinetto,
                FORMAT(IFNULL(SUM(`tovd_over`),0) - IFNULL(SUM(`tovd_tax`),0),2) as toverreding_netto"))
                ->leftJoin('etrs.trs_komisi_dtl', 'tkomh_pk', '=', 'tkomd_tkomh_pk')
                ->leftJoin('epstfix.peserta_all', 'tpprd_pk', '=', 'tkomd_tpprd_pk')
                ->leftJoin('emst.mst_lokasi', 'mlok_kode', '=', 'tpprd_mlok_kode')
                // ->leftJoin('eopr.mst_polis', function($join) use ($request) {
                //     $join->on('mpol_kode', '=', 'tpprd_nomor_polish');
                //     $join->groupBy('mpol_kode')->orderBy('mpol_mrkn_nama', 'ASC');
                // })
                ->leftJoin('eopr.mst_polis', 'mpol_kode', '=', 'tpprd_nomor_polish')
                ->leftJoin('emst.mst_jenis_nasabah', 'mjns_kode', '=', 'mpol_mjns_kode')
                ->leftJoin('emst.mst_jaminan', 'mjm_kode', '=', 'mpol_mjm_kode')
                ->leftJoin('etrs.trs_over_dtl', DB::raw("REPLACE('tkomd_tkomh_pk','K','')"), '=', DB::raw("REPLACE('tovd_tovh_pk','O','')"))
                // ->where('mpol_kode', '!=', '')
                ;

             //    $vtable->whereRaw("month(date(tkomh_crud)) BETWEEN 01 and 01 and year(date(tkomh_crud))='2021'");
                //$vtable->whereRaw("year(date(tkomh_crud))='".$request->get('tahun')."'");

               /* if ($request->get('check_1') == "1") {
                    if (!empty($request->get('cabang'))) {
                        $vtable->whereRaw("mlok_nama = '".$request->get('cabang')."'");
                   }
                }*/


                if (!empty($request->get('bulan1')) && !empty($request->get('bulan2')) && !empty($request->get('tahun'))) {
                    $vtable->whereRaw("month(date(tkomh_crud)) BETWEEN '".$request->get('bulan1')."' and '".$request->get('bulan2')."' and year(date(tkomh_crud))='".$request->get('tahun')."'");
               }


                $data = $vtable->orderBy('mpol_mrkn_nama', 'ASC')->groupBy('mpol_kode')->get();

            return DataTables::of($data)->addIndexColumn()->make(true);
        //   }
    }
    public function export($id,$mpol) {

        $komisi = DB::select("SELECT
        tpprd_pk PK,
        tpprd_nomor_peserta `NO_PESERTA`,
        tpprd_nomor_polish `KODE_POLIS`,
        mpol_mrkn_nama `PEMEGANG_POLIS`,
        cb.mrkn_nama `CAB_PEMEGANG_POLIS`,
        mlok_nama `CABANG_AL_AMIN`,
        mjns_keterangan `JNS_NASABAH`,
        mjm_nama JAMINAN,
        tpprd_nama NAMA,
        tpprd_tanggal_lahir `TGL_LAHIR`,
        tpprd_umur UMUR,
        tpprd_tanggal_awal `TGL_AWAL`,
        tpprd_tanggal_akhir `TGL_AKHIR`,
        tpprd_masa_bulan `TENOR`,
        tpprd_up UP,
        tpprd_premi `KONTRIBUSI_GROSS`,
        tpprd_premi_co `KONTRIBUSI_CO`,
        tpprd_discpolis `FEEBASE_POTONG`,
        tpprd_premi_bayar `KONTRIBUSI_TAGIH`,
        tpprd_admin `FEEBASE_TDK_POTONG`,
        tpprd_total_bayar_dtl `KONTRIBUSI_BAYAR`,
        IFNULL(pic1.mtx_nama,'') `PIC_PAJAK_KOMISI`,
        IFNULL(tkomd_komisi_persen,0) `KOMISI_PERSEN`,
        IFNULL(tkomd_komisi,0) KOMISI,
        IFNULL(tkomd_tax_persen,0) `TAX_KOMISI_PERSEN`,
        IFNULL(tkomd_tax,0) `TAX_KOMISI`,
        IFNULL(tkomd_komisi-tkomd_tax,0) `KOMISI_NETT`,
        IFNULL(pic2.mtx_nama,'') `PIC_PAJAK_OVERRIDING`,
        IFNULL(tovd_over_persen,0) `OVERRIDING_PERSEN`,
        IFNULL(tovd_over,0) `OVERRIDING`,
        IFNULL(tovd_tax_persen,0) `TAX_OVERRIDING_PERSEN`,
        IFNULL(tovd_tax,0) `TAX_OVERRIDING`,
        IFNULL(tovd_over-tovd_tax,0) `OVERRIDING_NETT`
    FROM etrs.`trs_komisi_hdr`, etrs.`trs_komisi_dtl`
    LEFT JOIN emst.`mst_tax` pic1 ON pic1.mtx_kode=tkomd_tax_user
    LEFT JOIN epstfix.`peserta_all` ON tpprd_pk=tkomd_tpprd_pk
    LEFT JOIN etrs.`trs_over_dtl` ON REPLACE(tkomd_tkomh_pk,'K','')=REPLACE(`tovd_tovh_pk`,'O','') AND tovd_tpprd_pk=tpprd_pk
    LEFT JOIN eopr.mst_polis ON mpol_kode=tpprd_nomor_polish
    LEFT JOIN emst.`mst_jenis_nasabah` ON mpol_mjns_kode=mjns_kode
    LEFT JOIN emst.`mst_jaminan` ON mjm_kode=mpol_mjm_kode
    LEFT JOIN emst.`mst_manfaat_plafond` ON mft_kode=mpol_mft_kode
    LEFT JOIN emst.mst_lokasi ON tpprd_mlok_kode=mlok_kode
    LEFT JOIN emst.mst_tax pic2 ON pic2.mtx_kode=tovd_pic,
    emst.mst_rekanan cb
    LEFT JOIN emst.mst_rekanan ps ON  IF(IFNULL(cb.mrkn_mrkn_kode_induk,'')='' OR cb.mrkn_mrkn_kode_induk='-' ,cb.mrkn_kode,cb.mrkn_mrkn_kode_induk) =ps.mrkn_kode
    WHERE tkomd_tkomh_pk=tkomh_pk AND tpprd_mrkn_kode=cb.mrkn_kode  AND tkomh_pk = '".$id."K'
    AND mpol_kode= '".$mpol."'
    GROUP BY tkomd_pk
    LIMIT 10000000");

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet(0);

        $sheet->setCellValue('A1', 'DETAIL PESERTA KOMISI & OVERREDING');
        $sheet->setCellValue('A3', 'NO');
        $sheet->setCellValue('B3', 'PK');
        $sheet->setCellValue('C3', 'NO PESERTA');
        $sheet->setCellValue('D3', 'KODE POLIS');
        $sheet->setCellValue('E3', 'PEMEGANG POLIS');
        $sheet->setCellValue('F3', 'CAB. PEMEGANG POLIS');
        $sheet->setCellValue('G3', 'CABANG AL AMIN');
        $sheet->setCellValue('H3', 'JNS NASABAH');
        $sheet->setCellValue('I3', 'JAMINAN');
        $sheet->setCellValue('J3', 'NAMA');
        $sheet->setCellValue('K3', 'TGL LAHIR');
        $sheet->setCellValue('L3', 'UMUR');
        $sheet->setCellValue('M3', 'TGL AWAL');
        $sheet->setCellValue('N3', 'TGL AKHIR');
        $sheet->setCellValue('O3', 'TENOR');
        $sheet->setCellValue('P3', 'UP');
        $sheet->setCellValue('Q3', 'KONTRIBUSI GROSS');
        $sheet->setCellValue('R3', 'KONTRIBUSI CO');
        $sheet->setCellValue('S3', 'FEEBASE POTONG');
        $sheet->setCellValue('T3', 'KONTRIBUSI TAGIH');
        $sheet->setCellValue('U3', 'FEEBASE TDK POTONG');
        $sheet->setCellValue('V3', 'KONTRIBUSI BAYAR');
        $sheet->setCellValue('W3', 'PIC PAJAK KOMISI');
        $sheet->setCellValue('X3', 'KOMISI(%)');
        $sheet->setCellValue('Y3', 'KOMISI');
        $sheet->setCellValue('Z3', 'TAX KOMISI(%)');
        $sheet->setCellValue('AA3', 'TAX KOMISI');
        $sheet->setCellValue('AB3', 'KOMISI NETT');
        $sheet->setCellValue('AC3', 'PIC PAJAK OVERRIDING');
        $sheet->setCellValue('AD3', 'OVERRIDING(%)');
        $sheet->setCellValue('AE3', 'OVERRIDING');
        $sheet->setCellValue('AF3', 'TAX OVERRIDING(%)');
        $sheet->setCellValue('AG3', 'TAX OVERRIDING');
        $sheet->setCellValue('AH3', 'OVERRIDING NETT');

        $i=0;
        foreach($komisi as $data){
        $sheet = $spreadsheet->getActiveSheet(0);
        $sheet->setCellValue('A'.(4+$i),($i+1));
        $sheet->setCellValue('B'.(4+$i), "'".$data->PK);
        $sheet->setCellValue('C'.(4+$i), "'".$data->NO_PESERTA);
        $sheet->setCellValue('D'.(4+$i), "'".$data->KODE_POLIS);
        $sheet->setCellValue('E'.(4+$i), $data->PEMEGANG_POLIS);
        $sheet->setCellValue('F'.(4+$i), $data->CAB_PEMEGANG_POLIS);
        $sheet->setCellValue('G'.(4+$i), $data->CABANG_AL_AMIN);
        $sheet->setCellValue('H'.(4+$i), $data->JNS_NASABAH);
        $sheet->setCellValue('I'.(4+$i), $data->JAMINAN);
        $sheet->setCellValue('J'.(4+$i), $data->NAMA);
        $sheet->setCellValue('K'.(4+$i), $data->TGL_LAHIR);
        $sheet->setCellValue('L'.(4+$i), $data->UMUR);
        $sheet->setCellValue('M'.(4+$i), $data->TGL_AWAL);
        $sheet->setCellValue('N'.(4+$i), $data->TGL_AKHIR);
        $sheet->setCellValue('O'.(4+$i), $data->TENOR);
        $sheet->setCellValue('P'.(4+$i), $data->UP);
        $sheet->setCellValue('Q'.(4+$i), $data->KONTRIBUSI_GROSS);
        $sheet->setCellValue('R'.(4+$i), $data->KONTRIBUSI_CO);
        $sheet->setCellValue('S'.(4+$i), $data->FEEBASE_POTONG);
        $sheet->setCellValue('T'.(4+$i), $data->KONTRIBUSI_TAGIH);
        $sheet->setCellValue('U'.(4+$i), $data->FEEBASE_TDK_POTONG);
        $sheet->setCellValue('V'.(4+$i), $data->KONTRIBUSI_BAYAR);
        $sheet->setCellValue('W'.(4+$i), $data->PIC_PAJAK_KOMISI);
        $sheet->setCellValue('X'.(4+$i), $data->KOMISI_PERSEN);
        $sheet->setCellValue('Y'.(4+$i), $data->KOMISI);
        $sheet->setCellValue('Z'.(4+$i), $data->TAX_KOMISI_PERSEN);
        $sheet->setCellValue('AA'.(4+$i), $data->TAX_KOMISI);
        $sheet->setCellValue('AB'.(4+$i), $data->KOMISI_NETT);
        $sheet->setCellValue('AC'.(4+$i), $data->PIC_PAJAK_OVERRIDING);
        $sheet->setCellValue('AD'.(4+$i), $data->OVERRIDING_PERSEN);
        $sheet->setCellValue('AE'.(4+$i), $data->OVERRIDING);
        $sheet->setCellValue('AF'.(4+$i), $data->TAX_OVERRIDING_PERSEN);
        $sheet->setCellValue('AG'.(4+$i), $data->TAX_OVERRIDING);
        $sheet->setCellValue('AH'.(4+$i), $data->OVERRIDING_NETT);

         // # CETAK FORMAT NUMERIC

         $sheet->getStyle('P'.(4+$i))
         ->getNumberFormat()
         ->setFormatCode('#,##0.00');

         $sheet->getStyle('Q'.(4+$i))
         ->getNumberFormat()
         ->setFormatCode('#,##0.00');

         $sheet->getStyle('R'.(4+$i))
         ->getNumberFormat()
         ->setFormatCode('#,##0.00');

         $sheet->getStyle('S'.(4+$i))
         ->getNumberFormat()
         ->setFormatCode('#,##0.00');

         $sheet->getStyle('T'.(4+$i))
         ->getNumberFormat()
         ->setFormatCode('#,##0.00');

         $sheet->getStyle('U'.(4+$i))
         ->getNumberFormat()
         ->setFormatCode('#,##0.00');

         $sheet->getStyle('V'.(4+$i))
         ->getNumberFormat()
         ->setFormatCode('#,##0.00');

         $sheet->getStyle('X'.(4+$i))
         ->getNumberFormat()
         ->setFormatCode('#,##0.00');

         $sheet->getStyle('Y'.(4+$i))
         ->getNumberFormat()
         ->setFormatCode('#,##0.00');

         $sheet->getStyle('Z'.(4+$i))
         ->getNumberFormat()
         ->setFormatCode('#,##0.00');

         $sheet->getStyle('AA'.(4+$i))
         ->getNumberFormat()
         ->setFormatCode('#,##0.00');

         $sheet->getStyle('AB'.(4+$i))
         ->getNumberFormat()
         ->setFormatCode('#,##0.00');

         $sheet->getStyle('AD'.(4+$i))
         ->getNumberFormat()
         ->setFormatCode('#,##0.00');

         $sheet->getStyle('AE'.(4+$i))
         ->getNumberFormat()
         ->setFormatCode('#,##0.00');

         $sheet->getStyle('AF'.(4+$i))
         ->getNumberFormat()
         ->setFormatCode('#,##0.00');

         $sheet->getStyle('AG'.(4+$i))
         ->getNumberFormat()
         ->setFormatCode('#,##0.00');

         $sheet->getStyle('AH'.(4+$i))
         ->getNumberFormat()
         ->setFormatCode('#,##0.00');

        $i++;
        }


        // # CETAK WARNA

        $sheet->getStyle('A3:AH3')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('BDBDBD');

        $fileName = "DETAIL PESERTA KOMISI & OVERREDING.".$id;
        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$fileName.'.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
