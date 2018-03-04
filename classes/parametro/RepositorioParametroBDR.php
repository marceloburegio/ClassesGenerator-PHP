<?php
/**
 * Repositório de objetos Parametro
 * Esta classe implementa a interface IRepositorioParametro
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:28:51
 */
class RepositorioParametroBDR implements IRepositorioParametro {
	/**
	 * Objeto da conexão
	 *
	 * @access protected
	 * @var ConexaoParametro
	 */
	protected $objConexaoParametro;
	
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
		$this->objConexaoParametro = ConexaoBDR::getInstancia("sistema");
		$this->objPDO = $this->objConexaoParametro->getConexao();
	}
	
	/**
	 * Método que insere um objeto no Repositorio BDR
	 *
	 * @access public
	 * @param Parametro $objParametro
	 * @throws ParametroNaoCadastradoException
	 * @throws RepositorioException
	 * @return int
	 */
	public function inserir(Parametro $objParametro) {
		if ($objParametro != null) {
			$strSql = "
				INSERT INTO parametros (
					metodoId,
					parametroId,
					nome,
					tipo,
					valorPadrao,
					ordem
				)
				VALUES (
					:intmetodoid,
					:intparametroid,
					:strnome,
					:strtipo,
					:strvalorpadrao,
					:intordem
				)";
			try {
				$objPDOStm = $this->objPDO->prepare($strSql);
				$objPDOStm->execute(array(
					":intmetodoid"    => $objParametro->getMetodoId(),
					":intparametroid" => $objParametro->getParametroId(),
					":strnome"        => $objParametro->getNome(),
					":strtipo"        => $objParametro->getTipo(),
					":strvalorpadrao" => $objParametro->getValorPadrao(),
					":intordem"       => $objParametro->getOrdem()
				));
				return $this->objPDO->lastInsertId();
			}
			catch(PDOException $ex) {
				throw new RepositorioException($ex->getMessage());
			}
		}
		else {
			throw new ParametroNaoCadastradoException(null, null);
		}
	}
	
	/**
	 * Método que atualiza um objeto no Repositorio BDR
	 *
	 * @access public
	 * @param Parametro $objParametro
	 * @throws ParametroNaoCadastradoException
	 * @throws RepositorioException
	 * @return void
	 */
	public function atualizar(Parametro $objParametro) {
		if ($objParametro != null) {
			$strSql = "
				UPDATE parametros SET
					parametroId = :intparametroid,
					tipo        = :strtipo,
					valorPadrao = :strvalorpadrao,
					ordem       = :intordem
				WHERE metodoId = :intmetodoid
				AND nome = :strnome";
			try {
				$objPDOStm = $this->objPDO->prepare($strSql);
				$objPDOStm->execute(array(
					":intmetodoid"    => $objParametro->getMetodoId(),
					":intparametroid" => $objParametro->getParametroId(),
					":strnome"        => $objParametro->getNome(),
					":strtipo"        => $objParametro->getTipo(),
					":strvalorpadrao" => $objParametro->getValorPadrao(),
					":intordem"       => $objParametro->getOrdem()
				));
			}
			catch(PDOException $ex) {
				throw new RepositorioException($ex->getMessage());
			}
		}
		else {
			throw new ParametroNaoCadastradoException(null, null);
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
			DELETE FROM parametros
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
	 * @throws ParametroNaoCadastradoException
	 * @return Parametro
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
		$arrObjParametro = $this->listar($strSql, $arrParam);
		if (!empty($arrObjParametro) && is_array($arrObjParametro)) {
			return $arrObjParametro[0];
		}
		else {
			throw new ParametroNaoCadastradoException($intMetodoId, $strNome);
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
			FROM parametros
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
				parametroId,
				nome,
				tipo,
				valorPadrao,
				ordem
			FROM parametros
			WHERE metodoId IS NOT NULL
			AND nome IS NOT NULL
			$strComplemento";
		try {
			$objPDOStm = $this->objPDO->prepare($strSql);
			$objPDOStm->execute($arrParam);
			$arrResults = $objPDOStm->fetchAll(PDO::FETCH_ASSOC);
			$arrObjParametro = array();
			if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $arrResult) {
					$arrObjParametro[] = new Parametro($arrResult["metodoId"], $arrResult["parametroId"], $arrResult["nome"], $arrResult["tipo"], $arrResult["valorPadrao"], $arrResult["ordem"]);
				}
			}
			return $arrObjParametro;
		}
		catch(PDOException $ex) {
			throw new RepositorioException($ex->getMessage());
		}
	}
	
}
