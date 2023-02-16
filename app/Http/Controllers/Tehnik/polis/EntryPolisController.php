<?php

namespace App\Http\Controllers\Tehnik\Polis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EntryPolisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.tehnik.polis.entry-master-polis.create');
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
        $data = $request->except(
            '_token',
            'judul',
            'e_nasabah',
            'e_manfaat',
            'e_jenisprod',
            'endors',
            'e_pras',
            'e_bersih',
            'e_cabalamin',
            'e_marketing',
            'e_pinca',
            'e_tarif',
            'e_uw',
        );
        $data['mpol_va_via'] = __str2($request['mpol_va_via'], 'MS');
        $data['mpol_playonline_via'] = __str2($request['mpol_playonline_via'], 'MS');
        $data['mpol_agent_via'] = __str2($request['mpol_agent_via'], 'MS');
        $data['mpol_mprov_berlaku'] = __str2($request['mpol_mprov_berlaku'], 'MS');

        return __json($data);
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
}
