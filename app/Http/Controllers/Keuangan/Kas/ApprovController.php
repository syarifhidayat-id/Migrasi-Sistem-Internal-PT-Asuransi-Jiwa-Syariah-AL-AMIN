<?php

namespace App\Http\Controllers\Keuangan\Kas;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\Lib;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ApprovController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.keuangan.kas.approv-transaksi-kas.index');
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

    public function pdf_vcr_dtl($id)
    {
        // $data = DB::table('epms.trs_dtl_vcr')->get();

        $file_data = DB::table('epms.trs_dtl_vcr')
            ->where('tkav_pk', $id)
            ->first();

        $data = [
            'title' => 'Generate PDF using Laravel TCPDF - ItSolutionStuff.com!'
        ];

        $html = view()->make('pdfSample', $data)->render();

        $filename = 'VOUCHER KAS CABANG ' + $file_data->tkav_nomor;

        $pdf = new TCPDF;

        $pdf::SetTitle($file_data->tkav_nomor);
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');

        $pdf::Output(public_path($filename), 'F');

        return response()->download(public_path($filename));
    }

    public function lodDoc(Request $request)
    {
        $url = public_path('storage/keuangan/kas/master-kas/'.$request['doc']);
        if (Storage::exists($url)) {
            return response()->json(['success' => 'Success']);
        } else {
            return response()->json(['error' => 'Error']);
        }
        // return response()->json(['error' => $url]);
    }


    public function api_dtl_approv(Request $request)
    {
        $tambah="";
        // $page = $request->page ? intval($request->page) : 1;
        // $rows = $request->rows ? intval($request->rows) : 50000;
        // $offset = ($page - 1) * $rows;

        // $data = DB::table('epms.trs_dana_aju')->leftJoin('emst.mst_lokasi', 'mlok_pk', '=', 'tdna_mlok_kode')
        //     ->select(
        //         '*',
        //         DB::raw("@no:=@no+1 AS DT_RowIndex"),
        //         // DB::raw('DATE_FORMAT(tdna_tgl_aju, "%d-%m-%Y") as date_aju'),
        //         // DB::raw('CASE 
        //         // WHEN tdna_mlok_kode = mlok_pk THEN mlok_nama END as cabang_alamin'),
        //         DB::raw('CASE WHEN tdna_aprov_admin = "1" THEN "Setuju" WHEN tdna_aprov_admin = "0" THEN "Belum Approv" END as admin,
        //     CASE WHEN tdna_aprov_kacab = "1" THEN "Setuju" WHEN tdna_aprov_kacab = "0" THEN "Belum Approv" END as kepala_cabang,
        //     CASE WHEN tdna_aprov_kapms = "1" THEN "Setuju" WHEN tdna_aprov_kapms = "0" THEN "Belum Approv" END as kadiv_wakadiv,
        //     CASE WHEN tdna_aprov_korwil = "1" THEN "Setuju" WHEN tdna_aprov_korwil = "0" THEN "Belum Approv" END as korwil,
        //     CASE WHEN tdna_aprov_ho = "1" THEN "Setuju" WHEN tdna_aprov_ho = "0" THEN "Belum Approv" END as keuangan,
        //     FORMAT(tdna_total, 2) tdna_total')
        //     )
        //     ->orderBy('tdna_date_ins', 'desc')
        //     ->limit(10000)
        //     ->get();
        if (!empty($request['search']))
        {
            $tambah = $tambah." and tdna_pk= '".$request['search']."' ";
        }

        if (isset($request['e_baris']))
        {
            $baris = $request['e_baris'];
        } else {
            $baris = '50';
        }

        $cmd = DB::select("
        SELECT
        tdna_pk, DATE_FORMAT(tdna_tgl_aju,'%d-%m-%Y') tdna_tgl_aju, mlok_nama tdna_mlok_kode,  tdna_tipe,  tdna_penerima,tdna_akun_d, 
        tdna_total  tdna_total,
        tdna_kode_vcr,   LEFT(tdna_ket,85) tdna_ket,
        tdna_bukti, 
        IF(tdna_aprov_admin=1,   'SETUJU',IF(tdna_aprov_admin=2,'TOLAK','-')) tdna_aprov_admin,
        IF(tdna_aprov_kacab=1, 'SETUJU',IF(tdna_aprov_kacab=2,'TOLAK','-')) tdna_aprov_kacab,
        IF(tdna_aprov_kapms=1, 'SETUJU',IF(tdna_aprov_kapms=2,'TOLAK','-')) tdna_aprov_kapms,
        IF(tdna_aprov_korwil=1,'SETUJU',IF(tdna_aprov_korwil=2,'TOLAK','-')) tdna_aprov_korwil,
        IF(tdna_aprov_ho=1,    'SETUJU',IF(tdna_aprov_ho=2 ,   'TOLAK','-')) tdna_aprov_ho,
        IF(tdna_sts_buku=1,    'SUDAH',IF(tdna_sts_buku=0,   'BELUM','-')) tdna_sts_buku,
        IF(tdna_sts_jurnal=1,  'SUDAH',IF(tdna_sts_jurnal=0 ,'BELUM','-')) tdna_sts_jurnal,tdna_sts_jurnal tdna_sts_jurnalx
        FROM epms.trs_dana_aju,  emst.`mst_lokasi` 
        WHERE mlok_kode=tdna_mlok_kode
        ".$tambah." 
        ORDER BY tdna_date_ins DESC
        LIMIT ".$baris."");
        $data = Lib::__dbAll($cmd);

        return DataTables::of($data)
            ->addIndexColumn()
            ->filter(function ($instance) use ($request) {
                if ($request->get('check_cab_alamin') == "1") {
                    if (!empty($request->get('mlok_pk'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['mlok_pk'], $request->get('mlok_pk')) ? true : false;
                        });
                    }
                }
                if ($request->get('check_buku_besar') == "1") {
                    if (!empty($request->get('tdna_sts_buku'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['tdna_sts_buku'], $request->get('tdna_sts_buku')) ? true : false;
                        });
                    }
                }
                if ($request->get('check_jurnal') == "1") {
                    if (!empty($request->get('tdna_sts_jurnal'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['tdna_sts_jurnal'], $request->get('tdna_sts_jurnal')) ? true : false;
                        });
                    }
                }
                if ($request->get('check_admin') == "1") {
                    if (!empty($request->get('tdna_aprov_admin'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['tdna_aprov_admin'], $request->get('tdna_aprov_admin')) ? true : false;
                        });
                    }
                }
                if ($request->get('check_pincab') == "1") {
                    if (!empty($request->get('tdna_aprov_kacab'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['tdna_aprov_kacab'], $request->get('tdna_aprov_kacab')) ? true : false;
                        });
                    }
                }
                if ($request->get('check_keu') == "1") {
                    if (!empty($request->get('tdna_aprov_ho'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['tdna_aprov_ho'], $request->get('tdna_aprov_ho')) ? true : false;
                        });
                    }
                }
                if ($request->get('check_kadiv') == "1") {
                    if (!empty($request->get('tdna_aprov_kapms'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['tdna_aprov_kapms'], $request->get('tdna_aprov_kapms')) ? true : false;
                        });
                    }
                }
                if ($request->get('check_korwil') == "1") {
                    if (!empty($request->get('tdna_aprov_korwil'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['tdna_aprov_korwil'], $request->get('tdna_aprov_korwil')) ? true : false;
                        });
                    }
                }
                // if (!empty($request->get('search'))) {
                //     $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                //         if (Str::contains(Str::lower($row['tdna_pk']), Str::lower($request->get('search')))) {
                //             return true;
                //         }

                //         //else if (Str::contains(Str::lower($row['mua_ins_user']), Str::lower($request->get('search')))) {
                //         //     return true;
                //         // }

                //         return false;
                //     });
                // }
            })
            ->make(true);
    }


    public function selectCabang(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;

        $vtable = DB::table('emst.mst_lokasi')
            ->select('mlok_pk', 'mlok_nama');

        if (!empty($request->q)) {
            $vtable->where('mlok_nama', 'LIKE', "%$request->q%");
        }

        $data = $vtable
            ->groupBy('mlok_nama')
            ->offset($offset)
            ->limit($rows)
            ->get();

        return response()->json($data);
    }


    public function getCabang(Request $request, $id)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('emst.mst_lokasi')
                ->select('*')
                ->where([
                    ['mlok_pk', $id],
                    ['mlok_nama', 'like', "%$search%"],
                ])
                ->get();
        } else {
            $data = DB::table('emst.mst_lokasi')
                ->select('*')
                ->where([
                    ['mlok_pk', $id],
                ])
                ->get();
        }

        return response()->json($data);
    }


    public function api_approv($id)
    {
        $data = DB::table('epms.trs_dana_aju')->leftJoin('emst.mst_lokasi', 'mlok_pk', '=', 'tdna_mlok_kode')
            ->select('*', DB::raw('FORMAT(tdna_total, 2) tdna_total'))
            ->where('tdna_pk', $id)
            ->first();
        return response()->json($data);
    }

    public function approv(Request $request)
    {
        $data = $request->all();
        $approv = $request->e_status;
        $user = $request->user()->jabatan;
        $level_jabatan = DB::table('esdm.sdm_jabatan')
            ->select('sjab_level', 'sjab_sdir_kode')
            ->where('sjab_kode', $user)
            ->first();

        $data = $request->except(
            '_token',
            'mlok_nama',
            'e_status',

        );

        $data['tdna_total'] = Lib::__str2($request->tdna_total, 'N');


        if ($level_jabatan->sjab_level == "STF" && $level_jabatan->sjab_sdir_kode == "OPS") {
            $data['tdna_aprov_admin'] = $approv;
        }
        if ($level_jabatan->sjab_level == "CAB" || $level_jabatan->sjab_level == "KBG") {
            $data['tdna_aprov_kacab'] = $approv;
        }
        if ($level_jabatan->sjab_level == "KORWI" && $level_jabatan->sjab_sdir_kode == "PMS") {
            $data['tdna_aprov_korwil'] = $approv;
        }
        if ($level_jabatan->sjab_level == "KDV"  && $level_jabatan->sjab_sdir_kode == "PMS") {
            $data['tdna_aprov_kapms'] = $approv;
        }
        if (($level_jabatan->sjab_level == "KBG" || $level_jabatan->sjab_level == "KDV")  && $level_jabatan->sjab_sdir_kode == "KEU") {
            $data['tdna_aprov_ho'] = $approv;
        }


        $vtable = DB::table('epms.trs_dana_aju')
        ->where('tdna_pk', $request->tdna_pk);
        $vtable->update($data);


        return $data;
    }

    public function upload ($id) {
        $data = DB::table('epms.trs_dana_aju')
        ->where('tdna_pk', $id)
        ->first();

        return response()->json($data);
    }
}
