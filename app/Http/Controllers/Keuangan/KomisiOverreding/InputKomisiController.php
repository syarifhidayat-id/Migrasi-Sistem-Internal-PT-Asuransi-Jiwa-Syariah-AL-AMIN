<?php

namespace App\Http\Controllers\Keuangan\KomisiOverreding;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\KodeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class InputKomisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.keuangan.komisi-overreding.input.index');
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
            'mtx_kode' => 'required|max:16',
            'mtx_npwp' => 'required|max:20',
            'mtx_nama' => 'required',
            'mtx_status' => 'required',
        ],
        [
            'mtx_kode.required'=>'Kode user tidak boleh kosong!',
            'mtx_kode.max'=>'Kode user maksimal 16 karakter!',
            'mtx_npwp.required'=>'NPWP tidak boleh kosong!',
            'mtx_npwp.max'=>'NPWP maksimal 20 karakter!',
            'mtx_nama.required'=>'Nama user tidak boleh kosong!',
            'mtx_status.required'=>'Status user tidak boleh kosong!',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'error' => $validasi->errors()
            ]);
        } else {
            $vtable = DB::table('emst.mst_tax');
            $data = $request->all();
            $data = $request->except('_token');

            $vtable->insert($data);

            return response()->json([
                'success' => 'Data berhasil disimpan dengan Kode '.$request->mtx_kode.' !'
            ]);
        }
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

    public function inputKomisi(Request $request)
    {
        // if ($request->ajax()) {
            $data = DB::table('epstfix.peserta_all')
            ->select(DB::raw("
            mpol_kode kdpolis,
            mpol_mrkn_kode kode,
            mpol_mrkn_nama nama,
            COUNT(tpprd_pk) tpst,
            SUM(tpprd_up) tup,
            SUM(tpprd_premi_bayar) ttagih,
            SUM(tpprd_total_bayar_dtl) tbyr,
            SUM(epstfix.F_GET_RUMUSPRODUKSI('KOMISI',tpprd_pk,tpprd_nomor_polish,tpprd_jatuhtempo,tpprd_umur,tpprd_umur2,tpprd_tanggal_lahir,tpprd_tanggal_lahir2,tpprd_tanggal_awal,tpprd_tanggal_akhir,tpprd_masa_tahun,tpprd_masa_bulan,tpprd_up,tpprd_tarif_persen,tpprd_tarif,tpprd_admin,tpprd_admin_persen,tpprd_disc,tpprd_disc_persen,tpprd_disc_ajukan,tpprd_discpolis,tpprd_discpolis_persen,tpprd_disc_lain_persen,tpprd_disc_lain,tpprd_biaya_medis,tpprd_extra,tpprd_extra_persen,tpprd_em_persen_reas,tpprd_premi_reas,tpprd_up_baru,tpprd_premi,tpprd_premi_co,tpprd_premi_bayar,tpprd_share,tpprd_up_persen,tpprd_ujroh_persen,tpprd_ujroh,tpprd_komisi_persen,tpprd_komisi,tpprd_status_usertax_persen,tpprd_status_usertax,tpprd_tax_persen,tpprd_tax,tpprd_komisi_bayar,tpprd_manajemenfee_persen,tpprd_manajemenfee,tpprd_overidding_persen,tpprd_overidding,tpprd_referal,tpprd_referal_persen,tpprd_maintenance,tpprd_maintenance_persen,tpprd_handlingfee_persen,tpprd_handlingfee,tpprd_disc_ujroh,tpprd_refund_premi,tpprd_tanggal_bayar,tpprd_total_bayar_dtl,tpprd_total_bayar,tpprd_status_bayar,tpprd_jenis_bayar,tpprd_tarif_nonlife,tpprd_premi_nonlife,tpprd_tarif_persen_nonlife,tpprd_umur_polis,tpprd_status_bayar_lain,tpprd_tanggal_bayar_lain,tpprd_total_bayar_lain,tpprd_total_bayar_disc,tpprd_tanggal_bayar_disc,tpprd_em_status,tpprd_em_tanggal,tpprd_reas_premilife,tpprd_reas_preminonlife,tpprd_reas_ujrohreas,tpprd_reas_tabbaru,tpprd_share_reindo,tpprd_share_nasre,tpprd_share_alamin,tpprd_tabaru_life,tpprd_uangkuliah_semester,tpprd_uangkuliah_tunggal,tpprd_tahun_kuliah,tpprd_masa_kuliah,tpprd_ajufee,tpprd_ajufee_persen,tpprd_total_refund,tpprd_selisih_premi,mjns_kode,mjm_kode,'')) tkomisi,
            SUM((epstfix.F_GET_RUMUSPRODUKSI('KOMISI',tpprd_pk,tpprd_nomor_polish,tpprd_jatuhtempo,tpprd_umur,tpprd_umur2,tpprd_tanggal_lahir,tpprd_tanggal_lahir2,tpprd_tanggal_awal,tpprd_tanggal_akhir,tpprd_masa_tahun,tpprd_masa_bulan,tpprd_up,tpprd_tarif_persen,tpprd_tarif,tpprd_admin,tpprd_admin_persen,tpprd_disc,tpprd_disc_persen,tpprd_disc_ajukan,tpprd_discpolis,tpprd_discpolis_persen,tpprd_disc_lain_persen,tpprd_disc_lain,tpprd_biaya_medis,tpprd_extra,tpprd_extra_persen,tpprd_em_persen_reas,tpprd_premi_reas,tpprd_up_baru,tpprd_premi,tpprd_premi_co,tpprd_premi_bayar,tpprd_share,tpprd_up_persen,tpprd_ujroh_persen,tpprd_ujroh,tpprd_komisi_persen,tpprd_komisi,tpprd_status_usertax_persen,tpprd_status_usertax,tpprd_tax_persen,tpprd_tax,tpprd_komisi_bayar,tpprd_manajemenfee_persen,tpprd_manajemenfee,tpprd_overidding_persen,tpprd_overidding,tpprd_referal,tpprd_referal_persen,tpprd_maintenance,tpprd_maintenance_persen,tpprd_handlingfee_persen,tpprd_handlingfee,tpprd_disc_ujroh,tpprd_refund_premi,tpprd_tanggal_bayar,tpprd_total_bayar_dtl,tpprd_total_bayar,tpprd_status_bayar,tpprd_jenis_bayar,tpprd_tarif_nonlife,tpprd_premi_nonlife,tpprd_tarif_persen_nonlife,tpprd_umur_polis,tpprd_status_bayar_lain,tpprd_tanggal_bayar_lain,tpprd_total_bayar_lain,tpprd_total_bayar_disc,tpprd_tanggal_bayar_disc,tpprd_em_status,tpprd_em_tanggal,tpprd_reas_premilife,tpprd_reas_preminonlife,tpprd_reas_ujrohreas,tpprd_reas_tabbaru,tpprd_share_reindo,tpprd_share_nasre,tpprd_share_alamin,tpprd_tabaru_life,tpprd_uangkuliah_semester,tpprd_uangkuliah_tunggal,tpprd_tahun_kuliah,tpprd_masa_kuliah,tpprd_ajufee,tpprd_ajufee_persen,tpprd_total_refund,tpprd_selisih_premi,mjns_kode,mjm_kode,'') * tpprd_overidding_persen)/100) toverreding,
            mlok_nama cabang,
            CONCAT(mjns_keterangan,'/',mjm_nama,'/',mft_nama,'/',mpol_kode) ket,
            tpprd_extra_persen,
            tpprd_insert_fix"))
            ->leftJoin('eopr.mst_polis', function($join) {
                $join->on('mpol_kode', '=', 'tpprd_nomor_polish');
            })
            ->leftJoin('emst.mst_jenis_nasabah', 'mjns_kode', '=', 'mpol_mjns_kode')
            ->leftJoin('emst.mst_jaminan', 'mjm_kode', '=', 'mpol_mjm_kode')
            ->leftJoin('emst.mst_manfaat_plafond', 'mft_kode', '=', 'mpol_mft_kode')
            ->leftJoin('emst.mst_lokasi', 'mlok_kode', '=', 'tpprd_mlok_kode')
            ->leftJoin('emst.mst_rekanan as cb', function($join) {
                $join->on('cb.mrkn_kode', '=', 'tpprd_mrkn_kode');
            })
            ->leftJoin('emst.mst_rekanan as ps', function($join) {
                $join->on(DB::raw("IF(IFNULL(cb.mrkn_mrkn_kode_induk,'')='' OR cb.mrkn_mrkn_kode_induk='-', cb.mrkn_kode,cb.mrkn_mrkn_kode_induk)"), '=', 'ps.mrkn_kode');
            })
            ->where([
                [DB::raw("(tpprd_total_bayar_dtl-tpprd_premi_bayar)"), '>-', 0.1],
                [DB::raw("IFNULL(tpprd_komisi_persen,0)"), '>', 0],
                [DB::raw("IFNULL(tpprd_tax_persen,0)"), '<', 1],
                ['tpprd_status_klaim', '!=', 1],
                ['tpprd_status_refund', '!=', 1],
                ['tpprd_status_batal', '!=', 1],
                ['tpprd_status_bayar', '!=', 1],
                ['tpprd_status', 1],
            ])
            ->orderBy(DB::raw("mpol_mrkn_nama,mlok_nama"), 'ASC')
            ->groupBy('mpol_kode')
            // ->limit(10000)
            ->get();

            return DataTables::of($data)
            ->addIndexColumn()
            ->filter (function ($instance) use ($request) {
                // if (!empty($request->get('e_bln1')) && !empty($request->get('e_bln2'))) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        // return Str::contains($row['tpprd_insert_fix'], $request->get('e_bln1')) ? true : false;
                        // return Str::between($row['tpprd_insert_fix'], date('m', strtotime($request->get('e_bln1'))), date('m', strtotime($request->get('e_bln2'))));
                    });
                // }
                // if ($request->get('check_2') == "1") {
                //     if (!empty($request->get('wmn_descp'))) {
                //         $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                //             return Str::contains($row['wmn_descp'], $request->get('wmn_descp')) ? true : false;
                //         });
                //     }
                // }
                // if (!empty($request->get('search'))) {
                //     $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                //         if (Str::contains(Str::lower($row['wmn_tipe']), Str::lower($request->get('search')))){
                //             return true;
                //         }else if (Str::contains(Str::lower($row['wmn_descp']), Str::lower($request->get('search')))) {
                //             return true;
                //         }

                //         return false;
                //     });
                // }
            })
            ->make(true);
        // }
    }
}
