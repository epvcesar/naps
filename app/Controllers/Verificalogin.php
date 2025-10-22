<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\OrganizacoesModel;
use App\Models\LogsModel;
use App\Models\ColaboradoresModel;
use App\Models\PerfilColaboradoresMembroModel;
use CodeIgniter\HTTP\IncomingRequest;

class Verificalogin extends BaseController
{
	protected $validation;
	protected $Organizacao;
	protected $LogsModel;
	protected $OrganizacoesModel;
	protected $ColaboradoresModel;
	protected $PerfilColaboradoresMembroModel;
	protected $codOrganizacao;

	public function __construct()
	{
		$this->OrganizacoesModel = new OrganizacoesModel();
		$this->PerfilColaboradoresMembroModel = new PerfilColaboradoresMembroModel();
		$this->LogsModel = new LogsModel();
		$this->ColaboradoresModel = new ColaboradoresModel();
		$this->validation =  \Config\Services::validation();
	}


	function verificaCredenciais()
	{

		//PEGA DADOS

		$codOrganizacao = $this->request->getPost('codOrganizacao');

		session()->codOrganizacao = $this->request->getPost('codOrganizacao');

		$login = mb_strtolower(rtrim(ltrim($this->request->getPost('login'))));

		if (!strpos($login, '@')) {
			$login = removeCaracteresIndesejados($login);
		}

		if ($login == '00000000000') {
			session()->setFlashdata('mensagemLoginInexistente', 1);

			$response['success'] = false;
			$response['messages'] = 'Login Inexistente';
			return $this->response->setJSON($response);
		}



		$senha = rtrim(ltrim($this->request->getPost('senha')));
		$perfilLogin = rtrim(ltrim($this->request->getPost('perfilLogin')));

		//VALIDA FORMATO LOGIN/SENHA


		$loginGoogle = $this->request->getPost('google');



		if ($loginGoogle !== NULL) {
			$dadoslogin['login'] = $this->request->getPost('email');
			$dadoslogin['senha'] = 'SubS8H8nONSbgsSlCfp6tmDmXQ7iW8';
		} else {
			$dadoslogin['login'] = mb_strtolower(rtrim(ltrim($this->request->getPost('login'))));
			$dadoslogin['senha'] = rtrim(ltrim($this->request->getPost('senha')));
		}
		

		$this->validation->setRules([
			'login' => ['label' => 'login', 'rules' => 'required|bloquearReservado'],
			'senha' => ['label' => 'senha', 'rules' => 'required|bloquearReservado'],

		]);

		
		if ($this->validation->run($dadoslogin) == FALSE) {

			$response['success'] = false;
			$response['messages'] = 'Verifique seu login ou senha';
			return $this->response->setJSON($response);
		}


		$organizacao = $this->OrganizacoesModel->pegaOrganizacao();


		if ($perfilLogin == 2) {

			//PEGA DADOS DE DE COLABORADOR
			$colaborador = $this->ColaboradoresModel->pegaColaboradorPorLogin($login);

			if ($colaborador == NULL) {
				$response['success'] = false;
				$response['messages'] = 'Login Inexistente';
				return $this->response->setJSON($response);
			}



			//VERIFICA SE ANIVERSARIANTE
			if (date('m-d', strtotime($colaborador->dataNascimento)) == date('m-d') and $colaborador->conta !== 'admin') {
				session()->set('aniversariante', 1);
			} else {
				session()->set('aniversariante', 0);
			}


			//ANIVERSARIANTES

			$aniversariantes = $this->ColaboradoresModel->aniversariantesHoje();
			session()->set('aniversariantes', $aniversariantes);


			//VERIFICA PERFILS DE ACESSO DE COLABORADORES


			
			if ($this->verificaPerfisColaboradores($organizacao, $colaborador) !== 1) {

				$response['success'] = false;
				$response['messages'] = 'Perfil inexistente';
				return $this->response->setJSON($response);
			}


			

			//VERIFICA SENHA
			$senha = hash("sha256",  $senha . $organizacao->chaveSalgada);
			sleep(2);



			if ($colaborador->senha == $senha) {
				$this->variaveisSessao($codOrganizacao, $login, $organizacao, $colaborador);	

				//LOG DE OUDITORIA
				$this->LogsModel->inserirLog('Login Sucesso', $colaborador->codColaborador);

				$response['success'] = true;
				$response['messages'] = 'Login sucesso';
				return $this->response->setJSON($response);
			} else {
			
				$this->LogsModel->inserirLog('Falha no Login', $colaborador->codColaborador);
				$response['success'] = false;
				$response['messages'] = 'Verifique seu login ou senha';
				return $this->response->setJSON($response);
				
			}
		}
	}



	function verificaPerfisClientes()
	{

		$meusPerfisValidos = $this->PerfilColaboradoresMembroModel->pegaMeusPerfisValidosClientes();
		$todosMeusPerfis = $this->PerfilColaboradoresMembroModel->pegaMeusPerfisClientes();

		//reexecutar consulta dos meus perfis
		$meusModulos = $this->PerfilColaboradoresMembroModel->pegaMinhasPermissoesModulosClientes();

		session()->set('codPerfil', 9);
		session()->set('meusPerfis', $meusPerfisValidos);
		session()->set('meusModulos', $meusModulos);
		return 1;
	}

	function verificaPerfisColaboradores($organizacao, $colaborador)
	{



		//return 1;


		//meus perfis
		$meusPerfisValidos = $this->PerfilColaboradoresMembroModel->pegaMeusPerfisValidos($colaborador->codColaborador);
		$todosMeusPerfis = $this->PerfilColaboradoresMembroModel->pegaMeusPerfis($colaborador->codColaborador);


		if (empty($todosMeusPerfis)) {
			//NUNCA HOUVE PERFIL ASSOSSIADO

			if ($organizacao->codPerfilPadrao > 0) {
				//atualiza colaborador
				$perfilPadrao['codPerfilPadrao'] = $organizacao->codPerfilPadrao;
				$db      = \Config\Database::connect();
				$builderColaborador = $db->table('colaboradores');
				$builderColaborador->where('codColaborador', $colaborador->codColaborador);
				$builderColaborador->update($perfilPadrao);

				//insere colaborador no perfil


				$dadosmembroPerfil['codPerfil'] = $organizacao->codPerfilPadrao;
				$dadosmembroPerfil['codColaborador'] = $colaborador->codColaborador;
				$dadosmembroPerfil['dataCriacao'] = date('Y-m-d H:i');
				$dadosmembroPerfil['dataAtualizacao'] = date('Y-m-d H:i');
				$dadosmembroPerfil['dataInicio'] = date('Y-m-d');
				$builderMembroPerfil = $db->table('perfiscolaboradoresmembro');
				$builderMembroPerfil->insert($dadosmembroPerfil);

				//reexecutar consulta dos meus perfis
				$meusPerfisValidos = $this->PerfilColaboradoresMembroModel->pegaMeusPerfisValidos($colaborador->codColaborador);
				$todosMeusPerfis = $this->PerfilColaboradoresMembroModel->pegaMeusPerfis($colaborador->codColaborador);
				$meusModulos = $this->PerfilColaboradoresMembroModel->pegaMinhasPermissoesModulos($colaborador->codColaborador, $organizacao->codPerfilPadrao);
				session()->set('codPerfil', $organizacao->codPerfilPadrao);
				session()->set('meusPerfis', $meusPerfisValidos);
				session()->set('meusModulos', $meusModulos);
				return 1;
			} else {

				session()->setFlashdata('mensagemPerfilInexistente', 1);
				return 0;
			}
		} else {

			// TEM OU TEVE PERFIL

			$validos = 0;
			$expirados = 0;
			$perfilPadrao = -1;
			foreach ($todosMeusPerfis as $meuperfil) {
				if ($meuperfil->dataEncerramento !== NULL and $meuperfil->dataEncerramento < date('Y-m-d')) {

					$expirados++;
				} else {
					$validos++;
					if ($colaborador->codPerfilPadrao == $meuperfil->codPerfil) {
						$perfilPadrao = $meuperfil->codPerfil;
					} else {
						$perfilNaoPadrao =  $meuperfil->codPerfil;
					}
				}
			}
			if ($validos == 0 and $expirados > 0) {
				session()->setFlashdata('mensagemPerfilExpirado', 'Sua conta estava associada ao perfil "' . $meuperfil->descricao . '" que expirou em ' . date('d/m/Y', strtotime($meuperfil->dataEncerramento)) . '.');
				return 0;
			}
			if ($validos > 0) {
				if ($perfilPadrao !== -1) {
					$codPerfil = $perfilPadrao;
				} else {
					$codPerfil = $perfilNaoPadrao;
				}
			}


			$meusModulos = $this->PerfilColaboradoresMembroModel->pegaMinhasPermissoesModulos($colaborador->codColaborador, $codPerfil);
			session()->set('codPerfil', $codPerfil);
			session()->set('meusPerfis', $meusPerfisValidos);
			session()->set('meusModulos', $meusModulos);
			return 1;
			//print_r(session()->meusModulos);
			//exit();
		}
	}


	function verificaSeAdmin()
	{


		foreach (session()->meusPerfis as $perfil) {
			if ($perfil->descricao == 'Administrador') {
				return 1;
			}
		}
		return 0;
	}
	function variaveisSessao($codOrganizacao, $login, $organizacao, $colaborador)
	{

		//SET TIMEZONE
		$timezone = $this->OrganizacoesModel->pegaTimezoneOrganizacao($codOrganizacao);

		if ($timezone == NULL) {
			$timezone = 'America/Sao_Paulo';
		} else {
			$timezone = $timezone->nome;
		}

		date_default_timezone_set($timezone);

		session()->set('estaLogado', 1);
		session()->set('ip', pegaIP());
		session()->set('logo', $organizacao->logo);
		session()->set('codTipoOrganizacao', $organizacao->codTipoOrganizacao);
		session()->set('codTipoMultisite', $organizacao->codTipoMultisite);
		session()->set('multiSiteLoginAtivado', $organizacao->multiSiteLoginAtivado);
		session()->set('codOrganizacao', $organizacao->codOrganizacao);
		session()->set('descricaoOrganizacao', $organizacao->descricao);
		session()->set('cabecalhoOficios', $organizacao->cabecalho);
		session()->set('rodapeOficios', $organizacao->rodape);
		session()->set('cabecalhoPrescricao', $organizacao->cabecalhoPrescricao);
		session()->set('rodapePrescricao', $organizacao->rodapePrescricao);
		session()->set('siglaOrganizacao', $organizacao->siglaOrganizacao);
		session()->set('telefoneOrganizacao', $organizacao->telefone);
		session()->set('fundo', $organizacao->fundo);
		session()->set('codTimezone', $organizacao->codTimezone);
		session()->set('timezone', $timezone);
		session()->set('codColaborador', $colaborador->codColaborador);
		session()->set('codPerfil', $colaborador->codPerfilPadrao);
		session()->set('permissoes', null);
		session()->set('login', $login);
		session()->set('nomeCompleto', $colaborador->nomeCompleto);
		session()->set('celular', $colaborador->celular);
		session()->set('nomeExibicao', $colaborador->nomeExibicao);
		session()->set('codBen', $colaborador->codBen);
		session()->set('emailPessoal', $colaborador->emailPessoal);
		session()->set('cpf', $colaborador->cpf);
		session()->set('fotoPerfil', $colaborador->fotoPerfil);


		session()->set('tempoInatividade', $organizacao->tempoInatividade);
		session()->set('tempoInatividade_em', date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s") . " +" . $organizacao->tempoInatividade . " minutes")));
		session()->set('forcarExpiracao', $organizacao->forcarExpiracao);
		session()->set('forcarExpiracao_em', date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s") . " +" . $organizacao->forcarExpiracao . " minutes")));
		session()->set('dt_login', date("Y-m-d H:i:s"));
		session()->set('dt_ultimaAlteracao', date("Y-m-d H:i:s"));
		session()->set('politicaSenha', $organizacao->politicaSenha);
		session()->set('senhaNaoSimples', $organizacao->senhaNaoSimples);
		session()->set('numeros', $organizacao->numeros);
		session()->set('letras', $organizacao->letras);
		session()->set('caracteresEspeciais', $organizacao->caracteresEspeciais);
		session()->set('minimoCaracteres', $organizacao->minimoCaracteres);
		session()->set('maiusculo', $organizacao->maiusculo);
		session()->set('nomeExibicaoSistema', $organizacao->nomeExibicaoSistema);

	}



	function loginLDAP($login, $senha, $organizacao)
	{
		$servidoresLDAP = $this->ServicoLDAPModel->pegaTudoAtivo();

		foreach ($servidoresLDAP as $servidorLDAP) {

			$loginLDAP = $this->ServicoLDAPModel->conectaldap($login, $senha, $servidorLDAP->codServidorLDAP);


			if ($loginLDAP['status'] == 1) {

				$dadosLdapColaborador = $this->ServicoLDAPModel->pegaColaboradores($loginLDAP['tipoldap'], $orderby = 'sn', $login);

				//print_r($dadosLdapColaborador); exit();
				$colaborador = $this->ColaboradoresModel->pegaColaboradorPorLogin($login);
				if ($colaborador == NULL) {

					$atributosMapeados = $this->MapeamentoAtributosLDAPModel->pegaAtributosMapeados($loginLDAP['codServidorLDAP']);

					foreach ($atributosMapeados as $atributos) {
						if (is_array($dadosLdapColaborador[0][$atributos->nomeAtributoLDAP])) {
							$dados[$atributos->nomeAtributoSistema] =  $dadosLdapColaborador[0][$atributos->nomeAtributoLDAP][0];
						} else {
							$dados[$atributos->nomeAtributoSistema] =  $dadosLdapColaborador[0][$atributos->nomeAtributoLDAP];
						}
					}

					$dados['codOrganizacao'] =  session()->codOrganizacao;
					$dados['dataCriacao'] = date('Y-m-d H:i:s');
					$dados['dataAtualizacao'] = date('Y-m-d H:i:s');
					$dados['ativo'] = 1;
					$dados['aceiteTermos'] = 1;
					$dados['senha'] = hash("sha256",  $senha . $organizacao->chaveSalgada);


					$this->ColaboradoresModel->insert($dados);
				}
				return 1;
			} else {
				//return 0;
			}
		}
		return 0;
	}
	function loginAdmin($login, $senha, $organizacao)
	{

		//é o admin

		session()->set('meusPerfis', array());
		session()->set('meusModulos', array());




		if (hash("sha256", $senha) == $organizacao->senhaAdmin) {


			//  ****  VARIÁVEIS ****

			session()->set('nomeCompleto', 'Administrador');
			session()->set('nomeExibicao', 'Administrador');

			//LOG DE OUDITORIA
			$this->LogsModel->inserirLog('Login Sucesso', 0);
			return 1;
		} else {

			//LOG DE OUDITORIA
			$this->LogsModel->inserirLog('Login falha', 0);
			session()->setFlashdata('mensagemSenhaErrada', 1);
			return 0;
		}
	}


	public function pegaCargos()
	{
		$response = array();


		//INSTANCIA POST/GET FORMS
		$request = service('request');


		//PEGA DADOS
		$codCargo = $this->request->getPost('codCargo');

		if (is_numeric($codCargo)) {

			$data = $this->CargosModel->pegaCargosPorCodigo($codCargo);

			return json_encode($data);
		} else {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}


	public function pegaOrganizacao()
	{
		//INSTANCIA POST/GET FORMS
		$request = service('request');


		//PEGA DADOS
		$codOrganizacao = $this->request->getPost('codOrganizacao');

		$response = array();

		if (is_numeric($codOrganizacao)) {

			$data = $this->OrganizacoesModel->pegaOrganizacao($codOrganizacao);

			return $this->response->setJSON($data);
		} else {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function verificacaoConfirmacoes($cpf = null)
	{
		$response = array();

		//VALIDAR ENTRADAS
		$validacao['cpf'] = $this->request->getPost('cpf');
		$validacao['identidade'] = $this->request->getPost('identidadeValidacao');
		$validacao['email'] = $this->request->getPost('emailPessoalValidacao');
		$validacao['celular'] = $this->request->getPost('celularValidacao');
		$validacao['codBen'] = $this->request->getPost('codBenValidacao');
		$validacao['nomeMae'] = $this->request->getPost('nomeMaeValidacao');
		$validacao['dataNascimento'] = $this->request->getPost('dataNascimentoValidacao');


		$this->validation->setRules([
			'cpf' => ['label' => 'CPF', 'rules' => 'required|bloquearReservado|numeric|max_length[14]'],
			'identidade' => ['label' => 'Identidade', 'rules' => 'permit_empty|bloquearReservado|numeric|max_length[3]'],
			'email' => ['label' => 'E-mail', 'rules' => 'permit_empty|bloquearReservado|valid_email|max_length[40]'],
			'celular' => ['label' => 'Celular', 'rules' => 'permit_empty|bloquearReservado|numeric|max_length[4]'],
			'codBen' => ['label' => 'Código Beneficiário', 'rules' => 'permit_empty|bloquearReservado|numeric|max_length[3]'],
			'nomeMae' => ['label' => 'Nome da Mae', 'rules' => 'required|bloquearReservado|max_length[20]'],

		]);

		if ($this->validation->run($validacao) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {
			//LOGICA AQUI



			if ($cpf !== NULL) {
				$cpf = $cpf;
			} else {
				$cpf = $this->request->getPost('cpf');
			}


			$codOrganizacao = $this->request->getPost('codOrganizacao');
			session()->set('codOrganizacao', $codOrganizacao);

			$codPerfil = $this->request->getPost('codPerfil');
			$cpf = removeCaracteresIndesejados($cpf);


			$colaborador = $this->ClientesModel->pegaClientePorcpf($cpf);

			if ($this->request->getPost('emailPessoalNovos') !== NULL) {
				$atualiza["emailPessoal"] = $this->request->getPost('emailPessoalNovos');
			}
			if ($this->request->getPost('celularNovos') !== NULL) {
				$atualiza["celular"] = $this->request->getPost('celularNovos');
			}

			if ($this->request->getPost('emailPessoalNovos') !== NULL or $this->request->getPost('celularNovos') !== NULL) {
				$this->ClientesModel->update($colaborador->codCliente, $atualiza);
			}


			$tudoOK = 1;
			if ($colaborador !== NULL) {

				$dados = array();


				if ($colaborador->nomeCompleto !== NULL and strpos($colaborador->nomeCompleto, '***') === false) {
					//$dados['nomeCompleto'] = $colaborador->nomeCompleto;
				}
				if ($colaborador->identidade !== NULL) {
					//Primeiros 3 números do Identidade

					$dados['identidade'] = mb_substr($colaborador->identidade, 0, 3);
					if ($this->request->getPost('identidadeValidacao')) {
						if (mb_substr($this->request->getPost('identidadeValidacao'), 0, 3) == $dados['identidade']) {
						} else {
							$tudoOK = 0;
						}
					}
				}
				if ($colaborador->emailPessoal !== NULL and strpos($colaborador->emailPessoal, '***') === false) {

					//informe seu email

					$emailPessoal = explode("@", $colaborador->emailPessoal);
					$emailPessoal = mb_substr($emailPessoal[0], 0, round(strlen($emailPessoal[0]) / 2)) . '****@' . mb_substr($emailPessoal[1], 0, 3) . '*******';

					$dados['emailPessoal'] = $colaborador->emailPessoal;

					if ($this->request->getPost('emailPessoalValidacao')) {
						if (mb_strtolower($this->request->getPost('emailPessoalValidacao'), "utf-8") == mb_strtolower($dados['emailPessoal'], "utf-8")) {
						} else {
							$tudoOK = 0;
						}
					}
				}


				if ($colaborador->celular !== NULL and $colaborador->celular !== "" and strpos($colaborador->celular, '***') === false) {
					//Primeiros 4 números do CELULAR
					$dados['celular'] = mb_substr($colaborador->celular, -4);
					if ($this->request->getPost('celularValidacao')) {
						if (mb_strtolower($this->request->getPost('celularValidacao'), "utf-8") == mb_strtolower($dados['celular'], "utf-8")) {
						} else {
							$tudoOK = 0;
						}
					}
				}

				if ($colaborador->codBen !== NULL and $colaborador->codBen !== "" and strpos($colaborador->codBen, '***') === false) {
					//ultimos 3 números do CadBEM /PrecCP
					$dados['codBen'] =  mb_substr($colaborador->codBen, 0, 3);
					if ($this->request->getPost('codBenValidacao')) {
						if (mb_strtolower($this->request->getPost('codBenValidacao'), "utf-8") == mb_strtolower($dados['codBen'], "utf-8")) {
						} else {
							$tudoOK = 0;
						}
					}
				}
				if ($colaborador->nomeMae !== NULL and $colaborador->nomeMae !== "" and strpos($colaborador->nomeMae, '***') === false) {
					//PRIMEIRO NOME DA MAE
					$nomeMae = explode(" ", $colaborador->nomeMae);
					$dados['nomeMae'] = $nomeMae[0];
					if ($this->request->getPost('nomeMaeValidacao')) {
						if (trim(mb_strtolower(removeAcentos($this->request->getPost('nomeMaeValidacao')), "utf-8")) == trim(mb_strtolower(removeAcentos($dados['nomeMae']), "utf-8"))) {
						} else {
							$tudoOK = 0;
						}
					}
				}

				if ($colaborador->dataNascimento !== NULL and $colaborador->dataNascimento !== "" and strpos($colaborador->dataNascimento, '***') === false) {
					$dados['dataNascimento'] = date('Y', strtotime($colaborador->dataNascimento));
					if ($this->request->getPost('dataNascimentoValidacao')) {
						if (mb_strtolower($this->request->getPost('dataNascimentoValidacao'), "utf-8") == mb_strtolower($dados['dataNascimento'], "utf-8")) {
						} else {
							$tudoOK = 0;
						}
					}
				}




				//VERIFICA SE VALIDAÇÃO PASSOU

				if ($this->request->getPost('respostas') == 1) {

					if ($tudoOK == 1) {
						$response['success'] = true;
						$response['csrf_hash'] = csrf_hash();



						$senha = geraSenha(6, true, true, true);


						//TROCA SENHA
						$this->ClientesModel->trocaSenha($colaborador->codCliente, $senha, $senha);


						//ENVIA NOTIFICAÇÃO POR EMAIL
						$textoEmail = '<div>Caro usu&aacute;rio(a), ' . $colaborador->nomeExibicao . ', </div>';
						$textoEmail .= '<div>Seu login &eacute; <b>' . $colaborador->cpf . '</b> e foi gerada a senha provis&oacute;ria <b>' . $senha . '</b></div>';
						$textoEmail .= '<div>Em momento oportuno, troque a sua senha.</div>';
						$textoEmail .= '<div>Atenciosamente, Equipe de TI do ' . $colaborador->siglaOrganizacao . '</div>';

						if ($colaborador->emailPessoal !== NULL) {
							$email = $colaborador->emailPessoal;
						} else {
							$email = $atualiza["emailPessoal"];
						}
						email($email, 'SENHA', $textoEmail);


						//ENVIA NOTIFICAÇÃO POR SMS
						if ($colaborador->celular !== NULL) {
							$celular = $colaborador->celular;
						} else {
							$celular = $atualiza["celular"];
						}
						$textoSMS = 'Caro usuário(a), ' . $colaborador->nomeExibicao . ', \n';
						$textoSMS .= 'Seu login é ' . $colaborador->cpf . ' e foi gerada a senha provisória ' . $senha . '\n';
						$textoSMS .= 'Em momento oportuno, troque a sua senha.\n';
						$textoSMS .= 'Atenciosamente, Equipe de TI do ' . $colaborador->siglaOrganizacao . '\n';

						sms($celular, $textoSMS);

						$response['success'] = true;
						$response['csrf_hash'] = csrf_hash();
						$response['emailPessoal'] = true;
						$response['messages'] = 'Confirmamos sua identidade. Uma senha provisória foi enviada para o seu email ' . $emailPessoal;

						//grava no LOG SUCESSO
						$this->LogsModel->inserirLogCliente('Recuperação de senha do cpf ' . $colaborador->cpf, $colaborador->codCliente);


						return $this->response->setJSON($response);
					} else {
						//grava no LOG FALHA
						$this->LogsModel->inserirLogCliente('Falha na recuperação de senha do cpf ' . $colaborador->cpf, $colaborador->codCliente);

						$response['success'] = false;
						$response['messages'] = '<div>Não foi possível confirmar seus dados.</div> <div style="font-size:14px;color:red">Tente novamente ou procure o Hospital.</div>';
						return $this->response->setJSON($response);
					}
				}
			}
		}
		return $this->response->setJSON($response);
	}

	public function esqueciMinhaSenha()
	{
		$response = array();
		$fields['email'] = $this->request->getPost('email');

		$this->validation->setRules([
			'email' => ['label' => 'Email', 'rules' => 'required|valid_email|bloquearReservado|max_length[100]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {

			$cliente = $this->ClientesModel->pegaClientePorEmail($fields['email']);

			if ($cliente !== NULL) {

				//ENVIAR NOTIFICAÇÃO

				if (($cliente->emailFuncional !== NULL and $cliente->emailFuncional !== "" and $cliente->emailFuncional !== " ") or ($cliente->emailPessoal !== NULL and $cliente->emailPessoal !== "" and $cliente->emailPessoal !== " ")) {
					$email = $cliente->emailPessoal;
				} else {
					$email = NULL;
				}

				$senha = geraSenha(6, true, true, true);


				//TROCA SENHA
				$this->ClientesModel->trocaSenha($cliente->codCliente, $senha, $senha);


				if ($email !== NULL and $cliente->nomeExibicao !== NULL) {
					$conteudo = "
					<div> Caro senhor(a), " . $cliente->nomeExibicao . ",</div>";
					$conteudo .= "<div>Você solicitou a redefinição de sua senha da conta. Por favor, realize o login com a senha temporária abaixo. </div>";

					$conteudo .= "<div style='margin-top:15px;'>DADOS DO ACESSO:</div>";
					$conteudo .= '<div>Usuário: <a href="mailto:' . $email . '">' . $email . '</a></div>';
					$conteudo .= "<div>Senha provisória:" . $senha . "</div>";
					$conteudo .= "<div>Para sua segurança, altere a senha imediatamente após o login.</div>";
					$conteudo .= 'Recuperação realizada em ' . diaSemanaCompleto(date('Y-m-d H:i')) . ", " .  date("d/m/Y H:i", strtotime(date('Y-m-d H:i'))) . ".</div>";

					$conteudo .= "<div style='font-size: 12px;margin-top:16px'>Atenciosamente,</div>";
					$conteudo .= "<div style='font-size: 12px; margin-top:0px'>" . session()->descricaoOrganizacao . "</div>";

					$resultadoEmail = @email($email, 'RECUPERAÇÃO DE SENHA', $conteudo);
					if ($resultadoEmail == false) {

						//ADICIONAR NOTIFICAÇÃO ANA FILA EM CASO DE FALHA
						@addNotificacoesFila($conteudo, $email, $email, 1);
					}
				}

				//ENVIAR SMS
				$celular = removeCaracteresIndesejados($cliente->celular);
				$conteudoSMS = "Caro senhor(a), " . $cliente->nomeExibicao . ",\n";
				$conteudoSMS .= "Sua senha provisória é " . $senha . "\n";

				$conteudoSMS .= "\nAtenciosamente, ";
				$conteudoSMS .= session()->siglaOrganizacao;

				if ($celular !== NULL  and $celular !== ""  and $celular !== " ") {
					$resultadoSMS = @sms($celular, $conteudoSMS);
					if ($resultadoSMS == false) {

						//ADICIONAR NOTIFICAÇÃO ANA FILA EM CASO DE FALHA
						@addNotificacoesFila($conteudoSMS, 'Sistema', $celular, 2);
					}
				}

				$response['success'] = true;
				$response['csrf_hash'] = csrf_hash();
				$response['messages'] = 'Dados da recuperação de senha enviado para seu email. Se necessário verifique a sua caixa de SPAM!';
			} else {

				$response['success'] = false;
				$response['messages'] = 'usuário não localizado';
			}
		}

		return $this->response->setJSON($response);
	}

	public function getOne()
	{
		$response = array();
		$id = $this->request->getPost('codCliente');

		$autorizacaoCodPesssoaMD5 = mb_substr($_SESSION['autorizacao'], 0, 32);

		if ($autorizacaoCodPesssoaMD5 !== md5($id)) {
			header("Location:" . base_url());
			exit();
		} else {
			//print mb_substr($_GET['autorizacao'], 0, 32)." = ". md5(session()->cpf);
		}





		$data = $this->ClientesModel->pegaClientePorCodCliente($id);

		return $this->response->setJSON($data);
	}

	public function listaDropDownParentesco()
	{

		$result = $this->ClientesModel->listaDropDownParentesco();

		if ($result !== NULL) {


			return $this->response->setJSON($result);
		} else {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}
	public function listaDropDownTiposContatos()
	{

		$result = $this->ClientesModel->listaDropDownTiposContatos();

		if ($result !== NULL) {


			return $this->response->setJSON($result);
		} else {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}


	public function incluirContatoSelf($codCliente = null)
	{
		$response = array();
		$dados = array();



		$dados['codOrganizacao'] = session()->codOrganizacao;
		$dados['codCliente'] = $this->request->getPost('codCliente');
		$dados['codTipoContato'] = $this->request->getPost('codTipoContato');
		$dados['nomeContato'] = $this->request->getPost('nomeContato');
		$dados['numeroContato'] = $this->request->getPost('numeroContato');
		$dados['codParentesco'] = $this->request->getPost('codParentesco');
		$dados['observacoes'] = $this->request->getPost('observacoes');






		$this->validation->setRules([
			'codCliente' => ['label' => 'Cliente', 'rules' => 'required|numeric|max_length[11]'],
			'codTipoContato' => ['label' => 'Tipo Contato', 'rules' => 'required|numeric|max_length[11]'],
			'codParentesco' => ['label' => 'Parentesco', 'rules' => 'required|numeric|max_length[11]'],
			'nomeContato' => ['label' => 'Nome Contato', 'rules' => 'required|bloquearReservado|max_length[20]'],
			'numeroContato' => ['label' => 'Número Contato', 'rules' => 'required|bloquearReservado|max_length[50]'],
			'observacoes' => ['label' => 'Observações', 'rules' => 'bloquearReservado|max_length[60]'],

		]);

		if ($this->validation->run($dados) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {

			if ($this->ClientesModel->inserirOutroContato($dados)) {

				$response['success'] = true;
				$response['csrf_hash'] = csrf_hash();
				$response['messages'] = 'Contato incluido com sucesso';
			} else {

				$response['success'] = false;
				$response['messages'] = 'Erro ao incluir!';
			}
		}

		return $this->response->setJSON($response);
	}





	public function atualizaCliente()
	{

		$response = array();


		$fields['codCliente'] = $this->request->getPost('codCliente');
		$fields['codOrganizacao'] =  $this->request->getPost('codOrganizacao');
		$fields['nomeCompleto'] =  $this->request->getPost('nomeCompleto');
		$fields['sexo'] =  $this->request->getPost('sexo');
		$fields['dataNascimento'] =  $this->request->getPost('dataNascimento');
		$fields['orgao'] =  $this->request->getPost('orgao');
		$fields['identidade'] =  $this->request->getPost('identidade');
		$fields['nacionalidade'] =  $this->request->getPost('nacionalidade');
		$fields['cpf'] =  $this->request->getPost('cpf');
		$fields['nomeMae'] =  $this->request->getPost('nomeMae');
		$fields['nomePai'] =  $this->request->getPost('nomePai');
		$fields['emailPessoal'] = $this->request->getPost('emailPessoal');
		$fields['celular'] = $this->request->getPost('celular');
		$fields['endereco'] = $this->request->getPost('endereco');
		$fields['cep'] = $this->request->getPost('cep');
		$fields['dataAtualizacao'] = date('Y-m-d H:i');
		$request = \Config\Services::request();
		$ip = $request->getIPAddress();
		$fields['ipRequisitante'] = $ip;

		if (session()->codColaborador !== NULL) {
			$fields['autorAtualizacao'] = session()->codColaborador;
		} else {
			if (session()->codCliente !== NULL) {
				$fields['autorAtualizacao'] = session()->codCliente;
			} else {
				$fields['autorAtualizacao'] = 0;
			}
		}


		$this->validation->setRules([
			'codCliente' => ['label' => 'codCliente', 'rules' => 'required|numeric|max_length[11]'],
			'codOrganizacao' => ['label' => 'CodOrganizacao', 'rules' => 'required|numeric|max_length[11]'],
			'celular' => ['label' => 'celular', 'rules' => 'required|bloquearReservado|max_length[16]'],
			'emailPessoal' => ['label' => 'E-mail Colaborador', 'rules' => 'permit_empty|valid_email|bloquearReservado'],
			'endereco' => ['label' => 'endereco', 'rules' => 'permit_empty|bloquearReservado'],
			'cep' => ['label' => 'cep', 'rules' => 'permit_empty|bloquearReservado'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {

			if ($this->ClientesModel->update($fields['codCliente'], $fields)) {


				$cliente = $this->ClientesModel->pegaClientePorCodCliente($fields['codCliente']);



				if ($cliente->emailPessoal !== NULL and $cliente->emailPessoal !== "" and $cliente->emailPessoal !== " ") {
					$email = $cliente->emailPessoal;
					$email = removeCaracteresIndesejadosEmail($email);
				} else {
					$email = NULL;
				}

				if ($email !== NULL and $cliente->nomeExibicao !== NULL) {
					$conteudo = "
								<div> Caro senhor(a), " . $cliente->nomeExibicao . ",</div>";
					$conteudo .= "<div>Seus dados foram atualizados com sucesso em " . date("d/m/Y  H:i") . ".";
					$conteudo .= "<div style='margin-top:20px'>Atenciosamente,</div>";
					$conteudo .= "<div style='font-size: 12px; margin-top:0px'>" . session()->descricaoOrganizacao . "</div>";

					$resultadoEmail = @email($email, 'ATUALIZAÇÃO DE CADASTRO', $conteudo);
					if ($resultadoEmail == false) {

						//ADICIONAR NOTIFICAÇÃO ANA FILA EM CASO DE FALHA
						@addNotificacoesFila($conteudo, $email, $email, 1);
					}


					//ENVIAR SMS
					$celular = removeCaracteresIndesejados($cliente->celular);
					$conteudoSMS = "
									Caro senhor(a), " . $cliente->nomeExibicao . ",";
					$conteudoSMS .= " Seus dados foram atualizados com sucesso em " . date("d/m/Y  H:i") . ".";

					$conteudoSMS .= "Atenciosamente, ";
					$conteudoSMS .= session()->siglaOrganizacao;

					if ($celular !== NULL  and $celular !== ""  and $celular !== " ") {
						$resultadoSMS = @sms($celular, $conteudoSMS);
						if ($resultadoSMS == false) {

							//ADICIONAR NOTIFICAÇÃO ANA FILA EM CASO DE FALHA
							@addNotificacoesFila($conteudoSMS, 'Sistema', $celular, 2);
						}
					}
				}



				$response['success'] = true;
				$response['csrf_hash'] = csrf_hash();
				$response['messages'] = 'Cliente atualizado com sucesso';
			} else {

				$response['success'] = false;
				$response['messages'] = 'Erro na inserção!';
			}
		}


		return $this->response->setJSON($response);
	}

	public function getOutrosContatos()
	{


		$response = array();

		$data['data'] = array();

		$codCliente = $this->request->getPost('codCliente');



		$autorizacaoCodPesssoaMD5 = mb_substr($_SESSION['autorizacao'], 0, 32);

		if ($autorizacaoCodPesssoaMD5 !== md5($codCliente)) {
			header("Location:" . base_url());
			exit();
		} else {
			//print mb_substr($_GET['autorizacao'], 0, 32)." = ". md5(session()->cpf);
		}


		$result = $this->ClientesModel->pegaOutrosContatosPorCodCliente($codCliente);

		foreach ($result as $key => $value) {

			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"  onclick="modificarContatoSelf(' . $value->codOutroContato . ')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Remover"  onclick="removeContatoSelf(' . $value->codOutroContato . ')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';



			$data['csrf_token'] =  csrf_token();
			$data['csrf_hash'] =  csrf_hash();
			$data['data'][$key] = array(
				$key + 1,
				$this->ClientesModel->tipoContatoLookup($value->codTipoContato),
				$value->nomeContato,
				$this->ClientesModel->parentescoLookup($value->codParentesco),
				$value->numeroContato,
				$value->observacoes,
				$ops,
			);
		}

		return $this->response->setJSON($data);
	}
	public function removeContatoSelf()
	{

		$codOutroContato = $this->request->getPost('codOutroContato');

		$this->ClientesModel->removerOutroContato($codOutroContato);
		$response['success'] = true;
		$response['csrf_hash'] = csrf_hash();

		return $this->response->setJSON($response);
	}

	public function pegaColaborador()
	{
		$response = array();


		$cpf = removeCaracteresIndesejados($this->request->getPost('cpf'));
		$dados['cpf'] = $cpf;


		$this->validation->setRules([
			'cpf' => ['label' => 'CPF', 'rules' => 'required|bloquearReservado|numeric|max_length[16]'],

		]);

		if ($this->validation->run($dados) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {


			$codOrganizacao = $this->request->getPost('codOrganizacao');

			session()->set('codOrganizacao', $codOrganizacao);

			$codPerfil = $this->request->getPost('codPerfil');


			$colaborador = $this->ClientesModel->pegaClientePorcpf($cpf);

			$tudoOK = 1;
			if ($colaborador !== NULL) {

				$dados = array();
				$novos = array();


				if ($colaborador->nomeCompleto !== NULL and strpos($colaborador->nomeCompleto, '***') === false) {
					//$dados['nomeCompleto'] = $colaborador->nomeCompleto;
				}
				if ($colaborador->identidade !== NULL) {
					//Primeiros 3 números da identidade

					$dados['identidade'] = mb_substr($colaborador->identidade, 0, 3);
				}
				if ($colaborador->emailPessoal !== NULL and strpos($colaborador->emailPessoal, '***') === false) {


					//informe seu email

					$emailPessoal = explode("@", $colaborador->emailPessoal);
					$emailPessoal = mb_substr($emailPessoal[0], 0, round(strlen($emailPessoal[0]) / 2)) . '****@' . mb_substr($emailPessoal[1], 0, 3) . '*******';

					$dados['emailPessoal'] = $colaborador->emailPessoal;

					if ($this->request->getPost('emailPessoalValidacao')) {
						if ($this->request->getPost('emailPessoalValidacao') == $dados['emailPessoal']) {
						} else {
							$tudoOK = 0;
						}
					}
				} else {
					$novos['emailPessoal'] = NULL;
				}
				if ($colaborador->celular !== NULL and $colaborador->celular !== "" and strpos($colaborador->celular, '***') === false) {
					//ultimos 4 números do Celular
					$dados['celular'] = mb_substr($colaborador->celular, -4);
				} else {
					$novos['celular'] = NULL;
				}
				if ($colaborador->codBen !== NULL and $colaborador->codBen !== "" and strpos($colaborador->codben, '***') === false) {
					//ultimos 3 números do CadBEM /PrecCP
					$dados['codBen'] =  mb_substr($colaborador->codBen, 0, 3);
				}
				if ($colaborador->nomeMae !== NULL and $colaborador->nomeMae !== "" and strpos($colaborador->nomeMae, '***') === false) {
					//PRIMEIRO NOME DA MAE

					$nomeMae = explode(" ", $colaborador->nomeMae);
					$dados['nomeMae'] = $nomeMae[0];
				}

				if ($colaborador->dataNascimento !== NULL and $colaborador->dataNascimento !== "" and strpos($colaborador->dataNascimento, '***') === false) {
					$dados['dataNascimento'] = date('Y', strtotime($colaborador->dataNascimento));
				}


				//VERIFICA SE VALIDAÇÃO PASSOU

				if ($this->request->getPost('respostas') == 1) {

					if ($tudoOK == 1) {
						$response['success'] = true;
						$response['csrf_hash'] = csrf_hash();
						$response['messages'] = 'Passou, enviamos um email';
						return $this->response->setJSON($response);
					} else {
						$response['success'] = false;
						$response['messages'] = '<div>Não foi possível confirmar seus dados.</div> <div style="font-size:14px;color:red">Tente novamente ou procure o Hospital.</div>';
						return $this->response->setJSON($response);
					}
				}


				$response['success'] = true;
				$response['csrf_hash'] = csrf_hash();
				$response['dados'] = $dados;
				$response['cpf'] = $cpf;
				$response['codOrganizacao'] = $codOrganizacao;
				$response['formConfirmacao'] = $this->montaFormularioConfirmacao($dados, $novos);
			} else {
				$response['success'] = false;
				$response['messages'] = '<div>Cadastro não localizado.</div> <div style="font-size:14px;color:red">Tente novamente ou procure o Hospital.</div>';
			}
		}

		return $this->response->setJSON($response);
	}



	public function montaFormularioConfirmacao($dados, $novos)
	{
		$x = 0;

		$formulario = '<form id="confirmacoesForm" class="pl-3 pr-3">';

		foreach ($dados as $key => $valor) {
			$label = "";
			$tipo = "";
			$tamanho = "";
			$caracteres = "";

			if ($key == 'identidade') {
				$label = "Qual os <b>3 primeiros</b> digitos da sua <b>identidade</b>?";
				$tipo = "text";
				$caracteres = "3";
				$tamanho = "60";
			}

			if ($key == 'codBen') {
				$label = "Qual são <b>3 primeiros</b> digitos do seu nº de Beneficiário (PRECCP,FUSMA ou FUNSA)?";
				$tipo = "text";
				$caracteres = "3";
				$tamanho = "60";
			}


			if ($key == 'emailPessoal') {
				$label = "Qual é seu <b>e-mail</b> cadatrado previamente no sistema?";
				$tipo = "text";
				$caracteres = "40";
				$tamanho = "300";
			}

			if ($key == 'nomeMae') {
				$label = "Qual é o <b>primeiro nome</b> da sua mãe?";
				$tipo = "text";
				$caracteres = "40";
				$tamanho = "200";
			}
			if ($key == 'celular') {
				$label = "Quais são os <b>4 últimos</b> números do seu <b>celular</b>?";
				$tipo = "text";
				$caracteres = "4";
				$tamanho = "70";
			}


			if ($key == 'dataNascimento') {
				$label = "Qual é o <b>ano</b> do seu nascimento?";
				$tipo = "text";
				$caracteres = "4";
				$tamanho = "70";
			}


			$x++;

			$formulario .= '
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
					<label for="' . $key . '" name="' . $key . '">' . $label . '</label>
					<input style="width:' . $tamanho . 'px" type="' . $tipo . '" id="' . $key . '" name="' . $key . 'Validacao" class="form-control" maxlength="' . $caracteres . '" required>
																
					</div>	


				</div>	
			</div>			
			';
		}


		foreach ($novos as $key => $valor) {
			$label = "";
			$tipo = "";
			$tamanho = "";
			$caracteres = "";

			if ($key == 'emailPessoal') {
				$label = "Falta seu e-mail em nosso sistema, por favor, forneça-o para que a senha possa ser enviada.";
				$tipo = "text";
				$caracteres = "40";
				$tamanho = "300";
				$exemplo = "";
			}

			if ($key == 'celular') {
				$label = "Falta seu Nº de Celular em nosso sistema, por favor, forneça-o para que possamos contata-lo em caso de necessidade.";
				$tipo = "text";
				$caracteres = "60";
				$tamanho = "200";
				$exemplo = '<span style="font-size:9px;color:red"> informe o DDD: Exemplo: 81 99999-9999</span>';
			}



			$x++;
			$formulario .= '
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
					<label for="' . $key . '" name="' . $key . '">' . $label . '</label>
					<input style="width:' . $tamanho . 'px" type="' . $tipo . '" id="' . $key . 'Add" name="' . $key . 'Novos" class="form-control" maxlength="' . $caracteres . '" required>
					' . $exemplo . '										
					</div>	
				</div>	
				
			</div>			
			';
		}
		$formulario .= '</form>';
		return $formulario;
	}

	public function check_session()
	{

		$response = array();
		if (!empty(session()->estaLogado)) {

			$response['statusSessao'] = 1;
		} else {
			$response['statusSessao'] = 0;
			$response['messages'] = 'Sua sessão expirou.';
		}



		$verificaSTempoInatividade = verificaSTempoInatividade();


		if ($verificaSTempoInatividade == 1) {
			$response['statusSessao'] = 0;
			$response['messages'] = 'Tempo de inatividade ultrapassou mais de ' . session()->tempoInatividade . ' minuto(s).';
			session()->destroy();
		}

		$verificaForcaExpiracao = verificaForcaExpiracao();


		if ($verificaForcaExpiracao == 1) {
			$response['statusSessao'] = 0;
			$response['messages'] = 'Tempo máximo de sessão expirou às ' . date('H:i', strtotime(session()->forcarExpiracao_em)) . '.';
			session()->destroy();
		}




		return $this->response->setJSON($response);
	}
	public function redefineOrganizacao()
	{
		//INSTANCIA POST/GET FORMS
		$request = service('request');


		//PEGA DADOS
		$codOrganizacao = $this->request->getPost('codOrganizacao');

		$response = array();

		if (is_numeric($codOrganizacao)) {

			session()->set('codOrganizacao', $codOrganizacao);

			return true;
		} else {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}
}
