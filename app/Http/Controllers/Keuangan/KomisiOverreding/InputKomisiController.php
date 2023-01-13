<?php

namespace App\Http\Controllers\Keuangan\KomisiOverreding;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class InputKomisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.keuangan.komisi-overreding.input.index', [
            'year' => date('2007'),
            'tahun' => date('2007'),
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
        if ($request->mtx_kode) {
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

        if ($request->x_kode) {
            $vtable = DB::table('emst.mst_saldo_komisi')->where('msalk_mtx_kode', $request->x_kode);
            $data = $request->all();
            $data = $request->except(
                '_token',
                'x_tahun',
                'cari_tax',
                'x_kode',
                'x_npwp',
                'x_nama',
                'x_status',
                'x_saldo',
            );
            $data['msalk_mtx_kode'] = $request->x_kode;
            $data['msalk_tahun'] = $request->x_tahun;
            $data['msalk_saldo'] = Config::_str2($request->x_saldo);
            $vtable->update($data);

            return response()->json([
                'success' => 'Data berhasil diupdate dengan Kode '.$request->x_kode.' !'
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

    public function selectCabAlm(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;

        $vtable = DB::table('emst.mst_lokasi');
        $vField = DB::raw("mlok_kode kode,mlok_nama nama");

        $vtable->select($vField)->where('mlok_kode', '<>', '');

        if (!empty($request->q)) {
            $vtable->where('mlok_kode', 'LIKE', "%$request->q%")->orWhere('mlok_nama', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->offset($offset)
        ->limit($rows)
        ->get();

        return response()->json($data);
    }

    public function cariTax(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;

        $vtable = DB::table('emst.mst_tax')
        ->select(DB::raw("mtx_kode x_kode,
        mtx_npwp x_npwp,
        mtx_nama x_nama,
        mtx_status x_status,
        IFNULL(msalk_tahun,'1881') x_tahun,
        FORMAT(IFNULL(msalk_saldo,0),2) x_saldo"))
        ->leftJoin('emst.mst_saldo_komisi', function($join) use ($request) {
            $join->on('mtx_kode', '=', 'msalk_mtx_kode');
            if ($request->e_tahun) {
                $join->where('msalk_tahun', '=', $request->e_tahun);
            }
        });

        if (!empty($request->q)) {
            $vtable->where('mtx_nama', 'LIKE', "%$request->q%")->orWhere('mtx_kode', 'LIKE', "%$request->q%");
        }

        $data = $vtable->get();

        return response()->json($data);
    }

    public function userTax(Request $request)
    {
        if (!empty($request->q)) {
            $page = $request->page ? intval($request->page) : 1;
            $rows = $request->rows ? intval($request->rows) : 1000;
            $offset = ($page - 1) * $rows;

            $vtable = DB::table('emst.mst_tax')
            ->select(DB::raw("mtx_kode kode,
            mtx_npwp npwp,
            mtx_nama nama,
            format(ifnull(msalk_saldo,0),2) mtx_saldo,
            case mtx_status
            when '0' then 'Karyawan'
            when '1' then 'Non Karyawan'
            end ket,
            mtx_status sts,
            msalk_tahun"))
            ->leftJoin('emst.mst_saldo_komisi', function($join) use ($request) {
                $join->on('mtx_kode', '=', 'msalk_mtx_kode')
                ->where('msalk_tahun', '=', DB::raw("year('".Config::curdate()."')"));
            })
            ->where('mtx_kode', '<>', '');

            if (!empty($request->q)) {
                $vtable->where('mtx_nama', 'LIKE', "%$request->q%")->orWhere('mtx_kode', 'LIKE', "%$request->q%");
            }

            $data = $vtable
            ->offset($offset)
            ->limit($rows)
            ->get();

            if (!empty($request->q)) {
                return response()->json($data);
            }
        }

    }

    public function lodInputKomisi(Request $request)
    {
        if ($request->ajax()) {
            $vtable = DB::table('epstfix.peserta_all')
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
            tpprd_insert_fix,
            tpprd_mlok_kode"))
            ->leftJoin('eopr.mst_polis', function($join) {
                $join->on('mpol_kode', '=', 'tpprd_nomor_polish')
                ->orderBy('mpol_mrkn_nama', 'ASC')
                ->groupBy('mpol_kode');
            })
            ->leftJoin('emst.mst_jenis_nasabah', 'mjns_kode', '=', 'mpol_mjns_kode')
            ->leftJoin('emst.mst_jaminan', 'mjm_kode', '=', 'mpol_mjm_kode')
            ->leftJoin('emst.mst_manfaat_plafond', 'mft_kode', '=', 'mpol_mft_kode')
            ->leftJoin('emst.mst_lokasi', function($join) use ($request) {
                $join->on('mlok_kode', '=', 'tpprd_mlok_kode')
                ->orderBy('mlok_nama', 'ASC');
            })
            ->leftJoin('emst.mst_rekanan as cb', function($join) {
                $join->on('cb.mrkn_kode', '=', 'tpprd_mrkn_kode');
            })
            ->leftJoin('emst.mst_rekanan as ps', function($join) {
                $join->on(DB::raw("IF(IFNULL(cb.mrkn_mrkn_kode_induk,'')='' OR cb.mrkn_mrkn_kode_induk='-', cb.mrkn_kode,cb.mrkn_mrkn_kode_induk)"), '=', 'ps.mrkn_kode');
            })
            // ->whereRaw("(tpprd_total_bayar_dtl-tpprd_premi_bayar)>-0.1 and IFNULL(tpprd_komisi_persen,0)>0 and IFNULL(tpprd_tax_persen,0)<1 and tpprd_status_klaim!=1 and tpprd_status_refund!=1 and tpprd_status_batal!=1 and tpprd_status_bayar=1 and tpprd_status=1");
            ->where([
                [DB::raw("(tpprd_total_bayar_dtl-tpprd_premi_bayar)"), '>', '-0.1'],
                [DB::raw("IFNULL(tpprd_komisi_persen,0)"), '>', '0'],
                [DB::raw("IFNULL(tpprd_tax_persen,0)"), '<', '1'],
                ['tpprd_status_klaim', '!=', '1'],
                ['tpprd_status_refund', '!=', '1'],
                ['tpprd_status_batal', '!=', '1'],
                ['tpprd_status_bayar', '=', '1'],
                ['tpprd_status', '=', '1'],
            ]);

            if (!empty($request->get('e_cab'))) {
                $vtable->where('tpprd_mlok_kode', '=', $request->get('e_cab'));
            }
            if (!empty($request->get('e_bln1')) && !empty($request->get('e_bln2')) && !empty($request->get('e_thn'))) {
                // $vtable->whereRaw("month(date(tpprd_insert_fix)) BETWEEN '".$request->get('e_bln1')."' and '".$request->get('e_bln1')."' and year(date(tpprd_insert_fix))='".$request->get('e_thn')."'");
                $vtable->where([
                    [DB::raw("month(date(tpprd_insert_fix))"), '>=', $request->get('e_bln1')],
                    [DB::raw("month(date(tpprd_insert_fix))"), '<=', $request->get('e_bln2')],
                    [DB::raw("year(date(tpprd_insert_fix))"), '=', $request->get('e_thn')],
                ]);
            }

            $data = $vtable
            ->limit(10000)
            ->get();

            return DataTables::of($data)
            ->addIndexColumn()
            ->filter (function ($instance) use ($request) {
                // if (!empty($request->get('e_cabalamin'))) {
                //     $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                //         return Str::contains($row['tpprd_mlok_kode'], $request->get('e_cabalamin')) ? true : false;
                //     });
                // }
                // if (!empty($request->get('e_bln1')) && !empty($request->get('e_bln2')) && !empty($request->get('e_thn'))) {
                //     $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                //         return Str::contains(date('m', strtotime($row['tpprd_insert_fix'])), $request->get('e_bln1')) ? true : false;
                //     });
                //     $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                //         return Str::contains(date('m', strtotime($row['tpprd_insert_fix'])), $request->get('e_bln2')) ? true : false;
                //     });
                //     $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                //         return Str::contains(date('Y', strtotime($row['tpprd_insert_fix'])), $request->get('e_thn')) ? true : false;
                //     });
                // }
                // if ($request->get('check_2') == "1") {
                //     if (!empty($request->get('wmn_descp'))) {
                //         $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                //             return Str::contains($row['wmn_descp'], $request->get('wmn_descp')) ? true : false;
                //         });
                //     }
                // }
                if (!empty($request->get('search'))) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        if (Str::contains(Str::lower($row['nama']), Str::lower($request->get('search')))){
                            return true;
                        }else if (Str::contains(Str::lower($row['cabang']), Str::lower($request->get('search')))) {
                            return true;
                        }

                        return false;
                    });
                }
            })
            ->make(true);
        }
    }

    public function exportInput(Request $request)
    {
        $vtable = DB::table('epstfix.peserta_all')
        ->select(DB::raw("tpprd_pk `PK`,
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
        epstfix.F_GET_RUMUSPRODUKSI('KOMISI',tpprd_pk,tpprd_nomor_polish,tpprd_jatuhtempo,tpprd_umur,tpprd_umur2,tpprd_tanggal_lahir,tpprd_tanggal_lahir2,tpprd_tanggal_awal,tpprd_tanggal_akhir,tpprd_masa_tahun,tpprd_masa_bulan,tpprd_up,tpprd_tarif_persen,tpprd_tarif,tpprd_admin,tpprd_admin_persen,tpprd_disc,tpprd_disc_persen,tpprd_disc_ajukan,tpprd_discpolis,tpprd_discpolis_persen,tpprd_disc_lain_persen,tpprd_disc_lain,tpprd_biaya_medis,tpprd_extra,tpprd_extra_persen,tpprd_em_persen_reas,tpprd_premi_reas,tpprd_up_baru,tpprd_premi,tpprd_premi_co,tpprd_premi_bayar,tpprd_share,tpprd_up_persen,tpprd_ujroh_persen,tpprd_ujroh,tpprd_komisi_persen,tpprd_komisi,tpprd_status_usertax_persen,tpprd_status_usertax,tpprd_tax_persen,tpprd_tax,tpprd_komisi_bayar,tpprd_manajemenfee_persen,tpprd_manajemenfee,tpprd_overidding_persen,tpprd_overidding,tpprd_referal,tpprd_referal_persen,tpprd_maintenance,tpprd_maintenance_persen,tpprd_handlingfee_persen,tpprd_handlingfee,tpprd_disc_ujroh,tpprd_refund_premi,tpprd_tanggal_bayar,tpprd_total_bayar_dtl,tpprd_total_bayar,tpprd_status_bayar,tpprd_jenis_bayar,tpprd_tarif_nonlife,tpprd_premi_nonlife,tpprd_tarif_persen_nonlife,tpprd_umur_polis,tpprd_status_bayar_lain,tpprd_tanggal_bayar_lain,tpprd_total_bayar_lain,tpprd_total_bayar_disc,tpprd_tanggal_bayar_disc,tpprd_em_status,tpprd_em_tanggal,tpprd_reas_premilife,tpprd_reas_preminonlife,tpprd_reas_ujrohreas,tpprd_reas_tabbaru,tpprd_share_reindo,tpprd_share_nasre,tpprd_share_alamin,tpprd_tabaru_life,tpprd_uangkuliah_semester,tpprd_uangkuliah_tunggal,tpprd_tahun_kuliah,tpprd_masa_kuliah,tpprd_ajufee,tpprd_ajufee_persen,tpprd_total_refund,tpprd_selisih_premi,mjns_kode,mjm_kode,'') KOMISI,
        (epstfix.F_GET_RUMUSPRODUKSI('KOMISI',tpprd_pk,tpprd_nomor_polish,tpprd_jatuhtempo,tpprd_umur,tpprd_umur2,tpprd_tanggal_lahir,tpprd_tanggal_lahir2,tpprd_tanggal_awal,tpprd_tanggal_akhir,tpprd_masa_tahun,tpprd_masa_bulan,tpprd_up,tpprd_tarif_persen,tpprd_tarif,tpprd_admin,tpprd_admin_persen,tpprd_disc,tpprd_disc_persen,tpprd_disc_ajukan,tpprd_discpolis,tpprd_discpolis_persen,tpprd_disc_lain_persen,tpprd_disc_lain,tpprd_biaya_medis,tpprd_extra,tpprd_extra_persen,tpprd_em_persen_reas,tpprd_premi_reas,tpprd_up_baru,tpprd_premi,tpprd_premi_co,tpprd_premi_bayar,tpprd_share,tpprd_up_persen,tpprd_ujroh_persen,tpprd_ujroh,tpprd_komisi_persen,tpprd_komisi,tpprd_status_usertax_persen,tpprd_status_usertax,tpprd_tax_persen,tpprd_tax,tpprd_komisi_bayar,tpprd_manajemenfee_persen,tpprd_manajemenfee,tpprd_overidding_persen,tpprd_overidding,tpprd_referal,tpprd_referal_persen,tpprd_maintenance,tpprd_maintenance_persen,tpprd_handlingfee_persen,tpprd_handlingfee,tpprd_disc_ujroh,tpprd_refund_premi,tpprd_tanggal_bayar,tpprd_total_bayar_dtl,tpprd_total_bayar,tpprd_status_bayar,tpprd_jenis_bayar,tpprd_tarif_nonlife,tpprd_premi_nonlife,tpprd_tarif_persen_nonlife,tpprd_umur_polis,tpprd_status_bayar_lain,tpprd_tanggal_bayar_lain,tpprd_total_bayar_lain,tpprd_total_bayar_disc,tpprd_tanggal_bayar_disc,tpprd_em_status,tpprd_em_tanggal,tpprd_reas_premilife,tpprd_reas_preminonlife,tpprd_reas_ujrohreas,tpprd_reas_tabbaru,tpprd_share_reindo,tpprd_share_nasre,tpprd_share_alamin,tpprd_tabaru_life,tpprd_uangkuliah_semester,tpprd_uangkuliah_tunggal,tpprd_tahun_kuliah,tpprd_masa_kuliah,tpprd_ajufee,tpprd_ajufee_persen,tpprd_total_refund,tpprd_selisih_premi,mjns_kode,mjm_kode,'')*mpol_overreding)/100 AS OVERREDING"))
        ->leftJoin('eopr.mst_polis', function($join) use ($request) {
            $join->on('mpol_kode', '=', 'tpprd_nomor_polish');
            if (!empty($request->kode)) {
                $join->where('mpol_kode', $request->kode);
            }
        })
        ->leftJoin('emst.mst_jenis_nasabah', 'mpol_mjns_kode', '=', 'mjns_kode')
        ->leftJoin('emst.mst_jaminan', 'mjm_kode', '=', 'mpol_mjm_kode')
        ->leftJoin('emst.mst_manfaat_plafond', 'mft_kode', '=', 'mpol_mft_kode')
        ->leftJoin('emst.mst_lokasi', 'tpprd_mlok_kode', '=', 'mlok_kode')
        ->leftJoin('emst.mst_rekanan as cb', function($join) {
            $join->on('cb.mrkn_kode', '=', 'tpprd_mrkn_kode');
        })
        ->leftJoin('emst.mst_rekanan as ps', function($join) {
            $join->on(DB::raw("IF(IFNULL(cb.mrkn_mrkn_kode_induk,'')='' OR cb.mrkn_mrkn_kode_induk='-' ,cb.mrkn_kode,cb.mrkn_mrkn_kode_induk)"), '=', 'ps.mrkn_kode');
        })
        // ->whereRaw("tpprd_total_bayar_dtl>=tpprd_premi_bayar and IFNULL(tpprd_komisi_persen,0)>0 and IFNULL(tpprd_tax_persen,0)<1 and tpprd_status_klaim!=1 and tpprd_status_refund!=1 and tpprd_status_batal!=1 and tpprd_status_bayar=1 and tpprd_status=1");
        ->where([
            ['tpprd_total_bayar_dtl', '>=', 'tpprd_premi_bayar'],
            [DB::raw("IFNULL(tpprd_komisi_persen,0)"), '>', '0'],
            [DB::raw("IFNULL(tpprd_tax_persen,0)"), '<', '1'],
            ['tpprd_status_klaim', '!=', '1'],
            ['tpprd_status_refund', '!=', '1'],
            ['tpprd_status_batal', '!=', '1'],
            ['tpprd_status_bayar', '=', '1'],
            ['tpprd_status', '=', '1'],
        ]);

        if (!empty($request->e_cab)) {
            $vtable->where('tpprd_mlok_kode', $request->e_cab);
        }
        if (!empty($request->e_bln1) && !empty($request->e_bln2) && !empty($request->e_thn)) {
            // $vtable->whereRaw("month(date(tpprd_insert_fix)) BETWEEN '".$request->e_bln1."' and '".$request->e_bln2."' and year(date(tpprd_insert_fix))='".$request->e_thn."' ");
            $vtable->where([
                [DB::raw("month(date(tpprd_insert_fix))"), '>=', $request->e_bln1],
                [DB::raw("month(date(tpprd_insert_fix))"), '<=', $request->e_bln2],
                [DB::raw("year(date(tpprd_insert_fix))"), '=', $request->e_thn],
            ]);
        }

        $data = $vtable->groupBy('tpprd_pk')->limit(10000000)->get();

        $vtable2 = DB::table('eopr.mst_polis')
        ->select(DB::raw("upper(eset.f_get_namabulan2('".$request->e_bln1."')) bln1,
        upper(eset.f_get_namabulan2('".$request->e_bln2."')) bln2,
        upper(eopr.f_get_namabulan(now())) cetakx,
        mpol_mrkn_nama nama"));

        if (!empty($request->kode)) {
            $vtable->where('mpol_mrkn_kode', $request->kode);
        }

        $data2 = $vtable2->first();

        $objPHPExcel = new Spreadsheet();
        $objPHPExcel->getProperties()
        ->setCreator("Maarten Balliauw")
        ->setLastModifiedBy("Maarten Balliauw")
        ->setTitle("Office 2007 XLS Test Document")
        ->setSubject("Office 2007 XLS Test Document")
        ->setDescription("Test document for Office 2007 XLS, generated using PHP classes.")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Test result file");

        $namafile="_".' DETAIL PESERTA KOMISI & OVERREDING '.Config::__getKey(14);
        $namasheet='DATA';
        $dirfile="public/keuangan/kemisi-overriding/input/xls";

        // # CETAK HEADER

        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1', 'DETAIL PESERTA KOMISI & OVERREDING '.$data2->nama)
        ->setCellValue('A2', 'PERIODE '.$data2->bln1.' '.$data2->bln2.' TAHUN '.$request->thn)
        ->setCellValue('A4', 'NO')
        ->setCellValue('B4', 'PK')
        ->setCellValue('C4', 'NO PESERTA')
        ->setCellValue('D4', 'KODE POLIS')
        ->setCellValue('E4', 'PEMEGANG POLIS')
        ->setCellValue('F4', 'CAB. PEMEGANG POLIS')
        ->setCellValue('G4', 'CABANG AL AMIN')
        ->setCellValue('H4', 'JNS NASABAH')
        ->setCellValue('I4', 'JAMINAN')
        ->setCellValue('J4', 'NAMA')
        ->setCellValue('K4', 'TGL LAHIR')
        ->setCellValue('L4', 'UMUR')
        ->setCellValue('M4', 'TGL AWAL')
        ->setCellValue('N4', 'TGL AKHIR')
        ->setCellValue('O4', 'TENOR')
        ->setCellValue('P4', 'UP')
        ->setCellValue('Q4', 'KONTRIBUSI GROSS')
        ->setCellValue('R4', 'KONTRIBUSI CO')
        ->setCellValue('S4', 'FEEBASE POTONG')
        ->setCellValue('T4', 'KONTRIBUSI TAGIH')
        ->setCellValue('U4', 'FEEBASE TDK POTONG')
        ->setCellValue('V4', 'KONTRIBUSI BAYAR')
        ->setCellValue('W4', 'KOMISI')
        ->setCellValue('X4', 'OVERREDING');

        // # CETAK BARIS
        $i=0;
        foreach ($data as $key => $res) {
            $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.(5+$i),($i+1))
            ->setCellValue('B'.(5+$i), "'".$res->PK)
            ->setCellValue('C'.(5+$i), "'".$res->NO_PESERTA)
            ->setCellValue('D'.(5+$i), "'".$res->KODE_POLIS)
            ->setCellValue('E'.(5+$i), $res->PEMEGANG_POLIS)
            ->setCellValue('F'.(5+$i), $res->CAB_PEMEGANG_POLIS)
            ->setCellValue('G'.(5+$i), $res->CABANG_AL_AMIN)
            ->setCellValue('H'.(5+$i), $res->JNS_NASABAH)
            ->setCellValue('I'.(5+$i), $res->JAMINAN)
            ->setCellValue('J'.(5+$i), $res->NAMA)
            ->setCellValue('K'.(5+$i), $res->TGL_LAHIR)
            ->setCellValue('L'.(5+$i), $res->UMUR)
            ->setCellValue('M'.(5+$i), $res->TGL_AWAL)
            ->setCellValue('N'.(5+$i), $res->TGL_AKHIR)
            ->setCellValue('O'.(5+$i), $res->TENOR)
            ->setCellValue('P'.(5+$i), $res->UP)
            ->setCellValue('Q'.(5+$i), $res->KONTRIBUSI_GROSS)
            ->setCellValue('R'.(5+$i), $res->KONTRIBUSI_CO)
            ->setCellValue('S'.(5+$i), $res->FEEBASE_POTONG)
            ->setCellValue('T'.(5+$i), $res->KONTRIBUSI_TAGIH)
            ->setCellValue('U'.(5+$i), $res->FEEBASE_TDK_POTONG)
            ->setCellValue('V'.(5+$i), $res->KONTRIBUSI_BAYAR)
            ->setCellValue('W'.(5+$i), $res->KOMISI)
            ->setCellValue('X'.(5+$i), $res->OVERREDING);

            // # CETAK FORMAT NUMERIC

            $objPHPExcel->getActiveSheet()
            ->getStyle('P'.(5+$i))
            ->getNumberFormat()
            ->setFormatCode('#,##0.00');

            $objPHPExcel->getActiveSheet()
            ->getStyle('Q'.(5+$i))
            ->getNumberFormat()
            ->setFormatCode('#,##0.00');

            $objPHPExcel->getActiveSheet()
            ->getStyle('R'.(5+$i))
            ->getNumberFormat()
            ->setFormatCode('#,##0.00');

            $objPHPExcel->getActiveSheet()
            ->getStyle('S'.(5+$i))
            ->getNumberFormat()
            ->setFormatCode('#,##0.00');

            $objPHPExcel->getActiveSheet()
            ->getStyle('T'.(5+$i))
            ->getNumberFormat()
            ->setFormatCode('#,##0.00');

            $objPHPExcel->getActiveSheet()
            ->getStyle('U'.(5+$i))
            ->getNumberFormat()
            ->setFormatCode('#,##0.00');

            $objPHPExcel->getActiveSheet()
            ->getStyle('V'.(5+$i))
            ->getNumberFormat()
            ->setFormatCode('#,##0.00');

            $objPHPExcel->getActiveSheet()
            ->getStyle('W'.(5+$i))
            ->getNumberFormat()
            ->setFormatCode('#,##0.00');

            $objPHPExcel->getActiveSheet()
            ->getStyle('X'.(5+$i))
            ->getNumberFormat()
            ->setFormatCode('#,##0.00');

            $i++;
        }

        // # CETAK RESIZE
        foreach(range('B','X') as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
        $objPHPExcel->getActiveSheet()->getStyle('A4:X4')->getFill()->applyFromArray(array('type' => Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'BDBDBD')));
        $objPHPExcel->getActiveSheet()->setTitle($namasheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$namafile.'.xlsx"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
        header ('Cache-Control: cache, must-revalidate');
        header ('Pragma: public');

        $objWriter = IOFactory::createWriter($objPHPExcel, 'Xlsx');
        $objWriter->save('php://output');
    }

    public function postPjKomisi(Request $request)
    {
        # code...
    }
}
