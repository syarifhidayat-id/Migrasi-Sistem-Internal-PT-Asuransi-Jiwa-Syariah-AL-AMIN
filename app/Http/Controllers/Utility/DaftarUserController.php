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
use Illuminate\Support\Facades\View;
use DataTables;

class DaftarUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = DaftarUser::all();
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
            'password_n' => 'required',
            'menu_tipe' => 'required',
        ],[
            'email.required'=>'Data username is required',
            'no_hp.string'=>'Data No Hp must be a string',
            'email.unique'=>'This data username is already taken',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'error' => $validasi->errors()
            ]);
        } else {
            if ($request->id == "" && $request->id == NULL) {
                $kode = KodeController::__getKey(4);
                $data = $request->all();
                if ($request->hasFile('img_bukti')) {
                    $img_bukti = $request->file('img_bukti');
                    $dir = 'public/utility/daftar-user/formulir';
                    $fileOri = $img_bukti->getClientOriginalName();
                    $nameBukti = $kode . '-DaftarUser-' . $fileOri;
                    $path = Storage::putFileAs($dir, $img_bukti, $nameBukti);
                    $data['img_bukti'] = $nameBukti;
                }
                if ($request->hasFile('img_foto')) {
                    $img_foto = $request->file('img_foto');
                    $dir = 'public/utility/daftar-user/foto';
                    $fileOri = $img_foto->getClientOriginalName();
                    $nameFoto = $kode . '-DaftarUser-' . $fileOri;
                    $path = Storage::putFileAs($dir, $img_foto, $nameFoto);
                    $data['img_foto'] = $nameFoto;
                }
                $data['id'] = $kode;
                $data['no_hp'] = '0' . str_replace('-', '', $request->no_hp);
                $data['email_user'] = $request->email_user . '@alamin.co.id';
                $data['password_n'] = Hash::make($request->password_n);
                $data['password_reg'] = '9';
                $data['active'] = '1';
                $data['groups'] = "['ALAMIN']";
                $data['activation_key'] = 'NULL';
                $data['extras'] = 'NULL';
                $data['temp'] = 'NULL';
                $data['lokasi'] = '01';
                $data['korwil'] = 'NULL';
                $data['menu_tipe_rpt'] = 'NULL';
                $data['groupuser'] = 'ALAMIN';
                $data['inbox'] = '0';
                $data['iplocal'] = '0';
                $data['lastlogin'] = '2022-10-01 21:28:51';
                $data['islive'] = '0';
                $data['jabatan'] = 'KBGIT';
                $data['bagian'] = '0';
                $data['ttdlevel'] = '0';
                $data['mrkn_kode_induk'] = '0';
                $data['mrkn_kode'] = '0';
                $data['rekan_tipe'] = '0';
                $data['ispst'] = '0';
                $data['isaprovrkn'] = '0';
                $data['isadmin'] = '0';
                $data['isregandro'] = '0';
                $data['tipemon'] = '0';
                $data['wmds_kode'] = 'NULL';
                $data['info'] = 'NULL';
                $data['foto'] = 'NULL';
                $data['mjns_kode'] = '07';
                $data['mkm_kode'] = '0';
                $data['mkm_kode2'] = '0';
                $data['mpol_kode'] = '0';
                $data['dboard'] = '0';
                $data['chat_tipe'] = 'CAB';
                $data['isautoemail'] = '0';
                $data['ischat'] = '0';
                $data['dirshare'] = '0';
                $data['pst_kumpulan'] = '0';
                $data['isdboard'] = '0';
                $data['isnews'] = '0';
                $data['pk_last'] = '0';
                $data['pk_count'] = '0';
                $data['pk_rpt'] = '0';
                $data['livevideo_hak'] = '0';
                $data['livevideo_ses'] = '01';
                $data['byr_cabang'] = '0';
                $data['tipe_login'] = '0';
                $data['mui_mntp_kode'] = 'ALM';
                $data['mui_mht_kode'] = 'HMALA';
                $data['mui_mtt_kode'] = 'ALT';
                $data['home_dash'] = '0';
                $data['home_menu'] = 'DEVIT';
                $data['mgu_kode'] = '000';
                $data['isdevmode'] = '0';

                User::create($data);

                return response()->json([
                    'success' => 'Data berhasil disimpan dengan Kode '.$kode.'!'
                ]);

            } else {
                $user = User::findOrFail($request->id);
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

    public function datauser(Request $request)
    {
        if ($request->ajax()) {
            $data = DaftarUser::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }
}
