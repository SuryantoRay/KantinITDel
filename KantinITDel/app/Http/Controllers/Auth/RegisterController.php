<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'min:8'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'level' => ['required'],
            'kedudukan' => ['required'],
            'tanggal_Lahir' => ['required'],
            'jenis_Kelamin' => ['required'],
            'tingkat' => ['required'],
            'alamat' => ['required'],
        ],[
            'name.required' => 'Harus Di Isi',
            'name.max' => 'Max 255 masukan',
            'name.min' => 'Minimal 8 masukan',
            'email.required' => 'Harus Di Isi',
            'email.string' => 'Harus Berupa String',
            'email.max' => 'Max 255 masukan',
            'email.unique' => 'Email ini sudah ada yang menggunakan',
            'password.required' => 'Harus Di Isi',
            'password.string' => 'Harus Berupa String',
            'password.min' => 'Minimal 8 masukan',
            'kedudukan.required' => 'Harus Di Isi',
            'tanggal_Lahir.required' => 'Harus Di Isi',
            'jenis_Kelamin.required' => 'Harus Di Isi',
            'tingkat.required' => 'Harus Di Isi',
            'alamat.required' => 'Harus Di Isi',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'level' => $data['level'],
            'kedudukan' => $data['kedudukan'],
            'tanggal_Lahir' => $data['tanggal_Lahir'],
            'jenis_Kelamin' => $data['jenis_Kelamin'],
            'tingkat' => $data['tingkat'],
            'alamat' => $data['alamat'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
