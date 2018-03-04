<?php
/**
 * Cadastro de objetos Classe
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:27:01
 */
class CadastroClasse {
	/**
	 * Repositório de classes Classe
	 *
	 * @access private
	 * @var IRepositorioClasse
	 */
	private $objRepositorioClasse;
	
	/**
	 * Método construtor da classe
	 *
	 * @access public
	 * @param IRepositorioClasse $objRepositorioClasse
	 */
	public function __construct(IRepositorioClasse $objRepositorioClasse) {
		$this->objRepositorioClasse = $objRepositorioClasse;
	}
	
	/**
	 * Método que cadastra um objeto no RepositorioClasse
	 *
	 * @access public
	 * @param Classe $objClasse
	 * @throws ClasseJaCadastradoException
	 * @throws ClasseNaoCadastradoException
	 * @throws RepositorioException
	 * @return int
	 */
	public function cadastrar(Classe $objClasse) {
		if ($this->existe($objClasse->getSistemaId(), $objClasse->getNome()))
			throw new ClasseJaCadastradoException($objClasse->getSistemaId(), $objClasse->getNome());
		return $this->objRepositorioClasse->inserir($objClasse);
	}
	
	/**
	 * Método que atualiza um objeto no RepositorioClasse
	 *
	 * @access public
	 * @param Classe $objClasse
	 * @throws ClasseNaoCadastradoException
	 * @throws RepositorioException
	 * @return void
	 */
	public function atualizar(Classe $objClasse) {
		$this->objRepositorioClasse->atualizar($objClasse);
	}
	
	/**
	 * Método que remove um objeto do RepositorioClasse
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @param string $strNome
	 * @throws RepositorioException
	 * @return void
	 */
	public function remover($intSistemaId, $strNome) {
		$this->objRepositorioClasse->remover($intSistemaId, $strNome);
	}
	
	/**
	 * Método que procura um determinado objeto no RepositorioClasse
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @param string $strNome
	 * @throws ClasseNaoCadastradoException
	 * @return Classe
	 */
	public function procurar($intSistemaId, $strNome) {
		return $this->objRepositorioClasse->procurar($intSistemaId, $strNome);
	}
	
	/**
	 * Método que verifica se existe um determinado objeto no RepositorioClasse
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @param string $strNome
	 * @throws RepositorioException
	 * @return boolean
	 */
	public function existe($intSistemaId, $strNome) {
		return $this->objRepositorioClasse->existe($intSistemaId, $strNome);
	}
	
	/**
	 * Método que lista todos os objetos do RepositorioClasse
	 *
	 * @access public
	 * @throws RepositorioException
	 * @return array
	 */
	public function listar() {
		return $this->objRepositorioClasse->listar();
	}
	
	/**
	 * Método que lista todos os objetos do RepositorioClasse por SistemaId
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @return array
	 */
	public function listarPorSistemaId($intSistemaId) {
		return $this->objRepositorioClasse->listarPorSistemaId($intSistemaId);
	}
	
	/**
	 * Método que lista todos os objetos do RepositorioClasse por SistemaId e por Subpacote
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @return array
	 */
	public function listarPorSistemaIdPorSubpacote($intSistemaId, $strSubpacote) {
		return $this->objRepositorioClasse->listarPorSistemaIdPorSubpacote($intSistemaId, $strSubpacote);
	}
	
}
