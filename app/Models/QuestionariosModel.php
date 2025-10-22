<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models;
use CodeIgniter\Model;

class QuestionariosModel extends Model {
    
	protected $table = 'questionarios';
	protected $primaryKey = 'codQuestionario';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['titulo', 'resumo', 'codOrganizacao', 'dataCriacao', 'dataAtualizacao', 'dataInicio', 'dataEncerramento', 'termoAceite', 'instrucoes', 'codAutor', 'ativo', 'codVisibilidade'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'dataAtualizacao';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    
	

	
	public function pegaTudo()
	{
		$query = $this->db->query('select * from questionarios');
        return $query->getResult();
	}

		
	public function pegaPorCodigo($codQuestionario = NULL)
	{
		$query = $this->db->query('select * from questionarios where codQuestionario="'.$codQuestionario.'"');
        return $query->getRow();
	}


}