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

class ApprovKasAnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.keuangan.kas.approv-kas-anggaran.index');
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

    public function api_dtl_approv_kas(Request $request)
    {
        $tambah = "";
        if (!empty($request['search'])) {
            $tambah = $tambah . " and tkad_pk= '" . $request['search'] . "' ";
        }

        if (isset($request['e_baris'])) {
            $baris = $request['e_baris'];
            // $baris = '10';
        } else {
            $baris = '50';
        }

        $cmd = DB::select("
        SELECT
        tkad_pk,  
        tkad_atjh_pk,
        tkad_askn_kode,
        tkad_keterangan,
        tdna_mlok_kode,
        tkad_tipe_dk,
        FORMAT(tkad_total,2) tkad_total,
        tkad_jns_realisasi,
        mar_nama e_realisasi,
        tkad_tkb_pk,
        tkad_mta_pk,
        mta_keterangan,
        tkad_kd_keterangan,
        tkad_relops,
        tkad_kelompokas
        FROM epms.trs_kas_dtl	
        LEFT JOIN eacc.ams_sub_akun  ON asakn_kode=tkad_askn_kode 
        LEFT JOIN epms.`mst_tipe_anggaran` ON mta_pk=tkad_mta_pk
        LEFT JOIN `emst`.`mst_anggaran_realisasi` on mar_kode=tkad_jns_realisasi
        WHERE 1=1 AND tkad_tipe_dk='D'
        " . $tambah . " 
        ORDER BY tkad_tipe_dk DESC
        LIMIT " . $baris . "");
        $data = Lib::__dbAll($cmd);
        return DataTables::of($data)
            ->addIndexColumn()
            ->filter(function ($instance) use ($request) {
                if ($request->get('check_cab_alamin') == "1") {
                    if (!empty($request->get('mlok_kode'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['tdna_mlok_kode'], $request->get('tdna_mlok_kode')) ? true : false;
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
}
