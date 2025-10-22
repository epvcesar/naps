<?php
// Desenvolvido por Emanuel Peixoto Vicente

namespace App\Models;

use CodeIgniter\Model;

class PortalOrganizacaoModel extends Model
{

	protected $table = 'portalorganizacao';
	protected $primaryKey = 'codPortal';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['convenioAlternativo', 'textoConvenioAlternativo', 'convenioAlternativo', 'imagemSobre', 'ativoSobre', 'sobreTexto', 'heroTexto', 'ativoHero', 'dataAtualizacao', 'codAutor', 'codOrganizacao', 'corFundoPrincipal', 'corTextoPrincipal', 'corLinhaTabela', 'corTextoTabela', 'corSecundaria', 'corMenus', 'corTextoMenus', 'corBackgroundMenus'];
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
		$query = $this->db->query('select * from portalorganizacao');
		return $query->getResult();
	}

	public function dadosPortal()
	{
		$codOrganizacao = session()->codOrganizacao;
		$query = $this->db->query('select * from portalorganizacao where codOrganizacao=' . $codOrganizacao);
		return $query->getRow();
	}
	public function pegaPorCodigo($codOrganizacao)
	{
		$query = $this->db->query('select * from ' . $this->table . ' where codOrganizacao = "' . $codOrganizacao . '"');
		return $query->getRow();
	}

	public function multiSiteLoginAtivado()
	{

		$codOrganizacao = session()->codOrganizacao;

		if (session()->codUnidadeGlobal !== NULL) {
			$codUnidadeGlobal = session()->codUnidadeGlobal;
		}else{
			$codUnidadeGlobal=1;
		}
		$query = $this->db->query('select * from organizacoes  where codOrganizacao="' . $codOrganizacao . '" and codTipoOrganizacao > 1 and codTipoMultisite > 1 and multiSiteLoginAtivado=1');
		$organizacao = $query->getRow();

		$html = '';
		if ($organizacao !== NULL) {
			$query2 = $this->db->query('select * from unidades  where codOrganizacao="' . $codOrganizacao . '" and ativo=1 and codTipoUnidade=3');
			$unidades = $query2->getResult();
			$html .= '<select class="form-control" style="background:#FFF" style="margin-bottom:10px" id="codUnidadeGlobal" name="codUnidadeGlobal" required>';
			if ($unidades !== NULL) {
				$html .= '<option value="">Selecione uma Unidade</option>';

				foreach ($unidades as $key => $unidade) {
					$selected = '';
					if ($codUnidadeGlobal !== NULL) {
						if ($unidade->codUnidade == $codUnidadeGlobal) {
							$selected = 'selected';
						}
					}
					$html .= '<option value="' . $unidade->codUnidade . '" ' . $selected . '>' . $unidade->descricaoUnidade . '</option>';
				}
			}

			$html .= '</select>';


			return $html;
		}

		return $html;
	}
}
