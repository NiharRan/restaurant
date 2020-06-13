<?php 

class Requests extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		
		$this->data['page_title'] = 'Requests';
		$this->load->model('model_tables');
		$this->load->model('model_stores');
	}

	public function index()
	{	
		$this->render_template('requests/index', $this->data);
	}

	public function fetchRequestData()
	{
		if(!in_array('viewTable', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$result = array('data' => array());

		$data = $this->model_tables->getRequestData();

		foreach ($data as $key => $value) {
			// button
			$buttons = '';

			$buttons = '<button type="button" id="edit'.$value['request_id'].'" data-people="'.$value['people'].'" data-date="'.$value['date'].' '.$value['time'].'" class="btn btn-default" data-email="'.$value['email'].'" onclick="editFunc('.$value['request_id'].')" data-toggle="modal" data-target="#bookingModal"><i class="fa fa-pencil"></i></button>';
			if($value['request_checked'] == 0) $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['request_id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';

			$status = ($value['request_checked'] == 1) ? '<span class="label label-success">Done</span>' : '<span class="label label-warning">Pending</span>';

			$result['data'][$key] = array(
				$value['name'],
				$value['phone'],
				$value['email'],
				date("d-m-Y", strtotime($value['date'])),
				date("h:i A", strtotime($value['time'])),
				$value['people'],
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function create()
	{
		if(!in_array('createTable', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('table_name', 'Table name', 'trim|required');
		$this->form_validation->set_rules('capacity', 'Capacity', 'trim|integer');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');
		$this->form_validation->set_rules('store', 'Store', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'table_name' => $this->input->post('table_name'),
        		'available' => 1,
        		'capacity' => $this->input->post('capacity'),	
        		'active' => $this->input->post('active'),	
        		'store_id' => $this->input->post('store'),	
        	);

        	$create = $this->model_tables->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';			
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}

	public function fetchRequestDataById($id = null)
	{
		if($id) {
			$data = $this->model_tables->getRequestData($id);
			echo json_encode($data);
		}
		
	}

	public function update($id)
	{
		$response = array();

		if($id) {
			$data = array(
                'request_checked' => $this->input->post('edit_request_checked'),
            );

            $update = $this->model_tables->updateRequest($id, $data);
            if($update == true) {
                $response['success'] = true;
                $response['messages'] = 'Succesfully updated';
            }
            else {
                $response['success'] = false;
                $response['messages'] = 'Error in the database while updated the brand information';			
            }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}

	public function remove()
	{
		if(!in_array('deleteTable', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$request_id = $this->input->post('request_id');

		$response = array();
		if($request_id) {
			$delete = $this->model_tables->removeRequest($request_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

}