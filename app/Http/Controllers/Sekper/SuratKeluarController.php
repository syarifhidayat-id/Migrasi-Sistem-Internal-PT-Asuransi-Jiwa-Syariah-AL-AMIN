<?php

namespace App\Http\Controllers\Sekper;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\KodeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class SuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.sekper.suratkeluar.index');
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


        if ($request->tsin_pk == "") {

            $kode = KodeController::__getKey(14);
            $data = $request->all();
            $data = request()->except(['_token']);

            if ($request->tsin_js || $request->tsin_direktorat) {
                $a = DB::table('esur.trs_surat')
                    ->select('tsin_nomor')
                    ->orderBy('tsin_nomor', 'desc')
                    ->limit('1')->get();

                $c = array('', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII');

                $char = Str::substr($a, 16, 6);
                $nomor = intval($char) + 1;
                $d = date('Y');
                $no_surat = $nomor . '/' . $request->tsin_js . '-AL AMIN' . '/' . $request->tsin_direktorat . '/' . $c[date('n')] . '/' . $d;
                $data['tsin_nomor'] = $no_surat;
            }

            if ($request->hasFile('tsin_doksurat')) {
                $dokumen = $request->file('tsin_doksurat');
                $dir = 'public/sekper/suratkeluar';
                $fileOri = $dokumen->getClientOriginalName();
                $nameBukti = $kode . $request->tsin_direktorat . '_suratout_' . $fileOri;
                $path = Storage::putFileAs($dir, $dokumen, $nameBukti);
                $data['tsin_doksurat'] = $nameBukti;
            }

            $data['tsin_index'] = rand(1000, 5999);
            $data['tsin_pk'] = $kode . $request->tsin_direktorat;
            $data['tsin_ins_user'] = $request->user()->email;
            $data['tsin_ins_date'] = date('Y-m-d H:i:s');
            // $data['mpojk_indexfolder'] = 0;


            // return $data;
            $insert = DB::table('esur.trs_surat')->insert($data);
            return response()->json([
                'success' => 'Data berhasil disimpan dengan Kode ' . $kode . '!'
            ]);
        } else {
            $data = $request->all();
            $d = DB::table('esur.trs_surat')
                ->where('tsin_pk', '=', $request->tsin_pk)
                ->first();
            $data = request()->except(['_token']);
            $oldFile = 'public/sekper/suratkeluar/' . $d->tsin_doksurat;

            if ($request->hasFile('tsin_doksurat')) {
                $dok = $request->file('tsin_doksurat');
                $dir = 'public/sekper/suratkeluar';
                $fileOri = $dok->getClientOriginalName();
                $nameBukti = $request->tsin_pk . '_suratout_' . $fileOri;
                Storage::delete($oldFile);
                $path = Storage::putFileAs($dir, $dok, $nameBukti);
                $data['tsin_doksurat'] = $nameBukti;
            }

            // return $data;

            $data['tsin_upd_user'] = $request->user()->email;
            $data['tsin_upd_date'] = date('Y-m-d H:i:s');

            $update = DB::table('esur.trs_surat')
                ->where('tsin_pk', '=', $request->tsin_pk)
                ->update($data);
            return response()->json([
                'success' => 'Data berhasil diupdate dengan Kode ' . $request->tsin_pk . '!'
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
        $data = DB::table('esur.trs_surat')
            ->where('tsin_pk', $id)
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
        $data = DB::table('esur.trs_surat')
            ->where('tsin_pk', '=', $id)
            ->first();
        $oldFile = 'public/sekper/suratkeluar/' . $data->tsin_doksurat;

        if ($oldFile) {
            Storage::delete($oldFile);
        }

        $delete = DB::table('esur.trs_surat')
            ->where('tsin_pk', '=', $id)
            ->delete();
        return response()->json([
            'success' => 'Data berhasil dihapus dengan Kode ' . $data->tsin_pk . '!'
        ]);
    }

    public function surat_keluar(Request $request)
    {
        // $data = DB::table('esur.trs_surat')->select(
        //     '*',
        //     DB::raw("@no:=@no+1 AS DT_RowIndex"),
        //     DB::raw('DATE_FORMAT(tsm_ins_date, "%d-%m-%Y") as ins_date')
        // )

        $data = DB::table('esur.trs_surat')->select(
            '*',
            DB::raw("@no:=@no+1 AS DT_RowIndex")
        )
            ->orderBy('tsin_nomor', 'desc')->limit(10);

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
                        $w->orWhere('tsin_nomor', 'LIKE', "%$search%")
                            ->orWhere('tsin_pk', 'LIKE', "%$search%");
                    });
                }
            })
            ->make(true);
        // }
    }


    public function get_js()
    {
        $data = DB::table('emst.mst_surat')
            ->orderBy('msrt_kode', 'asc')
            ->where('msrt_keterangan', 'JNS_SURAT')
            ->where('msrt_hak', 0)->get();

        return response()->json($data);
    }
    public function get_surat_dir()
    {
        $data = DB::table('emst.mst_surat')
            ->select('*')
            ->orderBy('msrt_kode', 'asc')
            ->where([
                ['msrt_keterangan', 'MST_DIREKTORAT'],
                ['msrt_hak', 0]
            ])
            // ->where('msrt_keterangan','MST_DIREKTORAT')
            // ->where('msrt_hak', 0)
            ->get();

        return response()->json($data);
    }
    public function get_ref_surat()
    {
        $data = DB::table('eopr.trs_surat_masuk')
            ->select('tsm_pk', 'tsm_nomor', 'tsm_dr_instansi')
            ->where('tsm_nomor', '<>', "")
            ->groupBy('tsm_nomor')
            ->orderBy('tsm_nomor', 'ASC')
            ->limit(100)
            ->get();

        return response()->json($data);
    }

    public function get_aju_surat()
    {
        $data = DB::table('emst.mst_aju_surat')
            ->orderBy('mas_kode', 'ASC')
            ->get();

        return response()->json($data);
    }

    public function get_setuju_surat()
    {
        $data = DB::table('emst.mst_setuju_surat')
            ->orderBy('mtujs_kode', 'ASC')
            ->get();

        return response()->json($data);
    }

    // public function getTsinjs_edit($kode)
    // {
    //     $data = DB::table('emst.mst_surat')
    //         ->orderBy('msrt_kode', 'asc')
    //         ->where([
    //             ['msrt_kode', $kode],
    //             ['msrt_keterangan', 'JNS_SURAT'],
    //             ['msrt_hak', 0],
    //         ])
    //         ->get();

    //     return response()->json($data);
    // }

    public function get_user_ttd()
    {
        $data = DB::table('euser.user_agen_all')
            ->orderBy('name', 'asc')
            ->where('groupuser', 'ALAMIN')
            // ->where([
            //     ['groups', 'alamin'],
            //     ['msrt_keterangan', 'JNS_SURAT'],
            //     ['msrt_hak', 0],
            // ])
            ->get();

        return response()->json($data);
    }

    public function store_ttd(Request $request)
    {
        $data = $request->all();
        $data = request()->except(['_token']);

        $a = DB::table('emst.mst_setuju_surat')
            ->select('mtujs_kode')
            ->orderBy('mtujs_kode', 'desc')
            ->limit('1')->get();

        $char = Str::substr($a, 16, 2);
        $nomor = intval($char) + 1;

        $data['mtujs_kode'] = $nomor;

        // return $data;
        $insert = DB::table('emst.mst_setuju_surat')->insert($data);
        return response()->json([
            'success' => 'Data berhasil disimpan dengan Kode ' . $nomor . '!'
        ]);
    }


    public function store_bd(Request $request)
    {
        $kode = KodeController::__getKey(14);
            $data = $request->all();
            $data = request()->except(['_token']);

            if ($request->tsin_js || $request->tsin_direktorat) {
                $a = DB::table('esur.trs_surat')
                    ->select('tsin_nomor')
                    ->orderBy('tsin_nomor', 'desc')
                    ->limit('1')->get();

                $c = array('', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII');

                $char = Str::substr($a, 16, 6);
                $nomor = intval($char) + 1;
                $d = date('Y');
                $no_surat = $nomor . '/' . $request->tsin_js . '-AL AMIN' . '/' . $request->tsin_direktorat . '/' . $c[date('n')] . '/' . $d;
                $data['tsin_nomor'] = $no_surat;
            }

            if ($request->hasFile('tsin_doksurat')) {
                $dokumen = $request->file('tsin_doksurat');
                $dir = 'public/sekper/suratkeluar';
                $fileOri = $dokumen->getClientOriginalName();
                $nameBukti = $kode . $request->tsin_direktorat . '_suratout_' . $fileOri;
                $path = Storage::putFileAs($dir, $dokumen, $nameBukti);
                $data['tsin_doksurat'] = $nameBukti;
            }

            $data['tsin_index'] = rand(1000, 5999);
            $data['tsin_pk'] = $kode . $request->tsin_direktorat;
            $data['tsin_ins_user'] = $request->user()->email;
            $data['tsin_ins_date'] = date('Y-m-d H:i:s');
            // $data['mpojk_indexfolder'] = 0;


            // return $data;
            $insert = DB::table('esur.trs_surat')->insert($data);
            return response()->json([
                'success' => 'Data berhasil disimpan dengan Kode ' . $kode . '!'
            ]);
    }
}
