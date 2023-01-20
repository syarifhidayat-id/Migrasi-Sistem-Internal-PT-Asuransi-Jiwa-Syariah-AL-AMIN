<?php

namespace App\Http\Controllers\Sekper;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\Lib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.sekper.suratmasuk.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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

        //         'mua_nomor' => 'required',
        //         'mua_tentang' => 'required',
        //         'mua_dokumen' => 'mimes:pdf',
        //     ],
        //     [
        //         'mua_nomor.required' => 'Tidak boleh kosong!',
        //         'mua_tentang.required' => 'Tidak boleh kosong!',
        //         'mua_dokumen.mimes' => 'File harus format pdf!',
        //     ]
        // );

        // if ($validasi->fails()) {
        //     return response()->json([
        //         'error' => $validasi->errors()
        //     ]);
        // } else {

        if ($request->tsm_pk == "") {
            $kode = Lib::__getKey(14);
            $data = $request->all();
            $data = request()->except(['_token']);

            if ($request->hasFile('tsm_disposisi')) {
                $dok = $request->file('tsm_disposisi');
                $dir = 'public/sekper/suratmasuk';
                $fileOri = $dok->getClientOriginalName();
                $nameBukti = $kode . '_disposisi_srtmasuk_' . $fileOri;
                $path = Storage::putFileAs($dir, $dok, $nameBukti);
                $data['tsm_disposisi'] = $nameBukti;
            }

            $data['tsm_pk'] = $kode;
            $data['tsm_ins_user'] = $request->user()->email;
            $data['tsm_ins_date'] = date('Y-m-d H:i:s');
            $data['tsm_indexfolder'] = 0;
            $data['tsm_halkhusus'] = 0;
            $data['tsm_proses'] = 0;

            $insert = DB::table('eopr.trs_surat_masuk')->insert($data);
            // return response()->json([
            //     'success' => 'Data berhasil disimpan dengan Kode ' . $kode . '!'
            // ]);

            return $data;
        } else {
            $data = $request->all();
            $uu = DB::table('eopr.trs_surat_masuk')
                ->where('tsm_pk', '=', $request->tsm_pk)
                ->first();

            $data = request()->except(['_token']);

            $oldFile = 'public/sekper/suratmasuk/' . $uu->tsm_disposisi;

            if ($request->hasFile('tsm_disposisi')) {
                $dok = $request->file('tsm_disposisi');
                $dir = 'public/sekper/suratmasuk';
                $fileOri = $dok->getClientOriginalName();
                $nameBukti = $request->tsm_pk . '_disposisi_srtmasuk_' . $fileOri;
                Storage::delete($oldFile);
                $path = Storage::putFileAs($dir, $dok, $nameBukti);
                $data['tsm_disposisi'] = $nameBukti;
            }

            $data['tsm_upd_user'] = $request->user()->email;
            $data['tsm_upd_date'] = date('Y-m-d H:i:s');


            $update = DB::table('eopr.trs_surat_masuk')
                ->where('tsm_pk', '=', $request->tsm_pk)
                ->update($data);

            // return response()->json([
            //     'success' => 'Data berhasil diupdate dengan Kode ' . $request->tsm_pk . '!'
            // ]);

            return $data;
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
        $data = DB::table('eopr.trs_surat_masuk')
            ->where('tsm_pk', $id)
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DB::table('eopr.trs_surat_masuk')
            ->where('tsm_pk', '=', $id)
            ->first();
        $oldFile = 'public/sekper/suratmasuk/' . $data->tsm_disposisi;

        if ($oldFile) {
            Storage::delete($oldFile);
        }

        $delete = DB::table('eopr.trs_surat_masuk')
            ->where('tsm_pk', '=', $id)
            ->delete();

        return response()->json([
            'success' => 'Data berhasil dihapus dengan Kode ' . $data->tsm_pk . '!'
        ]);
    }


    public function surat_masuk(Request $request)
    {
        $data = DB::table('eopr.trs_surat_masuk')->select(
            '*',
            DB::raw("@no:=@no+1 AS DT_RowIndex"),
            DB::raw('DATE_FORMAT(tsm_ins_date, "%d-%m-%Y") as ins_date')
        )
            ->orderBy('tsm_ins_date', 'DESC');

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
                        $w->orWhere('tsm_nomor', 'LIKE', "%$search%")
                            ->orWhere('tsm_dr_instansi', 'LIKE', "%$search%");
                    });
                }
            })
            ->make(true);
        // }
    }


}
