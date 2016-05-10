<?php

namespace App\Http\Controllers\AdminAuth;
use Auth;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';
	protected $guard = 'admins';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest', ['except' => 'logout']);
         //$this->middleware('admins', ['except' => ['logout', 'getLogout']]);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    
    public function showLoginForm()
	{		
	    if (view()->exists('auth.authenticate')) {
	        return view('auth.authenticate');
	    }

	    return view('admin.auth.login');
	}
	public function showRegistrationForm()
	{
	    return view('admin.auth.register');
	} 
	
	public function login(Request $request)
	{
		$email = Input::get('email');
      	$password = Input::get('password');
      	
      	 $this->validate($request, [
        'email' => 'required',
        'password' => 'required',
    	]);

		if(Auth::guard('admins')->attempt(['email' => $email, 'password' => $password]))
		{
			/*echo '<pre>';
			print_r(Auth::guard('admins')->check());
			exit;*/
			return Redirect::to('/admin');
		}	
			
		else
		{
			//return Redirect::back()->withMessage('Invalid credentials');
			return view('admin.auth.login')->withErrors('Invalid credentials');
		}
		
	} 
	
	public function getLogout()
    {
        Auth::Logout();
        \Session::flush();
        return Redirect::to('/admin/login');
    }
    
   
	
}
