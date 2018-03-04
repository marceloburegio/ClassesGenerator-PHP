<?php
/**
 * Interface do repositótio da classe Intface
 * Todos os repositórios da classe Intface deverão implementar esta interface
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:27:19
 */
interface IRepositorioIntface {
	/**
	 * Assinatura do método que insere um objeto do RepositorioIntface
	 *
	 * @access public
	 * @param Intface $objIntface
	 * @throws IntfaceNaoCadastradoException
	 * @throws RepositorioException
	 * @return int
	 */
	public function inserir(Intface $objIntface);
	
	/**
	 * Assinatura do método que atualiza um objeto do RepositorioIntface
	 *
	 * @access public
	 * @param Intface $objIntface
	 * @throws IntfaceNaoCadastradoException
	 * @throws RepositorioException
	 * @return void
	 */
	public function atualizar(Intface $objIntface);
	
	/**
	 * Assinatura do método que remove um objeto do RepositorioIntface
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param int $intIntfaceId
	 * @throws RepositorioException
	 * @return void
	 */
	public function remover($intClasseId, $intIntfaceId);
	
	/**
	 * Assinatura do método que procura um determinado objeto no RepositorioIntface
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param int $intIntfaceId
	 * @throws IntfaceNaoCadastradoException
	 * @return Intface
	 */
	public function procurar($intClasseId, $intIntfaceId);
	
	/**
	 * Assinatura do método que verifica se existe um determinado objeto no RepositorioIntface
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param int $intIntfaceId
	 * @throws RepositorioException
	 * @return boolean
	 */
	public function existe($intClasseId, $intIntfaceId);
	
	/**
	 * Assinatura do método que lista todos os objetos do RepositorioIntface
	 *
	 * @access public
	 * @throws RepositorioException
	 * @return array
	 */
	public function listar();
	
}
