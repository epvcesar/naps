<?php
// Desenvolvido por Emanuel Peixoto Vicente

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Services;

use App\Models\LogsModel;
use App\Models\ColaboradoresModel;
use App\Models\OrganizacoesModel;

use App\Models\PortalOrganizacaoModel;

class PortalOrganizacao extends BaseController
{

	protected $PortalOrganizacaoModel;
	protected $ColaboradoresModel;
	protected $OrganizacoesModel;
	protected $Organizacao;
	protected $codOrganizacao;
	protected $validation;

	public function __construct()
	{

		helper(['seguranca', 'formularios']);
		verificaSeguranca($this, session(), base_url());
		$this->PortalOrganizacaoModel = new PortalOrganizacaoModel();
		$this->OrganizacoesModel = new OrganizacoesModel();
		$this->LogsModel = new LogsModel(); // $this->LogsModel->inserirLog('descrição da ocorrencia',$codColaborador);
		$this->validation =  \Config\Services::validation();
		$this->codOrganizacao = session()->codOrganizacao;
		$this->Organizacao =  $this->OrganizacoesModel->pegaOrganizacao($this->codOrganizacao);
	}

	public function index()
	{

		$permissao = verificaPermissao('PortalOrganizacao', 'listar');
		if ($permissao == 0) {
			echo mensagemAcessoNegado(session()->organizacoes);
			$this->LogsModel->inserirLog('Acesso indevido ao Módulo "PortalOrganizacao"', session()->codColaborador);
			exit();
		}


		$data = [
			'controller'    	=> 'portalOrganizacao',
			'title'     		=> 'portalOrganizacao'
		];
		return view('portalOrganizacao', $data);
	}

	public function getAll()
	{
		$response = array();

		$data['data'] = array();

		$result = $this->PortalOrganizacaoModel->pegaTudo();

		foreach ($result as $key => $value) {

			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info"  data-toggle="tooltip" data-placement="top" title="Editar"  onclick="editportalOrganizacao(' . $value->codPortal . ')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remover"  onclick="removeportalOrganizacao(' . $value->codPortal . ')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->codPortal,
				$value->codOrganizacao,
				$value->corFundoPrincipal,
				$value->corTextoPrincipal,
				$value->corSecundaria,
				$value->corMenus,
				$value->corTextoMenus,
				$value->corBackgroundMenus,

				$ops,
			);
		}

		return $this->response->setJSON($data);
	}

	public function getOne()
	{
		$response = array();

		$codOrganizacao = $this->request->getPost('codOrganizacao');

		if ($this->validation->check($codOrganizacao, 'required|numeric')) {

			$data = $this->PortalOrganizacaoModel->pegaPorCodigo($codOrganizacao);

			return $this->response->setJSON($data);
		} else {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function add()
	{

		$response = array();

		$fields['codPortal'] = $this->request->getPost('codPortal');
		$fields['codOrganizacao'] = $this->request->getPost('codOrganizacao');
		$fields['corFundoPrincipal'] = $this->request->getPost('corFundoPrincipal');
		$fields['corTextoPrincipal'] = $this->request->getPost('corTextoPrincipal');
		$fields['corSecundaria'] = $this->request->getPost('corSecundaria');
		$fields['corMenus'] = $this->request->getPost('corMenus');
		$fields['corTextoMenus'] = $this->request->getPost('corTextoMenus');
		$fields['corBackgroundMenus'] = $this->request->getPost('corBackgroundMenus');


		$this->validation->setRules([
			'codOrganizacao' => ['label' => 'CodOrganizacao', 'rules' => 'required|numeric|max_length[11]'],
			'corFundoPrincipal' => ['label' => 'CorFundoPrincipal', 'rules' => 'permit_empty|max_length[12]'],
			'corTextoPrincipal' => ['label' => 'CorTextoPrincipal', 'rules' => 'permit_empty|max_length[12]'],
			'corSecundaria' => ['label' => 'CorSecundaria', 'rules' => 'permit_empty|max_length[12]'],
			'corMenus' => ['label' => 'CorMenus', 'rules' => 'permit_empty|max_length[12]'],
			'corTextoMenus' => ['label' => 'CorTextoMenus', 'rules' => 'permit_empty|max_length[12]'],
			'corBackgroundMenus' => ['label' => 'CorBackgroundMenus', 'rules' => 'permit_empty|max_length[12]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {

			if ($this->PortalOrganizacaoModel->insert($fields)) {

				$response['success'] = true;
				$response['messages'] = 'Informação inserida com sucesso';
			} else {

				$response['success'] = false;
				$response['messages'] = 'Erro na inserção!';
			}
		}

		return $this->response->setJSON($response);
	}

	public function edit()
	{

		$response = array();

		$fields['codPortal'] = $this->request->getPost('codPortal');
		$fields['codOrganizacao'] = $this->request->getPost('codOrganizacao');
		$fields['corFundoPrincipal'] = $this->request->getPost('corFundoPrincipal');
		$fields['corTextoPrincipal'] = $this->request->getPost('corTextoPrincipal');
		$fields['corSecundaria'] = $this->request->getPost('corSecundaria');
		$fields['corMenus'] = $this->request->getPost('corMenus');
		$fields['corTextoMenus'] = $this->request->getPost('corTextoMenus');
		$fields['corBackgroundMenus'] = $this->request->getPost('corBackgroundMenus');


		$this->validation->setRules([
			'codPortal' => ['label' => 'codPortal', 'rules' => 'required|numeric|max_length[11]'],
			'codOrganizacao' => ['label' => 'CodOrganizacao', 'rules' => 'required|numeric|max_length[11]'],
			'corFundoPrincipal' => ['label' => 'CorFundoPrincipal', 'rules' => 'permit_empty|max_length[12]'],
			'corTextoPrincipal' => ['label' => 'CorTextoPrincipal', 'rules' => 'permit_empty|max_length[12]'],
			'corSecundaria' => ['label' => 'CorSecundaria', 'rules' => 'permit_empty|max_length[12]'],
			'corMenus' => ['label' => 'CorMenus', 'rules' => 'permit_empty|max_length[12]'],
			'corTextoMenus' => ['label' => 'CorTextoMenus', 'rules' => 'permit_empty|max_length[12]'],
			'corBackgroundMenus' => ['label' => 'CorBackgroundMenus', 'rules' => 'permit_empty|max_length[12]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {

			if ($this->PortalOrganizacaoModel->update($fields['codPortal'], $fields)) {

				$response['success'] = true;
				$response['messages'] = 'Atualizado com sucesso';
			} else {

				$response['success'] = false;
				$response['messages'] = 'Erro na atualização!';
			}
		}

		return $this->response->setJSON($response);
	}

	public function envia_imagem()
	{

		$response = array();

		$validationRule = [
			'file' => [
				'label' => 'Imagem',
				'rules' => [
					'uploaded[file]',
					'is_image[file]',
					'mime_in[file,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
					'max_size[file,50000]',
				],
				'errors' => [
					'is_image' => 'Não é uma imagem',
					'max_size' => 'Arquivo muito grane',
					'mime_in' => 'Extensão inválida',
					'uploaded' => 'Extensão inválida',
				],
			],
		];
		if (!$this->validate($validationRule)) {

			$response['success'] = false;
			$response['messages'] = $this->validator->getError();
			return $this->response->setJSON($response);
		}



		if ($this->request->getFile('file') !== NULL) {

			$img = $this->request->getFile('file');

			$dadosPortal = $this->PortalOrganizacaoModel->pegaPorCodigo(session()->codOrganizacao);


			$nomeArquivo = str_replace(" ", "", removeCaracteresIndesejadosEmail($img->getName()));

			$img->move(WRITEPATH . '../imagens/',  $nomeArquivo, true);

			$fields = array(
				'imagemSobre' => $nomeArquivo,
				'dataAtualizacao' => date('Y-m-d H:i'),
			);
			$this->PortalOrganizacaoModel->update($dadosPortal->codPortal, $fields);


			$response['success'] = true;
			$response['nomeArquivo'] = $nomeArquivo;
			$response['messages'] =  'Foto enviada com sucesso';
			return $this->response->setJSON($response);
		}
	}


	public function salvaPaletaCores()
	{

		$response = array();

		$codOrganizacao = session()->codOrganizacao;
		if ($this->validation->check($codOrganizacao, 'required|numeric')) {
			$data = $this->PortalOrganizacaoModel->pegaPorCodigo($codOrganizacao);

			if ($data !== NULL) {

				$fields['codAutor'] = session()->codColaborador;
				$fields['corFundoPrincipal'] = $this->request->getPost('corFundoPrincipal');
				$fields['corTextoPrincipal'] = $this->request->getPost('corTextoPrincipal');
				$fields['corLinhaTabela'] = $this->request->getPost('corLinhaTabela');
				$fields['corTextoTabela'] = $this->request->getPost('corTextoTabela');
				$fields['corMenus'] = $this->request->getPost('corMenus');
				$fields['corTextoMenus'] = $this->request->getPost('corTextoMenus');
				$fields['corBackgroundMenus'] = $this->request->getPost('corBackgroundMenus');
				$fields['dataAtualizacao'] = date('Y-m-d H:i');

				if ($this->PortalOrganizacaoModel->update($data->codPortal, $fields)) {

					$this->OrganizacoesModel->temaPortal($codOrganizacao);
					$response['success'] = true;
					$response['messages'] = 'Atualizado com sucesso';
				} else {

					$response['success'] = false;
					$response['messages'] = $this->validation->listErrors();
				}
			} else {
				$fields['codOrganizacao'] = $codOrganizacao;
				$fields['codAutor'] = session()->codColaborador;
				$fields['corFundoPrincipal'] = $this->request->getPost('corFundoPrincipal');
				$fields['corTextoPrincipal'] = $this->request->getPost('corTextoPrincipal');
				$fields['corLinhaTabela'] = $this->request->getPost('corLinhaTabela');
				$fields['corTextoTabela'] = $this->request->getPost('corTextoTabela');
				$fields['corMenus'] = $this->request->getPost('corMenus');
				$fields['corTextoMenus'] = $this->request->getPost('corTextoMenus');
				$fields['corBackgroundMenus'] = $this->request->getPost('corBackgroundMenus');
				$fields['dataAtualizacao'] = date('Y-m-d H:i');

				if ($this->PortalOrganizacaoModel->insert($fields)) {

					$this->OrganizacoesModel->temaPortal($codOrganizacao);
					$response['success'] = true;
					$response['messages'] = 'Atualizado com sucesso';
				} else {

					$response['success'] = false;
					$response['messages'] = json_encode($fields);
				}
			}
		}
		return $this->response->setJSON($response);
	}

	public function salvaHero()
	{


		$response = array();



		$codOrganizacao = session()->codOrganizacao;
		if ($this->validation->check($codOrganizacao, 'required|numeric')) {
			$data = $this->PortalOrganizacaoModel->pegaPorCodigo($codOrganizacao);

			if ($data !== NULL) {

				$fields['codAutor'] = session()->codColaborador;
				$fields['dataAtualizacao'] = date('Y-m-d H:i');
				$fields['heroTexto'] = $this->request->getPost('heroTexto');
				if ($this->request->getPost('ativoHero') == 'on') {
					$fields['ativoHero'] = 1;
				} else {
					$fields['ativoHero'] = 0;
				}


				if ($this->PortalOrganizacaoModel->update($data->codPortal, $fields)) {

					$this->OrganizacoesModel->temaPortal($codOrganizacao);
					$response['success'] = true;
					$response['messages'] = 'Atualizado com sucesso';
				} else {

					$response['success'] = false;
					$response['messages'] = $this->validation->listErrors();
				}
			} else {
				$fields['codOrganizacao'] = $codOrganizacao;
				$fields['codAutor'] = session()->codColaborador;
				$fields['dataAtualizacao'] = date('Y-m-d H:i');
				$fields['heroTexto'] = $this->request->getPost('heroTexto');
				if ($this->request->getPost('ativoHero') == 'on') {
					$fields['ativoHero'] = 1;
				} else {
					$fields['ativoHero'] = 0;
				}
				if ($this->PortalOrganizacaoModel->insert($fields)) {

					$this->OrganizacoesModel->temaPortal($codOrganizacao);
					$response['success'] = true;
					$response['messages'] = 'Atualizado com sucesso';
				} else {

					$response['success'] = false;
					$response['messages'] = $this->validation->listErrors();
				}
			}
		} else {
			$response['success'] = false;
			$response['messages'] = 'Falha na operação';
		}
		return $this->response->setJSON($response);
	}
	public function salvaSobre()
	{


		$response = array();



		$codOrganizacao = session()->codOrganizacao;
		if ($this->validation->check($codOrganizacao, 'required|numeric')) {
			$data = $this->PortalOrganizacaoModel->pegaPorCodigo($codOrganizacao);

			if ($data !== NULL) {

				$fields['codAutor'] = session()->codColaborador;
				$fields['dataAtualizacao'] = date('Y-m-d H:i');
				$fields['sobreTexto'] = $this->request->getPost('sobreTexto');
				if ($this->request->getPost('ativoSobre') == 'on') {
					$fields['ativoSobre'] = 1;
				} else {
					$fields['ativoSobre'] = 0;
				}


				if ($this->PortalOrganizacaoModel->update($data->codPortal, $fields)) {

					$this->OrganizacoesModel->temaPortal($codOrganizacao);
					$response['success'] = true;
					$response['messages'] = 'Atualizado com sucesso';
				} else {

					$response['success'] = false;
					$response['messages'] = $this->validation->listErrors();
				}
			} else {
				$fields['codOrganizacao'] = $codOrganizacao;
				$fields['codAutor'] = session()->codColaborador;
				$fields['dataAtualizacao'] = date('Y-m-d H:i');
				$fields['sobreTexto'] = $this->request->getPost('sobreTexto');
				if ($this->request->getPost('ativoSobre') == 'on') {
					$fields['ativoSobre'] = 1;
				} else {
					$fields['ativoSobre'] = 0;
				}
				if ($this->PortalOrganizacaoModel->insert($fields)) {

					$this->OrganizacoesModel->temaPortal($codOrganizacao);
					$response['success'] = true;
					$response['messages'] = 'Atualizado com sucesso';
				} else {

					$response['success'] = false;
					$response['messages'] = $this->validation->listErrors();
				}
			}
		} else {
			$response['success'] = false;
			$response['messages'] = 'Falha na operação';
		}
		return $this->response->setJSON($response);
	}
	public function remove()
	{
		$response = array();

		$id = $this->request->getPost('codPortal');

		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {

			if ($this->PortalOrganizacaoModel->where('codPortal', $id)->delete()) {

				$response['success'] = true;
				$response['messages'] = 'Deletado com sucesso';
			} else {

				$response['success'] = false;
				$response['messages'] = 'Erro na deleção!';
			}
		}

		return $this->response->setJSON($response);
	}
}
