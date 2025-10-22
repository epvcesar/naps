<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models;
use CodeIgniter\Model;

class PacientesModel extends Model {
    
	protected $table = 'pacientes';
	protected $primaryKey = 'codPaciente';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['codOrganizacao','nomeCompleto', 'cpf', 'preccp', 'postoGraduacao'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'dataAtualizacao';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    
	

	
	public function pegaTudo()
	{
		$query = $this->db->query('
		select * from pacientes p
		join cargos c on p.postoGraduacao = c.codCargo');
        return $query->getResult();
	}

	public function listaDropDownPostoGraduacao()
	{
		$query = $this->db->query('select codCargo as id, siglaCargo as text from cargos');
        return $query->getResult();
	}
		
	public function listaDropDownPacientes()
	{
		// Remove pontos e traços do CPF para exibição.
		// Usamos REPLACE aninhado para compatibilidade com MySQL < 8.
		// Se estiver usando MySQL 8+, pode preferir: REGEXP_REPLACE(cpf, '[^0-9]', '')
		$query = $this->db->query("select codPaciente as id, concat(nomeCompleto, ' | CPF: ', REPLACE(REPLACE(cpf, '.', ''), '-', ''), ' | Prec-CP:', preccp) as text from pacientes");
        return $query->getResult();
	}
	public function pegaPorCodigo($codPaciente = NULL)
	{
		$query = $this->db->query('select * from pacientes where codPaciente="'.$codPaciente.'"');
        return $query->getRow();
	}

		public function verificaCPF($cpf = NULL)
	{
		$query = $this->db->query('select * from pacientes where cpf="'.$cpf.'"');
        return $query->getRow();
	}
		public function verificaPreccp($preccp = NULL)
	{
		$query = $this->db->query('select * from pacientes where preccp="'.$preccp.'"');
        return $query->getRow();
	}


}