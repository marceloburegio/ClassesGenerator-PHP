<?php
/**
 * Cadastro de objetos Metodo
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:28:07
 */
class CadastroMetodo {
	/**
	 * Repositório de classes Metodo
	 *
	 * @access private
	 * @var IRepositorioMetodo
	 */
	private $objRepositorioMetodo;
	
	/**
	 * Método construtor da classe
	 *
	 * @access public
	 * @param IRepositorioMetodo $objRepositorioMetodo
	 */
	public function __construct(IRepositorioMetodo $objRepositorioMetodo) {
		$this->objRepositorioMetodo = $objRepositorioMetodo;
	}
	
	/**
	 * Método que cadastra um objeto no RepositorioMetodo
	 *
	 * @access public
	 * @param Metodo $objMetodo
	 * @throws MetodoJaCadastradoException
	 * @throws MetodoNaoCadastradoException
	 * @throws RepositorioException
	 * @return int
	 */
	public function cadastrar(Metodo $objMetodo) {
		if ($this->existe($objMetodo->getClasseId(), $objMetodo->getNome()))
			throw new MetodoJaCadastradoException($objMetodo->getClasseId(), $objMetodo->getNome());
		return $this->objRepositorioMetodo->inserir($objMetodo);
	}
	
	/**
	 * Método que atualiza um objeto no RepositorioMetodo
	 *
	 * @access public
	 * @param Metodo $objMetodo
	 * @throws MetodoNaoCadastradoException
	 * @throws RepositorioException
	 * @return void
	 */
	public function atualizar(Metodo $objMetodo) {
		$this->objRepositorioMetodo->atualizar($objMetodo);
	}
	
	/**
	 * Método que remove um objeto do RepositorioMetodo
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param string $strNome
	 * @throws RepositorioException
	 * @return void
	 */
	public function remover($intClasseId, $strNome) {
		$this->objRepositorioMetodo->remover($intClasseId, $strNome);
	}
	
	/**
	 * Método que procura um determinado objeto no RepositorioMetodo
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param string $strNome
	 * @throws MetodoNaoCadastradoException
	 * @return Metodo
	 */
	public function procurar($intClasseId, $strNome) {
		return $this->objRepositorioMetodo->procurar($intClasseId, $strNome);
	}
	
	/**
	 * Método que verifica se existe um determinado objeto no RepositorioMetodo
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param string $strNome
	 * @throws RepositorioException
	 * @return boolean
	 */
	public function existe($intClasseId, $strNome) {
		return $this->objRepositorioMetodo->existe($intClasseId, $strNome);
	}
	
	/**
	 * Método que lista todos os objetos do RepositorioMetodo
	 *
	 * @access public
	 * @throws RepositorioException
	 * @return array
	 */
	public function listar() {
		return $this->objRepositorioMetodo->listar();
	}
	
	/**
	 * Método que lista todos os objetos do RepositorioMetodo por ClasseId
	 *
	 * @access public
	 * @param int $intClasseId
	 * @return array
	 */
	public function listarPorClasseId($intClasseId) {
		return $this->objRepositorioMetodo->listarPorClasseId($intClasseId);
	}
	
	/**
	 * Método que lista todos os objetos do RepositorioMetodo por ClasseId Ordenado
	 *
	 * @access public
	 * @param int $intClasseId
	 * @return array
	 */
	public function listarPorClasseIdOrdenado($intClasseId) {
		return $this->objRepositorioMetodo->listarPorClasseIdOrdenado($intClasseId);
	}
}
