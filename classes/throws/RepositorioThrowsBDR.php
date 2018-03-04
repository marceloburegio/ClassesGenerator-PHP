<?php
/**
 * Repositório de objetos Throws
 * Esta classe implementa a interface IRepositorioThrows
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:38:02
 */
class RepositorioThrowsBDR implements IRepositorioThrows {
	/**
	 * Objeto da conexão
	 *
	 * @access protected
	 * @var ConexaoThrows
	 */
	protected $objConexaoThrows;
	
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
		$this->objConexaoThrows = ConexaoBDR::getInstancia("sistema");
		$this->objPDO = $this->objConexaoThrows->getConexao();
	}
	
	/**
	 * Método que insere um objeto no Repositorio BDR
	 *
	 * @access public
	 * @param Throws $objThrows
	 * @throws ThrowsNaoCadastradoException
	 * @throws RepositorioException
	 * @return int
	 */
	public function inserir(Throws $objThrows) {
		if ($objThrows != null) {
			$strSql = "
				INSERT INTO throws (
					metodoId,
					throwsId,
					nome,
					ordem
				)
				VALUES (
					:intmetodoid,
					:intthrowsid,
					:strnome,
					:intordem
				)";
			try {
				$objPDOStm = $this->objPDO->prepare($strSql);
				$objPDOStm->execute(array(
					":intmetodoid" => $objThrows->getMetodoId(),
					":intthrowsid" => $objThrows->getThrowsId(),
					":strnome"     => $objThrows->getNome(),
					":intordem"    => $objThrows->getOrdem()
				));
				return $this->objPDO->lastInsertId();
			}
			catch(PDOException $ex) {
				throw new RepositorioException($ex->getMessage());
			}
		}
		else {
			throw new ThrowsNaoCadastradoException(null, null);
		}
	}
	
	/**
	 * Método que atualiza um objeto no Repositorio BDR
	 *
	 * @access public
	 * @param Throws $objThrows
	 * @throws ThrowsNaoCadastradoException
	 * @throws RepositorioException
	 * @return void
	 */
	public function atualizar(Throws $objThrows) {
		if ($objThrows != null) {
			$strSql = "
				UPDATE throws SET
					throwsId = :intthrowsid,
					ordem    = :intordem
				WHERE metodoId = :intmetodoid
				AND nome = :strnome";
			try {
				$objPDOStm = $this->objPDO->prepare($strSql);
				$objPDOStm->execute(array(
					":intmetodoid" => $objThrows->getMetodoId(),
					":intthrowsid" => $objThrows->getThrowsId(),
					":strnome"     => $objThrows->getNome(),
					":intordem"    => $objThrows->getOrdem()
				));
			}
			catch(PDOException $ex) {
				throw new RepositorioException($ex->getMessage());
			}
		}
		else {
			throw new ThrowsNaoCadastradoException(null, null);
		}
	}
	
	/**
	 * Método que remove um objeto no Repositorio BDR
	 *
	 * @access public
	 * @param int $intMetodoId
	 * @param string $strNome
	 * @throws RepositorioException
	 * @return void
	 */
	public function remover($intMetodoId, $strNome) {
		$intMetodoId = (int) $intMetodoId;
		$strNome = (string) $strNome;
		
		$strSql = "
			DELETE FROM throws
			WHERE metodoId = :intmetodoid
			AND nome = :strnome";
		try {
			$objPDOStm = $this->objPDO->prepare($strSql);
			$objPDOStm->execute(array(
				":intmetodoid" => $intMetodoId,
				":strnome" => $strNome
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
	 * @param int $intMetodoId
	 * @param string $strNome
	 * @throws ThrowsNaoCadastradoException
	 * @return Throws
	 */
	public function procurar($intMetodoId, $strNome) {
		$intMetodoId = (int) $intMetodoId;
		$strNome = (string) $strNome;
		
		$strSql ="
			AND metodoId = :intmetodoid
			AND nome = :strnome";
		$arrParam = array(
			":intmetodoid" => $intMetodoId,
			":strnome" => $strNome
		);
		$arrObjThrows = $this->listar($strSql, $arrParam);
		if (!empty($arrObjThrows) && is_array($arrObjThrows)) {
			return $arrObjThrows[0];
		}
		else {
			throw new ThrowsNaoCadastradoException($intMetodoId, $strNome);
		}
	}
	
	/**
	 * Método que verifica a existencia de um determinado objeto no Repositorio BDR
	 *
	 * @access public
	 * @param int $intMetodoId
	 * @param string $strNome
	 * @throws RepositorioException
	 * @return boolean
	 */
	public function existe($intMetodoId, $strNome) {
		$intMetodoId = (int) $intMetodoId;
		$strNome = (string) $strNome;
		
		$strSql = "
			SELECT COUNT(*) AS quantidade
			FROM throws
			WHERE metodoId = :intmetodoid
			AND nome = :strnome";
		try {
			$objPDOStm = $this->objPDO->prepare($strSql);
			$objPDOStm->execute(array(
				":intmetodoid" => $intMetodoId,
				":strnome" => $strNome
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
				metodoId,
				throwsId,
				nome,
				ordem
			FROM throws
			WHERE metodoId IS NOT NULL
			AND nome IS NOT NULL
			$strComplemento";
		try {
			$objPDOStm = $this->objPDO->prepare($strSql);
			$objPDOStm->execute($arrParam);
			$arrResults = $objPDOStm->fetchAll(PDO::FETCH_ASSOC);
			$arrObjThrows = array();
			if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $arrResult) {
					$arrObjThrows[] = new Throws($arrResult["metodoId"], $arrResult["throwsId"], $arrResult["nome"], $arrResult["ordem"]);
				}
			}
			return $arrObjThrows;
		}
		catch(PDOException $ex) {
			throw new RepositorioException($ex->getMessage());
		}
	}
	
}
