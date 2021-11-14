<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\User;
use App\Models\PengaduanKomen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboardAdmin()
    {
        $countnew = Pengaduan::where('case_status', 1)->get()->count();
        $countall = Pengaduan::get()->count();
        $countdone = Pengaduan::where('case_status', 3)->get()->count();
        $countuser = User::get()->count();

        if(Auth::guard('admin')->check()){
            return view('home')
            ->with(compact('countnew'))
            ->with(compact('countall'))
            ->with(compact('countdone'))
            ->with(compact('countuser'));
        }
  
        return redirect("login")->with('prosesError', 'Silahkan login terlebih dahulu');
    }

    public function show()
    {
        if(Auth::guard('admin')->check()){
            $pengaduan = Pengaduan::leftJoin('users', 'pengaduans.user_id', '=', 'users.id')->select('pengaduans.*', 'users.name')->get();
            

            // return view('daftarpengaduan', [
            //     'pengaduan' => Pengaduan::all()
            // ]);
            return view('daftarpengaduan', compact('pengaduan'));
        }
  
        return redirect("login")->with('prosesError', 'Silahkan login terlebih dahulu');
        
    }

    public function detail($id)
    {
        if(Auth::guard('admin')->check()){
            $pengaduanb = Pengaduan::leftJoin('users', 'pengaduans.user_id', '=', 'users.id')->where('pengaduans.id', $id)->select('pengaduans.*', 'users.name')->first();

            $komen = PengaduanKomen::leftJoin('users', 'pengaduan_komens.user_id', '=', 'users.id')->leftJoin('admins', 'pengaduan_komens.admin_id', '=', 'admins.id')->where('pengaduan_id', $id)->select('pengaduan_komens.*', 'admins.admin_name', 'users.name')->get();

            if (!$pengaduanb) {
                return redirect("pengaduan");
            }
            if (!$komen) {
                return redirect("pengaduan");
            }
            return view('detailpengaduan', compact('pengaduanb'), compact('komen'));
        }
        return redirect("login")->with('prosesError', 'Silahkan login terlebih dahulu');
        
    }

    public function update_proses(Request $request, $id)
    {
        if(Auth::guard('admin')->check()){
            $pengaduan = Pengaduan::where('id', $id)->first();
    
            if (!$pengaduan) {
                // return redirect("pengaduan");
                return back()->with('prosesError', 'Error');
            }

            $pengaduan->case_status=2;
            $pengaduan->process_at=Carbon::now()->toDateTimeString();;
            $updated = $pengaduan->save();
        
            if ($updated) {
                return back()->with('prosesBerhasil', 'Berhasil memproses pengaduan');
            } else {
                return back()->with('prosesError', 'Error');
            }
        }
        return redirect("login")->with('prosesError', 'Silahkan login terlebih dahulu');
        
    }

    public function update_close(Request $request, $id)
    {
        if(Auth::guard('admin')->check()){
            $pengaduan = Pengaduan::where('id', $id)->first();
    
            if (!$pengaduan) {
                // return redirect("pengaduan");
                return back()->with('loginError', 'Error');
            }

            $pengaduan->case_status=3;
            $pengaduan->process_at=Carbon::now()->toDateTimeString();;
            $updated = $pengaduan->save();
        
            if ($updated) {
                return back()->with('prosesBerhasil', 'Berhasil menyelesaikan pengaduan');
            } else {
                return back()->with('prosesError', 'Error');
            }
        }
        return redirect("login")->with('prosesError', 'Silahkan login terlebih dahulu');
        
    }

    public function balas(Request $request, $id)
    {
        if(Auth::guard('admin')->check()){
            $pengaduankomen = $request->validate([
            'komen' => 'required|string'
            ]);

            $pengaduan = Pengaduan::where('id', $id)->first();
        
            if (!$pengaduan) {
                // return redirect("pengaduan");
                return back()->with('prosesError', 'Error');
            }

            // return $request;

            $pengaduankomen['komen'] = $request->komen;
            $pengaduankomen['pengaduan_id'] = $id;
            $pengaduankomen['admin_id'] = Auth::guard('admin')->user()->id;
        
            if (PengaduanKomen::create($pengaduankomen))
                return back()->with('prosesBerhasil', 'Berhasil membalas pesan');
            else
                return back()->with('prosesError', 'Error');
        }
        return redirect("login")->with('prosesError', 'Silahkan login terlebih dahulu');
        
    }

}
