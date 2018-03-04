<?php
/**
 * Cadastro de objetos Throws
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:38:02
 */
class CadastroThrows {
	/**
	 * Repositório de classes Throws
	 *
	 * @access private
	 * @var IRepositorioThrows
	 */
	private $objRepositorioThrows;
	
	/**
	 * Método construtor da classe
	 *
	 * @access public
	 * @param IRepositorioThrows $objRepositorioThrows
	 */
	public function __construct(IRepositorioThrows $objRepositorioThrows) {
		$this->objRepositorioThrows = $objRepositorioThrows;
	}
	
	/**
	 * Método que cadastra um objeto no RepositorioThrows
	 *
	 * @access public
	 * @param Throws $objThrows
	 * @throws ThrowsJaCadastradoException
	 * @throws ThrowsNaoCadastradoException
	 * @throws RepositorioException
	 * @return int
	 */
	public function cadastrar(Throws $objThrows) {
		if ($this->existe($objThrows->getMetodoId(), $objThrows->getNome()))
			throw new ThrowsJaCadastradoException($objThrows->getMetodoId(), $objThrows->getNome());
		return $this->objRepositorioThrows->inserir($objThrows);
	}
	
	/**
	 * Método que atualiza um objeto no RepositorioThrows
	 *
	 * @access public
	 * @param Throws $objThrows
	 * @throws ThrowsNaoCadastradoException
	 * @throws RepositorioException
	 * @return void
	 */
	public function atualizar(Throws $objThrows) {
		$this->objRepositorioThrows->atualizar($objThrows);
	}
	
	/**
	 * Método que remove um objeto do RepositorioThrows
	 *
	 * @access public
	 * @param int $intMetodoId
	 * @param string $strNome
	 * @throws RepositorioException
	 * @return void
	 */
	public function remover($intMetodoId, $strNome) {
		$this->objRepositorioThrows->remover($intMetodoId, $strNome);
	}
	
	/**
	 * Método que procura um determinado objeto no RepositorioThrows
	 *
	 * @access public
	 * @param int $intMetodoId
	 * @param string $strNome
	 * @throws ThrowsNaoCadastradoException
	 * @return Throws
	 */
	public function procurar($intMetodoId, $strNome) {
		return $this->objRepositorioThrows->procurar($intMetodoId, $strNome);
	}
	
	/**
	 * Método que verifica se existe um determinado objeto no RepositorioThrows
	 *
	 * @access public
	 * @param int $intMetodoId
	 * @param string $strNome
	 * @throws RepositorioException
	 * @return boolean
	 */
	public function existe($intMetodoId, $strNome) {
		return $this->objRepositorioThrows->existe($intMetodoId, $strNome);
	}
	
	/**
	 * Método que lista todos os objetos do RepositorioThrows
	 *
	 * @access public
	 * @throws RepositorioException
	 * @return array
	 */
	public function listar() {
		return $this->objRepositorioThrows->listar();
	}
	
	/**
	 * Método que lista todos os objetos do RepositorioThrows por MetodoId
	 *
	 * @access public
	 * @param int $intMetodoId
	 * @return array
	 */
	public function listarPorMetodoId($intMetodoId) {
		return $this->objRepositorioThrows->listarPorMetodoId($intMetodoId);
	}
	
	/**
	 * Método que lista todos os objetos do RepositorioThrows por MetodoId Ordenado
	 *
	 * @access public
	 * @param int $intMetodoId
	 * @return array
	 */
	public function listarPorMetodoIdOrdenado($intMetodoId) {
		return $this->objRepositorioThrows->listarPorMetodoIdOrdenado($intMetodoId);
	}
	
}
