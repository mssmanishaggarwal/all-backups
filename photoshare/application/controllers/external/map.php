�PNG

   IHDR   �   �   �>a�  �IDATx���q�@E�4. %�4T�� Jd�H	t@JP	)������X��־{ό2����̓N$�z����#�9������� �9va���cı �X q*�U�	�'�8@ ���cı ⬮�3�l�����cı �X q.^�&��Z�6��͵���^�:�R�mẕNn..@W�#�Z5l�&��M�\k�_��ϴ�"/��~����IR� PqG����F��/ PU|��J%� p���R� t���y9;z�ƺ~���3 蹧I7��FI��Y8�h8GO ��c�)���dB
 ��S	+ ��,���b�,�/5/��b�,<J�	 8��!��� ���2+�]�U�Y8�� ��7�	�,�CO ���h
�,��� �,|EV be�dJ`�������|	䳰\j~V=�g�Sff��[� ��6= �����E Pg��YX� �mz�+��]G5� ��2��fah�_f�#��1 ���8GF ڴ���� g�B	 �±��Y8�p@�,��c�uMH�ea���.�H��!S�'��|Y���/#Z ȓ��	/@�,�Jx [�DB��YpBF g�0:�,"�C��p�"5�Y��� �,�FR g�?4��,�C�f�,��Y���P^ �,� ����tZ�?���� ��f��B1-�jYh�Xh�d����s�����b�ܪ;�Ѧ��I���\�*����S����̇ q,�8@ ���c�Y�ޗ�@ �����˰؟�{�cı �����՘s����(<ı �X q,�8@�b�^��m��<X q,�8@ ���cı �X q,�8@�߾7�g����    IEND�B`�                                                               data($friend_id, $map_id);
		$this->load->view('header');
		$this->load->view('external/view_trip');
		$this->load->view('footer');
	}

	function view_multi_map($friend_id, $map_id) {
		$this->sanitization_urldata($friend_id, $map_id);
		$this->load->view('header');
		$this->load->view('external/view_multi_map');
		$this->load->view('footer');
	}

	function sanitization_urldata($friend_id, $map_id) {
		$session_data = $this->session->userdata('logged_in');
		//Cheking SQL Injection
		if (!filter_var($friend_id, FILTER_VALIDATE_INT) === true || !filter_var($map_id, FILTER_VALIDATE_INT) === true) {
			redirect('profile/news/');
			exit();
		}
		//Check presence of Account
		if ($this->logmodel->have_acc($friend_id) == 0) {
			redirect('profile/news/');
			exit();
		}
	}

}