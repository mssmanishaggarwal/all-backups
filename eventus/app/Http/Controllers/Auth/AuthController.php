<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Common;
use App\User;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Mail;
use Validator;


class AuthController extends Controller {
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
	//sprotected $loginPath = '/login';
	//protected $afterLogin = '/dashboard';
	protected $redirectPath = '/register-thanks';

	/**
	 * Create a new authentication controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('guest', ['except' => 'logout']);
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data) {
		/*$messages = [
			'password.regex' => 'Password must have 1 number and 1 special characters!',
			];*/
		return Validator::make($data, [
			'first_name' => 'required|max:50',
			'last_name' => 'required|max:50',
			'email' => 'required|email|max:100|unique:users',
			'contact_number' => 'required|min:10|numeric|unique:users',
			'address' => 'required|max:255',
			'password' => 'required|min:6|max:50',
			'city' => 'required|max:255',
			'state' => 'required|max:255',
			'tne' => 'required|accepted',
		]);
	}

	/** confirmed|
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	protected function create(array $data, Request $request) {
		
		/*$to = $data['email'];
		$subject = 'Event us Angola, Complete Registration';
		$from = 'noreply@eventusangola.com';

		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		$headers .= 'From: ' . $from . "\r\n" .
		'CC: ' . 'kaushik.citytech@gmail.com' . "\r\n" .
		'Reply-To: ' . $from . "\r\n" .
		'X-Mailer: PHP/' . phpversion();

		$message = '<div class="thank-you">
        <h3>Hello ' . $data['first_name'] . ' ' . $data['last_name'] . '</h3>
        <h4>Please Complete your Registration by <a href="' . url('/') . '/complete-registration/' . $data['_token'] . '">by Clicking Here</a>  </h4>
        </div>';

		@mail($to, $subject, $message, $headers);*/
		
		// Email section start //
        $username = $data['first_name'];
        $fullname = $data['first_name'] . ' ' . $data['last_name'];
        $clickhere = '<a href="' . url('/') . '/complete-registration/' . $data['_token'] . '">by Clicking Here</a>';    
		$emailTemplate = Common::getEmaildata(1,$request->session()->get('language_id'));	
		$data['email_subject'] = $emailTemplate->email_subject;
		$headerText = $emailTemplate->email_body;
		$headerText = str_replace('[USERNAME]',$username,$headerText);
		$headerText = str_replace('[CLICKHERE]',$clickhere,$headerText);
		$headerText = str_replace('[NAME]',$fullname,$headerText);
		$headerText = str_replace('[EMAIL]',$data['email'],$headerText);
		$headerText = str_replace('[MOBILE]',$data['contact_number'],$headerText);
		$headerText = str_replace('[ADDRESS]',$data['address'],$headerText);		
		
		$data['body'] = $headerText;
		$subject = $emailTemplate->email_subject;		
		$toEmail = $data['email'];
			
		Mail::send('emails.email_template', ['data' => $data], function ($message) use ($data) {
			$fromEmail = Common::getSettingdata(2);	
			$toEmail = $data['email'];		
			$message->from($fromEmail, 'Eventus Angola');
			$message->to($toEmail)->subject($data['email_subject']);
		});	
        // Email section end //
		
		$request->session()->put('reg_email', $data['email']);
		return User::create([
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'email' => $data['email'],
			'contact_number' => $data['contact_number'],
			'password' => bcrypt($data['password']),
			'address' => $data['address'],
			'city' => $data['city'],
			'state' => $data['state'],
			'postcode' => $data['postcode'],
			'email_auth' => $data['_token'],
		]);

	}
}
