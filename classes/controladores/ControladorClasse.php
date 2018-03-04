<?php
/**
 * Classe que irá controlar todas as classes
 * 
 * @author Marcelo Burégio
 * @subpackage controladores
 * @version 1.0
 * @since 22/10/2008 13:58:19
 */
class ControladorClasse {
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
	 * RepositórioBDR de classes Throws
	 *
	 * @access private
	 * @var IRepositorioThrows
	 */
	private $objRepositorioThrows;
	
	/**
	 * Cadastro de classes Classe
	 *
	 * @access private
	 * @var CadastroClasse
	 */
	private $objCadastroClasse;
	
	/**
	 * Cadastro de classes Atributo
	 *
	 * @access private
	 * @var CadastroAtributo
	 */
	private $objCadastroAtributo;
	
	/**
	 * Cadastro de classes Metodo
	 *
	 * @access private
	 * @var CadastroMetodo
	 */
	private $objCadastroMetodo;
	
	/**
	 * Cadastro de classes Parametro
	 *
	 * @access private
	 * @var CadastroParametro
	 */
	private $objCadastroParametro;
	
	/**
	 * Cadastro de classes Intface
	 *
	 * @access private
	 * @var CadastroIntface
	 */
	private $objCadastroIntface;
	
	
	/**
	 * Cadastro de classes Throws
	 *
	 * @access private
	 * @var CadastroThrows
	 */
	private $objCadastroThrows;
	
	/**
	 * Método construtor da classe
	 * 
	 * @access public
	 * @param IRepositorioClasse $objRepositorioClasse
	 * @param IRepositorioAtributo $objRepositorioAtributo
	 * @param IRepositorioMetodo $objRepositorioMetodo
	 * @param IRepositorioParametro $objRepositorioParametro
	 * @param IRepositorioIntface $objRepositorioIntface
	 * @param IRepositorioThrows $objRepositorioThrows
	 */
	public function __construct(IRepositorioClasse $objRepositorioClasse, IRepositorioAtributo $objRepositorioAtributo, IRepositorioMetodo $objRepositorioMetodo, IRepositorioParametro $objRepositorioParametro, IRepositorioIntface $objRepositorioIntface, IRepositorioThrows $objRepositorioThrows) {
		$this->objRepositorioClasse			= $objRepositorioClasse;
		$this->objRepositorioAtributo		= $objRepositorioAtributo;
		$this->objRepositorioMetodo			= $objRepositorioMetodo;
		$this->objRepositorioParametro	= $objRepositorioParametro;
		$this->objRepositorioIntface		= $objRepositorioIntface;
		$this->objRepositorioThrows			= $objRepositorioThrows;
		
		// Iniciando os cadastros
		$this->objCadastroClasse    = new CadastroClasse($this->objRepositorioClasse);
		$this->objCadastroAtributo  = new CadastroAtributo($this->objRepositorioAtributo);
		$this->objCadastroMetodo    = new CadastroMetodo($this->objRepositorioMetodo);
		$this->objCadastroParametro = new CadastroParametro($this->objRepositorioParametro);
		$this->objCadastroIntface   = new CadastroIntface($this->objRepositorioIntface);
		$this->objCadastroThrows    = new CadastroThrows($this->objRepositorioThrows);
	}
	
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * 
	 * Métodos de Cadastro
	 * 
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	
	
	/**
	 * Método que cria e cadastra todas as classe e todos os seus elementos no banco de dados
	 * 
	 * @access public
	 * @param int $intSistemaId
	 * @param string $strNome
	 * @param string $strResumo
	 * @param string $strDescricao
	 * @param string $strAutor
	 * @param string $strPacote
	 * @param string $strSubPacote
	 * @param string $strTabelaBd
	 * @param boolean $bolNovaVersao
	 * @param string $strNameSpace
	 * @param array $arrTipoAtributos
	 * @param array $arrNomeAtributos
	 * @param array $arrResumoAtributos
	 * @param array $arrColunasBd
	 * @param array $arrAtributosPk
	 * @return void
	 */
	public function cadastrar($intSistemaId, $strNome, $strResumo, $strDescricao, $strAutor, $strPacote, $strSubPacote, $strTabelaBd, $bolNovaVersao, $strNameSpace, $arrTipoAtributos, $arrNomeAtributos, $arrResumoAtributos, $arrColunasBd, $arrAtributosPk) {
		
		// Convertendo os dados evitando o Sql Injection
		$intSistemaId				= (int) $intSistemaId;
		$strNome						= (string) str_replace("'", "`", trim($strNome));
		$strResumo					= (string) str_replace("'", "`", trim($strResumo));
		$strDescricao				= (string) str_replace("'", "`", trim($strDescricao));
		$strAutor						= (string) str_replace("'", "`", trim($strAutor));
		$strPacote					= (string) str_replace("'", "`", trim($strPacote));
		$strSubPacote				= (string) str_replace("'", "`", trim($strSubPacote));
		$strTabelaBd				= (string) str_replace("'", "`", trim($strTabelaBd));
		$bolNovaVersao				= (boolean) $bolNovaVersao;
		$strNameSpace				= (string) str_replace("'", "`", trim($strNameSpace));
		$arrTipoAtributos		= (array) $arrTipoAtributos;
		$arrNomeAtributos		= (array) $arrNomeAtributos;
		$arrResumoAtributos	= (array) $arrResumoAtributos;
		$arrColunasBd				= (array) $arrColunasBd;
		$arrAtributosPk			= (array) $arrAtributosPk;
		
		// Convertendo os arrays
		foreach ($arrTipoAtributos		as $intKey => $strTipoAtributo)		$arrTipoAtributos[$intKey]		= (string) str_replace("'", "`", trim($strTipoAtributo));
		foreach ($arrNomeAtributos		as $intKey => $strNomeAtributo)		$arrNomeAtributos[$intKey]		= (string) str_replace("'", "`", trim($strNomeAtributo));
		foreach ($arrResumoAtributos	as $intKey => $strResumoAtributo)	$arrResumoAtributos[$intKey]	= (string) str_replace("'", "`", trim($strResumoAtributo));
		foreach ($arrColunasBd				as $intKey => $strColunaBd)				$arrColunasBd[$intKey]				= (string) str_replace("'", "`", trim($strColunaBd));
		foreach ($arrAtributosPk			as $intKey => $strAtributoPk)			$arrAtributosPk[$intKey]			= (string) str_replace("'", "`", trim($strAtributoPk));
		
		// Validando os dados
		if ($intSistemaId <= 0)					throw new Exception("Código SistemaId inválido");
		if (empty($strNome))						throw new Exception("Nome da Classe não pode ser vazio");
		if (empty($strResumo))					throw new Exception("Resumo da Classe não pode ser vazio");
		if (empty($strAutor))						throw new Exception("Autor da Classe não pode ser vazio");
		if (empty($strTabelaBd))				throw new Exception("Tabela da Classe não pode ser vazio");
		if (empty($arrTipoAtributos))		throw new Exception("Tipo dos atributos não pode ser vazio");
		if (empty($arrNomeAtributos))		throw new Exception("Nome dos atributos não pode ser vazio");
		if (empty($arrResumoAtributos))	throw new Exception("Resumo dos atributos não pode ser vazio");
		if (empty($arrColunasBd))				throw new Exception("Coluna BDR dos atributos não pode ser vazio");
		if (empty($arrAtributosPk))			throw new Exception("Chave primária (PK) dos atributos não pode ser vazio");
		
		// Validando os atributos
		foreach ($arrTipoAtributos		as $intKey => $strTipoAtributo) {
			if (empty($strTipoAtributo))		throw new Exception("Tipo do atributo ". ($intKey+1) ." não pode ser vazio");
		}
		foreach ($arrNomeAtributos		as $intKey => $strNomeAtributo) {
			if (empty($strNomeAtributo))		throw new Exception("Nome do atributo ". ($intKey+1) ." não pode ser vazio");
		}
		foreach ($arrResumoAtributos	as $intKey => $strResumoAtributo) {
			if (empty($strResumoAtributo))	throw new Exception("Resumo do atributo ". ($intKey+1) ." não pode ser vazio");
		}
		foreach ($arrColunasBd				as $intKey => $strColunaBd) {
			if (empty($strColunaBd))				throw new Exception("Coluna BDR do atributo ". ($intKey+1) ." não pode ser vazio");
		}
		
		// Cadastrando a Classe Básica
		$objClasseBasica = $this->criarClasseBasica($intSistemaId, $strNome, $strResumo, $strDescricao, $strAutor, $strPacote, $strSubPacote, $strTabelaBd, $bolNovaVersao, $strNameSpace, $arrTipoAtributos, $arrNomeAtributos, $arrResumoAtributos, $arrColunasBd, $arrAtributosPk);
		
		// Cadastranto todas as classes
		$this->cadastrarTodasAsClasses($objClasseBasica);
	}
	
	/**
	 * Método que cadastra a classe e todos os seus elementos no banco de dados
	 * 
	 * @access private
	 * @param Classe $objClasse
	 * @return void
	 */
	private function cadastrarClasse(Classe $objClasse) {
		
		// Cadastrando a classe
		$intClasseId = $this->objCadastroClasse->cadastrar($objClasse);
		$objClasse->setClasseId($intClasseId);
		
		// Cadastrando as interfaces (caso existam)
		foreach ($objClasse->getIntfaces() as $objIntface) {
			$intIntfaceId = $this->objCadastroIntface->cadastrar($objIntface);
			$objIntface->setIntfaceId($intIntfaceId);
		}
		
		// Cadastrando os atributos
		foreach ($objClasse->getAtributos() as $objAtributo) {
			$intAtributoId = $this->objCadastroAtributo->cadastrar($objAtributo);
			$objAtributo->setAtributoId($intAtributoId);
		}
		
		// Cadastrando os métodos
		foreach ($objClasse->getMetodos() as $objMetodo) {
			$intMetodoId = $this->objCadastroMetodo->cadastrar($objMetodo);
			$objMetodo->setMetodoId($intMetodoId);
			
			// Cadastrando os parametros
			foreach($objMetodo->getParametros() as $objParametro) {
				$intParametroId = $this->objCadastroParametro->cadastrar($objParametro);
				$objParametro->setParametroId($intParametroId);
			}
			
			// Cadastrando os throws
			foreach($objMetodo->getThrows() as $objThrows) {
				$intThrowsId = $this->objCadastroThrows->cadastrar($objThrows);
				$objThrows->setThrowsId($intThrowsId);
			}
		}
	}
	
	/**
	 * Método que recadastra a classe e todos os seus elementos no banco de dados
	 * 
	 * @access private
	 * @param Classe $objClasse
	 * @return void
	 */
	public function recriarClassesPorSistemaIdPorSubpacote($intSistemaId, $strSubpacote) {
		
		// Listando todas as classes do subpacote
		$arrObjClasse = $this->listarPorSistemaIdPorSubpacote($intSistemaId, $strSubpacote);
		
		// Verificando se existem classes
		if (!empty($arrObjClasse) && is_array($arrObjClasse)) {
			
			// Localizando a classe básica
			foreach ($arrObjClasse as $objClasse) {
				if ($strSubpacote == strtolower($objClasse->getNome())) {
					$objClasseBasica = $objClasse;
					break;
				}
			}
			
			// Excluindo a classe atual e todas as suas classes (subpacote)
			$this->excluirPorSistemaIdPorSubpacote($intSistemaId, strtolower($strSubpacote));
			
			// Recriando todas as classes baseado na classe básica
			$this->cadastrarTodasAsClasses($objClasseBasica);
		}
	}
	
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * 
	 * Métodos de Edição
	 * 
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	
	
	/**
	 * Método que atualiza todas as classe e todos os seus elementos no banco de dados
	 * 
	 * @access public
	 * @param int $intSistemaIdAtual
	 * @param string $strSubpacoteAtual
	 * @param int $intSistemaId
	 * @param string $strNome
	 * @param string $strResumo
	 * @param string $strDescricao
	 * @param string $strAutor
	 * @param string $strPacote
	 * @param string $strSubPacote
	 * @param string $strTabelaBd
	 * @param boolean $bolNovaVersao
	 * @param string $strNameSpace
	 * @param array $arrTipoAtributos
	 * @param array $arrNomeAtributos
	 * @param array $arrResumoAtributos
	 * @param array $arrColunasBd
	 * @param array $arrAtributosPk
	 * @return void
	 */
	public function atualizar($intSistemaIdAtual, $strSubpacoteAtual, $intSistemaId, $strNome, $strResumo, $strDescricao, $strAutor, $strPacote, $strSubPacote, $strTabelaBd, $bolNovaVersao, $strNameSpace, $arrTipoAtributos, $arrNomeAtributos, $arrResumoAtributos, $arrColunasBd, $arrAtributosPk) {
		
		// Convertendo os dados evitando o Sql Injection
		$intSistemaIdAtual	= (int) $intSistemaIdAtual;
		$strSubpacoteAtual	= (string) str_replace("'", "`", trim($strSubpacoteAtual));
		
		$intSistemaId				= (int) $intSistemaId;
		$strNome						= (string) str_replace("'", "`", trim($strNome));
		$strResumo					= (string) str_replace("'", "`", trim($strResumo));
		$strDescricao				= (string) str_replace("'", "`", trim($strDescricao));
		$strAutor						= (string) str_replace("'", "`", trim($strAutor));
		$strPacote					= (string) str_replace("'", "`", trim($strPacote));
		$strSubPacote				= (string) str_replace("'", "`", trim($strSubPacote));
		$strTabelaBd				= (string) str_replace("'", "`", trim($strTabelaBd));
		$bolNovaVersao				= (boolean) $bolNovaVersao;
		$strNameSpace				= (string) str_replace("'", "`", trim($strNameSpace));
		$arrTipoAtributos		= (array) $arrTipoAtributos;
		$arrNomeAtributos		= (array) $arrNomeAtributos;
		$arrResumoAtributos	= (array) $arrResumoAtributos;
		$arrColunasBd				= (array) $arrColunasBd;
		$arrAtributosPk			= (array) $arrAtributosPk;
		
		// Convertendo os arrays
		foreach ($arrTipoAtributos		as $intKey => $strTipoAtributo)		$arrTipoAtributos[$intKey]		= (string) str_replace("'", "`", trim($strTipoAtributo));
		foreach ($arrNomeAtributos		as $intKey => $strNomeAtributo)		$arrNomeAtributos[$intKey]		= (string) str_replace("'", "`", trim($strNomeAtributo));
		foreach ($arrResumoAtributos	as $intKey => $strResumoAtributo)	$arrResumoAtributos[$intKey]	= (string) str_replace("'", "`", trim($strResumoAtributo));
		foreach ($arrColunasBd				as $intKey => $strColunaBd)				$arrColunasBd[$intKey]				= (string) str_replace("'", "`", trim($strColunaBd));
		foreach ($arrAtributosPk			as $intKey => $strAtributoPk)			$arrAtributosPk[$intKey]			= (string) str_replace("'", "`", trim($strAtributoPk));
		
		// Validando os dados
		if ($intSistemaIdAtual <= 0)		throw new Exception("Código SistemaId Atual inválido");
		if (empty($strSubpacoteAtual))	throw new Exception("Nome do SubPacote Atual não pode ser vazio");
		
		if ($intSistemaId <= 0)					throw new Exception("Código SistemaId inválido");
		if (empty($strNome))						throw new Exception("Nome da Classe não pode ser vazio");
		if (empty($strResumo))					throw new Exception("Resumo da Classe não pode ser vazio");
		if (empty($strAutor))						throw new Exception("Autor da Classe não pode ser vazio");
		if (empty($strTabelaBd))				throw new Exception("Tabela da Classe não pode ser vazio");
		if (empty($arrTipoAtributos))		throw new Exception("Tipo dos atributos não pode ser vazio");
		if (empty($arrNomeAtributos))		throw new Exception("Nome dos atributos não pode ser vazio");
		if (empty($arrResumoAtributos))	throw new Exception("Resumo dos atributos não pode ser vazio");
		if (empty($arrColunasBd))				throw new Exception("Coluna BDR dos atributos não pode ser vazio");
		if (empty($arrAtributosPk))			throw new Exception("Chave primária (PK) dos atributos não pode ser vazio");
		
		// Validando os atributos
		foreach ($arrTipoAtributos		as $intKey => $strTipoAtributo) {
			if (empty($strTipoAtributo))		throw new Exception("Tipo do atributo ". ($intKey+1) ." não pode ser vazio");
		}
		foreach ($arrNomeAtributos		as $intKey => $strNomeAtributo) {
			if (empty($strNomeAtributo))		throw new Exception("Nome do atributo ". ($intKey+1) ." não pode ser vazio");
		}
		foreach ($arrResumoAtributos	as $intKey => $strResumoAtributo) {
			if (empty($strResumoAtributo))	throw new Exception("Resumo do atributo ". ($intKey+1) ." não pode ser vazio");
		}
		foreach ($arrColunasBd				as $intKey => $strColunaBd) {
			if (empty($strColunaBd))				throw new Exception("Coluna BDR do atributo ". ($intKey+1) ." não pode ser vazio");
		}
		
		// Excluindo todas as classes do pacote anterior
		$this->excluirPorSistemaIdPorSubpacote($intSistemaIdAtual, $strSubpacoteAtual);
		
		// Cadastrando a Classe Básica
		$objClasseBasica = $this->criarClasseBasica($intSistemaId, $strNome, $strResumo, $strDescricao, $strAutor, $strPacote, $strSubPacote, $strTabelaBd, $bolNovaVersao, $strNameSpace, $arrTipoAtributos, $arrNomeAtributos, $arrResumoAtributos, $arrColunasBd, $arrAtributosPk);
		
		// Cadastranto todas as classes
		$this->cadastrarTodasAsClasses($objClasseBasica);
	}
	
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * 
	 * Métodos de Exclusão
	 * 
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	
	
	/**
	 * Método privado que exclui a classe, interfaces, atributos, métodos e parametros
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @param string $strNome
	 * @return void
	 */
	public function excluir($intSistemaId, $strNome) {
		$objClasse = $this->procurar($intSistemaId, $strNome);
		$this->excluirClasse($objClasse);
	}
	
	/**
	 * Método privado que exclui todas as classes, interfaces, atributos, métodos e parametros
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @return void
	 */
	public function excluirPorSistemaId($intSistemaId) {
		$arrObjClasses = $this->listarPorSistemaId($intSistemaId);
		foreach ($arrObjClasses as $objClasse) $this->excluirClasse($objClasse);
	}
	
	public function excluirPorSistemaIdPorSubpacote($intSistemaId, $strSubpacote) {
		$arrObjClasses = $this->listarPorSistemaIdPorSubpacote($intSistemaId, $strSubpacote);
		foreach ($arrObjClasses as $objClasse) $this->excluirClasse($objClasse);
	}
	
	/**
	 * Método que exclui a classe, interfaces, atributos, métodos e parametros
	 *
	 * @access public
	 * @param Classe $objClasses
	 * @return void
	 */
	private function excluirClasse(Classe $objClasse) {
		
		// Excluindo os métodos
		foreach ($objClasse->getMetodos() as $objMetodo) {
			
			// Excluindo os parametros
			foreach($objMetodo->getParametros() as $objParametro) {
				$this->objCadastroParametro->remover($objParametro->getMetodoId(), $objParametro->getNome());
			}
			
			// Excluindo as exceções (throws)
			foreach($objMetodo->getThrows() as $objThrows) {
				$this->objCadastroThrows->remover($objThrows->getMetodoId(), $objThrows->getNome());
			}
			
			$this->objCadastroMetodo->remover($objMetodo->getClasseId(), $objMetodo->getNome());
		}
		
		// Excluindo os atributos
		foreach ($objClasse->getAtributos() as $objAtributo) {
			$this->objCadastroAtributo->remover($objAtributo->getClasseId(), $objAtributo->getNome());
		}
		
		// Excluindo as interfaces
		foreach ($objClasse->getIntfaces() as $objIntface) {
			$this->objCadastroIntface->remover($objIntface->getClasseId(), $objIntface->getIntfaceId());
		}
		
		// Excluindo a classe
		$this->objCadastroClasse->remover($objClasse->getSistemaId(), $objClasse->getNome());
	}
	
	
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * 
	 * Métodos de Busca / Listagem
	 * 
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	
	
	/**
	 * Método que procura uma determinada classe e retorna ela populada
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @param string $strNome
	 * @return Classe
	 */
	public function procurar($intSistemaId, $strNome) {
		
		// Listando as classes do SistemaId
		$objClasse = $this->objCadastroClasse->procurar($intSistemaId, $strNome);
		
		// Populando a classe com os atributos, métodos e parâmetros
		$this->popular($objClasse);
		
		// Retornando a classe
		return $objClasse;
	}
	
	/**
	 * Método que lista todas as classes do SistemaId especificado
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @return string
	 */
	public function listarPorSistemaId($intSistemaId) {
		
		// Listando as classes do SistemaId
		$arrObjClasses = $this->objCadastroClasse->listarPorSistemaId($intSistemaId);
		
		// Populando as classes com os atributos, métodos e parâmetros
		foreach ($arrObjClasses as $objClasse) $this->popular($objClasse);
		
		// Retornando o array de classes
		return $arrObjClasses;
	}
	
	/**
	 * Método que lista todas as classes do SistemaId e Subpacote especificado
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @param string $strSubpacote
	 * @return string
	 */
	public function listarPorSistemaIdPorSubpacote($intSistemaId, $strSubpacote) {
		
		// Listando as classes do SistemaId
		$arrObjClasses = $this->objCadastroClasse->listarPorSistemaIdPorSubpacote($intSistemaId, $strSubpacote);
		
		// Populando as classes com os atributos, métodos e parâmetros
		foreach ($arrObjClasses as $objClasse) $this->popular($objClasse);
		
		// Retornando o array de classes
		return $arrObjClasses;
	}
	
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * 
	 * Métodos Auxiliares
	 * 
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	
	
	/**
	 * Método que cadastra todas as classes que serão criadas pela classe básica especificada
	 *
	 * @access public
	 * @param Classe $objClasseBasica
	 * @return void
	 */
	private function cadastrarTodasAsClasses(Classe $objClasseBasica) {
		
		// Cadastrando a Classe Básica
		$this->cadastrarClasse($objClasseBasica);
		
		// Cadastrando a Classe Cadastro
		if (!$objClasseBasica->getNovaVersao()) {
			$objClasseCadastro = $this->criarClasseCadastro($objClasseBasica);
			$this->cadastrarClasse($objClasseCadastro);
		}
		
		// Cadastrando a Interface
		$objInterface = $this->criarInterfaceRepositorio($objClasseBasica);
		$this->cadastrarClasse($objInterface);
		
		// Cadastrando a Classe Repositório
		$objClasseRepositorio = $this->criarClasseRepositorioBDR($objClasseBasica, $objInterface);
		$this->cadastrarClasse($objClasseRepositorio);
		
		// Cadastrando a JaCadastradaException
		$objJaCadastradaException = $this->criarJaCadastradaException($objClasseBasica);
		$this->cadastrarClasse($objJaCadastradaException);
		
		// Cadastrando a NaoCadastradoException
		$objNaoCadastradoException = $this->criarNaoCadastradoException($objClasseBasica);
		$this->cadastrarClasse($objNaoCadastradoException);
	}
	
	/**
	 * Método privado que recebe um objeto Classe e popula ele com os seus atributos, métodos e parâmetros
	 *
	 * @access public
	 * @param Classe $objClasses
	 * @return void
	 */
	private function popular(Classe $objClasse) {
		
		// Listando as interfaces da classe
		$arrObjIntfaces = $this->objCadastroIntface->listarPorClasseId( $objClasse->getClasseId() );
		$objClasse->setIntfaces( $arrObjIntfaces );
		
		// Definindo os atributos da classe
		$objClasse->setAtributos( $this->objCadastroAtributo->listarPorClasseIdOrdenado( $objClasse->getClasseId() ) );
		
		// Listando todos os métodos da classe
		$arrObjMetodos = $this->objCadastroMetodo->listarPorClasseIdOrdenado( $objClasse->getClasseId() );
		
		// Definindo os parâmetros e throws dos métodos
		foreach ($arrObjMetodos as $objMetodo) {
			$objMetodo->setParametros( $this->objCadastroParametro->listarPorMetodoIdOrdenado( $objMetodo->getMetodoId() ) );
			$objMetodo->setThrows( $this->objCadastroThrows->listarPorMetodoIdOrdenado( $objMetodo->getMetodoId() ) );
		}
		
		// Definindo os métodos da classe
		$objClasse->setMetodos( $arrObjMetodos );
	}
	
	
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * 
	 * Métodos que criam: classes básicas, interfaces, cadastros e repositorios
	 * 
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	
	
	
	/**
	 * Método que cria a classe básica com todos os seus elementos associados
	 * 
	 * @access public
	 * @param int $intSistemaId
	 * @param string $strNome
	 * @param string $strResumo=""
	 * @param string $strDescricao=""
	 * @param string $strAutor=""
	 * @param string $strPacote=""
	 * @param string $strSubPacote=""
	 * @param string $strTabelaBd=""
	 * @param boolean $bolNovaVersao=false
	 * @param string $strNameSpace=""
	 * @param array $arrTipoAtributos=array()
	 * @param array $arrNomeAtributos=array()
	 * @param array $arrResumoAtributos=array()
	 * @param array $arrColunasBd=array()
	 * @param array $arrAtributosPk=array()
	 * @return Classe
	 */
	public function criarClasseBasica($intSistemaId, $strNome, $strResumo="", $strDescricao="", $strAutor="", $strPacote="", $strSubPacote="", $strTabelaBd="", $bolNovaVersao=false, $strNameSpace="", $arrTipoAtributos=array(), $arrNomeAtributos=array(), $arrResumoAtributos=array(), $arrColunasBd=array(), $arrAtributosPk=array()) {
		
		// Gerando a Classe Básica
		$intSistemaId		= (int) $intSistemaId;
		$intClasseId		= (int) 0;
		$strNomeClasse				= (string) ucfirst($strNome);
		$strTipo				= (string) "CL";
		$strTipoCamada	= (string) "CB";
		$strResumo			= (string) $strResumo;
		$strDescricao		= (string) $strDescricao;
		$strAutor				= (string) $strAutor;
		$strPacote			= (string) $strPacote;
		$strSubPacote		= (string) ($bolNovaVersao) ? $strNomeClasse : strtolower($strNomeClasse);
		$strVersao			= (string) "1.0";
		$strCriadoEm		= (string) date("Y-m-d H:i:s");
		$strTabelaBd		= (string) $strTabelaBd;
		$bolNovaVersao		= (boolean) $bolNovaVersao;
		$strNameSpace		= (string) $strNameSpace;
		$objClasse			= new Classe($intSistemaId, $intClasseId, $strNomeClasse, $strTipo, $strTipoCamada, $strResumo, $strDescricao, $strAutor, $strPacote, $strSubPacote, $strVersao, $strCriadoEm, $strTabelaBd, $bolNovaVersao, $strNameSpace);
		
		if (!empty($arrNomeAtributos)) {
			// Gerando todos os Atributos da Classe
			foreach ($arrNomeAtributos as $intKey => $strNomeAtributo) {
				$intClasseId		= (int) 0;
				$intAtributoId	= (int) 0;
				$strNome				= (string) $strNomeAtributo;
				$strAcesso			= (string) "private";
				$strTipo				= (string) $arrTipoAtributos[ $intKey ];
				$strResumo			= (string) $arrResumoAtributos[ $intKey ];
				$strDescricao		= (string) "";
				$strColunaBd		= (string) $arrColunasBd[ $intKey ];
				$bolChavePk			= (boolean) $arrAtributosPk[ $intKey ];
				$intOrdem			= (int) 0;
				$objAtributo		= new Atributo($intClasseId, $intAtributoId, $strNome, $strAcesso, $strTipo, $strResumo, $strDescricao, $strColunaBd, $bolChavePk, $intOrdem);
				$objClasse->adicionarAtributo($objAtributo);
			}
			
			// Gerando o método construtor
			$intClasseId	= (int) 0;
			$intMetodoId	= (int) 0;
			$strNome			= (string) "__construct";
			$strAcesso		= (string) "public";
			$strRetorno		= (string) "";
			$strResumo		= (string) "Método construtor da classe";
			$strDescricao	= (string) "";
			$intOrdem		= (int) 0;
			
			// Definindo o conteúdo do construtor
			$strConteudo = "";
			foreach ($objClasse->getAtributos() as $objAtributo) {
				$strNomeId    = ucfirst($objAtributo->getNome());
				$strConteudo .= '$this->set'. $strNomeId .'($'. Util::tipoAbreviado($objAtributo->getTipo()) . $strNomeId .');'."\r\n";
			}
			$objMetodo = new Metodo($intClasseId, $intMetodoId, $strNome, $strAcesso, $strRetorno, $strConteudo, $strResumo, $strDescricao, $intOrdem);
			$objClasse->adicionarMetodo($objMetodo);
			
			// Definindo os parametros do construtor
			foreach ($objClasse->getAtributos() as $objAtributo) {
				$intMetodoId		= (int) 0;
				$intParametroId	= (int) 0;
				$strNome				= (string) $objAtributo->getNome();
				$strTipo				= (string) $objAtributo->getTipo();
				$strValorPadrao			= (string) "";
				$intOrdem				= (int) 0;
				// Valor Padrao Vazio
				switch ($strTipo) {
					case "boolean"	: $strValorPadrao = 'false'; break;
					case "string"	: $strValorPadrao = '""'; break;
					case "float"	: 
					case "int"		: $strValorPadrao = '0'; break;
					case "array"	: $strValorPadrao = 'array()'; break;
					default			: $strValorPadrao = 'null';
				}
				$objParametro		= new Parametro($intMetodoId, $intParametroId, $strNome, $strTipo, $strValorPadrao, $intOrdem);
				$objMetodo->adicionarParametro($objParametro);
			}
			
			// Gerando os pares de metodos GET/SET
			foreach ($objClasse->getAtributos() as $objAtributo) {
				$strTipoAbreviado	= Util::tipoAbreviado($objAtributo->getTipo());
				$strNomeId				= ucfirst($objAtributo->getNome());
				
				// Gerando os Métodos GET
				$intClasseId	= (int) 0;
				$intMetodoId	= (int) 0;
				$strNome			= (string) "get". $strNomeId;
				$strAcesso		= (string) "public";
				$strRetorno		= (string) $objAtributo->getTipo();
				$strConteudo	= (string) 'return $this->'. $strTipoAbreviado . $strNomeId .';';
				$strResumo		= (string) 'Retorna o valor de <var>$this->'. $strTipoAbreviado . $strNomeId .'</var>';
				$strDescricao	= (string) "";
				$intOrdem		= (int) 0;
				$objMetodo		= new Metodo($intClasseId, $intMetodoId, $strNome, $strAcesso, $strRetorno, $strConteudo, $strResumo, $strDescricao, $intOrdem);
				$objClasse->adicionarMetodo($objMetodo);
				
				// Gerando os Métodos SET
				$intClasseId	= (int) 0;
				$intMetodoId	= (int) 0;
				$strNome		= (string) "set". $strNomeId;
				$strAcesso		= (string) "public";
				$strRetorno		= (string) $strNomeClasse;
				$strConteudo	= '$this->'. $strTipoAbreviado . $strNomeId .' = (' . $objAtributo->getTipo(). ') $'. $strTipoAbreviado . $strNomeId .";\r\n";
				$strConteudo	.= 'return $this;';
				$strResumo		= (string) 'Define o valor de <var>$this->'. $strTipoAbreviado . $strNomeId .'</var>';
				$strDescricao	= (string) "";
				$intOrdem		= (int) 0;
				$objMetodo		= new Metodo($intClasseId, $intMetodoId, $strNome, $strAcesso, $strRetorno, $strConteudo, $strResumo, $strDescricao, $intOrdem);
				$objClasse->adicionarMetodo($objMetodo);
				
				// Definindo o parametro do método SET
				$intMetodoId		= (int) 0;
				$intParametroId	= (int) 0;
				$strNome				= (string) $objAtributo->getNome();
				$strTipo				= (string) $objAtributo->getTipo();
				$strValorPadrao			= (string) "";
				$intOrdem				= (int) 0;
				$objParametro		= new Parametro($intMetodoId, $intParametroId, $strNome, $strTipo, $strValorPadrao, $intOrdem);
				$objMetodo->adicionarParametro($objParametro);
			}
			
			// Gerando o método equals()
			$intClasseId	= (int) 0;
			$intMetodoId	= (int) 0;
			$strNome			= (string) "equals";
			$strAcesso		= (string) "public";
			$strRetorno		= (string) "boolean";
			
			// Definindo o conteúdo do equals()
			$strConteudo = "";
			foreach ($objClasse->getAtributos() as $objAtributo) {
				$strNomeId    = ucfirst($objAtributo->getNome());
				if (!empty($strConteudo)) $strConteudo .= " &&\r\n	";
				$strConteudo .= '$this->'. Util::tipoAbreviado($objAtributo->getTipo()) . $strNomeId .' == $'. Util::tipoAbreviado("object") . $objClasse->getNome() .'->get'. $strNomeId .'()';
			}
			if (!empty($strConteudo)) $strConteudo = "if (". $strConteudo .") ";
			$strConteudo .= "return true;"."\r\n";
			$strConteudo .= "return false;";
			$strResumo		= (string) 'Método que compara um objeto passado por parametro com o próprio objeto';
			$strDescricao	= (string) "";
			$intOrdem		= (int) 0;
			$objMetodo		= new Metodo($intClasseId, $intMetodoId, $strNome, $strAcesso, $strRetorno, $strConteudo, $strResumo, $strDescricao, $intOrdem);
			$objClasse->adicionarMetodo($objMetodo);
			
			// Definindo o parametro do método equals()
			$intMetodoId		= (int) 0;
			$intParametroId	= (int) 0;
			$strNome				= (string) $objClasse->getNome();
			$strTipo				= (string) $objClasse->getNome();
			$strValorPadrao			= (string) "";
			$intOrdem				= (int) 0;
			$objParametro		= new Parametro($intMetodoId, $intParametroId, $strNome, $strTipo, $strValorPadrao, $intOrdem);
			$objMetodo->adicionarParametro($objParametro);
		}
		// Retornando a Classe Básica
		return $objClasse;
	}
	
	/**
	 * Método que cria a classe de cadatro com todos os seus elementos associados
	 * 
	 * @access public
	 * @param Classe $objClasseBasica
	 * @return Classe
	 */
	public function criarClasseCadastro(Classe $objClasseBasica) {
		
		/**
		 * Lista de métodos e parâmetros comuns
		 */
		$strListaMetodosPk		= "";
		$strListaParametrosPk	= "";
		$arrObjParametros			= array();
		foreach ($objClasseBasica->getAtributos() as $objAtributo) {
			
			// Verificando se o atributo é uma PK
			if ($objAtributo->getChavePk()) {
				// Criando a lista de métodos e de parâmetros comuns
				if (!empty($strListaMetodosPk))			$strListaMetodosPk		.= ", ";
				if (!empty($strListaParametrosPk))	$strListaParametrosPk	.= ", ";
				$strListaMetodosPk		.= '$obj'. $objClasseBasica->getNome() .'->get'. ucfirst($objAtributo->getNome()) .'()';
				$strListaParametrosPk	.= '$'. Util::tipoAbreviado($objAtributo->getTipo()) . ucfirst($objAtributo->getNome());
				
				// Criando os parametros comuns (PKs)
				$intMetodoId				= 0;
				$intParametroId			= 0;
				$strNome						= $objAtributo->getNome();
				$strTipo						= $objAtributo->getTipo();
				$strValorPadrao					= (string) "";
				$intOrdem						= (int) 0;
				$arrObjParametros[]	= new Parametro($intMetodoId, $intParametroId, $strNome, $strTipo, $strValorPadrao, $intOrdem);
			}
		}
		// Criando o parâmetro do objeto da classe
		$intMetodoId				= 0;
		$intParametroId			= 0;
		$strNome						= $objClasseBasica->getNome();
		$strTipo						= $objClasseBasica->getNome();
		$strValorPadrao					= (string) "";
		$intOrdem						= (int) 0;
		$objParametroComum	= new Parametro($intMetodoId, $intParametroId, $strNome, $strTipo, $strValorPadrao, $intOrdem);
		
		// Criando o throws comum Repositorio
		$intMetodoId						= 0;
		$intThrowsId						= 0;
		$strNome								= 'RepositorioException';
		$intOrdem							= (int) 0;
		$objThrowsRepositorio		= new Throws($intMetodoId, $intThrowsId, $strNome, $intOrdem);
		
		// Criando o throws comum NaoCadastrado
		$intMetodoId						= 0;
		$intThrowsId						= 0;
		$strNome								= ($objClasseBasica->getNovaVersao()) ? $objClasseBasica->getNome() .'InexistenteException' : $objClasseBasica->getNome() .'NaoCadastradoException';
		$intOrdem							= (int) 0;
		$objThrowsNaoCadastrado	= new Throws($intMetodoId, $intThrowsId, $strNome, $intOrdem);
		
		
		// Criando o parâmetro do objeto da classe
		$intMetodoId				= 0;
		$intParametroId			= 0;
		$strNome						= $objClasseBasica->getNome();
		$strTipo						= $objClasseBasica->getNome();
		$strValorPadrao					= (string) "";
		$intOrdem						= (int) 0;
		$objParametroComum	= new Parametro($intMetodoId, $intParametroId, $strNome, $strTipo, $strValorPadrao, $intOrdem);
		
		/**
		 * Gerando a Classe Cadastro
		 */
		$intSistemaId		= $objClasseBasica->getSistemaId();
		$intClasseId		= 0;
		$strNome				= "Cadastro". $objClasseBasica->getNome();
		$strTipo				= "CL";
		$strTipoCamada	= "CD";
		$strResumo			= "Cadastro de objetos ". $objClasseBasica->getNome();
		$strDescricao		= "";
		$strAutor				= $objClasseBasica->getAutor();
		$strPacote			= $objClasseBasica->getPacote();
		$strSubPacote		= $objClasseBasica->getSubpacote();
		$strVersao			= $objClasseBasica->getVersao();
		$strCriadoEm		= date("Y-m-d H:i:s");
		$strTabelaBd		= "";
		$bolNovaVersao		= $objClasseBasica->getNovaVersao();
		$strNameSpace		= $objClasseBasica->getNameSpace();
		$objClasse			= new Classe($intSistemaId, $intClasseId, $strNome, $strTipo, $strTipoCamada, $strResumo, $strDescricao, $strAutor, $strPacote, $strSubPacote, $strVersao, $strCriadoEm, $strTabelaBd, $bolNovaVersao, $strNameSpace);
		
		// Gerando os Atributos da Classe
		$intClasseId		= 0;
		$intAtributoId	= 0;
		$strNome				= "repositorio". $objClasseBasica->getNome();
		$strAcesso			= "private";
		$strTipo				= ($objClasseBasica->getNovaVersao()) ? $objClasseBasica->getNome() ."Interface" : "IRepositorio". $objClasseBasica->getNome();
		$strResumo			= "Repositório de classes ". $objClasseBasica->getNome();
		$strDescricao		= "";
		$strColunaBd		= "";
		$bolChavePk			= false;
		$intOrdem			= (int) 0;
		$objAtributo		= new Atributo($intClasseId, $intAtributoId, $strNome, $strAcesso, $strTipo, $strResumo, $strDescricao, $strColunaBd, $bolChavePk, $intOrdem);
		$objClasse->adicionarAtributo($objAtributo);
		
		
		// Gerando o método construtor
		$intClasseId	= 0;
		$intMetodoId	= 0;
		$strNome			= "__construct";
		$strAcesso		= "public";
		$strRetorno		= "";
		$strConteudo	= '$this->objRepositorio'. $objClasseBasica->getNome() .' = $objRepositorio'. $objClasseBasica->getNome() .';';
		$strResumo		= "Método construtor da classe";
		$strDescricao	= "";
		$intOrdem		= (int) 0;
		$objMetodo		= new Metodo($intClasseId, $intMetodoId, $strNome, $strAcesso, $strRetorno, $strConteudo, $strResumo, $strDescricao, $intOrdem);
		$objClasse->adicionarMetodo($objMetodo);
		
		// Definindo o parametro do método Construtor
		$intMetodoId		= 0;
		$intParametroId	= 0;
		$strNome				= "repositorio". $objClasseBasica->getNome();
		$strTipo				= ($objClasseBasica->getNovaVersao()) ? $objClasseBasica->getNome() ."Interface" : "IRepositorio". $objClasseBasica->getNome();
		$strValorPadrao			= (string) "";
		$intOrdem				= (int) 0;
		$objParametro		= new Parametro($intMetodoId, $intParametroId, $strNome, $strTipo, $strValorPadrao, $intOrdem);
		$objMetodo->adicionarParametro($objParametro);
		
		
		// Cadastrar
		$intClasseId	= 0;
		$intMetodoId	= 0;
		$strNome			= "cadastrar";
		$strAcesso		= "public";
		$strRetorno		= "int";
		$strResumo		= "Método que cadastra um objeto no Repositorio". $objClasseBasica->getNome();
		$strDescricao	= "";
		$strConteudo	 = 'if ($this->existe('. $strListaMetodosPk .'))'."\r\n";
		if ($objClasseBasica->getNovaVersao()) {
			$strConteudo	.= '	throw new '. $objClasseBasica->getNome() .'ExistenteException('. $strListaMetodosPk .');'."\r\n";
		}
		else {
			$strConteudo	.= '	throw new '. $objClasseBasica->getNome() .'JaCadastradoException('. $strListaMetodosPk .');'."\r\n";
		}
		$strConteudo	.= 'return $this->objRepositorio'. $objClasseBasica->getNome() .'->inserir($obj'. $objClasseBasica->getNome() .');';
		$intOrdem		= (int) 0;
		$objMetodo		= new Metodo($intClasseId, $intMetodoId, $strNome, $strAcesso, $strRetorno, $strConteudo, $strResumo, $strDescricao, $intOrdem);
		$objClasse->adicionarMetodo($objMetodo);
		
		// Definindo o parametro do método Cadastrar
		$objMetodo->adicionarParametro(clone $objParametroComum);
		
		// Criando o throws Existente/JaCadastrado
		$intMetodoId	= 0;
		$intThrowsId	= 0;
		$strNome			= ($objClasseBasica->getNovaVersao()) ? $objClasseBasica->getNome() .'ExistenteException' : $objClasseBasica->getNome() .'JaCadastradoException';
		$intOrdem		= (int) 0;
		$objThrows		= new Throws($intMetodoId, $intThrowsId, $strNome, $intOrdem);
		
		// Definindo os throws do método
		$objMetodo->adicionarThrows($objThrows);
		$objMetodo->adicionarThrows(clone $objThrowsNaoCadastrado);
		$objMetodo->adicionarThrows(clone $objThrowsRepositorio);
		
		
		// Atualizar
		$intClasseId	= 0;
		$intMetodoId	= 0;
		$strNome			= "atualizar";
		$strAcesso		= "public";
		$strRetorno		= "void";
		$strResumo		= "Método que atualiza um objeto no Repositorio". $objClasseBasica->getNome();
		$strDescricao	= "";
		$strConteudo	= '$this->objRepositorio'. $objClasseBasica->getNome() .'->atualizar($obj'. $objClasseBasica->getNome() .');';
		$intOrdem		= (int) 0;
		$objMetodo		= new Metodo($intClasseId, $intMetodoId, $strNome, $strAcesso, $strRetorno, $strConteudo, $strResumo, $strDescricao, $intOrdem);
		$objClasse->adicionarMetodo($objMetodo);
		
		// Definindo o parametro do método Alterar
		$objMetodo->adicionarParametro(clone $objParametroComum);
		
		// Definindo os throws do método
		$objMetodo->adicionarThrows(clone $objThrowsNaoCadastrado);
		$objMetodo->adicionarThrows(clone $objThrowsRepositorio);
		
		
		// Remover
		$intClasseId	= 0;
		$intMetodoId	= 0;
		$strNome			= "remover";
		$strAcesso		= "public";
		$strRetorno		= "void";
		$strResumo		= "Método que remove um objeto do Repositorio". $objClasseBasica->getNome();
		$strDescricao	= "";
		$strConteudo	= '$this->objRepositorio'. $objClasseBasica->getNome() .'->remover('. $strListaParametrosPk .');';
		$intOrdem		= (int) 0;
		$objMetodo		= new Metodo($intClasseId, $intMetodoId, $strNome, $strAcesso, $strRetorno, $strConteudo, $strResumo, $strDescricao, $intOrdem);
		$objClasse->adicionarMetodo($objMetodo);
		
		// Definindo os parametros do método (PKs)
		foreach ($arrObjParametros as $objParametro) $objMetodo->adicionarParametro(clone $objParametro);
		
		// Definindo os throws do método
		$objMetodo->adicionarThrows(clone $objThrowsRepositorio);
		
		
		// Procurar
		$intClasseId	= 0;
		$intMetodoId	= 0;
		$strNome			= "procurar";
		$strAcesso		= "public";
		$strRetorno		= $objClasseBasica->getNome();
		$strResumo		= "Método que procura um determinado objeto no Repositorio". $objClasseBasica->getNome();
		$strDescricao	= "";
		$strConteudo	= 'return $this->objRepositorio'. $objClasseBasica->getNome() .'->procurar('. $strListaParametrosPk .');';
		$intOrdem		= (int) 0;
		$objMetodo		= new Metodo($intClasseId, $intMetodoId, $strNome, $strAcesso, $strRetorno, $strConteudo, $strResumo, $strDescricao, $intOrdem);
		$objClasse->adicionarMetodo($objMetodo);
		
		// Definindo os parametros do método (PKs)
		foreach ($arrObjParametros as $objParametro) $objMetodo->adicionarParametro(clone $objParametro);
		
		// Definindo os throws do método
		$objMetodo->adicionarThrows(clone $objThrowsNaoCadastrado);
		
		
		// Existe
		$intClasseId	= 0;
		$intMetodoId	= 0;
		$strNome			= "existe";
		$strAcesso		= "public";
		$strRetorno		= "boolean";
		$strResumo		= "Método que verifica se existe um determinado objeto no Repositorio". $objClasseBasica->getNome();
		$strDescricao	= "";
		$strConteudo	= 'return $this->objRepositorio'. $objClasseBasica->getNome() .'->existe('. $strListaParametrosPk .');';
		$intOrdem		= (int) 0;
		$objMetodo		= new Metodo($intClasseId, $intMetodoId, $strNome, $strAcesso, $strRetorno, $strConteudo, $strResumo, $strDescricao, $intOrdem);
		$objClasse->adicionarMetodo($objMetodo);
		
		// Definindo os parametros do método (PKs)
		foreach ($arrObjParametros as $objParametro) $objMetodo->adicionarParametro(clone $objParametro);
		
		// Definindo os throws do método
		$objMetodo->adicionarThrows(clone $objThrowsRepositorio);
		
		
		// Listar
		$intClasseId	= 0;
		$intMetodoId	= 0;
		$strNome			= "listar";
		$strAcesso		= "public";
		$strRetorno		= "array";
		$strResumo		= "Método que lista todos os objetos do Repositorio". $objClasseBasica->getNome();
		$strDescricao	= "";
		$strConteudo	= 'return $this->objRepositorio'. $objClasseBasica->getNome() .'->listar();';
		$intOrdem		= (int) 0;
		$objMetodo		= new Metodo($intClasseId, $intMetodoId, $strNome, $strAcesso, $strRetorno, $strConteudo, $strResumo, $strDescricao, $intOrdem);
		$objClasse->adicionarMetodo($objMetodo);
		
		// Definindo os throws do método
		$objMetodo->adicionarThrows(clone $objThrowsRepositorio);
		
		// Retornando a Classe Cadastro
		return $objClasse;
	}
	
	/**
	 * Método que cria a interface com todos os seus elementos associados
	 * 
	 * @access public
	 * @param Classe $objClasseBasica
	 * @return Classe
	 */
	public function criarInterfaceRepositorio(Classe $objClasseBasica) {
		
		/**
		 * Lista de métodos e parâmetros comuns
		 */
		$arrObjParametrosPk	= array();
		foreach ($objClasseBasica->getAtributos() as $objAtributo) {
			
			// Verificando se o atributo é uma PK
			if ($objAtributo->getChavePk()) {
				
				// Criando os parametros comuns (PKs)
				$intMetodoId				= 0;
				$intParametroId			= 0;
				$strNome						= $objAtributo->getNome();
				$strTipo						= $objAtributo->getTipo();
				$strValorPadrao					= (string) "";
				$intOrdem						= (int) 0;
				$arrObjParametrosPk[]	= new Parametro($intMetodoId, $intParametroId, $strNome, $strTipo, $strValorPadrao, $intOrdem);
			}
		}
		// Criando o parâmetro do objeto da classe
		$intMetodoId				= 0;
		$intParametroId			= 0;
		$strNome						= $objClasseBasica->getNome();
		$strTipo						= $objClasseBasica->getNome();
		$strValorPadrao					= (string) "";
		$intOrdem						= (int) 0;
		$objParametroComum	= new Parametro($intMetodoId, $intParametroId, $strNome, $strTipo, $strValorPadrao, $intOrdem);
		
		// Criando o throws comum Repositorio
		$intMetodoId						= 0;
		$intThrowsId						= 0;
		$strNome								= 'RepositorioException';
		$intOrdem							= (int) 0;
		$objThrowsRepositorio		= new Throws($intMetodoId, $intThrowsId, $strNome, $intOrdem);
		
		// Criando o throws comum NaoCadastrado
		$intMetodoId						= 0;
		$intThrowsId						= 0;
		$strNome								= ($objClasseBasica->getNovaVersao()) ? $objClasseBasica->getNome() .'InexistenteException' : $objClasseBasica->getNome() .'NaoCadastradoException';
		$intOrdem							= (int) 0;
		$objThrowsNaoCadastrado	= new Throws($intMetodoId, $intThrowsId, $strNome, $intOrdem);
		
		
		/**
		 * Gerando a Interface
		 */
		$intSistemaId		= $objClasseBasica->getSistemaId();
		$intClasseId		= 0;
		$strNome				= ($objClasseBasica->getNovaVersao()) ? $objClasseBasica->getNome() ."Interface" : "IRepositorio". $objClasseBasica->getNome();
		$strTipo				= "IF";
		$strTipoCamada	= "IR";
		$strResumo			= "Interface do repositótio da classe ". $objClasseBasica->getNome();
		$strDescricao		= "Todos os repositórios da classe ". $objClasseBasica->getNome() ." deverão implementar esta interface";
		$strAutor				= $objClasseBasica->getAutor();
		$strPacote			= $objClasseBasica->getPacote();
		$strSubPacote		= $objClasseBasica->getSubpacote();
		$strVersao			= $objClasseBasica->getVersao();
		$strCriadoEm		= date("Y-m-d H:i:s");
		$strTabelaBd		= "";
		$bolNovaVersao		= $objClasseBasica->getNovaVersao();
		$strNameSpace		= $objClasseBasica->getNameSpace();
		$objClasse			= new Classe($intSistemaId, $intClasseId, $strNome, $strTipo, $strTipoCamada, $strResumo, $strDescricao, $strAutor, $strPacote, $strSubPacote, $strVersao, $strCriadoEm, $strTabelaBd, $bolNovaVersao, $strNameSpace);
		
		
		// Inserir
		$intClasseId	= 0;
		$intMetodoId	= 0;
		$strNome			= "inserir";
		$strAcesso		= "public";
		$strRetorno		= "int";
		$strConteudo	= "";
		$strResumo		= "Assinatura do método que insere um objeto do Repositorio". $objClasseBasica->getNome();
		$strDescricao	= "";
		$intOrdem		= (int) 0;
		$objMetodo		= new Metodo($intClasseId, $intMetodoId, $strNome, $strAcesso, $strRetorno, $strConteudo, $strResumo, $strDescricao, $intOrdem);
		$objClasse->adicionarMetodo($objMetodo);
		
		// Definindo o parametro do método
		$objMetodo->adicionarParametro(clone $objParametroComum);
		
		// Definindo os throws do método
		$objMetodo->adicionarThrows(clone $objThrowsNaoCadastrado);
		$objMetodo->adicionarThrows(clone $objThrowsRepositorio);
		
		
		// Atualizar
		$intClasseId	= 0;
		$intMetodoId	= 0;
		$strNome			= "atualizar";
		$strAcesso		= "public";
		$strRetorno		= "void";
		$strConteudo	= "";
		$strResumo		= "Assinatura do método que atualiza um objeto do Repositorio". $objClasseBasica->getNome();
		$strDescricao	= "";
		$intOrdem		= (int) 0;
		$objMetodo		= new Metodo($intClasseId, $intMetodoId, $strNome, $strAcesso, $strRetorno, $strConteudo, $strResumo, $strDescricao, $intOrdem);
		$objClasse->adicionarMetodo($objMetodo);
		
		// Definindo o parametro do método
		$objMetodo->adicionarParametro(clone $objParametroComum);
		
		// Definindo os throws do método
		$objMetodo->adicionarThrows(clone $objThrowsNaoCadastrado);
		$objMetodo->adicionarThrows(clone $objThrowsRepositorio);
		
		
		// Remover
		$intClasseId	= 0;
		$intMetodoId	= 0;
		$strNome			= "remover";
		$strAcesso		= "public";
		$strRetorno		= "void";
		$strConteudo	= "";
		$strResumo		= "Assinatura do método que remove um objeto do Repositorio". $objClasseBasica->getNome();
		$strDescricao	= "";
		$intOrdem		= (int) 0;
		$objMetodo		= new Metodo($intClasseId, $intMetodoId, $strNome, $strAcesso, $strRetorno, $strConteudo, $strResumo, $strDescricao, $intOrdem);
		$objClasse->adicionarMetodo($objMetodo);
		
		// Definindo os parametros do método (PKs)
		foreach ($arrObjParametrosPk as $objParametro) $objMetodo->adicionarParametro(clone $objParametro);
		
		// Definindo os throws do método
		$objMetodo->adicionarThrows(clone $objThrowsRepositorio);
		
		
		// Procurar
		$intClasseId	= 0;
		$intMetodoId	= 0;
		$strNome			= "procurar";
		$strAcesso		= "public";
		$strRetorno		= $objClasseBasica->getNome();
		$strConteudo	= "";
		$strResumo		= "Assinatura do método que procura um determinado objeto no Repositorio". $objClasseBasica->getNome();
		$strDescricao	= "";
		$intOrdem		= (int) 0;
		$objMetodo		= new Metodo($intClasseId, $intMetodoId, $strNome, $strAcesso, $strRetorno, $strConteudo, $strResumo, $strDescricao, $intOrdem);
		$objClasse->adicionarMetodo($objMetodo);
		
		// Definindo os parametros do método (PKs)
		foreach ($arrObjParametrosPk as $objParametro) $objMetodo->adicionarParametro(clone $objParametro);
		
		// Definindo os throws do método
		$objMetodo->adicionarThrows(clone $objThrowsNaoCadastrado);
		
		
		// Existe
		$intClasseId	= 0;
		$intMetodoId	= 0;
		$strNome			= "existe";
		$strAcesso		= "public";
		$strRetorno		= "boolean";
		$strConteudo	= "";
		$strResumo		= "Assinatura do método que verifica se existe um determinado objeto no Repositorio". $objClasseBasica->getNome();
		$strDescricao	= "";
		$intOrdem		= (int) 0;
		$objMetodo		= new Metodo($intClasseId, $intMetodoId, $strNome, $strAcesso, $strRetorno, $strConteudo, $strResumo, $strDescricao, $intOrdem);
		$objClasse->adicionarMetodo($objMetodo);
		
		// Definindo os parametros do método (PKs)
		foreach ($arrObjParametrosPk as $objParametro) $objMetodo->adicionarParametro(clone $objParametro);
		
		// Definindo os throws do método
		$objMetodo->adicionarThrows(clone $objThrowsRepositorio);
		
		
		// Listar
		$intClasseId	= 0;
		$intMetodoId	= 0;
		$strNome			= "listar";
		$strAcesso		= "public";
		$strRetorno		= "array";
		$strConteudo	= "";
		$strResumo		= "Assinatura do método que lista todos os objetos do Repositorio". $objClasseBasica->getNome();
		$strDescricao	= "";
		$intOrdem		= (int) 0;
		$objMetodo		= new Metodo($intClasseId, $intMetodoId, $strNome, $strAcesso, $strRetorno, $strConteudo, $strResumo, $strDescricao, $intOrdem);
		$objClasse->adicionarMetodo($objMetodo);
		
		// Definindo os throws do método
		$objMetodo->adicionarThrows(clone $objThrowsRepositorio);
		
		// Retornando a Interface
		return $objClasse;
	}
	
	/**
	 * Método que cria a classe repositorio com todos os seus elementos associados
	 * 
	 * @access public
	 * @param Classe $objClasseBasica
	 * @param Classe $objInterface
	 * @return Classe
	 */
	public function criarClasseRepositorioBDR(Classe $objClasseBasica, Classe $objInterface) {
		
		/**
		 * Lista de métodos e parâmetros comuns
		 */
		$arrStrColunas			= array();
		$arrStrMetodos			= array();
		$arrStrParamPrep		= array();
		$arrStrColunasBol		= array();
		$arrStrMetodosBol		= array();
		$arrStrParametrosBol	= array();
		$arrStrParametrosIntBol	= array();
		$arrStrColunasPk		= array();
		$arrStrParametrosPk	= array();
		$arrStrParamPrepPk	= array();
		$arrObjParametrosPk	= array();
		foreach ($objClasseBasica->getAtributos() as $objAtributo) {
			$strTipoAbreviado	= Util::tipoAbreviado($objAtributo->getTipo());
			$strNomeId			= ucfirst($objAtributo->getNome());
			$strStrMetodo		= '$obj'. $objClasseBasica->getNome() ."->get". $strNomeId ."()";
			
			$arrStrColunas[] = $objAtributo->getColunaBd();
			$arrStrMetodos[] = $strStrMetodo;
			$arrStrParamPrep[] = ':'. strtolower($strTipoAbreviado . $strNomeId);
			
			if ($strTipoAbreviado == "bol") {
				$arrStrColunasBol[]			= $objAtributo->getColunaBd();
				$arrStrMetodosBol[]			= $strStrMetodo;
				$arrStrParametrosBol[]		= '$'. $strTipoAbreviado . $strNomeId;
				$arrStrParametrosIntBol[]	= '$int'. $strNomeId;
			}
			
			// Verificando se o atributo é uma PK
			if ($objAtributo->getChavePk()) {
				// Criando a lista de métodos e de parâmetros comuns
				$arrStrColunasPk[]		= $objAtributo->getColunaBd();
				$arrStrParametrosPk[]	= '$'. $strTipoAbreviado . $strNomeId;
				$arrStrParamPrepPk[] = ':'. strtolower($strTipoAbreviado . $strNomeId);
				
				// Criando os parametros comuns (PKs)
				$intMetodoId				= 0;
				$intParametroId			= 0;
				$strNome						= $objAtributo->getNome();
				$strTipo						= $objAtributo->getTipo();
				$strValorPadrao					= (string) "";
				$intOrdem						= (int) 0;
				$arrObjParametrosPk[]	= new Parametro($intMetodoId, $intParametroId, $strNome, $strTipo, $strValorPadrao, $intOrdem);
			}
		}
		// Criando o parâmetro do objeto da classe
		$intMetodoId					= 0;
		$intParametroId				= 0;
		$strNome							= $objClasseBasica->getNome();
		$strTipo							= $objClasseBasica->getNome();
		$strValorPadrao						= (string) "";
		$intOrdem							= (int) 0;
		$objParametroComum		= new Parametro($intMetodoId, $intParametroId, $strNome, $strTipo, $strValorPadrao, $intOrdem);
		
		// Criando o throws comum Repositorio
		$intMetodoId						= 0;
		$intThrowsId						= 0;
		$strNome								= 'RepositorioException';
		$intOrdem							= (int) 0;
		$objThrowsRepositorio		= new Throws($intMetodoId, $intThrowsId, $strNome, $intOrdem);
		
		// Criando o throws comum NaoCadastrado
		$intMetodoId						= 0;
		$intThrowsId						= 0;
		$strNome								= ($objClasseBasica->getNovaVersao()) ? $objClasseBasica->getNome() .'InexistenteException' : $objClasseBasica->getNome() .'NaoCadastradoException';
		$intOrdem							= (int) 0;
		$objThrowsNaoCadastrado	= new Throws($intMetodoId, $intThrowsId, $strNome, $intOrdem);
		
		
		/**
		 * Gerando a Classe Repositório
		 */
		$intSistemaId		= $objClasseBasica->getSistemaId();
		$intClasseId		= 0;
		$strNome				= ($objClasseBasica->getNovaVersao()) ? $objClasseBasica->getNome() ."DAOBDR" : "Repositorio". $objClasseBasica->getNome() ."BDR";
		$strTipo				= "CL";
		$strTipoCamada	= "RP";
		$strResumo			= "Repositório de objetos ". $objClasseBasica->getNome();
		$strDescricao		= "Esta classe implementa a interface ";
		$strDescricao		.= ($objClasseBasica->getNovaVersao()) ? $objClasseBasica->getNome() ."Interface" : "IRepositorio". $objClasseBasica->getNome();
		$strAutor				= $objClasseBasica->getAutor();
		$strPacote			= $objClasseBasica->getPacote();
		$strSubPacote		= $objClasseBasica->getSubpacote();
		$strVersao			= $objClasseBasica->getVersao();
		$strCriadoEm		= date("Y-m-d H:i:s");
		$strTabelaBd		= "";
		$bolNovaVersao		= $objClasseBasica->getNovaVersao();
		$strNameSpace		= $objClasseBasica->getNameSpace();
		$objClasse			= new Classe($intSistemaId, $intClasseId, $strNome, $strTipo, $strTipoCamada, $strResumo, $strDescricao, $strAutor, $strPacote, $strSubPacote, $strVersao, $strCriadoEm, $strTabelaBd, $bolNovaVersao, $strNameSpace);
		
		// Gerando a Interface
		$objIntface = new Intface(0, $objInterface->getClasseId(), $objInterface->getNome());
		$objClasse->adicionarIntface($objIntface);
		
		// Gerando os Atributos da Classe
		if (!$objClasseBasica->getNovaVersao()) {
			$intClasseId		= 0;
			$intAtributoId	= 0;
			$strNome				= "conexao". $objClasseBasica->getNome();
			$strAcesso			= "protected";
			$strTipo				= "Conexao". $objClasseBasica->getNome();
			$strResumo			= "Objeto da conexão";
			$strDescricao		= "";
			$strColunaBd		= "";
			$bolChavePk			= false;
			$intOrdem			= (int) 0;
			$objAtributo		= new Atributo($intClasseId, $intAtributoId, $strNome, $strAcesso, $strTipo, $strResumo, $strDescricao, $strColunaBd, $bolChavePk, $intOrdem);
			$objClasse->adicionarAtributo($objAtributo);
		}
		
		$intClasseId		= 0;
		$intAtributoId		= 0;
		$strNome			= "PDO";
		$strAcesso			= "protected";
		$strTipo			= "PDO";
		$strResumo			= "Objeto PDO";
		$strDescricao		= "";
		$strColunaBd		= "";
		$bolChavePk			= false;
		$intOrdem			= (int) 0;
		$objAtributo		= new Atributo($intClasseId, $intAtributoId, $strNome, $strAcesso, $strTipo, $strResumo, $strDescricao, $strColunaBd, $bolChavePk, $intOrdem);
		$objClasse->adicionarAtributo($objAtributo);
		
		
		// Gerando o método construtor
		$intClasseId	= 0;
		$intMetodoId	= 0;
		$strNome		= "__construct";
		$strAcesso		= "public";
		$strRetorno		= "";
		$strResumo		= "Método construtor da classe";
		$strDescricao	= "";
		$intOrdem		= (int) 0;
		
		// Montando o conteúdo
		if ($objClasseBasica->getNovaVersao()) {
			$strConteudo	 = '$this->objFConnection = \WFramework\DAO\FConnectionBDR::getInstance("sistema");'."\r\n";
			$strConteudo	.= '$this->objPDO = $this->objFConnection->getConnection();';
		}
		else {
			$strConteudo	 = '$this->objConexao'. $objClasseBasica->getNome() .' = ConexaoBDR::getInstancia("sistema");'."\r\n";
			$strConteudo	.= '$this->objPDO = $this->objConexao'. $objClasseBasica->getNome() .'->getConexao();';
		}
		$objMetodo		= new Metodo($intClasseId, $intMetodoId, $strNome, $strAcesso, $strRetorno, $strConteudo, $strResumo, $strDescricao, $intOrdem);
		$objClasse->adicionarMetodo($objMetodo);
		
		
		// Inserir
		$intClasseId	= 0;
		$intMetodoId	= 0;
		$strNome		= "inserir";
		$strAcesso		= "public";
		$strRetorno		= "int";
		$strResumo		= "Método que insere um objeto no Repositorio BDR";
		$strDescricao	= "";
		$intOrdem		= (int) 0;
		
		// Montando o conteúdo do método
		$strListaColunas = "";
		foreach ($arrStrColunas as $strColunaBd) {
			if (!empty($strListaColunas)) $strListaColunas .= ",\r\n";
			$strListaColunas .= "		". $strColunaBd;
		}
		if (!empty($strListaColunas)) $strListaColunas .= "\r\n";
		
		
		$intTamanhoMaximoParam = 0;
		foreach ($arrStrParamPrep as $strParamPrep) {
			if (strlen($strParamPrep) > $intTamanhoMaximoParam) $intTamanhoMaximoParam = strlen($strParamPrep);
		}
		
		$strListaMetodos = "";
		$strValoresConsulta = "";
		foreach ($arrStrMetodos as $intKey => $strMetodo) {
			if (!empty($strListaMetodos)) $strListaMetodos .= ",\r\n";
			if (!empty($strValoresConsulta)) $strValoresConsulta .= ",\r\n";
			$strSpacesTempParam = str_repeat(" ", $intTamanhoMaximoParam - strlen($arrStrParamPrep[$intKey]));
			$intKeyBol = array_search($strMetodo, $arrStrMetodosBol);
			$strListaMetodos .= '	"'. $arrStrParamPrep[$intKey] .'"'. $strSpacesTempParam .' => ';
			$strListaMetodos .= ($intKeyBol !== false) ? $arrStrParametrosIntBol[$intKeyBol] : $strMetodo;
			$strValoresConsulta .= '		'. $arrStrParamPrep[$intKey];
		}
		if (!empty($strListaMetodos)) $strListaMetodos .= "\r\n";
		if (!empty($strValoresConsulta)) $strValoresConsulta .= "\r\n";
		
		
		$strListaParametrosEx = "";
		foreach ($arrStrParametrosPk as $strParametro) {
			if (!empty($strListaParametrosEx)) $strListaParametrosEx .= ", ";
			$strListaParametrosEx .= 'null';
		}
		
		
		$strListaParametrosIntBol = "";
		foreach ($arrStrParametrosIntBol as $intKey => $strParametroIntBol) {
			$strListaParametrosIntBol .= $strParametroIntBol ." = (". $arrStrMetodosBol[$intKey] .") ? 1 : 0;\r\n";
		}
		
		$strConteudo	 =	'if ($obj'. $objClasseBasica->getNome() .' != null) {'."\r\n";
		$strConteudo	.=		$strListaParametrosIntBol;
		$strConteudo	.=		'$strSql = "'."\r\n";
		$strConteudo	.=		'	INSERT INTO '. $objClasseBasica->getTabelaBd() .' ('."\r\n";
		$strConteudo	.=		$strListaColunas;
		$strConteudo	.=		'	)'."\r\n";
		$strConteudo	.=		'	VALUES ('."\r\n";
		$strConteudo	.=		$strValoresConsulta;
		$strConteudo	.=		'	)";'."\r\n";
		$strConteudo	.=		'try {'."\r\n";
		$strConteudo	.=			'$objPDOStm = $this->objPDO->prepare($strSql);'."\r\n";
		$strConteudo	.=			'$objPDOStm->execute(array('."\r\n";
		$strConteudo	.=			$strListaMetodos;
		$strConteudo	.=			'));'."\r\n";
		$strConteudo	.=			'return $this->objPDO->lastInsertId();'."\r\n";
		$strConteudo	.=		'}'."\r\n";
		$strConteudo	.=		'catch(PDOException $ex) {'."\r\n";
		$strConteudo	.=			'throw new RepositorioException($ex->getMessage());'."\r\n";
		$strConteudo	.=		'}'."\r\n";
		$strConteudo	.=	'}'."\r\n";
		$strConteudo	.=	'else {'."\r\n";
		if ($objClasseBasica->getNovaVersao()) {
			$strConteudo	.=		'throw new '. $objClasseBasica->getNome() .'InexistenteException('. $strListaParametrosEx .');'."\r\n";
		}
		else {
			$strConteudo	.=		'throw new '. $objClasseBasica->getNome() .'NaoCadastradoException('. $strListaParametrosEx .');'."\r\n";
		}
		$strConteudo	.=	'}'."\r\n";
		
		$objMetodo		= new Metodo($intClasseId, $intMetodoId, $strNome, $strAcesso, $strRetorno, $strConteudo, $strResumo, $strDescricao, $intOrdem);
		$objClasse->adicionarMetodo($objMetodo);
		
		// Definindo o parametro do método
		$objMetodo->adicionarParametro(clone $objParametroComum);
		
		// Definindo os throws do método
		$objMetodo->adicionarThrows(clone $objThrowsNaoCadastrado);
		$objMetodo->adicionarThrows(clone $objThrowsRepositorio);
		
		
		// Atualizar
		$intClasseId	= 0;
		$intMetodoId	= 0;
		$strNome		= "atualizar";
		$strAcesso		= "public";
		$strRetorno		= "void";
		$strResumo		= "Método que atualiza um objeto no Repositorio BDR";
		$strDescricao	= "";
		$intOrdem		= (int) 0;
		
		// Montando o conteúdo do método
		$strListaColunas		= "";
		$strListaParametros	= "";
		$strListaMetodos = "";
		$intTamanhoMaximoCol = 0;
		foreach ($arrStrColunas as $strColunaBd) {
			if (!in_array($strColunaBd, $arrStrColunasPk) && strlen($strColunaBd) > $intTamanhoMaximoCol) $intTamanhoMaximoCol = strlen($strColunaBd);
		}
		$intTamanhoMaximoParam = 0;
		foreach ($arrStrParamPrep as $strParamPrep) {
			if (strlen($strParamPrep) > $intTamanhoMaximoParam) $intTamanhoMaximoParam = strlen($strParamPrep);
		}
		foreach ($arrStrColunas as $intKey => $strColunaBd) {
			if (!empty($strListaMetodos)) $strListaMetodos .= ",\r\n";
			
			$strMetodo = $arrStrMetodos[ $intKey ];
			$strSpacesTempParam = str_repeat(" ", $intTamanhoMaximoParam - strlen($arrStrParamPrep[$intKey]));
			$intKeyBol = array_search($strMetodo, $arrStrMetodosBol);
			$strListaMetodos .= '	"'. $arrStrParamPrep[$intKey] .'"'. $strSpacesTempParam .' => ';
			$strListaMetodos .= ($intKeyBol !== false) ? $arrStrParametrosIntBol[$intKeyBol] : $strMetodo;
			
			$strSpacesTempCol = (!in_array($strColunaBd, $arrStrColunasPk)) ? str_repeat(" ", $intTamanhoMaximoCol - strlen($strColunaBd)) : "";
			$strListaTemp  = $strColunaBd . $strSpacesTempCol .' = ';
			$strListaTemp .= $arrStrParamPrep[ $intKey ];
			if (in_array($strColunaBd, $arrStrColunasPk)) {
				if (!empty($strListaParametros)) $strListaParametros .= "\r\n"."	AND ";
				$strListaParametros .= $strListaTemp;
			}
			else {
				if (!empty($strListaColunas)) $strListaColunas .= ",\r\n";
				$strListaColunas .= "		". $strListaTemp;
			}
		}
		if (!empty($strListaColunas)) $strListaColunas .= "\r\n";
		if (!empty($strListaMetodos)) $strListaMetodos .= "\r\n";
		
		
		$strConteudo	 =	'if ($obj'. $objClasseBasica->getNome() .' != null) {'."\r\n";
		$strConteudo	.=		$strListaParametrosIntBol;
		$strConteudo	.=		'$strSql = "'."\r\n";
		$strConteudo	.=		'	UPDATE '. $objClasseBasica->getTabelaBd() .' SET'."\r\n";
		$strConteudo	.=		$strListaColunas;
		$strConteudo	.=		'	WHERE '. $strListaParametros;
		$strConteudo	.=		'";'."\r\n";
		$strConteudo	.=		'try {'."\r\n";
		$strConteudo	.=			'$objPDOStm = $this->objPDO->prepare($strSql);'."\r\n";
		$strConteudo	.=			'$objPDOStm->execute(array('."\r\n";
		$strConteudo	.=			$strListaMetodos;
		$strConteudo	.=			'));'."\r\n";
		$strConteudo	.=		'}'."\r\n";
		$strConteudo	.=		'catch(PDOException $ex) {'."\r\n";
		$strConteudo	.=			'throw new RepositorioException($ex->getMessage());'."\r\n";
		$strConteudo	.=		'}'."\r\n";
		$strConteudo	.=	'}'."\r\n";
		$strConteudo	.=	'else {'."\r\n";
		if ($objClasseBasica->getNovaVersao()) {
			$strConteudo	.=		'throw new '. $objClasseBasica->getNome() .'InexistenteException('. $strListaParametrosEx .');'."\r\n";
		}
		else {
			$strConteudo	.=		'throw new '. $objClasseBasica->getNome() .'NaoCadastradoException('. $strListaParametrosEx .');'."\r\n";
		}
		$strConteudo	.=	'}'."\r\n";
		$objMetodo		= new Metodo($intClasseId, $intMetodoId, $strNome, $strAcesso, $strRetorno, $strConteudo, $strResumo, $strDescricao, $intOrdem);
		$objClasse->adicionarMetodo($objMetodo);
		
		// Definindo o parametro do método
		$objMetodo->adicionarParametro(clone $objParametroComum);
		
		// Definindo os throws do método
		$objMetodo->adicionarThrows(clone $objThrowsNaoCadastrado);
		$objMetodo->adicionarThrows(clone $objThrowsRepositorio);
		
		
		// Remover
		$intClasseId	= 0;
		$intMetodoId	= 0;
		$strNome		= "remover";
		$strAcesso		= "public";
		$strRetorno		= "void";
		$strResumo		= "Método que remove um objeto no Repositorio BDR";
		$strDescricao	= "";
		$intOrdem		= (int) 0;
		
		// Montando o conteúdo
		$strValidacoes = "";
		foreach ($arrObjParametrosPk as $intKey => $objParametro) {
			$strParametro = $arrStrParametrosPk[ $intKey ];
			$strValidacoes .= $strParametro ." = (". $objParametro->getTipo() .") ". $strParametro .";\r\n";
		}
		if (!empty($strValidacoes)) $strValidacoes .= "\r\n";
		$strListaParametros		= "";
		$strListaParametrosEx	= "";
		$strListaMetodos			= "";
		foreach ($arrStrColunasPk as $intKey => $strColunaBd) {
			if (!empty($strListaParametros))		$strListaParametros		.= "\r\n"."	AND ";
			if (!empty($strListaParametrosEx))	$strListaParametrosEx	.= ", ";
			if (!empty($strListaMetodos))	$strListaMetodos	.= ",\r\n";
			$strListaParametros		.= $strColunaBd .' = '. $arrStrParamPrepPk[ $intKey ];
			$strListaParametrosEx	.= $arrStrParametrosPk[ $intKey ];
			$strListaMetodos			.= '	"'. $arrStrParamPrepPk[ $intKey ] .'" => '. $arrStrParametrosPk[ $intKey ];
		}
		if (!empty($strListaMetodos)) $strListaMetodos .= "\r\n";
		
		$strConteudo	 =	$strValidacoes;
		$strConteudo	.=	'$strSql = "'."\r\n";
		$strConteudo	.=	'	DELETE FROM '. $objClasseBasica->getTabelaBd() ."\r\n";
		$strConteudo	.=	'	WHERE '. $strListaParametros;
		$strConteudo	.=	'";'."\r\n";
		$strConteudo	.=	'try {'."\r\n";
		$strConteudo	.=			'$objPDOStm = $this->objPDO->prepare($strSql);'."\r\n";
		$strConteudo	.=			'$objPDOStm->execute(array('."\r\n";
		$strConteudo	.=			$strListaMetodos;
		$strConteudo	.=			'));'."\r\n";
		$strConteudo	.=	'}'."\r\n";
		$strConteudo	.=	'catch(PDOException $ex) {'."\r\n";
		$strConteudo	.=		'throw new RepositorioException($ex->getMessage());'."\r\n";
		$strConteudo	.=	'}';
		$objMetodo		= new Metodo($intClasseId, $intMetodoId, $strNome, $strAcesso, $strRetorno, $strConteudo, $strResumo, $strDescricao, $intOrdem);
		$objClasse->adicionarMetodo($objMetodo);
		
		// Definindo os parametros do método (PKs)
		foreach ($arrObjParametrosPk as $objParametro) $objMetodo->adicionarParametro(clone $objParametro);
		
		// Definindo os throws do método
		$objMetodo->adicionarThrows(clone $objThrowsRepositorio);
		
		
		// Procurar
		$intClasseId	= 0;
		$intMetodoId	= 0;
		$strNome		= "procurar";
		$strAcesso		= "public";
		$strRetorno		= $objClasseBasica->getNome();
		$strResumo		= "Método que procura um objeto no Repositorio BDR";
		$strDescricao	= "";
		$intOrdem		= (int) 0;
		
		// Montando o conteúdo
		$strConteudo	 =	$strValidacoes;
		$strConteudo	.=	'$strSql ="'."\r\n";
		$strConteudo	.=	'	AND '. $strListaParametros .'";'."\r\n";
		$strConteudo	.=	'$arrParam = array('."\r\n";
		$strConteudo	.=		$strListaMetodos;
		$strConteudo	.=	');'."\r\n";
		$strConteudo	.=	'$arrObj'. $objClasseBasica->getNome() .' = $this->listar($strSql, $arrParam);'."\r\n";
		$strConteudo	.=	'if (!empty($arrObj'. $objClasseBasica->getNome() .') && is_array($arrObj'. $objClasseBasica->getNome() .')) {'."\r\n";
		$strConteudo	.=		'return $arrObj'. $objClasseBasica->getNome() .'[0];'."\r\n";
		$strConteudo	.=	'}'."\r\n";
		$strConteudo	.=	'else {'."\r\n";
		if ($objClasseBasica->getNovaVersao()) {
			$strConteudo	.=		'throw new '. $objClasseBasica->getNome() .'InexistenteException('. $strListaParametrosEx .');'."\r\n";
		}
		else {
			$strConteudo	.=		'throw new '. $objClasseBasica->getNome() .'NaoCadastradoException('. $strListaParametrosEx .');'."\r\n";
		}
		$strConteudo	.=	'}'."\r\n";
		$objMetodo		= new Metodo($intClasseId, $intMetodoId, $strNome, $strAcesso, $strRetorno, $strConteudo, $strResumo, $strDescricao, $intOrdem);
		$objClasse->adicionarMetodo($objMetodo);
		
		// Definindo os parametros do método (PKs)
		foreach ($arrObjParametrosPk as $objParametro) $objMetodo->adicionarParametro(clone $objParametro);
		
		// Definindo os throws do método
		$objMetodo->adicionarThrows(clone $objThrowsNaoCadastrado);
		
		
		// Existe
		$intClasseId	= 0;
		$intMetodoId	= 0;
		$strNome		= "existe";
		$strAcesso		= "public";
		$strRetorno		= "boolean";
		$strResumo		= "Método que verifica a existencia de um determinado objeto no Repositorio BDR";
		$strDescricao	= "";
		$intOrdem		= (int) 0;
		
		// Montando o conteúdo
		$strConteudo	 =	$strValidacoes;
		$strConteudo	.=	'$strSql = "'."\r\n";
		$strConteudo	.=	'	SELECT COUNT(*) AS quantidade'."\r\n";
		$strConteudo	.=	'	FROM '. $objClasseBasica->getTabelaBd() ."\r\n";
		$strConteudo	.=	'	WHERE '. $strListaParametros;
		$strConteudo	.=	'";'."\r\n";
		$strConteudo	.=	'try {'."\r\n";
		$strConteudo	.=		'$objPDOStm = $this->objPDO->prepare($strSql);'."\r\n";
		$strConteudo	.=		'$objPDOStm->execute(array('."\r\n";
		$strConteudo	.=		$strListaMetodos;
		$strConteudo	.=		'));'."\r\n";
		if ($objClasseBasica->getNovaVersao()) {
			$strConteudo	.=		'$arrResult = $objPDOStm->fetch(\PDO::FETCH_ASSOC);'."\r\n";
		}
		else {
			$strConteudo	.=		'$arrResult = $objPDOStm->fetch(PDO::FETCH_ASSOC);'."\r\n";
		}
		$strConteudo	.=		'if (!empty($arrResult) && is_array($arrResult) && $arrResult["quantidade"] > 0) {'."\r\n";
		$strConteudo	.=			'return true;'."\r\n";
		$strConteudo	.=		'}'."\r\n";
		$strConteudo	.=		'else {'."\r\n";
		$strConteudo	.=			'return false;'."\r\n";
		$strConteudo	.=		'}'."\r\n";
		$strConteudo	.=	'}'."\r\n";
		$strConteudo	.=	'catch(PDOException $ex) {'."\r\n";
		$strConteudo	.=		'throw new RepositorioException($ex->getMessage());'."\r\n";
		$strConteudo	.=	'}';
		$objMetodo		= new Metodo($intClasseId, $intMetodoId, $strNome, $strAcesso, $strRetorno, $strConteudo, $strResumo, $strDescricao, $intOrdem);
		$objClasse->adicionarMetodo($objMetodo);
		
		// Definindo os parametros do método (PKs)
		foreach ($arrObjParametrosPk as $objParametro) $objMetodo->adicionarParametro(clone $objParametro);
		
		// Definindo os throws do método
		$objMetodo->adicionarThrows(clone $objThrowsRepositorio);
		
		
		// Listar
		$intClasseId	= 0;
		$intMetodoId	= 0;
		$strNome		= "listar";
		$strAcesso		= "public";
		$strRetorno		= "array";
		$strResumo		= "Método que lista todos os objetos do Repositorio BDR";
		$strDescricao	= "";
		$intOrdem		= (int) 0;
		
		// Montando o conteúdo
		$strListaColunas		= "";
		$strListaResultado	= "";
		foreach ($arrStrColunas as $strColunaBd) {
			if (!empty($strListaColunas))		$strListaColunas	.= ",\r\n";
			if (!empty($strListaResultado))		$strListaResultado	.= ", ";
			$strListaColunas		.= "		". $strColunaBd;
			$strListaResultado	.= '$arrResult["'. $strColunaBd .'"]';
		}
		if (!empty($strListaColunas)) $strListaColunas	.= "\r\n";
		$strListaParametros = "";
		foreach ($arrStrColunasPk as $strColunaBd) {
			if (!empty($strListaParametros))	$strListaParametros	.= "\r\n"."	AND ";
			$strListaParametros	.= $strColunaBd ." IS NOT NULL";
		}
		
		$strStrColunasBol = "";
		foreach ($arrStrColunasBol as $strColunaBol) {
			if (!empty($strStrColunasBol)) $strStrColunasBol .= "\r\n";
			$strStrColunasBol .= '$arrResult["'. $strColunaBol .'"] = ($arrResult["'. $strColunaBol .'"]) ? true : false;';
		}
		if (!empty($strStrColunasBol)) $strStrColunasBol .= "\r\n";
		
		$strConteudo	 =	'$strSql = "'."\r\n";
		$strConteudo	.=	'	SELECT'."\r\n";
		$strConteudo	.=	$strListaColunas;
		$strConteudo	.=	'	FROM '. $objClasseBasica->getTabelaBd() ."\r\n";
		$strConteudo	.=	'	WHERE '. $strListaParametros ."\r\n";
		$strConteudo	.=	'	$strComplemento';
		$strConteudo	.=	'";'."\r\n";
		$strConteudo	.=	'try {'."\r\n";
		$strConteudo	.=		'$objPDOStm = $this->objPDO->prepare($strSql);'."\r\n";
		$strConteudo	.=		'$objPDOStm->execute($arrParam);'."\r\n";
		if ($objClasseBasica->getNovaVersao()) {
			$strConteudo	.=		'$arrResults = $objPDOStm->fetchAll(\PDO::FETCH_ASSOC);'."\r\n";
		}
		else {
			$strConteudo	.=		'$arrResults = $objPDOStm->fetchAll(PDO::FETCH_ASSOC);'."\r\n";
		}
		$strConteudo	.=		'$arrObj'. $objClasseBasica->getNome() .' = array();'."\r\n";
		$strConteudo	.=		'if (!empty($arrResults) && is_array($arrResults)) {'."\r\n";
		$strConteudo	.=			'foreach ($arrResults as $arrResult) {'."\r\n";
		$strConteudo	.=				$strStrColunasBol;
		$strConteudo	.=				'$arrObj'. $objClasseBasica->getNome() .'[] = new '. $objClasseBasica->getNome() .'('. $strListaResultado .');'."\r\n";
		$strConteudo	.=			'}'."\r\n";
		$strConteudo	.=		'}'."\r\n";
		$strConteudo	.=	'return $arrObj'. $objClasseBasica->getNome() .';'."\r\n";
		$strConteudo	.=	'}'."\r\n";
		$strConteudo	.=	'catch(PDOException $ex) {'."\r\n";
		$strConteudo	.=		'throw new RepositorioException($ex->getMessage());'."\r\n";
		$strConteudo	.=	'}';
		$objMetodo		= new Metodo($intClasseId, $intMetodoId, $strNome, $strAcesso, $strRetorno, $strConteudo, $strResumo, $strDescricao, $intOrdem);
		$objClasse->adicionarMetodo($objMetodo);
		
		// Adicionando os parametros default do método listar
		$intMetodoId		= 0;
		$intParametroId		= 0;
		$strNome			= "complemento";
		$strTipo			= "string";
		$strValorPadrao		= '""';
		$intOrdem			= (int) 0;
		$objParametro		= new Parametro($intMetodoId, $intParametroId, $strNome, $strTipo, $strValorPadrao, $intOrdem);
		$objMetodo->adicionarParametro($objParametro);
		
		$intMetodoId		= 0;
		$intParametroId		= 0;
		$strNome			= "param";
		$strTipo			= "array";
		$strValorPadrao		= 'array()';
		$intOrdem			= (int) 0;
		$objParametro		= new Parametro($intMetodoId, $intParametroId, $strNome, $strTipo, $strValorPadrao, $intOrdem);
		$objMetodo->adicionarParametro($objParametro);
		
		// Definindo os throws do método
		$objMetodo->adicionarThrows(clone $objThrowsRepositorio);
		
		// Retornando a Classe Repositório
		return $objClasse;
	}
	
	/**
	 * Método que cria a classe de NaoCadastradoException com todos os seus elementos associados
	 * 
	 * @access public
	 * @param Classe $objClasseBasica
	 * @return Classe
	 */
	public function criarNaoCadastradoException(Classe $objClasseBasica) {
		$strNomeClasse			= ($objClasseBasica->getNovaVersao()) ? $objClasseBasica->getNome() ."InexistenteException" : $objClasseBasica->getNome() ."NaoCadastradoException";
		$strResumoClasse		= "Exceção de ". $objClasseBasica->getNome() ." não cadastrado";
		$strDescricaoClasse		= "Será levantada caso ocorra algum acesso a um objeto ". $objClasseBasica->getNome() ." que não cadastrado";
		$strMensagemClasse		= $objClasseBasica->getNome() ." não cadastrado(a)";
		
		// Gerando a Exception
		return $this->criarException($objClasseBasica, $strNomeClasse, $strResumoClasse, $strDescricaoClasse, $strMensagemClasse);
	}
	
	/**
	 * Método que cria a classe de JaCadastradaException com todos os seus elementos associados
	 * 
	 * @access public
	 * @param Classe $objClasseBasica
	 * @return Classe
	 */
	public function criarJaCadastradaException(Classe $objClasseBasica) {
		$strNomeClasse			= ($objClasseBasica->getNovaVersao()) ? $objClasseBasica->getNome() ."ExistenteException" : $objClasseBasica->getNome() ."JaCadastradoException";
		$strResumoClasse		= "Exceção de ". $objClasseBasica->getNome() ." já cadastrado";
		$strDescricaoClasse		= "Será levantada caso ocorra um cadastro de um objeto ". $objClasseBasica->getNome() ." já cadastrado";
		$strMensagemClasse		= $objClasseBasica->getNome() ." já cadastrado(a)";
		
		// Gerando a Exception
		return $this->criarException($objClasseBasica, $strNomeClasse, $strResumoClasse, $strDescricaoClasse, $strMensagemClasse);
	}
	
	/**
	 * Método privado que cria a classe de exception (genérica) com todos os seus elementos associados
	 * 
	 * @access private
	 * @param Classe $objClasseBasica
	 * @param string $strNomeClasse
	 * @param string $strResumoClasse
	 * @param string $strDescricaoClasse
	 * @param string $strMensagemClasse
	 * @return Classe
	 */
	private function criarException(Classe $objClasseBasica, $strNomeClasse, $strResumoClasse, $strDescricaoClasse, $strMensagemClasse) {
		
		/**
		 * Lista de métodos e parâmetros comuns
		 */
		$strListaParametros = "";
		$arrObjParametrosPk	= array();
		$arrObjAtributosPk	= array();
		foreach ($objClasseBasica->getAtributos() as $objAtributo) {
			
			// Verificando se o atributo é uma PK
			if ($objAtributo->getChavePk()) {
				
				// Criando a lista de parâmetros comuns
				$strNomeId					= Util::tipoAbreviado($objAtributo->getTipo()) . ucfirst($objAtributo->getNome());
				$strListaParametros	.= '$this->'. $strNomeId .' = $'. $strNomeId .";\r\n";
				
				// Criando os atributos (PKs)
				$intClasseId					= 0;
				$intAtributoId				= 0;
				$strNome							= $objAtributo->getNome();
				$strAcesso						= "private";
				$strTipo							= $objAtributo->getTipo();
				$strResumo						= $objAtributo->getResumo();
				$strDescricao					= $objAtributo->getDescricao();
				$strColunaBd					= "";
				$bolChavePk						= false;
				$intOrdem						= (int) 0;
				$arrObjAtributosPk[]	= new Atributo($intClasseId, $intAtributoId, $strNome, $strAcesso, $strTipo, $strResumo, $strDescricao, $strColunaBd, $bolChavePk, $intOrdem);
				
				// Criando os parametros comuns (PKs)
				$intMetodoId					= 0;
				$intParametroId				= 0;
				$strNome							= $objAtributo->getNome();
				$strTipo							= $objAtributo->getTipo();
				$strValorPadrao						= (string) "";
				$intOrdem							= (int) 0;
				$arrObjParametrosPk[]	= new Parametro($intMetodoId, $intParametroId, $strNome, $strTipo, $strValorPadrao, $intOrdem);
				
				// Criando os métodos (PKs)
			}
		}
		
		
		/**
		 * Gerando a Classe Exception
		 */
		$intSistemaId		= $objClasseBasica->getSistemaId();
		$intClasseId		= 0;
		$strNome				= $strNomeClasse;
		$strTipo				= "CL";
		$strTipoCamada	= "EX";
		$strResumo			= $strResumoClasse;
		$strDescricao		= $strDescricaoClasse;
		$strAutor				= $objClasseBasica->getAutor();
		$strPacote			= $objClasseBasica->getPacote();
		$strSubPacote		= $objClasseBasica->getSubpacote();
		$strVersao			= $objClasseBasica->getVersao();
		$strCriadoEm		= date("Y-m-d H:i:s");
		$strTabelaBd		= "";
		$bolNovaVersao		= $objClasseBasica->getNovaVersao();
		$strNameSpace		= $objClasseBasica->getNameSpace();
		$objClasse			= new Classe($intSistemaId, $intClasseId, $strNome, $strTipo, $strTipoCamada, $strResumo, $strDescricao, $strAutor, $strPacote, $strSubPacote, $strVersao, $strCriadoEm, $strTabelaBd, $bolNovaVersao, $strNameSpace);
		
		// Definindo os atributos da classe (PKs)
		foreach ($arrObjAtributosPk as $objAtributo) $objClasse->adicionarAtributo(clone $objAtributo);
		
		
		// Gerando o método construtor
		$intClasseId	= 0;
		$intMetodoId	= 0;
		$strNome			= "__construct";
		$strAcesso		= "public";
		$strRetorno		= "";
		$strResumo		= "Método construtor da classe";
		$strDescricao	= "";
		$intOrdem		= (int) 0;
		
		// Definindo o conteúdo
		$strConteudo	 = 'parent::__construct("'. $strMensagemClasse .'");'."\r\n";
		$strConteudo	.= $strListaParametros;
		$objMetodo		= new Metodo($intClasseId, $intMetodoId, $strNome, $strAcesso, $strRetorno, $strConteudo, $strResumo, $strDescricao, $intOrdem);
		$objClasse->adicionarMetodo($objMetodo);
		
		// Definindo os parametros do método (PKs)
		foreach ($arrObjParametrosPk as $objParametro) $objMetodo->adicionarParametro(clone $objParametro);
		
		
		// Criando os métodos GET
		foreach ($arrObjAtributosPk as $objAtributo) {
			$strTipoAbreviado	= Util::tipoAbreviado($objAtributo->getTipo());
			$strNomeId				= ucfirst($objAtributo->getNome());
			
			// Gerando os Métodos GET
			$intClasseId	= 0;
			$intMetodoId	= 0;
			$strNome			= "get". $strNomeId;
			$strAcesso		= "public";
			$strRetorno		= $objAtributo->getTipo();
			$strConteudo	= 'return $this->'. $strTipoAbreviado . $strNomeId .';';
			$strResumo		= 'Retorna o valor de <var>$this->'. $strTipoAbreviado . $strNomeId .'</var>';
			$strDescricao	= "";
			$intOrdem		= (int) 0;
			$objMetodo		= new Metodo($intClasseId, $intMetodoId, $strNome, $strAcesso, $strRetorno, $strConteudo, $strResumo, $strDescricao, $intOrdem);
			$objClasse->adicionarMetodo($objMetodo);
		}
		// Retornando a classe de Excessão
		return $objClasse;
	}
}
