<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models;

use CodeIgniter\Model;

class OrganizacoesModel extends Model
{

	protected $table = 'organizacoes';
	protected $primaryKey = 'codOrganizacao';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['descricao'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;




	function listaDropDownOrganizacoes()
	{
		$query = $this->db->query('select codOrganizacao as id, descricao as text from organizacoes order by descricao asc');
		return $query->getResult();
	}

	public function pegaTimezoneOrganizacao($codOrganizacao)
	{
		$query = $this->db->query('select tz.codTimezone,tz.nome from timezone tz join organizacoes o on o.codTimezone=tz.codTimezone where o.codOrganizacao = ' . $codOrganizacao);
		return $query->getRow();
	}

	public function pegaDadosBasicosOrganizacao()
	{


		$query = $this->db->query('select *
		from organizacoes o
		left join estadosfederacao ef on ef.codEstadoFederacao=o.codEstadoFederacao
		');
		return $query->getRow();
	}

	public function pegaOrganizacao($codOrganizacao = null)
	{
		$codOrganizacao = session()->codOrganizacao;

		$query = $this->db->query('select * from organizacoes o
		left join estadosfederacao e on o.codEstadoFederacao = e.codEstadoFederacao
		where o.codOrganizacao = ' . $codOrganizacao);
		return $query->getRow();
	}
}
