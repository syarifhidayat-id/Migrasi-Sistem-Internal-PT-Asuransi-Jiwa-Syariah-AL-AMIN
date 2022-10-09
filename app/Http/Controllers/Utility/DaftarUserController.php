<?php

namespace App\Http\Controllers\Utility;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\KodeController;
use App\Models\User;
use App\Models\Utility\DaftarUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DaftarUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $ftipe_menu = DB::table('web_menu_tipe')
        ->select('wmt_kode','wmt_nama')
        ->get();
        return view('pages.utility.daftar-user.index', [
            'user' => $user,
            'tipe_menu' => $ftipe_menu,
        ]);
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
        $validasi = Validator::make($request->all(), [
            'email' => 'required',
            'no_hp' => 'required',
            'email_user' => 'required',
            'email_cc' => 'required',
            'name' => 'required',
            'password' => 'required',
            'menu_tipe' => 'required',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'error' => $validasi->errors()
            ]);
        } else {
            if ($request->id == "") {
                $kode = KodeController::__getKey(4);
                $img_bukti = $request->file('img_bukti');
                $img_foto = $request->file('img_foto');

                if ($img_bukti) {
                    $file = $img_bukti;
                    $dir = 'public/utility/daftar-user/formulir';
                    $name = $kode . '-DaftarUser-' . $file->getClientOriginalName();
                    $path = Storage::putFileAs(
                        $dir,
                        $file,
                        $name
                    );

                    $request->merge([ 'img_bukti' => $name ]);
                }

                if ($img_foto) {
                    $file = $img_foto;
                    $dir = 'public/utility/daftar-user/foto';
                    $name = $kode . '-DaftarUser-' . $file->getClientOriginalName();
                    $path = Storage::putFileAs(
                        $dir,
                        $file,
                        $name
                    );

                    $request->merge([ 'img_foto' => $name ]);
                }

                $request->merge([
                    'id' => $kode,
                    'no_hp' => '0' . str_replace('-', '', $request->no_hp),
                    'email_user' => $request->email_user . '@alamin.co.id',
                    'password' => Hash::make($request->password),
                    'password_reg' => '9',
                    'active' => '1',
                    'groups' => "['ALAMIN']",
                    'activation_key' => 'NULL',
                    'extras' => 'NULL',
                    'temp' => 'NULL',
                    'lokasi' => '01',
                    'korwil' => 'NULL',
                    'menu_tipe_rpt' => 'NULL',
                    'groupuser' => 'ALAMIN',
                    'inbox' => '0',
                    'iplocal' => '0',
                    'lastlogin' => '2022-10-01 21:28:51',
                    'islive' => '0',
                    'jabatan' => 'KBGIT',
                    'bagian' => '0',
                    'ttdlevel' => '0',
                    'mrkn_kode_induk' => '0',
                    'mrkn_kode' => '0',
                    'rekan_tipe' => '0',
                    'ispst' => '0',
                    'isaprovrkn' => '0',
                    'isadmin' => '0',
                    'isregandro' => '0',
                    'tipemon' => '0',
                    'wmds_kode' => 'NULL',
                    'vtmp1' => 'NULL',
                    'vtmp2' => 'NULL',
                    'vtmp3' => 'NULL',
                    'info' => 'NULL',
                    'foto' => 'NULL',
                    'mjns_kode' => '07,13,',
                    'mkm_kode' => '0',
                    'mkm_kode2' => '0',
                    'mpol_kode' => '0',
                    'dboard' => '0',
                    'chat_tipe' => 'CAB,',
                    'isautoemail' => '0',
                    'ischat' => '0',
                    'dirshare' => '0',
                    'pst_kumpulan' => '0',
                    'isdboard' => '0',
                    'isnews' => '0',
                    'pk_last' => '0',
                    'pk_count' => '0',
                    'pk_rpt' => '0',
                    'livevideo_hak' => '01',
                    'livevideo_ses' => '01',
                    'byr_cabang' => '0',
                    'tipe_login' => '0',
                    'mui_mntp_kode' => 'ALM',
                    'mui_mht_kode' => 'HMALA',
                    'mui_mtt_kode' => 'ALT',
                    'home_dash' => '0',
                    'home_menu' => 'DEVIT',
                    'mgu_kode' => '000',
                    'isdevmode' => '0',
                ]);

                // $nullRequests=[
                //     'img_bukti',
                //     'img_foto',
                //     'foto',
                // ];
                // $nullRequests = array_merge_recursive($nullRequests, KodeController::nullRequests($request->all()));
                DaftarUser::create($request->all());
                // DB::table('user_accounts')->insert($request->except(['_token']));

                // DaftarUser::create($request->except($nullRequests));
                // return $request->all();

                return response()->json([
                    'success' => 'Data berhasil disimpan dengan Kode '.$kode.'!'
                ]);

            } else {
                $user = DaftarUser::findOrFail($request->id);
                $user->update($request->all());

                return response()->json([
                    'success' => 'Data berhasil diupdate dengan Kode '.$request->id.'!'
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
