<?php
/**
 * Exceção de Intface não cadastrado
 * Será levantada caso ocorra algum acesso a um objeto Intface que não cadastrado
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:27:19
 */
class IntfaceNaoCadastradoException extends Exception {
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
	 * Método construtor da classe
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param int $intIntfaceId
	 */
	public function __construct($intClasseId, $intIntfaceId) {
		parent::__construct("Intface não cadastrado(a)");
		$this->intClasseId = $intClasseId;
		$this->intIntfaceId = $intIntfaceId;
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
	 * Retorna o valor de <var>$this->intIntfaceId</var>
	 *
	 * @access public
	 * @return int
	 */
	public function getIntfaceId() {
		return $this->intIntfaceId;
	}
	
}
