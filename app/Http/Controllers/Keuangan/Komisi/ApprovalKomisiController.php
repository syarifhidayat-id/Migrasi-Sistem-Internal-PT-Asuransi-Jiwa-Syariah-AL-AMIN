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
        ->select(DB::raw("REPLACE(tkomh_pk,'K','') tkomh_pk,mpol_kode kdpolis_x, mgro_pk x_giro, skar_pk kode tkomh_penerima, tovh_penerima tkomh_penerima_o"))
        ->leftJoin('etrs.trs_over_dtl', DB::raw("REPLACE('tkomd_tkomh_pk','K','')"), '=', DB::raw("REPLACE('tovd_tovh_pk','O','')"))
        ->leftJoin('eacc.mst_giro', 'mgro_pk', '=', 'tkomh_mgro_pk')
        ->leftJoin('epstfix.peserta_all', 'tpprd_pk', '=', 'tkomd_tpprd_pk')
        ->leftJoin('esdm.sdm_karyawan_new', 'skar_pk kode', '=', 'tkomh_penerima')
        ->leftJoin('eopr.mst_polis', 'mpol_kode', '=', 'tpprd_nomor_polish')
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
    public function destroy(Komisi $komisi)
    {
        //
    }

    public function listKomisi(Request $request)
    {
         if ($request->ajax()) {
            $data = DB::table('etrs.trs_komisi_hdr')
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
                mlok_nama cabang,tkomh_sts1_user,tkomh_sts2_user,tkomh_sts3_user,
                FORMAT(IFNULL(SUM(tkomd_komisi),0) - IFNULL(SUM(tkomd_tax),0),2) as tkomisinetto,
                FORMAT(IFNULL(SUM(`tovd_over`),0) - IFNULL(SUM(`tovd_tax`),0),2) as toverreding_netto,
                @no:=@no+1 AS DT_RowIndex"))
                ->leftJoin('etrs.trs_komisi_dtl', 'tkomh_pk', '=', 'tkomd_tkomh_pk')
                ->leftJoin('epstfix.peserta_all', 'tpprd_pk', '=', 'tkomd_tpprd_pk')
                ->leftJoin('emst.mst_lokasi', 'mlok_kode', '=', 'tpprd_mlok_kode')
                ->leftJoin('eopr.mst_polis', 'mpol_kode', '=', 'tpprd_nomor_polish')
                ->leftJoin('emst.mst_jenis_nasabah', 'mjns_kode', '=', 'mpol_mjns_kode')
                ->leftJoin('emst.mst_jaminan', 'mjm_kode', '=', 'mpol_mjm_kode')
                ->leftJoin('etrs.trs_over_dtl', DB::raw("REPLACE('tkomd_tkomh_pk','K','')"), '=', DB::raw("REPLACE('tovd_tovh_pk','O','')"))
                ->groupBy('mpol_kode')
                ->orderBy('mpol_mrkn_nama', 'ASC')
                ->get();

            return DataTables::of($data)
            ->addIndexColumn()
            ->filter (function ($instance) use ($request) {
                if (!empty($request->get('cabang'))) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['cabang'], $request->get('cabang')) ? true : false;
                    });
                }

            })
            ->make(true);
         }
    }
}
