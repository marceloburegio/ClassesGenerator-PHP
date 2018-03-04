<?php
/**
 * Fachada do sistema
 * Esta Fachada é a implementação usando os repositórios BDR
 *
 * @author Marcelo Burégio
 * @subpackage fachada
 * @version 1.0
 * @since 22/10/2008 11:43:50
 */
class FachadaBDR {
	/**
	 * Atributo contendo a instância do Singleton da FachadaBDR
	 *
	 * @access private
	 * @var FachadaBDR
	 */
	private static $objInstance = null;
	
	/**
	 * RepositórioBDR de classes Classe
	 *
	 * @access private
	 * @var IRepositorioClasse
	 */
	private $objRepositorioClasse;
	
	/**
	 * RepositórioBDR de classes Atributo
	 *
	 * @access private
	 * @var IRepositorioAtributo
	 */
	private $objRepositorioAtributo;
	
	/**
	 * RepositórioBDR de classes Metodo
	 *
	 * @access private
	 * @var IRepositorioMetodo
	 */
	private $objRepositorioMetodo;
	
	/**
	 * RepositórioBDR de classes Parametro
	 *
	 * @access private
	 * @var IRepositorioParametro
	 */
	private $objRepositorioParametro;
	
	/**
	 * RepositórioBDR de classes Intface
	 *
	 * @access private
	 * @var IRepositorioIntface
	 */
	private $objRepositorioIntface;
	
	/**
	 * RepositórioBDR de classes Sistema
	 *
	 * @access private
	 * @var IRepositorioSistema
	 */
	private $objRepositorioSistema;
	
	/**
	 * RepositórioBDR de classes Throws
	 *
	 * @access private
	 * @var IRepositorioThrows
	 */
	private $objRepositorioThrows;
	
	/**
	 * Método construtor da classe
	 * 
	 * @access private
	 */
	private function __construct() {
		$this->objRepositorioClasse			= new RepositorioClasseBDRCustomizado();
		$this->objRepositorioAtributo		= new RepositorioAtributoBDRCustomizado();
		$this->objRepositorioMetodo			= new RepositorioMetodoBDRCustomizado();
		$this->objRepositorioParametro		= new RepositorioParametroBDRCustomizado();
		$this->objRepositorioIntface		= new RepositorioIntfaceBDRCustomizado();
		$this->objRepositorioSistema		= new RepositorioSistemaBDRCustomizado();
		$this->objRepositorioThrows			= new RepositorioThrowsBDRCustomizado();
	}
	
	/**
	 * Método estático Singleton que retorna uma instância da FachadaBDR
	 *
	 * @access public
	 */
	public static function getInstance() {
		if (self::$objInstance == null) {
			self::$objInstance = new FachadaBDR();
		}
		return self::$objInstance;
	}
	
	/**
	 * Método que lista todas as classes do SistemaId
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @return array
	 */
	public function listarClassesPorSistemaId($intSistemaId) {
		$objControladorClasse = new ControladorClasse($this->objRepositorioClasse, $this->objRepositorioAtributo, $this->objRepositorioMetodo, $this->objRepositorioParametro, $this->objRepositorioIntface, $this->objRepositorioThrows);
		return $objControladorClasse->listarPorSistemaId($intSistemaId);
	}
	
	/**
	 * Método que lista todas as classes do SistemaId e do Subpacote
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @param string $strSubpacote
	 * @return array
	 */
	public function listarClassesPorSistemaIdPorSubpacote($intSistemaId, $strSubpacote) {
		$objControladorClasse = new ControladorClasse($this->objRepositorioClasse, $this->objRepositorioAtributo, $this->objRepositorioMetodo, $this->objRepositorioParametro, $this->objRepositorioIntface, $this->objRepositorioThrows);
		return $objControladorClasse->listarPorSistemaIdPorSubpacote($intSistemaId, $strSubpacote);
	}
	
	/**
	 * Método que cria todas as classes da classe especificada
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @param string $strNomeClasse
	 * @param string $strTabelaBd
	 * @param string $strResumoClasse
	 * @param string $strAutorClasse
	 * @param array $arrTipoAtributos
	 * @param array $arrNomeAtributos
	 * @param array $arrColunasBd
	 * @param array $arrResumoAtributos
	 * @param array $arrAtributosPk
	 * @return void
	 */
	public function cadastrarClasses($intSistemaId, $strNome, $strResumo, $strAutor, $strTabelaBd, $bolNovaVersao, $strNameSpace, $arrTipoAtributos, $arrNomeAtributos, $arrResumoAtributos, $arrColunasBd, $arrAtributosPk) {
		
		// Obtendo uma instância da conexão
		$objConexao = ConexaoBDR::getInstancia("sistema");
		$objPDO     = $objConexao->getConexao();
		
		try {
			// Iniciando a transação
			$objPDO->beginTransaction();
			
			// Cadastrando as classes
			$objControladorClasse = new ControladorClasse($this->objRepositorioClasse, $this->objRepositorioAtributo, $this->objRepositorioMetodo, $this->objRepositorioParametro, $this->objRepositorioIntface, $this->objRepositorioThrows);
			
			// Definindo os valores padrões
			$strDescricao	= "";
			$strPacote		= "";
			$strSubpacote	= "";
			$objControladorClasse->cadastrar($intSistemaId, $strNome, $strResumo, $strDescricao, $strAutor, $strPacote, $strSubpacote, $strTabelaBd, $bolNovaVersao, $strNameSpace, $arrTipoAtributos, $arrNomeAtributos, $arrResumoAtributos, $arrColunasBd, $arrAtributosPk);
			
			// Comprometendo os dados
			$objPDO->commit();
		}
		catch (Exception $ex) {
			
			// Em caso de exceção, desfazer
			$objPDO->rollBack();
			throw $ex;
		}
	}
	
	/**
	 * Método que atualiza todas as classes da classe especificada
	 *
	 * @access public
	 * @param int $intSistemaIdAtual
	 * @param string $strSubpacoteAtual
	 * @param int $intSistemaId
	 * @param string $strNomeClasse
	 * @param string $strTabelaBd
	 * @param string $strResumoClasse
	 * @param string $strAutorClasse
	 * @param array $arrTipoAtributos
	 * @param array $arrNomeAtributos
	 * @param array $arrColunasBd
	 * @param array $arrResumoAtributos
	 * @param array $arrAtributosPk
	 * @return void
	 */
	public function atualizarClasses($intSistemaIdAtual, $strSubpacoteAtual, $intSistemaId, $strNome, $strResumo, $strAutor, $strTabelaBd, $bolNovaVersao, $strNameSpace, $arrTipoAtributos, $arrNomeAtributos, $arrResumoAtributos, $arrColunasBd, $arrAtributosPk) {
		
		// Obtendo uma instância da conexão
		$objConexao = ConexaoBDR::getInstancia("sistema");
		$objPDO     = $objConexao->getConexao();
		
		try {
			// Iniciando a transação
			$objPDO->beginTransaction();
			
			// Cadastrando as classes
			$objControladorClasse = new ControladorClasse($this->objRepositorioClasse, $this->objRepositorioAtributo, $this->objRepositorioMetodo, $this->objRepositorioParametro, $this->objRepositorioIntface, $this->objRepositorioThrows);
			
			// Definindo os valores padrões
			$strDescricao	= "";
			$strPacote		= "";
			$strSubpacote	= "";
			$objControladorClasse->atualizar($intSistemaIdAtual, $strSubpacoteAtual, $intSistemaId, $strNome, $strResumo, $strDescricao, $strAutor, $strPacote, $strSubpacote, $strTabelaBd, $bolNovaVersao, $strNameSpace, $arrTipoAtributos, $arrNomeAtributos, $arrResumoAtributos, $arrColunasBd, $arrAtributosPk);
			
			// Comprometendo os dados
			$objPDO->commit();
		}
		catch (Exception $ex) {
			
			// Em caso de exceção, desfazer
			$objPDO->rollBack();
			throw $ex;
		}
	}
	
	/**
	 * Método que exclui a classe especificada
	 *
	 * @access public
	 * @return array
	 */
	public function excluirClasse($intSistemaId, $strNome) {
		
		// Obtendo uma instância da conexão
		$objConexao = ConexaoBDR::getInstancia("sistema");
		$objPDO     = $objConexao->getConexao();
		
		try {
			// Iniciando a transação
			$objPDO->beginTransaction();
			
			// Cadastrando as classes
			$objControladorClasse = new ControladorClasse($this->objRepositorioClasse, $this->objRepositorioAtributo, $this->objRepositorioMetodo, $this->objRepositorioParametro, $this->objRepositorioIntface, $this->objRepositorioThrows);
			
			// Definindo os valores padrões
			$objControladorClasse->excluir($intSistemaId, $strNome);
			
			// Comprometendo os dados
			$objPDO->commit();
		}
		catch (Exception $ex) {
			
			// Em caso de exceção, desfazer
			$objPDO->rollBack();
			throw $ex;
		}
	}
	
	/**
	 * Método que exclui todas as classes do SistemaId especificado
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @return array
	 */
	public function excluirClassesPorSistemaId($intSistemaId) {
		
		// Obtendo uma instância da conexão
		$objConexao = ConexaoBDR::getInstancia("sistema");
		$objPDO     = $objConexao->getConexao();
		
		try {
			// Iniciando a transação
			$objPDO->beginTransaction();
			
			// Cadastrando as classes
			$objControladorClasse = new ControladorClasse($this->objRepositorioClasse, $this->objRepositorioAtributo, $this->objRepositorioMetodo, $this->objRepositorioParametro, $this->objRepositorioIntface, $this->objRepositorioThrows);
			
			// Definindo os valores padrões
			$objControladorClasse->excluirPorSistemaId($intSistemaId);
			
			// Comprometendo os dados
			$objPDO->commit();
		}
		catch (Exception $ex) {
			
			// Em caso de exceção, desfazer
			$objPDO->rollBack();
			throw $ex;
		}
	}
	
	/**
	 * Método que exclui todas as classes do SistemaId e Subpacote especificado
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @param string $strSubpacote
	 * @return array
	 */
	public function excluirClassesPorSistemaIdPorSubpacote($intSistemaId, $strSubpacote) {
		
		// Obtendo uma instância da conexão
		$objConexao = ConexaoBDR::getInstancia("sistema");
		$objPDO     = $objConexao->getConexao();
		
		try {
			// Iniciando a transação
			$objPDO->beginTransaction();
			
			// Cadastrando as classes
			$objControladorClasse = new ControladorClasse($this->objRepositorioClasse, $this->objRepositorioAtributo, $this->objRepositorioMetodo, $this->objRepositorioParametro, $this->objRepositorioIntface, $this->objRepositorioThrows);
			
			// Definindo os valores padrões
			$objControladorClasse->excluirPorSistemaIdPorSubpacote($intSistemaId, $strSubpacote);
			
			// Comprometendo os dados
			$objPDO->commit();
		}
		catch (Exception $ex) {
			
			// Em caso de exceção, desfazer
			$objPDO->rollBack();
			throw $ex;
		}
	}
	
	/**
	 * Método que lista todos os sistemas cadastrados
	 *
	 * @access public
	 * @return array
	 */
	public function listarSistemas() {
		$objControladorSistema = new ControladorSistemas($this->objRepositorioSistema);
		return $objControladorSistema->listar();
	}
	
	/**
	 * Método que retorna o objeto sistema do código especificado
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @return array
	 */
	public function procurarSistema($intSistemaId) {
		$objControladorSistema = new ControladorSistemas($this->objRepositorioSistema);
		return $objControladorSistema->procurar($intSistemaId);
	}
	
	/**
	 * Método que retorna o objeto da classe especificada
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @param string $strNome
	 * @return array
	 */
	public function procurarClasse($intSistemaId, $strNome) {
		$objControladorClasse = new ControladorClasse($this->objRepositorioClasse, $this->objRepositorioAtributo, $this->objRepositorioMetodo, $this->objRepositorioParametro, $this->objRepositorioIntface, $this->objRepositorioThrows);
		return $objControladorClasse->procurar($intSistemaId, $strNome);
	}
	
	
	public function recriarClassesPorSistemaIdPorSubpacote($intSistemaId, $strSubpacote) {
		
		// Obtendo uma instância da conexão
		$objConexao = ConexaoBDR::getInstancia("sistema");
		$objPDO     = $objConexao->getConexao();
		
		try {
			// Iniciando a transação
			$objPDO->beginTransaction();
			
			// Inicializando o controlador de classes
			$objControladorClasse = new ControladorClasse($this->objRepositorioClasse, $this->objRepositorioAtributo, $this->objRepositorioMetodo, $this->objRepositorioParametro, $this->objRepositorioIntface, $this->objRepositorioThrows);
			
			// Recriando todas as classes geradas apartir do SistemaId e Subpacote especificados
			$objControladorClasse->recriarClassesPorSistemaIdPorSubpacote($intSistemaId, $strSubpacote);
			
			// Comprometendo os dados
			$objPDO->commit();
		}
		catch (Exception $ex) {
			
			// Em caso de exceção, desfazer
			$objPDO->rollBack();
			throw $ex;
		}
	}
}
