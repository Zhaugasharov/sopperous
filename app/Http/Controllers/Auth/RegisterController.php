<?php

namespace App\Http\Controllers\Auth;

use App\Models\City;
use App\User;
use App\Http\Controllers\Controller;
use App\Models\UserCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/';

    public function showRegistrationForm()
    {
        $data['cities'] = City::getCityList();
        return view('auth.register', $data);
    }

    public function confirmation($email, $token){

        $userModel = User::where(['email' => $email, 'token' => $token])->first();

        if(empty($userModel->id)) return redirect('/')
                                            ->with(['error' => 'Пользователь не найден или неверный ключ!']);

        $userModel->token = '';
        $userModel->confirm = 1;
        $userModel->save();

        return redirect('/')
                ->with(['success' => 'Учетная запись подтвержден! Регистрация успешно завершена!']);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

       // $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath())
                ->with(['success' => 'Регистрация прошла успешно! Проверьте Вашу почту для подтверждения регистраций!']);
    }


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
            'fname' => 'required|string|max:255',
            'sname' => 'required|string|max:255',
            'pname' => 'required|string|max:255',
            'cname' => 'required|string|max:255',
            'city_id' => 'required|integer|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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
        $user = User::create([
            'fname' => $data['fname'],
            'sname' => $data['sname'],
            'pname' => $data['pname'],
            'role_id' => 3,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'token' => str_random(50),
            'confirm' => 0
        ]);

        $company = UserCompany::create([
            'logo' => '',
            'name' => $data['cname'],
            'address' => $data['address'],
            'city_id' => $data['city_id'],
            'phone' => $data['phone'],
            'user_id' => $user->id
        ]);

        $user->company_id = $company->id;
        $user->save();

        $data['token']  = $user->token;

        Mail::send('email.registration', $data, function($message) use ($data)
        {
            $message->from('no-reply@sam.gpp.kz', "sam.gpp.kz");
            $message->subject("Добро пожаловать!");
            $message->to($data['email']);
        });

        return $user;
    }
}
