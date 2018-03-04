<?php
/**
 * Repositório de objetos Metodo
 * Esta classe implementa a interface IRepositorioMetodo
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:28:07
 */
class RepositorioMetodoBDR implements IRepositorioMetodo {
	/**
	 * Objeto da conexão
	 *
	 * @access protected
	 * @var ConexaoMetodo
	 */
	protected $objConexaoMetodo;
	
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
		$this->objConexaoMetodo = ConexaoBDR::getInstancia("sistema");
		$this->objPDO = $this->objConexaoMetodo->getConexao();
	}
	
	/**
	 * Método que insere um objeto no Repositorio BDR
	 *
	 * @access public
	 * @param Metodo $objMetodo
	 * @throws MetodoNaoCadastradoException
	 * @throws RepositorioException
	 * @return int
	 */
	public function inserir(Metodo $objMetodo) {
		if ($objMetodo != null) {
			$strSql = "
				INSERT INTO metodos (
					classeId,
					metodoId,
					nome,
					acesso,
					retorno,
					conteudo,
					resumo,
					descricao,
					ordem
				)
				VALUES (
					:intclasseid,
					:intmetodoid,
					:strnome,
					:stracesso,
					:strretorno,
					:strconteudo,
					:strresumo,
					:strdescricao,
					:intordem
				)";
			try {
				$objPDOStm = $this->objPDO->prepare($strSql);
				$objPDOStm->execute(array(
					":intclasseid"  => $objMetodo->getClasseId(),
					":intmetodoid"  => $objMetodo->getMetodoId(),
					":strnome"      => $objMetodo->getNome(),
					":stracesso"    => $objMetodo->getAcesso(),
					":strretorno"   => $objMetodo->getRetorno(),
					":strconteudo"  => $objMetodo->getConteudo(),
					":strresumo"    => $objMetodo->getResumo(),
					":strdescricao" => $objMetodo->getDescricao(),
					":intordem"     => $objMetodo->getOrdem()
				));
				return $this->objPDO->lastInsertId();
			}
			catch(PDOException $ex) {
				throw new RepositorioException($ex->getMessage());
			}
		}
		else {
			throw new MetodoNaoCadastradoException(null, null);
		}
	}
	
	/**
	 * Método que atualiza um objeto no Repositorio BDR
	 *
	 * @access public
	 * @param Metodo $objMetodo
	 * @throws MetodoNaoCadastradoException
	 * @throws RepositorioException
	 * @return void
	 */
	public function atualizar(Metodo $objMetodo) {
		if ($objMetodo != null) {
			$strSql = "
				UPDATE metodos SET
					metodoId  = :intmetodoid,
					acesso    = :stracesso,
					retorno   = :strretorno,
					conteudo  = :strconteudo,
					resumo    = :strresumo,
					descricao = :strdescricao,
					ordem     = :intordem
				WHERE classeId = :intclasseid
				AND nome = :strnome";
			try {
				$objPDOStm = $this->objPDO->prepare($strSql);
				$objPDOStm->execute(array(
					":intclasseid"  => $objMetodo->getClasseId(),
					":intmetodoid"  => $objMetodo->getMetodoId(),
					":strnome"      => $objMetodo->getNome(),
					":stracesso"    => $objMetodo->getAcesso(),
					":strretorno"   => $objMetodo->getRetorno(),
					":strconteudo"  => $objMetodo->getConteudo(),
					":strresumo"    => $objMetodo->getResumo(),
					":strdescricao" => $objMetodo->getDescricao(),
					":intordem"     => $objMetodo->getOrdem()
				));
			}
			catch(PDOException $ex) {
				throw new RepositorioException($ex->getMessage());
			}
		}
		else {
			throw new MetodoNaoCadastradoException(null, null);
		}
	}
	
	/**
	 * Método que remove um objeto no Repositorio BDR
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param string $strNome
	 * @throws RepositorioException
	 * @return void
	 */
	public function remover($intClasseId, $strNome) {
		$intClasseId = (int) $intClasseId;
		$strNome = (string) $strNome;
		
		$strSql = "
			DELETE FROM metodos
			WHERE classeId = :intclasseid
			AND nome = :strnome";
		try {
			$objPDOStm = $this->objPDO->prepare($strSql);
			$objPDOStm->execute(array(
				":intclasseid" => $intClasseId,
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
	 * @param int $intClasseId
	 * @param string $strNome
	 * @throws MetodoNaoCadastradoException
	 * @return Metodo
	 */
	public function procurar($intClasseId, $strNome) {
		$intClasseId = (int) $intClasseId;
		$strNome = (string) $strNome;
		
		$strSql ="
			AND classeId = :intclasseid
			AND nome = :strnome";
		$arrParam = array(
			":intclasseid" => $intClasseId,
			":strnome" => $strNome
		);
		$arrObjMetodo = $this->listar($strSql, $arrParam);
		if (!empty($arrObjMetodo) && is_array($arrObjMetodo)) {
			return $arrObjMetodo[0];
		}
		else {
			throw new MetodoNaoCadastradoException($intClasseId, $strNome);
		}
	}
	
	/**
	 * Método que verifica a existencia de um determinado objeto no Repositorio BDR
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param string $strNome
	 * @throws RepositorioException
	 * @return boolean
	 */
	public function existe($intClasseId, $strNome) {
		$intClasseId = (int) $intClasseId;
		$strNome = (string) $strNome;
		
		$strSql = "
			SELECT COUNT(*) AS quantidade
			FROM metodos
			WHERE classeId = :intclasseid
			AND nome = :strnome";
		try {
			$objPDOStm = $this->objPDO->prepare($strSql);
			$objPDOStm->execute(array(
				":intclasseid" => $intClasseId,
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
				classeId,
				metodoId,
				nome,
				acesso,
				retorno,
				conteudo,
				resumo,
				descricao,
				ordem
			FROM metodos
			WHERE classeId IS NOT NULL
			AND nome IS NOT NULL
			$strComplemento";
		try {
			$objPDOStm = $this->objPDO->prepare($strSql);
			$objPDOStm->execute($arrParam);
			$arrResults = $objPDOStm->fetchAll(PDO::FETCH_ASSOC);
			$arrObjMetodo = array();
			if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $arrResult) {
					$arrObjMetodo[] = new Metodo($arrResult["classeId"], $arrResult["metodoId"], $arrResult["nome"], $arrResult["acesso"], $arrResult["retorno"], $arrResult["conteudo"], $arrResult["resumo"], $arrResult["descricao"], $arrResult["ordem"]);
				}
			}
			return $arrObjMetodo;
		}
		catch(PDOException $ex) {
			throw new RepositorioException($ex->getMessage());
		}
	}
	
}
