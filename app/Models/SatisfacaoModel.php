<?php

namespace App\Models;

use CodeIgniter\Model;

class SatisfacaoModel extends Model
{
	protected $table = 'satisfacao';
	protected $primaryKey = 'codPesquisa';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['codOrganizacao', 'codMeio', 'data', 'email', 'servico', 'atendimento', 'qualidade', 'tempo', 'instalacoes', 'qualidadePresencial', 'sugestao'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    
	




    function pegaTudo(){
        $query = $this->db->query('select * from satisfacao');
        return $query->getResult();
    }


    function listaDropDownOrganizacoes(){
        $query = $this->db->query('select codOrganizacao as id, descricao as text from organizacoes order by descricao asc');
        return $query->getResult();
    }

    function listaDropDownMeios(){
        $query = $this->db->query('select codMeio as id, descricaoMeio as text from meios');
        return $query->getResult();
    }

}

