<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('loginRegView');
	}

	public function register() {
		$result = $this->User->validateReg($this->input->post());
		if ($result == 'valid') {
			$this->User->register($this->input->post());
			$this->session->set_userdata(array('id' => $this->db->insert_id(), 'name' => $this->input->post('name')));
			$this->session->set_flashdata("success", "You have successfully registered. Please log in.");
			redirect("/");
		} else {
			$this->session->set_flashdata("regErrors", $result);
			redirect("/");
		}
	}
	public function login() {
		$result = $this->User->validateLogin($this->input->post());
		if ($result == 'valid') {
			$userInfo = $this->User->get_user($this->input->post('username'));
			if ($userInfo) {
				if ($this->input->post('password') == $userInfo['password']) {
					$this->session->set_userdata(array('id' => $userInfo['id'], "name" => $userInfo['name']));
					redirect('/travels');
				} else {
					$this->session->set_flashdata("badPassword", "Wrong Password");
					redirect('/');
				}
			} else {
				$this->session->set_flashdata("noUsername", "No such username found");
				redirect('/');
			}
		} else {
			$this->session->set_flashdata('loginErrors', $result);
			redirect('/');
		}
	}
}
