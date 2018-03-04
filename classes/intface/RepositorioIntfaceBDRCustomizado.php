<?php
/**
 * Repositório Customizado
 * Esta classe estende a classe original
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:26:14
 */
class RepositorioIntfaceBDRCustomizado extends RepositorioIntfaceBDR {
	/**
	 * Método construtor da classe
	 *
	 * @access public
	 */
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Método que lista todos os objetos do Repositorio BDR
	 *
	 * @access public
	 * @param string $strComplemento=""
	 * @param array $arrParam=array()
	 * @throws RepositorioException
	 * @return array
	 */
	public function listar($strComplemento="", $arrParam=array()) {
		$strSql = "
			SELECT
				classeId,
				intfaceId,
				(SELECT nome FROM classes WHERE classes.classeId = intfaces.intfaceId) AS nome
			FROM intfaces
			WHERE classeId IS NOT NULL
			AND intfaceId IS NOT NULL
			$strComplemento";
		try {
			$objPDOStm = $this->objPDO->prepare($strSql);
			$objPDOStm->execute($arrParam);
			$arrResults = $objPDOStm->fetchAll(PDO::FETCH_ASSOC);
			$arrObjIntface = array();
			if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $arrResult) {
					$arrObjIntface[] = new Intface($arrResult["classeId"], $arrResult["intfaceId"], $arrResult["nome"]);
				}
			}
			return $arrObjIntface;
		}
		catch(PDOException $ex) {
			throw new RepositorioException($ex->getMessage());
		}
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
}
