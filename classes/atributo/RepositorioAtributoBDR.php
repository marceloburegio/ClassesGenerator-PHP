<?php
/**
 * Repositório de objetos Atributo
 * Esta classe implementa a interface IRepositorioAtributo
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:26:14
 */
class RepositorioAtributoBDR implements IRepositorioAtributo {
	/**
	 * Objeto da conexão
	 *
	 * @access protected
	 * @var ConexaoAtributo
	 */
	protected $objConexaoAtributo;
	
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
		$this->objConexaoAtributo = ConexaoBDR::getInstancia("sistema");
		$this->objPDO = $this->objConexaoAtributo->getConexao();
	}
	
	/**
	 * Método que insere um objeto no Repositorio BDR
	 *
	 * @access public
	 * @param Atributo $objAtributo
	 * @throws AtributoNaoCadastradoException
	 * @throws RepositorioException
	 * @return int
	 */
	public function inserir(Atributo $objAtributo) {
		if ($objAtributo != null) {
			$intChavePk = ($objAtributo->getChavePk()) ? 1 : 0;
			$strSql = "
				INSERT INTO atributos (
					classeId,
					atributoId,
					nome,
					acesso,
					tipo,
					resumo,
					descricao,
					colunaBd,
					chavePk,
					ordem
				)
				VALUES (
					:intclasseid,
					:intatributoid,
					:strnome,
					:stracesso,
					:strtipo,
					:strresumo,
					:strdescricao,
					:strcolunabd,
					:bolchavepk,
					:intordem
				)";
			try {
				$objPDOStm = $this->objPDO->prepare($strSql);
				$objPDOStm->execute(array(
					":intclasseid"   => $objAtributo->getClasseId(),
					":intatributoid" => $objAtributo->getAtributoId(),
					":strnome"       => $objAtributo->getNome(),
					":stracesso"     => $objAtributo->getAcesso(),
					":strtipo"       => $objAtributo->getTipo(),
					":strresumo"     => $objAtributo->getResumo(),
					":strdescricao"  => $objAtributo->getDescricao(),
					":strcolunabd"   => $objAtributo->getColunaBd(),
					":bolchavepk"    => $intChavePk,
					":intordem"      => $objAtributo->getOrdem()
				));
				return $this->objPDO->lastInsertId();
			}
			catch(PDOException $ex) {
				throw new RepositorioException($ex->getMessage());
			}
		}
		else {
			throw new AtributoNaoCadastradoException(null, null);
		}
	}
	
	/**
	 * Método que atualiza um objeto no Repositorio BDR
	 *
	 * @access public
	 * @param Atributo $objAtributo
	 * @throws AtributoNaoCadastradoException
	 * @throws RepositorioException
	 * @return void
	 */
	public function atualizar(Atributo $objAtributo) {
		if ($objAtributo != null) {
			$intChavePk = ($objAtributo->getChavePk()) ? 1 : 0;
			$strSql = "
				UPDATE atributos SET
					atributoId = :intatributoid,
					acesso     = :stracesso,
					tipo       = :strtipo,
					resumo     = :strresumo,
					descricao  = :strdescricao,
					colunaBd   = :strcolunabd,
					chavePk    = :bolchavepk,
					ordem      = :intordem
				WHERE classeId = :intclasseid
				AND nome = :strnome";
			try {
				$objPDOStm = $this->objPDO->prepare($strSql);
				$objPDOStm->execute(array(
					":intclasseid"   => $objAtributo->getClasseId(),
					":intatributoid" => $objAtributo->getAtributoId(),
					":strnome"       => $objAtributo->getNome(),
					":stracesso"     => $objAtributo->getAcesso(),
					":strtipo"       => $objAtributo->getTipo(),
					":strresumo"     => $objAtributo->getResumo(),
					":strdescricao"  => $objAtributo->getDescricao(),
					":strcolunabd"   => $objAtributo->getColunaBd(),
					":bolchavepk"    => $intChavePk,
					":intordem"      => $objAtributo->getOrdem()
				));
			}
			catch(PDOException $ex) {
				throw new RepositorioException($ex->getMessage());
			}
		}
		else {
			throw new AtributoNaoCadastradoException(null, null);
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
			DELETE FROM atributos
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
	 * @throws AtributoNaoCadastradoException
	 * @return Atributo
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
		$arrObjAtributo = $this->listar($strSql, $arrParam);
		if (!empty($arrObjAtributo) && is_array($arrObjAtributo)) {
			return $arrObjAtributo[0];
		}
		else {
			throw new AtributoNaoCadastradoException($intClasseId, $strNome);
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
			FROM atributos
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
				atributoId,
				nome,
				acesso,
				tipo,
				resumo,
				descricao,
				colunaBd,
				chavePk,
				ordem
			FROM atributos
			WHERE classeId IS NOT NULL
			AND nome IS NOT NULL
			$strComplemento";
		try {
			$objPDOStm = $this->objPDO->prepare($strSql);
			$objPDOStm->execute($arrParam);
			$arrResults = $objPDOStm->fetchAll(PDO::FETCH_ASSOC);
			$arrObjAtributo = array();
			if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $arrResult) {
					$arrResult["chavePk"] = ($arrResult["chavePk"]) ? true : false;
					$arrObjAtributo[] = new Atributo($arrResult["classeId"], $arrResult["atributoId"], $arrResult["nome"], $arrResult["acesso"], $arrResult["tipo"], $arrResult["resumo"], $arrResult["descricao"], $arrResult["colunaBd"], $arrResult["chavePk"], $arrResult["ordem"]);
				}
			}
			return $arrObjAtributo;
		}
		catch(PDOException $ex) {
			throw new RepositorioException($ex->getMessage());
		}
	}
	
}
