<?php
/**
 * Cadastro de objetos Sistema
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:29:13
 */
class CadastroSistema {
	/**
	 * Repositório de classes Sistema
	 *
	 * @access private
	 * @var IRepositorioSistema
	 */
	private $objRepositorioSistema;
	
	/**
	 * Método construtor da classe
	 *
	 * @access public
	 * @param IRepositorioSistema $objRepositorioSistema
	 */
	public function __construct(IRepositorioSistema $objRepositorioSistema) {
		$this->objRepositorioSistema = $objRepositorioSistema;
	}
	
	/**
	 * Método que cadastra um objeto no RepositorioSistema
	 *
	 * @access public
	 * @param Sistema $objSistema
	 * @throws SistemaJaCadastradoException
	 * @throws SistemaNaoCadastradoException
	 * @throws RepositorioException
	 * @return int
	 */
	public function cadastrar(Sistema $objSistema) {
		if ($this->existe($objSistema->getSistemaId()))
			throw new SistemaJaCadastradoException($objSistema->getSistemaId());
		return $this->objRepositorioSistema->inserir($objSistema);
	}
	
	/**
	 * Método que atualiza um objeto no RepositorioSistema
	 *
	 * @access public
	 * @param Sistema $objSistema
	 * @throws SistemaNaoCadastradoException
	 * @throws RepositorioException
	 * @return void
	 */
	public function atualizar(Sistema $objSistema) {
		$this->objRepositorioSistema->atualizar($objSistema);
	}
	
	/**
	 * Método que remove um objeto do RepositorioSistema
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @throws RepositorioException
	 * @return void
	 */
	public function remover($intSistemaId) {
		$this->objRepositorioSistema->remover($intSistemaId);
	}
	
	/**
	 * Método que procura um determinado objeto no RepositorioSistema
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @throws SistemaNaoCadastradoException
	 * @return Sistema
	 */
	public function procurar($intSistemaId) {
		return $this->objRepositorioSistema->procurar($intSistemaId);
	}
	
	/**
	 * Método que verifica se existe um determinado objeto no RepositorioSistema
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @throws RepositorioException
	 * @return boolean
	 */
	public function existe($intSistemaId) {
		return $this->objRepositorioSistema->existe($intSistemaId);
	}
	
	/**
	 * Método que lista todos os objetos do RepositorioSistema
	 *
	 * @access public
	 * @throws RepositorioException
	 * @return array
	 */
	public function listar() {
		return $this->objRepositorioSistema->listar();
	}
	
}
