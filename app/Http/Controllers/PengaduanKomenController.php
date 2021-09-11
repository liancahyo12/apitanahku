<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Models\PengaduanKomen;
use Illuminate\Http\Request;

class PengaduanKomenController extends Controller
{
    protected $user;
    protected $pengaduan;
 
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        // $this->pengaduan = new Pengaduan;
    }

    public function index()
    {
        // $pengaduankomen = App\Models\Pengaduan::with('pengaduankomens')->find($pengaduan_id);
    
        // if (!$pengaduankomen) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Sorry, pengaduan with id ' . $pengaduan_id . ' cannot be found'
        //     ], 400);
        // }
    
        // return $pengaduankomen;
        return $this->user
            ->pengaduankomens()
            ->get(['komen', 'created_at'])
            ->toArray();
    }

    // public function show($id)
    // {
    //     $pengaduankomens = $this->pengaduan->pengaduan()->find(all)->pengaduankomen;
    
    //     if (!$pengaduankomens) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Sorry, pengaduan with id ' . $id . ' cannot be found'
    //         ], 400);
    //     }
    
    //     return $pengaduankomens;
    // }

    public function store(Request $request, $id)
    {

        $this->validate($request, [
            'komen' => 'required|string'
        ]);
    
        $pengaduankomen = new pengaduankomen();
        $pengaduankomen->komen = $request->komen;
        $pengaduankomen->pengaduan_id = $id;
    
        if ($this->user->pengaduankomens()->save($pengaduankomen))
            return response()->json([
                'success' => true,
                'pengaduankomen' => $pengaduankomen
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, pengaduankomen could not be added'
            ], 500);
    }
}
