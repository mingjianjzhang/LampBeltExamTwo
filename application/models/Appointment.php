<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends CI_Model {

	// public function validateAppointment($apptInfo) {
	// 	$this->load->library('form_validation');
	// 	$this->form_validation->set_rules('date', "Date", "trim|required");
	// 	$this->form_validation->set_rules('time', "Time", "trim|required");
	// 	$this->form_validation->set_rules('task', "Task", "trim|required");
		
	// 	if ($this->form_validation->run()) {
	// 		return "valid";
	// 	} else {
	// 		return validation_errors();
	// 	}
	// }

	public function addAppt($apptInfo) {
		$query = "INSERT INTO appointments (task, date, time, status, user_id, created_at, updated_at) VALUES (?, STR_TO_DATE(?, '%Y-%m-%d'), CAST(? AS TIME), 'Pending', ?, NOW(), NOW())";
		$values = array($apptInfo['task'], date('Y-m-d', strtotime($apptInfo['date'])), $apptInfo['time'], $apptInfo['user_id']);
		return $this->db->query($query, $values);
	}

	public function getTodaysAppts($userID) {
		$today = date("Y-m-d");
		$query = "SELECT a.task, a.time, a.status, a.id FROM appointments a JOIN users u ON u.id = a.user_id WHERE date = CAST(? as DATE) AND u.id = ?";
		$values =  array($today, $userID);
		return $this->db->query($query, $values)->result_array();
	}

	public function getOtherAppts($userID) {
		$today = date("Y-m-d");
		$query = "SELECT a.task, a.date, a.time, a.id FROM appointments a JOIN users u on u.id = a.user_id WHERE date > CAST(? as DATE) AND u.id = ? ";
		$values = array($today, $userID);
		return $this->db->query($query, $values)->result_array();
	}

	public function deleteAppt($apptID) {
		$query = "DELETE FROM appointments WHERE id = ?";
		$values = array($apptID);
		return $this->db->query($query, $values);
	}

	public function isOccupied($date, $time, $userID) {
		$query = "SELECT * FROM appointments WHERE date = ? AND time = ? AND user_id = ?";
		$values = array(date('Y-m-d', strtotime($date)), $time, $userID);
		return $this->db->query($query, $values)->row_array();
	}
	public function test($apptInfo) {
		return $this->isOccupied($apptInfo['date'], $apptInfo['time']);
	}

	public function getAppt($apptID) {
		$query = "SELECT * FROM appointments WHERE id = ?";
		$values = array($apptID);
		return $this->db->query($query, $values)->row_array();
	}

	public function validateAppt($apptInfo, $formType) {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('date', "Date", "trim|required");
		$this->form_validation->set_rules('time', "Time", "trim|required");
		$this->form_validation->set_rules('task', "Task", "trim|required");
		$errors = array();
		$apptDate = new DateTime($apptInfo['date']);
		$current_date = new DateTime();
		$apptTime = explode(":", $apptInfo['time']);
		if (count($apptTime) > 1) {
			$apptDate->setTime($apptTime[0], $apptTime[1]);
		}
		if ($apptDate < $current_date) {
			$errors['tooEarly'] = "Your appointment cannot be made in the past .. check your hours.";
		}
		if ($formType == "add") {
			if (($this->isOccupied($apptInfo['date'], $apptInfo['time'], $apptInfo['user_id'])) != null) {
				$errors['occupied'] = "You already have an appointment scheduled at that time.";
			}
		}
		if (!$this->form_validation->run()) {
			$errors['missingFields'] = validation_errors();
		}

		if (count($errors)) {
			return $errors;
		} else {
			return "valid";
		}
	}

	public function updateAppt($apptInfo) {
		$query = "UPDATE appointments SET task = ?, status = ?, date = ?, time = ? WHERE id = ?";
		$values = array($apptInfo['task'], $apptInfo['status'], date('Y-m-d', strtotime($apptInfo['date'])), $apptInfo['time'], $apptInfo['id']);
		return $this->db->query($query, $values);
	}

	public function checkStatus($apptID) {
		$query = "SELECT status FROM appointments WHERE id = ?";
		$values = array($apptID);
		$status = $this->db->query($query, $values)->row_array();
		return $status['status'];
	}

}