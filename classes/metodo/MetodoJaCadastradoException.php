<?php
/**
 * Exceção de Metodo já cadastrado
 * Será levantada caso ocorra um cadastro de um objeto Metodo já cadastrado
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:28:07
 */
class MetodoJaCadastradoException extends Exception {
	/**
	 * Código da Classe
	 *
	 * @access private
	 * @var int
	 */
	private $intClasseId;
	
	/**
	 * Nome do Método
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
	 * @param string $strNome
	 */
	public function __construct($intClasseId, $strNome) {
		parent::__construct("Metodo já cadastrado(a)");
		$this->intClasseId = $intClasseId;
		$this->strNome = $strNome;
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
	 * Retorna o valor de <var>$this->strNome</var>
	 *
	 * @access public
	 * @return string
	 */
	public function getNome() {
		return $this->strNome;
	}
	
}
