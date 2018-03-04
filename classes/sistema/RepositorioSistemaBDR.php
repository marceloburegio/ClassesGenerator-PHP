<?php
/**
 * Repositório de objetos Sistema
 * Esta classe implementa a interface IRepositorioSistema
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:29:13
 */
class RepositorioSistemaBDR implements IRepositorioSistema {
	/**
	 * Objeto da conexão
	 *
	 * @access protected
	 * @var ConexaoSistema
	 */
	protected $objConexaoSistema;
	
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
		$this->objConexaoSistema = ConexaoBDR::getInstancia("sistema");
		$this->objPDO = $this->objConexaoSistema->getConexao();
	}
	
	/**
	 * Método que insere um objeto no Repositorio BDR
	 *
	 * @access public
	 * @param Sistema $objSistema
	 * @throws SistemaNaoCadastradoException
	 * @throws RepositorioException
	 * @return int
	 */
	public function inserir(Sistema $objSistema) {
		if ($objSistema != null) {
			$strSql = "
				INSERT INTO sistemas (
					sistemaId,
					nome,
					descricao,
					criadoPor
				)
				VALUES (
					:intsistemaid,
					:strnome,
					:strdescricao,
					:strcriadopor
				)";
			try {
				$objPDOStm = $this->objPDO->prepare($strSql);
				$objPDOStm->execute(array(
					":intsistemaid" => $objSistema->getSistemaId(),
					":strnome"      => $objSistema->getNome(),
					":strdescricao" => $objSistema->getDescricao(),
					":strcriadopor" => $objSistema->getCriadoPor()
				));
				return $this->objPDO->lastInsertId();
			}
			catch(PDOException $ex) {
				throw new RepositorioException($ex->getMessage());
			}
		}
		else {
			throw new SistemaNaoCadastradoException(null);
		}
	}
	
	/**
	 * Método que atualiza um objeto no Repositorio BDR
	 *
	 * @access public
	 * @param Sistema $objSistema
	 * @throws SistemaNaoCadastradoException
	 * @throws RepositorioException
	 * @return void
	 */
	public function atualizar(Sistema $objSistema) {
		if ($objSistema != null) {
			$strSql = "
				UPDATE sistemas SET
					nome      = :strnome,
					descricao = :strdescricao,
					criadoPor = :strcriadopor
				WHERE sistemaId = :intsistemaid";
			try {
				$objPDOStm = $this->objPDO->prepare($strSql);
				$objPDOStm->execute(array(
					":intsistemaid" => $objSistema->getSistemaId(),
					":strnome"      => $objSistema->getNome(),
					":strdescricao" => $objSistema->getDescricao(),
					":strcriadopor" => $objSistema->getCriadoPor()
				));
			}
			catch(PDOException $ex) {
				throw new RepositorioException($ex->getMessage());
			}
		}
		else {
			throw new SistemaNaoCadastradoException(null);
		}
	}
	
	/**
	 * Método que remove um objeto no Repositorio BDR
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @throws RepositorioException
	 * @return void
	 */
	public function remover($intSistemaId) {
		$intSistemaId = (int) $intSistemaId;
		
		$strSql = "
			DELETE FROM sistemas
			WHERE sistemaId = :intsistemaid";
		try {
			$objPDOStm = $this->objPDO->prepare($strSql);
			$objPDOStm->execute(array(
				":intsistemaid" => $intSistemaId
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
	 * @param int $intSistemaId
	 * @throws SistemaNaoCadastradoException
	 * @return Sistema
	 */
	public function procurar($intSistemaId) {
		$intSistemaId = (int) $intSistemaId;
		
		$strSql ="
			AND sistemaId = :intsistemaid";
		$arrParam = array(
			":intsistemaid" => $intSistemaId
		);
		$arrObjSistema = $this->listar($strSql, $arrParam);
		if (!empty($arrObjSistema) && is_array($arrObjSistema)) {
			return $arrObjSistema[0];
		}
		else {
			throw new SistemaNaoCadastradoException($intSistemaId);
		}
	}
	
	/**
	 * Método que verifica a existencia de um determinado objeto no Repositorio BDR
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @throws RepositorioException
	 * @return boolean
	 */
	public function existe($intSistemaId) {
		$intSistemaId = (int) $intSistemaId;
		
		$strSql = "
			SELECT COUNT(*) AS quantidade
			FROM sistemas
			WHERE sistemaId = :intsistemaid";
		try {
			$objPDOStm = $this->objPDO->prepare($strSql);
			$objPDOStm->execute(array(
				":intsistemaid" => $intSistemaId
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
				sistemaId,
				nome,
				descricao,
				criadoPor
			FROM sistemas
			WHERE sistemaId IS NOT NULL
			$strComplemento";
		try {
			$objPDOStm = $this->objPDO->prepare($strSql);
			$objPDOStm->execute($arrParam);
			$arrResults = $objPDOStm->fetchAll(PDO::FETCH_ASSOC);
			$arrObjSistema = array();
			if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $arrResult) {
					$arrObjSistema[] = new Sistema($arrResult["sistemaId"], $arrResult["nome"], $arrResult["descricao"], $arrResult["criadoPor"]);
				}
			}
			return $arrObjSistema;
		}
		catch(PDOException $ex) {
			throw new RepositorioException($ex->getMessage());
		}
	}
	
}
