<?php
/**
 * Exceção de Classe já cadastrado
 * Será levantada caso ocorra um cadastro de um objeto Classe já cadastrado
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:27:01
 */
class ClasseJaCadastradoException extends Exception {
	/**
	 * Código do Sistema
	 *
	 * @access private
	 * @var int
	 */
	private $intSistemaId;
	
	/**
	 * Nome da Classe
	 *
	 * @access private
	 * @var string
	 */
	private $strNome;
	
	/**
	 * Método construtor da classe
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @param string $strNome
	 */
	public function __construct($intSistemaId, $strNome) {
		parent::__construct("Classe já cadastrado(a)");
		$this->intSistemaId = $intSistemaId;
		$this->strNome = $strNome;
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
	 * Retorna o valor de <var>$this->strNome</var>
	 *
	 * @access public
	 * @return string
	 */
	public function getNome() {
		return $this->strNome;
	}
	
}
