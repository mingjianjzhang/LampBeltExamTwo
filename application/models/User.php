<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function login() {

	}

	public function register() {
		
	}

	public function validateReg($info) {
		$this->form_validation->set_rules('name', "Name", "trim|required|min_length[3]");
		$this->form_validation->set_rules('username', "Username", "trim|required|min_length[3]");
		$this->form_validation->set_rules('password', "Password", "trim|required|min_length[6]|matches[confirm_password]");
		$this->form_validation->set_rules('confirm_password', "Confirm Password", "trim|required");
		if($this->form_validation->run()) {
			return "valid";
		} else {
			return validation_errors();
		}
	}

	public function validateLogin($info) {
		$this->form_validation->set_rules("username", "Username", "trim|required|min_length[3]");
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[6]");
		if($this->form_validation->run()) {
			return "valid";
		} else {
			return validation_errors();
		}
	}



}