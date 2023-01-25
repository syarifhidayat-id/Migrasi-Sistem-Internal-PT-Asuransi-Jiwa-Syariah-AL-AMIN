<?php

namespace App\Http\Controllers\Legal;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Library\Lib;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

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
                $kode = Lib::__getKey(14);
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
        $data = DB::table('emst.mst_uu_asuransi')
        ->select('*', DB::raw("@no:=@no+1 AS DT_RowIndex"), DB::raw('DATE_FORMAT(mua_ins_date, "%d-%m-%Y") as ins_date'))
        ->orderBy('mua_ins_date', 'DESC')->get();

            return Datatables::of($data)
            ->addIndexColumn()
            ->filter(function ($instance) use ($request) {
                if ($request->get('check_nomor') == "1") {
                    if (!empty($request->get('mua_nomor'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['mua_nomor'], $request->get('mua_nomor')) ? true : false;
                        });
                    }
                }
                if ($request->get('check_tentang') == "1") {
                    if (!empty($request->get('mua_tentang'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['mua_tentang'], $request->get('mua_tentang')) ? true : false;
                        });
                    }
                }
                // if ($request->get('check_segmen') == "1") {
                //     if (!empty($request->get('mdp_mssp_kode'))) {
                //         $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                //             return Str::contains($row['mdp_mssp_kode'], $request->get('mdp_mssp_kode')) ? true : false;
                //         });
                //     }
                // }
                if (!empty($request->get('search'))) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        if (Str::contains(Str::lower($row['mua_nomor']), Str::lower($request->get('search')))){
                            return true;
                        }else if (Str::contains(Str::lower($row['mua_tentang']), Str::lower($request->get('search')))) {
                            return true;
                        }else if (Str::contains(Str::lower($row['mua_ins_user']), Str::lower($request->get('search')))) {
                            return true;
                        }

                        return false;
                    });
                }
            })
            ->make(true);
        }


        //SELECT FILTER UU ASURANSI

        public function selectNomor(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;

        $vtable = DB::table('emst.mst_uu_asuransi')
        ->select('mua_nomor');
        // $vtable = DB::table('emst.mst_draft_pks')->join('emst.mst_produk_segment', 'mssp_kode', 'mdp_mssp_kode')
        // ->select('mdp_mssp_kode', 'mssp_kode', 'mssp_nama');

        if(!empty($request->q)) {
            $vtable->where('mua_nomor', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        // ->groupBy('mssp_kode')
        ->offset($offset)
        ->limit($rows)
        ->get();

        return response()->json($data);
    }

    public function getNomor(Request $request, $id)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            // $data = DB::table('emst.mst_draft_pks')->join('emst.mst_produk_segment', 'mssp_kode', 'mdp_mssp_kode')
            // ->select('mdp_mssp_kode', 'mssp_kode', 'mssp_nama')
            $data = DB::table('emst.mst_uu_asuransi')
            ->select('mua_nomor')
            ->where([
                ['mua_nomor', $id],
                ['mua_nomor','like',"%$search%"],
            ])
            ->get();
        } else {
            $data = DB::table('emst.mst_uu_asuransi')
            ->select('*')
            ->where([
                ['mua_nomor', $id],
            ])
            ->get();
        }

        return response()->json($data);
    }

        public function selectTentang(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;

        $vtable = DB::table('emst.mst_uu_asuransi')
        ->select('mua_tentang');
        // $vtable = DB::table('emst.mst_draft_pks')->join('emst.mst_produk_segment', 'mssp_kode', 'mdp_mssp_kode')
        // ->select('mdp_mssp_kode', 'mssp_kode', 'mssp_nama');

        if(!empty($request->q)) {
            $vtable->where('mua_tentang', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->groupBy('mua_tentang')
        ->offset($offset)
        ->limit($rows)
        ->get();

        return response()->json($data);
    }

    public function getTentang(Request $request, $id)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            // $data = DB::table('emst.mst_draft_pks')->join('emst.mst_produk_segment', 'mssp_kode', 'mdp_mssp_kode')
            // ->select('mdp_mssp_kode', 'mssp_kode', 'mssp_nama')
            $data = DB::table('emst.mst_uu_asuransi')
            ->select('mua_tentang')
            ->where([
                ['mua_tentang', $id],
                ['mua_tentang','like',"%$search%"],
            ])
            ->get();
        } else {
            $data = DB::table('emst.mst_uu_asuransi')
            ->select('*')
            ->where([
                ['mua_tentang', $id],
            ])
            ->get();
        }

        return response()->json($data);
    }

}
