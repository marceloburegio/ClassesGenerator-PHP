<?php
/**
 * Repositório Customizado
 * Esta classe estende a classe original
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:26:14
 */
class RepositorioAtributoBDRCustomizado extends RepositorioAtributoBDR {
	/**
	 * Método construtor da classe
	 *
	 * @access public
	 */
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Método que lista todos os objetos do Repositorio BDR por ClasseId
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param string $strComplemento=""
	 * @param array $arrParam=array()
	 * @return array
	 */
	public function listarPorClasseId($intClasseId, $strComplemento="", $arrParam=array()) {
		$intClasseId = (int) $intClasseId;
		$arrParam[":intclasseid"] = $intClasseId;
		return $this->listar("AND classeId = :intclasseid $strComplemento", $arrParam);
	}
	
	/**
	 * Método que lista todos os objetos do Repositorio BDR por ClasseId Ordenado
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param string $strComplemento=""
	 * @param array $arrParam=array()
	 * @return array
	 */
	public function listarPorClasseIdOrdenado($intClasseId, $strComplemento="", $arrParam=array()) {
		$intClasseId = (int) $intClasseId;
		return $this->listarPorClasseId($intClasseId, "$strComplemento ORDER BY ordem ASC", $arrParam);
	}
}
