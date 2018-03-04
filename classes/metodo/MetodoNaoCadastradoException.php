<?php
/**
 * Exceção de Metodo não cadastrado
 * Será levantada caso ocorra algum acesso a um objeto Metodo que não cadastrado
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:28:07
 */
class MetodoNaoCadastradoException extends Exception {
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
		parent::__construct("Metodo não cadastrado(a)");
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
