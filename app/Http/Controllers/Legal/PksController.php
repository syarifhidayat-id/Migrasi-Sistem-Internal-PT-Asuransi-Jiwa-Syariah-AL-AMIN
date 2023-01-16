<?php

namespace App\Http\Controllers\Legal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Legal\Pks;
use App\Http\Controllers\Library\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class PksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = DB::table('eopr.mst_pks AS pks')
        //     ->join('emst.mst_rekanan AS rekanan', 'rekanan.mrkn_kode', '=', 'pks.mpks_mrkn_kode')
        //     ->select(
        //         'rekanan.*',
        //         'pks.*',
        //         DB::raw('DATE_FORMAT(mpks_tgl_mulai, "%d-%m-%Y") as awal_date'),
        //         DB::raw('DATE_FORMAT(mpks_tgl_akhir, "%d-%m-%Y") as akhir_date')
        //     )
        //     ->orderBy('pks.mpks_ins_date', 'desc')
        //     ->get();
        // return View('pages.legal.pks.index', compact('data'));

        return view('pages.legal.pks.index');
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
                // 'mpks_mrkn_kode' => 'required',
                // 'mpks_instansi' => 'required',
                // 'mpks_nomor' => 'required',
                // 'mpks_tentang' => 'required',
                // 'mpks_tgl_mulai' => 'required',
                // 'mpks_tgl_akhir' => 'required',
                // 'mpks_pic' => 'required',
                // 'mpks_pic_hp' => 'required',
                // 'mpks_pic_email' => 'required||email',
                // 'mpks_atasan_hp' => 'required',
                // 'mpks_atasan_email' => 'required||email',
                // 'mpks_ket' => 'required',
                // // 'mpks_dokumen' => 'required||mimes:pdf',
            ],
            [
                // 'mpks_mrkn_kode.required' => 'Pemegang Polis tidak boleh kosong!',
                //     'mpks_instansi.required' => 'Instansi tidak boleh kosong!',
                //     'mpks_nomor.required' => 'Nomor pks tidak boleh kosong!',
                //     'mpks_tentang.required' => 'Perihal tidak boleh kosong!',
                //     'mpks_tgl_mulai.required' => 'Tanggal mulai tidak boleh kosong!',
                //     'mpks_tgl_akhir.required' => 'Tanggal akhir tidak boleh kosong!',
                //     'mpks_pic.required' => 'PIC tidak boleh kosong!',
                //     'mpks_pic_hp.required' => 'No. HP PIC tidak boleh kosong!',
                //     'mpks_pic_email.required' => 'email PIC tidak boleh kosong!',
                //     'mpks_pic_email.email' => 'Format email salah!',
                //     'mpks_atasan_hp.required' => 'No. HP atasan tidak boleh kosong!',
                //     'mpks_atasan_email.required' => 'Email atasan tidak boleh kosong!',
                //     'mpks_atasan_email.email' => 'Format email salah!',
                //     'mpks_ket.required' => 'Keterangan tidak boleh kosong!',
                //   // 'mpks_dokumen.required' => 'dokumen harus diisi, dan tidak boleh kosong!',
                //   // 'mpks_dokumen.mimes' => 'dokumen harus diisi dengan format .pdf!',
            ]
        );

        if ($validasi->fails()) {
            return response()->json([
                'error' => $validasi->errors()
            ]);
        } else {
            if (empty($request->mpks_pk)) {
                $kode = Config::__getKey(14);
                $data = $request->all();
                $data = $request->except('_token', 'cari_pk', 'eds');
                // $data = request()->except(['_token']);

                if ($request->hasFile('mpks_dokumen')) {
                    $mpks_dokumen = $request->file('mpks_dokumen');
                    $dir = 'public/legal/pks';
                    $fileOri = $mpks_dokumen->getClientOriginalName();
                    $nameBukti = $kode . '_pks_' . $fileOri;
                    $path = Storage::putFileAs($dir, $mpks_dokumen, $nameBukti);
                    $data['mpks_dokumen'] = $nameBukti;
                }

                $data['mpks_pk'] = $kode;
                $data['mpks_ins_user'] = $request->user()->email;
                $data['mpks_ins_date'] = date('Y-m-d H:i:s');
                $data['mpks_nomor_ori'] = 0;
                // $data['mpks_endos'] = 0;
                $data['mpks_endos_idx'] = 0;
                $data['mpks_indexfolder'] = 0;
                $data['mpks_hapus'] = 0;

                // Pks::create($data);

                $insert = DB::table('eopr.mst_pks')->insert($data);

                if ($insert) {
                    return response()->json([
                        'success' => 'Data berhasil disimpan dengan Kode ' . $kode . '!'
                    ]);
                } else {
                    return response()->json([
                        'error' => 'Data gagal disimpan !'
                    ]);
                }
            } else {
                if ($request->eds == "1") {
                    $data = $request->all();
                    $pks = DB::table('eopr.mst_pks')
                        ->where('mpks_pk', '=', $request->mpks_pk)
                        ->first();
                    $data = $request->except('_token', 'cari_pk', 'eds');

                    $oldFile = 'public/legal/pks/' . $pks->mpks_dokumen;

                    if ($request->hasFile('mpks_dokumen')) {
                        $mpks_dokumen = $request->file('mpks_dokumen');
                        $dir = 'public/legal/pks';
                        $fileOri = $mpks_dokumen->getClientOriginalName();
                        $nameBukti = $request->mpks_pk . '_pks_' . $fileOri;
                        Storage::delete($oldFile);
                        $path = Storage::putFileAs($dir, $mpks_dokumen, $nameBukti);
                        $data['mpks_dokumen'] = $nameBukti;
                    }

                    $data['mpks_nomor_ori'] = 0;
                    $data['mpks_endos'] = $request->eds;
                    $data['mpks_endos_idx'] = 0;
                    $data['mpks_indexfolder'] = 0;
                    $data['mpks_hapus'] = 0;
                    $data['mpks_upd_user'] = $request->user()->email;
                    $data['mpks_upd_date'] = date('Y-m-d H:i:s');

                    $update = DB::table('eopr.mst_pks')
                        ->where('mpks_pk', '=', $request->mpks_pk)
                        ->update($data);

                    if ($update) {
                        return response()->json([
                            'success' => 'Data berhasil diupdate dengan Kode ' . $request->mpks_pk . '!'
                        ]);
                    } else {
                        return response()->json([
                            'error' => 'Data dengan kode ' . $request->mpks_pk . ' gagal diupdate !'
                        ]);
                    }
                }

                if ($request->eds == "2") {
                    $kode_add = Config::__getKey(14);
                    $data = $request->all();
                    $data = $request->except('cari_pk', 'mpks_pk', 'eds', '_token');
                    $data['mpks_pk'] = $kode_add;
                    $data['mpks_endos'] = $request->eds;

                    DB::table('eopr.mst_pks')->insert($data);

                    return response()->json([
                        'success' => 'Data addendum berhasil disimpan dengan Kode ' . $kode_add . '!'
                    ]);
                }
                if ($request->eds == "3") {
                    // $kode_add = Config::__getKey(14);
                    $vtable = DB::table('eopr.mst_pks')->where('mpks_pk', $request->mpks_pk);
                    $data = $request->all();
                    $data = $request->except('cari_pk', 'eds', '_token');
                    // $data['mpks_pk'] = $kode_add;
                    $data['mpks_endos'] = $request->eds;

                    $vtable->update($data);

                    return response()->json([
                        'success' => 'Data addendum berhasil disimpan dengan Kode ' . $request->mpks_pk . '!'
                    ]);
                }

                // if ($request->mpks_endos == "3") {

                // }
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
        $pks = DB::table('eopr.mst_pks')
            ->where('mpks_pk', $id)
            ->select(
                'mst_pks.*',
                DB::raw('DATE_FORMAT(mpks_tgl_mulai, "%Y-%m-%d") as awal_date'),
                DB::raw('DATE_FORMAT(mpks_tgl_akhir, "%Y-%m-%d") as akhir_date')
            )
            ->first();
        return response()->json($pks);
    }

    public function viewPks($id)
    {
        $pks = DB::table('eopr.mst_pks AS pks')
            ->join('emst.mst_rekanan AS rekanan', 'rekanan.mrkn_kode', '=', 'pks.mpks_mrkn_kode')
            ->where('pks.mpks_pk', $id)
            ->select(
                'pks.*',
                'rekanan.mrkn_nama_induk',
                DB::raw('DATE_FORMAT(mpks_tgl_mulai, "%d-%m-%Y") as awal_date'),
                DB::raw('DATE_FORMAT(mpks_tgl_akhir, "%d-%m-%Y") as akhir_date')
            )
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
        // return $request->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pks = Pks::findOrFail($id);
        $pks->delete();
        $oldFile = 'public/legal/pks/' . $pks->mpks_dokumen;
        Storage::delete($oldFile);
        return response()->json([
            'success' => 'Data berhasil dihapus dengan Kode ' . $pks->mpks_pk . '!'
        ]);
    }

    public function api_pks(Request $request)
    {
        // $data = DB::table('esur.trs_surat')->select(
        //     '*',
        //     DB::raw("@no:=@no+1 AS DT_RowIndex"),
        //     DB::raw('DATE_FORMAT(tsm_ins_date, "%d-%m-%Y") as ins_date')
        // )
        // if ($request->ajax()) {
        // $page = $request->page ? intval($request->page) : 1;
        // $rows = $request->rows ? intval($request->rows) : 100;
        // $offset = ($page - 1) * $rows;
        $data = DB::table('eopr.mst_pks as pks')
            ->join('emst.mst_rekanan as rekanan', 'rekanan.mrkn_kode', '=', 'pks.mpks_mrkn_kode')
            ->select(DB::raw('pks.*', 'rekanan.mrkn_kode', 'rekanan.mrkn_nama'),
                DB::raw("@no:=@no+1 AS DT_RowIndex"),
                DB::raw('(CASE WHEN pks.mpks_mrkn_kode = rekanan.mrkn_kode THEN rekanan.mrkn_nama END) as kode_rekanan')
            )
            ->orderBy('mpks_pk', 'desc')
            // ->limit(10)
            ->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->filter (function ($instance) use ($request) {
                if ($request->get('check_instansi') == "1") {
                    if (!empty($request->get('mpks_instansi'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['mpks_instansi'], $request->get('mpks_instansi')) ? true : false;
                        });
                    }
                }
                if ($request->get('check_no_pks') == "1") {
                    if (!empty($request->get('mpks_nomor'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['mpks_nomor'], $request->get('mpks_nomor')) ? true : false;
                        });
                    }
                }
                if ($request->get('check_pic') == "1") {
                    if (!empty($request->get('mpks_pic'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['mpks_pic'], $request->get('mpks_pic')) ? true : false;
                        });
                    }
                }
                if ($request->get('check_user_ins') == "1") {
                    if (!empty($request->get('mpks_ins_user'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['mpks_ins_user'], $request->get('mpks_ins_user')) ? true : false;
                        });
                    }
                }
                if (!empty($request->get('search'))) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        if (Str::contains(Str::lower($row['mpks_pk']), Str::lower($request->get('search')))){
                            return true;
                        }else if (Str::contains(Str::lower($row['mpks_instansi']), Str::lower($request->get('search')))) {
                            return true;
                        }else if (Str::contains(Str::lower($row['mpks_tentang']), Str::lower($request->get('search')))) {
                            return true;
                        }else if (Str::contains(Str::lower($row['mpks_pic']), Str::lower($request->get('search')))) {
                            return true;
                        }
                        return false;
                    });
                }
            })
            ->make(true);
        // }
    }

    public function select_pk_pks(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('eopr.mst_pks')
                ->select('*')
                ->where([
                    // ['mpks_endos', $mpks_endos],
                    ['mpks_nomor', 'like', "%$search%"],
                ])
                ->get();
        } else {
            $data = DB::table('eopr.mst_pks')
                ->select('mpks_pk', 'mpks_nomor')
                // ->where([
                //     ['mpks_endos', $mpks_endos],
                // ])
                ->orderBy('mpks_pk')
                ->get();
        }
        return response()->json($data);
    }

    public function get_edit_polis($id)
    {
        $data = DB::table('emst.mst_rekanan')
            ->select('mrkn_kode', 'mrkn_nama')
            ->where('mrkn_kode', $id)
            // ->where('mrkn_nama', 'like', "%$search%")
            ->first();

        return response()->json($data);
    }
    public function get_all_pks($id)
    {
        $data = DB::table('eopr.mst_pks')
            ->select('*')
            // ->leftJoin('emst.mst_rekanan', 'mrkn_kode', 'mpks_mrkn_kode')
            ->where([
                ['mpks_pk', $id],
            ])
            // ->where('mrkn_nama', 'like', "%$search%")
            ->first();

        return response()->json($data);
    }



    // QUERY FILTER DATATABLES

    public function selectInstansi(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;

        $vtable = DB::table('eopr.mst_pks')
        ->select('mpks_pk','mpks_instansi');

        if(!empty($request->q)) {
            $vtable->where('mpks_instansi', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->groupBy('mpks_instansi')
        ->offset($offset)
        ->limit($rows)
        ->get();

        return response()->json($data);
    }


    public function getInstansi(Request $request, $id)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('eopr.mst_pks')
            ->select('*')
            ->where([
                ['mpks_pk', $id],
                ['mpks_instansi','like',"%$search%"],
            ])
            ->get();
        } else {
            $data = DB::table('eopr.mst_pks')
            ->select('*')
            ->where([
                ['mpks_pk', $id],
            ])
            ->get();
        }

        return response()->json($data);
    }

    public function selectNoPks(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;

        $vtable = DB::table('eopr.mst_pks')
        ->select('mpks_pk','mpks_nomor');

        if(!empty($request->q)) {
            $vtable->where('mpks_nomor', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        // ->groupBy('mpks_instansi')
        ->offset($offset)
        ->limit($rows)
        ->get();

        return response()->json($data);
    }

    public function getNoPks(Request $request, $id)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('eopr.mst_pks')
            ->select('*')
            ->where([
                ['mpks_pk', $id],
                ['mpks_nomor','like',"%$search%"],
            ])
            ->get();
        } else {
            $data = DB::table('eopr.mst_pks')
            ->select('*')
            ->where([
                ['mpks_pk', $id],
            ])
            ->get();
        }

        return response()->json($data);
    }

    public function selectPic(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;

        $vtable = DB::table('eopr.mst_pks')
        ->select('mpks_pk','mpks_pic');

        if(!empty($request->q)) {
            $vtable->where('mpks_pic', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->groupBy('mpks_pic')
        ->offset($offset)
        ->limit($rows)
        ->get();

        return response()->json($data);
    }

    public function getPic(Request $request, $id)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('eopr.mst_pks')
            ->select('*')
            ->where([
                ['mpks_pk', $id],
                ['mpks_pic','like',"%$search%"],
            ])
            ->get();
        } else {
            $data = DB::table('eopr.mst_pks')
            ->select('*')
            ->where([
                ['mpks_pk', $id],
            ])
            ->get();
        }

        return response()->json($data);
    }
    public function selectInsUser(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;

        $vtable = DB::table('eopr.mst_pks')
        ->select('mpks_pk','mpks_ins_user');

        if(!empty($request->q)) {
            $vtable->where('mpks_ins_user', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->groupBy('mpks_ins_user')
        ->offset($offset)
        ->limit($rows)
        ->get();

        return response()->json($data);
    }

    public function getInsUser(Request $request, $id)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('eopr.mst_pks')
            ->select('*')
            ->where([
                ['mpks_pk', $id],
                ['mpks_ins_user','like',"%$search%"],
            ])
            ->get();
        } else {
            $data = DB::table('eopr.mst_pks')
            ->select('*')
            ->where([
                ['mpks_pk', $id],
            ])
            ->get();
        }

        return response()->json($data);
    }

}
