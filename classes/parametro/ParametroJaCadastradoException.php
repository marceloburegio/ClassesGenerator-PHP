<?php
/**
 * Exceção de Parametro já cadastrado
 * Será levantada caso ocorra um cadastro de um objeto Parametro já cadastrado
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:28:51
 */
class ParametroJaCadastradoException extends Exception {
	/**
	 * Código do Método
	 *
	 * @access private
	 * @var int
	 */
	private $intMetodoId;
	
	/**
	 * Nome do Parâmetro
	 *
	 * @access private
	 * @var string
	 */
	private $strNome;
	
	/**
	 * Método construtor da classe
	 *
	 * @access public
	 * @param int $intMetodoId
	 * @param string $strNome
	 */
	public function __construct($intMetodoId, $strNome) {
		parent::__construct("Parametro já cadastrado(a)");
		$this->intMetodoId = $intMetodoId;
		$this->strNome = $strNome;
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
	 * Retorna o valor de <var>$this->strNome</var>
	 *
	 * @access public
	 * @return string
	 */
	public function getNome() {
		return $this->strNome;
	}
	
}
