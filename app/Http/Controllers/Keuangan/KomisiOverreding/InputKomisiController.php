<?php

namespace App\Http\Controllers\Keuangan\KomisiOverreding;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class InputKomisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.keuangan.komisi-overreding.input.index');
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
        //
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

    public function inputKomisi(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('web_menu')->select(DB::raw("wmn_kode, wmn_icon, wmn_descp, wmn_tipe, wmn_url_n, wmn_url_o_n"))->get();
            return DataTables::of($data)
            ->addIndexColumn()
            // ->filter (function ($instance) use ($request) {
            //     if ($request->get('check_1') == "1") {
            //         if (!empty($request->get('wmn_tipe'))) {
            //             $instance->collection = $instance->collection->filter(function ($row) use ($request) {
            //                 return Str::contains($row['wmn_tipe'], $request->get('wmn_tipe')) ? true : false;
            //             });
            //         }
            //     }
            //     if ($request->get('check_2') == "1") {
            //         if (!empty($request->get('wmn_descp'))) {
            //             $instance->collection = $instance->collection->filter(function ($row) use ($request) {
            //                 return Str::contains($row['wmn_descp'], $request->get('wmn_descp')) ? true : false;
            //             });
            //         }
            //     }
            //     if (!empty($request->get('search'))) {
            //         $instance->collection = $instance->collection->filter(function ($row) use ($request) {
            //             if (Str::contains(Str::lower($row['wmn_tipe']), Str::lower($request->get('search')))){
            //                 return true;
            //             }else if (Str::contains(Str::lower($row['wmn_descp']), Str::lower($request->get('search')))) {
            //                 return true;
            //             }

            //             return false;
            //         });
            //     }
            // })
            ->make(true);
        }
    }
}
