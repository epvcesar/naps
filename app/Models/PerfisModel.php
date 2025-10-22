<?php
// Desenvolvido por CDS Saúde Sistemas

namespace App\Models;

use CodeIgniter\Model;

class PerfisModel extends Model
{

	protected $table = 'perfis';
	protected $primaryKey = 'codPerfil';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['perguntarLocalAtendimento','descricao', 'codOrganizacao', 'dataCriacao', 'dataAtualizacao'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;


	public function pega_todasPerfis()
	{
		$codOrganizacao = session()->codOrganizacao;
		$query = $this->db->query('select f.codPerfil, f.descricao as descricao_perfil, o.descricao as siglaOrganizacao 
		from perfis f join organizacoes o on o.codOrganizacao = f.codOrganizacao');
		return $query->getResult();
	}

	public function listaDropDownPerfis()
	{
		$codOrganizacao = session()->codOrganizacao;
		$query = $this->db->query('select codPerfil as id, descricao as text
		from perfis where descricao is not null');
		return $query->getResult();
	}
	public function listaDropDownPerfisPermitidos($codColaborador = NULL)
	{
		$codOrganizacao = session()->codOrganizacao;
		$query = $this->db->query('select p.codPerfil as id, p.descricao as text
		from perfiscolaboradoresmembro pm 
		left join perfis p on pm.codPerfil = p.codPerfil 
		where pm.codColaborador ="' . $codColaborador . '"');
		return $query->getResult();
	}

	public function getAllPerfisSame()
	{
		$codOrganizacao = session()->codOrganizacao;
		$query = $this->db->query('select f.codPerfil, f.descricao as descricao_perfil, o.descricao as siglaOrganizacao 
		from perfis f join organizacoes o on o.codOrganizacao = f.codOrganizacao where o.codOrganizacao =' . $codOrganizacao . ' and f.descricao like "%same%"');
		return $query->getResult();
	}
	public function getPerfisColaborador($codColaborador)
	{
		$codOrganizacao = session()->codOrganizacao;
		$query = $this->db->query('select pm.codColaboradorMembro,f.codPerfil, f.descricao as descricao_perfil
		from perfiscolaboradoresmembro pm 
		left join perfis f on pm.codPerfil = f.codPerfil 
		where pm.codColaborador ="' . $codColaborador . '"');
		return $query->getResult();
	}
}
