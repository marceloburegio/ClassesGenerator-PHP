<?php
/**
 * Classe de Exceções (Throws)
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:38:02
 */
class Throws {
	/**
	 * Código do Método
	 *
	 * @access private
	 * @var int
	 */
	private $intMetodoId;
	
	/**
	 * Código do Throws
	 *
	 * @access private
	 * @var int
	 */
	private $intThrowsId;
	
	/**
	 * Nome da Exception
	 *
	 * @access private
	 * @var string
	 */
	private $strNome;
	
	/**
	 * Ordem do Throws
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
	 * @param int $intThrowsId
	 * @param string $strNome
	 * @param int $intOrdem
	 */
	public function __construct($intMetodoId, $intThrowsId, $strNome, $intOrdem) {
		$this->setMetodoId($intMetodoId);
		$this->setThrowsId($intThrowsId);
		$this->setNome($strNome);
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
	 * Retorna o valor de <var>$this->intThrowsId</var>
	 *
	 * @access public
	 * @return int
	 */
	public function getThrowsId() {
		return $this->intThrowsId;
	}
	
	/**
	 * Define o valor de <var>$this->intThrowsId</var>
	 *
	 * @access public
	 * @param int $intThrowsId
	 * @return void
	 */
	public function setThrowsId($intThrowsId) {
		$this->intThrowsId = (int) $intThrowsId;
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
	 * @param Throws $objThrows
	 * @return boolean
	 */
	public function equals(Throws $objThrows) {
		if ($this->intMetodoId == $objThrows->getMetodoId() &&
			$this->intThrowsId == $objThrows->getThrowsId() &&
			$this->strNome == $objThrows->getNome() &&
			$this->intOrdem == $objThrows->getOrdem()) return true;
		return false;
	}
	
}
