<?php

namespace App\Http\Controllers\Keuangan\KomisiOverreding;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\Lib;
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
            $data['msalk_saldo'] = Lib::__str2($request->x_saldo, 'N');
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
                ->where('msalk_tahun', '=', DB::raw("year('".Lib::now()."')"));
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
            set_time_limit(10000000);

            $vtable = DB::table('epstfix.peserta_all')
            ->select(DB::raw("
            count(*) tot,
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
            ->leftJoin('eopr.mst_polis', function($join) use ($request) {
                $join->on('mpol_kode', '=', 'tpprd_nomor_polish');
                if ($request['c_pmgpolis']=='1' && $request['c_pmgpolis']!=='0') {
                    $join->where('mpol_mrkn_kode', '=', $request['e_pmgpolis']);
                }
                $join->orderBy('mpol_mrkn_nama', 'ASC')
                ->groupBy('mpol_kode');
            })
            ->leftJoin('emst.mst_jenis_nasabah', 'mjns_kode', '=', 'mpol_mjns_kode')
            ->leftJoin('emst.mst_jaminan', 'mjm_kode', '=', 'mpol_mjm_kode')
            ->leftJoin('emst.mst_manfaat_plafond', 'mft_kode', '=', 'mpol_mft_kode')
            ->leftJoin('emst.mst_lokasi', function($join) use ($request) {
                $join->on('mlok_kode', '=', 'tpprd_mlok_kode')
                ->orderBy('mlok_nama', 'ASC');
            })
            ->leftJoin('emst.mst_rekanan as cb', function($join) use ($request) {
                $join->on('cb.mrkn_kode', '=', 'tpprd_mrkn_kode');
                if ($request['c_cbpmgpolis']=='1' && $request['c_pmgpolis']!=='0') {
                    $join->where('cb.mrkn_kode', '=', $request['e_cbpmgpolis']);
                }
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

        $namafile="_".' DETAIL PESERTA KOMISI & OVERREDING '.Lib::__getKey(14);
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
        if ($request->pic1==$request->pic1a) {
            return Lib::json([
                'error' => 'PIC Pajak Komisi 1 dan 2 tidak boleh sama!'
            ]);
        } else if ($request->pic1==$request->pic2) {
            return Lib::json([
                'error' => 'PIC Pajak Komisi 1 dan 3 tidak boleh sama!'
            ]);
        } else if ($request->pic1a==$request->pic2) {
            return Lib::json([
                'error' => 'PIC Pajak Komisi 2 dan 3 tidak boleh sama!'
            ]);
        } else {
            $kode_polis = $request['kode'];
            $pst = $request['pst'];
            $up = strval(Lib::__str2($request['up'],'N'));
            $bln1 = $request['bln1'];
            $bln2 = $request['bln2'];
            $thn = $request['thn'];
            $pic1 = $request['pic1']; //pic pajak komisi
            $pic1a = $request['pic1a'];
            $kom = strval(Lib::__str2($request['tkom'],'N')); //nilai komisi
            $cab = $request['cab'];

            $pic2 = $request['pic2']; //pic pajak overreding
            $over = strval(Lib::__str2($request['tover'],'N')); //nilai overreding
            $user = Lib::__getUser();
            $saldo1 = strval(Lib::__str2($request['saldo1'],'NO'));
            $saldo2 = strval(Lib::__str2($request['saldo2'],'NO'));

            $data = $request->all();
            $data['kode'] = $kode_polis;
            $data['pst'] = $pst;
            $data['up'] = $up;
            $data['bln1'] = $bln1;
            $data['bln2'] = $bln2;
            $data['thn'] = $thn;
            $data['pic1'] = $pic1;
            $data['kom'] = $kom;
            $data['pic2'] = $pic2;
            $data['over'] = $over;
            $data['saldo1'] = $saldo1;
            $data['saldo2'] = $saldo2;
            $data['cabang'] = $cab;
            // $data['user'] = ;

            return  response()->json([
                'success' => $data
            ]);

        //     $cek = DB::select("SELECT COUNT(*) t,
        //     sum(tpprd_up) tup,
        //     mpol_mrkn_kode kd_rekan,
        //     IFNULL(mpol_mkom_persen,0) kompolis
        //     FROM epstfix.peserta_all
        //     LEFT JOIN eopr.mst_polis ON mpol_kode=tpprd_nomor_polish,
        //     emst.mst_rekanan cb
        //     LEFT JOIN emst.mst_rekanan ps ON IF(IFNULL(cb.mrkn_mrkn_kode_induk,'')='' OR cb.mrkn_mrkn_kode_induk='-' ,cb.mrkn_kode,cb.mrkn_mrkn_kode_induk) =ps.mrkn_kode
        //     WHERE mpol_kode='".$kode_polis."' AND tpprd_mrkn_kode=cb.mrkn_kode
        //     AND month(date(tpprd_insert_fix)) between '".$bln1."' and '".$bln2."'
        //     AND year(date(tpprd_insert_fix))='".$thn."'
        //     AND (tpprd_total_bayar_dtl-tpprd_premi_bayar)>-0.1
        //     AND IFNULL(tpprd_komisi_persen,0)>0 AND IFNULL(tpprd_tax_persen,0)<1 and tpprd_mlok_kode!=01
        //     AND tpprd_status_klaim!=1 AND tpprd_status_refund!=1
        //     AND tpprd_mlok_kode='".$cab."'
        //     AND tpprd_status_batal!=1 AND tpprd_status_bayar=1
        //     AND tpprd_status=1");

        //     $rcek= Lib::__dbRow($cek);

        //     if ($rcek['kompolis']<1) {
        //         return Lib::json([
        //             'error' => 'Komisi Pada Polis No l !'
        //         ]);
        //     }
        //     if ($rcek['t']!=$pst) {
        //         return Lib::json([
        //             'error' => 'Total Peserta berbeda Cek: '.$rcek['t'].' Sedangkan tabel: '.$pst
        //         ]);
        //     }

        //     $pkx = Lib::__getKey(14);

        //     if ($rcek['t']==$pst && strval($rcek['tup'])==strval($up)) {
        //         if ($pic1!='') {
        //             $cek1 = DB::select("SELECT mtx_status sts, IFNULL(mtx_npwp,'') npwp,
        //             IFNULL(msalk_saldo,0) saldo,if(mtx_status=1,120000000,60000000) xlimit
        //             FROM emst.`mst_tax`
        //             LEFT JOIN emst.mst_saldo_komisi ON mtx_kode=msalk_mtx_kode AND msalk_tahun=YEAR(CURDATE())
        //             WHERE 1=1 AND mtx_kode='".$pic1."'");
        //             $r1 = Lib::__dbRow($cek1);
        //         }
        //         if ($pic1a!='') {
        //             $cek2 = DB::select("SELECT mtx_status sts, IFNULL(mtx_npwp,'') npwp,
        //             IFNULL(msalk_saldo,0) saldo,if(mtx_status=1,120000000,60000000) xlimit
        //             FROM emst.`mst_tax`
        //             LEFT JOIN emst.mst_saldo_komisi ON mtx_kode=msalk_mtx_kode AND msalk_tahun=YEAR(CURDATE())
        //             WHERE 1=1 AND mtx_kode='".$pic1a."'");
        //             $r2 = Lib::__dbRow($cek2);
        //         }
        //         if ($pic2!='') {
        //             $cek3 = DB::select("SELECT mtx_status sts, IFNULL(mtx_npwp,'') npwp,
        //             IFNULL(msalk_saldo,0) saldo,if(mtx_status=1,120000000,60000000) xlimit
        //             FROM emst.`mst_tax`
        //             LEFT JOIN emst.mst_saldo_komisi ON mtx_kode=msalk_mtx_kode AND msalk_tahun=YEAR(CURDATE())
        //             WHERE 1=1 AND mtx_kode='".$pic2."'");
        //             $r3 = Lib::__dbRow($cek3);
        //         }

	    //         //---KONDISI KOMISI 1---//
        //         if ($pic1!='' || $pic1a=='' || $pic2=='') {
        //             $tax1 = DB::select("SELECT mpt_persen FROM emst.`mst_persen_tax`
        //             WHERE (".$r1['saldo']."+".$kom.")>=mpt_nilai1
        //             AND mpt_nilai2>=(".$r1['saldo']."+".$kom.")
        //             LIMIT 1");
        //             $rtax1 = Lib::__dbRow($tax1);

        //             $pajak1 = $rtax1['mpt_persen'];

        //             if ($r1['npwp']!='') {
        //                 if ($r1['sts']==1) {
        //                     $tax1 = (50/100)*($rtax1['mpt_persen']/100);
        //                 } else {
        //                     $tax1 = ($rtax1['mpt_persen']/100);
        //                 }
        //             } else {
        //                 if ($r1['sts']==1) {
        //                     $tax1 = (50/100)*($rtax1['mpt_persen']/100)*(120/100);
        //                 } else {
        //                     $tax1 = ($rtax1['mpt_persen']/100)*(120/100);
        //                 }
        //             }

        //             $cek = DB::select("select count(*) t from etrs.trs_komisi_hdr where tkomh_nosurat='".$kode_polis."' and tkomh_pst='".$rcek['t']."'
        //             and tkomh_up='".$rcek['tup']."' and tkomh_penerima='".$pic1."'");
        //             $rcek = Lib::__dbRow($cek);

        //             if ($rcek['t']<1) {
        //                 $cmdh1 = DB::select("INSERT IGNORE INTO etrs.trs_komisi_hdr
        //                 SELECT
        //                 '".$pkx."K' tkomh_pk,
        //                 '".$kode_polis."' tkomh_nosurat,
        //                 curdate() tkomh_tanggal,
        //                 '".$rcek['t']."'  tkomh_pst,
        //                 '".$rcek['tup']."'  tkomh_up,
        //                 0  tkomh_komisi,
        //                 0  tkomh_tax,
        //                 0  tkomh_komisinett,
        //                 0  tkomh_bayar,
        //                 '' tkomh_bayar_tgl,
        //                 '' tkomh_mgro_pk,
        //                 '".$pic1."' tkomh_penerima,
        //                 0 tkomh_indexfolder,
        //                 '' tkomh_buktibayar,
        //                 NOW() tkomh_crud,
        //                 0  tkomh_sts1,
        //                 '' tkomh_sts1_date,
        //                 '' tkomh_sts1_user,
        //                 0  tkomh_sts2,
        //                 '' tkomh_sts2_date,
        //                 '' tkomh_sts2_user,
        //                 0  tkomh_sts3,
        //                 '' tkomh_sts3_date,
        //                 '' tkomh_sts3_user");

        //                 Lib::__dbRow($cmdh1);

        //                 $cmd = DB::select("INSERT IGNORE INTO etrs.trs_komisi_dtl
        //                 (`tkomd_pk`,
        //                 `tkomd_tkomh_pk`,
        //                 `tkomd_tpprd_pk`,
        //                 `tkomd_up`,
        //                 `tkomd_komisi_persen`,
        //                 `tkomd_komisi`,
        //                 `tkomd_tax_user`,
        //                 `tkomd_tax_userstatus`,
        //                 `tkomd_tax_userpersen`,
        //                 `tkomd_tax_persen`,
        //                 `tkomd_tax`,
        //                 `tkomd_tipe`,
        //                 `tkomd_ins_date`,
        //                 `tkomd_ins_user`,
        //                 `tkomd_bayar`,
        //                 `tkomd_tglbayar`,
        //                 `tkomd_userbayar`,
        //                 `tkomd_prosesbayar`,
        //                 `tkomd_mlok_kode`,
        //                 `tkomd_mrkn_kode_induk`,
        //                 `tkomd_mpol_kode`)
        //                SELECT
        //                CONCAT('".$pkx."_',tpprd_pk) tkomd_pk,
        //                '".$pkx."K' tkomd_tkomh_pk,
        //                tpprd_pk tkomd_tpprd_pk,
        //                tpprd_up tkomd_up,
        //                tpprd_komisi_persen tkomd_komisi_persen,
        //                epstfix.`F_GET_RUMUSPRODUKSI`(
        //                 'KOMISI'	,			   		`tpprd_pk`  ,
        //                 `tpprd_nomor_polish` ,   		`tpprd_jatuhtempo` ,
        //                 `tpprd_umur` ,		   		`tpprd_umur2` ,
        //                 `tpprd_tanggal_lahir` ,  		`tpprd_tanggal_lahir2` ,
        //                 `tpprd_tanggal_awal` ,   		`tpprd_tanggal_akhir` ,
        //                 `tpprd_masa_tahun` ,	   		`tpprd_masa_bulan` ,
        //                 `tpprd_up` ,			   		`tpprd_tarif_persen` ,
        //                 `tpprd_tarif` ,		   		`tpprd_admin` ,
        //                 `tpprd_admin_persen` ,   		`tpprd_disc` ,
        //                 `tpprd_disc_persen` ,	   		`tpprd_disc_ajukan`  ,
        //                 `tpprd_discpolis`  ,	   		`tpprd_discpolis_persen` ,
        //                 `tpprd_disc_lain_persen`,		`tpprd_disc_lain` ,
        //                 `tpprd_biaya_medis` ,    		`tpprd_extra` ,
        //                 `tpprd_extra_persen` ,  		`tpprd_em_persen_reas` ,
        //                 `tpprd_premi_reas` ,	  		`tpprd_up_baru` ,
        //                 `tpprd_premi` ,		  		`tpprd_premi_co` ,
        //                 `tpprd_premi_bayar`,	  		`tpprd_share` ,
        //                 `tpprd_up_persen` ,	  		`tpprd_ujroh_persen` ,
        //                 `tpprd_ujroh` ,		  		`tpprd_komisi_persen` ,
        //                 `tpprd_komisi` ,		  		`tpprd_status_usertax_persen` ,
        //                 `tpprd_status_usertax`, 		`tpprd_tax_persen` ,
        //                 `tpprd_tax` ,			  		`tpprd_komisi_bayar` ,
        //                 `tpprd_manajemenfee_persen`,  `tpprd_manajemenfee` ,
        //                 `tpprd_overidding_persen` ,   `tpprd_overidding` ,
        //                 `tpprd_referal` ,			    `tpprd_referal_persen` ,
        //                 `tpprd_maintenance` , 	    `tpprd_maintenance_persen` ,
        //                 `tpprd_handlingfee_persen` ,  `tpprd_handlingfee` ,
        //                 `tpprd_disc_ujroh` , 		    `tpprd_refund_premi` ,
        //                 `tpprd_tanggal_bayar` , 	    `tpprd_total_bayar_dtl` ,
        //                 `tpprd_total_bayar` , 	    `tpprd_status_bayar` ,
        //                 `tpprd_jenis_bayar` , 	    `tpprd_tarif_nonlife` ,
        //                 `tpprd_premi_nonlife` ,  	    `tpprd_tarif_persen_nonlife` ,
        //                 `tpprd_umur_polis` , 	  	    `tpprd_status_bayar_lain` ,
        //                 `tpprd_tanggal_bayar_lain` ,  `tpprd_total_bayar_lain` ,
        //                 `tpprd_total_bayar_disc` ,    `tpprd_tanggal_bayar_disc` ,
        //                 `tpprd_em_status`,		    `tpprd_em_tanggal` ,
        //                 `tpprd_reas_premilife` ,	    `tpprd_reas_preminonlife` ,
        //                 `tpprd_reas_ujrohreas` ,	    `tpprd_reas_tabbaru` ,
        //                 `tpprd_share_reindo` ,	    `tpprd_share_nasre` ,
        //                 `tpprd_share_alamin` ,	    `tpprd_tabaru_life` ,
        //                 `tpprd_uangkuliah_semester`  ,`tpprd_uangkuliah_tunggal` ,
        //                 `tpprd_tahun_kuliah`,		    `tpprd_masa_kuliah` ,
        //                 `tpprd_ajufee` ,			    `tpprd_ajufee_persen` ,
        //                 `tpprd_total_refund` ,	    `tpprd_selisih_premi` ,
        //                 mpol_mjns_kode,			  	 mpol_mjm_kode,
        //                 '') as tkomd_komisi,
        //                '".$pic1."' tkomd_tax_user,
        //                '".$r1['sts']."' tkomd_tax_userstatus,
        //                if('".$r1['sts']."'=1,50,0) tkomd_tax_userpersen,
        //                ".$pajak1." tkomd_tax_persen,
        //                epstfix.`F_GET_RUMUSPRODUKSI`(
        //                 'KOMISI'	,			   		`tpprd_pk`  ,
        //                 `tpprd_nomor_polish` ,   		`tpprd_jatuhtempo` ,
        //                 `tpprd_umur` ,		   		`tpprd_umur2` ,
        //                 `tpprd_tanggal_lahir` ,  		`tpprd_tanggal_lahir2` ,
        //                 `tpprd_tanggal_awal` ,   		`tpprd_tanggal_akhir` ,
        //                 `tpprd_masa_tahun` ,	   		`tpprd_masa_bulan` ,
        //                 `tpprd_up` ,			   		`tpprd_tarif_persen` ,
        //                 `tpprd_tarif` ,		   		`tpprd_admin` ,
        //                 `tpprd_admin_persen` ,   		`tpprd_disc` ,
        //                 `tpprd_disc_persen` ,	   		`tpprd_disc_ajukan`  ,
        //                 `tpprd_discpolis`  ,	   		`tpprd_discpolis_persen` ,
        //                 `tpprd_disc_lain_persen`,		`tpprd_disc_lain` ,
        //                 `tpprd_biaya_medis` ,    		`tpprd_extra` ,
        //                 `tpprd_extra_persen` ,  		`tpprd_em_persen_reas` ,
        //                 `tpprd_premi_reas` ,	  		`tpprd_up_baru` ,
        //                 `tpprd_premi` ,		  		`tpprd_premi_co` ,
        //                 `tpprd_premi_bayar`,	  		`tpprd_share` ,
        //                 `tpprd_up_persen` ,	  		`tpprd_ujroh_persen` ,
        //                 `tpprd_ujroh` ,		  		`tpprd_komisi_persen` ,
        //                 `tpprd_komisi` ,		  		`tpprd_status_usertax_persen` ,
        //                 `tpprd_status_usertax`, 		`tpprd_tax_persen` ,
        //                 `tpprd_tax` ,			  		`tpprd_komisi_bayar` ,
        //                 `tpprd_manajemenfee_persen`,  `tpprd_manajemenfee` ,
        //                 `tpprd_overidding_persen` ,   `tpprd_overidding` ,
        //                 `tpprd_referal` ,			    `tpprd_referal_persen` ,
        //                 `tpprd_maintenance` , 	    `tpprd_maintenance_persen` ,
        //                 `tpprd_handlingfee_persen` ,  `tpprd_handlingfee` ,
        //                 `tpprd_disc_ujroh` , 		    `tpprd_refund_premi` ,
        //                 `tpprd_tanggal_bayar` , 	    `tpprd_total_bayar_dtl` ,
        //                 `tpprd_total_bayar` , 	    `tpprd_status_bayar` ,
        //                 `tpprd_jenis_bayar` , 	    `tpprd_tarif_nonlife` ,
        //                 `tpprd_premi_nonlife` ,  	    `tpprd_tarif_persen_nonlife` ,
        //                 `tpprd_umur_polis` , 	  	    `tpprd_status_bayar_lain` ,
        //                 `tpprd_tanggal_bayar_lain` ,  `tpprd_total_bayar_lain` ,
        //                 `tpprd_total_bayar_disc` ,    `tpprd_tanggal_bayar_disc` ,
        //                 `tpprd_em_status`,		    `tpprd_em_tanggal` ,
        //                 `tpprd_reas_premilife` ,	    `tpprd_reas_preminonlife` ,
        //                 `tpprd_reas_ujrohreas` ,	    `tpprd_reas_tabbaru` ,
        //                 `tpprd_share_reindo` ,	    `tpprd_share_nasre` ,
        //                 `tpprd_share_alamin` ,	    `tpprd_tabaru_life` ,
        //                 `tpprd_uangkuliah_semester`  ,`tpprd_uangkuliah_tunggal` ,
        //                 `tpprd_tahun_kuliah`,		    `tpprd_masa_kuliah` ,
        //                 `tpprd_ajufee` ,			    `tpprd_ajufee_persen` ,
        //                 `tpprd_total_refund` ,	    `tpprd_selisih_premi` ,
        //                 mpol_mjns_kode,			  	 mpol_mjm_kode,
        //                 '')*".$tax1." as tkomd_tax,
        //                 1 tkomd_tipe,
        //                 now() tkomd_ins_date,
        //                 '".$user."' tkomd_ins_user,
        //                 0 tkomd_bayar,
        //                 '1881-01-01' tkomd_tglbayar,
        //                 '' tkomd_userbayar,
        //                 '' tkomd_prosesbayar,tpprd_mlok_kode  `tkomd_mlok_kode`,mpol_mrkn_kode `tkomd_mrkn_kode_induk`, mpol_kode `tkomd_mpol_kode`
        //                FROM epstfix.peserta_all
        //                LEFT JOIN eopr.mst_polis ON mpol_kode=tpprd_nomor_polish
        //                WHERE mpol_kode='".$kode_polis."' AND month(date(tpprd_insert_fix)) between '".$bln1."' and '".$bln2."'
        //                AND year(date(tpprd_insert_fix))='".$thn."' #AND tpprd_total_bayar_dtl>=tpprd_premi_bayar
        //                AND (tpprd_total_bayar_dtl-tpprd_premi_bayar)>-0.1
        //                AND IFNULL(mpol_mkom_persen,0)>0 AND IFNULL(tpprd_tax_persen,0)<1 and tpprd_mlok_kode!='01'
        //                AND if(mpol_mrkn_kode='R17000246',tpprd_mlok_kode='".$cab."',ifnull(tpprd_pk,'')!='')
        //                AND tpprd_status_klaim!=1 AND tpprd_status_refund!=1
        //                AND tpprd_status_batal!=1 AND tpprd_status_bayar='1' AND tpprd_status='1'
        //                GROUP BY tpprd_pk LIMIT 100000");

        //                Lib::__dbAll($cmd);
        //             }
        //         }
        //         //---END KONDISI KOMISI 1---//

        //         //---KONDISI KOMISI 2---//
        //         if ($pic1!='' || $pic1a!='' || $pic2!=='') {
        //             $sel1 = $r1['xlimit']-$r1['saldo'];

        //             $tax1 = DB::select("SELECT mpt_persen FROM emst.`mst_persen_tax`
        //             WHERE ".$sel1."+".$r1['saldo'].">=mpt_nilai1 AND mpt_nilai2>=".$sel1."+".$r1['saldo']."
        //             LIMIT 1");
        //             $rtax1 = Lib::__dbRow($tax1);

        //             $pajak1 = $rtax1['mpt_persen'];

        //             if ($r1['npwp']!='') {
        //                 if ($r1['sts']==1) {
        //                     $tax1 = (50/100)*($rtax1['mpt_persen']/100);
        //                 } else {
        //                     $tax1 = ($rtax1['mpt_persen']/100);
        //                 }
        //             } else {
        //                 if ($r1['sts']==1) {
        //                     $tax1 = (50/100)*($rtax1['mpt_persen']/100)*(120/100);
        //                 } else {
        //                     $tax1 = ($rtax1['mpt_persen']/100)*(120/100);
        //                 }
        //             }

        //             $cmdh = DB::select("INSERT IGNORE INTO etrs.`trs_komisi_hdr`
        //             SELECT
        //             '".$pkx."K' `tkomh_pk`,
        //             '' `tkomh_nosurat`,
        //             '' `tkomh_tanggal`,
        //             0  `tkomh_pst`,
        //             0  `tkomh_up`,
        //             0  `tkomh_komisi`,
        //             0 `tkomh_tax`,
        //             0 `tkomh_komisinett`,
        //             0 `tkomh_bayar`,
        //             '' `tkomh_bayar_tgl`,
        //             '' `tkomh_mgro_pk`,
        //             '' `tkomh_penerima`,
        //             0 tkomh_indexfolder,
        //             '' tkomh_buktibayar,
        //             NOW() `tkomh_crud`,
        //             0  `tkomh_sts1`,
        //             '' `tkomh_sts1_date`,
        //             '' `tkomh_sts1_user`,
        //             0  `tkomh_sts2`,
        //             '' `tkomh_sts2_date`,
        //             '' `tkomh_sts2_user`,
        //             0  `tkomh_sts3`,
        //             '' `tkomh_sts3_date`,
        //             '' `tkomh_sts3_user`");

        //             Lib::__dbRow($cmdh);

        //             $cmdx1 = DB::select("SELECT
        //             tpprd_pk,
        //             tpprd_up,
        //             tpprd_komisi_persen,
        //             epstfix.`F_GET_RUMUSPRODUKSI`(
        //             'KOMISI'	,			   		`tpprd_pk`  ,
        //             `tpprd_nomor_polish` ,   		`tpprd_jatuhtempo` ,
        //             `tpprd_umur` ,		   		`tpprd_umur2` ,
        //             `tpprd_tanggal_lahir` ,  		`tpprd_tanggal_lahir2` ,
        //             `tpprd_tanggal_awal` ,   		`tpprd_tanggal_akhir` ,
        //             `tpprd_masa_tahun` ,	   		`tpprd_masa_bulan` ,
        //             `tpprd_up` ,			   		`tpprd_tarif_persen` ,
        //             `tpprd_tarif` ,		   		`tpprd_admin` ,
        //             `tpprd_admin_persen` ,   		`tpprd_disc` ,
        //             `tpprd_disc_persen` ,	   		`tpprd_disc_ajukan`  ,
        //             `tpprd_discpolis`  ,	   		`tpprd_discpolis_persen` ,
        //             `tpprd_disc_lain_persen`,		`tpprd_disc_lain` ,
        //             `tpprd_biaya_medis` ,    		`tpprd_extra` ,
        //             `tpprd_extra_persen` ,  		`tpprd_em_persen_reas` ,
        //             `tpprd_premi_reas` ,	  		`tpprd_up_baru` ,
        //             `tpprd_premi` ,		  		`tpprd_premi_co` ,
        //             `tpprd_premi_bayar`,	  		`tpprd_share` ,
        //             `tpprd_up_persen` ,	  		`tpprd_ujroh_persen` ,
        //             `tpprd_ujroh` ,		  		`tpprd_komisi_persen` ,
        //             `tpprd_komisi` ,		  		`tpprd_status_usertax_persen` ,
        //             `tpprd_status_usertax`, 		`tpprd_tax_persen` ,
        //             `tpprd_tax` ,			  		`tpprd_komisi_bayar` ,
        //             `tpprd_manajemenfee_persen`,  `tpprd_manajemenfee` ,
        //             `tpprd_overidding_persen` ,   `tpprd_overidding` ,
        //             `tpprd_referal` ,			    `tpprd_referal_persen` ,
        //             `tpprd_maintenance` , 	    `tpprd_maintenance_persen` ,
        //             `tpprd_handlingfee_persen` ,  `tpprd_handlingfee` ,
        //             `tpprd_disc_ujroh` , 		    `tpprd_refund_premi` ,
        //             `tpprd_tanggal_bayar` , 	    `tpprd_total_bayar_dtl` ,
        //             `tpprd_total_bayar` , 	    `tpprd_status_bayar` ,
        //             `tpprd_jenis_bayar` , 	    `tpprd_tarif_nonlife` ,
        //             `tpprd_premi_nonlife` ,  	    `tpprd_tarif_persen_nonlife` ,
        //             `tpprd_umur_polis` , 	  	    `tpprd_status_bayar_lain` ,
        //             `tpprd_tanggal_bayar_lain` ,  `tpprd_total_bayar_lain` ,
        //             `tpprd_total_bayar_disc` ,    `tpprd_tanggal_bayar_disc` ,
        //             `tpprd_em_status`,		    `tpprd_em_tanggal` ,
        //             `tpprd_reas_premilife` ,	    `tpprd_reas_preminonlife` ,
        //             `tpprd_reas_ujrohreas` ,	    `tpprd_reas_tabbaru` ,
        //             `tpprd_share_reindo` ,	    `tpprd_share_nasre` ,
        //             `tpprd_share_alamin` ,	    `tpprd_tabaru_life` ,
        //             `tpprd_uangkuliah_semester`  ,`tpprd_uangkuliah_tunggal` ,
        //             `tpprd_tahun_kuliah`,		    `tpprd_masa_kuliah` ,
        //             `tpprd_ajufee` ,			    `tpprd_ajufee_persen` ,
        //             `tpprd_total_refund` ,	    `tpprd_selisih_premi` ,
        //             mpol_mjns_kode,			  	 mpol_mjm_kode,
        //             '') komisi
        //             FROM epstfix.peserta_all
        //             LEFT JOIN eopr.mst_polis ON mpol_kode=tpprd_nomor_polish
        //             WHERE mpol_kode='".$kode_polis."' AND month(date(tpprd_insert_fix)) between '".$bln1."' and '".$bln2."'
        //             AND year(date(tpprd_insert_fix))='".$thn."' #AND tpprd_total_bayar_dtl>=tpprd_premi_bayar
        //             AND (tpprd_total_bayar_dtl-tpprd_premi_bayar)>-0.1
        //             AND IFNULL(mpol_mkom_persen,0)>0 AND IFNULL(tpprd_tax_persen,0)<1 and tpprd_mlok_kode!='01'
        //             AND if(mpol_mrkn_kode='R17000246',tpprd_mlok_kode='".$cab."',ifnull(tpprd_pk,'')!='')
        //             AND tpprd_status_klaim!=1 AND tpprd_status_refund!=1
        //             AND tpprd_status_batal!=1 AND tpprd_status_bayar='1'
        //             AND tpprd_status='1'
        //             GROUP BY tpprd_pk LIMIT 100000");

        //             $resx1 = Lib::__dbAll($cmdx1);

        //             for ($i=0; $i < count($resx1); $i++) {
        //                 $ceklimit = DB::select("SELECT (`tkomh_komisi`+".$resx1[$i]['komisi'].") t
        //                 FROM etrs.`trs_komisi_hdr` WHERE `tkomh_pk`='".$pkx."K' LIMIT 1");
        //                 $r = Lib::__dbRow($ceklimit);

        //                 if ($r['t']<=$sel1) {
        //                     $cmd = DB::select("INSERT IGNORE INTO etrs.trs_komisi_dtl
        //                     (`tkomd_pk`,
        //                     `tkomd_tkomh_pk`,
        //                     `tkomd_tpprd_pk`,
        //                     `tkomd_up`,
        //                     `tkomd_komisi_persen`,
        //                     `tkomd_komisi`,
        //                     `tkomd_tax_user`,
        //                     `tkomd_tax_userstatus`,
        //                     `tkomd_tax_userpersen`,
        //                     `tkomd_tax_persen`,
        //                     `tkomd_tax`,
        //                     `tkomd_tipe`,
        //                     `tkomd_ins_date`,
        //                     `tkomd_ins_user`,
        //                     `tkomd_bayar`,
        //                     `tkomd_tglbayar`,
        //                     `tkomd_userbayar`,
        //                     `tkomd_prosesbayar`,
        //                     `tkomd_mlok_kode`,
        //                     `tkomd_mrkn_kode_induk`,
        //                     `tkomd_mpol_kode`)

        //                     SELECT
        //                       CONCAT('".$pkx."_','".$resx1[$i]['tpprd_pk']."') tkomd_pk,
        //                       '".$pkx."K' tkomd_tkomh_pk,
        //                       '".$resx1[$i]['tpprd_pk']."' tkomd_tpprd_pk,
        //                       '".$resx1[$i]['tpprd_up']."' tkomd_up,
        //                       '".$resx1[$i]['tpprd_komisi_persen']."' tkomd_komisi_persen,
        //                       '".$resx1[$i]['komisi']."' as tkomd_komisi,
        //                       '".$pic1."' tkomd_tax_user,
        //                       '".$r1['sts']."' tkomd_tax_userstatus,
        //                       if('".$r1['sts']."'=1,50,0) tkomd_tax_userpersen,
        //                       ".$pajak1." tkomd_tax_persen,
        //                       '".$resx1[$i]['komisi']."'*".$tax1." as tkomd_tax,
        //                       1 tkomd_tipe,
        //                       now() tkomd_ins_date,
        //                       '".$user."' tkomd_ins_user,
        //                       0 tkomd_bayar,
        //                       '1881-01-01' tkomd_tglbayar,
        //                       '' tkomd_userbayar,
        //                       '' tkomd_prosesbayar,
        //                       '' tkomd_mlok_kode,
        //                       '' tkomd_mrkn_kode_induk,
        //                       '' tkomd_mpol_kode");

        //                       Lib::__dbRow($cmd);
        //                 } else {
        //                     $i==count($resx1);
        //                 }
        //             }

        //             $sel2 = $r2['saldo']+($kom-$sel1);
        //             $tax2 = DB::select("SELECT mpt_persen FROM emst.`mst_persen_tax`
        //             WHERE ".$sel2.">=mpt_nilai1 AND mpt_nilai2>=".$sel2." LIMIT 1");
        //             $rtax2 = Lib::__dbRow($tax2);

        //             $pajak2 = $rtax2['mpt_persen'];

        //             if ($r2['npwp']!='') {
        //                 if ($r2['sts']==1) {
        //                     $tax2 = (50/100)*($rtax2['mpt_persen']/100);
        //                 } else {
        //                     $tax2 = ($rtax2['mpt_persen']/100);
        //                 }
        //             } else {
        //                 if ($r2['sts']==1) {
        //                     $tax2 = (50/100)*($rtax2['mpt_persen']/100)*(120/100);
        //                 } else {
        //                     $tax2 = ($rtax2['mpt_persen']/100)*(120/100);
        //                 }
        //             }

        //             $cmdx1a = DB::select("SELECT
        //             tpprd_pk,
        //             tpprd_up,
        //             tpprd_komisi_persen,
        //             epstfix.`F_GET_RUMUSPRODUKSI`(
        //             'KOMISI'	,			   		`tpprd_pk`  ,
        //             `tpprd_nomor_polish` ,   		`tpprd_jatuhtempo` ,
        //             `tpprd_umur` ,		   		`tpprd_umur2` ,
        //             `tpprd_tanggal_lahir` ,  		`tpprd_tanggal_lahir2` ,
        //             `tpprd_tanggal_awal` ,   		`tpprd_tanggal_akhir` ,
        //             `tpprd_masa_tahun` ,	   		`tpprd_masa_bulan` ,
        //             `tpprd_up` ,			   		`tpprd_tarif_persen` ,
        //             `tpprd_tarif` ,		   		`tpprd_admin` ,
        //             `tpprd_admin_persen` ,   		`tpprd_disc` ,
        //             `tpprd_disc_persen` ,	   		`tpprd_disc_ajukan`  ,
        //             `tpprd_discpolis`  ,	   		`tpprd_discpolis_persen` ,
        //             `tpprd_disc_lain_persen`,		`tpprd_disc_lain` ,
        //             `tpprd_biaya_medis` ,    		`tpprd_extra` ,
        //             `tpprd_extra_persen` ,  		`tpprd_em_persen_reas` ,
        //             `tpprd_premi_reas` ,	  		`tpprd_up_baru` ,
        //             `tpprd_premi` ,		  		`tpprd_premi_co` ,
        //             `tpprd_premi_bayar`,	  		`tpprd_share` ,
        //             `tpprd_up_persen` ,	  		`tpprd_ujroh_persen` ,
        //             `tpprd_ujroh` ,		  		`tpprd_komisi_persen` ,
        //             `tpprd_komisi` ,		  		`tpprd_status_usertax_persen` ,
        //             `tpprd_status_usertax`, 		`tpprd_tax_persen` ,
        //             `tpprd_tax` ,			  		`tpprd_komisi_bayar` ,
        //             `tpprd_manajemenfee_persen`,  `tpprd_manajemenfee` ,
        //             `tpprd_overidding_persen` ,   `tpprd_overidding` ,
        //             `tpprd_referal` ,			    `tpprd_referal_persen` ,
        //             `tpprd_maintenance` , 	    `tpprd_maintenance_persen` ,
        //             `tpprd_handlingfee_persen` ,  `tpprd_handlingfee` ,
        //             `tpprd_disc_ujroh` , 		    `tpprd_refund_premi` ,
        //             `tpprd_tanggal_bayar` , 	    `tpprd_total_bayar_dtl` ,
        //             `tpprd_total_bayar` , 	    `tpprd_status_bayar` ,
        //             `tpprd_jenis_bayar` , 	    `tpprd_tarif_nonlife` ,
        //             `tpprd_premi_nonlife` ,  	    `tpprd_tarif_persen_nonlife` ,
        //             `tpprd_umur_polis` , 	  	    `tpprd_status_bayar_lain` ,
        //             `tpprd_tanggal_bayar_lain` ,  `tpprd_total_bayar_lain` ,
        //             `tpprd_total_bayar_disc` ,    `tpprd_tanggal_bayar_disc` ,
        //             `tpprd_em_status`,		    `tpprd_em_tanggal` ,
        //             `tpprd_reas_premilife` ,	    `tpprd_reas_preminonlife` ,
        //             `tpprd_reas_ujrohreas` ,	    `tpprd_reas_tabbaru` ,
        //             `tpprd_share_reindo` ,	    `tpprd_share_nasre` ,
        //             `tpprd_share_alamin` ,	    `tpprd_tabaru_life` ,
        //             `tpprd_uangkuliah_semester`  ,`tpprd_uangkuliah_tunggal` ,
        //             `tpprd_tahun_kuliah`,		    `tpprd_masa_kuliah` ,
        //             `tpprd_ajufee` ,			    `tpprd_ajufee_persen` ,
        //             `tpprd_total_refund` ,	    `tpprd_selisih_premi` ,
        //             mpol_mjns_kode,			  	 mpol_mjm_kode,
        //             '') komisi
        //             FROM epstfix.peserta_all
        //             LEFT JOIN eopr.mst_polis ON mpol_kode=tpprd_nomor_polish
        //             WHERE mpol_kode='".$kode_polis."' AND month(date(tpprd_insert_fix)) between '".$bln1."' and '".$bln2."'
        //             AND year(date(tpprd_insert_fix))='".$thn."' #AND tpprd_total_bayar_dtl>=tpprd_premi_bayar
        //             AND (tpprd_total_bayar_dtl-tpprd_premi_bayar)>-0.1
        //             AND IFNULL(mpol_mkom_persen,0)>0 AND IFNULL(tpprd_tax_persen,0)<1 and tpprd_mlok_kode!='01'
        //             AND tpprd_status_klaim!=1 AND tpprd_status_refund!=1
        //             AND if(mpol_mrkn_kode='R17000246',tpprd_mlok_kode='".$cab."',ifnull(tpprd_pk,'')!='')
        //             AND tpprd_status_batal!=1 AND tpprd_status_bayar='1'
        //             AND tpprd_status='1'
        //             AND tpprd_pk not in (select tkomd_tpprd_pk FROM etrs.trs_komisi_dtl WHERE tkomd_tkomh_pk='".$pkx."K' )
        //             GROUP BY tpprd_pk LIMIT 100000");
        //             $resx1a = Lib::__dbAll($cmdx1a);

        //             for ($i=0; $i < count($resx1a); $i++) {
        //                 $ceklimit = DB::select("SELECT `tkomh_komisi` t FROM etrs.`trs_komisi_hdr`
        //                 WHERE `tkomh_pk`='".$pkx."K' LIMIT 1");
        //                 $r =Lib::__dbRow($ceklimit);

        //                 if ($r['t']<=($kom-$sel1)) {
        //                     $cmd = DB::select("INSERT IGNORE INTO etrs.trs_komisi_dtl
        //                     (`tkomd_pk`,
        //                     `tkomd_tkomh_pk`,
        //                     `tkomd_tpprd_pk`,
        //                     `tkomd_up`,
        //                     `tkomd_komisi_persen`,
        //                     `tkomd_komisi`,
        //                     `tkomd_tax_user`,
        //                     `tkomd_tax_userstatus`,
        //                     `tkomd_tax_userpersen`,
        //                     `tkomd_tax_persen`,
        //                     `tkomd_tax`,
        //                     `tkomd_tipe`,
        //                     `tkomd_ins_date`,
        //                     `tkomd_ins_user`,
        //                     `tkomd_bayar`,
        //                     `tkomd_tglbayar`,
        //                     `tkomd_userbayar`,
        //                     `tkomd_prosesbayar`,
        //                     `tkomd_mlok_kode`,
        //                     `tkomd_mrkn_kode_induk`,
        //                     `tkomd_mpol_kode`)
        //                     SELECT
        //                       CONCAT('".$pkx."_','".$resx1a[$i]['tpprd_pk']."') tkomd_pk,
        //                       '".$pkx."K' tkomd_tkomh_pk,
        //                       '".$resx1a[$i]['tpprd_pk']."' tkomd_tpprd_pk,
        //                       '".$resx1a[$i]['tpprd_up']."' tkomd_up,
        //                       '".$resx1a[$i]['tpprd_komisi_persen']."' tkomd_komisi_persen,
        //                       '".$resx1a[$i]['komisi']."' as tkomd_komisi,
        //                       '".$pic1a."' tkomd_tax_user,
        //                       '".$r2['sts']."' tkomd_tax_userstatus,
        //                       if('".$r2['sts']."'=1,50,0) tkomd_tax_userpersen,
        //                       ".$pajak2." tkomd_tax_persen,
        //                       '".$resx1a[$i]['komisi']."'*".$tax2." as tkomd_tax,
        //                       1 tkomd_tipe,
        //                       now() tkomd_ins_date,
        //                       '".$user."' tkomd_ins_user,
        //                       0 tkomd_bayar,
        //                       '1881-01-01' tkomd_tglbayar,
        //                       '' tkomd_userbayar,
        //                       '' tkomd_prosesbayar,'','',''");

        //                       Lib::__dbRow($cmd);
        //                 } else {
        //                     $i==count($resx1);
        //                 }
        //             }

        //             $sel2 = $r2['saldo']+($kom-$sel1);
        //             $tax2 = DB::select("SELECT mpt_persen FROM emst.`mst_persen_tax`
        //             WHERE ".$sel2.">=mpt_nilai1 AND mpt_nilai2>=".$sel2." LIMIT 1");
        //             $rtax2 = Lib::__dbRow($tax2);

        //             $pajak2 = $rtax2['mpt_persen'];

        //             if ($r2['npwp']!='') {
        //                 if ($r2['sts']==1) {
        //                     $tax2 = (50/100)*($rtax2['mpt_persen']/100);
        //                 } else {
        //                     $tax2 = ($rtax2['mpt_persen']/100);
        //                 }
        //             } else {
        //                 if ($r2['sts']==1) {
        //                     $tax2 = (50/100)*($rtax2['mpt_persen']/100)*(120/100);
        //                 } else {
        //                     $tax2 = ($rtax2['mpt_persen']/100)*(120/100);
        //                 }
        //             }

        //             $cmdxx = DB::select("SELECT
        //             tpprd_pk,
        //             tpprd_up,
        //             tpprd_komisi_persen,
        //             epstfix.`F_GET_RUMUSPRODUKSI`(
        //             'KOMISI'	,			   		`tpprd_pk`  ,
        //             `tpprd_nomor_polish` ,   		`tpprd_jatuhtempo` ,
        //             `tpprd_umur` ,		   		`tpprd_umur2` ,
        //             `tpprd_tanggal_lahir` ,  		`tpprd_tanggal_lahir2` ,
        //             `tpprd_tanggal_awal` ,   		`tpprd_tanggal_akhir` ,
        //             `tpprd_masa_tahun` ,	   		`tpprd_masa_bulan` ,
        //             `tpprd_up` ,			   		`tpprd_tarif_persen` ,
        //             `tpprd_tarif` ,		   		`tpprd_admin` ,
        //             `tpprd_admin_persen` ,   		`tpprd_disc` ,
        //             `tpprd_disc_persen` ,	   		`tpprd_disc_ajukan`  ,
        //             `tpprd_discpolis`  ,	   		`tpprd_discpolis_persen` ,
        //             `tpprd_disc_lain_persen`,		`tpprd_disc_lain` ,
        //             `tpprd_biaya_medis` ,    		`tpprd_extra` ,
        //             `tpprd_extra_persen` ,  		`tpprd_em_persen_reas` ,
        //             `tpprd_premi_reas` ,	  		`tpprd_up_baru` ,
        //             `tpprd_premi` ,		  		`tpprd_premi_co` ,
        //             `tpprd_premi_bayar`,	  		`tpprd_share` ,
        //             `tpprd_up_persen` ,	  		`tpprd_ujroh_persen` ,
        //             `tpprd_ujroh` ,		  		`tpprd_komisi_persen` ,
        //             `tpprd_komisi` ,		  		`tpprd_status_usertax_persen` ,
        //             `tpprd_status_usertax`, 		`tpprd_tax_persen` ,
        //             `tpprd_tax` ,			  		`tpprd_komisi_bayar` ,
        //             `tpprd_manajemenfee_persen`,  `tpprd_manajemenfee` ,
        //             `tpprd_overidding_persen` ,   `tpprd_overidding` ,
        //             `tpprd_referal` ,			    `tpprd_referal_persen` ,
        //             `tpprd_maintenance` , 	    `tpprd_maintenance_persen` ,
        //             `tpprd_handlingfee_persen` ,  `tpprd_handlingfee` ,
        //             `tpprd_disc_ujroh` , 		    `tpprd_refund_premi` ,
        //             `tpprd_tanggal_bayar` , 	    `tpprd_total_bayar_dtl` ,
        //             `tpprd_total_bayar` , 	    `tpprd_status_bayar` ,
        //             `tpprd_jenis_bayar` , 	    `tpprd_tarif_nonlife` ,
        //             `tpprd_premi_nonlife` ,  	    `tpprd_tarif_persen_nonlife` ,
        //             `tpprd_umur_polis` , 	  	    `tpprd_status_bayar_lain` ,
        //             `tpprd_tanggal_bayar_lain` ,  `tpprd_total_bayar_lain` ,
        //             `tpprd_total_bayar_disc` ,    `tpprd_tanggal_bayar_disc` ,
        //             `tpprd_em_status`,		    `tpprd_em_tanggal` ,
        //             `tpprd_reas_premilife` ,	    `tpprd_reas_preminonlife` ,
        //             `tpprd_reas_ujrohreas` ,	    `tpprd_reas_tabbaru` ,
        //             `tpprd_share_reindo` ,	    `tpprd_share_nasre` ,
        //             `tpprd_share_alamin` ,	    `tpprd_tabaru_life` ,
        //             `tpprd_uangkuliah_semester`  ,`tpprd_uangkuliah_tunggal` ,
        //             `tpprd_tahun_kuliah`,		    `tpprd_masa_kuliah` ,
        //             `tpprd_ajufee` ,			    `tpprd_ajufee_persen` ,
        //             `tpprd_total_refund` ,	    `tpprd_selisih_premi` ,
        //             mpol_mjns_kode,			  	 mpol_mjm_kode,
        //             '') as komisi
        //             FROM epstfix.peserta_all
        //             LEFT JOIN eopr.mst_polis ON mpol_kode=tpprd_nomor_polish
        //             WHERE mpol_kode='".$kode_polis."' AND month(date(tpprd_insert_fix)) between '".$bln1."' and '".$bln2."'
        //             AND year(date(tpprd_insert_fix))='".$thn."' #AND tpprd_total_bayar_dtl>=tpprd_premi_bayar
        //             AND (tpprd_total_bayar_dtl-tpprd_premi_bayar)>-0.1
        //             AND IFNULL(mpol_mkom_persen,0)>0 AND IFNULL(tpprd_tax_persen,0)<1 and tpprd_mlok_kode!='01'
        //             AND if(mpol_mrkn_kode='R17000246',tpprd_mlok_kode='".$cab."',ifnull(tpprd_pk,'')!='')
        //             AND tpprd_status_klaim!=1 AND tpprd_status_refund!=1
        //             AND tpprd_status_batal!=1 AND tpprd_status_bayar='1'
        //             AND tpprd_status='1'
        //             AND tpprd_pk not in (select tkomd_tpprd_pk FROM etrs.trs_komisi_dtl WHERE tkomd_tkomh_pk='".$pkx."K' )
        //             GROUP BY tpprd_pk LIMIT 100000");

        //             $resx1a = Lib::__dbAll($cmdxx);

        //             for ($i=0; $i < count($resx1a); $i++) {
        //                 $cmd = DB::select("INSERT IGNORE INTO etrs.trs_komisi_dtl
        //                 (`tkomd_pk`,
        //                  `tkomd_tkomh_pk`,
        //                  `tkomd_tpprd_pk`,
        //                  `tkomd_up`,
        //                  `tkomd_komisi_persen`,
        //                  `tkomd_komisi`,
        //                  `tkomd_tax_user`,
        //                  `tkomd_tax_userstatus`,
        //                  `tkomd_tax_userpersen`,
        //                  `tkomd_tax_persen`,
        //                  `tkomd_tax`,
        //                  `tkomd_tipe`,
        //                  `tkomd_ins_date`,
        //                  `tkomd_ins_user`,
        //                  `tkomd_bayar`,
        //                  `tkomd_tglbayar`,
        //                  `tkomd_userbayar`,
        //                  `tkomd_prosesbayar`,
        //                  `tkomd_mlok_kode`,
        //                  `tkomd_mrkn_kode_induk`,
        //                  `tkomd_mpol_kode`)
        //                 SELECT
        //                   CONCAT('".$pkx."_','".$resx1a[$i]['tpprd_pk']."') tkomd_pk,
        //                   '".$pkx."K' tkomd_tkomh_pk,
        //                   '".$resx1a[$i]['tpprd_pk']."' tkomd_tpprd_pk,
        //                   '".$resx1a[$i]['tpprd_up']."' tkomd_up,
        //                   '".$resx1a[$i]['tpprd_komisi_persen']."' tkomd_komisi_persen,
        //                   '".$resx1a[$i]['komisi']."' as tkomd_komisi,
        //                   '".$pic1a."' tkomd_tax_user,
        //                   '".$r2['sts']."' tkomd_tax_userstatus,
        //                   if('".$r2['sts']."'=1,50,0) tkomd_tax_userpersen,
        //                   ".$pajak2." tkomd_tax_persen,
        //                   '".$resx1a[$i]['komisi']."'*".$tax2." as tkomd_tax,
        //                   1 tkomd_tipe,
        //                   now() tkomd_ins_date,
        //                   '".$user."' tkomd_ins_user,
        //                   0 tkomd_bayar,
        //                   '1881-01-01' tkomd_tglbayar,
        //                   '' tkomd_userbayar,
        //                   '' tkomd_prosesbayar,'','',''");

        //                 Lib::__dbRow($cmd);
        //             }

        //         }
        //         //---END KONDISI KOMISI 2---//

        //         //---KONDISI KOMISI 3---//
        //         if ($pic1!='' || $pic1a!='' || $pic2!='') {
        //             $sel1 = $r1['xlimit']-$r1['saldo'];

        //             $tax1 = DB::select("SELECT mpt_persen FROM emst.`mst_persen_tax`
        //             WHERE ".$sel1."+".$r1['saldo'].">=mpt_nilai1 AND mpt_nilai2>=".$sel1."+".$r1['saldo']."
        //             LIMIT 1");
        //             $rtax1 = Lib::__dbRow($tax1);

        //             $pajak1 = $rtax1['mpt_persen'];

        //             if ($r1['npwp']!='') {
        //                 if ($r1['sts']==1) {
        //                     $tax1 = (50/100)*($rtax1['mpt_persen']/100);
        //                 } else {
        //                     $tax1 = ($rtax1['mpt_persen']/100);
        //                 }
        //             } else {
        //                 if ($r1['sts']==1) {
        //                     $tax1 = (50/100)*($rtax1['mpt_persen']/100)*(120/100);
        //                 } else {
        //                     $tax1 = ($rtax1['mpt_persen']/100);
        //                 }
        //             }

        //             $cmdh = DB::select("INSERT IGNORE INTO etrs.`trs_komisi_hdr`
        //             SELECT
        //             '".$pkx."K' `tkomh_pk`,
        //             '' `tkomh_nosurat`,
        //             '' `tkomh_tanggal`,
        //             0  `tkomh_pst`,
        //             0  `tkomh_up`,
        //             0  `tkomh_komisi`,
        //             0 `tkomh_tax`,
        //             0 `tkomh_komisinett`,
        //             0 `tkomh_bayar`,
        //             '' `tkomh_bayar_tgl`,
        //             '' `tkomh_mgro_pk`,
        //             '' `tkomh_penerima`,
        //             0 tkomh_indexfolder,
        //             '' tkomh_buktibayar,
        //             NOW() `tkomh_crud`,
        //             0  `tkomh_sts1`,
        //             '' `tkomh_sts1_date`,
        //             '' `tkomh_sts1_user`,
        //             0  `tkomh_sts2`,
        //             '' `tkomh_sts2_date`,
        //             '' `tkomh_sts2_user`,
        //             0  `tkomh_sts3`,
        //             '' `tkomh_sts3_date`,
        //             '' `tkomh_sts3_user`");

        //             Lib::__dbRow($cmdh);

        //             $cmdx1 = DB::select("SELECT
        //             tpprd_pk,
        //             tpprd_up,
        //             tpprd_komisi_persen,
        //             epstfix.`F_GET_RUMUSPRODUKSI`(
        //             'KOMISI'	,			   		`tpprd_pk`  ,
        //             `tpprd_nomor_polish` ,   		`tpprd_jatuhtempo` ,
        //             `tpprd_umur` ,		   		`tpprd_umur2` ,
        //             `tpprd_tanggal_lahir` ,  		`tpprd_tanggal_lahir2` ,
        //             `tpprd_tanggal_awal` ,   		`tpprd_tanggal_akhir` ,
        //             `tpprd_masa_tahun` ,	   		`tpprd_masa_bulan` ,
        //             `tpprd_up` ,			   		`tpprd_tarif_persen` ,
        //             `tpprd_tarif` ,		   		`tpprd_admin` ,
        //             `tpprd_admin_persen` ,   		`tpprd_disc` ,
        //             `tpprd_disc_persen` ,	   		`tpprd_disc_ajukan`  ,
        //             `tpprd_discpolis`  ,	   		`tpprd_discpolis_persen` ,
        //             `tpprd_disc_lain_persen`,		`tpprd_disc_lain` ,
        //             `tpprd_biaya_medis` ,    		`tpprd_extra` ,
        //             `tpprd_extra_persen` ,  		`tpprd_em_persen_reas` ,
        //             `tpprd_premi_reas` ,	  		`tpprd_up_baru` ,
        //             `tpprd_premi` ,		  		`tpprd_premi_co` ,
        //             `tpprd_premi_bayar`,	  		`tpprd_share` ,
        //             `tpprd_up_persen` ,	  		`tpprd_ujroh_persen` ,
        //             `tpprd_ujroh` ,		  		`tpprd_komisi_persen` ,
        //             `tpprd_komisi` ,		  		`tpprd_status_usertax_persen` ,
        //             `tpprd_status_usertax`, 		`tpprd_tax_persen` ,
        //             `tpprd_tax` ,			  		`tpprd_komisi_bayar` ,
        //             `tpprd_manajemenfee_persen`,  `tpprd_manajemenfee` ,
        //             `tpprd_overidding_persen` ,   `tpprd_overidding` ,
        //             `tpprd_referal` ,			    `tpprd_referal_persen` ,
        //             `tpprd_maintenance` , 	    `tpprd_maintenance_persen` ,
        //             `tpprd_handlingfee_persen` ,  `tpprd_handlingfee` ,
        //             `tpprd_disc_ujroh` , 		    `tpprd_refund_premi` ,
        //             `tpprd_tanggal_bayar` , 	    `tpprd_total_bayar_dtl` ,
        //             `tpprd_total_bayar` , 	    `tpprd_status_bayar` ,
        //             `tpprd_jenis_bayar` , 	    `tpprd_tarif_nonlife` ,
        //             `tpprd_premi_nonlife` ,  	    `tpprd_tarif_persen_nonlife` ,
        //             `tpprd_umur_polis` , 	  	    `tpprd_status_bayar_lain` ,
        //             `tpprd_tanggal_bayar_lain` ,  `tpprd_total_bayar_lain` ,
        //             `tpprd_total_bayar_disc` ,    `tpprd_tanggal_bayar_disc` ,
        //             `tpprd_em_status`,		    `tpprd_em_tanggal` ,
        //             `tpprd_reas_premilife` ,	    `tpprd_reas_preminonlife` ,
        //             `tpprd_reas_ujrohreas` ,	    `tpprd_reas_tabbaru` ,
        //             `tpprd_share_reindo` ,	    `tpprd_share_nasre` ,
        //             `tpprd_share_alamin` ,	    `tpprd_tabaru_life` ,
        //             `tpprd_uangkuliah_semester`  ,`tpprd_uangkuliah_tunggal` ,
        //             `tpprd_tahun_kuliah`,		    `tpprd_masa_kuliah` ,
        //             `tpprd_ajufee` ,			    `tpprd_ajufee_persen` ,
        //             `tpprd_total_refund` ,	    `tpprd_selisih_premi` ,
        //             mpol_mjns_kode,			  	 mpol_mjm_kode,
        //             '') komisi
        //             FROM epstfix.peserta_all
        //             LEFT JOIN eopr.mst_polis ON mpol_kode=tpprd_nomor_polish
        //             WHERE mpol_kode='".$kode_polis."' AND month(date(tpprd_insert_fix)) between '".$bln1."' and '".$bln2."'
        //             AND year(date(tpprd_insert_fix))='".$thn."' #AND tpprd_total_bayar_dtl>=tpprd_premi_bayar
        //             AND (tpprd_total_bayar_dtl-tpprd_premi_bayar)>-0.1
        //             AND IFNULL(mpol_mkom_persen,0)>0 AND IFNULL(tpprd_tax_persen,0)<1 and tpprd_mlok_kode!='01'
        //             AND if(mpol_mrkn_kode='R17000246',tpprd_mlok_kode='".$cab."',ifnull(tpprd_pk,'')!='')
        //             AND tpprd_status_klaim!=1 AND tpprd_status_refund!=1
        //             AND tpprd_status_batal!=1 AND tpprd_status_bayar='1'
        //             AND tpprd_status='1'
        //             GROUP BY tpprd_pk LIMIT 100000");
        //             $resx1 = Lib::__dbAll($cmdx1);

        //             for ($i=0; $i < count($resx1); $i++) {

        //                 $ceklimit = DB::select("SELECT `tkomh_komisi` t FROM etrs.`trs_komisi_hdr`
        //                 WHERE `tkomh_pk`='".$pkx."K' LIMIT 1");
        //                 $r = Lib::__dbRow($ceklimit);

        //                 if ($r['t']<=$sel1) {
        //                     $cmd = DB::select("INSERT IGNORE INTO etrs.trs_komisi_dtl
        //                     (`tkomd_pk`,
        //                     `tkomd_tkomh_pk`,
        //                     `tkomd_tpprd_pk`,
        //                     `tkomd_up`,
        //                     `tkomd_komisi_persen`,
        //                     `tkomd_komisi`,
        //                     `tkomd_tax_user`,
        //                     `tkomd_tax_userstatus`,
        //                     `tkomd_tax_userpersen`,
        //                     `tkomd_tax_persen`,
        //                     `tkomd_tax`,
        //                     `tkomd_tipe`,
        //                     `tkomd_ins_date`,
        //                     `tkomd_ins_user`,
        //                     `tkomd_bayar`,
        //                     `tkomd_tglbayar`,
        //                     `tkomd_userbayar`,
        //                     `tkomd_prosesbayar`,
        //                     `tkomd_mlok_kode`,
        //                     `tkomd_mrkn_kode_induk`,
        //                     `tkomd_mpol_kode`)
        //                     SELECT
        //                       CONCAT('".$pkx."_','".$resx1[$i]['tpprd_pk']."') tkomd_pk,
        //                       '".$pkx."K' tkomd_tkomh_pk,
        //                       '".$resx1[$i]['tpprd_pk']."' tkomd_tpprd_pk,
        //                       '".$resx1[$i]['tpprd_up']."' tkomd_up,
        //                       '".$resx1[$i]['tpprd_komisi_persen']."' tkomd_komisi_persen,
        //                       '".$resx1[$i]['komisi']."' as tkomd_komisi,
        //                       '".$pic1."' tkomd_tax_user,
        //                       '".$r1['sts']."' tkomd_tax_userstatus,
        //                       if('".$r1['sts']."'=1,50,0) tkomd_tax_userpersen,
        //                       ".$pajak1." tkomd_tax_persen,
        //                       '".$resx1[$i]['komisi']."'*".$tax1." as tkomd_tax,
        //                       1 tkomd_tipe,
        //                       now() tkomd_ins_date,
        //                       '".$user."' tkomd_ins_user,
        //                       0 tkomd_bayar,
        //                       '1881-01-01' tkomd_tglbayar,
        //                       '' tkomd_userbayar,
        //                       '' tkomd_prosesbayar,,'','',''");

        //                     Lib::__dbRow($cmd);
        //                 } else {
        //                     $i==count($resx1);
        //                 }
        //             }

        //             $sel2 = $r2['saldo']+($kom-$sel1);
        //             $tax2 = DB::select("SELECT mpt_persen FROM emst.`mst_persen_tax`
        //             WHERE ".$sel2.">=mpt_nilai1 AND mpt_nilai2>=".$sel2." LIMIT 1");
        //             $rtax2 = Lib::__dbRow($tax2);

        //             $pajak2 = $rtax2['mpt_persen'];

        //             if ($r2['npwp']!='') {
        //                 if ($r2['sts']==1) {
        //                     $tax2 = (50/100)*($rtax2['mpt_persen']/100);
        //                 } else {
        //                     $tax2 = ($rtax2['mpt_persen']/100);
        //                 }
        //             } else {
        //                 if ($r2['sts']==1) {
        //                     $tax2 = (50/100)*($rtax2['mpt_persen']/100)*(120/100);
        //                 } else {
        //                     $tax2 = ($rtax2['mpt_persen']/100)*(120/100);
        //                 }
        //             }

        //             $cmdx1a = DB::select("SELECT
        //             tpprd_pk,
        //             tpprd_up,
        //             tpprd_komisi_persen,
        //             epstfix.`F_GET_RUMUSPRODUKSI`(
        //             'KOMISI'	,			   		`tpprd_pk`  ,
        //             `tpprd_nomor_polish` ,   		`tpprd_jatuhtempo` ,
        //             `tpprd_umur` ,		   		`tpprd_umur2` ,
        //             `tpprd_tanggal_lahir` ,  		`tpprd_tanggal_lahir2` ,
        //             `tpprd_tanggal_awal` ,   		`tpprd_tanggal_akhir` ,
        //             `tpprd_masa_tahun` ,	   		`tpprd_masa_bulan` ,
        //             `tpprd_up` ,			   		`tpprd_tarif_persen` ,
        //             `tpprd_tarif` ,		   		`tpprd_admin` ,
        //             `tpprd_admin_persen` ,   		`tpprd_disc` ,
        //             `tpprd_disc_persen` ,	   		`tpprd_disc_ajukan`  ,
        //             `tpprd_discpolis`  ,	   		`tpprd_discpolis_persen` ,
        //             `tpprd_disc_lain_persen`,		`tpprd_disc_lain` ,
        //             `tpprd_biaya_medis` ,    		`tpprd_extra` ,
        //             `tpprd_extra_persen` ,  		`tpprd_em_persen_reas` ,
        //             `tpprd_premi_reas` ,	  		`tpprd_up_baru` ,
        //             `tpprd_premi` ,		  		`tpprd_premi_co` ,
        //             `tpprd_premi_bayar`,	  		`tpprd_share` ,
        //             `tpprd_up_persen` ,	  		`tpprd_ujroh_persen` ,
        //             `tpprd_ujroh` ,		  		`tpprd_komisi_persen` ,
        //             `tpprd_komisi` ,		  		`tpprd_status_usertax_persen` ,
        //             `tpprd_status_usertax`, 		`tpprd_tax_persen` ,
        //             `tpprd_tax` ,			  		`tpprd_komisi_bayar` ,
        //             `tpprd_manajemenfee_persen`,  `tpprd_manajemenfee` ,
        //             `tpprd_overidding_persen` ,   `tpprd_overidding` ,
        //             `tpprd_referal` ,			    `tpprd_referal_persen` ,
        //             `tpprd_maintenance` , 	    `tpprd_maintenance_persen` ,
        //             `tpprd_handlingfee_persen` ,  `tpprd_handlingfee` ,
        //             `tpprd_disc_ujroh` , 		    `tpprd_refund_premi` ,
        //             `tpprd_tanggal_bayar` , 	    `tpprd_total_bayar_dtl` ,
        //             `tpprd_total_bayar` , 	    `tpprd_status_bayar` ,
        //             `tpprd_jenis_bayar` , 	    `tpprd_tarif_nonlife` ,
        //             `tpprd_premi_nonlife` ,  	    `tpprd_tarif_persen_nonlife` ,
        //             `tpprd_umur_polis` , 	  	    `tpprd_status_bayar_lain` ,
        //             `tpprd_tanggal_bayar_lain` ,  `tpprd_total_bayar_lain` ,
        //             `tpprd_total_bayar_disc` ,    `tpprd_tanggal_bayar_disc` ,
        //             `tpprd_em_status`,		    `tpprd_em_tanggal` ,
        //             `tpprd_reas_premilife` ,	    `tpprd_reas_preminonlife` ,
        //             `tpprd_reas_ujrohreas` ,	    `tpprd_reas_tabbaru` ,
        //             `tpprd_share_reindo` ,	    `tpprd_share_nasre` ,
        //             `tpprd_share_alamin` ,	    `tpprd_tabaru_life` ,
        //             `tpprd_uangkuliah_semester`  ,`tpprd_uangkuliah_tunggal` ,
        //             `tpprd_tahun_kuliah`,		    `tpprd_masa_kuliah` ,
        //             `tpprd_ajufee` ,			    `tpprd_ajufee_persen` ,
        //             `tpprd_total_refund` ,	    `tpprd_selisih_premi` ,
        //             mpol_mjns_kode,			  	 mpol_mjm_kode,
        //             '') komisi
        //             FROM epstfix.peserta_all
        //             LEFT JOIN eopr.mst_polis ON mpol_kode=tpprd_nomor_polish
        //             WHERE mpol_kode='".$kode_polis."' AND month(date(tpprd_insert_fix)) between '".$bln1."' and '".$bln2."'
        //             AND year(date(tpprd_insert_fix))='".$thn."' #AND tpprd_total_bayar_dtl>=tpprd_premi_bayar
        //             AND (tpprd_total_bayar_dtl-tpprd_premi_bayar)>-0.1
        //             AND IFNULL(mpol_mkom_persen,0)>0 AND IFNULL(tpprd_tax_persen,0)<1 and tpprd_mlok_kode!='01'
        //             AND tpprd_status_klaim!=1 AND tpprd_status_refund!=1
        //             AND if(mpol_mrkn_kode='R17000246',tpprd_mlok_kode='".$cab."',ifnull(tpprd_pk,'')!='')
        //             AND tpprd_status_batal!=1 AND tpprd_status_bayar='1'
        //             AND tpprd_status='1'
        //             AND tpprd_pk not in (select tkomd_tpprd_pk FROM etrs.trs_komisi_dtl WHERE tkomd_tkomh_pk='".$pkx."K' )
        //             GROUP BY tpprd_pk LIMIT 100000");

        //             $resx1a = Lib::__dbAll($cmdx1a);

        //             for ($i=0; $i < count($resx1a); $i++) {

        //                 $ceklimit = DB::select("SELECT `tkomh_komisi` t FROM etrs.`trs_komisi_hdr`
        //                 WHERE `tkomh_pk`='".$pkx."K' LIMIT 1");
        //                 $r = Lib::__dbRow($ceklimit);

        //                 if ($r['t']<=($kom-$sel1)) {
        //                     $cmd = DB::select("INSERT IGNORE INTO etrs.trs_komisi_dtl
        //                     (`tkomd_pk`,
        //                     `tkomd_tkomh_pk`,
        //                     `tkomd_tpprd_pk`,
        //                     `tkomd_up`,
        //                     `tkomd_komisi_persen`,
        //                     `tkomd_komisi`,
        //                     `tkomd_tax_user`,
        //                     `tkomd_tax_userstatus`,
        //                     `tkomd_tax_userpersen`,
        //                     `tkomd_tax_persen`,
        //                     `tkomd_tax`,
        //                     `tkomd_tipe`,
        //                     `tkomd_ins_date`,
        //                     `tkomd_ins_user`,
        //                     `tkomd_bayar`,
        //                     `tkomd_tglbayar`,
        //                     `tkomd_userbayar`,
        //                     `tkomd_prosesbayar`,
        //                     `tkomd_mlok_kode`,
        //                     `tkomd_mrkn_kode_induk`,
        //                     `tkomd_mpol_kode`)
        //                     SELECT
        //                       CONCAT('".$pkx."_','".$resx1a[$i]['tpprd_pk']."') tkomd_pk,
        //                       '".$pkx."K' tkomd_tkomh_pk,
        //                       '".$resx1a[$i]['tpprd_pk']."' tkomd_tpprd_pk,
        //                       '".$resx1a[$i]['tpprd_up']."' tkomd_up,
        //                       '".$resx1a[$i]['tpprd_komisi_persen']."' tkomd_komisi_persen,
        //                       '".$resx1a[$i]['komisi']."' as tkomd_komisi,
        //                       '".$pic1a."' tkomd_tax_user,
        //                       '".$r2['sts']."' tkomd_tax_userstatus,
        //                       if('".$r2['sts']."'=1,50,0) tkomd_tax_userpersen,
        //                       ".$pajak2." tkomd_tax_persen,
        //                       '".$resx1a[$i]['komisi']."'*".$tax2." as tkomd_tax,
        //                       1 tkomd_tipe,
        //                       now() tkomd_ins_date,
        //                       '".$user."' tkomd_ins_user,
        //                       0 tkomd_bayar,
        //                       '1881-01-01' tkomd_tglbayar,
        //                       '' tkomd_userbayar,
        //                       '' tkomd_prosesbayar,'','',''");
        //                     Lib::__dbRow($cmd);
        //                 } else {
        //                     $i==count($resx1);
        //                 }
        //             }

        //             $sel3 = $r3['saldo']+($kom-$sel1-$sel2);
        //             $tax3 = DB::select("SELECT mpt_persen FROM emst.`mst_persen_tax`
        //             WHERE ".$sel3.">=mpt_nilai1 AND mpt_nilai2>=".$sel3." LIMIT 1");
        //             $rtax3 = Lib::__dbRow($tax3);

        //             $pajak3 = $rtax3['mpt_persen'];

        //             if ($r3['npwp']!='') {
        //                 if ($r['sts']==1) {
        //                     $tax3 = (50/100)*($rtax3['mpt_persen']/100);
        //                 } else {
        //                     $rax3 = ($rtax3['mpt_persen']/100);
        //                 }
        //             } else {
        //                 if ($r3['sts']==1) {
        //                     $tax3 = (50/100)*($rtax3['mpt_persen']/100)*(120/100);
        //                 } else {
        //                     $tax3 = ($rtax3['mpt_persen']/100)*(120/100);
        //                 }
        //             }

        //             $cmdb = DB::select("SELECT
        //             tpprd_pk,
        //             tpprd_up,
        //             tpprd_komisi_persen,
        //             epstfix.`F_GET_RUMUSPRODUKSI`(
        //             'KOMISI'	,			   		`tpprd_pk`  ,
        //             `tpprd_nomor_polish` ,   		`tpprd_jatuhtempo` ,
        //             `tpprd_umur` ,		   		`tpprd_umur2` ,
        //             `tpprd_tanggal_lahir` ,  		`tpprd_tanggal_lahir2` ,
        //             `tpprd_tanggal_awal` ,   		`tpprd_tanggal_akhir` ,
        //             `tpprd_masa_tahun` ,	   		`tpprd_masa_bulan` ,
        //             `tpprd_up` ,			   		`tpprd_tarif_persen` ,
        //             `tpprd_tarif` ,		   		`tpprd_admin` ,
        //             `tpprd_admin_persen` ,   		`tpprd_disc` ,
        //             `tpprd_disc_persen` ,	   		`tpprd_disc_ajukan`  ,
        //             `tpprd_discpolis`  ,	   		`tpprd_discpolis_persen` ,
        //             `tpprd_disc_lain_persen`,		`tpprd_disc_lain` ,
        //             `tpprd_biaya_medis` ,    		`tpprd_extra` ,
        //             `tpprd_extra_persen` ,  		`tpprd_em_persen_reas` ,
        //             `tpprd_premi_reas` ,	  		`tpprd_up_baru` ,
        //             `tpprd_premi` ,		  		`tpprd_premi_co` ,
        //             `tpprd_premi_bayar`,	  		`tpprd_share` ,
        //             `tpprd_up_persen` ,	  		`tpprd_ujroh_persen` ,
        //             `tpprd_ujroh` ,		  		`tpprd_komisi_persen` ,
        //             `tpprd_komisi` ,		  		`tpprd_status_usertax_persen` ,
        //             `tpprd_status_usertax`, 		`tpprd_tax_persen` ,
        //             `tpprd_tax` ,			  		`tpprd_komisi_bayar` ,
        //             `tpprd_manajemenfee_persen`,  `tpprd_manajemenfee` ,
        //             `tpprd_overidding_persen` ,   `tpprd_overidding` ,
        //             `tpprd_referal` ,			    `tpprd_referal_persen` ,
        //             `tpprd_maintenance` , 	    `tpprd_maintenance_persen` ,
        //             `tpprd_handlingfee_persen` ,  `tpprd_handlingfee` ,
        //             `tpprd_disc_ujroh` , 		    `tpprd_refund_premi` ,
        //             `tpprd_tanggal_bayar` , 	    `tpprd_total_bayar_dtl` ,
        //             `tpprd_total_bayar` , 	    `tpprd_status_bayar` ,
        //             `tpprd_jenis_bayar` , 	    `tpprd_tarif_nonlife` ,
        //             `tpprd_premi_nonlife` ,  	    `tpprd_tarif_persen_nonlife` ,
        //             `tpprd_umur_polis` , 	  	    `tpprd_status_bayar_lain` ,
        //             `tpprd_tanggal_bayar_lain` ,  `tpprd_total_bayar_lain` ,
        //             `tpprd_total_bayar_disc` ,    `tpprd_tanggal_bayar_disc` ,
        //             `tpprd_em_status`,		    `tpprd_em_tanggal` ,
        //             `tpprd_reas_premilife` ,	    `tpprd_reas_preminonlife` ,
        //             `tpprd_reas_ujrohreas` ,	    `tpprd_reas_tabbaru` ,
        //             `tpprd_share_reindo` ,	    `tpprd_share_nasre` ,
        //             `tpprd_share_alamin` ,	    `tpprd_tabaru_life` ,
        //             `tpprd_uangkuliah_semester`  ,`tpprd_uangkuliah_tunggal` ,
        //             `tpprd_tahun_kuliah`,		    `tpprd_masa_kuliah` ,
        //             `tpprd_ajufee` ,			    `tpprd_ajufee_persen` ,
        //             `tpprd_total_refund` ,	    `tpprd_selisih_premi` ,
        //             mpol_mjns_kode,			  	 mpol_mjm_kode,
        //             '') as komisi
        //             FROM epstfix.peserta_all
        //             LEFT JOIN eopr.mst_polis ON mpol_kode=tpprd_nomor_polish
        //             WHERE mpol_kode='".$kode_polis."' AND month(date(tpprd_insert_fix)) between '".$bln1."' and '".$bln2."'
        //             AND year(date(tpprd_insert_fix))='".$thn."' #AND tpprd_total_bayar_dtl>=tpprd_premi_bayar
        //             AND (tpprd_total_bayar_dtl-tpprd_premi_bayar)>-0.1
        //             AND IFNULL(mpol_mkom_persen,0)>0 AND IFNULL(tpprd_tax_persen,0)<1 and tpprd_mlok_kode!='01'
        //             AND tpprd_status_klaim!=1 AND tpprd_status_refund!=1
        //             AND if(mpol_mrkn_kode='R17000246',tpprd_mlok_kode='".$cab."',ifnull(tpprd_pk,'')!='')
        //             AND tpprd_status_batal!=1 AND tpprd_status_bayar='1'
        //             AND tpprd_status='1'
        //             AND tpprd_pk not in (select tkomd_tpprd_pk FROM etrs.trs_komisi_dtl WHERE tkomd_tkomh_pk='".$pkx."K' )
        //             GROUP BY tpprd_pk LIMIT 100000");
        //             $resx1b = Lib::__dbAll($cmdb);

        //             for ($i=0; $i < count($resx1b); $i++) {

        //                 $cmd = DB::select("INSERT IGNORE INTO etrs.trs_komisi_dtl
        //                 (`tkomd_pk`,
        //                 `tkomd_tkomh_pk`,
        //                 `tkomd_tpprd_pk`,
        //                 `tkomd_up`,
        //                 `tkomd_komisi_persen`,
        //                 `tkomd_komisi`,
        //                 `tkomd_tax_user`,
        //                 `tkomd_tax_userstatus`,
        //                 `tkomd_tax_userpersen`,
        //                 `tkomd_tax_persen`,
        //                 `tkomd_tax`,
        //                 `tkomd_tipe`,
        //                 `tkomd_ins_date`,
        //                 `tkomd_ins_user`,
        //                 `tkomd_bayar`,
        //                 `tkomd_tglbayar`,
        //                 `tkomd_userbayar`,
        //                 `tkomd_prosesbayar`,
        //                 `tkomd_mlok_kode`,
        //                 `tkomd_mrkn_kode_induk`,
        //                 `tkomd_mpol_kode`)
        //                SELECT
        //                  CONCAT('".$pkx."_','".$resx1b[$i]['tpprd_pk']."') tkomd_pk,
        //                  '".$pkx."K' tkomd_tkomh_pk,
        //                  '".$resx1b[$i]['tpprd_pk']."' tkomd_tpprd_pk,
        //                  '".$resx1b[$i]['tpprd_up']."' tkomd_up,
        //                  '".$resx1b[$i]['tpprd_komisi_persen']."' tkomd_komisi_persen,
        //                  '".$resx1b[$i]['komisi']."' as tkomd_komisi,
        //                  '".$pic2."' tkomd_tax_user,
        //                  '".$r3['sts']."' tkomd_tax_userstatus,
        //                  if('".$r3['sts']."'=1,50,0) tkomd_tax_userpersen,
        //                  ".$pajak3." tkomd_tax_persen,
        //                  '".$resx1b[$i]['komisi']."'*".$tax3." as tkomd_tax,
        //                  1 tkomd_tipe,
        //                  now() tkomd_ins_date,
        //                  '".$user."' tkomd_ins_user,
        //                  0 tkomd_bayar,
        //                  '1881-01-01' tkomd_tglbayar,
        //                  '' tkomd_userbayar,
        //                  '' tkomd_prosesbayar,
        //                  '' tkomd_mlok_kode,
        //                  '' tkomd_mrkn_kode_induk,
        //                  '' tkomd_mpol_kode");
        //                 Lib::__dbRow($cmd);
        //             }
        //         }
	    //         //---END KONDISI KOMISI 3---//
        //     }
        }
    }
}
