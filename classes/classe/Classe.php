<?php
/**
 * Classe de Classes
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:27:01
 */
class Classe {
	/**
	 * Código do Sistema
	 *
	 * @access private
	 * @var int
	 */
	private $intSistemaId;
	
	/**
	 * Código da Classe
	 *
	 * @access private
	 * @var int
	 */
	private $intClasseId;
	
	/**
	 * Nome da Classe
	 *
	 * @access private
	 * @var string
	 */
	private $strNome;
	
	/**
	 * Tipo da Classe
	 *
	 * @access private
	 * @var string
	 */
	private $strTipo;
	
	/**
	 * Tipo da Camada da Classe
	 *
	 * @access private
	 * @var string
	 */
	private $strTipoCamada;
	
	/**
	 * Resumo da Classe
	 *
	 * @access private
	 * @var string
	 */
	private $strResumo;
	
	/**
	 * Descrição da Classe
	 *
	 * @access private
	 * @var string
	 */
	private $strDescricao;
	
	/**
	 * Autor da Classe
	 *
	 * @access private
	 * @var string
	 */
	private $strAutor;
	
	/**
	 * Pacote da Classe
	 *
	 * @access private
	 * @var string
	 */
	private $strPacote;
	
	/**
	 * Subpacote da Classe
	 *
	 * @access private
	 * @var string
	 */
	private $strSubpacote;
	
	/**
	 * Versão da Classe
	 *
	 * @access private
	 * @var string
	 */
	private $strVersao;
	
	/**
	 * Data de Criação da Classe
	 *
	 * @access private
	 * @var string
	 */
	private $strDataCriacao;
	
	/**
	 * Tabela do banco de dados
	 *
	 * @access private
	 * @var string
	 */
	private $strTabelaBd;
	
	/**
	 * Flag indicadora da Nova Versão
	 *
	 * @access private
	 * @var boolean
	 */
	private $bolNovaVersao;
	
	/**
	 * NameSpace do Pacote (Apenas Nova Versão)
	 *
	 * @access private
	 * @var string
	 */
	private $strNameSpace;
	
	/**
	 * Array de objetos Intface
	 *
	 * @access private
	 * @var array
	 */
	private $arrObjIntfaces=array();
	
	/**
	 * Array de objetos Atributos
	 *
	 * @access private
	 * @var array
	 */
	private $arrObjAtributos=array();
	
	/**
	 * Array de objetos Metodos
	 *
	 * @access private
	 * @var array
	 */
	private $arrObjMetodos=array();
	
	/**
	 * Método construtor da classe
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @param int $intClasseId
	 * @param string $strNome
	 * @param string $strTipo
	 * @param string $strTipoCamada
	 * @param string $strResumo
	 * @param string $strDescricao
	 * @param string $strAutor
	 * @param string $strPacote
	 * @param string $strSubpacote
	 * @param string $strVersao
	 * @param string $strDataCriacao
	 * @param string $strTabelaBd
	 * @param boolean $bolNovaVersao
	 * @param string $strNameSpace
	 * @param array $arrObjAtributos=array()
	 * @param array $arrObjMetodos=array()
	 * @param array $arrObjIntfaces=array()
	 */
	public function __construct($intSistemaId, $intClasseId, $strNome, $strTipo, $strTipoCamada, $strResumo, $strDescricao, $strAutor, $strPacote, $strSubpacote, $strVersao, $strDataCriacao, $strTabelaBd, $bolNovaVersao, $strNameSpace, $arrObjAtributos=array(), $arrObjMetodos=array(), $arrObjIntfaces=array()) {
		$this->setSistemaId($intSistemaId);
		$this->setClasseId($intClasseId);
		$this->setNome($strNome);
		$this->setTipo($strTipo);
		$this->setTipoCamada($strTipoCamada);
		$this->setResumo($strResumo);
		$this->setDescricao($strDescricao);
		$this->setAutor($strAutor);
		$this->setPacote($strPacote);
		$this->setSubpacote($strSubpacote);
		$this->setVersao($strVersao);
		$this->setDataCriacao($strDataCriacao);
		$this->setTabelaBd($strTabelaBd);
		$this->setNovaVersao($bolNovaVersao);
		$this->setNameSpace($strNameSpace);
		$this->setAtributos($arrObjAtributos);
		$this->setMetodos($arrObjMetodos);
		$this->setIntfaces($arrObjIntfaces);
	}
	
	/**
	 * Retorna o valor de <var>$this->intSistemaId</var>
	 *
	 * @access public
	 * @return int
	 */
	public function getSistemaId() {
		return $this->intSistemaId;
	}
	
	/**
	 * Define o valor de <var>$this->intSistemaId</var>
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @return void
	 */
	public function setSistemaId($intSistemaId) {
		$this->intSistemaId = (int) $intSistemaId;
	}
	
	/**
	 * Retorna o valor de <var>$this->intClasseId</var>
	 *
	 * @access public
	 * @return int
	 */
	public function getClasseId() {
		return $this->intClasseId;
	}
	
	/**
	 * Define o valor de <var>$this->intClasseId</var>
	 *
	 * @access public
	 * @param int $intClasseId
	 * @return void
	 */
	public function setClasseId($intClasseId) {
		$this->intClasseId = (int) $intClasseId;
		$this->atualizarClasseId();
	}
	
	/**
	 * Retorna o valor de <var>$this->strNome</var>
	 *
	 * @access public
	 * @return string
	 */
	public function getNome() {
		return $this->strNome;
	}
	
	/**
	 * Define o valor de <var>$this->strNome</var>
	 *
	 * @access public
	 * @param string $strNome
	 * @return void
	 */
	public function setNome($strNome) {
		$this->strNome = (string) $strNome;
	}
	
	/**
	 * Retorna o valor de <var>$this->strTipo</var>
	 *
	 * @access public
	 * @return string
	 */
	public function getTipo() {
		return $this->strTipo;
	}
	
	/**
	 * Define o valor de <var>$this->strTipo</var>
	 *
	 * @access public
	 * @param string $strTipo
	 * @return void
	 */
	public function setTipo($strTipo) {
		$this->strTipo = (string) $strTipo;
	}
	
	/**
	 * Retorna o valor de <var>$this->strTipoCamada</var>
	 *
	 * @access public
	 * @return string
	 */
	public function getTipoCamada() {
		return $this->strTipoCamada;
	}
	
	/**
	 * Define o valor de <var>$this->strTipoCamada</var>
	 *
	 * @access public
	 * @param string $strTipoCamada
	 * @return void
	 */
	public function setTipoCamada($strTipoCamada) {
		$this->strTipoCamada = (string) $strTipoCamada;
	}
	
	/**
	 * Retorna o valor de <var>$this->strResumo</var>
	 *
	 * @access public
	 * @return string
	 */
	public function getResumo() {
		return $this->strResumo;
	}
	
	/**
	 * Define o valor de <var>$this->strResumo</var>
	 *
	 * @access public
	 * @param string $strResumo
	 * @return void
	 */
	public function setResumo($strResumo) {
		$this->strResumo = (string) $strResumo;
	}
	
	/**
	 * Retorna o valor de <var>$this->strDescricao</var>
	 *
	 * @access public
	 * @return string
	 */
	public function getDescricao() {
		return $this->strDescricao;
	}
	
	/**
	 * Define o valor de <var>$this->strDescricao</var>
	 *
	 * @access public
	 * @param string $strDescricao
	 * @return void
	 */
	public function setDescricao($strDescricao) {
		$this->strDescricao = (string) $strDescricao;
	}
	
	/**
	 * Retorna o valor de <var>$this->strAutor</var>
	 *
	 * @access public
	 * @return string
	 */
	public function getAutor() {
		return $this->strAutor;
	}
	
	/**
	 * Define o valor de <var>$this->strAutor</var>
	 *
	 * @access public
	 * @param string $strAutor
	 * @return void
	 */
	public function setAutor($strAutor) {
		$this->strAutor = (string) $strAutor;
	}
	
	/**
	 * Retorna o valor de <var>$this->strPacote</var>
	 *
	 * @access public
	 * @return string
	 */
	public function getPacote() {
		return $this->strPacote;
	}
	
	/**
	 * Define o valor de <var>$this->strPacote</var>
	 *
	 * @access public
	 * @param string $strPacote
	 * @return void
	 */
	public function setPacote($strPacote) {
		$this->strPacote = (string) $strPacote;
	}
	
	/**
	 * Retorna o valor de <var>$this->strSubpacote</var>
	 *
	 * @access public
	 * @return string
	 */
	public function getSubpacote() {
		return $this->strSubpacote;
	}
	
	/**
	 * Define o valor de <var>$this->strSubpacote</var>
	 *
	 * @access public
	 * @param string $strSubpacote
	 * @return void
	 */
	public function setSubpacote($strSubpacote) {
		$this->strSubpacote = (string) $strSubpacote;
	}
	
	/**
	 * Retorna o valor de <var>$this->strVersao</var>
	 *
	 * @access public
	 * @return string
	 */
	public function getVersao() {
		return $this->strVersao;
	}
	
	/**
	 * Define o valor de <var>$this->strVersao</var>
	 *
	 * @access public
	 * @param string $strVersao
	 * @return void
	 */
	public function setVersao($strVersao) {
		$this->strVersao = (string) $strVersao;
	}
	
	/**
	 * Retorna o valor de <var>$this->strDataCriacao</var>
	 *
	 * @access public
	 * @return string
	 */
	public function getDataCriacao() {
		return $this->strDataCriacao;
	}
	
	/**
	 * Define o valor de <var>$this->strDataCriacao</var>
	 *
	 * @access public
	 * @param string $strDataCriacao
	 * @return void
	 */
	public function setDataCriacao($strDataCriacao) {
		$this->strDataCriacao = (string) $strDataCriacao;
	}
	
	/**
	 * Retorna o valor de <var>$this->strTabelaBd</var>
	 *
	 * @access public
	 * @return string
	 */
	public function getTabelaBd() {
		return $this->strTabelaBd;
	}
	
	/**
	 * Define o valor de <var>$this->strTabelaBd</var>
	 *
	 * @access public
	 * @param string $strTabelaBd
	 * @return void
	 */
	public function setTabelaBd($strTabelaBd) {
		$this->strTabelaBd = (string) $strTabelaBd;
	}
	
	/**
	 * Retorna o valor de <var>$this->bolNovaVersao</var>
	 *
	 * @access public
	 * @return boolean
	 */
	public function getNovaVersao() {
		return $this->bolNovaVersao;
	}
	
	/**
	 * Define o valor de <var>$this->bolNovaVersao</var>
	 *
	 * @access public
	 * @param boolean $bolNovaVersao
	 * @return void
	 */
	public function setNovaVersao($bolNovaVersao) {
		$this->bolNovaVersao = (boolean) $bolNovaVersao;
	}
	
	/**
	 * Retorna o valor de <var>$this->strNameSpace</var>
	 *
	 * @access public
	 * @return string
	 */
	public function getNameSpace() {
		return $this->strNameSpace;
	}
	
	/**
	 * Define o valor de <var>$this->strNameSpace</var>
	 *
	 * @access public
	 * @param string $strNameSpace
	 * @return void
	 */
	public function setNameSpace($strNameSpace) {
		$this->strNameSpace = (string) $strNameSpace;
	}
	
	/**
	 * Método que compara um objeto passado por parametro com o próprio objeto
	 *
	 * @access public
	 * @param Classe $objClasse
	 * @return boolean
	 */
	public function equals(Classe $objClasse) {
		if ($this->intSistemaId == $objClasse->getSistemaId() &&
			$this->intClasseId == $objClasse->getClasseId() &&
			$this->strNome == $objClasse->getNome() &&
			$this->strTipo == $objClasse->getTipo() &&
			$this->strTipoCamada == $objClasse->getTipoCamada() &&
			$this->strResumo == $objClasse->getResumo() &&
			$this->strDescricao == $objClasse->getDescricao() &&
			$this->strAutor == $objClasse->getAutor() &&
			$this->strPacote == $objClasse->getPacote() &&
			$this->strSubpacote == $objClasse->getSubpacote() &&
			$this->strVersao == $objClasse->getVersao() &&
			$this->strDataCriacao == $objClasse->getDataCriacao() &&
			$this->strTabelaBd == $objClasse->getTabelaBd() &&
			$this->bolNovaVersao == $objClasse->getNovaVersao() &&
			$this->strNameSpace == $objClasse->getNameSpace()) return true;
		return false;
	}
	
	/**
	 * Retorna o valor de <var>$this->arrObjIntfaces</var>
	 *
	 * @access public
	 * @return array
	 */
	public function getIntfaces() {
		return $this->arrObjIntfaces;
	}
	
	/**
	 * Define o valor de <var>$this->arrObjIntfaces</var>
	 *
	 * @access public
	 * @param array $arrObjIntfaces
	 * @return void
	 */
	public function setIntfaces($arrObjIntfaces) {
		if (is_array($arrObjIntfaces)) {
			$this->arrObjIntfaces = $arrObjIntfaces;
			$this->atualizarClasseId();
		}
	}
	
	/**
	 * Adiciona um objeto ao array <var>$this->arrObjIntfaces</var>
	 *
	 * @access public
	 * @param Intface $objIntface
	 * @return void
	 */
	public function adicionarIntface(Intface $objIntface) {
		$this->arrObjIntfaces[] = $objIntface;
		$objIntface->setClasseId($this->intClasseId);
	}
	
	/**
	 * Retorna o valor de <var>$this->arrObjAtributos</var>
	 *
	 * @access public
	 * @return array
	 */
	public function getAtributos() {
		return $this->arrObjAtributos;
	}
	
	/**
	 * Define o valor de <var>$this->arrObjAtributos</var>
	 *
	 * @access public
	 * @param array $arrObjAtributos
	 * @return void
	 */
	public function setAtributos($arrObjAtributos) {
		if (is_array($arrObjAtributos)) {
			foreach ($arrObjAtributos as $objAtributo) {
				$this->adicionarAtributo($objAtributo);
			}
		}
	}
	
	/**
	 * Adiciona um objeto ao array <var>$this->arrObjAtributos</var>
	 *
	 * @access public
	 * @param Atributo $objAtributo
	 * @return void
	 */
	public function adicionarAtributo(Atributo $objAtributo) {
		$this->arrObjAtributos[] = $objAtributo;
		$objAtributo->setClasseId($this->intClasseId);
		$objAtributo->setOrdem( count($this->arrObjAtributos) * 10 );
	}
	
	/**
	 * Retorna o valor de <var>$this->arrObjMetodos</var>
	 *
	 * @access public
	 * @return array
	 */
	public function getMetodos() {
		return $this->arrObjMetodos;
	}
	
	/**
	 * Define o valor de <var>$this->arrObjMetodos</var>
	 *
	 * @access public
	 * @param array $arrObjMetodos
	 * @return void
	 */
	public function setMetodos($arrObjMetodos) {
		if (is_array($arrObjMetodos)) {
			foreach ($arrObjMetodos as $objMetodo) {
				$this->adicionarMetodo($objMetodo);
			}
		}
	}
	
	/**
	 * Adiciona um objeto ao array <var>$this->arrObjMetodos</var>
	 *
	 * @access public
	 * @param Metodo $objMetodo
	 * @return void
	 */
	public function adicionarMetodo(Metodo $objMetodo) {
		$this->arrObjMetodos[] = $objMetodo;
		$objMetodo->setClasseId($this->intClasseId);
		$objMetodo->setOrdem( count($this->arrObjMetodos) * 10 );
	}
	
	/**
	 * Método que converte todo o objeto em String
	 *
	 * @access public
	 * @param string $strEOL="\r\n"
	 * @param boolean $bolComentario=true
	 * @return string
	 */
	public function toString($strEOL="\r\n", $bolComentario=true) {
		$strOutput = "";
		
		// Informando o NameSpace (Apenas Versão Nova)
		if ($this->getNovaVersao()) $strOutput .= "namespace ". $this->getNameSpace() ."\\". $this->getSubpacote() .";". $strEOL . $strEOL;
		
		// Exibindo o comentário
		if ($bolComentario) $strOutput .= $this->gerarComentario($strEOL);
		
		// Criando o objeto (Intface, Abstract Class ou Class)
		switch ($this->getTipo()) {
			case "IF"	: $strOutput .= "interface ";
									break;
			case "AC"	: $strOutput .= "abstract ";
			default		: $strOutput .= "class ";
		}
		$strOutput .= $this->getNome();
		
		// Exibindo o extends (Exception)
		if ($this->getTipoCamada() == "EX") $strOutput .= " extends Exception";
		if ($this->getNovaVersao() && $this->getTipoCamada() == "RP") $strOutput .= " extends \WFramework\DAO\FAppDAO";
		
		// Exibindo as interfaces
		$arrObjIntfaces = $this->getIntfaces();
		if (!empty($arrObjIntfaces) && is_array($arrObjIntfaces)) {
			$strIntfaces = "";
			foreach ($arrObjIntfaces as $objIntface) {
				if (!empty($strIntfaces)) $strIntfaces .= ", ";
				$strIntfaces .= $objIntface->toString();
			}
			$strOutput .= " implements ". $strIntfaces;
		}
		$strOutput .= " {". $strEOL;
		
		// Exibindo os atributos
		foreach ($this->getAtributos() as $objAtributo) $strOutput .= $objAtributo->toString($strEOL, $bolComentario) . $strEOL;
		
		// Exibindo os métodos
		foreach ($this->getMetodos() as $objMetodo) $strOutput .= $objMetodo->toString($strEOL, $bolComentario) . $strEOL;
		
		$strOutput .= "}";
		return $strOutput;
	}
	
	/**
	 * Método privado que gera toda a parte de comentário do objeto
	 * Usado pelo toString()
	 *
	 * @access private
	 * @param string $strEOL
	 * @return string
	 */
	private function gerarComentario($strEOL) {
		$strOutput = "";
		if (!empty($this->strResumo))      $strOutput .= " * {$this->strResumo}". $strEOL;
		if (!empty($this->strDescricao))   $strOutput .= " * {$this->strDescricao}". $strEOL;
		if (!empty($this->strResumo) || !empty($this->strDescricao)) $strOutput .= " * ". $strEOL;
		if (!empty($this->strAutor))       $strOutput .= " * @author {$this->strAutor}". $strEOL;
		if (!empty($this->strPacote))      $strOutput .= " * @package {$this->strPacote}". $strEOL;
		if (!empty($this->strSubPacote))   $strOutput .= " * @subpackage {$this->strSubPacote}". $strEOL;
		if (!empty($this->strVersao))      $strOutput .= " * @version {$this->strVersao}". $strEOL;
		if (!empty($this->strDataCriacao)) $strOutput .= " * @since ". date("d/m/Y H:i:s", strtotime($this->strDataCriacao)) . $strEOL;
		if (!empty($strOutput)) $strOutput = "/**". $strEOL . $strOutput ." */". $strEOL;
		return $strOutput;
	}
	
	/**
	 * Método que atualiza todos os Ids dos atributos e métodos para o Id da classe atual
	 *
	 * @access private
	 * @return void
	 */
	private function atualizarClasseId() {
		
		// Atualizando os ClasseIds das Interfaces
		if (is_array($this->arrObjIntfaces)) {
			foreach ($this->arrObjIntfaces as $objIntface) $objIntface->setClasseId($this->intClasseId);
		}
		
		// Atualizando os ClasseIds dos Atributos
		if (is_array($this->arrObjAtributos)) {
			foreach ($this->arrObjAtributos as $objAtributo) $objAtributo->setClasseId($this->intClasseId);
		}
		
		// Atualizando os ClasseIds dos Métodos
		if (is_array($this->arrObjMetodos)) {
			foreach ($this->arrObjMetodos as $objMetodo) $objMetodo->setClasseId($this->intClasseId);
		}
	}
	
}
