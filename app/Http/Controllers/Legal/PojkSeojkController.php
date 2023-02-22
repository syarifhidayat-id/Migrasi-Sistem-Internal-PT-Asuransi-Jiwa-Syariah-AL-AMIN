<?php

namespace App\Http\Controllers\Legal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
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
                $kode = __getKey(14);
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

    public function pojk_seojk(Request $request)
    {
        $data = DB::table('emst.mst_pojk')->select(
            '*',
            DB::raw("@no:=@no+1 AS DT_RowIndex"),
            DB::raw('DATE_FORMAT(mpojk_ins_date, "%d-%m-%Y") as ins_date'),
            DB::raw('CASE WHEN mpojk_jenis = "2" THEN "POJK" WHEN mpojk_jenis = "1" THEN "SEOJK" END as jenis')
        )->orderBy('mpojk_ins_date', 'DESC')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->filter(function ($instance) use ($request) {
                if ($request->get('check_no_pojk') == "1") {
                    if (!empty($request->get('mpojk_nomor'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['mpojk_nomor'], $request->get('mpojk_nomor')) ? true : false;
                        });
                    }
                }
                if ($request->get('check_hal_pojk') == "1") {
                    if (!empty($request->get('mpojk_tentang'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['mpojk_tentang'], $request->get('mpojk_tentang')) ? true : false;
                        });
                    }
                }
                if ($request->get('check_jenis') == "1") {
                    if (!empty($request->get('jenis'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['jenis'], $request->get('jenis')) ? true : false;
                        });
                    }
                }
                if (!empty($request->get('search'))) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        if (Str::contains(Str::lower($row['mpojk_pk']), Str::lower($request->get('search')))){
                            return true;
                        }else if (Str::contains(Str::lower($row['mpojk_nomor']), Str::lower($request->get('search')))) {
                            return true;
                        }else if (Str::contains(Str::lower($row['mpojk_tentang']), Str::lower($request->get('search')))) {
                            return true;
                        }else if (Str::contains(Str::lower($row['jenis']), Str::lower($request->get('search')))) {
                            return true;
                        }

                        return false;
                    });
                }
            })
            ->make(true);
        }

        public function selectNomorPojk(Request $request)
        {
            $page = $request->page ? intval($request->page) : 1;
            $rows = $request->rows ? intval($request->rows) : 100;
            $offset = ($page - 1) * $rows;

            $vtable = DB::table('emst.mst_pojk')
            ->select('mpojk_nomor');
            // $vtable = DB::table('emst.mst_draft_pks')->join('emst.mst_produk_segment', 'mssp_kode', 'mdp_mssp_kode')
            // ->select('mdp_mssp_kode', 'mssp_kode', 'mssp_nama');

            if(!empty($request->q)) {
                $vtable->where('mpojk_nomor', 'LIKE', "%$request->q%");
            }

            $data = $vtable
            ->groupBy('mpojk_nomor')
            ->offset($offset)
            ->limit($rows)
            ->get();

            return response()->json($data);
        }

        public function getNomorPojk(Request $request, $id)
        {
            $data = [];
            if ($request->has('q')) {
                $search = $request->q;
                // $data = DB::table('emst.mst_draft_pks')->join('emst.mst_produk_segment', 'mssp_kode', 'mdp_mssp_kode')
                // ->select('mdp_mssp_kode', 'mssp_kode', 'mssp_nama')
                $data = DB::table('emst.mst_pojk')
                ->select('mpojk_nomor')
                ->where([
                    ['mpojk_nomor', $id],
                    ['mpojk_nomor','like',"%$search%"],
                ])
                ->get();
            } else {
                $data = DB::table('emst.mst_pojk')
                ->select('*')
                ->where([
                    ['mpojk_nomor', $id],
                ])
                ->get();
            }

            return response()->json($data);
        }

        public function selectPerihalPojk(Request $request)
        {
            $page = $request->page ? intval($request->page) : 1;
            $rows = $request->rows ? intval($request->rows) : 100;
            $offset = ($page - 1) * $rows;

            $vtable = DB::table('emst.mst_pojk')
            ->select('mpojk_tentang');
            // $vtable = DB::table('emst.mst_draft_pks')->join('emst.mst_produk_segment', 'mssp_kode', 'mdp_mssp_kode')
            // ->select('mdp_mssp_kode', 'mssp_kode', 'mssp_nama');

            if(!empty($request->q)) {
                $vtable->where('mpojk_tentang', 'LIKE', "%$request->q%");
            }

            $data = $vtable
            ->groupBy('mpojk_tentang')
            ->offset($offset)
            ->limit($rows)
            ->get();

            return response()->json($data);
        }

        public function getPerihalPojk(Request $request, $id)
        {
            $data = [];
            if ($request->has('q')) {
                $search = $request->q;
                // $data = DB::table('emst.mst_draft_pks')->join('emst.mst_produk_segment', 'mssp_kode', 'mdp_mssp_kode')
                // ->select('mdp_mssp_kode', 'mssp_kode', 'mssp_nama')
                $data = DB::table('emst.mst_pojk')
                ->select('mpojk_tentang')
                ->where([
                    ['mpojk_tentang', $id],
                    ['mpojk_tentang','like',"%$search%"],
                ])
                ->get();
            } else {
                $data = DB::table('emst.mst_pojk')
                ->select('*')
                ->where([
                    ['mpojk_tentang', $id],
                ])
                ->get();
            }

            return response()->json($data);
        }

        public function selectJenis(Request $request)
        {
            $page = $request->page ? intval($request->page) : 1;
            $rows = $request->rows ? intval($request->rows) : 100;
            $offset = ($page - 1) * $rows;

            $vtable = DB::table('emst.mst_pojk')
            ->select('mpojk_jenis', DB::raw('CASE WHEN mpojk_jenis = "2" THEN "POJK" WHEN mpojk_jenis = "1" THEN "SEOJK" END as jenis'));
            // $vtable = DB::table('emst.mst_draft_pks')->join('emst.mst_produk_segment', 'mssp_kode', 'mdp_mssp_kode')
            // ->select('mdp_mssp_kode', 'mssp_kode', 'mssp_nama');

            if(!empty($request->q)) {
                $vtable->where('mpojk_jenis', 'LIKE', "%$request->q%");
            }

            $data = $vtable
            ->groupBy('mpojk_jenis')
            ->offset($offset)
            ->limit($rows)
            ->get();

            return response()->json($data);
        }

        public function getJenis(Request $request, $id)
        {
            $data = [];
            if ($request->has('q')) {
                $search = $request->q;
                // $data = DB::table('emst.mst_draft_pks')->join('emst.mst_produk_segment', 'mssp_kode', 'mdp_mssp_kode')
                // ->select('mdp_mssp_kode', 'mssp_kode', 'mssp_nama')
                $data = DB::table('emst.mst_pojk')
                ->select('mpojk_tentang')
                ->where([
                    ['mpojk_jenis', $id],
                    ['mpojk_jenis','like',"%$search%"],
                ])
                ->get();
            } else {
                $data = DB::table('emst.mst_pojk')
                ->select('*')
                ->where([
                    ['mpojk_jenis', $id],
                ])
                ->get();
            }

            return response()->json($data);
        }
}
