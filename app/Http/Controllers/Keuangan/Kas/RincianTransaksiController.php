<?php

namespace App\Http\Controllers\Keuangan\Kas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Library\KodeController;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class RincianTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = $request->all();

        return response()->json($data);
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
        //
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
        //
    }

    public function e_akun(Request $request)
    {
        // if (!isset($tipedk)) $tipedk="K";
        // if (!isset($ckorek)) $ckorek="0";
        // if (!isset($e_value)) $e_value="0";
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 200;
        $offset = ($page - 1) * $rows;
        // $vtable = DB::select(DB::raw("epms.P_AMBILAKUN_KASKOR('D', '01', '', '1')"));
        // $vtable = DB::raw("CALL epms.P_AMBILAKUN_KASKOR('D', '01', '', '1')");
        // $vtable = DB::table('epms')->select(DB::raw("epms.P_AMBILAKUN_KASKOR('K', '01', '0', '0')"))->get();
        // DB::raw("epms.P_AMBILAKUN_KASKOR")

        $vtable = DB::table('eacc.ams_sub_akun')
        ->select(DB::raw("asakn_kode, asakn_keterangan"))
        // ->where(DB::raw("LEFT(asakn_kode,3)"), '=', '550')
        ->whereRaw("LEFT(asakn_kode,3) = '550'")
        ->orderBy('asakn_kode');
        // ->get();


        $union = DB::table('eacc.ams_sub_akun')
        ->select(DB::raw("asakn_kode, asakn_keterangan"))
        ->where([
            ['asakn_mrpt_kode','NEROPR'],
            ['asakn_aakn_kode', '554','558']
            ])->orWhere([
                ['asakn_aakn_kode','540'],
                ['asakn_bnb','1']
            ]);

        if (!empty($request->q)) {
            $vtable->where('asakn_kode', 'LIKE', "%$request->q%")->orWhere('asakn_keterangan', 'LIKE', "%$request->q%");
        }

        // $tble = $vtable->merge($union);
        $data = $vtable
        ->offset($offset)
        ->limit($rows)
        ->union($union)
        ->get();
 
        return response()->json($data);
        // return $union;
    }
}
