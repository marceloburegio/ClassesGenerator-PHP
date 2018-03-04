<?php
/**
 * Interface do repositótio da classe Parametro
 * Todos os repositórios da classe Parametro deverão implementar esta interface
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:28:51
 */
interface IRepositorioParametro {
	/**
	 * Assinatura do método que insere um objeto do RepositorioParametro
	 *
	 * @access public
	 * @param Parametro $objParametro
	 * @throws ParametroNaoCadastradoException
	 * @throws RepositorioException
	 * @return int
	 */
	public function inserir(Parametro $objParametro);
	
	/**
	 * Assinatura do método que atualiza um objeto do RepositorioParametro
	 *
	 * @access public
	 * @param Parametro $objParametro
	 * @throws ParametroNaoCadastradoException
	 * @throws RepositorioException
	 * @return void
	 */
	public function atualizar(Parametro $objParametro);
	
	/**
	 * Assinatura do método que remove um objeto do RepositorioParametro
	 *
	 * @access public
	 * @param int $intMetodoId
	 * @param string $strNome
	 * @throws RepositorioException
	 * @return void
	 */
	public function remover($intMetodoId, $strNome);
	
	/**
	 * Assinatura do método que procura um determinado objeto no RepositorioParametro
	 *
	 * @access public
	 * @param int $intMetodoId
	 * @param string $strNome
	 * @throws ParametroNaoCadastradoException
	 * @return Parametro
	 */
	public function procurar($intMetodoId, $strNome);
	
	/**
	 * Assinatura do método que verifica se existe um determinado objeto no RepositorioParametro
	 *
	 * @access public
	 * @param int $intMetodoId
	 * @param string $strNome
	 * @throws RepositorioException
	 * @return boolean
	 */
	public function existe($intMetodoId, $strNome);
	
	/**
	 * Assinatura do método que lista todos os objetos do RepositorioParametro
	 *
	 * @access public
	 * @throws RepositorioException
	 * @return array
	 */
	public function listar();
	
}
