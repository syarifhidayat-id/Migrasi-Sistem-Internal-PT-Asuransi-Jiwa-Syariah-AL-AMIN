<?php

namespace App\Http\Controllers\Keuangan\Kas;

use App\Http\Controllers\Controller;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class BukuBesarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.keuangan.kas.buku-besar.index');
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

    public function kantor_cabang(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;

        $vtable = DB::table('emst.mst_lokasi')
            ->select('mlok_kode', 'mlok_nama');

        if (!empty($request->q)) {
            $vtable->where('mlok_nama', 'LIKE', "%$request->q%");
        }

        $data = $vtable
            ->groupBy('mlok_nama')
            ->orderBy('mlok_kode')
            ->offset($offset)
            ->limit($rows)
            ->get();

        return response()->json($data);
    }


    public function lod_bukber(Request $request)
    {


        if ($request->get('c_tipe') == "1") {
            if (!empty($request['e_jns'])) {
                "e_jns = '" . $request['e_jns'] . "'";
            }
        }
        $cmd = DB::select("CALL epms.P_REPORT_KAS_PUS('" . $request['e_akun'] . "','" . $request['e_cabalamin'] . "','" . $request['e_entry1'] . "','" . $request['e_entry2'] . "','" . $request['e_tag'] . "','" . $request['e_jns'] . "')");
        // $cmd = DB::select("CALL epms.P_REPORT_KAS_PUS('150-540-0101001','01','2022-01-24','2022-01-31','','0');");

        $data = __dbAll($cmd);
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function lod_akunkascab(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;

        $cmd = DB::select("SELECT `asakn_kode` akun,`asakn_keterangan` nama FROM eacc.`ams_sub_akun` 
        WHERE `asakn_mlok_kode`='" . $request['mlok'] . "' AND `asakn_mrpt_kode`='NEROPR' AND `asakn_aakn_kode`='540' AND RIGHT(asakn_kode,1)='1';");

        $res = __dbAll($cmd);
        return __json($res);
    }

    public function getjurnalkasfull(Request $request)
    {

        $tambah = "";
        if (isset($request['kode'])) {
            if ($request['kode'] != "") {
                $tambah .= " AND atjh_pk='" . $request['kode'] . "'";
            }
        }

        //$jabatan=__getGlobalValue("jabatan");

        $cmd = DB::select(" 
		SELECT 
		  atjh_pk,  atjh_mlok_pk,  
		  DATE_FORMAT(atjh_tanggal,'%d-%m-%Y') atjh_tanggal,
		  atjh_periode_bulan,
		  atjh_periode_tahun,  atjh_nomor,  atjh_tanggal_bukti,  atjh_amjb_kode,
		  atjh_amjb_mlok_kode,  atjh_nomor_bukti,  atjh_keterangan,  atjh_total_debit,
		  atjh_total_kredit,  atjh_status_posting,  atjh_insert_user,  atjh_update_user,  atjh_insert_date,  atjh_update_date,
		  atjh_TS,  atjh_rpt,  atjh_manual,  atjh_final_acc,
		  atjd_pk,  atjd_atjh_pk,  atjd_askn_kode,  atjd_keterangan,  atjd_tipe_dk,  atjd_total 
		FROM ejur.atr_jurnal_hdr_all, ejur.atr_jurnal_dtl_all
		WHERE atjd_atjh_pk = atjh_pk
		AND 1=1 $tambah
		ORDER BY atjd_tipe_dk
		 ");

        $data = __dbAll($cmd);
        // return DataTables::of($data)->addIndexColumn()->make(true);
        return response()->json($data[0]);
       
    }

    public function i_jurkas(Request $request)
    {
        $order=" ORDER BY atjd_tipe_dk ";
        $tambah = "";
        $vtable = "  ejur.`atr_jurnal_dtl_all`
		   LEFT JOIN eacc.ams_sub_akun ON asakn_kode=atjd_askn_kode  ";     // table database
        $vidxkey = "atjd_pk";                              // field kode validasi
        $vfldname = "atjd_keterangan";                     // field nama validasi

        $vfield = "atr_jurnal_dtl_all.*,asakn_keterangan, FORMAT(atjd_total,2) atjd_totalx   ";    // query field 

        if (isset($request['pk_h'])) {
            $tambah .= $tambah . " and atjd_atjh_pk='" . $request['pk_h'] . "'";
        }
        $cmd = DB::select(" 
	SELECT
	$vfield 
	FROM $vtable
	where $vidxkey<>'' 
	$tambah 
	$order
	 ");

     $data = __dbAll($cmd);

    //  return response()->json($data);

    return DataTables::of($data)->addIndexColumn()->make(true);

    }
}
