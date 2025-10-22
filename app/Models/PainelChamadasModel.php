<?php
// Licença GNU GPL

namespace App\Models;

use CodeIgniter\Model;

class painelChamadasModel extends Model
{

	protected $table = 'chamadasfila';
	protected $primaryKey = 'codChamada';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['codExameLista', 'codEspecialidade', 'codClasseRisco', 'codOrganizacao', 'localAssistencia', 'dataChamada', 'codChamador', 'qtdChamadas', 'codPaciente'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;

	public function listaDropDownEspecialidades()
	{
		$query = $this->db->query('select codEspecialidade as id,descricaoEspecialidade as text from eb_especialidades order by descricaoEspecialidade');
		return $query->getResult();
	}

	public function pegaTudo()
	{
		$query = $this->db->query('select * from eb_chamadasfila');
		return $query->getRow();
	}

	public function pacientesChamados()
	{
		$query = $this->db->query('select e.especialidade,cf.*,c.nomeExibicao as especialista,pa.nomeCompleto as nomeCompleto,TIMESTAMPDIFF(MINUTE, cf.dataChamada,NOW()) as ultimaChamada  
		FROM chamadasfila cf
		left join colaboradores c on cf.codChamador = c.codColaborador
		left join pacientes pa on cf.codPaciente = pa.codPaciente
		left join especialidades e on cf.codEspecialidade = e.codEspecialidade
		group by c.nomeExibicao ,pa.nomeCompleto,cf.localAssistencia
		order by cf.qtdChamadas desc,cf.codChamada asc  limit 1');


		return $query->getRow();
	}




	public function marcados()
	{
		$query = $this->db->query('select a.*, e.especialidade, p.nomeCompleto from atendimentos a
		join especialidades e on a.codEspecialidade = e.codEspecialidade
		join pacientes p on a.codPaciente = p.codPaciente
		where a.dataCriacao >= CURDATE() and a.codStatus = 1');


		return $query->getResult();
	}

	public function pacientesUltimasChamadas()
	{

		$query = $this->db->query('select e.especialidade, c.nomeExibicao as especialista,pa.nomeCompleto as nomePaciente,cf.localAssistencia,count(*) as Nrchamadas 
		FROM chamadasfila cf
		left join colaboradores c on cf.codChamador = c.codColaborador
		left join pacientes pa on cf.codPaciente = pa.codPaciente
		left join especialidades e on cf.codEspecialidade = e.codEspecialidade
		group by c.nomeExibicao ,pa.nomeCompleto,cf.localAssistencia
		order by cf.dataChamada desc limit 10');
		return $query->getResult();
	}

	public function pacientesUltimasChamadasOdonto($especialidades = null)
	{

		$configuracao = config('App');
		session()->set('codOrganizacao', $configuracao->codOrganizacao);
		$codOrganizacao = $configuracao->codOrganizacao;

		$query = $this->db->query('select pe.nomeExibicao as especialista,pa.nomeExibicao as nomePaciente,TIMESTAMPDIFF(YEAR, pa.dataNascimento,CURDATE()) as idade,cf.localAssistencia,count(*) as Nrchamadas 
		FROM eb_chamadasfila cf
		join eb_pessoas pe on cf.codChamador = pe.codPessoa
		join eb_pacientes pa on cf.codPaciente = pa.codPaciente
		where cf.codEspecialidade in (' . $especialidades . ') or cf.codExameLista in(34)
		group by pe.nomeExibicao,pa.nomeExibicao,cf.localAssistencia,pa.dataNascimento 
		order by cf.dataChamada desc limit 10');
		return $query->getResult();
	}
}
