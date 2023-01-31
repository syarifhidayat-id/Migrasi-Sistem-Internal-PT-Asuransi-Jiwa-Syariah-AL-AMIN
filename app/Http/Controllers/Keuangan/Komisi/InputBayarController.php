<?php

namespace App\Http\Controllers\Keuangan\Komisi;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\Lib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class InputBayarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $month = array(1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
        return view('pages.keuangan.komisi-overreding.input-bayar.index', [
            'month' => $month,
            'year' => date('2007'),
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function lodInputBayar(Request $request)
    {
        $tambah = "";
        $tambah.="and tpprd_mlok_kode='".$request['e_cab']."' ";

        if ($request['c_periode']=='1') {
            $tambah.="and month(date(tkomh_sts2_date)) between '".$request['e_bln1']."' and '".$request['bln2']."' and year(date(tkomh_sts2_date))='".$request['e_thn']."'";
        }

        if ($request['c_pmgpolis']=='1') {
            $tambah.="and mpol_mrkn_kode='".$request['e_pmgpolis']."' ";
        }

        if (!empty($request['e_baris'])) {
            $jumbar = $request['e_baris'];
        } else {
            $jumbar = 10;
        }

        $cmd = DB::select("
        SELECT
            REPLACE(tkomd_tkomh_pk,'K','') id,
            mpol_kode kdpolis,
            mpol_mrkn_nama nama,
            COUNT(tkomd_pk) tpst,
            IFNULL(SUM(tkomd_up),0) tup,
            IFNULL(SUM(tpprd_premi_bayar),0) ttagih,
            IFNULL(SUM(tkomd_komisi),0) tkomisi,
            IFNULL(SUM(tkomd_tax),0) ttax,
            IFNULL(SUM(tovd_over),0) toverreding,
            IFNULL(SUM(tovd_tax),0) ttax_overr,
            CONCAT(mjns_keterangan,'/ ',mjm_nama) ket,
            (IFNULL(SUM(tkomd_komisi),0)-IFNULL(SUM(tkomd_tax),0))+(IFNULL(SUM(tovd_over),0)-IFNULL(SUM(tovd_tax),0)) tagihan,
            mlok_nama cabang
        FROM etrs.trs_komisi_hdr, etrs.trs_komisi_dtl
        LEFT JOIN epstfix.peserta_all ON tpprd_pk=tkomd_tpprd_pk AND tpprd_up=tkomd_up
        LEFT JOIN emst.mst_lokasi ON mlok_kode=tpprd_mlok_kode
        LEFT JOIN eopr.mst_polis ON mpol_kode=tpprd_nomor_polish
        LEFT JOIN emst.mst_jenis_nasabah ON mjns_kode=mpol_mjns_kode
        LEFT JOIN emst.mst_jaminan ON mjm_kode=mpol_mjm_kode
        LEFT JOIN etrs.trs_over_dtl ON REPLACE(tkomd_tkomh_pk,'K','')=REPLACE(tovd_tovh_pk,'O','')  AND tovd_tpprd_pk=tpprd_pk
        WHERE tkomd_tkomh_pk=tkomh_pk and tkomh_sts1=1 AND tkomh_sts2=1
        ".$tambah."
        GROUP BY mpol_kode
        ORDER BY mpol_mrkn_nama ASC
        LIMIT ".$jumbar."");
        $res = Lib::__dbAll($cmd);

        return DataTables::of($res)->addIndexColumn()->make(true);
        // return Lib::json($res);
    }

    public function lod_byr_pjkomisi(Request $request)
    {
        $tambah = "";

        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;

        if (empty($request['vtgl'])) {
            return "{}";
        }

        if (strval($request['vlain'])<=0) {
            return "{}";
        }

        if(!empty($request['polis'])) {
            $tambah.="and tkomh_pk='".$request['polis']."K' ";
        }

        if(!empty($request['vlain'])) {
            $tbayar=$request['vlain'];
        } else {
            $tbayar = 0;
        }

        if(!empty($request['vtgl'])) {
            $tglbayar=$request['vtgl'];
        } else {
            $tglbayar = Lib::now();
        }

        $sql = Lib::__dbRow(Lib::__select("
        SELECT count(*) AS jumrow FROM etrs.trs_komisi_hdr,etrs.trs_komisi_dtl
        LEFT JOIN etrs.trs_over_dtl ON tovd_tpprd_pk=tkomd_tpprd_pk
        WHERE tkomh_pk=tkomd_tkomh_pk ".$tambah." "));
        $jumrow= $sql['jumrow'];

        $cmd = Lib::__select("
        SELECT *,
            IF(bayar<0,0, IF(".$jumrow."<=1,jumBayar,bayar) ) terbayar,
            IF( sisapaid >=0,1,IF( bayar < 0,'0', IF( sisapaid <-1000, 2, '1'))) stsbyr
        FROM (
        SELECT
            a.noid noid,
            a.tpprd_pk,
            tpprd_nomor_peserta nopst,
            ".$tbayar." jumBayar,
            a.tagihan tagihan,
            SUM(b.tagihan) AS jumPengurang,
            (".$tbayar."-SUM(b.tagihan)) AS sisapaid,
            IF((".$tbayar."-SUM(b.tagihan)) <= -100,(a.tagihan + (".$tbayar."-SUM(b.tagihan)) ) ,
            IF((a.brs)=".$jumrow." ,(a.tagihan+(".$tbayar."-SUM(b.tagihan))),a.tagihan)) AS bayar,
            DATE_FORMAT('".$tglbayar."', '%d-%m-%Y') tgl_bayar,
            a.id,
            a.nama,
            a.up,
            a.komisi,
            a.taxkomisi,
            round(a.komisinett,2) komisinett,
            a.ovr,
            a.taxovr,
            round(a.ovrnett,2) ovrnett,
            a.ck

        FROM ( SELECT
            tkomd_pk noid,
            (@rownum:= IFNULL(@rownum,0)+1) brs,
            tkomd_tpprd_pk tpprd_pk,
            tpprd_nomor_peserta nopst,
            REPLACE(tkomd_tkomh_pk,'K','') id,
            tpprd_nama nama,
            tkomd_up up,
            IFNULL(tkomd_komisi,0) komisi,
            IFNULL(tkomd_tax,0) taxkomisi,
            IFNULL(tkomd_komisi-tkomd_tax,0) komisinett,
            IFNULL(tovd_over,0) ovr,
            IFNULL(tovd_tax,0) taxovr,
            IFNULL(tovd_over-tovd_tax,0) ovrnett,
            IFNULL((tkomd_komisi-tkomd_tax),0)+IFNULL((tovd_over-tovd_tax),0) tagihan,
            IF(IFNULL(tkomd_pk,'')='','0','1') ck
        FROM etrs.trs_komisi_hdr a,etrs.trs_komisi_dtl
        LEFT JOIN etrs.trs_over_dtl ON tovd_tpprd_pk=tkomd_tpprd_pk AND REPLACE(tkomd_tkomh_pk,'K','')=REPLACE(tovd_tovh_pk,'O','')
        LEFT JOIN epstfix.peserta_all ON tpprd_pk=tkomd_tpprd_pk
        WHERE tkomh_pk=tkomd_tkomh_pk ".$tambah."
        ORDER BY 1
        LIMIT 100000) AS a

        INNER JOIN (
        SELECT
            tkomd_pk noid,
            '' brs,
            tkomd_tpprd_pk tpprd_pk,
            tpprd_nomor_peserta,
            REPLACE(tkomd_tkomh_pk,'K','') id,
            tpprd_nama nama,
            tkomd_up up,
            IFNULL(tkomd_komisi,0) komisi,
            IFNULL(tkomd_tax,0) taxkomisi,
            IFNULL(tkomd_komisi-tkomd_tax,0) komisinett,
            IFNULL(tovd_over,0) ovr,
            IFNULL(tovd_tax,0) taxovr,
            IFNULL(tovd_over-tovd_tax,0) ovrnett,
            IFNULL((tkomd_komisi-tkomd_tax),0)+IFNULL((tovd_over-tovd_tax),0) tagihan,
            IF(IFNULL(tkomd_pk,'')='','0','1') ck
        FROM etrs.trs_komisi_hdr a,etrs.trs_komisi_dtl
        LEFT JOIN etrs.trs_over_dtl ON tovd_tpprd_pk=tkomd_tpprd_pk AND REPLACE(tkomd_tkomh_pk,'K','')=REPLACE(tovd_tovh_pk,'O','')
        LEFT JOIN epstfix.peserta_all ON tpprd_pk=tkomd_tpprd_pk
        WHERE tkomh_pk=tkomd_tkomh_pk ".$tambah."
        ) AS b ON a.noid >= b.noid
        GROUP BY a.noid
        LIMIT 100000
        ) AS tmaster
        GROUP BY 1
        LIMIT 100000000");
        $res = Lib::__dbAll($cmd);

        return DataTables::of($res)->addIndexColumn()->make(true);
        // return $res;
    }
}
