<?php

namespace App\Http\Controllers\Legal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Library\KodeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PojkSeojkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.legal.pojk-seojk.index');
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

                'mpojk_nomor' => 'required',
                'mpojk_tentang' => 'required',
                'mpojk_jenis' => 'required',
                'mpojk_dokumen' => 'mimes:pdf',
            ],
            [
                'mpojk_nomor.required' => 'Tidak boleh kosong!',
                'mpojk_tentang.required' => 'Tidak boleh kosong!',
                'mpojk_jenis.required' => 'Tidak boleh kosong!',
                'mpojk_dokumen.mimes' => 'File harus format pdf!',
            ]
        );

        if ($validasi->fails()) {
            return response()->json([
                'error' => $validasi->errors()
            ]);
        } else {

            if ($request->mpojk_pk == "") {
                $kode = KodeController::__getKey(14);
                $data = $request->all();
                $data = request()->except(['_token']);

                if ($request->hasFile('mpojk_dokumen')) {
                    $mpojk_dokumen = $request->file('mpojk_dokumen');
                    $dir = 'public/legal/pojk';
                    $fileOri = $mpojk_dokumen->getClientOriginalName();
                    $nameBukti = $kode . '_pojk_' . $fileOri;
                    $path = Storage::putFileAs($dir, $mpojk_dokumen, $nameBukti);
                    $data['mpojk_dokumen'] = $nameBukti;
                }
                $data['mpojk_pk'] = $kode;
                $data['mpojk_ins_user'] = $request->user()->email;
                $data['mpojk_ins_date'] = date('Y-m-d H:i:s');
                $data['mpojk_indexfolder'] = 0;
                // return $data;
                $insert = DB::table('emst.mst_pojk')->insert($data);
                return response()->json([
                    'success' => 'Data berhasil disimpan dengan Kode ' . $kode . '!'
                ]);
            } else {
                $data = $request->all();
                $pojk = DB::table('emst.mst_pojk')
                    ->where('mpojk_pk', '=', $request->mpojk_pk)
                    ->first();
                $data = request()->except(['_token']);
                $oldFile = 'public/legal/pojk/' . $pojk->mpojk_dokumen;

                if ($request->hasFile('mpojk_dokumen')) {
                    $mpojk_dokumen = $request->file('mpojk_dokumen');
                    $dir = 'public/legal/pojk';
                    $fileOri = $mpojk_dokumen->getClientOriginalName();
                    $nameBukti = $request->mpojk_pk . '_pojk_' . $fileOri;
                    Storage::delete($oldFile);
                    $path = Storage::putFileAs($dir, $mpojk_dokumen, $nameBukti);
                    $data['mpojk_dokumen'] = $nameBukti;
                }

                $data['mpojk_upd_user'] = $request->user()->email;
                $data['mpojk_upd_date'] = date('Y-m-d H:i:s');

                $update = DB::table('emst.mst_pojk')
                    ->where('mpojk_pk', '=', $request->mpojk_pk)
                    ->update($data);
                return response()->json([
                    'success' => 'Data berhasil diupdate dengan Kode ' . $request->mpojk_pk . '!'
                ]);
            }
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
        $pks = DB::table('emst.mst_pojk')
            ->where('mpojk_pk', $id)
            ->first();
        return response()->json($pks);
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
        $data = DB::table('emst.mst_pojk')
            ->where('mpojk_pk', '=', $id)
            ->first();
        $oldFile = 'public/legal/pojk/' . $data->mpojk_dokumen;

        if ($oldFile) {
            Storage::delete($oldFile);
        }

        $delete = DB::table('emst.mst_pojk')
            ->where('mpojk_pk', '=', $id)
            ->delete();
        if ($delete) {
            return response()->json([
                'success' => 'Data berhasil dihapus dengan Kode ' . $data->mpojk_pk . '!'
            ]);
        } else {
            return response()->json([
                'error' => 'Gagal menghapus data dengan kode' . $data->mpojk_pk . '!'
            ]);
        }
    }
}
