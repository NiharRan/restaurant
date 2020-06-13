<?php 

class Tables extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		
		$this->data['page_title'] = 'Tables';
		$this->load->model('model_tables');
		$this->load->model('model_stores');
	}

	public function index()
	{	
		$store_data = $this->model_stores->getActiveStore();
		$this->data['store_data'] = $store_data;
		$this->render_template('tables/index', $this->data);
	}

	public function fetchTableData()
	{
		if(!in_array('viewTable', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$result = array('data' => array());

		$data = $this->model_tables->getTableData();

		foreach ($data as $key => $value) {

			$store_data = $this->model_stores->getStoresData(1);

			// button
			$buttons = '';

			if(in_array('updateTable', $this->permission)) {
				$buttons = '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deleteTable', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
				if ($value['available'] == 1) {
					$buttons .= ' <button type="button" class="btn btn-default" onclick="bookingFunc('.$value['id'].')" data-toggle="modal" data-target="#bookingModal"><i class="fa fa-plus"></i></button>';
				}
			}

			$available = ($value['available'] == 1) ? '<span class="label label-success">Available</span>' : '<span class="label label-warning">Unavailable</span>';
			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$store_data['name'],
				$value['table_name'],
				$value['capacity'],
				$available,
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function fetchAvailableTableData()
	{	
		$result = array('data' => array());

		$data = $this->model_tables->getActiveTable();

		$output = '<option value="">Select Table</option>';
		foreach ($data as $table) {
			$output .= '<option value="'.$table['id'].'">'.$table['table_name'].'</option>';
		} // /foreach

		echo json_encode($output);
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

	public function fetchTableDataById($id = null)
	{
		if($id) {
			$data = $this->model_tables->getTableData($id);
		}elseif (isset($_POST['table_id'])) {
			$table_ids = $this->input->post("table_id");
			$data = $this->db->select("*")->from("tables")->where_in("id", $table_ids)->get()->result_array();
		}
		echo json_encode($data);
	}

	public function update($id)
	{
		if(!in_array('updateTable', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_table_name', 'Table name', 'trim|required');
			$this->form_validation->set_rules('edit_capacity', 'Capacity', 'trim|integer');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');
			$this->form_validation->set_rules('edit_store', 'Store', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'table_name' => $this->input->post('edit_table_name'),
        			'capacity' => $this->input->post('edit_capacity'),	
        			'active' => $this->input->post('edit_active'),	
        			'store_id' => $this->input->post('edit_store'),	
	        	);

	        	$update = $this->model_tables->update($id, $data);
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
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
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
		
		$table_id = $this->input->post('table_id');

		$response = array();
		if($table_id) {
			$delete = $this->model_tables->remove($table_id);
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

	public function booking($id=null)
	{
		if(!in_array('deleteTable', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('booking_start', 'Start Time', 'trim|required');
			$this->form_validation->set_rules('booking_end', 'End Time', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
				$request_id = $this->input->post("request_id");
	        	$data = array(
        			'available' => 2,	
				);
				$booking_start = date('Y-m-d H:i:s', strtotime($this->input->post('booking_start')));
				$booking_end = date('Y-m-d H:i:s', strtotime($this->input->post('booking_end')));
				$bookingData = array(
					'table_id' => $id,
					'booking_start' => $booking_start,
					'booking_end' => $booking_end,
					'booking_status' => 1,
					'booking_doc' => date("Y-m-d H:i:s"),
				);

				$update = $this->model_tables->update($id, $data);
				$this->db->set("request_checked", 1)->set("request_confirmed_at", date("Y-m-d H:i:s"))->where('request_id', $request_id)->update("booking_requests");
				$result = $this->model_tables->booking($bookingData);
	        	if($update && $result) {
					$response['success'] = true;
					$response['messages'] = 'Succesfully updated'; 
					
					$this->sendMail();
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the brand information';			
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		elseif (isset($_POST['table_id'])) {
			$this->form_validation->set_rules('booking_start', 'Start Time', 'trim|required');
			$this->form_validation->set_rules('booking_end', 'End Time', 'trim|required');
			$this->form_validation->set_rules('table_id[]', 'End Time', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
			if ($this->form_validation->run() == TRUE) {
				$table_ids = $this->input->post("table_id");
				$request_id = $this->input->post("request_id");
				foreach ($table_ids as $id) {
					$data = array(
						'available' => 2,	
					);
					
					$bookingData = array(
						'table_id' => $id,
						'booking_start' => date('Y-m-d H:i:s', strtotime($this->input->post('booking_start'))),
						'booking_end' => date('Y-m-d H:i:s', strtotime($this->input->post('booking_end'))),
						'booking_status' => 1,
						'booking_doc' => date("Y-m-d H:i:s"),
					);

					$update = $this->model_tables->update($id, $data);
					$result = $this->model_tables->booking($bookingData);
					if($update == true) {
						$response['success'] = true;
						$response['messages'] = 'Succesfully updated';
						$this->sendMail();
					}
					else {
						$response['success'] = false;
						$response['messages'] = 'Error in the database while updated the brand information';			
					}
				}
				$this->db->set("request_checked", 1)->set("request_confirmed_at", date("Y-m-d H:i:s"))->where('request_id', $request_id)->update("booking_requests");
			} else {
				# code...
			}
			
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}


	function sendMail()
	{
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from('niharranjandasmu@gmail.com'); // change it to yours
		$this->email->to($this->input->post('request_email'));// change it to yours
		$this->email->subject('Table booking confirmation');
		$this->email->message('<h1>Your table booking request is accepted successfully!</h1>');
		$this->email->send();

	}

}