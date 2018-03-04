<?php
/**
 * Interface do repositótio da classe Throws
 * Todos os repositórios da classe Throws deverão implementar esta interface
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:38:02
 */
interface IRepositorioThrows {
	/**
	 * Assinatura do método que insere um objeto do RepositorioThrows
	 *
	 * @access public
	 * @param Throws $objThrows
	 * @throws ThrowsNaoCadastradoException
	 * @throws RepositorioException
	 * @return int
	 */
	public function inserir(Throws $objThrows);
	
	/**
	 * Assinatura do método que atualiza um objeto do RepositorioThrows
	 *
	 * @access public
	 * @param Throws $objThrows
	 * @throws ThrowsNaoCadastradoException
	 * @throws RepositorioException
	 * @return void
	 */
	public function atualizar(Throws $objThrows);
	
	/**
	 * Assinatura do método que remove um objeto do RepositorioThrows
	 *
	 * @access public
	 * @param int $intMetodoId
	 * @param string $strNome
	 * @throws RepositorioException
	 * @return void
	 */
	public function remover($intMetodoId, $strNome);
	
	/**
	 * Assinatura do método que procura um determinado objeto no RepositorioThrows
	 *
	 * @access public
	 * @param int $intMetodoId
	 * @param string $strNome
	 * @throws ThrowsNaoCadastradoException
	 * @return Throws
	 */
	public function procurar($intMetodoId, $strNome);
	
	/**
	 * Assinatura do método que verifica se existe um determinado objeto no RepositorioThrows
	 *
	 * @access public
	 * @param int $intMetodoId
	 * @param string $strNome
	 * @throws RepositorioException
	 * @return boolean
	 */
	public function existe($intMetodoId, $strNome);
	
	/**
	 * Assinatura do método que lista todos os objetos do RepositorioThrows
	 *
	 * @access public
	 * @throws RepositorioException
	 * @return array
	 */
	public function listar();
	
}
