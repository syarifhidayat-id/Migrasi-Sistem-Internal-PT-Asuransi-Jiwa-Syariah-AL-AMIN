<?php

namespace App\Http\Controllers\Tehnik\Soc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class LihatSocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.tehnik.soc.lihat-soc.index');
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
        // return $request->msoc_kode;
        // $vtable = DB::table('eopr.mst_soc')->where('msoc_kode', $request->msoc_kode);
        // $data = $request->all();
        // $data = $request->except('_token', 'approv_soc');
        // $data['msoc_approve'] = $request->approv_soc;
        // $vtable->update($data);

        // return response()->json([
        //     'success' => 'Data berhasil diupdate dengan Kode '.$request->msoc_kode.'!'
        // ]);
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

    public function udapteStsApprov($kode, $value)
    {
        $vtable = DB::table('eopr.mst_soc')->where('msoc_kode', $kode);
        $data['msoc_approve'] = $value;
        $vtable->update($data);

        return response()->json([
            'success' => 'Data berhasil diupdate dengan Kode '.$kode.'!'
        ]);
    }

    public function listSoc(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('eopr.mst_soc')
                ->select(DB::raw("CASE msoc_mft_kode WHEN '01' THEN 'UM' WHEN '02' THEN 'UT' WHEN '03' THEN 'UM FLAT' WHEN '04' THEN 'UM EFEKTIF' WHEN '05' THEN 'UM SLIDING' END msoc_mft_kode,
                msoc_nomor msli_nomor,
                msoc_kode,
                msoc_mrkn_nama msli_mrkn_nama,
                mjns.mjns_Keterangan mjns_nama,
                mpras.mpras_nama mpli_mpras_nama,
                mft_nama,
                msoc_mpuw_nomor,
                mkm_nama,
                mpras_nama,
                mkm_ket2,
                mssp_nama,
                mker_nama,
                DATE_FORMAT(msoc_ins_date,'%d-%m-%Y, %H:%i:%s') ins_date,
                msoc_ins_date,
                msoc_ins_user,
                mjm_nama,
                IF(msoc_jenis_bayar=2,'PER BULAN',IF(msoc_jenis_bayar=1,'PER TAHUN','SEKALIGUS')) bayar,
                IF(msoc_approve=1, 'sudah','belum') msoc_approve,
                DATEDIFF(curdate(), date(msoc_ins_date)) umur,
                IFNULL(mpol_kode, 'belum dibuat polis') mpol_kode,
                IF(mpol_approve=1, 'sudah','belum') mpol_approve,
                IF(mpol_aktif=1, 'aktif',IF(mpol_aktif=2,'mati','suspend')) aktif,
                IF(mpol_online=1, 'aktif',IF(mpol_online=2,'mati','mati')) online,
                @no:=@no+1 AS DT_RowIndex"))
                ->leftJoin('emst.mst_jenis_nasabah as mjns', 'mjns.mjns_kode', '=', 'msoc_mjns_kode')
                ->leftJoin('emst.mst_produk_segment as mssp', 'mssp.mssp_kode', '=', 'msoc_mssp_kode')
                ->leftJoin('emst.mst_program_asuransi as mpras', 'mpras.mpras_kode', '=', 'msoc_mpras_kode')
                ->leftJoin('emst.mst_jaminan as mjm', 'mjm.mjm_kode', '=', 'msoc_mjm_kode')
                ->leftJoin('emst.mst_manfaat_plafond', 'mft_kode', '=', 'msoc_mft_kode')
                ->leftJoin('emst.mst_mekanisme', 'mkm_kode', '=', 'msoc_mekanisme')
                ->leftJoin('emst.mst_pekerjaan', 'mker_kode', '=', 'msoc_jns_perusahaan')
                ->leftJoin('emst.mst_mekanisme2', 'mkm_kode2', '=', 'msoc_mekanisme2')
                ->leftJoin('eopr.mst_polis', 'mpol_msoc_kode', '=', 'msoc_kode')
                ->where([
                    ['msoc_endos', '!=', '3'],
                ])
                ->groupBy('msoc_kode')
                ->orderBy('msoc_ins_date', 'DESC')
                ->get();

            return DataTables::of($data)
            ->addIndexColumn()
            ->filter (function ($instance) use ($request) {
                if (!empty($request->get('msoc_kode'))) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['msoc_kode'], $request->get('msoc_kode')) ? true : false;
                    });
                }
                if (!empty($request->get('search'))) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        if (Str::contains(Str::lower($row['msoc_kode']), Str::lower($request->get('search')))){
                            return true;
                        }else if (Str::contains(Str::lower($row['msli_mrkn_nama']), Str::lower($request->get('search')))) {
                            return true;
                        }

                        return false;
                    });
                }
            })
            ->make(true);
        }
    }
}
