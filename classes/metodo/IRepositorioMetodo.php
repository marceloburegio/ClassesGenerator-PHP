<?php
/**
 * Interface do repositótio da classe Metodo
 * Todos os repositórios da classe Metodo deverão implementar esta interface
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:28:07
 */
interface IRepositorioMetodo {
	/**
	 * Assinatura do método que insere um objeto do RepositorioMetodo
	 *
	 * @access public
	 * @param Metodo $objMetodo
	 * @throws MetodoNaoCadastradoException
	 * @throws RepositorioException
	 * @return int
	 */
	public function inserir(Metodo $objMetodo);
	
	/**
	 * Assinatura do método que atualiza um objeto do RepositorioMetodo
	 *
	 * @access public
	 * @param Metodo $objMetodo
	 * @throws MetodoNaoCadastradoException
	 * @throws RepositorioException
	 * @return void
	 */
	public function atualizar(Metodo $objMetodo);
	
	/**
	 * Assinatura do método que remove um objeto do RepositorioMetodo
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param string $strNome
	 * @throws RepositorioException
	 * @return void
	 */
	public function remover($intClasseId, $strNome);
	
	/**
	 * Assinatura do método que procura um determinado objeto no RepositorioMetodo
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param string $strNome
	 * @throws MetodoNaoCadastradoException
	 * @return Metodo
	 */
	public function procurar($intClasseId, $strNome);
	
	/**
	 * Assinatura do método que verifica se existe um determinado objeto no RepositorioMetodo
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param string $strNome
	 * @throws RepositorioException
	 * @return boolean
	 */
	public function existe($intClasseId, $strNome);
	
	/**
	 * Assinatura do método que lista todos os objetos do RepositorioMetodo
	 *
	 * @access public
	 * @throws RepositorioException
	 * @return array
	 */
	public function listar();
	
}
