<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\LogsModel;

class Home extends BaseController
{

	protected $LogsModel;
	protected $validation;

	public function __construct()
	{

		helper(['seguranca', 'formularios']);
		verificaSeguranca($this, session(), base_url());
		$this->LogsModel = new LogsModel();
		$this->validation =  \Config\Services::validation();
	}

	public function index()
	{


		$data = [
			'controller'    	=> 'Home',
			'title'     		=> 'Home'
		];

		return view('home', $data);
	}



}
