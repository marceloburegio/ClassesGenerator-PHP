<?php
/**
 * Exceção de Parametro não cadastrado
 * Será levantada caso ocorra algum acesso a um objeto Parametro que não cadastrado
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:28:51
 */
class ParametroNaoCadastradoException extends Exception {
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
		parent::__construct("Parametro não cadastrado(a)");
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
