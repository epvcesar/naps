<?php
// Desenvolvido por CDS Saúde Sistemas

namespace App\Models;

use CodeIgniter\Model;

class PerfilColaboradoresMembroModel extends Model
{

	protected $table = 'perfiscolaboradoresmembro';
	protected $primaryKey = 'codColaboradorMembro';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['codColaborador', 'codPerfil', 'dataInicio', 'dataEncerramento', 'dataCriacao', 'dataAtualizacao'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;


	public function pegaTudo()
	{

		$codOrganizacao = session()->codOrganizacao;
		$query = $this->db->query('select ppm.*, p.nomeExibicao from perfiscolaboradoresmembro as ppm 
		join colaboradores p on p.codColaborador = ppm.codColaborador
		where p.codOrganizacao = ' . $codOrganizacao);
		return $query->getResult();
	}

	public function pegaPorCodigo($codColaboradorMembro)
	{
		$query = $this->db->query('select * from ' . $this->table . ' where codColaboradorMembro = "' . $codColaboradorMembro . '"');
		return $query->getRow();
	}
	public function pegaPorCodigoPerfil($codPerfil = NULL)
	{
		$codOrganizacao = session()->codOrganizacao;
		$query = $this->db->query('select ppm.*, p.nomeExibicao 
		from perfiscolaboradoresmembro as ppm 
		join colaboradores p on p.codColaborador = ppm.codColaborador
		where ppm.codPerfil="' . $codPerfil . '" order by p.codCargo asc, ppm.dataEncerramento desc,ppm.dataInicio asc');
		return $query->getResult();
	}

	public function pegaMeusPerfisValidos($codColaborador = null)
	{
		if ($codColaborador !== null) {
			$codOrganizacao = session()->codOrganizacao;
			$query = $this->db->query('select ppm.codPerfil, p.perguntarLocalAtendimento, p.descricao,ppm.dataEncerramento 
			from perfiscolaboradoresmembro as ppm 
		join perfis p on p.codPerfil = ppm.codPerfil
		where p.codOrganizacao = "' . $codOrganizacao . '" and ppm.codColaborador="' . $codColaborador . '" and (ppm.dataEncerramento is null  or ppm.dataEncerramento >= CURDATE()) order by ppm.dataEncerramento desc,ppm.dataInicio asc');
			return $query->getResult();
		} else {
			return array();
		}
	}

	public function pegaMeusPerfisValidosClientes()
	{
		$codOrganizacao = session()->codOrganizacao;
		$query = $this->db->query('select p.codPerfil, p.perguntarLocalAtendimento, p.descricao, "2050-01-01" as dataEncerramento 
			from perfis p where p.codPerfil in (9)');
		return $query->getResult();
	}

	public function pegaMeusPerfis($codColaborador)
	{
		$query = $this->db->query('select ppm.codPerfil, p.perguntarLocalAtendimento,p.descricao,ppm.dataEncerramento 
		from perfiscolaboradoresmembro as ppm 
		join perfis p on p.codPerfil = ppm.codPerfil
		where ppm.codColaborador="' . $codColaborador . '" order by ppm.dataEncerramento desc,ppm.dataInicio asc');
		return $query->getResult();
	}

	public function pegaMeusPerfisClientes()
	{
		$codOrganizacao = session()->codOrganizacao;
		$query = $this->db->query('select p.codPerfil,p.perguntarLocalAtendimento, p.descricao, "2050-01-01" as dataEncerramento 
		from perfis p where p.codPerfil in( 9)');
		return $query->getResult();
	}

	public function pegaMinhasPermissoesModulos($codColaborador, $codPerfil)
	{
		$codOrganizacao = session()->codOrganizacao;
		$query = $this->db->query('select ppm.codPerfil,pm.listar,pm.adicionar,pm.editar,pm.deletar,m.nome,m.link 
		FROM perfismodulos pm 
		join perfiscolaboradoresmembro ppm on ppm.codPerfil=pm.codPerfil 
		join modulos m on m.codModulo=pm.codModulo 
		where ppm.codPerfil="' . $codPerfil . '" and ppm.codColaborador=' . $codColaborador);
		return $query->getResult();
	}

	public function pegaMinhasPermissoesModulosClientes()
	{
		$codOrganizacao = session()->codOrganizacao;
		$query = $this->db->query('select pm.codPerfil,pm.listar,pm.adicionar,pm.editar,pm.deletar,m.nome,m.link 
		FROM perfismodulos pm 
		join modulos m on m.codModulo=pm.codModulo 
		where pm.codPerfil in(9)');
		return $query->getResult();
	}
}
