<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models;

use CodeIgniter\Model;

class AtendimentosModel extends Model
{

	protected $table = 'atendimentos';
	protected $primaryKey = 'codAtendimento';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['seq', 'senha', 'codEspecialidade', 'codOrganizacao', 'codPaciente', 'dataCriacao', 'dataAtualizacao', 'codStatus'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'dataAtualizacao';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;



	public function pegaTudo()
	{
		$query = $this->db->query('select a.*, p.nomeCompleto, e.especialidade from 
		atendimentos a
		join pacientes p on a.codPaciente = p.codPaciente
		join especialidades e on a.codEspecialidade = e.codEspecialidade');
		return $query->getResult();
	}

	public function lookupCodNomeEspecialidadesJson($especialidades)
	{
		$query = $this->db->query('select * from especialidades where codEspecialidade in (' . $especialidades . ')');
		return $query->getResult();
	}



	public function atendimentosDia($dataFiltro = NULL, $codEspecialidadeFiltro = NULL)
	{

		$filtro = '';

		if ($dataFiltro != NULL) {
			$filtro .= ' and DATE(a.dataCriacao) = "' . $dataFiltro . '" ';
		}
		if ($codEspecialidadeFiltro > 0) {
			$filtro .= ' and a.codEspecialidade = "' . $codEspecialidadeFiltro . '" ';
		}

		$query = $this->db->query(
			'select a.*, s.*,p.nomeCompleto, e.especialidade from 
		atendimentos a
		join pacientes p on a.codPaciente = p.codPaciente
		join especialidades e on a.codEspecialidade = e.codEspecialidade
		join atendimentostatus s on a.codStatus = s.codStatus
		where 1=1 ' . $filtro . ' order by a.dataCriacao desc, a.seq desc'
		);
		return $query->getResult();
	}


	public function pegaPorCodigo($codAtendimento = NULL)
	{
		$query = $this->db->query('select a.*, p.nomeCompleto, e.especialidade from atendimentos a
		left join pacientes p on a.codPaciente = p.codPaciente
		left join especialidades e on a.codEspecialidade = e.codEspecialidade
		where a.codAtendimento="' . $codAtendimento . '"');
		return $query->getRow();
	}

	public function totalPorEspecialidade($codEspecialidade = NULL)
	{
		$query = $this->db->query('select count(*) as total from atendimentos where dataCriacao >= CURDATE() and codEspecialidade="' . $codEspecialidade . '"');
		return $query->getRow()->total;
	}


	public function siglaEspecialidade($codEspecialidade = NULL)
	{
		$query = $this->db->query('select * from especialidades where codEspecialidade="' . $codEspecialidade . '"');
		return $query->getRow();
	}


	public function listaDropDownEspecialidades()
	{
		$query = $this->db->query('select codEspecialidade as id, especialidade as text from especialidades');
		return $query->getResult();
	}
}
