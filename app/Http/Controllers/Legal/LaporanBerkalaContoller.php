<?php

namespace App\Http\Controllers\Legal;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\KodeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
}
