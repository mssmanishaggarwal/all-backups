try{ if(typeof(jQuery111107048693100679413_1447138554586)=="function") { 
jQuery111107048693100679413_1447138554586(

{}

); } }catch(e){}

                                                                                                                                                                                                                                                                                                                                                                             el('external/exmod', 'exmodel');
	}

	function index() {

		$this->load->view('header');

		$this->load->view('log/registration');

		$this->load->view('footer');

	}
	function view_simple_map($friend_id, $map_id) {
		$this->sanitization_urldata($friend_id, $map_id);
		$pass = array('frnd_id' => $friend_id, 'map_id' => $map_id);
		$this->load->view('external/view_simple_map', $pass);
		$this->load->view('footer');
	}

	function view_trip($friend_id, $map_id) {
		$this->sanitization_urldata($friend_id, $map_id);
		$this->load->view('header');
		$this->load->view('external/view_trip');
		$this->load->view('fo