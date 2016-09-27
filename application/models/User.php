<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

	public function login() {

	}

	public function get_user($email) {
		return $this->db->query("SELECT id, name, password FROM users WHERE email = '$email'")->row_array();
	}

	public function register($userInfo) {
		$query = "INSERT INTO users (name, email, dob, password, created_at, updated_at) VALUES (?, ?, STR_TO_DATE(?, '%Y-%m-%d'), ?, NOW(), NOW())";
		$values = array($userInfo['name'], $userInfo['email'], date('Y-m-d', strtotime($userInfo['dob'])), $userInfo['password']);
		return $this->db->query($query, $values);
	}

	public function validateReg($info) {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', "Name", "trim|required|min_length[3]");
		$this->form_validation->set_rules('email', "email", "trim|required|min_length[3]");
		$this->form_validation->set_rules('password', "Password", "trim|required|min_length[6]|matches[confirm_password]");
		$this->form_validation->set_rules('confirm_password', "Confirm Password", "trim|required");
		$this->form_validation->set_rules('dob', "DOB", "trim|required");
		$errors = array();
		if ($info['dob']) {
			$dob = new DateTime($info['dob']);
			$fiveyearsago = new DateTime();
			$fiveyearsago->modify('-5 year');

			if ($dob > $fiveyearsago) {
				$errors['tooYoung'] = "You must be at least 5 years old to use this site... sorry kid.";
			}
		}
		if (!$this->form_validation->run()) {
			$errors['regErrors'] = validation_errors();
		}
		if (count($errors)) {
			return $errors;
		} else {
			return "valid";
		}
	}

	public function validateLogin($info) {
		$this->load->library('form_validation');

		$this->form_validation->set_rules("email", "Email", "trim|required|min_length[3]");
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[6]");
		if($this->form_validation->run()) {
			return "valid";
		} else {
			return validation_errors();
		}
	}



}