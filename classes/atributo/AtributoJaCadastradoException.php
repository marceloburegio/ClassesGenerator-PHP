<?php
/**
 * Exceção de Atributo já cadastrado
 * Será levantada caso ocorra um cadastro de um objeto Atributo já cadastrado
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:26:14
 */
class AtributoJaCadastradoException extends Exception {
	/**
	 * Código da Classe
	 *
	 * @access private
	 * @var int
	 */
	private $intClasseId;
	
	/**
	 * Nome do Atributo
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
		parent::__construct("Atributo já cadastrado(a). Nome: ". $strNome);
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
