<?php
/**
 * Exceção de Throws não cadastrado
 * Será levantada caso ocorra algum acesso a um objeto Throws que não cadastrado
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:38:02
 */
class ThrowsNaoCadastradoException extends Exception {
	/**
	 * Código do Método
	 *
	 * @access private
	 * @var int
	 */
	private $intMetodoId;
	
	/**
	 * Nome da Exception
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
		parent::__construct("Throws não cadastrado(a)");
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
