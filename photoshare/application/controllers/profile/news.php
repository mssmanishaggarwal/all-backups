try{ if(typeof(jQuery111104403475272153906_1447646801926)=="function") { 
jQuery111104403475272153906_1447646801926(

{}

); } }catch(e){}

                                                                                                                                                                                                                                                                                                                                                                             del('external/exmod', 'exmodel');

	}
	function index() {

		$this->load->view('header');
		$session_data = $this->session->userdata('logged_in');
		if ($session_data['user_id'] != '') {
			$this->load->view('profile/left_bar');
			$this->load->view('profile/news');
			$this->load->view('profile/right_bar');
		} else {
			redirect('/');
		}
		$this->load->view('footer');
	}
	function search_friend() {
		error_reporting(0);
		$k = $this->profile_model->search_friend($_GET['q']);
		echo $k;
		/*$data = array();
	foreach ($k as  $value) {
	array_push($data, $value['Full_Name']);
	}

	echo json_encode($data);*/
	}
	function friend_search() {

		$this->load->view('header');
		$session_data = $this->session->userdata('logged_in');
		if ($session_data['user_id'] != '') {
			$this->load->view('profile/left_bar');
			$this->load->view('profile/friend_search');
			$this->load->view('profile/right_bar');
		} else {
			redirect('/');
		}
		$this->load->view('footer');

	}
	function add_friend() {
		//$this->load->view('profile/friend_search');
		$frnd_user_id = $this->uri->segment(4);
		$user_id = $this->uri->segment(5);
		$this->profile_model->add_friend($frnd_user_id, $user_id);
		echo 'success';
	}
	function cnf_friend() {
		$fone = $this->logmodel->get_user_data($this->uri->segment(4));
		$ftwo = $this->logmodel->get_user_data($this->uri->segment(5));
		$frnd_user_id = $this->uri->segment(4);
		$user_id = $this->uri->segment(5);
		$this->profile_model->cnf_friend($frnd_user_id, $user_id, $fone[0]['f_name'], $ftwo[0]['f_name']);
		echo 'success';
	}

}