<?php
/**
 * Classe de Atributos
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:26:14
 */
class Atributo {
	/**
	 * Código da Classe
	 *
	 * @access private
	 * @var int
	 */
	private $intClasseId;
	
	/**
	 * Código do Atributo
	 *
	 * @access private
	 * @var int
	 */
	private $intAtributoId;
	
	/**
	 * Nome do Atributo
	 *
	 * @access private
	 * @var string
	 */
	private $strNome;
	
	/**
	 * Acesso do Atributo
	 *
	 * @access private
	 * @var string
	 */
	private $strAcesso;
	
	/**
	 * Tipo do Atributo
	 *
	 * @access private
	 * @var string
	 */
	private $strTipo;
	
	/**
	 * Resumo do Atributo
	 *
	 * @access private
	 * @var string
	 */
	private $strResumo;
	
	/**
	 * Descrição do Atributo
	 *
	 * @access private
	 * @var string
	 */
	private $strDescricao;
	
	/**
	 * Coluna do banco de dados
	 *
	 * @access private
	 * @var string
	 */
	private $strColunaBd;
	
	/**
	 * Indica se o atributo é a Chave Primária
	 *
	 * @access private
	 * @var boolean
	 */
	private $bolChavePk;
	
	/**
	 * Ordem do Atributo
	 *
	 * @access private
	 * @var int
	 */
	private $intOrdem;
	
	/**
	 * Método construtor da classe
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param int $intAtributoId
	 * @param string $strNome
	 * @param string $strAcesso
	 * @param string $strTipo
	 * @param string $strResumo
	 * @param string $strDescricao
	 * @param string $strColunaBd
	 * @param boolean $bolChavePk
	 * @param int $intOrdem
	 */
	public function __construct($intClasseId, $intAtributoId, $strNome, $strAcesso, $strTipo, $strResumo, $strDescricao, $strColunaBd, $bolChavePk, $intOrdem) {
		$this->setClasseId($intClasseId);
		$this->setAtributoId($intAtributoId);
		$this->setNome($strNome);
		$this->setAcesso($strAcesso);
		$this->setTipo($strTipo);
		$this->setResumo($strResumo);
		$this->setDescricao($strDescricao);
		$this->setColunaBd($strColunaBd);
		$this->setChavePk($bolChavePk);
		$this->setOrdem($intOrdem);
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
	}
	
	/**
	 * Retorna o valor de <var>$this->intAtributoId</var>
	 *
	 * @access public
	 * @return int
	 */
	public function getAtributoId() {
		return $this->intAtributoId;
	}
	
	/**
	 * Define o valor de <var>$this->intAtributoId</var>
	 *
	 * @access public
	 * @param int $intAtributoId
	 * @return void
	 */
	public function setAtributoId($intAtributoId) {
		$this->intAtributoId = (int) $intAtributoId;
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
	 * Retorna o valor de <var>$this->strAcesso</var>
	 *
	 * @access public
	 * @return string
	 */
	public function getAcesso() {
		return $this->strAcesso;
	}
	
	/**
	 * Define o valor de <var>$this->strAcesso</var>
	 *
	 * @access public
	 * @param string $strAcesso
	 * @return void
	 */
	public function setAcesso($strAcesso) {
		$this->strAcesso = (string) $strAcesso;
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
	 * Retorna o valor de <var>$this->strColunaBd</var>
	 *
	 * @access public
	 * @return string
	 */
	public function getColunaBd() {
		return $this->strColunaBd;
	}
	
	/**
	 * Define o valor de <var>$this->strColunaBd</var>
	 *
	 * @access public
	 * @param string $strColunaBd
	 * @return void
	 */
	public function setColunaBd($strColunaBd) {
		$this->strColunaBd = (string) $strColunaBd;
	}
	
	/**
	 * Retorna o valor de <var>$this->bolChavePk</var>
	 *
	 * @access public
	 * @return boolean
	 */
	public function getChavePk() {
		return $this->bolChavePk;
	}
	
	/**
	 * Define o valor de <var>$this->bolChavePk</var>
	 *
	 * @access public
	 * @param boolean $bolChavePk
	 * @return void
	 */
	public function setChavePk($bolChavePk) {
		$this->bolChavePk = (boolean) $bolChavePk;
	}
	
	/**
	 * Retorna o valor de <var>$this->intOrdem</var>
	 *
	 * @access public
	 * @return int
	 */
	public function getOrdem() {
		return $this->intOrdem;
	}
	
	/**
	 * Define o valor de <var>$this->intOrdem</var>
	 *
	 * @access public
	 * @param int $intOrdem
	 * @return void
	 */
	public function setOrdem($intOrdem) {
		$this->intOrdem = (int) $intOrdem;
	}
	
	/**
	 * Método que compara um objeto passado por parametro com o próprio objeto
	 *
	 * @access public
	 * @param Atributo $objAtributo
	 * @return boolean
	 */
	public function equals(Atributo $objAtributo) {
		if ($this->intClasseId == $objAtributo->getClasseId() &&
			$this->intAtributoId == $objAtributo->getAtributoId() &&
			$this->strNome == $objAtributo->getNome() &&
			$this->strAcesso == $objAtributo->getAcesso() &&
			$this->strTipo == $objAtributo->getTipo() &&
			$this->strResumo == $objAtributo->getResumo() &&
			$this->strDescricao == $objAtributo->getDescricao() &&
			$this->strColunaBd == $objAtributo->getColunaBd() &&
			$this->bolChavePk == $objAtributo->getChavePk() &&
			$this->intOrdem == $objAtributo->getOrdem()) return true;
		return false;
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
		
		// Exibindo o comentário
		if ($bolComentario) $strOutput .= $this->gerarComentario($strEOL);
		
		// Criando o atributo
		$strOutput .= $this->strAcesso ." $". Util::tipoAbreviado($this->strTipo) . ucfirst($this->strNome) .";". $strEOL;
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
		if (!empty($this->strResumo))    $strOutput .= " * {$this->strResumo}". $strEOL;
		if (!empty($this->strDescricao)) $strOutput .= " * {$this->strDescricao}". $strEOL;
		if (!empty($this->strResumo) || !empty($this->strDescricao)) $strOutput .= " * ". $strEOL;
		if (!empty($this->strAcesso))    $strOutput .= " * @access {$this->strAcesso}". $strEOL;
		if (!empty($this->strTipo))      $strOutput .= " * @var {$this->strTipo}". $strEOL;
		if (!empty($strOutput)) $strOutput = "/**". $strEOL . $strOutput ." */". $strEOL;
		return $strOutput;
	}
	
}
