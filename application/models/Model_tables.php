<?php 

class Model_tables extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getTableData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM tables WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		// if admin all data 
		$user_id = $this->session->userdata('id');
		if($user_id == 1) {
			$sql = "SELECT * FROM tables ORDER BY id DESC";
			$query = $this->db->query($sql);
			return $query->result_array();	
		}
		else {
			$this->load->model('model_users');
			$user_data = $this->model_users->getUserData($user_id);
			$sql = "SELECT * FROM tables WHERE store_id = ? ORDER BY id DESC";
			$query = $this->db->query($sql, array($user_data['store_id']));
			return $query->result_array();		
		}

		// else store wise

		
	}

	public function create($data = array())
	{
		if($data) {
			$create = $this->db->insert('tables', $data);
			return ($create == true) ? true : false;
		}
	}

	public function booking($data = array())
	{
		if($data) {
			$create = $this->db->insert('table_bookings', $data);
			return ($create == true) ? true : false;
		}
	}

	public function update($id = null, $data = array())
	{		
		$this->db->where('id', $id);
		$update = $this->db->update('tables', $data);

		return ($update == true) ? true : false;
	}

	public function remove($id = null)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('tables');
			return ($delete == true) ? true : false;
		}
	}

	public function getActiveTable()
	{
		$user_id = $this->session->userdata('id');
		if($user_id == 1) {
			$sql = "SELECT * FROM tables WHERE available = ? AND active = ?";
			$query = $this->db->query($sql, array(1, 1));
			return $query->result_array();	
		}
		else {
			$this->load->model('model_users');
			$user_data = $this->model_users->getUserData($user_id);
			$sql = "SELECT * FROM tables WHERE store_id = ? AND available = ? AND active = ? ORDER BY id DESC";
			$query = $this->db->query($sql, array($user_data['store_id'], 1, 1));
			return $query->result_array();			
		}
	}

	public function getAllTable()
	{
		$user_id = $this->session->userdata('id');
		if($user_id == 1) {
			$sql = "SELECT * FROM tables";
			$query = $this->db->query($sql);
			return $query->result_array();	
		}
		else {
			$this->load->model('model_users');
			$user_data = $this->model_users->getUserData($user_id);
			$sql = "SELECT * FROM tables WHERE store_id = ? ORDER BY id DESC";
			$query = $this->db->query($sql, array($user_data['store_id']));
			return $query->result_array();			
		}
	}
		

	public function getBookingTable()
	{
		$user_id = $this->session->userdata('id');
		if($user_id == 1) {
			$sql = "SELECT * FROM tables WHERE available = ? AND active = ?";
			$query = $this->db->query($sql, array(2, 1));
			return $query->result_array();	
		}
		else {
			$this->load->model('model_users');
			$user_data = $this->model_users->getUserData($user_id);
			$sql = "SELECT * FROM tables WHERE store_id = ? AND available = ? AND active = ? ORDER BY id DESC";
			$query = $this->db->query($sql, array($user_data['store_id'], 2, 1));
			return $query->result_array();			
		}
	}

	public function countTotalUncheckedRequests()
	{
		return $this->db->select('*')
						->from('booking_requests')
						->where('request_checked', 0)
						->get()
						->num_rows();
	}

	public function getRequestData($id = null)
    {
		if($id) {
			$sql = "SELECT * FROM booking_requests WHERE request_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}else {
			return $this->db->select('*')
						->from('booking_requests')
						->get()
						->result_array();
		}
	}

	public function updateRequest($id = null, $data = array())
	{		
		$this->db->where('request_id', $id);
		$update = $this->db->update('booking_requests', $data);

		return ($update == true) ? true : false;
	}

	public function removeRequest($id = null)
	{
		if($id) {
			$this->db->where('request_id', $id);
			$delete = $this->db->delete('booking_requests');
			return ($delete == true) ? true : false;
		}
	}
}