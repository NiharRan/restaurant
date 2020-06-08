<?php 

class Model_web extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
    }

    public function store_booking_request_info($data)
    {
        return $this->db->insert('booking_requests', $data);
    }

    public function fetchCompanyInfo()
    {
        return $this->db->select("*")->from("company")->get()->row_array();
    }
}