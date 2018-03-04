<?php
/**
 * Cadastro de objetos Intface
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:27:19
 */
class CadastroIntface {
	/**
	 * Repositório de classes Intface
	 *
	 * @access private
	 * @var IRepositorioIntface
	 */
	private $objRepositorioIntface;
	
	/**
	 * Método construtor da classe
	 *
	 * @access public
	 * @param IRepositorioIntface $objRepositorioIntface
	 */
	public function __construct(IRepositorioIntface $objRepositorioIntface) {
		$this->objRepositorioIntface = $objRepositorioIntface;
	}
	
	/**
	 * Método que cadastra um objeto no RepositorioIntface
	 *
	 * @access public
	 * @param Intface $objIntface
	 * @throws IntfaceJaCadastradoException
	 * @throws IntfaceNaoCadastradoException
	 * @throws RepositorioException
	 * @return int
	 */
	public function cadastrar(Intface $objIntface) {
		if ($this->existe($objIntface->getClasseId(), $objIntface->getIntfaceId()))
			throw new IntfaceJaCadastradoException($objIntface->getClasseId(), $objIntface->getIntfaceId());
		return $this->objRepositorioIntface->inserir($objIntface);
	}
	
	/**
	 * Método que atualiza um objeto no RepositorioIntface
	 *
	 * @access public
	 * @param Intface $objIntface
	 * @throws IntfaceNaoCadastradoException
	 * @throws RepositorioException
	 * @return void
	 */
	public function atualizar(Intface $objIntface) {
		$this->objRepositorioIntface->atualizar($objIntface);
	}
	
	/**
	 * Método que remove um objeto do RepositorioIntface
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param int $intIntfaceId
	 * @throws RepositorioException
	 * @return void
	 */
	public function remover($intClasseId, $intIntfaceId) {
		$this->objRepositorioIntface->remover($intClasseId, $intIntfaceId);
	}
	
	/**
	 * Método que procura um determinado objeto no RepositorioIntface
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param int $intIntfaceId
	 * @throws IntfaceNaoCadastradoException
	 * @return Intface
	 */
	public function procurar($intClasseId, $intIntfaceId) {
		return $this->objRepositorioIntface->procurar($intClasseId, $intIntfaceId);
	}
	
	/**
	 * Método que verifica se existe um determinado objeto no RepositorioIntface
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param int $intIntfaceId
	 * @throws RepositorioException
	 * @return boolean
	 */
	public function existe($intClasseId, $intIntfaceId) {
		return $this->objRepositorioIntface->existe($intClasseId, $intIntfaceId);
	}
	
	/**
	 * Método que lista todos os objetos do RepositorioIntface
	 *
	 * @access public
	 * @throws RepositorioException
	 * @return array
	 */
	public function listar() {
		return $this->objRepositorioIntface->listar();
	}
	
	/**
	 * Método que lista todos os objetos do RepositorioIntface por ClasseId
	 *
	 * @access public
	 * @param int $intClasseId
	 * @return array
	 */
	public function listarPorClasseId($intClasseId) {
		return $this->objRepositorioIntface->listarPorClasseId($intClasseId);
	}
	
}
