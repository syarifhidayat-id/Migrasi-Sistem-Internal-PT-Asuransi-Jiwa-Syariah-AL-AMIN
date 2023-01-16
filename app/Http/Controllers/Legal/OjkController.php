<?php

namespace App\Http\Controllers\Legal;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class OjkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.legal.ojk.index');
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
                $kode = Config::__getKey(14);
                $data = $request->all();
                $data = request()->except(['_token']);

                if ($request->hasFile('mojk_file1')) {
                    $dokumen = $request->file('mojk_file1');
                    $dir = 'public/legal/ojk/file1';
                    $fileOri = $dokumen->getClientOriginalName();
                    $nameBukti = $kode . '_dok_' . $fileOri;
                    $path = Storage::putFileAs($dir, $dokumen, $nameBukti);
                    $data['mojk_file1'] = $nameBukti;
                }
                if ($request->hasFile('mojk_file2')) {
                    $dokumen = $request->file('mojk_file2');
                    $dir = 'public/legal/ojk/file2';
                    $fileOri = $dokumen->getClientOriginalName();
                    $nameBukti = $kode . '_dok_' . $fileOri;
                    $path = Storage::putFileAs($dir, $dokumen, $nameBukti);
                    $data['mojk_file2'] = $nameBukti;
                }

                $data['mojk_pk'] = $kode;
                $data['mojk_ins_date'] = date('Y-m-d H:i:s');
                $data['mojk_ins_user'] = $request->user()->email;

                $insert = DB::table('emst.mst_ojk')->insert($data);
                return response()->json([
                    'success' => 'Data berhasil disimpan dengan Kode ' . $kode . '!'
                ]);
            } else {
                $data = $request->all();
                $pk = DB::table('emst.mst_ojk')
                    ->where('mojk_pk', '=', $request->mojk_pk)
                    ->first();
                $data = request()->except(['_token']);
                $oldFile1 = 'public/legal/ojk/file1/' . $pk->mojk_file1;
                $oldFile2 = 'public/legal/ojk/file2/' . $pk->mojk_file2;

                if ($request->hasFile('mojk_file1')) {
                    $dokumen = $request->file('mojk_file1');
                    $dir = 'public/legal/ojk/file1';
                    $fileOri = $dokumen->getClientOriginalName();
                    $nameBukti = $request->mojk_pk . '_tanda-terima_' . $fileOri;
                    Storage::delete($oldFile1);
                    $path = Storage::putFileAs($dir, $dokumen, $nameBukti);
                    $data['mojk_file1'] = $nameBukti;
                }
                if ($request->hasFile('mojk_file2')) {
                    $dokumen = $request->file('mojk_file2');
                    $dir = 'public/legal/ojk/file2';
                    $fileOri = $dokumen->getClientOriginalName();
                    $nameBukti = $request->mojk_pk . '_dokumen_' . $fileOri;
                    Storage::delete($oldFile2);
                    $path = Storage::putFileAs($dir, $dokumen, $nameBukti);
                    $data['mojk_file2'] = $nameBukti;
                }

                $data['mojk_upd_user'] = $request->user()->email;
                $data['mojk_upd_date'] = date('Y-m-d H:i:s');

                DB::table('emst.mst_ojk')
                    ->where('mojk_pk', '=', $request->mojk_pk)
                    ->update($data);
                return response()->json([
                    'success' => 'Data berhasil diupdate dengan Kode ' . $request->mojk_pk . '!'
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
        $data = DB::table('emst.mst_ojk')
            ->where('mojk_pk', $id)
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
        $pk = DB::table('emst.mst_ojk')
        ->where('mojk_pk', '=', $id)
        ->first();
    $oldFile1 = 'public/legal/ojk/file1' . $pk->mojk_file1;
    $oldFile2 = 'public/legal/ojk/file2' . $pk->mojk_file2;

    if ($oldFile1) {
        Storage::delete($oldFile1);
    }

    if ($oldFile2) {
        Storage::delete($oldFile2);
    }

    $delete = DB::table('emst.mst_ojk')
        ->where('mojk_pk', '=', $id)
        ->delete();
    return response()->json([
        'success' => 'Data berhasil dihapus dengan Kode ' . $id . '!'
    ]);
    }


    public function ojk(Request $request)
    {
        $data = DB::table('emst.mst_ojk')->select(
            '*',
            // DB::raw("@no:=@no+1 AS DT_RowIndex"),
            DB::raw("@no:=@no+1 AS DT_RowIndex"),
            // DB::raw('DATE_FORMAT(map_ins_date, "%d-%m-%Y") as ins_date'),
            DB::raw('CASE WHEN mojk_jenis = "0" THEN "Audit"
            WHEN mojk_jenis = "1" THEN "Laporan"
            WHEN mojk_jenis = "2" THEN "Tanda Terima" END as jenis_mojk')
        )->orderBy('mojk_pk', 'desc')->get();

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
            // if ($request->get('check_hal_pojk') == "1") {
            //     if (!empty($request->get('mpojk_tentang'))) {
            //         $instance->collection = $instance->collection->filter(function ($row) use ($request) {
            //             return Str::contains($row['mpojk_tentang'], $request->get('mpojk_tentang')) ? true : false;
            //         });
            //     }
            // }
            // if ($request->get('check_jenis') == "1") {
            //     if (!empty($request->get('jenis'))) {
            //         $instance->collection = $instance->collection->filter(function ($row) use ($request) {
            //             return Str::contains($row['jenis'], $request->get('jenis')) ? true : false;
            //         });
            //     }
            // }
            if (!empty($request->get('search'))) {
                $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    if (Str::contains(Str::lower($row['mojk_pk']), Str::lower($request->get('search')))){
                        return true;
                    }else if (Str::contains(Str::lower($row['mojk_judul']), Str::lower($request->get('search')))) {
                        return true;
                    }else if (Str::contains(Str::lower($row['mojk_tahun']), Str::lower($request->get('search')))) {
                        return true;
                    }else if (Str::contains(Str::lower($row['mojk_ket_jenis']), Str::lower($request->get('search')))) {
                        return true;
                    }

                    return false;
                });
            }
        })
        ->make(true);
    }

    public function showDoc(Request $request)
    {
        $vtable = DB::table('emst.mst_ojk')
        ->select(DB::raw("mojk_pk, mojk_jenis, mojk_file1, mojk_file2"));

        if (!empty($request->kode)) {
            $vtable->where('mojk_pk', $request->kode);
        }
         $data = $vtable->first();

        return response()->json($data);
    }


    //SELECT FILTER

    public function selectId(Request $request)
        {
            $page = $request->page ? intval($request->page) : 1;
            $rows = $request->rows ? intval($request->rows) : 100;
            $offset = ($page - 1) * $rows;

            $vtable = DB::table('emst.mst_ojk')
            ->select('mojk_pk'
            // DB::raw('CASE WHEN mpojk_jenis = "2" THEN "POJK" WHEN mpojk_jenis = "1" THEN "SEOJK" END as jenis')
        );
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

        public function getId(Request $request, $id)
        {
            $data = [];
            if ($request->has('q')) {
                $search = $request->q;
                // $data = DB::table('emst.mst_draft_pks')->join('emst.mst_produk_segment', 'mssp_kode', 'mdp_mssp_kode')
                // ->select('mdp_mssp_kode', 'mssp_kode', 'mssp_nama')
                $data = DB::table('emst.mst_ojk')
                ->select('mojk_pk')
                ->where([
                    ['mojk_pk', $id],
                    ['mojk_pk','like',"%$search%"],
                ])
                ->get();
            } else {
                $data = DB::table('emst.mst_ojk')
                ->select('*')
                ->where([
                    ['mojk_pk', $id],
                ])
                ->get();
            }

            return response()->json($data);
        }

}
