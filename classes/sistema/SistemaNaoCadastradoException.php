<?php
/**
 * Exceção de Sistema não cadastrado
 * Será levantada caso ocorra algum acesso a um objeto Sistema que não cadastrado
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:29:13
 */
class SistemaNaoCadastradoException extends Exception {
	/**
	 * Código do Sistema
	 *
	 * @access private
	 * @var int
	 */
	private $intSistemaId;
	
	/**
	 * Método construtor da classe
	 *
	 * @access public
	 * @param int $intSistemaId
	 */
	public function __construct($intSistemaId) {
		parent::__construct("Sistema não cadastrado(a)");
		$this->intSistemaId = $intSistemaId;
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
	
}
