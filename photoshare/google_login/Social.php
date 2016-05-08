<?php
/* -----------------------------------------------------------------------------------------
   IdiotMinds - http://idiotminds.com
   -----------------------------------------------------------------------------------------
*/
//For Facebook
require_once 'config.php';
require_once 'lib/facebook/facebook.php';
//For Google
require_once 'lib/google/Google_Client.php';
require_once 'lib/google/Google_Oauth2Service.php';


class Social{
  
 function facebook(){
     $facebook = new Facebook(array(
		'appId'		=>  APP_ID,
		'secret'	=> APP_SECRET,
		));
			//get the user facebook id		
			$user = $facebook->getUser();
			//echo $user;exit;
			if($user){
				try{
					//get the facebook user profile data
					$user_profile = $facebook->api('/me');
					$params = array('next' => BASE_URL.'logout.php');
					//logout url
					$logout =$facebook->getLogoutUrl($params);
					$_SESSION['User']=$user_profile;
					$_SESSION['facebook_logout']=$logout;
				}catch(FacebookApiException $e){
					error_log($e);
					$user = NULL;
				}		
			}
			if(empty($user)){
			  //login url	
			  $loginurl = $facebook->getLoginUrl(array(
							'scope'			=> 'email,read_stream, publish_actions, user_birthday, user_location, user_work_history, user_hometown, user_photos',
							'redirect_uri'	=> BASE_URL.'login.php?facebook',
							'display'=>'popup'
							));
			  header('Location: '.$loginurl);
			}
  
  }
    function google(){
	  
			$client = new Google_Client();
			$client->setApplicationName("Idiot Minds Google Login Functionallity");
			$client->setClientId(CLIENT_ID);
			$client->setClientSecret(CLIENT_SECRET);
			$client->setRedirectUri(REDIRECT_URI);
			$client->setApprovalPrompt(APPROVAL_PROMPT);
			$client->setAccessType(ACCESS_TYPE);
			$oauth2 = new Google_Oauth2Service($client);
			if (isset($_GET['code'])) {
			  $client->authenticate($_GET['code']);
			  $_SESSION['token'] = $client->getAccessToken();
			}
			if (isset($_SESSION['token'])) {
			 $client->setAccessToken($_SESSION['token']);
			}
			if (isset($_REQUEST['error'])) {
			 echo '<script type="text/javascript">window.close();</script>'; exit;
			}
			if ($client->getAccessToken()) {
			  $user = $oauth2->userinfo->get();
			  $_SESSION['User']=$user;
			  $_SESSION['token'] = $client->getAccessToken();
	
			} else {
			  $authUrl = $client->createAuthUrl();
			  header('Location: '.$authUrl);
			
			}
      }
  
  
  

}




?>