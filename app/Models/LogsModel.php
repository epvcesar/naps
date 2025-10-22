<?php
// Licença GNU GPL

namespace App\Models;

use CodeIgniter\Model;

class LogsModel extends Model
{

	protected $table = 'logs';
	protected $primaryKey = 'codLog';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['codOrganizacao', 'ocorrrencia', 'codColaborador', 'dataCriacao'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;


	public function pega_logs()
	{
		$query = $this->db->query('select * from ' . $this->table);
		return $query->getRow();
	}



	public function inserirLog($ocorrencia, $codColaborador)
	{
		if ($codColaborador == NULL) {
			$codColaborador = 0;
		}

		
		//pega IP
		$request = \Config\Services::request();
		$ip = $request->getIPAddress();
		$codOrganizacao = session()->codOrganizacao;
		

		if (session()->timezone == NULL) {
			$timezone = 'America/Sao_Paulo';
		}else{
			$timezone = session()->timezone;
			session()->timezone = 'America/Sao_Paulo';
		}

		date_default_timezone_set($timezone);




		$query = $this->db->query('insert into ' . $this->table . '(codOrganizacao,ocorrencia,codColaborador,dataCriacao,ip) values ("' . $codOrganizacao . '","' . $ocorrencia . '","' . $codColaborador . '","' . date('Y-m-d H:i') . '","' . $ip . '")');
	}



	public function inserirLogPaciente($ocorrencia, $codPaciente)
	{
		if ($codPaciente == NULL) {
			$codPaciente = 0;
		}

		$codOrganizacao = session()->codOrganizacao;
		$timezone = session()->timezone;
		date_default_timezone_set($timezone);


		//pega IP
		$request = \Config\Services::request();
		$ip = $request->getIPAddress();

		$query = $this->db->query('insert into logspacientes(codOrganizacao, ocorrencia, codPaciente, dataCriacao, ip) values (' . $codOrganizacao . ',"' . $ocorrencia . '",' . $codPaciente . ',"' . date('Y-m-d H:i') . '","' . $ip . '")');
	}


	
	public function inserirPesquisaVagas($codPaciente, $codEspecialidade)
	{
		if ($codPaciente == NULL) {
			$codPaciente = 0;
		}

		$codOrganizacao = session()->codOrganizacao;
		$timezone = session()->timezone;
		date_default_timezone_set($timezone);


		//pega IP
		$request = \Config\Services::request();
		$ip = $request->getIPAddress();

		$query = $this->db->query('insert into pesquisavagas(codPaciente,codEspecialidade,dataPesquisa) values (' . $codPaciente . ',"' . $codEspecialidade . '","' . date('Y-m-d H:i') . '")');
	}


	public function inserirLogLDAP($conexao = null, $dados = null, $codServidorLDAP = NULL, $tipoLogLDAP = NULL, $dn = null, $ocorrencia = null)
	{
		//$tipoLogLDAP ERROR =0, SUCESSO =1

		$codColaborador = session()->codColaborador;
		if ($codColaborador == NULL) {
			$codColaborador = 0;
		}



		$timezone = session()->timezone;
		if ($timezone == NULL) {
			$timezone = 'America/Sao_Paulo';
		}
		date_default_timezone_set($timezone);
		$dataHora = date('Y-m-d H:i:s');
		$saidaConexao = @ldap_error($conexao);
		if ($saidaConexao !== 'Success') {
			$erro = " - " . $saidaConexao;
		} else {
			$erro = "";
		}
		@ldap_get_option($conexao, LDAP_OPT_DIAGNOSTIC_MESSAGE, $erroDetalheado);
		$atributosTentados = str_replace(array("{", "}", "'\'", "[", "]", '"'), "", json_encode($dados));
		$mensagemCompleta = $ocorrencia . $erro . ' - ' . $erroDetalheado . ' - ' . $dn . $atributosTentados;


		//pega IP
		$request = \Config\Services::request();
		$ip = $request->getIPAddress();


		$query = $this->db->query('insert into logsldap(codOrganizacao,codServidorLDAP,codColaborador,tipoLogLDAP,dataCriacao,ip,ocorrencia) values (' . $codOrganizacao . ',' . $codServidorLDAP . ',' . $codColaborador . ',' . $tipoLogLDAP . ',"' . $dataHora . '","' . $ip . '","' . $mensagemCompleta . '")');
	}
}
