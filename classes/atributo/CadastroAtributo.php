<?php
/**
 * Cadastro de objetos Atributo
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:26:14
 */
class CadastroAtributo {
	/**
	 * Repositório de classes Atributo
	 *
	 * @access private
	 * @var IRepositorioAtributo
	 */
	private $objRepositorioAtributo;
	
	/**
	 * Método construtor da classe
	 *
	 * @access public
	 * @param IRepositorioAtributo $objRepositorioAtributo
	 */
	public function __construct(IRepositorioAtributo $objRepositorioAtributo) {
		$this->objRepositorioAtributo = $objRepositorioAtributo;
	}
	
	/**
	 * Método que cadastra um objeto no RepositorioAtributo
	 *
	 * @access public
	 * @param Atributo $objAtributo
	 * @throws AtributoJaCadastradoException
	 * @throws AtributoNaoCadastradoException
	 * @throws RepositorioException
	 * @return int
	 */
	public function cadastrar(Atributo $objAtributo) {
		if ($this->existe($objAtributo->getClasseId(), $objAtributo->getNome()))
			throw new AtributoJaCadastradoException($objAtributo->getClasseId(), $objAtributo->getNome());
		return $this->objRepositorioAtributo->inserir($objAtributo);
	}
	
	/**
	 * Método que atualiza um objeto no RepositorioAtributo
	 *
	 * @access public
	 * @param Atributo $objAtributo
	 * @throws AtributoNaoCadastradoException
	 * @throws RepositorioException
	 * @return void
	 */
	public function atualizar(Atributo $objAtributo) {
		$this->objRepositorioAtributo->atualizar($objAtributo);
	}
	
	/**
	 * Método que remove um objeto do RepositorioAtributo
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param string $strNome
	 * @throws RepositorioException
	 * @return void
	 */
	public function remover($intClasseId, $strNome) {
		$this->objRepositorioAtributo->remover($intClasseId, $strNome);
	}
	
	/**
	 * Método que procura um determinado objeto no RepositorioAtributo
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param string $strNome
	 * @throws AtributoNaoCadastradoException
	 * @return Atributo
	 */
	public function procurar($intClasseId, $strNome) {
		return $this->objRepositorioAtributo->procurar($intClasseId, $strNome);
	}
	
	/**
	 * Método que verifica se existe um determinado objeto no RepositorioAtributo
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param string $strNome
	 * @throws RepositorioException
	 * @return boolean
	 */
	public function existe($intClasseId, $strNome) {
		return $this->objRepositorioAtributo->existe($intClasseId, $strNome);
	}
	
	/**
	 * Método que lista todos os objetos do RepositorioAtributo
	 *
	 * @access public
	 * @throws RepositorioException
	 * @return array
	 */
	public function listar() {
		return $this->objRepositorioAtributo->listar();
	}
	
	/**
	 * Método que lista todos os objetos do RepositorioAtributo por ClasseId
	 *
	 * @access public
	 * @param int $intClasseId
	 * @return array
	 */
	public function listarPorClasseId($intClasseId) {
		return $this->objRepositorioAtributo->listarPorClasseId($intClasseId);
	}
	
	/**
	 * Método que lista todos os objetos do RepositorioAtributo por ClasseId Ordenado
	 *
	 * @access public
	 * @param int $intClasseId
	 * @return array
	 */
	public function listarPorClasseIdOrdenado($intClasseId) {
		return $this->objRepositorioAtributo->listarPorClasseIdOrdenado($intClasseId);
	}
	
}
