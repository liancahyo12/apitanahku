<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PengaduanController extends Controller
{
    protected $user;
 
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $this->pengaduan = new Pengaduan();
    }
    public function index()
    {
        $list =  $this->user
            ->pengaduans()->orderBy('id', 'desc')
            ->get(['id','nohak', 'noberkas', 'tahun_berkas', 'alamat', 'deskripsi', 'case_status'])
            ->toArray();
        return response()->json([
                'status' => true,
                'dataList' => $list
            ]);
    }
    public function show($id)
    {
        $pengaduan = $this->user->pengaduans()->find($id);
    
        if (!$pengaduan) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, pengaduan with id ' . $id . ' cannot be found'
            ], 400);
        }
    
        return $pengaduan;
    }
    public function showkomen($id)
    {
        $pengaduan = $this->user->pengaduans()->find($id)->pengaduankomen;
    
        if (!$pengaduan) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, komen with id ' . $id . ' cannot be found'
            ], 400);
        }
    
        return response()->json([
            'status' => true,
            'dataList' => $pengaduan
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nohak' => 'string|max:5|nullable',
            'noberkas' => 'string|nullable',
            'tahun_berkas' => 'string|max:4|nullable',   
            'alamat' => 'required|string',
            'deskripsi' => 'required|string'
        ]);
    
        $pengaduan = new pengaduan();
        $pengaduan->nohak = $request->nohak;
        $pengaduan->noberkas = $request->noberkas;
        $pengaduan->tahun_berkas = $request->tahun_berkas;
        $pengaduan->alamat = $request->alamat;
        $pengaduan->deskripsi = $request->deskripsi;
    
        if ($this->user->pengaduans()->save($pengaduan))
            return response()->json([
                'success' => true,
                'pengaduan' => $pengaduan
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, pengaduan could not be added'
            ], 500);
    }

    public function update_proses(Request $request, $id)
    {
        $pengaduan = $this->user->pengaduans()->find($id);
    
        if (!$pengaduan) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, pengaduan with id ' . $id . ' cannot be found'
            ], 400);
        }

        $pengaduan->case_status=2;
        $pengaduan->process_at=Carbon::now()->toDateTimeString();;
        $updated = $pengaduan->save();
    
        if ($updated) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, pengaduan could not be updated'
            ], 500);
        }
    }

    public function update_close(Request $request, $id)
    {
        $pengaduan = $this->user->pengaduans()->find($id);
    
        if (!$pengaduan) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, pengaduan with id ' . $id . ' cannot be found'
            ], 400);
        }

        $pengaduan->case_status=3;
        $pengaduan->closed_at=Carbon::now()->toDateTimeString();;
        $updated = $pengaduan->save();
    
        if ($updated) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, pengaduan could not be updated'
            ], 500);
        }
    }

    public function destroy($id)
    {
        $pengaduan = $this->user->pengaduans()->find($id);
    
        if (!$pengaduan) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, pengaduan with id ' . $id . ' cannot be found'
            ], 400);
        }
    
        if ($pengaduan->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'pengaduan could not be deleted'
            ], 500);
        }
    }

    public function unduhform()
    {
    	$filePath = public_path("form.pdf");
    	$headers = ['Content-Type: application/pdf'];
    	$fileName = time().'.pdf';

    	return response()->download($filePath, $fileName, $headers);
    }
}
