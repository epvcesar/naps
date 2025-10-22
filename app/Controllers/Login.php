<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrganizacoesModel;
use App\Models\LogsModel;

use App\Models\ColaboradoresModel;

class Login extends BaseController
{
	protected $validation;
	protected $ColaboradoresModel;
	protected $OrganizacoesModel;
	protected $LogsModel;
	public $request;


	public function __construct()
	{

		$this->OrganizacoesModel = new OrganizacoesModel();
		$this->ColaboradoresModel = new ColaboradoresModel();
		$this->LogsModel = new LogsModel();

		$this->validation =  \Config\Services::validation();
		helper(['form', 'url']);




		$dadosOrganizacao = $this->OrganizacoesModel->pegaDadosBasicosOrganizacao();

		session()->set('descricaoOrganizacao', $dadosOrganizacao->descricao);
		session()->set('siglaOrganizacao', $dadosOrganizacao->siglaOrganizacao);
		session()->set('logo', $dadosOrganizacao->logo);
		session()->set('cidade', $dadosOrganizacao->cidade);
		session()->set('endereço', $dadosOrganizacao->endereço);
		session()->set('telefone', $dadosOrganizacao->telefone);
		session()->set('uf', $dadosOrganizacao->siglaEstadoFederacao);
		session()->set('cep', $dadosOrganizacao->cep);
		session()->set('faleConosco', $dadosOrganizacao->faleConosco);
		session()->set('contatos', $dadosOrganizacao->contatos);
		session()->set('hero', $dadosOrganizacao->hero);
		session()->set('facebook_url', $dadosOrganizacao->facebook_url);
		session()->set('instagram_url', $dadosOrganizacao->instagram_url);
		session()->set('linkedin_url', $dadosOrganizacao->linkedin_url);
		session()->set('twitter_url', $dadosOrganizacao->twitter_url);
		session()->set('youtube_url', $dadosOrganizacao->youtube_url);
	}


	public function termo()
	{

		$response = array();

		$codTermo = $this->request->getPost('codTermo');

		$data = $this->TermosModel->pegaPorCodigo($codTermo);


		$termo = '';

		if ($data->termoPDF !== NULL) {
			$termo .= '
			
			<div style="margin-left:10px;margin-right:10px;margin-top:10px" class="row  justify-content-center">
				<div class="col-sm-12 col-md-12">
					<embed style="height: 100vh;width: 80vw;" src="./arquivos/termos/' . $data->termoPDF . '" type="application/pdf">
				</div>
			</div>
			';
		} else {

			$termo .= '
			
			<div style="margin-left:10px;margin-right:10px;margin-top:10px" class="row">
				<div class="col-sm-12 col-md-12">
					' . $data->termo . '
				</div>
			</div>
			';
		}



		$response['termo'] = $termo;

		return $this->response->setJSON($response);
	}



	public function index()
	{


		helper('form');
		echo view('login');
	}


	function logout()
	{
		
		$codColaborador = session()->codColaborador;
		$this->LogsModel->inserirLog('Saiu do sistema', $codColaborador);

		session()->destroy();
		return redirect()->to(base_url() . 'login');
	}


	function logoutPorExpiracao()
	{
		$codColaborador = session()->codColaborador;
		$this->LogsModel->inserirLog('Sessão expirou', $codColaborador);

		session()->destroy();
		return redirect()->to(base_url() . '/#login');
	}

	public function addColaborador()
	{

		$response = array();

		$lista = array();
		$contas = $this->ColaboradoresModel->contas();

		foreach ($contas as $row) {
			array_push($lista, $row->conta);
		}

		if ($this->request->getPost('conta') !== NULL) {
			if (in_array($this->request->getPost('conta'), $lista)) {
				$response['success'] = 'contaExistente';
				$response['mensagem'] = 'A conta "' . $this->request->getPost('conta') . " já está em uso!";

				return $this->response->setJSON($response);
			}
		}

		$fields['codOrganizacao'] =  $this->request->getPost('codOrganizacao');
		$fields['codColaborador'] = $this->request->getPost('codColaborador');
		$fields['conta'] = $this->request->getPost('conta');
		$fields['nomeExibicao'] = $this->request->getPost('nomeExibicao');
		$fields['nomeCompleto'] = $this->request->getPost('nomeCompleto');
		$fields['nomePrincipal'] = $this->request->getPost('nomePrincipal');
		$fields['identidade'] = $this->request->getPost('identidade');
		$fields['cpf'] = $this->request->getPost('cpf');
		$fields['codBen'] = $this->request->getPost('codBen');
		$fields['emailFuncional'] = $this->request->getPost('emailFuncional');
		$fields['emailPessoal'] = $this->request->getPost('emailPessoal');
		$fields['codEspecialidade'] = $this->request->getPost('codEspecialidade');
		$fields['telefoneTrabalho'] = $this->request->getPost('telefoneTrabalho');
		$fields['celular'] = $this->request->getPost('celular');
		$fields['endereco'] = $this->request->getPost('endereco');
		$fields['dataInicioEmpresa'] = $this->request->getPost('dataInicioEmpresa');
		$fields['dataCriacao'] = date('Y-m-d H:i:s');
		$fields['dataAtualizacao'] = date('Y-m-d H:i:s');
		$fields['datanascimento'] = $this->request->getPost('dataNascimento');
		$fields['codUnidade'] = $this->request->getPost('codUnidade');
		$fields['codFuncao'] = $this->request->getPost('codFuncao');
		$fields['codCargo'] = $this->request->getPost('codCargo');
		$fields['codPerfilPadrao'] = $this->request->getPost('codPerfilPadrao');
		$fields['nrEndereco'] = $this->request->getPost('nrEndereco');
		$fields['codMunicipioFederacao'] = $this->request->getPost('codMunicipioFederacao');
		$fields['cep'] = $this->request->getPost('cep');
		$fields['informacoesComplementares'] = $this->request->getPost('informacoesComplementares');
		$fields['pai'] = $this->request->getPost('pai');

		if ($this->request->getPost('ativo') == 'on') {
			$fields['ativo'] = 1;
		} else {
			$fields['ativo'] = 0;
		}
		if ($this->request->getPost('aceiteTermos') == 'on') {
			$fields['aceiteTermos'] = 1;
		} else {
			$fields['aceiteTermos'] = 0;
		}



		$this->validation->setRules([
			'dataCriacao' => ['label' => 'dataCriacao', 'rules' => 'permit_empty|max_length[40]'],
			'dataAtualizacao' => ['label' => 'dataAtualizacao', 'rules' => 'permit_empty|max_length[40]'],
			'conta' => ['label' => 'Conta', 'rules' => 'permit_empty|max_length[40]'],
			'nomeExibicao' => ['label' => 'Nome exibição', 'rules' => 'permit_empty|max_length[40]'],
			'nomeCompleto' => ['label' => 'Nome completo', 'rules' => 'permit_empty|max_length[100]'],
			'identidade' => ['label' => 'Identidade', 'rules' => 'permit_empty|numeric|max_length[15]'],
			'cpf' => ['label' => 'cpf', 'rules' => 'permit_empty|numeric|max_length[15]'],
			'emailFuncional' => ['label' => 'Email funcional', 'rules' => 'permit_empty|max_length[40]'],
			'emailPessoal' => ['label' => 'Email Pessoal', 'rules' => 'permit_empty|max_length[40]'],
			'codEspecialidade' => ['label' => 'Especialidade', 'rules' => 'permit_empty|max_length[11]'],
			'telefoneTrabalho' => ['label' => 'Telefone trabalho', 'rules' => 'permit_empty|max_length[16]'],
			'celular' => ['label' => 'Celular', 'rules' => 'permit_empty|max_length[16]'],
			'endereco' => ['label' => 'Endereço', 'rules' => 'permit_empty|max_length[200]'],
			'senha' => ['label' => 'Senha', 'rules' => 'permit_empty|max_length[200]'],
			'ativo' => ['label' => 'Ativo', 'rules' => 'permit_empty|max_length[1]'],
			'dataInicioEmpresa' => ['label' => 'Data início empresa', 'rules' => 'permit_empty|valid_date'],
			'datanascimento' => ['label' => 'Data de nascimento', 'rules' => 'permit_empty|valid_date'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {

			if ($codColaborador = $this->ColaboradoresModel->insert($fields)) {

				$xxx = exportarColaboradorHelper($this, $codColaborador);

				if ($this->request->getFile('file') !== NULL) {


					$avatar = $this->request->getFile('file');
					$nomeArquivo = $codColaborador . '.' . $avatar->getClientExtension();
					$avatar->move(WRITEPATH . '../arquivos/imagens/colaboradores/',  $nomeArquivo, true);

					$this->ColaboradoresModel->updateFotoPerfil($codColaborador, $nomeArquivo);
				}


				$response['success'] = true;
				$response['csrf_hash'] = csrf_hash();
				$response['mensagem'] = 'Cadastro realizado com sucesso. Verifique seu email para confirmação do cadastro';
			} else {
				$response['success'] = false;
				$response['mensagem'] = 'Falha na operação de cadastro';
			}
		}

		return $this->response->setJSON($response);
	}



	public function profissionaisSaude()
	{

		$response = array();

		$especialistas = $this->EspecialidadesModel->especialistasDisponiveis();


		$html = '
		<style>
			.borda {
				background: -webkit-linear-gradient(left top, #fffe01 0%, #28a745 100%);
				border-radius: 1000px;
				padding: 6px;
				width: 150px;
				height: 150px;

			}
		</style>
		
		';

		$profissionaisSaude = array();
		$especialista = array();
		foreach ($especialistas as $medico) {
			if ($medico->atende == 1) {
				$atende = '<span class="right badge badge-danger">Atende</span>';
			} else {
				$atende = '';
			}
			if (!in_array($medico->nomeExibicao, $especialista)) {

				array_push($especialista, $medico->nomeExibicao);

				array_push(
					$profissionaisSaude,
					array(
						'nomeExibicao' => $medico->nomeExibicao,
						'informacoesComplementares' => $medico->informacoesComplementares,
						'fotoPerfil' => $medico->fotoPerfil,
						'nomeConselho' => $medico->nomeConselho,
						'numeroInscricao' => $medico->numeroInscricao,
						'siglaEstadoFederacao' => $medico->siglaEstadoFederacao,
						'nomeArea' => $medico->nomeArea,
						'atende' => $atende,
					)
				);
			}
		}

		foreach ($profissionaisSaude as $medico) {

			$fotoPerfil = "no_image.jpg";
			if ($medico['fotoPerfil'] !== NULL and $medico['fotoPerfil'] !== "") {
				$fotoPerfil = base_url() . '/arquivos/imagens/colaboradores/' . $medico['fotoPerfil'];
			} else {
				$fotoPerfil = base_url() . '/arquivos/imagens/colaboradores/no_image.jpg';
			}

			$html .= '
			
			<div class="col-md-4">

				<div class="card card-widget widget-user shadow">
					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div  class="widget-user-header">

						<img class="borda" alt="" src="' . $fotoPerfil . '">
						<h3 style="font-size:16px !important;margin-top:10px;margin-bottom:10px;font-weight: bold;" class="widget-user-username">' . $medico['nomeExibicao'] . '</h3>

					</div>
					<div class="card-footer border-top-0">
						<div style="margin-top:10px" class="row">
							<div class="col-sm-6 border-right">
								<div style="font-size:12px;" >
									<div class="description-block">
										<h5 class="description-header">
											<div style="font-size:12px;" >' . $medico['nomeArea'] . '</div>
											<div style="font-size:12px;" >' . $medico['nomeConselho'] . "/" . $medico['siglaEstadoFederacao']     . " " . $medico['numeroInscricao'] . '</div>

										</h5>
									</div>
								</div>
								<!-- /.description-block -->
							</div>
							<!-- /.col -->
							<div class="col-sm-6">
								<div class="description-block">
									<h5 class="description-header">
										<div style="font-size:12px;font-weight: bold ;">';

			$especialidade = "";
			foreach ($especialistas as $medico2) {
				if ($medico['nomeExibicao'] == $medico2->nomeExibicao) {

					$especialidade .= $medico2->descricaoEspecialidade . " | ";
				}
			}
			$especialidade = rtrim($especialidade, "| ");


			$html .= '<div style="font-size:12px;">' . $especialidade . '</div>

									<!--' . $medico['atende'] . '-->
									</div>
									</h5>
								</div>
								<!-- /.description-block -->
							</div>
							<!-- /.col -->
						</div>
						<!--div style="height:100px" class="row">
							<div style="height:100%; width:100%;!important;font-size:12px;font-weight: bold; color:green;background:#edf3f9ad;" class="description-block col-sm-12 ">
							<div style="margin-top:10px">' . $medico['informacoesComplementares'] . '</div>
							</div>
						</div>
						-->
					</div>
				</div>
			</div>';
		}



		$response['success'] = true;
		$response['csrf_hash'] = csrf_hash();
		$response['html'] = $html;
		return $this->response->setJSON($response);
	}

	public function profissionaisSaude_OLD()
	{

		$response = array();

		$especialistas = $this->EspecialidadesModel->especialistasDisponiveis();


		$html = '';

		$profissionaisSaude = array();
		$especialista = array();
		foreach ($especialistas as $medico) {
			if ($medico->atende == 1) {
				$atende = '<span class="right badge badge-danger">Atende</span>';
			} else {
				$atende = '';
			}
			if (!in_array($medico->nomeExibicao, $especialista)) {

				array_push($especialista, $medico->nomeExibicao);

				array_push(
					$profissionaisSaude,
					array(
						'nomeExibicao' => $medico->nomeExibicao,
						'informacoesComplementares' => $medico->informacoesComplementares,
						'fotoPerfil' => $medico->fotoPerfil,
						'nomeConselho' => $medico->nomeConselho,
						'numeroInscricao' => $medico->numeroInscricao,
						'siglaEstadoFederacao' => $medico->siglaEstadoFederacao,
						'nomeArea' => $medico->nomeArea,
						'atende' => $atende,
					)
				);
			}
		}

		foreach ($profissionaisSaude as $medico) {

			$fotoPerfil = "no_image.jpg";
			if ($medico['fotoPerfil'] !== NULL and $medico['fotoPerfil'] !== "") {
				$fotoPerfil = base_url() . '/arquivos/imagens/colaboradores/' . $medico['fotoPerfil'];
			} else {
				$fotoPerfil = base_url() . '/arquivos/imagens/colaboradores/no_image.jpg';
			}

			$html .= '
			
			<div class="col-md-6">


				<div class="card card-widget widget-user shadow">
					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div style="background:#56ff0052;height:220px" class="widget-user-header">
						<h3 style="font-size:30px !important;margin-bottom:10px;font-weight: bold;" class="widget-user-username">' . $medico['nomeExibicao'] . '</h3>

						<img class="borda" alt="" src="' . $fotoPerfil . '">

					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col-sm-6 border-right">
								<div style="font-size:14px;font-weight: bold; color:green" class="description-block">
									<h5 class="description-header">
										<h5 class="widget-user-desc">' . $medico['nomeArea'] . '</h5>
										<h5 class="widget-user-desc">' . $medico['nomeConselho'] . "/" . $medico['siglaEstadoFederacao']     . " " . $medico['numeroInscricao'] . '</h5>

									</h5>
								</div>
								<!-- /.description-block -->
							</div>
							<!-- /.col -->
							<div class="col-sm-6">
								<div class="description-block">
									<h5 class="description-header">
										<div style="font-size:14px;font-weight: bold ; color:green">';

			$especialidade = "";
			foreach ($especialistas as $medico2) {
				if ($medico['nomeExibicao'] == $medico2->nomeExibicao) {

					$especialidade .= $medico2->descricaoEspecialidade . " | ";
				}
			}
			$especialidade = rtrim($especialidade, "| ");


			$html .= '<div style="font-size:14px;">' . $especialidade . '</div>

									<!--' . $medico['atende'] . '-->
									</div>
									</h5>
								</div>
								<!-- /.description-block -->
							</div>
							<!-- /.col -->
						</div>
						<div style="height:100px" class="row">
							<div style="font-size:14px !important;font-weight: bold; color:green;background:#edf3f9ad;" class="description-block col-sm-12">
							' . $medico['informacoesComplementares'] . '
							</div>
						</div>
						<!-- /.row -->
					</div>
				</div>
			</div>';
		}



		$response['success'] = true;
		$response['csrf_hash'] = csrf_hash();
		$response['html'] = $html;
		return $this->response->setJSON($response);
	}


	public function teste1($codColaborador)
	{
		$xxx = exportarColaboradorHelper($this, $codColaborador);
		print_r($xxx);
	}



	public function exportarColaborador($codColaborador = null)
	{


		if ($codColaborador !== NULL) {
			$codColaborador = $codColaborador;
			if (!is_numeric($codColaborador)) {
				exit();
			}
			$colaboradores = array($this->ColaboradoresModel->pegaColaboradorPorcodColaborador($codColaborador));
		}


		$servidoresLDAP = $this->ServicoLDAPModel->pegaTudoAtivo();



		$statusTrocaSenha = "";
		$teveFalhaLDAP = 0;
		foreach ($servidoresLDAP as $servidorLDAP) {
			$atributosMapeados = $this->MapeamentoAtributosLDAPModel->pegaAtributosMapeados($servidorLDAP->codServidorLDAP);

			$loginLDAP = $this->ServicoLDAPModel->conectaldap($servidorLDAP->loginLDAP, $servidorLDAP->senhaLDAP, $servidorLDAP->codServidorLDAP);
			if ($loginLDAP['status'] == 1) {

				foreach ($colaboradores as $colaborador) {

					$dadosLdapColaborador = $this->ServicoLDAPModel->pegaColaboradores($loginLDAP['tipoldap'], $orderby = 'sn', $colaborador->conta);

					if ($dadosLdapColaborador['count'] > 0) {
						//USUÁRIO EXISTE - UPDATE
					}

					if ($dadosLdapColaborador['count'] == 0) {
						//USUÁRIO NÃO EXISTE - INSERT
						//print 'inserir';


						if ($loginLDAP['tipoldap'] == 1) {
							//ACTIVE DIRECORY

						}

						if ($loginLDAP['tipoldap'] == 2) {


							//OPEN LDAP
							$dn = 'cn=' . $colaborador->conta . ',' . $servidorLDAP->dn;
							$dados['cn'] = $colaborador->conta;
							$dados["objectClass"][0] = "top";
							$dados["objectClass"][1] = "person";
							$dados["objectClass"][2] = "inetOrgPerson";
							$dados["uid"] = $colaborador->conta;
							$dados["sn"] = $colaborador->conta;
							$dados["userPassword"] = "{MD5}" . base64_encode(pack("H*", md5("123456")));
						}

						//MAPEAMENTO DE ATRIBUTOS
						foreach ($atributosMapeados as $atributos) {
							foreach ($colaborador as $key => $row) {
								if ($key == $atributos->nomeAtributoSistema) {
									$dados[$atributos->nomeAtributoLDAP] = $row;
								}
							}
						}
						@ldap_add($loginLDAP['statusConexao'], $dn, $dados);
					}
				}
			}
		}
	}
}
