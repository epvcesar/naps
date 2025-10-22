<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Services;

use App\Models\LogsModel;
use App\Models\ColaboradoresModel;
use App\Models\OrganizacoesModel;


use App\Models\PacientesModel;

class Pacientes extends BaseController
{

	protected $pacientesModel;
	protected $LogsModel;
	protected $ColaboradoresModel;
	protected $OrganizacoesModel;
	protected $organizacao;
	protected $codOrganizacao;
	protected $validation;

	public function __construct()
	{

		helper(['notificacoes', 'seguranca', 'formularios', 'pdf', 'alertas']);
		verificaSeguranca($this, session(), base_url());
		$this->LogsModel = new LogsModel();
		$this->ColaboradoresModel = new ColaboradoresModel();
		$this->OrganizacoesModel = new OrganizacoesModel();
		$this->pacientesModel = new PacientesModel();

		$this->validation =  \Config\Services::validation();
	}

	public function index()
	{


		$data = [
			'controller'    	=> 'pacientes',
			'title'     		=> 'pacientes'
		];

		return view('pacientes', $data);
	}

	public function getAll()
	{
		$response = $data['data'] = array();

		$result = $this->pacientesModel->pegaTudo();

		foreach ($result as $key => $value) {



			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-primary" onclick="savePacientes(' . $value->codPaciente . ')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-danger" data-bs-toggle="tooltip" data-placement="top" title="Remover" onclick="removePacientes(' . $value->codPaciente . ')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->codPaciente,
				$value->nomeCompleto,
				$value->cpf,
				$value->preccp,
				$value->siglaCargo,

				$ops
			);
		}

		return $this->response->setJSON($data);
	}

	public function listaDropDownPostoGraduacao()
	{

		$result = $this->pacientesModel->listaDropDownPostoGraduacao();

		if ($result !== NULL) {


			return $this->response->setJSON($result);
		} else {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}


	public function listaDropDownPacientes()
	{

		$result = $this->pacientesModel->listaDropDownPacientes();

		if ($result !== NULL) {


			return $this->response->setJSON($result);
		} else {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}



	public function getOne()
	{
		$response = array();

		$id = $this->request->getPost('codPaciente');

		if ($this->validation->check($id, 'required|numeric')) {

			$data = $this->pacientesModel->pegaPorCodigo($id);

			return $this->response->setJSON($data);
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function add()
	{
		$response = array();



		$fields['nomeCompleto'] = $this->request->getPost('nomeCompleto');
		$fields['codOrganizacao'] = session()->codOrganizacao;
		$fields['cpf'] = $this->request->getPost('cpf');
		$fields['preccp'] = $this->request->getPost('preccp');
		$fields['postoGraduacao'] = $this->request->getPost('postoGraduacao');

		//VERIFICAR SE CPF JA EXISTE


		if ($this->pacientesModel->verificaCPF($fields['cpf']) !== NULL) {

			$response['success'] = false;
			$response['messages'] = 'CPF já existe';

			return $this->response->setJSON($response);
		}

		if ($this->pacientesModel->verificaPreccp($fields['preccp']) !== NULL) {

			$response['success'] = false;
			$response['messages'] = 'preccp já existe';

			return $this->response->setJSON($response);
		}

		$this->validation->setRules([
			'codPaciente' => ['label' => 'CodPaciente', 'rules' => 'permit_empty'],
			'nomeCompleto' => ['label' => 'Nome', 'rules' => 'permit_empty|min_length[0]|max_length[150]'],
			'cpf' => ['label' => 'CPF', 'rules' => 'required|min_length[0]|max_length[14]'],
			'preccp' => ['label' => 'PRECCP', 'rules' => 'required|min_length[0]|max_length[14]'],
			'postoGraduacao' => ['label' => 'Posto/Grad', 'rules' => 'permit_empty|min_length[0]|max_length[11]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->getErrors(); //Show Error in Input Form

		} else {

			if ($codPaciente = $this->pacientesModel->insert($fields)) {

				$response['success'] = true;
				$response['codPaciente'] = $codPaciente;
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


		$fields['codPaciente'] = $this->request->getPost('codPaciente');
		$fields['nomeCompleto'] = $this->request->getPost('nomeCompleto');
		$fields['cpf'] = $this->request->getPost('cpf');
		$fields['preccp'] = $this->request->getPost('preccp');
		$fields['postoGraduacao'] = $this->request->getPost('postoGraduacao');


		$this->validation->setRules([
			'codPaciente' => ['label' => 'CodPaciente', 'rules' => 'required|numeric|min_length[0]|max_length[11]'],
			'nomeCompleto' => ['label' => 'Nome', 'rules' => 'permit_empty|min_length[0]|max_length[150]'],
			'cpf' => ['label' => 'CPF', 'rules' => 'required|min_length[0]|max_length[14]'],
			'preccp' => ['label' => 'PRECCP', 'rules' => 'required|min_length[0]|max_length[14]'],
			'postoGraduacao' => ['label' => 'Posto/Grad', 'rules' => 'permit_empty|min_length[0]|max_length[11]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->getErrors(); //Show Error in Input Form

		} else {

			if ($this->pacientesModel->update($fields['codPaciente'], $fields)) {

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



		$id = $this->request->getPost('codPaciente');

		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {

			if ($this->pacientesModel->where('codPaciente', $id)->delete()) {

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
