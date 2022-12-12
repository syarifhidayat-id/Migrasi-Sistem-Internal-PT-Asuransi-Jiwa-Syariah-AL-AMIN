<?php

namespace App\Http\Controllers\Legal;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Library\KodeController;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UndangUndangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.legal.undang-undang.index');
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

                'mua_nomor' => 'required',
                'mua_tentang' => 'required',
                'mua_dokumen' => 'mimes:pdf',
            ],
            [
                'mua_nomor.required' => 'Tidak boleh kosong!',
                'mua_tentang.required' => 'Tidak boleh kosong!',
                'mua_dokumen.mimes' => 'File harus format pdf!',
            ]
        );

        if ($validasi->fails()) {
            return response()->json([
                'error' => $validasi->errors()
            ]);
        } else {

            if ($request->mua_pk == "") {
                $kode = KodeController::__getKey(14);
                $data = $request->all();
                $data = request()->except(['_token']);

                if ($request->hasFile('mua_dokumen')) {
                    $mua_dokumen = $request->file('mua_dokumen');
                    $dir = 'public/legal/uu_asuransi';
                    $fileOri = $mua_dokumen->getClientOriginalName();
                    $nameBukti = $kode . '_uuasuransi_' . $fileOri;
                    $path = Storage::putFileAs($dir, $mua_dokumen, $nameBukti);
                    $data['mua_dokumen'] = $nameBukti;
                }

                $data['mua_pk'] = $kode;
                $data['mua_ins_user'] = $request->user()->email;
                $data['mua_ins_date'] = date('Y-m-d H:i:s');
                $data['mua_indexfolder'] = 0;
                $insert = DB::table('emst.mst_uu_asuransi')->insert($data);
                return response()->json([
                    'success' => 'Data berhasil disimpan dengan Kode ' . $kode . '!'
                ]);
            } else {
                $data = $request->all();
                $uu = DB::table('emst.mst_uu_asuransi')
                    ->where('mua_pk', '=', $request->mua_pk)
                    ->first();

                $data = request()->except(['_token']);

                $oldFile = 'public/legal/uu_asuransi/' . $uu->mua_dokumen;

                if ($request->hasFile('mua_dokumen')) {
                    $mua_dokumen = $request->file('mua_dokumen');
                    $dir = 'public/legal/uu_asuransi';
                    $fileOri = $mua_dokumen->getClientOriginalName();
                    $nameBukti = $request->mua_pk . '_uuasuransi_' . $fileOri;
                    Storage::delete($oldFile);
                    $path = Storage::putFileAs($dir, $mua_dokumen, $nameBukti);
                    $data['mua_dokumen'] = $nameBukti;
                }

                $data['mua_upd_user'] = $request->user()->email;
                $data['mua_upd_date'] = date('Y-m-d H:i:s');

                // return $data;

                $update = DB::table('emst.mst_uu_asuransi')
                    ->where('mua_pk', '=', $request->mua_pk)
                    ->update($data);

                return response()->json([
                    'success' => 'Data berhasil diupdate dengan Kode ' . $request->mua_pk . '!'
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
        $pks = DB::table('emst.mst_uu_asuransi')
            ->where('mua_pk', $id)
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
        $uu = DB::table('emst.mst_uu_asuransi')
            ->where('mua_pk', '=', $id)
            ->first();
        $oldFile = 'public/legal/uu_asuransi/' . $uu->mua_dokumen;

        if ($oldFile) {
            Storage::delete($oldFile);
        }

        $delete = DB::table('emst.mst_uu_asuransi')
            ->where('mua_pk', '=', $id)
            ->delete();
        if ($delete) {
            return response()->json([
                'success' => 'Data berhasil dihapus dengan Kode ' . $uu->mua_pk . '!'
            ]);
        } else {
            return response()->json([
                'error' => 'Gagal menghapus data dengan kode' . $uu->mua_pk . '!'
            ]);
        }
    }

    public function uu_asuransi(Request $request)
    {
        $data = DB::table('emst.mst_uu_asuransi')->select(
            '*',
            DB::raw("@no:=@no+1 AS DT_RowIndex"),
            DB::raw('DATE_FORMAT(mua_ins_date, "%d-%m-%Y") as ins_date')
        )
            ->orderBy('mua_ins_date', 'DESC');

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
                        $w->orWhere('mua_tentang', 'LIKE', "%$search%")
                            ->orWhere('mua_nomor', 'LIKE', "%$search%");
                    });
                }
            })
            ->make(true);
        // }
    }

}
