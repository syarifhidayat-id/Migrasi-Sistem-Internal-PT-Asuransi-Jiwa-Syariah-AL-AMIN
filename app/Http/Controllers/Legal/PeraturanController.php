<?php

namespace App\Http\Controllers\Legal;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\Lib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PeraturanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.legal.peraturan.index');
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

            if ($request->map_pk == "") {
                $kode = Lib::__getKey(14);
                $data = $request->all();
                $data = request()->except(['_token']);

                if ($request->hasFile('map_dokumen')) {
                    $dokumen = $request->file('map_dokumen');
                    $dir = 'public/legal/peraturan';
                    $fileOri = $dokumen->getClientOriginalName();
                    $nameBukti = $kode . '_peraturan-perusahaan_' . $fileOri;
                    $path = Storage::putFileAs($dir, $dokumen, $nameBukti);
                    $data['map_dokumen'] = $nameBukti;
                }
                $data['map_pk'] = $kode;
                $data['map_ins_user'] = $request->user()->email;
                $data['map_ins_date'] = date('Y-m-d H:i:s');
                $data['map_indexfolder'] = 0;
                // return $data;
                $insert = DB::table('emst.mst_atur_perusahaan')->insert($data);
                return response()->json([
                    'success' => 'Data berhasil disimpan dengan Kode ' . $kode . '!'
                ]);
            } else {
                $data = $request->all();
                $map = DB::table('emst.mst_atur_perusahaan')
                    ->where('map_pk', '=', $request->map_pk)
                    ->first();
                $data = request()->except(['_token']);
                $oldFile = 'public/legal/peraturan/' . $map->map_dokumen;

                if ($request->hasFile('map_dokumen')) {
                    $dokumen = $request->file('map_dokumen');
                    $dir = 'public/legal/peraturan';
                    $fileOri = $dokumen->getClientOriginalName();
                    $nameBukti = $request->map_pk . '_peraturan-perusahaan_' . $fileOri;
                    Storage::delete($oldFile);
                    $path = Storage::putFileAs($dir, $dokumen, $nameBukti);
                    $data['map_dokumen'] = $nameBukti;
                }

                $data['map_upd_user'] = $request->user()->email;
                $data['map_upd_date'] = date('Y-m-d H:i:s');

                $update = DB::table('emst.mst_atur_perusahaan')
                    ->where('map_pk', '=', $request->map_pk)
                    ->update($data);
                return response()->json([
                    'success' => 'Data berhasil diupdate dengan Kode ' . $request->map_pk . '!'
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
        $data = DB::table('emst.mst_atur_perusahaan')
            ->where('map_pk', $id)
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
        $data = DB::table('emst.mst_atur_perusahaan')
            ->where('map_pk', '=', $id)
            ->first();
        $oldFile = 'public/legal/peraturan/' . $data->map_dokumen;

        if ($oldFile) {
            Storage::delete($oldFile);
        }

        $delete = DB::table('emst.mst_atur_perusahaan')
            ->where('map_pk', '=', $id)
            ->delete();
        if ($delete) {
            return response()->json([
                'success' => 'Data berhasil dihapus dengan Kode ' . $data->map_pk . '!'
            ]);
        } else {
            return response()->json([
                'error' => 'Gagal menghapus data dengan kode' . $data->map_pk . '!'
            ]);
        }
    }
}
