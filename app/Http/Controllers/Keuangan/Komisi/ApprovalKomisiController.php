<?php

namespace App\Http\Controllers\Keuangan\Komisi;

use App\Http\Controllers\Controller;
use App\Models\Keuangan\Komisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
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

        return view('pages.keuangan.komisi.index', [
            'cabang' => $caricabang
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
    public function edit(Komisi $komisi)
    {
        //
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
                if (!empty($request->get('mlok_nama'))) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['mlok_nama'], $request->get('mlok_nama')) ? true : false;
                    });
                }

            })
            ->make(true);
         }
    }
}
