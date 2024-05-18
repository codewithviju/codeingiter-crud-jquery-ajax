<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("userModel");
	}
	public function index()
	{
		$this->load->view("welcome_message");
	}

	public function getAllData()
	{
		$criteria     		   = array();
		$action 			   = $this->input->post("action");
		$searchVal			   = $this->input->post("searchVal");
		if(!empty($searchVal))
		{
			$criteria['searchVal'] = $searchVal;
		}

		if($action == "delete")
		{
			$criteria 			= array();
			$criteria['UserID'] = $this->input->post("UserID");
			$this->userModel->deleteUser($criteria);
		}

		$allUsers     = $this->userModel->getAllData($criteria);
		$data['data'] = $allUsers;
		$this->load->view("_users",$data);
	}

	public function new()
	{
		$returnRes  			= array();
		$criteria 				= array();
		$UserID 				= $this->input->post("UserID");
		$criteria['Username'] 	= $this->input->post("username");
		$criteria['Email'] 		= $this->input->post("email");
		$criteria['Marks'] 		= $this->input->post("marks");

		if(!empty($criteria['Email']) || !empty($criteria['Marks']))
		{
			if(!empty($UserID))
			{
				$where 			 = array();
				$where['UserID'] = $UserID;
				$id				 = $this->userModel->update($where,$criteria);
			}
			else
			{
				$id = $this->userModel->insert($criteria);
			}

			if($id)
			{
				$returnRes['Status'] = "200";
				$returnRes['Message'] = "User Added Successfully";
			}
			else
			{
				$returnRes['Status'] = "200";
				$returnRes['Message'] = "User Not Added";
			}
		}
		echo json_encode($returnRes);
	}

	public function getByID()
	{
		$criteria 			= array();
		$criteria['UserID'] = $this->input->post('UserID');
		$user 				= $this->userModel->getByID($criteria);
		echo json_encode($user);
	}
}
