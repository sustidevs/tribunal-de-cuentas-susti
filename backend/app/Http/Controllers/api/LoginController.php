<?php

namespace App\Http\Controllers\api;

use app\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return "Vista Login.";
    }

    public function verificar(){
        return Auth::guest();
    }

    public function logout()
    {
        Auth::logout();
        return ('ola');
    }

        /**
         * PROXIMAMENTE EN DESUSO... CUANDO FRONT SOLUCIONE ENVIAR TOKEN => UTILIZAR authenticate_new
         */
    public function authenticate_old(LoginRequest $request)
    {
       /*
        $request = new Request;
        $request->cuil = '20101234564';
        $request->password = 'password';
        */
            if ($request->validated())
            {
                $credentials = ['cuil'=> $request->cuil,'password'=>$request->password];

                if (Auth::attempt($credentials))
                {
                    $user = Auth::user();
                    //$token = $user->createToken('my-app-token')->plainTextToken;
                    if ($user->remember_token != null)
                    {
                        $token = $user->createToken($user->remember_token)->plainTextToken;
                    }
                    else
                    {
                        $token = $user->createToken(Str::random(10))->plainTextToken;
                    }
                    $response = ["user" => $user->datos_user(), "token" => $token];
                    return response()->json($response, 200);
                    //return response($response, 201);
                }
                else
                {
                    $response = "El CUIL y la contraseña no coinciden. Vuelva a intentarlo.";
                    return response()->json($response, 201);
                }
            }
    }

    /**
     * Método para autenticar un usuario y loquearlo en el sistema,
     * genera un token para utilizar la API
     * @param: cuil
     * @param: password
     * Autor: Mariano Flores
     */
    public function authenticate(LoginRequest $request)
    {        
        $user = ModelsUser::where("cuil", "=", "$request->cuil")->first();
        $user->tokens()->delete();
        if(isset($user->id))
        {
            if(Hash::check($request->password, $user->password))
            {
                $token = $user->createToken("auth_token")->plainTextToken;
                return response()->json([
                    "status" => 1,
                    "mensaje" => "usuario logueado exitosamente",
                    "access_token" => $token
                ], 200);
            }
            else
            {
                return response()->json([
                    "status" => 0,
                    "mensaje" => "contraseña incorrecta",
                ], 404);
            }
        }
        else
        {
            return response()->json([
                "status" => 0,
                "mensaje" => "usuario no registrado",
            ], 404);
        }
    }
}
