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
        $order = " ORDER BY atjd_tipe_dk DESC";
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

    public function get_kasdetil(Request $request)
    {
        if (isset($request['tipe'])) {
            if ($request['tipe'] == "D") {
                $cmd = DB::select("
					SELECT t1.tdna_dk,
					IF(t1.tdna_dk='K',IF(kas_1<>1,akun_1,IF(kas_2<>1,akun_2,'')) ,IF(kas_1=1,akun_1,IF(kas_2=1,akun_2,''))) a_1,
					IF(t1.tdna_dk='K',IF(kas_1=1,akun_1,IF(kas_2=1,akun_2,'')) ,IF(kas_1<>1,akun_1,IF(kas_2<>1,akun_2,''))) a_2,

					IF(t1.tdna_dk='K',IF(kas_1<>1,ket_1,IF(kas_2<>1,ket_2,'')) ,IF(kas_1=1,ket_1,IF(kas_2=1,ket_2,''))) ket_1,
					IF(t1.tdna_dk='K',IF(kas_1=1,namakun_1,IF(kas_2=1,ket_2,'')) ,IF(kas_1<>1,ket_1,IF(kas_2<>1,namakun_2,''))) ket_2,

					IF(t1.tdna_dk='K',IF(kas_1<>1,tot_1,IF(kas_2<>1,tot_2,0)),'') d_1,
					IF(t1.tdna_dk='K','','') d_2,

					IF(t1.tdna_dk='K','','') k_1,
					IF(t1.tdna_dk='D','',IF(kas_1<>1,tot_1,IF(kas_2<>1,tot_2,0))) k_2,

					IF(t1.tdna_dk='K',IF(kas_1<>1,namakun_1,IF(kas_2<>1,namakun_2,'')) ,IF(kas_1=1,namakun_1,IF(kas_2=1,namakun_2,''))) namakun_1,
					IF(t1.tdna_dk='K',IF(kas_1=1,namakun_1,IF(kas_2=1,namakun_2,'')) ,IF(kas_1<>1,namakun_1,IF(kas_2<>1,namakun_2,''))) namakun_2,

					IF(kas_1<>1,tot_1,IF(kas_2<>1,tot_2,0))  dt_1,
					IF(kas_1<>1,tot_1,IF(kas_2<>1,tot_2,0)) dt_2 
					 FROM (
					SELECT
					  COUNT(*) jml,
					  tkad_pk pk_1,
					  tkad_askn_kode akun_1,
					  tkad_keterangan ket_1,
					  tkad_tipe_dk dk_1,
					  tkad_total tot_1,
					   tkad_askn_kode=tdna_akun_d kas_1,
					   asakn_keterangan namakun_1,
					   tdna_dk
					FROM epms.trs_kas_dtl
					LEFT JOIN  epms.trs_dana_aju ON tkad_atjh_pk=tdna_pk
					LEFT JOIN eacc.ams_sub_akun_new ON asakn_kode=tkad_askn_kode
					WHERE tkad_pk='" . $request['kode'] . "'

					) t1
					,
					(
					SELECT
					  COUNT(*) jml,
					  tkad_pk pk_2,
					  tkad_askn_kode akun_2,
					  tkad_keterangan ket_2,
					  tkad_tipe_dk dk_2,
					  tkad_total tot_2,
					   tkad_askn_kode=tdna_akun_d kas_2,
					   asakn_keterangan namakun_2,
					 tdna_dk
					FROM epms.trs_kas_dtl
					LEFT JOIN  epms.trs_dana_aju ON tkad_atjh_pk=tdna_pk
					LEFT JOIN eacc.ams_sub_akun_new ON asakn_kode=tkad_askn_kode
					WHERE tkad_pk<>'" . $request['kode'] . "' AND tdna_dk=tkad_tipe_dk
					AND tkad_atjh_pk IN (SELECT tkad_atjh_pk  FROM epms.trs_kas_dtl WHERE tkad_pk='" . $request['kode'] . "'  )
					) t2
					;
					");
            }
        }
        //echo $cmd;
        // IF(t1.tdna_dk='K',IF(kas_1=1,namakun_1,IF(kas_2=1,namakun_2,'')) ,IF(kas_1<>1,namakun_1,IF(kas_2<>1,namakun_2,''))) ket_2,

        if (isset($request['tipe'])) {
            if ($request['tipe'] == "K") {
                $cmd = DB::select(" 
					SELECT t1.tdna_dk,
					IF(t1.tdna_dk='D',IF(kas_1=1,akun_1,IF(kas_2=1,akun_2,'')) ,IF(kas_1<>1,akun_1,IF(kas_2<>1,akun_2,''))) a_1,
					IF(t1.tdna_dk='D',IF(kas_1<>1,akun_1,IF(kas_2<>1,akun_2,'')) ,IF(kas_1=1,akun_1,IF(kas_2=1,akun_2,''))) a_2,

					IF(t1.tdna_dk='D',IF(kas_1=1,namakun_1,IF(kas_2=1,namakun_2,'')) ,IF(kas_1<>1,namakun_1,IF(kas_2<>1,namakun_2,''))) ket_1,
					IF(t1.tdna_dk='K',IF(kas_1=1,namakun_1,IF(kas_2=1,ket_2,'')) ,IF(kas_1<>1,ket_1,IF(kas_2<>1,namakun_2,''))) ket_2,

					IF(t1.tdna_dk='D',IF(kas_1<>1,tot_1,IF(kas_2<>1,tot_2,0)),'') d_1,
					IF(t1.tdna_dk='D','','') d_2,

					IF(t1.tdna_dk='D','','') k_1,
					IF(t1.tdna_dk='K','',IF(kas_1<>1,tot_1,IF(kas_2<>1,tot_2,0))) k_2,

					IF(t1.tdna_dk='D',IF(kas_1=1,namakun_1,IF(kas_2=1,namakun_2,'')) ,IF(kas_1<>1,namakun_1,IF(kas_2<>1,namakun_2,''))) namakun_1,
					IF(t1.tdna_dk='D',IF(kas_1<>1,namakun_1,IF(kas_2<>1,namakun_2,'')) ,IF(kas_1=1,namakun_1,IF(kas_2=1,namakun_2,''))) namakun_2,


					IF(kas_1<>1,tot_1,IF(kas_2<>1,tot_2,0))  dt_1,
					IF(kas_1<>1,tot_1,IF(kas_2<>1,tot_2,0)) dt_2 
					 FROM (
					SELECT
					  COUNT(*) jml,
					  tkad_pk pk_1,
					  tkad_askn_kode akun_1,
					  tkad_keterangan ket_1,
					  tkad_tipe_dk dk_1,
					  tkad_total tot_1,
					   tkad_askn_kode=tdna_akun_d kas_1,
						  asakn_keterangan namakun_1,
					   tdna_dk
					FROM epms.trs_kas_dtl
					LEFT JOIN  epms.trs_dana_aju ON tkad_atjh_pk=tdna_pk
					LEFT JOIN eacc.ams_sub_akun_new ON asakn_kode=tkad_askn_kode
					WHERE tkad_pk='" . $request['kode'] . "'
					) t1
					,
					(
					SELECT
					  COUNT(*) jml,
					  tkad_pk pk_2,
					  tkad_askn_kode akun_2,
					  tkad_keterangan ket_2,
					  tkad_tipe_dk dk_2,
					  tkad_total tot_2,
					   tkad_askn_kode=tdna_akun_d kas_2,
					   asakn_keterangan namakun_2,
					 tdna_dk
					FROM epms.trs_kas_dtl
					LEFT JOIN  epms.trs_dana_aju ON tkad_atjh_pk=tdna_pk
					LEFT JOIN eacc.ams_sub_akun_new ON asakn_kode=tkad_askn_kode
					WHERE tkad_pk<>'" . $request['kode'] . "' AND tdna_dk=tkad_tipe_dk
					AND tkad_atjh_pk IN (SELECT tkad_atjh_pk  FROM epms.trs_kas_dtl WHERE tkad_pk='" . $request['kode'] . "'  )
					) t2
					");
            }
        }
        $data = __dbAll($cmd);
        // return DataTables::of($data)->addIndexColumn()->make(true);
        return response()->json($data[0]);
    }


    public function jurnalkasfinal(Request $request)
    {

        $vtb1 = DB::table('ejur.atr_jurnal_hdr_all')->where('atjh_pk', $request['tkad_pk']);
        $vtb2 = DB::table('epms.trs_kas_dtl')->where('tkad_pk', $request['tkad_pk']);

        $data1 = $request->all();
        $data1 = request()->except(['_token', 'ket_1', 'd_1', 'k_1', 'a_1', 'namakun_1', 'ket_2', 'd_2', 'k_2', 'a_2', 'namakun_2', 'hdrpk', 'vinal', 'tdna_dk', 'mlok_kode', 'tkad_pk', 'serverSide_ff_length']);

        $data2 = $request->all();
        $data2 = request()->except(['_token', 'ket_1', 'd_1', 'k_1', 'a_1', 'namakun_1', 'ket_2', 'd_2', 'k_2', 'a_2', 'namakun_2', 'hdrpk', 'vinal', 'tdna_dk', 'mlok_kode', 'tkad_pk', 'serverSide_ff_length', 'atjh_amjb_kode', 'atjh_keterangan', 'atjh_nomor']);

        $data1['atjh_final_acc'] = '1';
        $data2['tkad_final'] = '2';

        $vtb1->update($data1);
        $vtb2->update($data2);

        return __json(['success' => 'berhasil di proses']);
    }

    public function lov_polis(Request $request)
    {
        if ("akuntrs" == substr($request->id, 0, 7)) {
            $tambah = "";

            $tambah .= " and (asakn_keterangan like '%" . $request['nama'] . "%' or asakn_kode like '" . $request['nama'] . "%') ";

            if ($request['xakun'] != "") {
                $tambah .= " and asakn_kode<>'" . $request['xakun'] . "'";
            }

            if ($request['xdk'] != "") {
                $tambah .= " and (LEFT(asakn_kode,3)='550' AND asakn_mrpt_kode='LABRUG' OR  (asakn_aakn_kode IN ('554','558'))  OR (asakn_aakn_kode='540' AND asakn_bnb='1' )  OR  (LEFT(asakn_kode,7) = '240-580') OR  (LEFT(asakn_kode,7) = '150-556') OR  (asakn_kode = '150-544-0601201') OR  (asakn_kode = '150-544-0601101'))  ";
            }

            $cmd = __select("SELECT asakn_kode kode, asakn_keterangan nama,asakn_mlok_kode lain FROM eacc.ams_sub_akun 
				WHERE 1=1 
				" . $tambah . " ");
            //echo $cmd;	

            $r = __dbAll($cmd);

            return DataTables::of($r)->addIndexColumn()->make(true);
        }
    }

    public function p_ubah_akunkas(Request $request)
    {
        $cmd = "";
        // $cms = "";
        // $cmdk = "";
        $vtable        = " epms.trs_kas_dtl ";
        $tkad_pk    = $request['tkad_pk'];
        $vpkhdr        = $request['vpkhdr'];
        $vakun        = $request['vakun'];
        $vdr        = __str2($request['vdr'], 'N');
        $vcr        = __str2($request['vcr'], 'N');
        $vket        = $request['vket'];
        $vdk_dtl    = $request['vdk_dtl'];
        $vinal        = $request['vinal'];

        $data = $request->except(
            'vakun',
            'vdr',
            'vcr',
            'vdk_dtl',
            'vinal',
            'vpkhdr',
            'vket',
        );

        if ($vdk_dtl == "D" && strval($vcr) <> 0)        //	P_REPORT_KASCAB tkad_Dr (bea++ )= rpdiBB_CR filled
        {
            $cms = __select("UPDATE epms.trs_kas_dtl	SET tkad_askn_kode = '" . $vakun . "', tkad_keterangan = '" . $vket . "', tkad_total = '" . $vcr . "' WHERE tkad_pk ='" . $tkad_pk . "' AND  tkad_atjh_pk='" . $vpkhdr . "'");
            // $ress =__dbRow($cms);

            // xD == K Rp changed
            $cmd = __select("UPDATE epms.trs_kas_dtl AS tbl 
            JOIN  (SELECT tkad_atjh_pk, SUM(tkad_total) rp FROM epms.trs_kas_dtl WHERE tkad_tipe_dk='D' AND  tkad_atjh_pk='" . $vpkhdr . "' GROUP BY tkad_atjh_pk) AS grp ON grp.tkad_atjh_pk = tbl.tkad_atjh_pk SET tbl.tkad_total = grp.rp WHERE tbl.tkad_atjh_pk ='" . $vpkhdr . "' AND tbl.tkad_tipe_dk='K'");

            // $res =__dbRow($cmd);

            // Vcr Rp
            $cmd = __select("
            UPDATE epms.trs_kas_vcr	SET tkav_total = (SELECT SUM(tkad_total) rp FROM epms.trs_kas_dtl WHERE tkad_tipe_dk='D' AND  tkad_atjh_pk='" . $vpkhdr . "')	WHERE  tkav_tdna_pk ='" . $vpkhdr . "'
            ");

            // $res =__dbRow($cmd);

            // TDNA Rp
            $cmdk = __select("
            UPDATE epms.trs_dana_aju	SET tdna_total = (SELECT SUM(tkad_total) rp FROM epms.trs_kas_dtl WHERE tkad_tipe_dk='D' AND  tkad_atjh_pk='" . $vpkhdr . "')	WHERE  tdna_pk ='" . $vpkhdr . "'
            ");

            // $resk =__dbRow($cmdk);

            // JUR Rp
            if ($vinal == "1") {
                // change akun selected
                $sql = __select("
                UPDATE ejur.atr_jurnal_dtl_all SET atjd_total='" . $vcr . "', atjd_askn_kode='" . $vakun . "', atjd_keterangan='" . $vket . "'	
				WHERE atjd_atjh_pk ='" . $tkad_pk . "'  AND atjd_tipe_dk='K'
                ");

                // $resq =__dbRow($sql);

                // change xD == K Rp
                $sqlx = __select("
            UPDATE ejur.atr_jurnal_dtl_all SET atjd_total='" . $vcr . "'
            WHERE atjd_atjh_pk ='" . $tkad_pk . "'  AND atjd_tipe_dk='D'
            ");

                // $resqx =__dbRow($sqlx);

                $sqlz = __select("
            UPDATE ejur.atr_jurnal_hdr_all SET atjh_total_debit='" . $vcr . "', atjh_total_kredit='" . $vcr . "' WHERE atjh_pk ='" . $tkad_pk . "'
            ");

                // $resqz =__dbRow($sqlz);
            }
        }

        if ($vdk_dtl == "K" && strval($vdr) <> 0) //	P_REPORT_KASCAB tkad_Kr (kas++) = rpdiBB_DR filled
        {
            $cms = __select("
            UPDATE epms.trs_kas_dtl	SET tkad_askn_kode = '" . $vakun . "', tkad_keterangan = '" . $vket . "', tkad_total = '" . $vdr . "' WHERE tkad_pk ='" . $tkad_pk . "' AND  tkad_atjh_pk='" . $vpkhdr . "'
            ");
            // $ress =__dbRow($cms);

            // xK == D Rp changed

            $cmd = __select("
            UPDATE epms.trs_kas_dtl AS tbl 
            JOIN  (
                SELECT tkad_atjh_pk, SUM(tkad_total) rp FROM epms.trs_kas_dtl WHERE tkad_tipe_dk='K' AND  tkad_atjh_pk='" . $vpkhdr . "'
                              GROUP BY tkad_atjh_pk
                ) AS grp
            ON grp.tkad_atjh_pk = tbl.tkad_atjh_pk 
         SET tbl.tkad_total = grp.rp
         WHERE tbl.tkad_atjh_pk ='" . $vpkhdr . "' AND tbl.tkad_tipe_dk='D'
            ");
            // $res =__dbRow($cmd);

            $cmd = __select("
            UPDATE epms.trs_kas_vcr	SET tkav_total = (SELECT SUM(tkad_total) rp FROM epms.trs_kas_dtl WHERE tkad_tipe_dk='K' AND  tkad_atjh_pk='" . $vpkhdr . "')	WHERE tkav_tdna_pk ='" . $vpkhdr . "'
            ");
            // $res =__dbRow($cmd);

            // TDNA Rp
            $cmdk = __select("
            UPDATE epms.trs_dana_aju	SET tdna_total = (SELECT SUM(tkad_total) rp FROM epms.trs_kas_dtl WHERE tkad_tipe_dk='K' AND  tkad_atjh_pk='" . $vpkhdr . "')	WHERE  tdna_pk ='" . $vpkhdr . "'
            ");
            // $resk =__dbRow($cmdk);

            // JUR Rp
            if ($vinal == "1") {
                $sql = __select("
                UPDATE ejur.atr_jurnal_dtl_all SET atjd_total='" . $vcr . "', atjd_askn_kode='" . $vakun . "', atjd_keterangan='" . $vket . "'	
                WHERE atjd_atjh_pk ='" . $tkad_pk . "'  AND atjd_tipe_dk='K'
                ");
                // $resq =__dbRow($sql);

                $sqlx = __select("
                UPDATE ejur.atr_jurnal_dtl_all SET atjd_total='" . $vcr . "'
                WHERE atjd_atjh_pk ='" . $tkad_pk . "'  AND atjd_tipe_dk='D'
                ");
                // $resqx =__dbRow($sqlx);

                $sqlz = __select("
                UPDATE ejur.atr_jurnal_hdr_all SET atjh_total_debit='" . $vcr . "', atjh_total_kredit='" . $vcr . "' WHERE atjh_pk ='" . $tkad_pk . "'
                ");
                // $resqz =__dbRow($sqlz);
            }
        }

        // $cmdx =__select("
        // select tkad_pk from ".$vtable." where  tkad_pk='".$request['tkad_pk']."'
        // ");
        // // $cmdx = DB::table("epms.trs_kas_dtl")->where('tkad_pk', $request['tkad_pk']);
        // $res =__dbAll($cmdx);
        return response()->json(['success' => 'Data berhasil di update']);
        // // return $data;
    }

    public function p_jurkas_cek(Request $request)
    {
        $cmd = "";
        // $user = "";

        $tgl = $request->tgl;
        $tkad_pk = $request->tkad_pk;
        $tipe = $request->tipe;
        $user = $request->user;

        // $user = __getUser();
        $tglx = __str2($tgl, 'D');

        $bulan = __select("select 
        month('" . $tglx . "') as bulan,
        year('" . $tglx . "') as tahun");
        $rbln = __dbRow($bulan);

        if ($tipe == "R") {
            if ($rbln['bulan'] <= '11' and $rbln['tahun'] <= '2018') {
                $call1 = __select("CALL epms.`P_JURNAL_KAS_ULANG`('" . $tkad_pk . "','" . $user . "')");
                $cmd = __dbRow($call1);
                //$rcmd=__dbRow($cmd);
                //echo $cmd;

                return response()->json(['info' => 'Data sudah direfresh, Silahkan Approval']);
            } else {   #----CEK HAK AKSES KADIV ACC---#
                $call2 = __select("CALL epms.`P_JURNAL_KAS_ULANG`('" . $tkad_pk . "','" . $user. "')");
                $cmd = __dbRow($call2);

                // echo '{"info" : "Data sudah direfresh, Silahkan Approval "}';
                return response()->json(['info' => 'Data sudah direfresh, Silahkan Approval']);
            }
        }
    }
}
