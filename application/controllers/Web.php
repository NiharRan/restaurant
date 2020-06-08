<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_web');
		$this->load->model('model_products');
	}

	/* 
		Check if the index form is submitted, and validates the user credential
		If not submitted it redirects to the index page
	*/
	public function index()
	{
        $data['restaurant'] = $this->model_web->fetchCompanyInfo();
        $data['products'] = $this->model_products->getSomeProductData(6);
        $this->load->view('web/index', $data);
    }

    function booking_a_table()
    {
        $jsonData = array('check' => false, 'success' => false, 'errors' => array());

        $rules = array(
            array('field' => 'name', 'label' => 'Name', 'rules' => 'required'),
            array('field' => 'date', 'label' => 'Booking Date', 'rules' => 'required'),
            array('field' => 'time', 'label' => 'Booking Time', 'rules' => 'required'),
            array('field' => 'phone', 'label' => 'Contact Number', 'rules' => 'required'),
            array('field' => 'people', 'label' => 'Number of people', 'rules' => 'required'),
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        if ($this->form_validation->run() == TRUE) {
            $jsonData['check'] = true;
            $data = array(
                'name' => $this->input->post('name'),
                'date' => date("Y-m-d", strtotime($this->input->post('date'))),
                'time' => date("H:i:s", strtotime($this->input->post('time'))),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'people' => $this->input->post('people'),
                'message' => $this->input->post('message')
            );

            $result = $this->model_web->store_booking_request_info($data);
            if ($result) {
                $jsonData['success'] = true;
            }
        }else {
            foreach ($_POST as $key => $value) {
                $jsonData['errors'][$key] = form_error($key);
            }
        }

        echo json_encode($jsonData);
    }
}