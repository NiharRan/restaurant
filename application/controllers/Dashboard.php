<?php 

class Dashboard extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();


		$this->data['page_title'] = 'Dashboard';
		
		$this->load->model('model_products');
		$this->load->model('model_orders');
		$this->load->model('model_users');
		$this->load->model('model_stores');
	}

	public function index()
	{

		$this->data['total_products'] = $this->model_products->countTotalProducts();
		$this->data['total_paid_orders'] = $this->model_orders->countTotalPaidOrders();
		$this->data['total_users'] = $this->model_users->countTotalUsers();
		$this->data['total_stores'] = $this->model_stores->countTotalStores();
		$this->data['booking_requests'] = $this->model_tables->countTotalUncheckedRequests();

		$tables = $this->model_tables->getAllTable();
		$total_tables = count($tables);
		$total_inactive_tables = 0;
		$total_available_tables = 0;
		$total_booked_tables = 0;

		foreach ($tables as $table) {
			if($table['active'] == 0) $total_inactive_tables++;
			else {
				if ($table['available'] == 1) $total_available_tables++;
				else $total_booked_tables++;
			}
		}
		$this->data['total_tables'] = $total_tables;
		$this->data['total_inactive_tables'] = $total_inactive_tables;
		$this->data['total_available_tables'] = $total_available_tables;
		$this->data['total_booked_tables'] = $total_booked_tables;

		$user_id = $this->session->userdata('id');
		$is_admin = ($user_id == 1) ? true :false;

		$this->data['is_admin'] = $is_admin;
		$this->render_template('dashboard', $this->data);
	}
}