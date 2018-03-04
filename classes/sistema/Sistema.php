<?php
/**
 * Classe de Sistemas
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:29:13
 */
class Sistema {
	/**
	 * Código do Sistema
	 *
	 * @access private
	 * @var int
	 */
	private $intSistemaId;
	
	/**
	 * Nome do Sistema
	 *
	 * @access private
	 * @var string
	 */
	private $strNome;
	
	/**
	 * Descrição do Sistema
	 *
	 * @access private
	 * @var string
	 */
	private $strDescricao;
	
	/**
	 * Nome do Criador
	 *
	 * @access private
	 * @var string
	 */
	private $strCriadoPor;
	
	/**
	 * Método construtor da classe
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @param string $strNome
	 * @param string $strDescricao
	 * @param string $strCriadoPor
	 */
	public function __construct($intSistemaId, $strNome, $strDescricao, $strCriadoPor) {
		$this->setSistemaId($intSistemaId);
		$this->setNome($strNome);
		$this->setDescricao($strDescricao);
		$this->setCriadoPor($strCriadoPor);
	}
	
	/**
	 * Retorna o valor de <var>$this->intSistemaId</var>
	 *
	 * @access public
	 * @return int
	 */
	public function getSistemaId() {
		return $this->intSistemaId;
	}
	
	/**
	 * Define o valor de <var>$this->intSistemaId</var>
	 *
	 * @access public
	 * @param int $intSistemaId
	 * @return void
	 */
	public function setSistemaId($intSistemaId) {
		$this->intSistemaId = (int) $intSistemaId;
	}
	
	/**
	 * Retorna o valor de <var>$this->strNome</var>
	 *
	 * @access public
	 * @return string
	 */
	public function getNome() {
		return $this->strNome;
	}
	
	/**
	 * Define o valor de <var>$this->strNome</var>
	 *
	 * @access public
	 * @param string $strNome
	 * @return void
	 */
	public function setNome($strNome) {
		$this->strNome = (string) $strNome;
	}
	
	/**
	 * Retorna o valor de <var>$this->strDescricao</var>
	 *
	 * @access public
	 * @return string
	 */
	public function getDescricao() {
		return $this->strDescricao;
	}
	
	/**
	 * Define o valor de <var>$this->strDescricao</var>
	 *
	 * @access public
	 * @param string $strDescricao
	 * @return void
	 */
	public function setDescricao($strDescricao) {
		$this->strDescricao = (string) $strDescricao;
	}
	
	/**
	 * Retorna o valor de <var>$this->strCriadoPor</var>
	 *
	 * @access public
	 * @return string
	 */
	public function getCriadoPor() {
		return $this->strCriadoPor;
	}
	
	/**
	 * Define o valor de <var>$this->strCriadoPor</var>
	 *
	 * @access public
	 * @param string $strCriadoPor
	 * @return void
	 */
	public function setCriadoPor($strCriadoPor) {
		$this->strCriadoPor = (string) $strCriadoPor;
	}
	
	/**
	 * Método que compara um objeto passado por parametro com o próprio objeto
	 *
	 * @access public
	 * @param Sistema $objSistema
	 * @return boolean
	 */
	public function equals(Sistema $objSistema) {
		if ($this->intSistemaId == $objSistema->getSistemaId() &&
			$this->strNome == $objSistema->getNome() &&
			$this->strDescricao == $objSistema->getDescricao() &&
			$this->strCriadoPor == $objSistema->getCriadoPor()) return true;
		return false;
	}
	
}
