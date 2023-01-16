<?php

namespace App\Http\Controllers\Keuangan\Kas;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\KodeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class MasterKasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

         $kode = KodeController::__getKey(14);
         response()->json([
             'kode' => $kode,
        ]);
        // var_dump($kode);

        return view('pages.keuangan.kas.master_kas.index', compact('kode'));
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

        $validasi = Validator::make(
            $request->all(),
            [

                'tdna_kode_vcr' => 'required',
                // 'mpojk_tentang' => 'required',
                // 'mpojk_jenis' => 'required',
                // 'mpojk_dokumen' => 'mimes:pdf',
            ],
            [
                'tdna_kode_vcr.required' => 'Voucher Induk Tidak Boleh Kosong!',
                // 'mpojk_tentang.required' => 'Tidak boleh kosong!',
                // 'mpojk_jenis.required' => 'Tidak boleh kosong!',
                // 'mpojk_dokumen.mimes' => 'File harus format pdf!',
            ]
        );

        if ($validasi->fails()) {
            return response()->json([
                'error' => $validasi->errors()
            ]);
        } else {
            $data = $request->all(); 
            $kode = $request->kode_new;
            $data = $request->except(
                '_token',
                'kode_new',
                'serverSide_kas_length',
            );
            $data['tdna_pk'] = $kode;

            if ($request->hasFile('tdna_bukti')) {
                $dokumen = $request->file('tdna_bukti');
                $dir = 'public/keuangan/kas/master-kas';
                $fileOri = $dokumen->getClientOriginalName();
                $nameBukti = $kode . '_danaju_' . $fileOri;
                $path = Storage::putFileAs($dir, $dokumen, $nameBukti);
                $data['tdna_bukti'] = $nameBukti;
            }
            
            // $vtable = DB::table('epms.trs_dana_aju')->select('*')->get();
            if ($request->tdna_aprov_admin == '1' && $request->tdna_aprov_kacab == '1' && $request->tdna_aprov_kapms == '1' && $request->tdna_aprov_korwil == '1' && $request->tdna_aprov_ho == '1') {
                $data['tdna_sts_buku'] = '1';
            }

            $vtable = DB::table('epms.trs_dana_aju')->insert($data);

            return response()->json([
                'success' => 'Data berhasil disimpan dengan Kode ' . $kode . '!'
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

    

    // public function m_kas(Request $request)
    // {

    //     $data = DB::table('emst.mst_laporan_berkala')->leftJoin('esdm.sdm_divisi', 'sdiv_pk', 'mlapbkl_unit')
    //     ->select('*', DB::raw("@no:=@no+1 AS DT_RowIndex"),
    //         // DB::raw('DATE_FORMAT(map_ins_date, "%d-%m-%Y") as ins_date'),
    //         DB::raw('CASE WHEN mlapbkl_unit = sdiv_pk THEN sdiv_nama END as unit'),
    //         DB::raw('CASE WHEN mlapbkl_aktif = "1" THEN "Aktif"
    //         WHEN mlapbkl_aktif = "0" THEN "Non-Aktif"  END as aktif')
    //     )->orderBy('mlapbkl_update', 'DESC')->get();

    //     return DataTables::of($data)
    //     ->addIndexColumn()
    //     ->filter(function ($instance) use ($request) {
    //         if ($request->get('check_judul') == "1") {
    //             if (!empty($request->get('mlapbkl_jenis'))) {
    //                 $instance->collection = $instance->collection->filter(function ($row) use ($request) {
    //                     return Str::contains($row['mlapbkl_jenis'], $request->get('mlapbkl_jenis')) ? true : false;
    //                 });
    //             }
    //         }

    //         if (!empty($request->get('search'))) {
    //             $instance->collection = $instance->collection->filter(function ($row) use ($request) {
    //                 if (Str::contains(Str::lower($row['mlapbkl_jenis']), Str::lower($request->get('search')))){
    //                     return true;
    //                 }
    //                 return false;
    //             });
    //         }
    //     })
    //     ->make(true);
    // }

    public function kantor_alamin(Request $request){
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 1000;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('emst.mst_lokasi')
        ->select('mlok_pk', 'mlok_nama');
        // ->where([
        //     ['cb.mrkn_kode','<>',''],
        //     ['cb.mrkn_kantor_pusat','1'],
        //     ['cb.mrkn_nama','!=',''],
        //     // ['cb.mrkn_nama','like',"%$search%"],
        // ]);

        if (!empty($request->q)) {
            $vtable->where('mlok_pk', 'LIKE', "%$request->q%")->orWhere('mlok_nama', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->offset($offset)
        ->limit($rows)
        ->get();

        return response()->json($data);
    }

    public function e_realisasi(Request $request){
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 1000;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('emst.mst_anggaran_realisasi')
        ->select('mar_kode', 'mar_nama');
        // ->where([
        //     ['cb.mrkn_kode','<>',''],
        //     ['cb.mrkn_kantor_pusat','1'],
        //     ['cb.mrkn_nama','!=',''],
        //     // ['cb.mrkn_nama','like',"%$search%"],
        // ]);

        if (!empty($request->q)) {
            $vtable->where('mar_kode', 'LIKE', "%$request->q%")->orWhere('mar_nama', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->offset($offset)
        ->limit($rows)
        ->get();

        return response()->json($data);
    }
    public function tdna_penerima(Request $request){
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 1000;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('esdm.sdm_karyawan_new')
        ->select('skar_pk', 'skar_nama')
        ->orderBy('skar_nama')
        ->where('skar_pk', '!=', '20208588320008450001');
        // ->where([
        //     ['cb.mrkn_kode','<>',''],
        //     ['cb.mrkn_kantor_pusat','1'],
        //     ['cb.mrkn_nama','!=',''],
        //     // ['cb.mrkn_nama','like',"%$search%"],
        // ]);

        if (!empty($request->q)) {
            $vtable->where('skar_pk', 'LIKE', "%$request->q%")->orWhere('skar_nama', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->offset($offset)
        ->limit($rows)
        ->get();

        return response()->json($data);
    }


    public function testInput(Request $request){
        
        $data = $request->all();

        return response()->json($data);
    }


    //


}
