<?php
/**
 * Interface do repositótio da classe Classe
 * Todos os repositórios da classe Classe deverão implementar esta interface
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:27:01
 */
interface IRepositorioClasse {
	/**
	 * Assinatura do método que insere um objeto do RepositorioClasse
	 *
	 * @access public
	 * @param Classe $objClasse
	 * @throws ClasseNaoCadastradoException
	 * @throws RepositorioException
	 * @return int
	 */
	public function inserir(Classe $objClasse);
	
	/**
	 * Assinatura do método que atualiza um objeto do RepositorioClasse
	 *
	 * @access public
	 * @param Classe $objClasse
	 * @throws ClasseNaoCadastradoException
	 * @throws RepositorioException
	 * @return void
	 */
	public function atualizar(Classe $objClasse);
	
	/**
	 * Assinatura do método que remove um objeto do RepositorioClasse
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @param string $strNome
	 * @throws RepositorioException
	 * @return void
	 */
	public function remover($intSistemaId, $strNome);
	
	/**
	 * Assinatura do método que procura um determinado objeto no RepositorioClasse
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @param string $strNome
	 * @throws ClasseNaoCadastradoException
	 * @return Classe
	 */
	public function procurar($intSistemaId, $strNome);
	
	/**
	 * Assinatura do método que verifica se existe um determinado objeto no RepositorioClasse
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @param string $strNome
	 * @throws RepositorioException
	 * @return boolean
	 */
	public function existe($intSistemaId, $strNome);
	
	/**
	 * Assinatura do método que lista todos os objetos do RepositorioClasse
	 *
	 * @access public
	 * @throws RepositorioException
	 * @return array
	 */
	public function listar();
	
}
