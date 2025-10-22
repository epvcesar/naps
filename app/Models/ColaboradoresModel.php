<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models;
use CodeIgniter\Model;

class ColaboradoresModel extends Model {
    
	protected $table = 'colaboradores';
	protected $primaryKey = 'codColaborador';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['codClasse', 'codPerfilPadrao', 'codOrganizacao', 'ordenacao', 'pai', 'conta', 'codFuncao', 'codCargo', 'dn', 'nomeExibicao', 'nomeCompleto', 'nomePrincipal', 'identidade', 'cpf', 'emailFuncional', 'emailPessoal', 'codEspecialidade', 'telefoneTrabalho', 'celular', 'endereco', 'aceiteTermos', 'hashTcms', 'senha', 'dataSenha', 'historicoSenhas', 'ativo', 'ipRequisitante', 'notificado', 'dataCriacao', 'dataAtualizacao', 'dataInicioEmpresa', 'dataNascimento', 'codDepartamento', 'nrEndereco', 'codMunicipioFederacao', 'reservadoSimNao', 'reservadoTexto100', 'reservadoNumero', 'cep', 'fotoPerfil', 'informacoesComplementares', 'senhaResincLDAP', 'codMotivoInativo'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    

	public function contas()
	{
		$query = $this->db->query('select conta from colaboradores p left join departamentos d on d.codDepartamento=p.codDepartamento  where p.conta not in ("admin", "administrator", "administrador", "sisadmin", "root","", "null", "monitor glpi", "rootrepl rep", "rootrepl", "ldaper","admin_sped","adminss") order by p.codCargo asc');

		return $query->getResult();
	}

	public function organizacaoColaborador($codColaborador)
	{
		$query = $this->db->query('select * from organizacoes o left join colaboradores p on p.codOrganizacao=o.codOrganizacao where p.codColaborador = "' . $codColaborador . '" order by p.codCargo asc');
		return $query->getRow();
	}

	
	public function listaDropDownColaboradores()
	{
		$query = $this->db->query('
		select p.codColaborador as id, concat(p.nomeExibicao," - ",p.nomeCompleto) as text from colaboradores p where p.ativo=1 and p.nomeExibicao is not null  and p.nomeCompleto is not null  order by p.codCargo asc');
		return $query->getResult();
	}

	public function pegaColaboradorPorLogin($login)
	{
		
		$query = $this->db->query('select * from colaboradores c
		where c.ativo=1 
		and c.conta = "' . $login . '"  order by c.codCargo asc');
		return $query->getRow();
	}

	public function pegaTudo()
	{
		$query = $this->db->query('select c.*, o.siglaOrganizacao from colaboradores c 
		join organizacoes o on o.codOrganizacao=c.codOrganizacao 
		order by c.nomeExibicao asc');
		return $query->getResult();
	}

	public function emailPessoal()
	{
		$query = $this->db->query('select emailPessoal from colaboradores p left join departamentos d on d.codDepartamento=p.codDepartamento  where p.conta not in ("admin", "administrator", "administrador", "sisadmin", "root","", "null", "monitor glpi", "rootrepl rep", "rootrepl", "ldaper","admin_sped","adminss") order by p.codCargo asc');

		return $query->getResult();
	}


	public function aniversariantesHoje()
	{
		$query = $this->db->query('select * from colaboradores p 
		where p.ativo=1 and DATE_FORMAT(p.dataNascimento, "%m-%d")=DATE_FORMAT(NOW(), "%m-%d")  order by p.codCargo asc');
		return $query->getResult();
	}

	
}