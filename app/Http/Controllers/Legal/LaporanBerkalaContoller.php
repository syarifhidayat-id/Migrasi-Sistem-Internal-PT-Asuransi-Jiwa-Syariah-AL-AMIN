<?php

namespace App\Http\Controllers\Legal;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\KodeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class LaporanBerkalaContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.legal.laporan-berkala.index');
    }

    public function index_master()
    {
        return view('pages.legal.master-laporan-berkala.index');
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
        // $validasi = Validator::make(
        //     $request->all(),
        //     [

        //         'mpojk_nomor' => 'required',
        //         'mpojk_tentang' => 'required',
        //         'mpojk_jenis' => 'required',
        //         'mpojk_dokumen' => 'mimes:pdf',
        //     ],
        //     [
        //         'mpojk_nomor.required' => 'Tidak boleh kosong!',
        //         'mpojk_tentang.required' => 'Tidak boleh kosong!',
        //         'mpojk_jenis.required' => 'Tidak boleh kosong!',
        //         'mpojk_dokumen.mimes' => 'File harus format pdf!',
        //     ]
        // );

        // if ($validasi->fails()) {
        //     return response()->json([
        //         'error' => $validasi->errors()
        //     ]);
        // } else {

        if ($request->mojk_pk == "") {
            $kode = KodeController::__getKey(14);
            $data = $request->all();
            $data = request()->except(['_token']);

            if ($request->hasFile('mojk_file1')) {
                $dokumen = $request->file('mojk_file1');
                $dir = 'public/legal/laporan-berkala';
                $fileOri = $dokumen->getClientOriginalName();
                $nameBukti = $kode . '_dok_' . $fileOri;
                $path = Storage::putFileAs($dir, $dokumen, $nameBukti);
                $data['mojk_file1'] = $nameBukti;
            }

            $data['mojk_pk'] = $kode;
            $data['mojk_ins_date'] = date('Y-m-d H:i:s');
            $data['mojk_ins_user'] = $request->user()->email;

            $insert = DB::table('emst.mst_laporan_berkala_files')->insert($data);
            return response()->json([
                'success' => 'Data berhasil disimpan dengan Kode ' . $kode . '!'
            ]);
        } else {
            $data = $request->all();
            $pk = DB::table('emst.mst_laporan_berkala_files')
                ->where('mojk_pk', '=', $request->mojk_pk)
                ->first();
            $data = request()->except(['_token']);
            $oldFile = 'public/legal/laporan-berkala/' . $pk->mojk_file1;

            if ($request->hasFile('mojk_file1')) {
                $dokumen = $request->file('mojk_file1');
                $dir = 'public/legal/laporan-berkala';
                $fileOri = $dokumen->getClientOriginalName();
                $nameBukti = $request->mojk_pk . '_dok_' . $fileOri;
                Storage::delete($oldFile);
                $path = Storage::putFileAs($dir, $dokumen, $nameBukti);
                $data['mojk_file1'] = $nameBukti;
            }

            $data['mojk_upd_user'] = $request->user()->email;
            $data['mojk_upd_date'] = date('Y-m-d H:i:s');

            DB::table('emst.mst_laporan_berkala_files')
                ->where('mojk_pk', '=', $request->mojk_pk)
                ->update($data);
            return response()->json([
                'success' => 'Data berhasil diupdate dengan Kode ' . $request->mojk_pk . '!'
            ]);
        }
        // }
    }

    public function store_master(Request $request)
    {
        // $validasi = Validator::make(
        //     $request->all(),
        //     [

        //         'mpojk_nomor' => 'required',
        //         'mpojk_tentang' => 'required',
        //         'mpojk_jenis' => 'required',
        //         'mpojk_dokumen' => 'mimes:pdf',
        //     ],
        //     [
        //         'mpojk_nomor.required' => 'Tidak boleh kosong!',
        //         'mpojk_tentang.required' => 'Tidak boleh kosong!',
        //         'mpojk_jenis.required' => 'Tidak boleh kosong!',
        //         'mpojk_dokumen.mimes' => 'File harus format pdf!',
        //     ]
        // );

        // if ($validasi->fails()) {
        //     return response()->json([
        //         'error' => $validasi->errors()
        //     ]);
        // } else {

        if ($request->mlapbkl_pk == "") {
            $kode = KodeController::__getKey(14);
            $data = $request->all();
            $data = request()->except(['_token']);
            $data['mlapbkl_pk'] = $kode;
            $data['mlapbkl_update'] = date('Y-m-d H:i:s');
            $insert = DB::table('emst.mst_laporan_berkala')->insert($data);
            return response()->json([
                'success' => 'Data berhasil disimpan dengan Kode ' . $kode . '!'
            ]);
        } else {
            $data = $request->all();
            $data = request()->except(['_token']);
            $data['mlapbkl_update'] = date('Y-m-d H:i:s');
            DB::table('emst.mst_laporan_berkala')
                ->where('mlapbkl_pk', '=', $request->mlapbkl_pk)
                ->update($data);
            return response()->json([
                'success' => 'Data berhasil diupdate dengan Kode ' . $request->mlapbkl_pk . '!'
            ]);
        }
        // }
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
        $data = DB::table('emst.mst_laporan_berkala_files')
            ->where('mojk_pk', $id)
            ->first();
        return response()->json($data);
    }

    public function edit_master($id)
    {
        $data = DB::table('emst.mst_laporan_berkala')
            ->where('mlapbkl_pk', $id)
            ->first();
        return response()->json($data);
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
        $pk = DB::table('emst.mst_laporan_berkala_files')
            ->where('mojk_pk', '=', $id)
            ->first();
        $oldFile = 'public/legal/laporan-berkala/' . $pk->mojk_file1;

        if ($oldFile) {
            Storage::delete($oldFile);
        }

        $delete = DB::table('emst.mst_laporan_berkala_files')
            ->where('mojk_pk', '=', $id)
            ->delete();
        return response()->json([
            'success' => 'Data berhasil dihapus dengan Kode ' . $id . '!'
        ]);
    }

    public function destroy_master($id)
    {
        $delete = DB::table('emst.mst_laporan_berkala')
            ->where('mlapbkl_pk', '=', $id)
            ->delete();
        return response()->json([
            'success' => 'Data berhasil dihapus dengan Kode ' . $id . '!'
        ]);
    }

    public function get_edit_lap_ber($id)
    {
        $data = DB::table('emst.mst_laporan_berkala')
            ->select('mlapbkl_pk', 'mlapbkl_jenis')
            ->where('mlapbkl_pk', $id)
            // ->where('mrkn_nama', 'like', "%$search%")
            ->first();

        return response()->json($data);
    }

    public function laporan_berkala(Request $request)
    {
        $data = DB::table('emst.mst_laporan_berkala_files')->leftJoin('emst.mst_laporan_berkala', 'mlapbkl_pk', 'mojk_jenis')
        ->select('*',
            // DB::raw("@no:=@no+1 AS DT_RowIndex"),
            DB::raw("@no:=@no+1 AS DT_RowIndex"),
            DB::raw('DATE_FORMAT(mojk_ins_date, "%d-%m-%Y") as ins_date'),
            DB::raw('CASE WHEN mojk_jenis = mlapbkl_pk THEN mlapbkl_jenis END as jenis'))
        ->orderBy('mojk_pk', 'desc')->get();

        return DataTables::of($data)
        ->addIndexColumn()
        ->filter(function ($instance) use ($request) {
            if ($request->get('check_id') == "1") {
                if (!empty($request->get('mojk_pk'))) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['mojk_pk'], $request->get('mojk_pk')) ? true : false;
                    });
                }
            }
            if ($request->get('check_jenis') == "1") {
                if (!empty($request->get('mojk_jenis'))) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['mojk_jenis'], $request->get('mojk_jenis')) ? true : false;
                    });
                }
            }
            if ($request->get('check_tahun') == "1") {
                if (!empty($request->get('mojk_tahun'))) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['mojk_tahun'], $request->get('mojk_tahun')) ? true : false;
                    });
                }
            }
            if (!empty($request->get('search'))) {
                $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    if (Str::contains(Str::lower($row['mojk_pk']), Str::lower($request->get('search')))){
                        return true;
                    }

                    //else if (Str::contains(Str::lower($row['mua_ins_user']), Str::lower($request->get('search')))) {
                    //     return true;
                    // }

                    return false;
                });
            }
        })
        ->make(true);
    }

    //JQUERY SELECT FILTER
    public function selectIdLapBerkala(Request $request)
        {
            $page = $request->page ? intval($request->page) : 1;
            $rows = $request->rows ? intval($request->rows) : 100;
            $offset = ($page - 1) * $rows;

            $vtable = DB::table('emst.mst_laporan_berkala_files')
            ->select('mojk_pk');
            // ->select('mpojk_jenis', DB::raw('CASE WHEN mpojk_jenis = "2" THEN "POJK" WHEN mpojk_jenis = "1" THEN "SEOJK" END as jenis'));
            // $vtable = DB::table('emst.mst_draft_pks')->join('emst.mst_produk_segment', 'mssp_kode', 'mdp_mssp_kode')
            // ->select('mdp_mssp_kode', 'mssp_kode', 'mssp_nama');

            if(!empty($request->q)) {
                $vtable->where('mojk_pk', 'LIKE', "%$request->q%");
            }

            $data = $vtable
            ->groupBy('mojk_pk')
            ->offset($offset)
            ->limit($rows)
            ->get();

            return response()->json($data);
        }

        public function getIdLapBerkala(Request $request, $id)
        {
            $data = [];
            if ($request->has('q')) {
                $search = $request->q;
                // $data = DB::table('emst.mst_draft_pks')->join('emst.mst_produk_segment', 'mssp_kode', 'mdp_mssp_kode')
                // ->select('mdp_mssp_kode', 'mssp_kode', 'mssp_nama')
                $data = DB::table('emst.mst_laporan_berkala_files')
                ->select('mojk_pk')
                ->where([
                    ['mojk_pk', $id],
                    ['mojk_pk','like',"%$search%"],
                ])
                ->get();
            } else {
                $data = DB::table('emst.mst_laporan_berkala_files')
                ->select('*')
                ->where([
                    ['mojk_pk', $id],
                ])
                ->get();
            }

            return response()->json($data);
        }

        public function selectJenisDok(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;

        $vtable = DB::table('emst.mst_laporan_berkala')
        ->select('mlapbkl_pk', 'mlapbkl_jenis');
        // $vtable = DB::table('emst.mst_draft_pks')->join('emst.mst_produk_segment', 'mssp_kode', 'mdp_mssp_kode')
        // ->select('mdp_mssp_kode', 'mssp_kode', 'mssp_nama');

        if(!empty($request->q)) {
            $vtable->where('mlapbkl_pk', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->groupBy('mlapbkl_jenis')
        ->offset($offset)
        ->limit($rows)
        ->get();

        return response()->json($data);
    }

    public function getTahun(Request $request, $id)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            // $data = DB::table('emst.mst_draft_pks')->join('emst.mst_produk_segment', 'mssp_kode', 'mdp_mssp_kode')
            // ->select('mdp_mssp_kode', 'mssp_kode', 'mssp_nama')
            $data = DB::table('eset.tahun')
            ->select('no')
            ->where([
                ['no', $id],
                ['no','like',"%$search%"],
            ])
            ->get();
        } else {
            $data = DB::table('eset.tahun')
            ->select('*')
            ->where([
                ['no', $id],
            ])
            ->get();
        }

        return response()->json($data);
    }

        public function selectTahun(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;

        $vtable = DB::table('eset.tahun')
        ->select('no');
        // $vtable = DB::table('emst.mst_draft_pks')->join('emst.mst_produk_segment', 'mssp_kode', 'mdp_mssp_kode')
        // ->select('mdp_mssp_kode', 'mssp_kode', 'mssp_nama');

        if(!empty($request->q)) {
            $vtable->where('no', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->groupBy('no')
        ->offset($offset)
        ->limit($rows)
        ->get();

        return response()->json($data);
    }

    public function getJenisDok(Request $request, $id)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            // $data = DB::table('emst.mst_draft_pks')->join('emst.mst_produk_segment', 'mssp_kode', 'mdp_mssp_kode')
            // ->select('mdp_mssp_kode', 'mssp_kode', 'mssp_nama')
            $data = DB::table('emst.mst_laporan_berkala')
            ->select('mlapbkl_pk', 'mlapbkl_jenis')
            ->where([
                ['mlapbkl_pk', $id],
                ['mlapbkl_pk','like',"%$search%"],
            ])
            ->get();
        } else {
            $data = DB::table('emst.mst_laporan_berkala')
            ->select('*')
            ->where([
                ['mlapbkl_pk', $id],
            ])
            ->get();
        }

        return response()->json($data);
    }

    //QUERY MASTER LAPORAN BERKALA
    public function m_laporan_berkala(Request $request)
    {

        $data = DB::table('emst.mst_laporan_berkala')->leftJoin('esdm.sdm_divisi', 'sdiv_pk', 'mlapbkl_unit')
        ->select('*', DB::raw("@no:=@no+1 AS DT_RowIndex"),
            // DB::raw('DATE_FORMAT(map_ins_date, "%d-%m-%Y") as ins_date'),
            DB::raw('CASE WHEN mlapbkl_unit = sdiv_pk THEN sdiv_nama END as unit'),
            DB::raw('CASE WHEN mlapbkl_aktif = "1" THEN "Aktif"
            WHEN mlapbkl_aktif = "0" THEN "Non-Aktif"  END as aktif')
        )->orderBy('mlapbkl_update', 'DESC')->get();

        return Datatables::of($data)
        ->addIndexColumn()
        ->filter(function ($instance) use ($request) {
            if ($request->get('check_judul') == "1") {
                if (!empty($request->get('mlapbkl_jenis'))) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['mlapbkl_jenis'], $request->get('mlapbkl_jenis')) ? true : false;
                    });
                }
            }

            if (!empty($request->get('search'))) {
                $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    if (Str::contains(Str::lower($row['mlapbkl_jenis']), Str::lower($request->get('search')))){
                        return true;
                    }
                    return false;
                });
            }
        })
        ->make(true);
    }
    public function selectJudul(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;

        $vtable = DB::table('emst.mst_laporan_berkala')
        ->select('mlapbkl_jenis');
        // $vtable = DB::table('emst.mst_draft_pks')->join('emst.mst_produk_segment', 'mssp_kode', 'mdp_mssp_kode')
        // ->select('mdp_mssp_kode', 'mssp_kode', 'mssp_nama');

        if(!empty($request->q)) {
            $vtable->where('mlapbkl_jenis', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->groupBy('mlapbkl_jenis')
        ->offset($offset)
        ->limit($rows)
        ->get();

        return response()->json($data);
    }

    public function getJudul(Request $request, $id)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            // $data = DB::table('emst.mst_draft_pks')->join('emst.mst_produk_segment', 'mssp_kode', 'mdp_mssp_kode')
            // ->select('mdp_mssp_kode', 'mssp_kode', 'mssp_nama')
            $data = DB::table('emst.mst_laporan_berkala')
            ->select('mlapbkl_jenis')
            ->where([
                ['mlapbkl_jenis', $id],
                ['mlapbkl_jenis','like',"%$search%"],
            ])
            ->get();
        } else {
            $data = DB::table('emst.mst_laporan_berkala')
            ->select('*')
            ->where([
                ['mlapbkl_jenis', $id],
            ])
            ->get();
        }

        return response()->json($data);
    }

    public function unit_laporan_berkala(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('esdm.sdm_divisi')
                ->select('sdiv_pk', 'sdiv_nama')
                ->where('sdiv_nama', 'like', "%$search%")
                ->get();
        } else {
            $data = DB::table('esdm.sdm_divisi')
                ->select('sdiv_pk', 'sdiv_nama')
                ->orderBy('sdiv_pk')
                ->get();
        }
        return response()->json($data);
    }
}
