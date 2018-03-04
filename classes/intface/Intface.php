<?php
/**
 * Classe de Intface
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:27:19
 */
class Intface {
	/**
	 * Código da Classe
	 *
	 * @access private
	 * @var int
	 */
	private $intClasseId;
	
	/**
	 * Código da Intface
	 *
	 * @access private
	 * @var int
	 */
	private $intIntfaceId;
	
	/**
	 * Nome da Intface
	 *
	 * @access private
	 * @var string
	 */
	private $strNome;
	
	/**
	 * Método construtor da classe
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param int $intIntfaceId
	 * @param string $strNome=""
	 */
	public function __construct($intClasseId, $intIntfaceId, $strNome="") {
		$this->setClasseId($intClasseId);
		$this->setIntfaceId($intIntfaceId);
		$this->setNome($strNome);
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
	 * Retorna o valor de <var>$this->intIntfaceId</var>
	 *
	 * @access public
	 * @return int
	 */
	public function getIntfaceId() {
		return $this->intIntfaceId;
	}
	
	/**
	 * Define o valor de <var>$this->intIntfaceId</var>
	 *
	 * @access public
	 * @param int $intIntfaceId
	 * @return void
	 */
	public function setIntfaceId($intIntfaceId) {
		$this->intIntfaceId = (int) $intIntfaceId;
	}
	
	/**
	 * Método que compara um objeto passado por parametro com o próprio objeto
	 *
	 * @access public
	 * @param Intface $objIntface
	 * @return boolean
	 */
	public function equals(Intface $objIntface) {
		if ($this->intClasseId == $objIntface->getClasseId() &&
			$this->intIntfaceId == $objIntface->getIntfaceId()) return true;
		return false;
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
		$this->strNome = $strNome;
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
		return $this->getNome();
	}
	
}
