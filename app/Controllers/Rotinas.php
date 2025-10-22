<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LogsModel;
use App\Models\OrganizacoesModel;
use App\Models\RotinasModel;
use App\Models\ColaboradoresModel;
use App\Models\FederacoesModel;

class Rotinas extends BaseController
{
	protected $colaboradoresModel;
	protected $validation;
	protected $LogsModel;
	protected $OrganizacoesModel;
	protected $FederacoesModel;
	protected $ColaboradoresModel;
	protected $RotinasModel;

	public function __construct()
	{

		helper(['seguranca', 'formularios']);
		verificaSeguranca($this, session(), base_url());
		$this->LogsModel = new LogsModel();
		$this->OrganizacoesModel = new OrganizacoesModel();
		$this->FederacoesModel = new FederacoesModel();
		$this->ColaboradoresModel = new ColaboradoresModel();
		$this->RotinasModel = new RotinasModel();
		$this->validation = \Config\Services::validation();

		$permissao = verificaPermissao('Rotinas', 'listar');
		if ($permissao == 0) {
			echo mensagemAcessoNegado(session()->organizacoes);
			$this->LogsModel->inserirLog('Acesso indevido ao Módulo Rotinas', session()->codColaborador);
			exit();
		}
	}



	public function redefineSenhaTodos()
	{
		ini_set('max_execution_time', '0'); //300 seconds = 5 minutes
		set_time_limit(0);

		$response = array();

		$organizacao = $this->OrganizacoesModel->pegaOrganizacao(session()->codOrganizacao);
		$clientes = $this->ClientesModel->pegaTudo();

		foreach ($clientes as $cliente) {

			if ($cliente->codBen !== "null" and $cliente->codBen !== NULL and $cliente->codBen !== "" and $cliente->codBen !== " ") {

				//TROCA SENHA
				$senha = hash("sha256", $cliente->codBen . $organizacao->chaveSalgada);
				$fields['senha'] = $senha;
				$fields['dataSenha'] = date('Y-m-d H:i');
				$fields['dataAtualizacao'] = date('Y-m-d H:i');
				if ($cliente->codCliente !== NULL) {
					if ($this->ClientesModel->update($cliente->codCliente, $fields)) {
					}
				}
			} else {
			}
		}

		$response['success'] = true;
		$response['csrf_hash'] = csrf_hash();
		$response['messages'] = 'Senhas redefinidas para Prec com sucesso';
		return $this->response->setJSON($response);
	}

	public function salvarReferenciaLookup()
	{
		ini_set('max_execution_time', '0'); //300 seconds = 5 minutes
		set_time_limit(0);
		$codColaborador = "";


		for ($x = 0; $x <= 1000; $x++) {
			$dados['codColaborador'] = 0;
			$codColaborador = $this->request->getPost('codColaborador' . $x);
			if ($codColaborador !== NULL and $codColaborador !== "") {
				$codColaborador = $this->request->getPost('codColaborador' . $x);

				$dados = array();
				$dados['codColaborador'] = $this->request->getPost('codColaborador' . $x);
				$this->ColaboradoresModel->updateLookupColaboradores($x, $dados);
			}
		}
		$response['success'] = true;
		$response['csrf_hash'] = csrf_hash();
		$response['messages'] = "Associação realizada com sucesso";
		return $this->response->setJSON($response);
	}


	public function importarPrescricoesEPrescricoes()
	{


		ini_set('max_execution_time', '0'); //300 seconds = 5 minutes
		set_time_limit(0);


		$atendimentosApolo = $this->RotinasModel->pegaAtendimentosApolo();



		foreach ($atendimentosApolo as $atendimentoAnamese) {
			$codAtendimento = NULL;
			$fieldsAnamnese = array();
			$anamnese1 = array();
			//CADASTRAR PRIMEIRO O ATENDIMENTO


			$especialistaAtendimento = lookupEspecialista($atendimentoAnamese->resp);

			if ($especialistaAtendimento == NULL or $especialistaAtendimento == "") {
				$codEspecialistaAtendimento = 0;
			} else {
				$codEspecialistaAtendimento = $especialistaAtendimento;
			}


			$fieldsAnamnese['codOrganizacao'] = session()->codOrganizacao;
			$fieldsAnamnese['codCliente'] = codClienteLookupPorProntuario($atendimentoAnamese->pron_id, $atendimentoAnamese->pron_nr);
			$fieldsAnamnese['codLocalAtendimento'] = lookupCodLocalAtendimento($atendimentoAnamese->local_atd);

			$fieldsAnamnese['legado'] = 1;
			$fieldsAnamnese['codEspecialista'] = $codEspecialistaAtendimento;
			$fieldsAnamnese['codEspecialidade'] = lookupCodEspecialidadeAtendimento($atendimentoAnamese->local_atd);
			$fieldsAnamnese['codStatus'] = 2; //Concluído
			$fieldsAnamnese['dataCriacao'] = $atendimentoAnamese->data_lc;
			$fieldsAnamnese['dataAtualizacao'] = $atendimentoAnamese->data_lc;
			$fieldsAnamnese['dataInicio'] = $atendimentoAnamese->data_lc;
			$fieldsAnamnese['dataEncerramento'] = $atendimentoAnamese->data_lc;
			$fieldsAnamnese['codTipoAtendimento'] = lookupCodTipoAtendimento($atendimentoAnamese->local_atd);
			$fieldsAnamnese['codAutor'] = $codEspecialistaAtendimento;
			$fieldsAnamnese['migrado'] = 1;

			// ANAMNESE
			if ($fieldsAnamnese['codEspecialista'] !== NULL) {
				if ($codAtendimento = $this->AtendimentosModel->insert($fieldsAnamnese)) {





					//INSERIR ANAMNESE
					$anamnese1['codAtendimento'] = $codAtendimento;
					$anamnese1['codCliente'] = $fieldsAnamnese['codCliente'];
					$anamnese1['codEspecialidade'] = $fieldsAnamnese['codEspecialidade'];
					$anamnese1['codEspecialista'] = $fieldsAnamnese['codEspecialista'];
					$anamnese1['queixaPrincipal'] = $atendimentoAnamese->anamnese;
					$anamnese1['hda'] = $atendimentoAnamese->anamnese;
					$anamnese1['hmp'] = null;
					//$anamnese1['historiaMedicamentos'] = $atendimentoAnamese->medicamentos;
					//$anamnese1['historiaAlergias'] = $atendimentoAnamese->alergias;;
					$anamnese1['outrasInformacoes'] = $atendimentoAnamese->conduta;
					//$anamnese1['chv'] = $atendimentoAnamese->chv;
					//$anamnese1['parecer'] = $atendimentoAnamese->parecer;
					$anamnese1['codStatus'] = 1;
					$anamnese1['migrado'] = 1;
					$anamnese1['dataCriacao'] = $atendimentoAnamese->data_lc;
					$anamnese1['dataAtualizacao'] = $atendimentoAnamese->data_lc;

					if ($this->AtendimentoAnamneseModel->insert($anamnese1)) {
					}




					//DIAGNISTICO/CID
					if ($atendimentoAnamese->cid !== NULL) {
						//INSERIR DIAGNISTICO
						$diagnostico['codAtendimento'] = $codAtendimento;
						$diagnostico['codCid'] = lookupCid10($atendimentoAnamese->cid);
						$diagnostico['codAutor'] = $codEspecialistaAtendimento;
						$diagnostico['codTipoDiagnostico'] = 1;
						$diagnostico['migrado'] = 1;
						$diagnostico['dataCriacao'] = $atendimentoAnamese->data_lc;

						if ($this->AtendimentoDiagnosticoModel->insert($diagnostico)) {
						}
					}






					//INSERIR CONDUTA

					$condutaArray['codAtendimento'] = $codAtendimento;
					$condutaArray['dataInicio'] = $atendimentoAnamese->data_lc;
					$condutaArray['conteudoConduta'] = $atendimentoAnamese->conduta; //registro e examefis = onde??
					$condutaArray['codStatus'] = 1;
					$condutaArray['codAutor'] = $codEspecialistaAtendimento;
					$condutaArray['migrado'] = 1;
					$condutaArray['dataEncerramento'] = $atendimentoAnamese->data_lc;
					$condutaArray['dataCriacao'] = $atendimentoAnamese->data_lc;
					$condutaArray['dataAtualizacao'] = $atendimentoAnamese->data_lc;

					if ($atendimentoAnamese->conduta !== NULL and $atendimentoAnamese->conduta !== '') {
						if ($this->AtendimentosCondutasModel->insert($condutaArray)) {
						}
					}



					//EVOLUÇÕES

					$evolucoes = $this->RotinasModel->pegaEvolucoesApolo($atendimentoAnamese->pron_id, $atendimentoAnamese->pron_nr, $atendimentoAnamese->id_atd);


					foreach ($evolucoes as $evolucao) {



						$especialistaEvolucao = lookupEspecialista($evolucao->resp);

						if ($especialistaEvolucao == NULL or $especialistaEvolucao == "") {
							$codEspecialistaEvolucao = 0;
						} else {
							$codEspecialistaEvolucao = $especialistaEvolucao;
						}



						$fields['codAtendimento'] = $codAtendimento;
						$fields['codTipoEvolucao'] = lookupTipoEvolucao($evolucao->tipo);
						$fields['conteudoEvolucao'] = $evolucao->registro;
						$fields['codStatus'] = 1;
						$fields['migrado'] = 1;
						$fields['codAutor'] = $codEspecialistaEvolucao;
						$fields['dataInicio'] = $evolucao->data_lc;
						$fields['dataEncerramento'] = $evolucao->data_lc;
						$fields['dataCriacao'] = $evolucao->data_lc;
						$fields['dataAtualizacao'] = $evolucao->data_lc;

						if ($codAtendimentoEvolucao = $this->AtendimentosEvolucoesModel->insert($fields)) {
						}
					}





					//PRESCRIÇÕES
					$prescricoes = $this->RotinasModel->pegaPrescricoesApolo($atendimentoAnamese->pron_id, $atendimentoAnamese->pron_nr, $atendimentoAnamese->id_atd);

					if (!empty($prescricoes)) {


						foreach ($prescricoes as $prescricao) {



							$especialistaPrescricao = lookupEspecialista($prescricao->resp);

							if ($especialistaPrescricao == NULL or $especialistaPrescricao == "") {
								$codEspecialistaPrescricao = 0;
							} else {
								$codEspecialistaPrescricao = $especialistaPrescricao;
							}



							$fieldsPrescricao['codAtendimento'] = $codAtendimento;
							$fieldsPrescricao['codLocalAtendimento'] = $fieldsAnamnese['codLocalAtendimento'];
							$fieldsPrescricao['codOrganizacao'] = session()->codOrganizacao;
							$fieldsPrescricao['conteudoPrescricao'] = $prescricao->obs;
							$fieldsPrescricao['dieta'] = NULL;
							$fieldsPrescricao['codStatus'] = 1;
							$fieldsPrescricao['migrado'] = 1;
							$fieldsPrescricao['codAutor'] = $codEspecialistaPrescricao;
							$fieldsPrescricao['dataInicio'] = $prescricao->val_ini;
							$fieldsPrescricao['dataEncerramento'] = $prescricao->val_ter;
							$fieldsPrescricao['dataCriacao'] = $prescricao->data_lc;
							$fieldsPrescricao['dataAtualizacao'] = $prescricao->data_lc;


							if ($codAtendimentoPrescricao = $this->AtendimentosPrescricoesModel->insert($fieldsPrescricao)) {


								//IMPORTAÇÃO DOS ITENS DA PRESCRIÇÃO
								$itensPrescricoes = $this->RotinasModel->pegaItensPrescricoesApolo($prescricao->pron_id, $prescricao->pron_nr, $prescricao->id_atd, $prescricao->idprescr);


								foreach ($itensPrescricoes as $itemPrescrito) {

									$especialistaPrescricaoItem = lookupEspecialista($itemPrescrito->resp);

									if ($especialistaPrescricaoItem == NULL or $especialistaPrescricaoItem == "") {
										$codEspecialistaItem = 0;
									} else {
										$codEspecialistaItem = $especialistaPrescricaoItem;
									}



									//LOOKUPS
									$codMedicamento = $this->RotinasModel->lookupMedicamento($itemPrescrito->descr)->codItem;

									if ($codMedicamento !== NULL and $codMedicamento !== 0) {
										$unidade = $this->RotinasModel->lookupUnidadeItem($itemPrescrito->unid)->codUnidade;
										$via = $this->RotinasModel->lookupViaItem($itemPrescrito->via)->codVia;
										$periodo = $this->RotinasModel->lookupPeriodoItem($itemPrescrito->rec)->codPeriodo;
										$agora = $this->RotinasModel->lookupAgoraItem($itemPrescrito->agora)->codAplicarAgora;
										$risco = $this->RotinasModel->lookupRiscoItem($itemPrescrito->risco)->codRiscoPrescricao;
										$status = $this->RotinasModel->lookupStatusItem($itemPrescrito->stat)->codStatusPrescricao;

										if ($status == 0 or $status == NULL or $status == "") {
											$status = 2;
										}


										$fieldsMedicamentos['codAtendimentoPrescricao'] = $codAtendimentoPrescricao;
										$fieldsMedicamentos['codMedicamento'] = $codMedicamento;
										$fieldsMedicamentos['qtde'] = $itemPrescrito->qsol;
										$fieldsMedicamentos['und'] = $unidade;
										$fieldsMedicamentos['via'] = $via;
										$fieldsMedicamentos['freq'] = $itemPrescrito->freq;
										$fieldsMedicamentos['per'] = $periodo;
										$fieldsMedicamentos['dias'] = $itemPrescrito->dias;
										$fieldsMedicamentos['horaIni'] = $itemPrescrito->horaini;
										$fieldsMedicamentos['agora'] = $agora;
										$fieldsMedicamentos['risco'] = $risco;
										$fieldsMedicamentos['obs'] = $itemPrescrito->obs;
										$fieldsMedicamentos['apraza'] = $itemPrescrito->apraza;
										$fieldsMedicamentos['total'] = $itemPrescrito->total;
										$fieldsMedicamentos['stat'] = $status;
										$fieldsMedicamentos['codAutor'] = $codEspecialistaItem;
										$fieldsMedicamentos['dataCriacao'] = $itemPrescrito->data_lc;
										$fieldsMedicamentos['dataAtualizacao'] = $itemPrescrito->data_lc;
										$fieldsMedicamentos['migrado'] = 1;


										if ($this->PrescricaoMedicamentosModel->insert($fieldsMedicamentos)) {
										}
									}
								}




								//IMPORTAÇÃO DOS MATERIAIS
								$itensMateriais = $this->RotinasModel->pegaItensMateriaisApolo($prescricao->pron_id, $prescricao->pron_nr, $prescricao->id_atd, $prescricao->idprescr);

								if (!empty($itensMateriais)) {

									foreach ($itensMateriais as $itemMaterial) {


										$especialistaMaterialItem = lookupEspecialista($itemMaterial->resp);

										if ($especialistaMaterialItem == NULL or $especialistaMaterialItem == "") {
											$codEspecialistaItemMaterial = 0;
										} else {
											$codEspecialistaItemMaterial = $especialistaMaterialItem;
										}


										//LOOKUPS

										if ($itemMaterial->descr !== NULL and $itemMaterial->descr !== "") {

											$codMaterial = $this->RotinasModel->lookupMaterial($itemMaterial->descr)->codItem;

											if ($codMaterial !== NULL and $codMaterial !== 0 and $codMaterial !== "") {

												$status = $this->RotinasModel->lookupStatusItemMaterial($itemMaterial->stat)->codStatusMaterial;

												if ($status == 0 or $status == NULL or $status == "") {
													$status = 2;
												}


												$fieldsMaterial['codAtendimentoPrescricao'] = $codAtendimentoPrescricao;
												$fieldsMaterial['codMaterial'] = $codMaterial;
												$fieldsMaterial['qtde'] = $itemMaterial->qsol;
												$fieldsMaterial['codStatus'] = $status;
												$fieldsMaterial['observacao'] = $itemMaterial->obs;
												$fieldsMaterial['codAutor'] = $codEspecialistaItemMaterial;
												$fieldsMaterial['dataCriacao'] = $itemMaterial->data_lc;
												$fieldsMaterial['dataAtualizacao'] = $itemMaterial->data_lc;

												if ($this->PrescricoesMaterialModel->insert($fieldsMaterial)) {
												}
											}
										}
									}
								}



								//IMPORTAÇÃO OUTRAS PRESCRIÇÕES
								$itensOutrasPrescricoes = $this->RotinasModel->pegaItensOutrasPrescricoesApolo($prescricao->pron_id, $prescricao->pron_nr, $prescricao->id_atd, $prescricao->idprescr);

								if (!empty($itensOutrasPrescricoes)) {

									foreach ($itensOutrasPrescricoes as $itensOutraPrescricao) {


										$especialistaOutraPrescricaoItem = lookupEspecialista($itensOutraPrescricao->resp);

										if ($especialistaOutraPrescricaoItem == NULL or $especialistaOutraPrescricaoItem == "") {
											$codEspecialistaItemOutraPrescricao = 0;
										} else {
											$codEspecialistaItemOutraPrescricao = $especialistaOutraPrescricaoItem;
										}


										//LOOKUP
										$codTipoOutraPrescricao = $this->RotinasModel->lookupTipoOutrasPrescricoes($itensOutraPrescricao->tipo)->codTipoOutraPrescricao;



										$status = $this->RotinasModel->lookupStatusItemOutras($itensOutraPrescricao->stat)->codStatusOutras;

										if ($status == 0 or $status == NULL or $status == "") {
											$status = 2;
										}


										$fieldsOutrasPrescricoes['codAtendimentoPrescricao'] = $codAtendimentoPrescricao;
										$fieldsOutrasPrescricoes['codTipoOutraPrescricao'] = $codTipoOutraPrescricao;
										$fieldsOutrasPrescricoes['descricao'] = $itensOutraPrescricao->descr;
										$fieldsOutrasPrescricoes['codStatus'] = $status;
										$fieldsOutrasPrescricoes['apraza'] = $itensOutraPrescricao->apraza;
										$fieldsOutrasPrescricoes['codAutor'] = $codEspecialistaItemOutraPrescricao;
										$fieldsOutrasPrescricoes['dataCriacao'] = $itensOutraPrescricao->data_lc;
										$fieldsOutrasPrescricoes['dataAtualizacao'] = $itensOutraPrescricao->data_lc;


										if ($this->PrescricoesOutrasModel->insert($fieldsOutrasPrescricoes)) {
										}
									}
								}
							}
						}
					}
				}
			} else {
				continue;
			}
		}



		$response['success'] = true;
		$response['csrf_hash'] = csrf_hash();
		$response['messages'] = 'Atendimentos cadastrados com suceso';
		return $this->response->setJSON($response);
	}

	public function importarAtendimentosAmbulatorios()
	{


		ini_set('max_execution_time', '0'); //300 seconds = 5 minutes
		set_time_limit(0);


		//ATENDIMENTOS POR DOENÇAS



		//$importarAtendimentosAmbulatoriosPorDoencas = $this->RotinasModel->importarAtendimentosAmbulatoriosPorDoencas();

		$importarDoencas = $this->RotinasModel->importarDoencas();



		foreach ($importarDoencas as $atendimento) {
			$codAtendimento = NULL;
			$fields = array();
			$anamnese = array();
			$anamnese = array();
			$diagnostico = array();
			$evolucaoArray = array();
			$condutaArray = array();
			//CADASTRAR PRIMEIRO O ATENDIMENTO

			$especiaista = lookupEspecialista($atendimento->resp);
			if ($especiaista == NULL) {
				$especiaista = 0;
			}

			$fields['codOrganizacao'] = session()->codOrganizacao;
			$fields['codCliente'] = codClienteLookupPorProntuario($atendimento->pron_id, $atendimento->pron_nr);
			$fields['codLocalAtendimento'] = 0;
			$fields['legado'] = 1;
			$fields['codEspecialista'] = $especiaista;
			$fields['codEspecialidade'] = $this->RotinasModel->lookupCodEspecialidade($atendimento->clinica, $atendimento->resp);
			$fields['codStatus'] = 0; //Aguardando classificação
			$fields['dataCriacao'] = $atendimento->data_lc;
			$fields['dataAtualizacao'] = $atendimento->data_lc;
			$fields['dataInicio'] = $atendimento->data_lc;
			$fields['dataEncerramento'] = $atendimento->data_lc;
			$fields['codTipoAtendimento'] = 2; // Consulta Ambulatório
			$fields['codAutor'] = $especiaista;

			// ANAMNESE
			if ($fields['codEspecialista'] !== NULL) {
				if ($codAtendimento = $this->AtendimentosModel->insert($fields)) {

					//INSERIR ANAMNESE
					$anamnese['codAtendimento'] = $codAtendimento;
					$anamnese['codCliente'] = $fields['codCliente'];
					$anamnese['codEspecialidade'] = $fields['codEspecialidade'];
					$anamnese['codEspecialista'] = $fields['codEspecialista'];
					$anamnese['queixaPrincipal'] = null;
					$anamnese['hda'] = $atendimento->lanc;
					$anamnese['hmp'] = $atendimento->cid;
					$anamnese['historiaMedicamentos'] = null;
					$anamnese['historiaAlergias'] = null;
					$anamnese['outrasInformacoes'] = $atendimento->inicio;
					$anamnese['chv'] = null;
					$anamnese['parecer'] = null;
					$anamnese['codStatus'] = 1;
					$anamnese['dataCriacao'] = $atendimento->data_lc;
					$anamnese['dataAtualizacao'] = $atendimento->data_lc;

					if ($this->AtendimentoAnamneseModel->insert($anamnese)) {
					}


					//DIAGNISTICO/CID
					if ($atendimento->cid !== NULL and $atendimento->cid !== "" and $atendimento->cid !== " ") {
						//INSERIR DIAGNISTICO
						$diagnostico['codAtendimento'] = $codAtendimento;
						$diagnostico['codCid'] = lookupCid10($atendimento->cid);
						$diagnostico['codAutor'] = $fields['codEspecialista'];
						$diagnostico['codTipoDiagnostico'] = 1;
						$diagnostico['dataCriacao'] = $atendimento->data_lc;

						if ($this->AtendimentoDiagnosticoModel->insert($diagnostico)) {
						}
					}




					//EVOLUÇÃO e CONDUTA

					if ($atendimento->pron_id !== NULL and $atendimento->pron_id !== '' and $atendimento->pron_nr !== NULL and $atendimento->pron_nr !== '' and $atendimento->id !== NULL and $atendimento->id !== '') {

						$evolucoes = $this->RotinasModel->condutasApolo($atendimento->pron_id, $atendimento->pron_nr, $atendimento->id);

						if (!empty(($evolucoes))) {
							foreach ($evolucoes as $key => $evolucao) {
								if ($evolucao !== NULL) {

									$evolucaoArray['codAtendimento'] = $codAtendimento;
									$evolucaoArray['dataInicio'] = $evolucao->data_lc;
									$evolucaoArray['conteudoEvolucao'] = $evolucao->registro . '' . $evolucao->examefis; //registro e examefis = onde??
									$evolucaoArray['codStatus'] = 1;
									$evolucaoArray['codAutor'] = $fields['codEspecialista'];
									$evolucaoArray['dataEncerramento'] = $evolucao->data_lc;
									$evolucaoArray['dataCriacao'] = $evolucao->data_lc;
									$evolucaoArray['dataAtualizacao'] = $evolucao->data_lc;

									//INSERIR EVOLUÇÃO

									if (strlen($evolucao->registro . '' . $evolucao->examefis) > 2) {
										if ($this->AtendimentosEvolucoesModel->insert($evolucaoArray)) {
										}
									}

									//INSERIR CONDUTA

									$condutaArray['codAtendimento'] = $codAtendimento;
									$condutaArray['dataInicio'] = $evolucao->data_lc;
									$condutaArray['conteudoConduta'] = $evolucao->conduta; //registro e examefis = onde??
									$condutaArray['codStatus'] = 1;
									$condutaArray['codAutor'] = $fields['codEspecialista'];
									$condutaArray['dataEncerramento'] = $evolucao->data_lc;
									$condutaArray['dataCriacao'] = $evolucao->data_lc;
									$condutaArray['dataAtualizacao'] = $evolucao->data_lc;

									if ($evolucao->conduta !== NULL and $evolucao->conduta !== '') {
										if ($this->AtendimentosCondutasModel->insert($condutaArray)) {
										}
									}
								}
							}
						}
					}
				}
			} else {
				continue;
			}
		}



		$response['success'] = true;
		$response['csrf_hash'] = csrf_hash();
		$response['messages'] = 'Atendimentos cadastrados com suceso';
		return $this->response->setJSON($response);
	}

	public function importarItensHospitalares()
	{
		ini_set('max_execution_time', '0'); //300 seconds = 5 minutes
		set_time_limit(0);
		$itensHospitalares = $this->RotinasModel->importarItensHospitalares();


		foreach ($itensHospitalares as $itemHospitalar) {

			$data = array();
			$data['codOrganizacao'] = session()->codOrganizacao;
			$data['codAutor'] = session()->codColaborador;
			$data['nee'] = $itemHospitalar->nee;
			$data['descricaoItem'] = mb_strtoupper($itemHospitalar->descr, "utf-8");
			$data['valor'] = $itemHospitalar->VALOR;
			$data['saldo'] = $itemHospitalar->disp;
			$data['observacao'] = $itemHospitalar->obs;
			$data['sire'] = $itemHospitalar->sire;
			$data['codCategoria'] = lookupCaegoriaItemFarmacia($itemHospitalar->conta);
			$data['ean'] = $itemHospitalar->ean;
			$data['nme'] = $itemHospitalar->nme;
			$data['pp'] = 0;
			$data['dataAtualizacao'] = date('Y-m-d H:i');
			$data['dataValidade'] = dataValidade($itemHospitalar->obs);
			$data['imagemItem'] = null;



			if ($itemHospitalar->nee !== NULL and $itemHospitalar->nee !== "" and $itemHospitalar->nee !== " ") {

				$verificaExistenciaItem = $this->ItensFarmaciaModel->pegaPorDescricao($itemHospitalar->nee);

				if ($verificaExistenciaItem !== NULL) {
					$this->ItensFarmaciaModel->update($verificaExistenciaItem->codItem, $data);
				} else {
					$this->ItensFarmaciaModel->insert($data);
				}
			}
		}



		$response['success'] = true;
		$response['csrf_hash'] = csrf_hash();
		$response['messages'] = 'Itens da famácia importads com sucesso';
		return $this->response->setJSON($response);
	}


	public function sincronizaKits()
	{
		$fields = array();
		$response = array();
		ini_set('max_execution_time', '0'); //300 seconds = 5 minutes
		set_time_limit(0);

		$Kits = $this->RotinasModel->sincronizaKits();



		foreach ($Kits as $Kit) {

			if ($Kit->tipo == 'ENFERMAGEM') {
				$tipo = 1;
			} else {
				$tipo = 2;
			}

			$fields['descricaoKit'] = $Kit->nome;
			$fields['descricaoAlternativa'] = $Kit->descricao;
			$fields['codTipo'] = $tipo;
			$fields['codStatus'] = 1;
			$fields['valorun'] = $Kit->valorun;
			$fields['disponivel'] = $Kit->disponivel;
			$fields['codAutor'] = session()->codColaborador;



			$verificaExistenciaKit = $this->KitsModel->pegaPorNomeKit($Kit->nome);

			if ($verificaExistenciaKit !== NULL) {
				$fields['dataAtualizacao'] = date('Y-m-d H:i');
				$this->KitsModel->update($verificaExistenciaKit->codKit, $fields);
			} else {
				$fields['dataCriacao'] = date('Y-m-d H:i');
				$this->KitsModel->insert($fields);
			}


			//SINCRONIZA ITENS


			$itensKit = $this->RotinasModel->itensKit($Kit->nome);

			$pegaKits = $this->KitsModel->pegaPorNomeKit($Kit->nome);

			foreach ($itensKit as $item) {

				//VERIFICA EXISTENCIA

				$codItem = $this->KitsItensModel->itemKitLookup($item->componentes)->codItem;

				//CADASTRAR ITEM SE NÃO EXISTIR

				if ($codItem == NULL and $item->componentes !== NULL and $item->componentes !== "") {

					$fieldsItemFar['codOrganizacao'] = session()->codOrganizacao;
					$fieldsItemFar['nee'] = 0;
					$fieldsItemFar['descricaoItem'] = mb_strtoupper($item->componentes, "utf-8");
					$fieldsItemFar['valor'] = 0;
					$fieldsItemFar['saldo'] = 0;
					$fieldsItemFar['observacao'] = 'Origem: rotina de importação de kits';
					$fieldsItemFar['sire'] = NULL;
					$fieldsItemFar['codCategoria'] = 1;
					$fieldsItemFar['ean'] = NULL;
					$fieldsItemFar['nme'] = NULL;
					$fieldsItemFar['pp'] = NULL;
					$fieldsItemFar['ativo'] = 1;
					$fieldsItemFar['imagemItem'] = NULL;
					$fieldsItemFar['dataCriacao'] = date('Y-m-d H:i');
					$fieldsItemFar['dataAtualizacao'] = date('Y-m-d H:i');
					$fieldsItemFar['codAutor'] = session()->codColaborador;
					$fieldsItemFar['codBarra'] = strtotime(date('Y-m-d H:i')) + geraNumero(6);
					if ($fieldsItem['codItem'] = $this->ItensFarmaciaModel->insert($fieldsItemFar)) {
					}
				}


				$existeItem = $this->KitsItensModel->verificaExistenciaItemKit($pegaKits->codKit, $codItem);



				$fieldsItem['codItem'] = $codItem;
				$fieldsItem['codKit'] = $verificaExistenciaKit->codKit;
				$fieldsItem['qtde'] = $item->qtde;
				$fieldsItem['codAutor'] = session()->codColaborador;


				if ($existeItem !== NULL) {
					//UPDATE

					$fieldsItem['dataAtualizacao'] = date('Y-m-d H:i');
					$this->KitsItensModel->update($existeItem->codKitItem, $fieldsItem);
				} else {
					//INSERT

					$fieldsItem['dataCriacao'] = date('Y-m-d H:i');
					$fieldsItem['dataAtualizacao'] = date('Y-m-d H:i');
					$this->KitsItensModel->insert($fieldsItem);
				}
			}
		}






		$response['success'] = true;
		$response['csrf_hash'] = csrf_hash();
		$response['messages'] = 'Kits Sincronizados';
		return $this->response->setJSON($response);
	}

	public function importarFornecedores()
	{
		ini_set('max_execution_time', '0'); //300 seconds = 5 minutes
		set_time_limit(0);
		$fornecedores = $this->RotinasModel->importarFornecedores();

		foreach ($fornecedores as $fornecedor) {

			$data = array();

			//VERIFICA SE OCS/PSC OU EMPRESA COMUM

			#1 = FORNECEDOR MATERIAL OU SERVIÇO
			#2 = OCS
			#3	 = PSA
			$codTipo = 1;

			if ($fornecedor->ocspsa == 'OCS') {
				$codTipo = 2;
			}
			if ($fornecedor->ocspsa == 'PSA') {
				$codTipo = 3;
			}

			//ESTADO

			$estado = lookupcodEstadoFederacao($fornecedor->uf);
			if ($estado == NULL) {
				$estado = 16;
			}

			$fields['inscricao'] = $fornecedor->cnpj;
			$fields['codTipo'] = $codTipo;
			$fields['nomeFantasia'] = mb_strtoupper($fornecedor->nome_fantasia, 'utf-8');
			$fields['razaoSocial'] = mb_strtoupper($fornecedor->razao_social, 'utf-8');
			$fields['endereco'] = $fornecedor->razao_social->endereco;
			$fields['cidade'] = mb_strtoupper($fornecedor->cidade, 'utf-8');
			$fields['codEstadoFederacao'] = $estado;
			$fields['cep'] = $fornecedor->razao_social->CEP;
			$fields['contatos'] = $fornecedor->contatos;
			$fields['email'] = $fornecedor->email;
			$fields['website'] = $fornecedor->website;
			$fields['simples'] = $fornecedor->simples;
			$fields['mnt'] = $fornecedor->mnt;
			$fields['obs'] = $fornecedor->website;
			$fields['dataCriacao'] = date('Y-m-d H:i');
			$fields['dataAtualizacao'] = date('Y-m-d H:i');
			$fields['codAutor'] = session()->codColaborador;

			$this->FornecedoresModel->insert($fields);
		}




		$response['success'] = true;
		$response['csrf_hash'] = csrf_hash();
		$response['messages'] = 'Fornecedores importados com sucesso';
		return $this->response->setJSON($response);
	}
	public function importarRequisicoes()
	{
		ini_set('max_execution_time', '0'); //300 seconds = 5 minutes
		set_time_limit(0);
		$requisicoes = $this->RotinasModel->importarRequisicoes();




		//ATUALIZA PREC DA TABEMA DE COLABORADORES COM O PREC DE CLIENTES
		$this->RotinasModel->atualizaPrec();

		foreach ($requisicoes as $requisicao) {

			$data = array();

			//UNIDADE

			$codUnidade = lookupMigracaoUnidades($requisicao->sec_nome);

			if ($codUnidade == NULL or $codUnidade == "" or $codUnidade == " ") {
				$codUnidade = 0;
			}



			//TIPO SERVIÇO

			$codClasseRequisicao = 5;

			if ($requisicao->tipo == 'Material Permanente') {
				$codClasseRequisicao = 1;
			}


			if ($requisicao->tipo == 'Material de Duradouro') {
				$codClasseRequisicao = 2;
			}

			if ($requisicao->tipo == 'Material de Consumo') {
				$codClasseRequisicao = 3;
			}

			if ($requisicao->tipo == 'Serviços') {
				$codClasseRequisicao = 4;
			}


			$codStatus = 1;
			if ($requisicao->situacao == 'APROVADO') {
				$codStatus = 5;
			}

			if ($requisicao->situacao == 'DESPACHADO') {
				$codStatus = 2;
			}

			if ($requisicao->situacao == 'EM ELABORAÇÃO') {
				$codStatus = 1;
			}
			if ($requisicao->situacao == 'AGD APROVAÇÃO') {
				$codStatus = 3;
			}

			if ($requisicao->situacao == 'A EMPENHAR') {
				$codStatus = 6;
			}
			if ($requisicao->situacao == 'A CONTRATAR') {
				$codStatus = 7;
			}

			$codTipoRequisicao = 99;

			if ($requisicao->tpreq == 'AQS MAT N LIC') {
				$codTipoRequisicao = 10;
			}

			if ($requisicao->tpreq == 'AQS MAT LIC') {
				$codTipoRequisicao = 20;
			}

			if ($requisicao->tpreq == 'PGTO OCS/PSA') {
				$codTipoRequisicao = 50;
			}

			if ($requisicao->tpreq == 'REQ ANUL EMP') {
				$codTipoRequisicao = 40;
			}

			if ($requisicao->tpreq == 'RESSARCIMENTO') {
				$codTipoRequisicao = 55;
			}

			if ($requisicao->tpreq == 'PAG DIV') {
				$codTipoRequisicao = 60;
			}

			if ($requisicao->tpreq == 'AQS MAT N LIC(DISP)') {
				$codTipoRequisicao = 30;
			}
			if ($requisicao->tpreq == 'OUTROS') {
				$codTipoRequisicao = 90;
			}

			$codAutor = $this->RotinasModel->lookupcodColaborador($requisicao->resp)->codColaborador;

			if ($codAutor == NULL or $codAutor == "" or $codAutor == " ") {
				$codAutor = session()->codColaborador;
			}

			$matSau = 0;

			if ($requisicao->matsau == 'SIM') {
				$matSau = 1;
			}


			$carDisp = 0;
			if ($requisicao->cardisp == 'SIM') {
				$carDisp = 1;
			}


			if ($requisicao->ano == NULL or $requisicao->ano == "" or $requisicao->ano == " ") {
				$ano = date("Y", strtotime($requisicao->data_sol));
			} else {
				$ano = $requisicao->ano;
			}

			$fieldsRequisicao['numeroRequisicao'] = $requisicao->nr;
			$fieldsRequisicao['ano'] = $ano;
			$fieldsRequisicao['nrRef'] = $requisicao->obs;
			$fieldsRequisicao['descricao'] = $requisicao->obs;
			$fieldsRequisicao['codTipoRequisicao'] = $codTipoRequisicao;
			$fieldsRequisicao['codUnidade'] = $codUnidade;
			$fieldsRequisicao['codClasseRequisicao'] = $codClasseRequisicao;
			$fieldsRequisicao['matSau'] = $matSau;
			$fieldsRequisicao['carDisp'] = $carDisp;
			$fieldsRequisicao['codAutor'] = $codAutor;
			$fieldsRequisicao['codStatus'] = $codStatus;
			$fieldsRequisicao['valorTotal'] = $requisicao->valorTotal;
			$fieldsRequisicao['codAutorUltAlteracao'] = $codAutor;
			$fieldsRequisicao['dataRequisicao'] = $requisicao->data_sol;
			$fieldsRequisicao['dataCriacao'] = $requisicao->data_sol;
			$fieldsRequisicao['dataAtualizacao'] = $requisicao->data_sol;
			$codRequisicao = NULL;
			$codRequisicao = $this->RequisicaoModel->insert($fieldsRequisicao);

			if ($codRequisicao > 0 and $codRequisicao !== NULL and $codRequisicao !== "" and $codRequisicao !== " ") {



				$atualizaUnidade['SeqAno'] = $requisicao->ano;
				$atualizaUnidade['seqRequisicao'] = $requisicao->nr;
				$this->UnidadesModel->update($codUnidade, $atualizaUnidade);


				$requisicoesInforComplementares = array();
				$requisicoesInforComplementares = $this->RotinasModel->importarRequisicoesInformacoesComplementares($requisicao->sec_nome, $requisicao->nr, $requisicao->ano);


				foreach ($requisicoesInforComplementares as $requisicaoInforComplementar) {


					$codCategoria = 1;
					if ($requisicaoInforComplementar->titulo == 'Qualidade dos itens') {
						$codCategoria = 2;
					}
					if ($requisicaoInforComplementar->titulo == 'Justificativa para aquisição') {
						$codCategoria = 1;
					}

					if ($requisicaoInforComplementar->titulo == 'Informações complementares') {
						$codCategoria = 3;
					}

					if ($requisicaoInforComplementar->titulo == 'Exigências técnicas e legais') {
						$codCategoria = 4;
					}


					if ($requisicaoInforComplementar->titulo == 'Periodicidade do serviço') {
						$codCategoria = 5;
					}

					if ($requisicaoInforComplementar->titulo == 'Justificativa para a aquisição') {
						$codCategoria = 1;
					}
					if ($requisicaoInforComplementar->titulo == 'Descrição detalhada do serviço') {
						$codCategoria = 6;
					}
					if ($requisicaoInforComplementar->titulo == 'Valor atual do(s) equipamento(s) a ser (em) manutenido(s)') {
						$codCategoria = 7;
					}
					if ($requisicaoInforComplementar->titulo == 'Descrição do material') {
						$codCategoria = 8;
					}
					if ($requisicaoInforComplementar->titulo == 'Forma de execução do serviço') {
						$codCategoria = 9;
					}





					$fieldsInforComplementar['codRequisicao'] = $codRequisicao;
					$fieldsInforComplementar['codCategoria'] = $codCategoria;
					$fieldsInforComplementar['conteudo'] = $requisicaoInforComplementar->descr;
					$fieldsInforComplementar['dataCriacao'] = $requisicao->data_sol;
					$fieldsInforComplementar['dataAtualizacao'] = $requisicao->data_sol;
					$fieldsInforComplementar['codAutor'] = $codAutor;

					$this->InformacoesComplementaresModel->insert($fieldsInforComplementar);
				}




				//ADICIONAR OS ITENS

				$itensRequisicoes = array();
				$itensRequisicoes = $this->RotinasModel->itensRequisicoes($requisicao->sec_nome, $requisicao->nr, $requisicao->ano);


				foreach ($itensRequisicoes as $itensRequisicao) {




					//$orcamentoItem = 4;
					if ($requisicao->tipo_ref_preco == 'ATA') {
						$orcamentoItem = 1;
					}
					if ($requisicao->tipo_ref_preco == 'Fornecedor') {
						$orcamentoItem = 2;
					}
					if ($requisicao->tipo_ref_preco == 'Internet') {
						$orcamentoItem = 3;
					}
					if ($requisicao->tipo_ref_preco == 'Comprasnet') {
						$orcamentoItem = 4;
					}
					if ($requisicao->tipo_ref_preco == 'Favorecido') {
						$orcamentoItem = 5;
					}
					if ($requisicao->catipo_ref_precordisp == 'Outro') {
						$orcamentoItem = 6;
					}





					$fieldsItem['codRequisicao'] = $codRequisicao;
					$fieldsItem['NrRef'] = $itensRequisicao->obs;
					$fieldsItem['descricao'] = $itensRequisicao->espec;
					$fieldsItem['unidade'] = $this->RotinasModel->lookupUnidadeItem($itensRequisicao->unidade)->codUnidade;
					$fieldsItem['qtde_sol'] = $itensRequisicao->qtde_sol;
					$fieldsItem['qtde_atd'] = $itensRequisicao->qtde_atd;
					$fieldsItem['valorUnit'] = brl2decimal($itensRequisicao->valorUnit);
					$fieldsItem['valorTotal'] = brl2decimal($itensRequisicao->valorTotal);
					$fieldsItem['cod_siasg'] = $itensRequisicao->cod_siasg;
					$fieldsItem['tipoMaterial'] = 9; //OUTROS
					$fieldsItem['obs'] = $itensRequisicao->obs;
					$fieldsItem['dataCriacao'] = date('Y-m-d H:i');
					$fieldsItem['dataAtualizacao'] = date('Y-m-d H:i');
					$fieldsItem['codAutorUltAlteracao'] = session()->codColaborador;
					$codRequisicaoItem = $this->ItensRequisicaoModel->insert($fieldsItem);


					if ($codRequisicaoItem > 0 and $codRequisicaoItem !== NULL and $codRequisicaoItem !== "" and $codRequisicaoItem !== " ") {


						//ADICIONAR ORÇAMENTOS


						$orcamentos = array();
						$orcamentos = $this->RotinasModel->orcamentos($requisicao->sec_nome, $requisicao->nr, $requisicao->ano, $itensRequisicao->idItem);


						foreach ($orcamentos as $orcamento) {

							$codTipoOrcamento = NULL;
							$codTipoOrcamento = $this->RotinasModel->lookupPegaTipoOrcamento($orcamento->tipo)->codTipoOrcamento;

							if ($codTipoOrcamento == NULL or $codTipoOrcamento == "" or $codTipoOrcamento == " ") {
								$codTipoOrcamento = 6;
							}

							$fieldsOrcamento['codFornecedor'] = $this->RotinasModel->lookupPegaCodFornecedor($orcamento->razaosocial)->codFornecedor;
							$fieldsOrcamento['valorUnitario'] = brl2decimal($orcamento->preco);
							$fieldsOrcamento['codTipoOrcamento'] = $codTipoOrcamento;
							$fieldsOrcamento['codRequisicaoItem'] = $codRequisicaoItem;
							$fieldsOrcamento['dataOrcamento'] = $orcamento->data_lc;
							$fieldsOrcamento['dataCriacao'] = $orcamento->data_lc;
							$fieldsOrcamento['dataAtualizacao'] = $orcamento->data_lc;

							$this->OrcamentosModel->insert($fieldsOrcamento);
						}
					}
				}


				//ADICIONAR AÇÕES/DESPACHOS


				$acoes = array();
				$historicoAcoes = $this->RotinasModel->historicoAcoes($requisicao->sec_nome, $requisicao->nr, $requisicao->ano);

				foreach ($historicoAcoes as $historicoAcao) {

					$codAutor = $this->RotinasModel->lookupcodColaborador($historicoAcao->resp)->codColaborador;

					if ($codAutor == NULL or $codAutor == "" or $codAutor == " ") {
						$codAutor = session()->codColaborador;
					}

					$fieldsHistoricoAcao['codTipoAcao'] = 1;
					$fieldsHistoricoAcao['descricaoAcao'] = $historicoAcao->despacho;
					$fieldsHistoricoAcao['codAutor'] = $codAutor;
					$fieldsHistoricoAcao['dataCriacao'] = $historicoAcao->data_lc;
					$fieldsHistoricoAcao['recurso'] = $historicoAcao->recurso;
					$fieldsHistoricoAcao['codRequisicao'] = $codRequisicao;

					$this->HistoricoAcoesModel->insert($fieldsHistoricoAcao);
				}
			}
		}


		$response['success'] = true;
		$response['csrf_hash'] = csrf_hash();
		$response['messages'] = 'Requisições importados com sucesso';
		return $this->response->setJSON($response);
	}

	public function importarAgendas()
	{
		ini_set('max_execution_time', '0'); //300 seconds = 5 minutes
		set_time_limit(0);
		$agendas = $this->ColaboradoresModel->agendasApolo();

		foreach ($agendas as $agenda) {

			$data = array();

			$data['codConfig'] = 0;
			$data['codOrganizacao'] = session()->codOrganizacao;
			$data['codEspecialista'] = lookupEspecialista($agenda->prec_cp);
			$data['codEspecialidade'] = lookupCodEspecialidade($agenda->nome_esp);
			$data['dataCriacao'] = $agenda->data_lc;
			$data['dataAtualizacao'] = $agenda->data_lc;
			$data['dataInicio'] = $agenda->gdh;
			$data['dataEncerramento'] = $agenda->gdh;
			$data['codAutor'] = session()->codColaborador;
			$data['protocolo'] = $agenda->obs;
			$data['ordemAtendimento'] = 0;
			$data['chegou'] = 0;
			$data['confirmou'] = 0;
			$data['horaChegada'] = null;


			if ($agenda->pron_id !== NULL and $agenda->pron_id !== "") {
				$cliente = $this->ClientesModel->pegaClientePorCodProntuario($agenda->pron_id, $agenda->pron_nr);

				$data['codCliente'] = $cliente->codCliente;
				$data['codStatus'] = 1;
			} else {
				$data['codCliente'] = 0;
				$data['codStatus'] = 0;
			}

			if (lookupCodEspecialidade($agenda->nome_esp) !== NULL and lookupEspecialista($agenda->prec_cp) !== NULL and $agenda->gdh !== NULL and lookupCodEspecialidade($agenda->nome_esp) !== "" and lookupEspecialista($agenda->prec_cp) !== "" and $agenda->gdh !== "") {
				$verificaExistenciaAgendamento = $this->AgendamentosModel->verificaExistenciaAgendamento(lookupCodEspecialidade($agenda->nome_esp), lookupEspecialista($agenda->prec_cp), $agenda->gdh);

				if ($verificaExistenciaAgendamento !== NULL) {


					if (($verificaExistenciaAgendamento->datacriacao == $verificaExistenciaAgendamento->dataAtualizacao) and ($agenda->pron_id !== NULL and $agenda->pron_id !== "")) {
						$this->AgendamentosModel->update($verificaExistenciaAgendamento->codAgendamento, $data);
					}
				} else {

					$this->AgendamentosModel->insert($data);
				}
			}
		}



		$response['success'] = true;
		$response['csrf_hash'] = csrf_hash();
		$response['messages'] = 'Agendas importadas com sucesso';
		return $this->response->setJSON($response);
	}


	public function ajustarLookupsColaboradores()
	{

		$response = array();

		$data['data'] = array();

		$colaboradoresUsadas = $this->RotinasModel->colaboradoresUsadas();

		foreach ($colaboradoresUsadas as $key => $colaborador) {

			if ($this->RotinasModel->lookupcodColaboradorSIGH($colaborador->CD_COLABORADOR) == NULL) {

				$this->RotinasModel->addColaboradorLookup($colaborador->CD_COLABORADOR, $colaborador->NOME, $colaborador->PRECCP, $colaborador->CPF);
			}

			//VERIFICA SE NOMES IGUAIS E JÁ CONFIGURA
			$dadosColaboradorSandra = $this->RotinasModel->pegaColaboradorSandraPorNome($colaborador->NOME);

			if ($dadosColaboradorSandra !== NULL) {
				$this->RotinasModel->editColaboradorLookup($colaborador->CD_COLABORADOR, $dadosColaboradorSandra->codColaborador, $dadosColaboradorSandra->nomeCompleto, $dadosColaboradorSandra->codBen, $dadosColaboradorSandra->cpf);
			}
		}

		$colaboradores = $this->RotinasModel->lookupListaColaboradores();
		$x = 0;
		foreach ($colaboradores as $key => $value) {
			$x++;

			$colaboradoresSandra = $this->RotinasModel->colaboradoresSandra();

			$select = '<select id="codColaborador_' .  $value->CD_COLABORADOR . '" name="codColaborador_' . $value->CD_COLABORADOR . '" class="select2">
			<option value=""></option>';

			foreach ($colaboradoresSandra as $colaboradorSandra) {

				if ($value->codColaborador == $colaboradorSandra->codColaborador) {
					$select .= '<option selected value="' . $colaboradorSandra->codColaborador . '">' . $colaboradorSandra->nomeCompleto . '</option>';
				} else {
					$select .= '<option value="' . $colaboradorSandra->codColaborador . '">'  . $colaboradorSandra->nomeCompleto  . '</option>';
				}
			}

			$select .= '</select>';


			$data['data'][$key] = array(
				$value->CD_COLABORADOR,
				$value->NOME,
				$select,
			);
		}


		return $this->response->setJSON($data);
	}

	public function ajustarLookupsEspecialidades()
	{

		$response = array();

		$data['data'] = array();

		$especialidadesUsadas = $this->RotinasModel->especialidadesUsadas();

		foreach ($especialidadesUsadas as $key => $especialidade) {

			if ($this->RotinasModel->lookupCodEspecialidadeSIGH($especialidade->CD_ESPECIALIDADE) == NULL) {

				$this->RotinasModel->addEspecialidadeLookup($especialidade->CD_ESPECIALIDADE, $especialidade->ESPECIALIDADE);
			}
		}

		$especialidades = $this->RotinasModel->lookupListaEspecialidades();
		$x = 0;
		foreach ($especialidades as $key => $value) {
			$x++;

			$especialidadesSandra = $this->RotinasModel->especialidadesSandra();
			$select = '<select id="codEspecialidade_' .  $value->CD_ESPECIALIDADE . '" name="codEspecialidade_' . $value->CD_ESPECIALIDADE . '" class="select2">
			<option value=""></option>';

			foreach ($especialidadesSandra as $especialidadeSandra) {

				if ($value->descricaoEspecialidade == $especialidadeSandra->descricaoEspecialidade) {
					$select .= '<option selected value="' . $especialidadeSandra->codEspecialidade . '">' . $especialidadeSandra->descricaoEspecialidade . '</option>';
				} else {
					$select .= '<option value="' . $especialidadeSandra->codEspecialidade . '">' . $especialidadeSandra->descricaoEspecialidade . '</option>';
				}
			}

			$select .= '</select>';


			$data['data'][$key] = array(
				$value->CD_ESPECIALIDADE,
				$value->ESPECIALIDADE,
				$select,
			);
		}


		return $this->response->setJSON($data);
	}

	public function salvarEspecialidadeLookup()
	{

		foreach ($this->request->getPost() as $chave => $atributo) {
			$fields = array();

			if (strpos($chave,  'codEspecialidade_') !== false) {
				$codEspecialidadeSIGH = str_replace('codEspecialidade_', '', $chave);




				$codEspecialidade =  $this->request->getPost('codEspecialidade_' . $codEspecialidadeSIGH);

				if ($codEspecialidadeSIGH !== NULL and $codEspecialidadeSIGH !== "" and $codEspecialidadeSIGH !== " " and $codEspecialidade !== NULL and $codEspecialidade !== "" and $codEspecialidade !== " ") {

					$descricaoEspecialidade = $this->EspecialidadesModel->lookupCodNomeEspecialidade($codEspecialidade)->descricaoEspecialidade;
					$this->RotinasModel->editEspecialidadeLookup($codEspecialidadeSIGH, $codEspecialidade, $descricaoEspecialidade);
				}
			}
		}


		$response['success'] = true;
		$response['csrf_hash'] = csrf_hash();
		$response['messages'] = 'Lookpup de especialidades salvo com sucesso';
		return $this->response->setJSON($response);
	}


	public function salvarColaboradorLookup()
	{

		foreach ($this->request->getPost() as $chave => $atributo) {
			$fields = array();

			if (strpos($chave,  'codColaborador_') !== false) {
				$codColaboradorSIGH = str_replace('codColaborador_', '', $chave);


				$codColaborador =  $this->request->getPost('codColaborador_' . $codColaboradorSIGH);

				if ($codColaboradorSIGH !== NULL and $codColaboradorSIGH !== "" and $codColaboradorSIGH !== " " and $codColaborador !== NULL and $codColaborador !== "" and $codColaborador !== " ") {

					$colaborador = $this->RotinasModel->dadosColaborador($codColaborador);
					$this->RotinasModel->editColaboradorLookup($codColaboradorSIGH, $colaborador->codColaborador, $colaborador->nomeCompleto, $colaborador->codBen, $colaborador->cpf);

					//Adicionar usuário como membro Especialidades que ele tem
					$especialidadesAddmembro = $this->RotinasModel->especialidadesDesteColaborador($codColaboradorSIGH);

					foreach ($especialidadesAddmembro as $especialidade) {

						//TRANSFORMAR ESPECIALIDADE PARA O CDS SAÚDE
						$codEpecialidadeSandra = $this->RotinasModel->lookupCodEspecialidadeSIGH($especialidade->CD_ESPECIALIDADE)->codEspecialidade;


						$membros['codOrganizacao'] = session()->codOrganizacao;

						$membros['codEspecialidade'] = $codEpecialidadeSandra;


						$membros['codColaborador'] = $colaborador->codColaborador;
						$membros['codEstadoFederacao'] = lookupcodEstadoFederacao(session()->uf);
						$membros['numeroInscricao'] = '000000';
						$membros['dataInscricao'] =  date('Y-m-d H:i');
						$membros['numeroSire'] = NULL;
						$membros['observacoes'] = NULL;
						$membros['dataCriacao'] = date('Y-m-d H:i');
						$membros['dataAtualizacao'] = date('Y-m-d H:i');
						$membros['autor'] = session()->codColaborador;
						$membros['atende'] = 1;


						if ($colaborador->codColaborador !== NULL and $colaborador->codColaborador >= 1 and $codEpecialidadeSandra !== NULL) {

							$membrosEspecilidade = $this->EspecialidadesModel->pegaMembroPorEspecialidadeEcodColaborador($codEpecialidadeSandra, $colaborador->codColaborador);

							if ($membrosEspecilidade !== NULL) {
								@$this->EspecialidadesMembroModel->update($membrosEspecilidade->codEspecialidadeMembro, $membros);
							} else {

								@$this->EspecialidadesMembroModel->insert($membros);
							}
						}
					}
				}
			}
		}


		$response['success'] = true;
		$response['csrf_hash'] = csrf_hash();
		$response['messages'] = 'Lookpup de colaboradores salvo com sucesso';
		return $this->response->setJSON($response);
	}


	public function importarColaboradoresSIGH()
	{
		ini_set('max_execution_time', '0'); //300 seconds = 5 minutes
		set_time_limit(0);

		$response = array();


		$chave = $this->RotinasModel->pegaChave(session()->codOrganizacao)->chaveSalgada;
		$tipo_cifra = 'des';

		$COLABORADOR = $this->RotinasModel->colaboradoresSIGH();

		foreach ($COLABORADOR as $colaborador) {

			$verificaExistenciaColaborador = $this->RotinasModel->verificaExistenciaColaborador($colaborador->NOME);

			if ($verificaExistenciaColaborador == NULL) {

				$verificacodColaborador = $this->RotinasModel->verificacodColaborador($colaborador->CD_COLABORADOR);
				if ($verificacodColaborador == NULL) {
					$fields['codColaborador'] = $colaborador->CD_COLABORADOR;
				} else {
					$fields['codColaborador'] = NULL;
				}





				$senha = hash("sha256", $colaborador->SENHA  . $chave);

				$fields['senha'] = $senha;
				$fields['senhaResincLDAP'] = $senha;


				$cargo = $this->CargosModel->pegaCargosPorCodigo(postoGraduacaoLookupSIGH($colaborador->PSTGRD));




				$fields['codOrganizacao'] =  session()->codOrganizacao;
				$fields['codClasse'] = 1;
				$fields['conta'] = mb_strtolower($colaborador->COLABORADOR, "utf-8");
				$fields['nomeExibicao'] =  $cargo->siglaCargo . ' ' . $colaborador->GUERRA;
				$fields['nomePrincipal'] =  $cargo->siglaCargo . ' ' . $colaborador->GUERRA;
				$fields['nomeCompleto'] =  $colaborador->NOME;
				$fields['identidade'] =  $colaborador->IDENT;
				$fields['cpf'] = removeCaracteresIndesejados($colaborador->CPF);
				$fields['codBen'] = removeCaracteresIndesejados($colaborador->PRECCP);
				$fields['emailFuncional'] =  trim($colaborador->EMAIL);
				$fields['emailPessoal'] = trim($colaborador->EMAIL);
				$fields['codEspecialidade'] =  NULL;
				$fields['telefoneTrabalho'] = $colaborador->FONE;
				$fields['celular'] = $colaborador->CELULAR;
				$fields['endereco'] =  $colaborador->ENDERECO . ", " . $colaborador->BAIRRO . ", " . $colaborador->CIDADE;
				$fields['dataInicioEmpresa'] =   date('Y-m-d H:i:s');
				$fields['dataCriacao'] = date('Y-m-d H:i:s');
				$fields['dataAtualizacao'] = date('Y-m-d H:i:s');
				$fields['dataNascimento'] = $colaborador->DT_NASC;
				$fields['codUnidade'] =  NULL;
				$fields['codFuncao'] = NULL;
				$fields['codCargo'] = postoGraduacaoLookupSIGH($colaborador->PSTGRD);
				$fields['codPerfilPadrao'] = NULL;
				$fields['nrEndereco'] =   NULL;
				$fields['codMunicipioFederacao'] =  NULL;
				$fields['cep'] =  $colaborador->CEP;
				$fields['informacoesComplementares'] =   NULL;
				$fields['pai'] = NULL;
				$fields['ativo'] = $colaborador->ATIVO;
				$fields['aceiteTermos'] = 1;

				if ($codColaborador = $this->ColaboradoresModel->insert($fields)) {
				}
			}
		}

		$response['success'] = true;
		$response['csrf_hash'] = csrf_hash();
		$response['messages'] = 'Colaboradores importados com sucesso';
		return $this->response->setJSON($response);
	}


	public function importarBoletinsSIGH()
	{
		ini_set('max_execution_time', '0'); //300 seconds = 5 minutes
		set_time_limit(0);

		$response = array();

		$importarBoletins = $this->RotinasModel->listarBoletinsSIGH();


		foreach ($importarBoletins as $atendimento) {
			$codAtendimento = NULL;
			$fields = array();
			$anamnese = array();
			$anamnese = array();
			$diagnostico = array();
			$evolucaoArray = array();
			$condutaArray = array();
			$codEspeciaista = 0;
			//CADASTRAR PRIMEIRO O ATENDIMENTO

			$codEspeciaista = $this->RotinasModel->lookupCodEspecialitaSandra($atendimento->CD_MED_RESP)->codColaborador;

			$codEspecialidade = $this->RotinasModel->lookupCodEspecialidadeSIGH($atendimento->CD_ESPECIALIDADE)->codEspecialidade;


			//VERIFICA SE JA EXISTE
			$verificaSeJaImportado = $this->RotinasModel->verificaSeJaImportado($atendimento->CD_CLIENTE, $codEspeciaista, $atendimento->DT_BOLETIM);

			if ($verificaSeJaImportado == NULL) {

				////STATUS AMBULATÓRIO
				$status = 0; //Aguardando classificação

				if ($atendimento->CD_SIT_BOL == 1) {
					$status = 13;
				}

				if ($atendimento->CD_SIT_BOL == 3) {
					$status = 1;
				}

				if ($atendimento->CD_SIT_BOL == 4) {
					$status = 8;
				}

				if ($atendimento->CD_SIT_BOL == 5) {
					$status = 3;
				}

				if ($atendimento->CD_SIT_BOL == 6) {
					$status = 3;
				}

				if ($atendimento->CD_SIT_BOL == 7) {
					$status = 3;
				}

				if ($atendimento->CD_SIT_BOL == 8) {
					$status = 15;
				}

				if ($atendimento->CD_SIT_BOL == 9) {
					$status = 5;
				}

				if ($atendimento->CD_SIT_BOL == 10) {
					$status = 8;
				}





				$fields['codOrganizacao'] = session()->codOrganizacao;
				$fields['codAtendimento'] = $atendimento->CD_BOLETIM;
				$fields['codCliente'] = $atendimento->CD_CLIENTE;
				$fields['codLocalAtendimento'] = 0;
				$fields['legado'] = 1;
				$fields['migrado'] = 1;
				$fields['codEspecialista'] = $codEspeciaista;
				$fields['codEspecialidade'] = $codEspecialidade;
				$fields['codStatus'] = $status;
				$fields['dataCriacao'] = $atendimento->DT_BOLETIM;
				$fields['dataAtualizacao'] = $atendimento->DT_BOLETIM;
				$fields['dataInicio'] = $atendimento->DT_BOLETIM;
				$fields['dataEncerramento'] = $atendimento->DT_BOLETIM;
				$fields['codTipoAtendimento'] = 2; // Consulta Ambulatório
				$fields['codAutor'] = $codEspeciaista;


				if ($fields['codEspecialista'] !== NULL and $fields['codEspecialidade'] !== NULL) {



					if ($codAtendimento = $this->AtendimentosModel->insert($fields)) {

						//INSERIR ANAMNESE
						$anamnese['codAtendimento'] = $codAtendimento;
						$anamnese['codCliente'] = $fields['codCliente'];
						$anamnese['codEspecialidade'] = $fields['codEspecialidade'];
						$anamnese['codEspecialista'] = $fields['codEspecialista'];
						$anamnese['queixaPrincipal'] = null;
						$anamnese['hda'] = $atendimento->HDA;
						$anamnese['exameFisico'] = $atendimento->EXAME_FISICO;
						$anamnese['outrasInformacoes'] = $atendimento->EXAMES;
						$anamnese['hmp'] = $atendimento->HPP;
						$anamnese['historiaMedicamentos'] = null;
						$anamnese['historiaAlergias'] = null;
						$anamnese['outrasInformacoes'] = null;
						$anamnese['chv'] = null;
						$anamnese['parecer'] = null;
						$anamnese['codStatus'] = 1;
						$anamnese['dataCriacao'] = $atendimento->DT_BOLETIM;
						$anamnese['dataAtualizacao'] = $atendimento->DT_BOLETIM;
						$diagnostico['migrado'] = 1;

						if ($this->AtendimentoAnamneseModel->insert($anamnese)) {
						}



						//DIAGNISTICO/CID


						$cids = $this->RotinasModel->pegaCIDBoletom($atendimento->CD_BOLETIM);



						if ($cids !== NULL) {
							foreach ($cids as $cid) {

								if ($cid->CD_CID !== NULL and $cid->CD_CID !== "" and $cid->CD_CID !== " ") {

									//PEGA CODCID

									$codCid = $this->RotinasModel->pegaCodCid($cid->CD_CID)->codCid;

									if ($codCid !== NULL) {
										//INSERIR DIAGNISTICO

										if ($cid->TIPO == 'P') {
											$codTipoDiagnostico = 1;
										} else {
											$codTipoDiagnostico = 2;
										}


										$diagnostico['codAtendimento'] = $codAtendimento;
										$diagnostico['codCid'] = $codCid;
										$diagnostico['codAutor'] = $codEspeciaista;
										$diagnostico['codTipoDiagnostico'] = $codTipoDiagnostico;
										$diagnostico['dataCriacao'] = $atendimento->DT_BOLETIM;
										$diagnostico['migrado'] = 1;

										if ($this->AtendimentoDiagnosticoModel->insert($diagnostico)) {
										}
									}
								}
							}
						}



						//INSERIR CONDUTA

						$condutaArray['codAtendimento'] = $codAtendimento;
						$condutaArray['dataInicio'] = $atendimento->DT_BOLETIM;
						$condutaArray['conteudoConduta'] = $atendimento->CONDUTA; //registro e examefis = onde??
						$condutaArray['codStatus'] = 1;
						$condutaArray['codAutor'] = $fields['codEspecialista'];
						$condutaArray['dataEncerramento'] = $atendimento->DT_BOLETIM;
						$condutaArray['dataCriacao'] = $atendimento->DT_BOLETIM;
						$condutaArray['dataAtualizacao'] = $atendimento->DT_BOLETIM;

						if ($atendimento->CONDUTA !== NULL and $atendimento->CONDUTA !== '') {
							if ($this->AtendimentosCondutasModel->insert($condutaArray)) {
							}
						}
					}
				}
			}
		}
	}

	public function importarAmbulatorioSIGH()
	{
		ini_set('max_execution_time', '0'); //300 seconds = 5 minutes
		set_time_limit(0);

		$response = array();

		$importarAmbulatorios = $this->RotinasModel->listarAmbulatoriosSIGH();


		foreach ($importarAmbulatorios as $atendimento) {
			$codAtendimento = NULL;
			$fields = array();
			$anamnese = array();
			$anamnese = array();
			$diagnostico = array();
			$evolucaoArray = array();
			$condutaArray = array();
			$codEspeciaista = 0;
			//CADASTRAR PRIMEIRO O ATENDIMENTO



			$codEspeciaista = $this->RotinasModel->lookupCodEspecialitaSandra($atendimento->CD_USER_REG)->codColaborador;

			$codEspecialidade = $this->RotinasModel->lookupCodEspecialidadeSIGH($atendimento->CD_ESPECIALIDADE)->codEspecialidade;

			//VERIFICA SE JA EXISTE

			$verificaSeJaImportado = $this->RotinasModel->verificaSeJaImportado($atendimento->CD_CLIENTE, $codEspeciaista, $atendimento->DT_REG);

			if ($verificaSeJaImportado == NULL) {

				////STATUS AMBULATÓRIO
				$status = 0; //Aguardando classificação

				if ($atendimento->CD_SIT_AMB == 1) {
					$status = 1; //Em atendimento
				}
				if ($atendimento->CD_SIT_AMB == 2) {
					$status = 4; //Aguardando Exame/melhora
				}
				if ($atendimento->CD_SIT_AMB == 3) {
					$status = 3; //Abandonou tratamento
				}
				if ($atendimento->CD_SIT_AMB == 4) {
					$status = 8; //Liberado
				}
				$fields['codOrganizacao'] = session()->codOrganizacao;
				$fields['codAtendimento'] = $atendimento->CD_AMBULATORIO;
				$fields['codCliente'] = $atendimento->CD_CLIENTE;
				$fields['codLocalAtendimento'] = 0;
				$fields['legado'] = 1;
				$fields['migrado'] = 1;
				$fields['codEspecialista'] = $codEspeciaista;
				$fields['codEspecialidade'] = $codEspecialidade;
				$fields['codStatus'] = $status;
				$fields['dataCriacao'] = $atendimento->DT_REG;
				$fields['dataAtualizacao'] = $atendimento->DT_REG;
				$fields['dataInicio'] = $atendimento->DT_REG;
				$fields['dataEncerramento'] = $atendimento->DT_REG;
				$fields['codTipoAtendimento'] = 2; // Consulta Ambulatório
				$fields['codAutor'] = $codEspeciaista;

				// ANAMNESE
				if ($fields['codEspecialista'] !== NULL and $fields['codEspecialidade'] !== NULL) {


					if ($codAtendimento = $this->AtendimentosModel->insert($fields)) {

						//INSERIR ANAMNESE
						$anamnese['codAtendimento'] = $codAtendimento;
						$anamnese['codCliente'] = $fields['codCliente'];
						$anamnese['codEspecialidade'] = $fields['codEspecialidade'];
						$anamnese['codEspecialista'] = $fields['codEspecialista'];
						$anamnese['queixaPrincipal'] = null;
						$anamnese['hda'] = $atendimento->HDA;
						$anamnese['exameFisico'] = $atendimento->EXAME_FISICO;
						$anamnese['hmp'] = $atendimento->HPP;
						$anamnese['historiaMedicamentos'] = null;
						$anamnese['historiaAlergias'] = null;
						$anamnese['outrasInformacoes'] = null;
						$anamnese['chv'] = null;
						$anamnese['parecer'] = null;
						$anamnese['codStatus'] = 1;
						$anamnese['dataCriacao'] = $atendimento->DT_REG;
						$anamnese['dataAtualizacao'] = $atendimento->DT_REG;
						$diagnostico['migrado'] = 1;

						if ($this->AtendimentoAnamneseModel->insert($anamnese)) {
						}




						//DIAGNISTICO/CID


						$cids = $this->RotinasModel->pegaCIDAtendimento($atendimento->CD_AMBULATORIO);



						if ($cids !== NULL) {
							foreach ($cids as $cid) {

								if ($cid->CD_CID !== NULL and $cid->CD_CID !== "" and $cid->CD_CID !== " ") {

									//PEGA CODCID

									$codCid = $this->RotinasModel->pegaCodCid($cid->CD_CID)->codCid;

									if ($codCid !== NULL) {
										//INSERIR DIAGNISTICO

										if ($cid->PRINCIPAL == 'S') {
											$codTipoDiagnostico = 1;
										} else {
											$codTipoDiagnostico = 2;
										}


										$diagnostico['codAtendimento'] = $codAtendimento;
										$diagnostico['codCid'] = $codCid;
										$diagnostico['codAutor'] = $codEspeciaista;
										$diagnostico['codTipoDiagnostico'] = $codTipoDiagnostico;
										$diagnostico['dataCriacao'] = $atendimento->DT_REG;
										$diagnostico['migrado'] = 1;

										if ($this->AtendimentoDiagnosticoModel->insert($diagnostico)) {
										}
									}
								}
							}
						}



						//INSERIR CONDUTA

						$condutaArray['codAtendimento'] = $codAtendimento;
						$condutaArray['dataInicio'] = $atendimento->DT_REG;
						$condutaArray['conteudoConduta'] = $atendimento->CONDUTA; //registro e examefis = onde??
						$condutaArray['codStatus'] = 1;
						$condutaArray['codAutor'] = $fields['codEspecialista'];
						$condutaArray['dataEncerramento'] = $atendimento->DT_REG;
						$condutaArray['dataCriacao'] = $atendimento->DT_REG;
						$condutaArray['dataAtualizacao'] = $atendimento->DT_REG;

						if ($atendimento->CONDUTA !== NULL and $atendimento->CONDUTA !== '') {
							if ($this->AtendimentosCondutasModel->insert($condutaArray)) {
							}
						}
					}
				} else {
					continue;
				}
			}
		}



		$response['success'] = true;
		$response['csrf_hash'] = csrf_hash();
		$response['messages'] = 'Atendimentos cadastrados com suceso';
		return $this->response->setJSON($response);
	}






	public function importarAgendasSIGH()
	{
		ini_set('max_execution_time', '0'); //300 seconds = 5 minutes
		set_time_limit(0);

		$response = array();

		$agendasConfig = $this->RotinasModel->agendasConfigSIGH();

		foreach ($agendasConfig as $config) {

			$fields = array();

			$especialidade = $this->RotinasModel->lookupCodEspecialidadeSIGH($config->CD_ESPECIALIDADE);

			if ($especialidade !== NULL) {
				$codEspecialidade = $especialidade->codEspecialidade;

				$fields['codOrganizacao'] = session()->codOrganizacao;
				$fields['codEspecialidade'] = $codEspecialidade;
				$fields['codEspecialista'] = $config->CD_USER_MED;
				$fields['codLocal'] = 0;
				$fields['dataInicio'] = date('Y-m-d');
				$fields['horaInicio'] = '07:00';
				$fields['dataEncerramento'] = date('Y-m-d');
				$fields['horaEncerramento'] = '16:00';
				$fields['tempoAtendimento'] = $config->DURA_CONS;
				$fields['intervaloAtendimento'] = 0;
				$fields['codStatusAgendamento'] = $config->ATIVA;
				$fields['codTipoAgendamento'] = 1;
				$fields['ordemAtendimento'] = 1;
				$fields['dataCriacao'] = $config->DT_REG;
				$fields['dataAtualizacao'] = $config->DT_REG;
				$fields['autor'] = $config->CD_USER_REG;

				$verificaExitenciaConfig = $this->RotinasModel->verificaExitenciaConfigSIGH($codEspecialidade, $config->DT_REG);

				if ($verificaExitenciaConfig == NULL) {
					if ($codConfig = $this->AgendamentosConfigModel->insert($fields)) {
					}
				}
			}
		}



		$agendas = $this->RotinasModel->agendasSIGH();


		foreach ($agendas as $agenda) {

			$data = array();

			$dataInicio = date('Y-m-d', strtotime($agenda->DT_AGENDA)) . ' ' . $agenda->HORARIO;
			$dataEncerramento = date(date('Y-m-d', strtotime($agenda->DT_AGENDA)) . ' ' . $agenda->HORARIO, strtotime("+" . $agenda->DURA_CONS . " minutes"));

			$especialidade = $this->RotinasModel->lookupCodEspecialidadeSIGH($agenda->CD_ESPECIALIDADE);

			$codEspecialidade = $especialidade->codEspecialidade;




			$verificaExistenciaAgendamento = $this->AgendamentosModel->verificaExistenciaAgendamentoSIGH($codEspecialidade, $agenda->CD_USER_MED, $dataInicio);



			if ($agenda->CD_SIT_AGENDA == 1) {
				$codStatus = 2;

				$data['chegou'] = 1;
				$data['confirmou'] = 1;
			}
			if ($agenda->CD_SIT_AGENDA == 2) {
				$codStatus = 1;
			}
			if ($agenda->CD_SIT_AGENDA == 3 or $agenda->CD_SIT_AGENDA == 4) {
				$codStatus = 3;
			}
			if ($agenda->CD_SIT_AGENDA == 0) {
				$codStatus = 0;
			}

			if ($agenda->CD_SIT_AGENDA == 7) {
				$codStatus = 2;
			}
			if ($agenda->CD_SIT_AGENDA == 6 or $agenda->CD_SIT_AGENDA == 5 or $agenda->CD_SIT_AGENDA == 8) {
				$codStatus = 4;
			}

			if ($verificaExistenciaAgendamento == NULL) {

				$data = array();
				$data['codConfig'] = 0;
				$data['codOrganizacao'] = session()->codOrganizacao;
				$data['codCliente'] = $agenda->CD_CLIENTE;
				$data['codEspecialista'] = $agenda->CD_USER_MED;
				$data['codEspecialidade'] = $codEspecialidade;
				$data['codStatus'] = $codStatus;
				$data['ordemAtendimento'] = 1;
				$data['dataInicio'] = $dataInicio;
				$data['dataEncerramento'] = $dataEncerramento;
				$data['codAutor'] = $agenda->CD_USER_REG;
				$data['dataCriacao'] = $agenda->DT_MARCACAO;
				$data['dataAtualizacao'] = $agenda->DT_MARCACAO;



				$this->AgendamentosModel->insert($data);
			} else {


				$data['dataAtualizacao'] = date('Y-m-d H:i');
				$data['protocolo'] = 1;
				$data['ordemAtendimento'] = 0;
				$data['chegou'] = 0;
				$data['confirmou'] = 0;
				$data['horaChegada'] = null;

				$data['codCliente'] = $agenda->CD_CLIENTE;
				$data['codEspecialista'] = $agenda->codEspecialista;
				$data['codEspecialidade'] = $codEspecialidade;
				$data['codStatus'] = $codStatus;
				$data['dataInicio'] = $dataInicio;
				$data['dataEncerramento'] = $dataEncerramento;
				$data['codAutor'] = $agenda->CD_USER_REG;
				$data['dataCriacao'] = $agenda->DT_MARCACAO;
				$data['dataAtualizacao'] = $agenda->DT_MARCACAO;

				$this->AgendamentosModel->update($verificaExistenciaAgendamento->codAgendamento, $data);
			}
		}


		$response['success'] = true;
		$response['csrf_hash'] = csrf_hash();
		$response['messages'] = 'Agendas importadas com sucesso';
		return $this->response->setJSON($response);
	}
	public function lookupEspecialistasApolo()
	{
		$colaboradores = $this->ColaboradoresModel->colaboradoresEvolucoes();
		$colaboradoresLocal = $this->ColaboradoresModel->pegaTudo();
		$colaboradoresLookup = $this->ColaboradoresModel->colaboradoresLookup();

		$arrayPrecsLookup = array();
		foreach ($colaboradoresLookup as $colaboradorLookup) {
			array_push($arrayPrecsLookup, $colaboradorLookup->prec);
		}

		$arrayPrecs = array();
		foreach ($colaboradoresLocal as $colaborador) {
			array_push($arrayPrecs, $colaborador->codBen);
		}



		foreach ($colaboradores as $colaborador) {
			$data = array();
			if (in_array($colaborador->prec_cp, $arrayPrecs)) {
				//confere se nome colaborador pertence

				$nome = explode(" ", $colaborador->nome);

				$nome = $nome[count($nome) - 1];

				$colaborador = $this->ColaboradoresModel->pegaPorCodBen($colaborador->prec_cp);
				if ($colaborador !== NULL) {


					$data['codColaborador'] = $colaborador->codColaborador;
					$data['conta'] = $colaborador->conta;
					$data['nomeCompleto'] = $colaborador->nomeCompleto;
					$data['dataNascimento'] = $colaborador->dataNascimento;
					$data['cpf'] = $colaborador->cpf;
					$data['prec'] = $colaborador->codBen;
					$data['datacriacao'] = date('Y-m-d H:i');
					if (!in_array($colaborador->codBen, $arrayPrecsLookup)) {
						$this->ColaboradoresModel->insereLookupColaboradores($data);
					}
				}
			} else {
				$dataApolo = array();
				$dataApolo['codColaborador'] = 0;
				$dataApolo['conta'] = $colaborador->nomeColaborador;
				$dataApolo['prec'] = $colaborador->prec_cp;
				$data['datacriacao'] = date('Y-m-d H:i');
				if (!in_array($colaborador->prec_cp, $arrayPrecsLookup)) {
					$this->ColaboradoresModel->insereLookupColaboradores($dataApolo);
				}
			}
		}

		$colaboradoresLookup = $this->ColaboradoresModel->colaboradoresLookup();

		$form = "";
		foreach ($colaboradoresLookup as $lookup) {
			if ($lookup->codColaborador == 0) {
				$form .= '

				<div class="row">
				<input type="hidden" id="codLookup" name="codLookup" value="' . $lookup->codLookup . '" class="form-control" >

					<div  class="col-md-4">
					' . $lookup->prec . ' - ' . $lookup->conta . '
					</div>
					<div class="col-md-4">
					<div class="form-group text-left">
							<select style="width:300px" id="colaborador' . trim($lookup->codLookup) . '" name="codColaborador' . trim($lookup->codLookup) . '" class="colaboradoresLocal">
							<option value="0"></option>
						</select>

					</div>
				</div>


				</div>

				';
			}
		}

		$response['success'] = true;
		$response['csrf_hash'] = csrf_hash();
		$response['form'] = $form;
		return $this->response->setJSON($response);
	}


	public function diferencaEsquema()
	{

		$response = array();

		$chave = $this->FederacoesModel->pegaChave(session()->codOrganizacao)->chaveSalgada;
		$tipo_cifra = 'des';
		$this->request->getPost('codFederacao') == 7;

		$federacao = $this->FederacoesModel->pegaPorCodigo(7);


		$servidor = $federacao->servidor;
		$login = $federacao->login;//https://codeigniter.com/user_guide/libraries/publisher.html
		$senha = $federacao->senha;
		$banco = $federacao->banco;



		$senha = descriptar($chave, $tipo_cifra, $senha); // print descriptar($chave, $tipo_cifra, 'dHZPcW84ZktwaytPOFBrTjBadk1QUT09OjqP+UO2YtpH7g==');

		$tabelasLocal = $this->RotinasModel->tabelasLocal();
		$tabelasRemota = $this->RotinasModel->tabelasRemota($servidor, $login, $senha, $banco);


		$arrayTabelasRemota = array();
		foreach ($tabelasRemota as $tabelaRemota) {
			array_push($arrayTabelasRemota, $tabelaRemota->TABLE_NAME);
		}

		$arrayTabelasLocal = array();
		foreach ($tabelasLocal as $tabelaLocal) {
			array_push($arrayTabelasLocal, $tabelaLocal->TABLE_NAME);
		}



		$texto = "";
		$texto .= "Tabelas Novas<br>";







		$texto .= "<hr>";
		$texto .= "NOVAS TABELAS";
		$texto .= '<br>';

		foreach ($arrayTabelasLocal as $tabelaLocal) {

			if (!in_array($tabelaLocal, $arrayTabelasRemota)) {
				$texto .= $tabelaLocal . "<br>";
			}
		}




		$texto .= "<hr>";
		$texto .= "ATRIBUTOS NOVOS";
		$texto .= '<br>';




		foreach ($tabelasLocal as $tabelaLocal) {

			if (in_array($tabelaLocal->TABLE_NAME, $arrayTabelasRemota)) {


				$atributosTabelasDev = $this->RotinasModel->atributosLocal($tabelaLocal->TABLE_NAME);


				foreach ($atributosTabelasDev as $atributosTabelaDev) {

					$atributosAmbDev = $atributosTabelaDev->TABLE_NAME;
					$atributosAmbDev .= $atributosTabelaDev->COLUMN_NAME;
					$atributosAmbDev .= $atributosTabelaDev->IS_NULLABLE;
					$atributosAmbDev .= $atributosTabelaDev->DATA_TYPE;

					$atributosTabelasProd = $this->RotinasModel->atributosRemotaPorTabela($atributosTabelaDev->TABLE_NAME, $atributosTabelaDev->COLUMN_NAME, $servidor, $login, $senha, $banco);

					foreach ($atributosTabelasProd as $atributosTabelaProd) {
						$atributosAmbProd = $atributosTabelaProd->TABLE_NAME;
						$atributosAmbProd .= $atributosTabelaProd->COLUMN_NAME;
						$atributosAmbProd .= $atributosTabelaProd->IS_NULLABLE;
						$atributosAmbProd .= $atributosTabelaProd->DATA_TYPE;
					}

					if ($atributosTabelaDev->COLUMN_DEFAULT == NULL) {
						$default = "";
					} else {
						$default = " DEFAULT " . $atributosTabelaDev->COLUMN_DEFAULT;
					}

					if ($atributosTabelaDev->IS_NULLABLE == 'YES') {
						$nulo = "NULL";
					} else {
						$nulo = "NOT NULL";
					}


					if ($atributosTabelasProd == NULL) {
						$texto .= "ALTER TABLE " . $tabelaLocal->TABLE_NAME . " ADD " . $atributosTabelaDev->COLUMN_NAME . " " . $atributosTabelaDev->COLUMN_TYPE . " " . $nulo . " " . $default . ";" . "<br>";
					} else {
					}
				}
			}
		}





		$texto .= "<hr>";
		$texto .= "ATRIBUTOS ALTERADOS";
		$texto .= '<br>';




		foreach ($tabelasLocal as $tabelaLocal) {

			if (in_array($tabelaLocal->TABLE_NAME, $arrayTabelasRemota)) {


				$atributosTabelasDev = $this->RotinasModel->atributosLocal($tabelaLocal->TABLE_NAME);


				foreach ($atributosTabelasDev as $atributosTabelaDev) {

					$atributosAmbDev = $atributosTabelaDev->TABLE_NAME;
					$atributosAmbDev .= $atributosTabelaDev->COLUMN_NAME;
					$atributosAmbDev .= $atributosTabelaDev->IS_NULLABLE;
					$atributosAmbDev .= $atributosTabelaDev->DATA_TYPE;
					$atributosAmbDev .= $atributosTabelaDev->CHARACTER_MAXIMUM_LENGTH;
					$atributosAmbDev .= $atributosTabelaDev->NUMERIC_PRECISION;
					$atributosAmbDev .= $atributosTabelaDev->DATETIME_PRECISION;
					$atributosAmbDev .= $atributosTabelaDev->COLUMN_KEY;
					$atributosAmbDev .= $atributosTabelaDev->EXTRA;

					$atributosTabelasProd = $this->RotinasModel->atributosRemotaPorTabela($atributosTabelaDev->TABLE_NAME, $atributosTabelaDev->COLUMN_NAME, $servidor, $login, $senha, $banco);

					foreach ($atributosTabelasProd as $atributosTabelaProd) {
						$atributosAmbProd = $atributosTabelaProd->TABLE_NAME;
						$atributosAmbProd .= $atributosTabelaProd->COLUMN_NAME;
						$atributosAmbProd .= $atributosTabelaProd->IS_NULLABLE;
						$atributosAmbProd .= $atributosTabelaProd->DATA_TYPE;
						$atributosAmbProd .= $atributosTabelaProd->CHARACTER_MAXIMUM_LENGTH;
						$atributosAmbProd .= $atributosTabelaProd->NUMERIC_PRECISION;
						$atributosAmbProd .= $atributosTabelaProd->DATETIME_PRECISION;
						$atributosAmbProd .= $atributosTabelaProd->COLUMN_KEY;
						$atributosAmbProd .= $atributosTabelaProd->EXTRA;
					}

					if ($atributosTabelaDev->COLUMN_DEFAULT == NULL) {
						$default = "";
					} else {
						$default = " DEFAULT " . $atributosTabelaDev->COLUMN_DEFAULT;
					}

					if ($atributosTabelaDev->IS_NULLABLE == 'YES') {
						$nulo = "NULL";
					} else {
						$nulo = "NOT NULL";
					}


					if ($atributosTabelasProd == NULL) {
					} else {

						if ($atributosAmbProd !== $atributosAmbDev) {
							$texto .= "ALTER TABLE " . $tabelaLocal->TABLE_NAME . "  CHANGE " . $atributosTabelaDev->COLUMN_NAME . " " . $atributosTabelaDev->COLUMN_NAME . " " . $atributosTabelaDev->COLUMN_TYPE . " " . $nulo . $default . ";" . "<br>";
						}
					}
				}
			}
		}





		$texto .= "<hr>";
		$texto .= "TABELAS REMOVIDAS";
		$texto .= "***** ATENÇÃO ****";
		$texto .= "CONFIRA E SÓ RODE EM PRODUÇÃO";
		$texto .= '<br>';

		foreach ($arrayTabelasRemota as $tabelaRemota) {

			if (!in_array($tabelaRemota, $arrayTabelasLocal)) {
				$texto .= $tabelaRemota . "<br>";
			}
		}



		$texto .= "<hr>";
		$texto .= "ATRIBUTOS REMOVIDOS";
		$texto .= "***** ATENÇÃO ****";
		$texto .= "CONFIRA E SÓ RODE EM PRODUÇÃO";
		$texto .= '<br>';




		foreach ($tabelasRemota as $tabelaRemota) {


			$atributosTabelasProd = $this->RotinasModel->atributosRemota($tabelaRemota->TABLE_NAME, $servidor, $login, $senha, $banco);


			foreach ($atributosTabelasProd as $atributosTabelaProd) {

				$atributosAmbProd = $atributosTabelaProd->TABLE_NAME;
				$atributosAmbProd .= $atributosTabelaProd->COLUMN_NAME;
				$atributosAmbProd .= $atributosTabelaProd->IS_NULLABLE;
				$atributosAmbProd .= $atributosTabelaProd->DATA_TYPE;

				$atributosTabelasDev = $this->RotinasModel->atributosLocalPorTabela($atributosTabelaProd->TABLE_NAME, $atributosTabelaProd->COLUMN_NAME);

				if (empty($atributosTabelasDev)) {
					$texto .= 'ALTER TABLE ' . $tabelaRemota->TABLE_NAME . ' DROP COLUMN ' . $atributosTabelaProd->COLUMN_NAME . "</br>";
				}
			}
		}



		$response['success'] = true;
		$response['csrf_hash'] = csrf_hash();
		$response['alteracoes'] = $texto;
		return $this->response->setJSON($response);
	}


	public function index()
	{


		$data = [
			'controller'    	=> 'rotinas',
			'title'     		=> 'Rotinas'
		];
		$data['organizacao'] = $this->OrganizacoesModel->select('codOrganizacao,descricao')->findAll();
		helper('form');
		return view('rotinas', $data);
	}
}
