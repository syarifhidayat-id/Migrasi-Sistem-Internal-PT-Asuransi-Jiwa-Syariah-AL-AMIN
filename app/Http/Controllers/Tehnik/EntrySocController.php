<?php

namespace App\Http\Controllers\Tehnik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntrySocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.tehnik.soc.create');
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

    public function selectPmgPolis(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::connection('emst')
            ->table('mst_rekanan as cb')
            ->select('cb.mrkn_kode as kode', DB::raw("if(cb.mrkn_nama = ps.mrkn_nama OR ps.mrkn_nama IS NULL, cb.mrkn_nama, concat(ps.mrkn_nama, ' ', cb.mrkn_nama)) as nama"))
            ->leftJoin('emst.mst_rekanan as ps', 'ps.mrkn_kode', '=', 'cb.mrkn_kode')
            ->where([
                ['cb.mrkn_kode','<>',''],
                ['cb.mrkn_kantor_pusat','1'],
                ['cb.mrkn_nama','!=',''],
                ['cb.mrkn_nama','like',"%$search%"],
            ])
            ->get();
        } else {
            $data = DB::connection('emst')
            ->table('mst_rekanan as cb')
            ->select('cb.mrkn_kode as kode', DB::raw("if(cb.mrkn_nama = ps.mrkn_nama OR ps.mrkn_nama IS NULL, cb.mrkn_nama, concat(ps.mrkn_nama, ' ', cb.mrkn_nama)) as nama"))
            ->leftJoin('emst.mst_rekanan as ps', 'ps.mrkn_kode', '=', 'cb.mrkn_kode')
            ->where([
                ['cb.mrkn_kode','<>',''],
                ['cb.mrkn_kantor_pusat','1'],
                ['cb.mrkn_nama','!=',''],
            ])
            ->get();
        }

        return response()->json($data);
    }

    public function selectJnsNasabah(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::connection('emst')
                ->table('mst_jenis_nasabah')
                ->select(DB::raw("mpol_mjns_kode, mpid_nama, mjns_kode, mjns_keterangan, mjns_jl, mjns_jl_pst, mjns_jl_pas, mjns_wp_pens, mjns_phk_pens, mjns_mpid_nomor, mjns_pbiaya"))
                ->leftJoin('eopr.mst_polis', 'mpol_mjns_kode', '=', 'mjns_kode')
                ->leftJoin('emst.mst_produk_induk', 'mpid_kode', '=', 'mjns_mpid_nomor')
                ->where([
                    ['mjns_kode', '<>', ''],
                    ['mjns_kode', '!=', '00'],
                    ['mjns_keterangan', 'like', "%$search%"],
                ])
                ->groupBy('mjns_kode')
                ->get();
        } else {
            $data = DB::connection('emst')
                ->table('mst_jenis_nasabah')
                ->select(DB::raw("mpol_mjns_kode, mpid_nama, mjns_kode, mjns_keterangan, mjns_jl, mjns_jl_pst, mjns_jl_pas, mjns_wp_pens, mjns_phk_pens, mjns_mpid_nomor, mjns_pbiaya"))
                ->leftJoin('eopr.mst_polis', 'mpol_mjns_kode', '=', 'mjns_kode')
                ->leftJoin('emst.mst_produk_induk', 'mpid_kode', '=', 'mjns_mpid_nomor')
                ->where([
                    ['mjns_kode', '<>', ''],
                    ['mjns_kode', '!=', '00'],
                ])
                ->groupBy('mjns_kode')
                ->get();
        }
        return response()->json($data);
    }

    public function selectSegmen(Request $request, $kode)
    {
        $data2 = [];
        if ($request->has('q')) {
            $search = $request->q;
            $in = DB::table('emst.mst_protree_2')->select('mptr_kode')->where('mptr_induk', $kode);
            $data1 = DB::connection('emst')
                ->table('mst_produk_segment')
                ->select(DB::raw("mssp_kode, mssp_nama, mssp_group"))
                ->where([
                    ['mssp_group', '<>', ''],
                    ['mssp_nama', 'like', "%$search%"],
                ])
                ->whereIn('mssp_kode', $in)
                ->get();

            $data2 = DB::connection('emst')
                ->table('mst_produk_segment')
                ->select(DB::raw("mssp_kode, mssp_nama, mssp_group"))
                ->where([
                    ['mssp_group', '<>', ''],
                    ['mssp_nama', 'like', "%$search%"],
                ])
                ->whereIn('mssp_kode', $in)
                ->get();

            $merge = $data2->merge($data1);
        } else {
            $in = DB::table('emst.mst_protree_2')->select('mptr_kode')->where('mptr_induk', $kode);
            $data1 = DB::connection('emst')
                ->table('mst_produk_segment')
                ->select(DB::raw("mssp_kode, mssp_nama, mssp_group"))
                ->where([
                    ['mssp_group', '<>', ''],
                ])
                ->whereIn('mssp_kode', $in)
                ->get();

            $data2 = DB::connection('emst')
                ->table('mst_produk_segment')
                ->select(DB::raw("mssp_kode, mssp_nama"))
                ->where([
                    ['mssp_group', ''],
                ])
                ->whereIn('mssp_kode', $in)
                ->get();

            $merge = $data2->merge($data1);
        }
        return response()->json($merge);
    }
}
