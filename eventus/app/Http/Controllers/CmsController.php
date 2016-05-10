<?php

namespace App\Http\Controllers;
use App\Helper\Languagehelper;
use App\Models\Common;
use Illuminate\Http\Request;
use Mail;
use Sitevariable;

class CmsController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		//$this->middleware('auth');
	}
	public function languageSetter(Request $request) {
		$data = array();
		/* SET DEFAULT LANGUAGE START */
		$data['languages'] = Languagehelper::getLanguage();
		$data['default_language'] = Languagehelper::getDefaultLanguage();

		$language_id = $request->session()->get('language_id');
		if (empty($language_id)) {
			$request->session()->put('language_id', $data['default_language']);
			$data['language_val'] = $data['default_language'];
			$data['currentlanguages'] = $data['default_language'];

		} else {
			$data['language_val'] = $language_id;
			$data['currentlanguages'] = $language_id;
		}
		$data['secondary_header'] = 0;
		return $data;
	}

	public function termCondition(Request $request) {
		$data = $this->languageSetter($request);
		$data['cms_id'] = 2;
		$data['cmsArr'] = Common::cmsdata($data['language_val'], 2);
		return view('cms.termcondition', ['data' => $data]);
	}
	public function aboutUs(Request $request) {
		$data = $this->languageSetter($request);
		$data['cms_id'] = 3;
		$data['cmsArr'] = Common::cmsdata($data['language_val'], 3);
		return view('cms.aboutus', ['data' => $data]);
	}
	public function privacyPolicy(Request $request) {
		$data = $this->languageSetter($request);
		$data['cms_id'] = 4;
		$data['cmsArr'] = Common::cmsdata($data['language_val'], 4);
		return view('cms.privacy', ['data' => $data]);
	}

	public function showNews(Request $request) {
		$data = $this->languageSetter($request);
		$data['cms_id'] = 7;
		$data['news'] = Common::allNews($data['language_val']);
		return view('cms.news', ['data' => $data]);
	}
	
	public function showFaq(Request $request) {
		$data = $this->languageSetter($request);
		$data['faq'] = Common::allFaq($data['language_val']);
		return view('cms.faq', ['data' => $data]);
	}

	public function contactUs(Request $request) {
		$data = $this->languageSetter($request);
		$data['cms_id'] = 6;
		$data['cmsArr'] = Common::cmsdata($data['language_val'], 6);
		return view('cms.contactus', ['data' => $data]);
	}
	public function contactUsValidate(Request $request) {
		$data = $this->languageSetter($request);
		$messages = [
			'firstname.required' => Sitevariable::setVariables($data['language_val'],'eventus_1') .' '. Sitevariable::setVariables($data['language_val'],'eventus_54'),
			'lastname.required' => Sitevariable::setVariables($data['language_val'],'eventus_2') .' '. Sitevariable::setVariables($data['language_val'],'eventus_54'),
			'email.required' => Sitevariable::setVariables($data['language_val'],'eventus_3') .' '. Sitevariable::setVariables($data['language_val'],'eventus_54'),
			'subject.required' => Sitevariable::setVariables($data['language_val'],'eventus_49') .' '. Sitevariable::setVariables($data['language_val'],'eventus_54'),
			'address.required' => Sitevariable::setVariables($data['language_val'],'eventus_50') .' '. Sitevariable::setVariables($data['language_val'],'eventus_54'),
			'sum.required' => Sitevariable::setVariables($data['language_val'],'eventus_55') .' '. Sitevariable::setVariables($data['language_val'],'eventus_54'),
		];
		$this->validate($request, [
			'firstname' => 'required|max:255',
			'lastname' => 'required|max:255',
			'email' => 'required|email|max:255',
			'subject' => 'required|max:255',
			'address' => 'required|max:255',
			'sum' => 'required|numeric|min:11|max:11',
		], $messages);
		//exit();
		return $this->sendContactMail($request);
		//print_r($formdata);
	}
	public function sendContactMail(Request $request) {		
		$data = $this->languageSetter($request);
		 // Email section start //            
		$emailTemplate = Common::getEmaildata(9,$data['language_val']);	
		$data['email_subject'] = $emailTemplate->email_subject;
		$headerText = $emailTemplate->email_body;
		$headerText = str_replace('[FIRST_NAME]',$request->firstname,$headerText);
		$headerText = str_replace('[LAST_NAME]',$request->lastname,$headerText);
		$headerText = str_replace('[EMAIL]',$request->email,$headerText);
		$headerText = str_replace('[SUBJECT]',$request->subject,$headerText);
		$headerText = str_replace('[COMMENT]',$request->address,$headerText);
		
		$data['body'] = $headerText;				
		
		Mail::send('emails.email_template', ['data' => $data], function ($message) use ($data) {
			$fromEmail = Common::getSettingdata(2);			
			$toEmail = Common::getSettingdata(14);			
			$message->from($fromEmail, 'Eventus Angola');
			$message->to($toEmail)->subject($data['email_subject']);
		});
        // Email section end // 		
		
		return json_encode(array('success' => 'Your contact request has been sent successfully.'));

	}

}
