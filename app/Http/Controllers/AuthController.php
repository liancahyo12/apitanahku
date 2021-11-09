<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Admin;
use Validator;
// Use Auth;



class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('auth:api', ['except' => ['login', 'register']], 'verified');
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // $role = Auth::user()->role;
        // if($role == 2){
        //     if (! $token = auth()->attempt($validator->validated())) {
        //         return response()->json(['error' => 'Unauthorized'], 401);
        //     }
        // } else {
        //     return redirect()->to('logout');
        // }
        $loginuser = auth()->guard('user')->attempt($validator->validated());
        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Email atau password salah'], 401);
        }

        return $this->createNewToken_user($token);
    }

    public function login_admin(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // $role = Auth::user()->role;
        // if($role == 2){
        //     if (! $token = auth()->attempt($validator->validated())) {
        //         return response()->json(['error' => 'Unauthorized'], 401);
        //     }
        // } else {
        //     return redirect()->to('logout');
        // }

        if (! $token = auth()->guard('admin')->attempt($validator->validated())) {
            Session::flash('error', 'Email atau password salah');
            return redirect()->route('login');
        }
        return redirect()->route('home');
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password' => 'required|string|confirmed|min:8',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));
        // event(new Registered($user));
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user,
            // 'error' => 'false'
        ], 201);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken_refresh(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json(auth()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken_user($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 1440,
            'user' => auth()->guard('user')->user()
        ]);
    }
    protected function createNewToken_refresh($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 1440,
            'user' => auth()->user()
        ]);
    }

    public function showFormLogin()
    {
        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            return redirect()->route('home');
        }
        return view('login');
    }
    
    public function logoutadmin()
    {
        Auth::logout(); // menghapus session yang aktif
        return redirect()->route('login');
    }
}