<?php
/**
 * Repositório Customizado
 * Esta classe estende a classe original
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:26:14
 */
class RepositorioClasseBDRCustomizado extends RepositorioClasseBDR {
	/**
	 * Método construtor da classe
	 *
	 * @access public
	 */
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Método que lista todos os objetos do Repositorio BDR por SistemaId
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @param string $strComplemento=""
	 * @param array $arrParam=array()
	 * @return array
	 */
	public function listarPorSistemaId($intSistemaId, $strComplemento="", $arrParam=array()) {
		$intSistemaId = (int) $intSistemaId;
		$arrParam[":intsistemaid"] = $intSistemaId;
		return $this->listar("AND sistemaId = :intsistemaid $strComplemento", $arrParam);
	}
	
	/**
	 * Método que lista todos os objetos do Repositorio BDR por SistemaId e por Subpacote
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @param string $strSubpacote
	 * @param string $strComplemento=""
	 * @param array $arrParam=array()
	 * @return array
	 */
	public function listarPorSistemaIdPorSubpacote($intSistemaId, $strSubpacote, $strComplemento="", $arrParam=array()) {
		$intSistemaId = (int) $intSistemaId;
		$strSubpacote = (string) $strSubpacote;
		$arrParam[":strsubpacote"] = $strSubpacote;
		return $this->listarPorSistemaId($intSistemaId, "AND subpacote = :strsubpacote $strComplemento", $arrParam);
	}
	
}
