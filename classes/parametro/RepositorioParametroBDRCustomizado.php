<?php
/**
 * Repositório Customizado
 * Esta classe estende a classe original
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:26:14
 */
class RepositorioParametroBDRCustomizado extends RepositorioParametroBDR {
	/**
	 * Método construtor da classe
	 *
	 * @access public
	 */
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Método que lista todos os objetos do Repositorio BDR por MetodoId
	 *
	 * @access public
	 * @param int $intMetodoId
	 * @param string $strComplemento=""
	 * @param array $arrParam=array()
	 * @return array
	 */
	public function listarPorMetodoId($intMetodoId, $strComplemento="", $arrParam=array()) {
		$intMetodoId = (int) $intMetodoId;
		$arrParam[":intmetodoid"] = $intMetodoId;
		return $this->listar("AND metodoId = :intmetodoid $strComplemento", $arrParam);
	}
	
	/**
	 * Método que lista todos os objetos do Repositorio BDR por MetodoId Ordenado
	 *
	 * @access public
	 * @param int $intMetodoId
	 * @param string $strComplemento=""
	 * @param array $arrParam=array()
	 * @return array
	 */
	public function listarPorMetodoIdOrdenado($intMetodoId, $strComplemento="", $arrParam=array()) {
		$intMetodoId = (int) $intMetodoId;
		return $this->listarPorMetodoId($intMetodoId, "$strComplemento ORDER BY ordem ASC", $arrParam);
	}
}
