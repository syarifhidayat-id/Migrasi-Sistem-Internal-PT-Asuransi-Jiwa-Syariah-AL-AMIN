<?php

namespace App\Http\Controllers\Sekper;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\Lib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SlidePresentasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.sekper.slide_presentasi.index');
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

            if ($request->mslp_pk == "") {
                $kode = Lib::__getKey(14);
                $data = $request->all();
                $data = request()->except(['_token']);

                if ($request->hasFile('mslp_dokumen')) {
                    $dokumen = $request->file('mslp_dokumen');
                    $dir = 'public/sekper/slide';
                    $fileOri = $dokumen->getClientOriginalName();
                    $nameBukti = $kode . '_slide_' . $fileOri;
                    $path = Storage::putFileAs($dir, $dokumen, $nameBukti);
                    $data['mslp_dokumen'] = $nameBukti;
                }
                $data['mslp_pk'] = $kode;
                $data['mslp_ins_user'] = $request->user()->email;
                $data['mslp_ins_date'] = date('Y-m-d H:i:s');
                $data['mslp_indexfolder'] = 0;
                // return $data;
                $insert = DB::table('emst.mst_slide_persentasi')->insert($data);
                return response()->json([
                    'success' => 'Data berhasil disimpan dengan Kode ' . $kode . '!'
                ]);
            } else {
                $data = $request->all();
                $d = DB::table('emst.mst_slide_persentasi')
                    ->where('mslp_pk', '=', $request->mslp_pk)
                    ->first();
                $data = request()->except(['_token']);
                $oldFile = 'public/sekper/slide/' . $d->mslp_dokumen;

                if ($request->hasFile('mslp_dokumen')) {
                    $dokumen = $request->file('mslp_dokumen');
                    $dir = 'public/sekper/slide';
                    $fileOri = $dokumen->getClientOriginalName();
                    $nameBukti = $request->mslp_pk . '_slide_' . $fileOri;
                    Storage::delete($oldFile);
                    $path = Storage::putFileAs($dir, $dokumen, $nameBukti);
                    $data['mslp_dokumen'] = $nameBukti;
                }

                $data['mslp_upd_user'] = $request->user()->email;
                $data['mslp_upd_date'] = date('Y-m-d H:i:s');

                // return $data;

                $update = DB::table('emst.mst_slide_persentasi')
                    ->where('mslp_pk', '=', $request->mslp_pk)
                    ->update($data);

                return response()->json([
                    'success' => 'Data berhasil diupdate dengan Kode ' . $request->mslp_pk . '!'
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
        $data = DB::table('emst.mst_slide_persentasi')
        ->where('mslp_pk', $id)
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
        $d = DB::table('emst.mst_slide_persentasi')
        ->where('mslp_pk', $id)
        ->first();
        $oldFile = 'public/sekper/slide/' . $d->mslp_dokumen;

        if ($oldFile) {
            Storage::delete($oldFile);
        }

        $delete = DB::table('emst.mst_slide_persentasi')
        ->where('mslp_pk', $id)
        ->delete();

        if ($delete) {
            return response()->json([
                'success' => 'Data berhasil dihapus dengan Kode ' . $d->mslp_pk . '!'
            ]);
        } else {
            return response()->json([
                'error' => 'Gagal menghapus data dengan kode' . $d->mslp_pk . '!'
            ]);
        }


        // return $data;
    }


    public function getSlide(Request $request)
    {
        // $data = DB::table('esur.trs_surat')->select(
        //     '*',
        //     DB::raw("@no:=@no+1 AS DT_RowIndex"),
        //     DB::raw('DATE_FORMAT(tsm_ins_date, "%d-%m-%Y") as ins_date')
        // )

        $data = DB::table('emst.mst_slide_persentasi')->select(
            '*',
            DB::raw("@no:=@no+1 AS DT_RowIndex")
        )
            ->orderBy('mslp_pk', 'desc')->limit(10);

        return DataTables::of($data)
            ->addIndexColumn()
            ->filter(function ($instance) use ($request) {
                // if($request->has('wmn_tipe') && $request->wmn_tipe!=null) {
                //     return $instance->where('wmn_tipe', $request->wmn_tipe);
                // }
                // if (!empty($request->get('wmn_tipe'))) {
                //     $instance->where('wmn_tipe', $request->get('wmn_tipe'));
                // }
                // if (!empty($request->get('wmn_descp'))) {
                //     $instance->where('wmn_descp', $request->get('wmn_descp'));
                // }
                if (!empty($request->get('search'))) {
                    $instance->where(function ($w) use ($request) {
                        $search = $request->get('search');
                        $w->orWhere('mslp_judul', 'LIKE', "%$search%")
                            ->orWhere('mslp_pk', 'LIKE', "%$search%");
                    });
                }
            })
            ->make(true);
        // }
    }
}
