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

class DraftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View('pages.legal.draft_pks.index');
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
        if ($request->mdp_pk == "") {
            $kode = KodeController::__getKey(14);
            $data = $request->all();
            $data = request()->except(['_token']);

            if ($request->hasFile('mdp_dokumen')) {
                $mdp_dokumen = $request->file('mdp_dokumen');
                $dir = 'public/legal/pks/draftpks';
                $fileOri = $mdp_dokumen->getClientOriginalName();
                $nameBukti = $kode . '_draftpks_' . $fileOri;
                $path = Storage::putFileAs($dir, $mdp_dokumen, $nameBukti);
                $data['mdp_dokumen'] = $nameBukti;
            }

            $data['mdp_pk'] = $kode;
            $data['mdp_ins_user'] = $request->user()->email;
            $data['mdp_ins_date'] = date('Y-m-d H:i:s');
            $data['mdp_indexfolder'] = 0;
            $insert = DB::table('emst.mst_draft_pks')->insert($data);

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
            $draft = DB::table('emst.mst_draft_pks')
                ->where('mdp_pk', '=', $request->mdp_pk)
                ->first();

            $data = request()->except(['_token']);

            $oldFile = 'public/legal/pks/draftpks/' . $draft->mdp_dokumen;

            if ($request->hasFile('mdp_dokumen')) {
                $mdp_dokumen = $request->file('mdp_dokumen');
                $dir = 'public/legal/pks/draftpks';
                $fileOri = $mdp_dokumen->getClientOriginalName();
                $nameBukti = $request->mdp_pk . '_draftpks_' . $fileOri;
                Storage::delete($oldFile);
                $path = Storage::putFileAs($dir, $mdp_dokumen, $nameBukti);
                $data['mdp_dokumen'] = $nameBukti;
            }

            $data['mdp_upd_user'] = $request->user()->email;
            $data['mdp_upd_date'] = date('Y-m-d H:i:s');

            $update = DB::table('emst.mst_draft_pks')
                ->where('mdp_pk', '=', $request->mdp_pk)
                ->update($data);

            if ($update) {
                return response()->json([
                    'success' => 'Data berhasil diupdate dengan Kode ' . $request->mdp_pk . '!'
                ]);
            } else {
                return response()->json([
                    'error' => 'Data dengan kode ' . $request->mdp_pk . ' gagal di update !'
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
        $pks = DB::table('emst.mst_draft_pks')
            ->where('mdp_pk', $id)
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
        // $pks = Pks::findOrFail($id);
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
        $draft = DB::table('emst.mst_draft_pks')
            ->where('mdp_pk', '=', $id)
            ->first();
        $oldFile = 'public/legal/pks/draftpks/' . $draft->mdp_dokumen;

        if ($oldFile) {
            Storage::delete($oldFile);
        }

        $delete = DB::table('emst.mst_draft_pks')
            ->where('mdp_pk', '=', $id)
            ->delete();
        if ($delete) {
            return response()->json([
                'success' => 'Data berhasil dihapus dengan Kode ' . $draft->mdp_pk . '!'
            ]);
        } else {
            return response()->json([
                'error' => 'Gagal menghapus data dengan kode' . $draft->mdp_pk . '!'
            ]);
        }
    }

    public function api_draft(Request $request)
    {
        // $data = DB::table('esur.trs_surat')->select(
        //     '*',
        //     DB::raw("@no:=@no+1 AS DT_RowIndex"),
        //     DB::raw('DATE_FORMAT(tsm_ins_date, "%d-%m-%Y") as ins_date')
        // )

        $data = DB::table('emst.mst_draft_pks')
            // ->join('emst.mst_rekanan as rekanan', 'rekanan.mrkn_kode', '=', 'pks.mpks_mrkn_kode')
            ->select(
                '*',
                // 'rekanan.mrkn_kode',
                // 'rekanan.mrkn_nama',
                DB::raw("@no:=@no+1 AS DT_RowIndex"),
                DB::raw('DATE_FORMAT(mdp_ins_date, "%d-%m-%Y") as ins_date')
                // DB::raw('(CASE WHEN pks.mpks_mrkn_kode = rekanan.mrkn_kode THEN rekanan.mrkn_nama END) as kode_rekanan')
            )
            ->orderBy('mdp_pk', 'desc')->limit(10);

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
                        $w->orWhere('mdp_tentang', 'LIKE', "%$search%")
                            ->orWhere('mdp_pk', 'LIKE', "%$search%");
                    });
                }
            })
            ->make(true);
        // }
    }

    function mssp_kode($id)
    {
        $data = DB::table('emst.mst_produk_segment')
            ->select('mssp_kode', 'mssp_nama')
            ->where('mssp_kode', $id)
            // ->where('mssp_nama', 'like', "%$search%")
            ->first();
        return response()->json($data);
    }

    public function select_mssp(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('emst.mst_produk_segment')
                ->select('mssp_kode', 'mssp_nama')
                ->where('mssp_nama', 'like', "%$search%")
                ->orderBy('mssp_kode')
                ->get();
        } else {
            $data = DB::table('emst.mst_produk_segment')
                ->select('mssp_kode', 'mssp_nama')
                ->orderBy('mssp_kode')
                ->get();
        }
        return response()->json($data);
    }
}
