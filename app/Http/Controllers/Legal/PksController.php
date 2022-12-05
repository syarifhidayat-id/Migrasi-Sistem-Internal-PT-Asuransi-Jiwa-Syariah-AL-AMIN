<?php

namespace App\Http\Controllers\Legal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Legal\Pks;
use App\Http\Controllers\Library\KodeController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

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
                'mpks_mrkn_kode' => 'required',
                'mpks_instansi' => 'required',
                'mpks_nomor' => 'required',
                'mpks_tentang' => 'required',
                'mpks_tgl_mulai' => 'required',
                'mpks_tgl_akhir' => 'required',
                'mpks_pic' => 'required',
                'mpks_pic_hp' => 'required',
                'mpks_pic_email' => 'required||email',
                'mpks_atasan_hp' => 'required',
                'mpks_atasan_email' => 'required||email',
                'mpks_ket' => 'required',
                'mpks_dokumen' => 'required||mimes:pdf',
            ],
           [
            'mpks_mrkn_kode.required' => 'Pemegang Polis tidak boleh kosong!',
                'mpks_instansi.required' => 'Instansi tidak boleh kosong!',
                'mpks_nomor.required' => 'Nomor pks tidak boleh kosong!',
                'mpks_tentang.required' => 'Perihal tidak boleh kosong!',
                'mpks_tgl_mulai.required' => 'Tanggal mulai tidak boleh kosong!',
                'mpks_tgl_akhir.required' => 'Tanggal akhir tidak boleh kosong!',
                'mpks_pic.required' => 'PIC tidak boleh kosong!',
                'mpks_pic_hp.required' => 'No. HP PIC tidak boleh kosong!',
                'mpks_pic_email.required' => 'email PIC tidak boleh kosong!',
                'mpks_pic_email.email' => 'Format email salah!',
                'mpks_atasan_hp.required' => 'No. HP atasan tidak boleh kosong!',
                'mpks_atasan_email.required' => 'Email atasan tidak boleh kosong!',
                'mpks_atasan_email.email' => 'Format email salah!',
                'mpks_ket.required' => 'Keterangan tidak boleh kosong!',
                'mpks_dokumen.required' => 'dokumen harus diisi, dan tidak boleh kosong!',
                'mpks_dokumen.mimes' => 'dokumen harus diisi dengan format .pdf!',
            ]
        );

        if ($validasi->fails()) {
            return response()->json([
                'error' => $validasi->errors()
            ]);
        }else{
            if ($request->mpks_pk == "") {
                $kode = KodeController::__getKey(14);
                $data = $request->all();
                $data = request()->except(['_token']);

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
                $data['mpks_endos'] = 0;
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
                $data = $request->all();
                $pks = DB::table('eopr.mst_pks')
                    ->where('mpks_pk', '=', $request->mpks_pk)
                    ->first();
                $data = request()->except(['_token']);

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
                $data['mpks_endos'] = 0;
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

        $data = DB::table('eopr.mst_pks as pks')
        ->join('emst.mst_rekanan as rekanan', 'rekanan.mrkn_kode', '=', 'pks.mpks_mrkn_kode')
        ->select(
            'pks.*', 'rekanan.mrkn_kode', 'rekanan.mrkn_nama',
            DB::raw("@no:=@no+1 AS DT_RowIndex"),
            DB::raw('(CASE WHEN pks.mpks_mrkn_kode = rekanan.mrkn_kode THEN rekanan.mrkn_nama END) as kode_rekanan')
        )
            ->orderBy('mpks_pk', 'desc')->limit(10);

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
                        $w->orWhere('mpks_tentang', 'LIKE', "%$search%")
                            ->orWhere('mpks_pk', 'LIKE', "%$search%");
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
                ->where('mpks_nomor', 'like', "%$search%")
                ->get();
        } else {
            $data = DB::table('eopr.mst_pks')
                ->select('mpks_pk', 'mpks_nomor')
                ->orderBy('mpks_pk')
                ->get();
        }
        return response()->json($data);
    }
}
