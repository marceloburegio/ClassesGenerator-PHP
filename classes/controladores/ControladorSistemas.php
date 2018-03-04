<?php
/**
 * Classe que irá controlar todos os sistemas
 * 
 * @author Marcelo Burégio
 * @subpackage controladores
 * @version 1.0
 * @since 22/10/2008 13:58:19
 */
class ControladorSistemas {
	/**
	 * RepositórioBDR de classes Sistema
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
	 * Método que lista todas as classes do SistemaId especificado
	 *
	 * @access public
	 * @return array
	 */
	public function listar() {
		
		// Inicialiando o cadastro
		$objCadastroSistema = new CadastroSistema($this->objRepositorioSistema);
		
		// Listando todos os sistemas
		$arrObjSistemas = $objCadastroSistema->listar();
		
		// Retornando o array de sistemas
		return $arrObjSistemas;
	}

	/**
	 * Método que procura um determinado sistema
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @return Sistema
	 */
	public function procurar($intSistemaId) {
		
		// Inicialiando o cadastro
		$objCadastroSistema = new CadastroSistema($this->objRepositorioSistema);
		
		// Procurando o SistemaId
		return $objCadastroSistema->procurar($intSistemaId);
	}
}
