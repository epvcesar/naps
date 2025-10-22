<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\OrganizacoesModel;
use App\Models\ModulosModel;

class Organizacoes extends BaseController
{

	protected $organizacoesModel;
	protected $ModulosModel;
	protected $validation;

	public function __construct()
	{
		
		helper(['seguranca', 'formularios']);
		verificaSeguranca($this, session(), base_url());
		$this->organizacoesModel = new OrganizacoesModel();
		$this->ModulosModel = new ModulosModel();
		$this->validation =  \Config\Services::validation();
	}

	public function index()
	{

		$data = [
			'controller'    	=> 'organizacoes',
			'title'     		=> 'Organizações'
		];

		return view('organizacoes', $data);
	}

	public function mudaOrganizacao()
	{
		$response = array();
		$codOrganizacao = $this->request->getPost('codOrganizacao');

		if ($this->validation->check($codOrganizacao, 'required|numeric')) {

			session()->codOrganizacao = $codOrganizacao;
		}

		$response['success'] = true;
		$response['codOrganizacao'] = $codOrganizacao;
		return $this->response->setJSON($response);
	}


	public function getAll()
	{
		$response = $data['data'] = array();

		$result = $this->organizacoesModel->select()->findAll();

		foreach ($result as $key => $value) {

			$ops = '<div class="btn-group mt-4">';
			$ops .= '<button type="button" class=" btn btn-sm dropdown-toggle btn-info" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
			$ops .= '<i class="fa-solid fa-pen-square"></i>  </button>';
			$ops .= '<div class="dropdown-menu">';
			$ops .= '<a class="dropdown-item text-info" onClick="save(' . $value->codOrganizacao . ')"><i class="fa-solid fa-pen-to-square"></i>   ' .  lang("App.edit")  . '</a>';
			$ops .= '<a class="dropdown-item text-orange" ><i class="fa-solid fa-copy"></i>   ' .  lang("App.copy")  . '</a>';
			$ops .= '<div class="dropdown-divider"></div>';
			$ops .= '<a class="dropdown-item text-danger" onClick="remove(' . $value->codOrganizacao . ')"><i class="fa-solid fa-trash"></i>   ' .  lang("App.delete")  . '</a>';
			$ops .= '</div></div>';

			$data['data'][$key] = array(
				$value->codOrganizacao,
				$value->descricao,
				$ops
			);
		}

		return $this->response->setJSON($data);
	}

	public function getOne()
	{
		$response = array();

		$id = $this->request->getPost('codOrganizacao');

		if ($this->validation->check($id, 'required|numeric')) {

			$data = $this->organizacoesModel->where('codOrganizacao', $id)->first();

			return $this->response->setJSON($data);
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function listaDropDownOrganizacoes()
	{

		$result = $this->organizacoesModel->listaDropDownOrganizacoes();

		if ($result !== NULL) {


			return $this->response->setJSON($result);
		} else {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}


	public function listaDropDownOrganizacoesMenuPrincipal()
	{

		$response = array();
		$result = $this->organizacoesModel->listaDropDownOrganizacoes();

		if ($result !== NULL) {
			$response['listaOrganizacoes'] = $result;
			$response['codOrganizacao'] = session()->codOrganizacao;

			return $this->response->setJSON($response);
		} else {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function add()
	{
		$response = array();

		$fields['codOrganizacao'] = $this->request->getPost('codOrganizacao');
		$fields['descricao'] = $this->request->getPost('descricao');


		$this->validation->setRules([
			'descricao' => ['label' => 'Descricao', 'rules' => 'required|min_length[0]|max_length[100]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->getErrors(); //Show Error in Input Form

		} else {

			if ($this->organizacoesModel->insert($fields)) {

				$response['success'] = true;
				$response['messages'] = lang("App.insert-success");
			} else {

				$response['success'] = false;
				$response['messages'] = lang("App.insert-error");
			}
		}

		return $this->response->setJSON($response);
	}

	public function edit()
	{
		$response = array();

		$fields['codOrganizacao'] = $this->request->getPost('codOrganizacao');
		$fields['descricao'] = $this->request->getPost('descricao');


		$this->validation->setRules([
			'descricao' => ['label' => 'Descricao', 'rules' => 'required|min_length[0]|max_length[100]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->getErrors(); //Show Error in Input Form

		} else {

			if ($this->organizacoesModel->update($fields['codOrganizacao'], $fields)) {

				$response['success'] = true;
				$response['messages'] = lang("App.update-success");
			} else {

				$response['success'] = false;
				$response['messages'] = lang("App.update-error");
			}
		}

		return $this->response->setJSON($response);
	}

	public function remove()
	{
		$response = array();

		$id = $this->request->getPost('codOrganizacao');

		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {

			if ($this->organizacoesModel->where('codOrganizacao', $id)->delete()) {

				$response['success'] = true;
				$response['messages'] = lang("App.delete-success");
			} else {

				$response['success'] = false;
				$response['messages'] = lang("App.delete-error");
			}
		}

		return $this->response->setJSON($response);
	}
}
