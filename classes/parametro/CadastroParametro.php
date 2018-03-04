<?php
/**
 * Cadastro de objetos Parametro
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:28:51
 */
class CadastroParametro {
	/**
	 * Repositório de classes Parametro
	 *
	 * @access private
	 * @var IRepositorioParametro
	 */
	private $objRepositorioParametro;
	
	/**
	 * Método construtor da classe
	 *
	 * @access public
	 * @param IRepositorioParametro $objRepositorioParametro
	 */
	public function __construct(IRepositorioParametro $objRepositorioParametro) {
		$this->objRepositorioParametro = $objRepositorioParametro;
	}
	
	/**
	 * Método que cadastra um objeto no RepositorioParametro
	 *
	 * @access public
	 * @param Parametro $objParametro
	 * @throws ParametroJaCadastradoException
	 * @throws ParametroNaoCadastradoException
	 * @throws RepositorioException
	 * @return int
	 */
	public function cadastrar(Parametro $objParametro) {
		if ($this->existe($objParametro->getMetodoId(), $objParametro->getNome()))
			throw new ParametroJaCadastradoException($objParametro->getMetodoId(), $objParametro->getNome());
		return $this->objRepositorioParametro->inserir($objParametro);
	}
	
	/**
	 * Método que atualiza um objeto no RepositorioParametro
	 *
	 * @access public
	 * @param Parametro $objParametro
	 * @throws ParametroNaoCadastradoException
	 * @throws RepositorioException
	 * @return void
	 */
	public function atualizar(Parametro $objParametro) {
		$this->objRepositorioParametro->atualizar($objParametro);
	}
	
	/**
	 * Método que remove um objeto do RepositorioParametro
	 *
	 * @access public
	 * @param int $intMetodoId
	 * @param string $strNome
	 * @throws RepositorioException
	 * @return void
	 */
	public function remover($intMetodoId, $strNome) {
		$this->objRepositorioParametro->remover($intMetodoId, $strNome);
	}
	
	/**
	 * Método que procura um determinado objeto no RepositorioParametro
	 *
	 * @access public
	 * @param int $intMetodoId
	 * @param string $strNome
	 * @throws ParametroNaoCadastradoException
	 * @return Parametro
	 */
	public function procurar($intMetodoId, $strNome) {
		return $this->objRepositorioParametro->procurar($intMetodoId, $strNome);
	}
	
	/**
	 * Método que verifica se existe um determinado objeto no RepositorioParametro
	 *
	 * @access public
	 * @param int $intMetodoId
	 * @param string $strNome
	 * @throws RepositorioException
	 * @return boolean
	 */
	public function existe($intMetodoId, $strNome) {
		return $this->objRepositorioParametro->existe($intMetodoId, $strNome);
	}
	
	/**
	 * Método que lista todos os objetos do RepositorioParametro
	 *
	 * @access public
	 * @throws RepositorioException
	 * @return array
	 */
	public function listar() {
		return $this->objRepositorioParametro->listar();
	}
	
	/**
	 * Método que lista todos os objetos do RepositorioParametro por MetodoId
	 *
	 * @access public
	 * @param int $intMetodoId
	 * @return array
	 */
	public function listarPorMetodoId($intMetodoId) {
		return $this->objRepositorioParametro->listarPorMetodoId($intMetodoId);
	}
	
	/**
	 * Método que lista todos os objetos do RepositorioParametro por MetodoId Ordenado
	 *
	 * @access public
	 * @param int $intMetodoId
	 * @return array
	 */
	public function listarPorMetodoIdOrdenado($intMetodoId) {
		return $this->objRepositorioParametro->listarPorMetodoIdOrdenado($intMetodoId);
	}
	
}
