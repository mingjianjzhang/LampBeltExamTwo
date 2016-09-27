<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointments extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->output->enable_profiler();
		$this->load->model("Appointment");
	}

	public function index() {
		$data = array();
		$data['todaysAppts'] = $this->Appointment->getTodaysAppts($this->session->id);
		$data['otherAppts'] = $this->Appointment->getOtherAppts($this->session->id);
		$this->load->view('appointmentsView', $data);
	}

	public function addAppointment() {

		$result = $this->Appointment->validateAppt($this->input->post(), "add");
		if ($result == 'valid') {
			$this->Appointment->addAppt($this->input->post());
		} else {
			$this->session->set_flashdata("errors", $result);
		}
		redirect("/appointments");
	}

	public function edit($apptID) {
		if ($this->Appointment->checkStatus($apptID) == "Done") {
			echo "Sorry, you can't modify an appointment marked as 'Done'";
		} else {
			$this->load->view("updateAppointment", $this->Appointment->getAppt($apptID));
		}
	}

	public function updateAppt() {
		$result = $this->Appointment->validateAppt($this->input->post(), "update");
		if ($result == "valid") {
			$this->Appointment->updateAppt($this->input->post());
			redirect("/appointments");

		} else {
			$this->session->set_flashdata("errors", $result);
			redirect("/appointments/edit/".$this->input->post('id'));

		}

	}
	public function delete($apptID) {
		if ($this->Appointment->checkStatus($apptID) == "Done") {
			echo "Sorry, you can't modify an appointment marked as 'Done'";
		}
		else {
			$this->Appointment->deleteAppt($apptID);
			redirect("/appointments");
		}
	}

	// public function test() {
	// 	var_dump($this->Appointment->validateAppt($this->input->post()));
	// }




}