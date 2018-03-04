<?php
/**
 * Classe de Parâmetros
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:28:51
 */
class Parametro {
	/**
	 * Código do Método
	 *
	 * @access private
	 * @var int
	 */
	private $intMetodoId;
	
	/**
	 * Código do Parâmetro
	 *
	 * @access private
	 * @var int
	 */
	private $intParametroId;
	
	/**
	 * Nome do Parâmetro
	 *
	 * @access private
	 * @var string
	 */
	private $strNome;
	
	/**
	 * Tipo do Parâmetro
	 *
	 * @access private
	 * @var string
	 */
	private $strTipo;
	
	/**
	 * Valor Padrão do Parâmetro
	 *
	 * @access private
	 * @var string
	 */
	private $strValorPadrao;
	
	/**
	 * Ordem do Parâmetro
	 *
	 * @access private
	 * @var int
	 */
	private $intOrdem;
	
	/**
	 * Método construtor da classe
	 *
	 * @access public
	 * @param int $intMetodoId
	 * @param int $intParametroId
	 * @param string $strNome
	 * @param string $strTipo
	 * @param string $strValorPadrao
	 * @param int $intOrdem
	 */
	public function __construct($intMetodoId, $intParametroId, $strNome, $strTipo, $strValorPadrao, $intOrdem) {
		$this->setMetodoId($intMetodoId);
		$this->setParametroId($intParametroId);
		$this->setNome($strNome);
		$this->setTipo($strTipo);
		$this->setValorPadrao($strValorPadrao);
		$this->setOrdem($intOrdem);
	}
	
	/**
	 * Retorna o valor de <var>$this->intMetodoId</var>
	 *
	 * @access public
	 * @return int
	 */
	public function getMetodoId() {
		return $this->intMetodoId;
	}
	
	/**
	 * Define o valor de <var>$this->intMetodoId</var>
	 *
	 * @access public
	 * @param int $intMetodoId
	 * @return void
	 */
	public function setMetodoId($intMetodoId) {
		$this->intMetodoId = (int) $intMetodoId;
	}
	
	/**
	 * Retorna o valor de <var>$this->intParametroId</var>
	 *
	 * @access public
	 * @return int
	 */
	public function getParametroId() {
		return $this->intParametroId;
	}
	
	/**
	 * Define o valor de <var>$this->intParametroId</var>
	 *
	 * @access public
	 * @param int $intParametroId
	 * @return void
	 */
	public function setParametroId($intParametroId) {
		$this->intParametroId = (int) $intParametroId;
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
	 * Retorna o valor de <var>$this->strValorPadrao</var>
	 *
	 * @access public
	 * @return string
	 */
	public function getValorPadrao() {
		return $this->strValorPadrao;
	}
	
	/**
	 * Define o valor de <var>$this->strValorPadrao</var>
	 *
	 * @access public
	 * @param string $strValorPadrao
	 * @return void
	 */
	public function setValorPadrao($strValorPadrao) {
		$this->strValorPadrao = (string) $strValorPadrao;
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
	 * @param Parametro $objParametro
	 * @return boolean
	 */
	public function equals(Parametro $objParametro) {
		if ($this->intMetodoId == $objParametro->getMetodoId() &&
			$this->intParametroId == $objParametro->getParametroId() &&
			$this->strNome == $objParametro->getNome() &&
			$this->strTipo == $objParametro->getTipo() &&
			$this->strValorPadrao == $objParametro->getValorPadrao() &&
			$this->intOrdem == $objParametro->getOrdem()) return true;
		return false;
	}
	
	/**
	 * Método que converte todo o objeto em String
	 *
	 * @access public
	 * @param string $strEOL="\r\n"
	 * @return string
	 */
	public function toString($strEOL="\r\n") {
		$strOutput = "";
		
		// Criando o atributo
		$strNome = ucfirst($this->strNome);
		$strTipoAbreviado = Util::tipoAbreviado($this->strTipo);
		if ($strTipoAbreviado == "obj") $strOutput .= $this->strTipo ." ";
		
		$strOutput .= "$". $strTipoAbreviado . $strNome;
		if (strlen($this->strValorPadrao) > 0) $strOutput .= "={$this->strValorPadrao}";
		return $strOutput;
	}
}
