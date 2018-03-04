<?php
/**
 * Repositório de objetos Classe
 * Esta classe implementa a interface IRepositorioClasse
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:27:01
 */
class RepositorioClasseBDR implements IRepositorioClasse {
	/**
	 * Objeto da conexão
	 *
	 * @access protected
	 * @var ConexaoClasse
	 */
	protected $objConexaoClasse;
	
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
		$this->objConexaoClasse = ConexaoBDR::getInstancia("sistema");
		$this->objPDO = $this->objConexaoClasse->getConexao();
	}
	
	/**
	 * Método que insere um objeto no Repositorio BDR
	 *
	 * @access public
	 * @param Classe $objClasse
	 * @throws ClasseNaoCadastradoException
	 * @throws RepositorioException
	 * @return int
	 */
	public function inserir(Classe $objClasse) {
		if ($objClasse != null) {
			$intNovaVersao = ($objClasse->getNovaVersao()) ? 1 : 0;
			$strSql = "
				INSERT INTO classes (
					sistemaId,
					classeId,
					nome,
					tipo,
					tipoCamada,
					resumo,
					descricao,
					autor,
					pacote,
					subpacote,
					versao,
					dataCriacao,
					tabelaBd,
					novaVersao,
					nameSpace
				)
				VALUES (
					:intsistemaid,
					:intclasseid,
					:strnome,
					:strtipo,
					:strtipocamada,
					:strresumo,
					:strdescricao,
					:strautor,
					:strpacote,
					:strsubpacote,
					:strversao,
					:strdatacriacao,
					:strtabelabd,
					:bolnovaversao,
					:strnamespace
				)";
			try {
				$objPDOStm = $this->objPDO->prepare($strSql);
				$objPDOStm->execute(array(
					":intsistemaid"   => $objClasse->getSistemaId(),
					":intclasseid"    => $objClasse->getClasseId(),
					":strnome"        => $objClasse->getNome(),
					":strtipo"        => $objClasse->getTipo(),
					":strtipocamada"  => $objClasse->getTipoCamada(),
					":strresumo"      => $objClasse->getResumo(),
					":strdescricao"   => $objClasse->getDescricao(),
					":strautor"       => $objClasse->getAutor(),
					":strpacote"      => $objClasse->getPacote(),
					":strsubpacote"   => $objClasse->getSubpacote(),
					":strversao"      => $objClasse->getVersao(),
					":strdatacriacao" => $objClasse->getDataCriacao(),
					":strtabelabd"    => $objClasse->getTabelaBd(),
					":bolnovaversao"  => $intNovaVersao,
					":strnamespace"   => $objClasse->getNameSpace()
				));
				return $this->objPDO->lastInsertId();
			}
			catch(PDOException $ex) {
				throw new RepositorioException($ex->getMessage());
			}
		}
		else {
			throw new ClasseNaoCadastradoException(null, null);
		}
	}
	
	/**
	 * Método que atualiza um objeto no Repositorio BDR
	 *
	 * @access public
	 * @param Classe $objClasse
	 * @throws ClasseNaoCadastradoException
	 * @throws RepositorioException
	 * @return void
	 */
	public function atualizar(Classe $objClasse) {
		if ($objClasse != null) {
			$intNovaVersao = ($objClasse->getNovaVersao()) ? 1 : 0;
			$strSql = "
				UPDATE classes SET
					classeId    = :intclasseid,
					tipo        = :strtipo,
					tipoCamada  = :strtipocamada,
					resumo      = :strresumo,
					descricao   = :strdescricao,
					autor       = :strautor,
					pacote      = :strpacote,
					subpacote   = :strsubpacote,
					versao      = :strversao,
					dataCriacao = :strdatacriacao,
					tabelaBd    = :strtabelabd,
					novaVersao  = :bolnovaversao,
					nameSpace   = :strnamespace
				WHERE sistemaId = :intsistemaid
				AND nome = :strnome";
			try {
				$objPDOStm = $this->objPDO->prepare($strSql);
				$objPDOStm->execute(array(
					":intsistemaid"   => $objClasse->getSistemaId(),
					":intclasseid"    => $objClasse->getClasseId(),
					":strnome"        => $objClasse->getNome(),
					":strtipo"        => $objClasse->getTipo(),
					":strtipocamada"  => $objClasse->getTipoCamada(),
					":strresumo"      => $objClasse->getResumo(),
					":strdescricao"   => $objClasse->getDescricao(),
					":strautor"       => $objClasse->getAutor(),
					":strpacote"      => $objClasse->getPacote(),
					":strsubpacote"   => $objClasse->getSubpacote(),
					":strversao"      => $objClasse->getVersao(),
					":strdatacriacao" => $objClasse->getDataCriacao(),
					":strtabelabd"    => $objClasse->getTabelaBd(),
					":bolnovaversao"  => $intNovaVersao,
					":strnamespace"   => $objClasse->getNameSpace()
				));
			}
			catch(PDOException $ex) {
				throw new RepositorioException($ex->getMessage());
			}
		}
		else {
			throw new ClasseNaoCadastradoException(null, null);
		}
	}
	
	/**
	 * Método que remove um objeto no Repositorio BDR
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @param string $strNome
	 * @throws RepositorioException
	 * @return void
	 */
	public function remover($intSistemaId, $strNome) {
		$intSistemaId = (int) $intSistemaId;
		$strNome = (string) $strNome;
		
		$strSql = "
			DELETE FROM classes
			WHERE sistemaId = :intsistemaid
			AND nome = :strnome";
		try {
			$objPDOStm = $this->objPDO->prepare($strSql);
			$objPDOStm->execute(array(
				":intsistemaid" => $intSistemaId,
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
	 * @param int $intSistemaId
	 * @param string $strNome
	 * @throws ClasseNaoCadastradoException
	 * @return Classe
	 */
	public function procurar($intSistemaId, $strNome) {
		$intSistemaId = (int) $intSistemaId;
		$strNome = (string) $strNome;
		
		$strSql ="
			AND sistemaId = :intsistemaid
			AND nome = :strnome";
		$arrParam = array(
			":intsistemaid" => $intSistemaId,
			":strnome" => $strNome
		);
		$arrObjClasse = $this->listar($strSql, $arrParam);
		if (!empty($arrObjClasse) && is_array($arrObjClasse)) {
			return $arrObjClasse[0];
		}
		else {
			throw new ClasseNaoCadastradoException($intSistemaId, $strNome);
		}
	}
	
	/**
	 * Método que verifica a existencia de um determinado objeto no Repositorio BDR
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @param string $strNome
	 * @throws RepositorioException
	 * @return boolean
	 */
	public function existe($intSistemaId, $strNome) {
		$intSistemaId = (int) $intSistemaId;
		$strNome = (string) $strNome;
		
		$strSql = "
			SELECT COUNT(*) AS quantidade
			FROM classes
			WHERE sistemaId = :intsistemaid
			AND nome = :strnome";
		try {
			$objPDOStm = $this->objPDO->prepare($strSql);
			$objPDOStm->execute(array(
				":intsistemaid" => $intSistemaId,
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
				sistemaId,
				classeId,
				nome,
				tipo,
				tipoCamada,
				resumo,
				descricao,
				autor,
				pacote,
				subpacote,
				versao,
				dataCriacao,
				tabelaBd,
				novaVersao,
				nameSpace
			FROM classes
			WHERE sistemaId IS NOT NULL
			AND nome IS NOT NULL
			$strComplemento";
		try {
			$objPDOStm = $this->objPDO->prepare($strSql);
			$objPDOStm->execute($arrParam);
			$arrResults = $objPDOStm->fetchAll(PDO::FETCH_ASSOC);
			$arrObjClasse = array();
			if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $arrResult) {
					$arrObjClasse[] = new Classe($arrResult["sistemaId"], $arrResult["classeId"], $arrResult["nome"], $arrResult["tipo"], $arrResult["tipoCamada"], $arrResult["resumo"], $arrResult["descricao"], $arrResult["autor"], $arrResult["pacote"], $arrResult["subpacote"], $arrResult["versao"], $arrResult["dataCriacao"], $arrResult["tabelaBd"], $arrResult["novaVersao"], $arrResult["nameSpace"]);
				}
			}
			return $arrObjClasse;
		}
		catch(PDOException $ex) {
			throw new RepositorioException($ex->getMessage());
		}
	}
	
}
