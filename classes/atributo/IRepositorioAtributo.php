<?php
/**
 * Interface do repositótio da classe Atributo
 * Todos os repositórios da classe Atributo deverão implementar esta interface
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:26:14
 */
interface IRepositorioAtributo {
	/**
	 * Assinatura do método que insere um objeto do RepositorioAtributo
	 *
	 * @access public
	 * @param Atributo $objAtributo
	 * @throws AtributoNaoCadastradoException
	 * @throws RepositorioException
	 * @return int
	 */
	public function inserir(Atributo $objAtributo);
	
	/**
	 * Assinatura do método que atualiza um objeto do RepositorioAtributo
	 *
	 * @access public
	 * @param Atributo $objAtributo
	 * @throws AtributoNaoCadastradoException
	 * @throws RepositorioException
	 * @return void
	 */
	public function atualizar(Atributo $objAtributo);
	
	/**
	 * Assinatura do método que remove um objeto do RepositorioAtributo
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param string $strNome
	 * @throws RepositorioException
	 * @return void
	 */
	public function remover($intClasseId, $strNome);
	
	/**
	 * Assinatura do método que procura um determinado objeto no RepositorioAtributo
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param string $strNome
	 * @throws AtributoNaoCadastradoException
	 * @return Atributo
	 */
	public function procurar($intClasseId, $strNome);
	
	/**
	 * Assinatura do método que verifica se existe um determinado objeto no RepositorioAtributo
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param string $strNome
	 * @throws RepositorioException
	 * @return boolean
	 */
	public function existe($intClasseId, $strNome);
	
	/**
	 * Assinatura do método que lista todos os objetos do RepositorioAtributo
	 *
	 * @access public
	 * @throws RepositorioException
	 * @return array
	 */
	public function listar();
	
}
