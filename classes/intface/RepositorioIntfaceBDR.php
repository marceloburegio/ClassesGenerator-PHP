<?php
/**
 * Repositório de objetos Intface
 * Esta classe implementa a interface IRepositorioIntface
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:27:19
 */
class RepositorioIntfaceBDR implements IRepositorioIntface {
	/**
	 * Objeto da conexão
	 *
	 * @access protected
	 * @var ConexaoIntface
	 */
	protected $objConexaoIntface;
	
	/**
	 * Objeto PDO
	 *
	 * @access protected
	 * @var PDO
	 */
	protected $objPDO;
	
	/**
	 * Método construtor da classe
	 *
	 * @access public
	 */
	public function __construct() {
		$this->objConexaoIntface = ConexaoBDR::getInstancia("sistema");
		$this->objPDO = $this->objConexaoIntface->getConexao();
	}
	
	/**
	 * Método que insere um objeto no Repositorio BDR
	 *
	 * @access public
	 * @param Intface $objIntface
	 * @throws IntfaceNaoCadastradoException
	 * @throws RepositorioException
	 * @return int
	 */
	public function inserir(Intface $objIntface) {
		if ($objIntface != null) {
			$strSql = "
				INSERT INTO intfaces (
					classeId,
					intfaceId
				)
				VALUES (
					:intclasseid,
					:intintfaceid
				)";
			try {
				$objPDOStm = $this->objPDO->prepare($strSql);
				$objPDOStm->execute(array(
					":intclasseid"  => $objIntface->getClasseId(),
					":intintfaceid" => $objIntface->getIntfaceId()
				));
				return $this->objPDO->lastInsertId();
			}
			catch(PDOException $ex) {
				throw new RepositorioException($ex->getMessage());
			}
		}
		else {
			throw new IntfaceNaoCadastradoException(null, null);
		}
	}
	
	/**
	 * Método que atualiza um objeto no Repositorio BDR
	 *
	 * @access public
	 * @param Intface $objIntface
	 * @throws IntfaceNaoCadastradoException
	 * @throws RepositorioException
	 * @return void
	 */
	public function atualizar(Intface $objIntface) {
		if ($objIntface != null) {
			$strSql = "
				UPDATE intfaces SET
				WHERE classeId = :intclasseid
				AND intfaceId = :intintfaceid";
			try {
				$objPDOStm = $this->objPDO->prepare($strSql);
				$objPDOStm->execute(array(
					":intclasseid"  => $objIntface->getClasseId(),
					":intintfaceid" => $objIntface->getIntfaceId()
				));
			}
			catch(PDOException $ex) {
				throw new RepositorioException($ex->getMessage());
			}
		}
		else {
			throw new IntfaceNaoCadastradoException(null, null);
		}
	}
	
	/**
	 * Método que remove um objeto no Repositorio BDR
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param int $intIntfaceId
	 * @throws RepositorioException
	 * @return void
	 */
	public function remover($intClasseId, $intIntfaceId) {
		$intClasseId = (int) $intClasseId;
		$intIntfaceId = (int) $intIntfaceId;
		
		$strSql = "
			DELETE FROM intfaces
			WHERE classeId = :intclasseid
			AND intfaceId = :intintfaceid";
		try {
			$objPDOStm = $this->objPDO->prepare($strSql);
			$objPDOStm->execute(array(
				":intclasseid" => $intClasseId,
				":intintfaceid" => $intIntfaceId
			));
		}
		catch(PDOException $ex) {
			throw new RepositorioException($ex->getMessage());
		}
	}
	
	/**
	 * Método que procura um objeto no Repositorio BDR
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param int $intIntfaceId
	 * @throws IntfaceNaoCadastradoException
	 * @return Intface
	 */
	public function procurar($intClasseId, $intIntfaceId) {
		$intClasseId = (int) $intClasseId;
		$intIntfaceId = (int) $intIntfaceId;
		
		$strSql ="
			AND classeId = :intclasseid
			AND intfaceId = :intintfaceid";
		$arrParam = array(
			":intclasseid" => $intClasseId,
			":intintfaceid" => $intIntfaceId
		);
		$arrObjIntface = $this->listar($strSql, $arrParam);
		if (!empty($arrObjIntface) && is_array($arrObjIntface)) {
			return $arrObjIntface[0];
		}
		else {
			throw new IntfaceNaoCadastradoException($intClasseId, $intIntfaceId);
		}
	}
	
	/**
	 * Método que verifica a existencia de um determinado objeto no Repositorio BDR
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param int $intIntfaceId
	 * @throws RepositorioException
	 * @return boolean
	 */
	public function existe($intClasseId, $intIntfaceId) {
		$intClasseId = (int) $intClasseId;
		$intIntfaceId = (int) $intIntfaceId;
		
		$strSql = "
			SELECT COUNT(*) AS quantidade
			FROM intfaces
			WHERE classeId = :intclasseid
			AND intfaceId = :intintfaceid";
		try {
			$objPDOStm = $this->objPDO->prepare($strSql);
			$objPDOStm->execute(array(
				":intclasseid" => $intClasseId,
				":intintfaceid" => $intIntfaceId
			));
			$arrResult = $objPDOStm->fetch(PDO::FETCH_ASSOC);
			if (!empty($arrResult) && is_array($arrResult) && $arrResult["quantidade"] > 0) {
				return true;
			}
			else {
				return false;
			}
		}
		catch(PDOException $ex) {
			throw new RepositorioException($ex->getMessage());
		}
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
				intfaceId
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
					$arrObjIntface[] = new Intface($arrResult["classeId"], $arrResult["intfaceId"]);
				}
			}
			return $arrObjIntface;
		}
		catch(PDOException $ex) {
			throw new RepositorioException($ex->getMessage());
		}
	}
	
}
