<?php
/**
 * Interface do repositótio da classe Sistema
 * Todos os repositórios da classe Sistema deverão implementar esta interface
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:29:13
 */
interface IRepositorioSistema {
	/**
	 * Assinatura do método que insere um objeto do RepositorioSistema
	 *
	 * @access public
	 * @param Sistema $objSistema
	 * @throws SistemaNaoCadastradoException
	 * @throws RepositorioException
	 * @return int
	 */
	public function inserir(Sistema $objSistema);
	
	/**
	 * Assinatura do método que atualiza um objeto do RepositorioSistema
	 *
	 * @access public
	 * @param Sistema $objSistema
	 * @throws SistemaNaoCadastradoException
	 * @throws RepositorioException
	 * @return void
	 */
	public function atualizar(Sistema $objSistema);
	
	/**
	 * Assinatura do método que remove um objeto do RepositorioSistema
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @throws RepositorioException
	 * @return void
	 */
	public function remover($intSistemaId);
	
	/**
	 * Assinatura do método que procura um determinado objeto no RepositorioSistema
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @throws SistemaNaoCadastradoException
	 * @return Sistema
	 */
	public function procurar($intSistemaId);
	
	/**
	 * Assinatura do método que verifica se existe um determinado objeto no RepositorioSistema
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @throws RepositorioException
	 * @return boolean
	 */
	public function existe($intSistemaId);
	
	/**
	 * Assinatura do método que lista todos os objetos do RepositorioSistema
	 *
	 * @access public
	 * @throws RepositorioException
	 * @return array
	 */
	public function listar();
	
}
