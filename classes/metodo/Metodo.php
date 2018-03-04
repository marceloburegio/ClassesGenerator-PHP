<?php
/**
 * Classe de Métodos
 *
 * @author Marcelo Burégio <marceloburegio@gmail.com>
 * @version 1.0
 * @since 20/12/2015 01:28:07
 */
class Metodo {
	/**
	 * Código da Classe
	 *
	 * @access private
	 * @var int
	 */
	private $intClasseId;
	
	/**
	 * Código do Método
	 *
	 * @access private
	 * @var int
	 */
	private $intMetodoId;
	
	/**
	 * Nome do Método
	 *
	 * @access private
	 * @var string
	 */
	private $strNome;
	
	/**
	 * Acesso do Método
	 *
	 * @access private
	 * @var string
	 */
	private $strAcesso;
	
	/**
	 * Retorno do Método
	 *
	 * @access private
	 * @var string
	 */
	private $strRetorno;
	
	/**
	 * Conteúdo do Método
	 *
	 * @access private
	 * @var string
	 */
	private $strConteudo;
	
	/**
	 * Resumo do Método
	 *
	 * @access private
	 * @var string
	 */
	private $strResumo;
	
	/**
	 * Descrição do Método
	 *
	 * @access private
	 * @var string
	 */
	private $strDescricao;
	
	/**
	 * Ordem do Método
	 *
	 * @access private
	 * @var int
	 */
	private $intOrdem;
	
	/**
	 * Array de objetos Parametros
	 *
	 * @access private
	 * @var array
	 */
	private $arrObjParametros=array();
	
	/**
	 * Array de objetos Throws
	 *
	 * @access private
	 * @var array
	 */
	private $arrObjThrows=array();
	
	/**
	 * Método construtor da classe
	 *
	 * @access public
	 * @param int $intClasseId
	 * @param int $intMetodoId
	 * @param string $strNome
	 * @param string $strAcesso
	 * @param string $strRetorno
	 * @param string $strConteudo
	 * @param string $strResumo
	 * @param string $strDescricao
	 * @param int $intOrdem
	 * @param array $arrObjParametros=array()
	 * @param array $arrObjThrows=array()
	 */
	public function __construct($intClasseId, $intMetodoId, $strNome, $strAcesso, $strRetorno, $strConteudo, $strResumo, $strDescricao, $intOrdem, $arrObjParametros=array(), $arrObjThrows=array()) {
		$this->setClasseId($intClasseId);
		$this->setMetodoId($intMetodoId);
		$this->setNome($strNome);
		$this->setAcesso($strAcesso);
		$this->setRetorno($strRetorno);
		$this->setConteudo($strConteudo);
		$this->setResumo($strResumo);
		$this->setDescricao($strDescricao);
		$this->setOrdem($intOrdem);
		$this->setParametros($arrObjParametros);
		$this->setThrows($arrObjThrows);
	}
	
	/**
	 * Retorna o valor de <var>$this->intClasseId</var>
	 *
	 * @access public
	 * @return int
	 */
	public function getClasseId() {
		return $this->intClasseId;
	}
	
	/**
	 * Define o valor de <var>$this->intClasseId</var>
	 *
	 * @access public
	 * @param int $intClasseId
	 * @return void
	 */
	public function setClasseId($intClasseId) {
		$this->intClasseId = (int) $intClasseId;
	}
	
	/**
	 * Retorna o valor de <var>$this->intMetodoId</var>
	 *
	 * @access public
	 * @return int
	 */
	public function getMetodoId() {
		return $this->intMetodoId;
	}
	
	/**
	 * Define o valor de <var>$this->intMetodoId</var>
	 *
	 * @access public
	 * @param int $intMetodoId
	 * @return void
	 */
	public function setMetodoId($intMetodoId) {
		$this->intMetodoId = (int) $intMetodoId;
		$this->atualizarMetodoId();
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
	 * Retorna o valor de <var>$this->strAcesso</var>
	 *
	 * @access public
	 * @return string
	 */
	public function getAcesso() {
		return $this->strAcesso;
	}
	
	/**
	 * Define o valor de <var>$this->strAcesso</var>
	 *
	 * @access public
	 * @param string $strAcesso
	 * @return void
	 */
	public function setAcesso($strAcesso) {
		$this->strAcesso = (string) $strAcesso;
	}
	
	/**
	 * Retorna o valor de <var>$this->strRetorno</var>
	 *
	 * @access public
	 * @return string
	 */
	public function getRetorno() {
		return $this->strRetorno;
	}
	
	/**
	 * Define o valor de <var>$this->strRetorno</var>
	 *
	 * @access public
	 * @param string $strRetorno
	 * @return void
	 */
	public function setRetorno($strRetorno) {
		$this->strRetorno = (string) $strRetorno;
	}
	
	/**
	 * Retorna o valor de <var>$this->strConteudo</var>
	 *
	 * @access public
	 * @return string
	 */
	public function getConteudo() {
		return $this->strConteudo;
	}
	
	/**
	 * Define o valor de <var>$this->strConteudo</var>
	 *
	 * @access public
	 * @param string $strConteudo
	 * @return void
	 */
	public function setConteudo($strConteudo) {
		$this->strConteudo = (string) $strConteudo;
	}
	
	/**
	 * Retorna o valor de <var>$this->strResumo</var>
	 *
	 * @access public
	 * @return string
	 */
	public function getResumo() {
		return $this->strResumo;
	}
	
	/**
	 * Define o valor de <var>$this->strResumo</var>
	 *
	 * @access public
	 * @param string $strResumo
	 * @return void
	 */
	public function setResumo($strResumo) {
		$this->strResumo = (string) $strResumo;
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
	 * Retorna o valor de <var>$this->intOrdem</var>
	 *
	 * @access public
	 * @return int
	 */
	public function getOrdem() {
		return $this->intOrdem;
	}
	
	/**
	 * Define o valor de <var>$this->intOrdem</var>
	 *
	 * @access public
	 * @param int $intOrdem
	 * @return void
	 */
	public function setOrdem($intOrdem) {
		$this->intOrdem = (int) $intOrdem;
	}
	
	/**
	 * Método que compara um objeto passado por parametro com o próprio objeto
	 *
	 * @access public
	 * @param Metodo $objMetodo
	 * @return boolean
	 */
	public function equals(Metodo $objMetodo) {
		if ($this->intClasseId == $objMetodo->getClasseId() &&
			$this->intMetodoId == $objMetodo->getMetodoId() &&
			$this->strNome == $objMetodo->getNome() &&
			$this->strAcesso == $objMetodo->getAcesso() &&
			$this->strRetorno == $objMetodo->getRetorno() &&
			$this->strConteudo == $objMetodo->getConteudo() &&
			$this->strResumo == $objMetodo->getResumo() &&
			$this->strDescricao == $objMetodo->getDescricao() &&
			$this->intOrdem == $objMetodo->getOrdem()) return true;
		return false;
	}
	
	/**
	 * Retorna o valor de <var>$this->arrObjParametros</var>
	 *
	 * @access public
	 * @return array
	 */
	public function getParametros() {
		return $this->arrObjParametros;
	}
	
	/**
	 * Define o valor de <var>$this->arrObjParametros</var>
	 *
	 * @access public
	 * @param array $arrObjParametros
	 * @return void
	 */
	public function setParametros($arrObjParametros) {
		if (is_array($arrObjParametros)) {
			foreach ($arrObjParametros as $objParametro) {
				$this->adicionarParametro($objParametro);
			}
		}
	}
	
	/**
	 * Adiciona um objeto ao array <var>$this->arrObjParametros</var>
	 *
	 * @access public
	 * @param Parametro $objParametro
	 * @return void
	 */
	public function adicionarParametro(Parametro $objParametro) {
		$this->arrObjParametros[] = $objParametro;
		$objParametro->setMetodoId($this->intMetodoId);
		$objParametro->setOrdem( count($this->arrObjParametros) * 10 );
	}
	
	/**
	 * Retorna o valor de <var>$this->arrObjThrows</var>
	 *
	 * @access public
	 * @return array
	 */
	public function getThrows() {
		return $this->arrObjThrows;
	}
	
	/**
	 * Define o valor de <var>$this->arrObjThrows</var>
	 *
	 * @access public
	 * @param array $arrObjThrows
	 * @return void
	 */
	public function setThrows($arrObjThrows) {
		if (is_array($arrObjThrows)) {
			foreach ($arrObjThrows as $objThrows) {
				$this->adicionarThrows($objThrows);
			}
		}
	}
	
	/**
	 * Adiciona um objeto ao array <var>$this->arrObjThrows</var>
	 *
	 * @access public
	 * @param Throws $objThrows
	 * @return void
	 */
	public function adicionarThrows(Throws $objThrows) {
		$this->arrObjThrows[] = $objThrows;
		$objThrows->setMetodoId($this->intMetodoId);
		$objThrows->setOrdem( count($this->arrObjThrows) * 10 );
	}
	
	/**
	 * Método que converte todo o objeto em String
	 *
	 * @access public
	 * @param string $strEOL="\r\n"
	 * @param boolean $bolComentario=true
	 * @return string
	 */
	public function toString($strEOL="\r\n", $bolComentario=true) {
		$strOutput = "";
		
		// Exibindo o comentário
		if ($bolComentario) $strOutput .= $this->gerarComentario($strEOL);
		
		// Criando o metodo
		$strOutput .= (($this->strAcesso) ? $this->strAcesso ." " : "") ."function ". $this->strNome;
		
		// Lista de argumentos
		$strOutput .= "(";
		$intQtdeParametros = count($this->arrObjParametros);
		foreach ($this->arrObjParametros as $intKey => $objParametro) {
			$strOutput .= $objParametro->toString();
			if (($intKey + 1) != $intQtdeParametros) $strOutput .= ", ";
		}
		$strOutput .= ")";
		
		// Conteudo
		$strConteudo = trim($this->strConteudo);
		if (!empty($strConteudo)) {
			$strOutput .= " {". $strEOL;
			$strOutput .= trim($this->strConteudo) . $strEOL;
			$strOutput .= "}". $strEOL;
		}
		else {
			$strOutput .= ";". $strEOL;
		}
		return $strOutput;
	}
	
	/**
	 * Método privado que gera toda a parte de comentário do objeto
	 * Usado pelo toString()
	 *
	 * @access private
	 * @param string $strEOL
	 * @return string
	 */
	private function gerarComentario($strEOL) {
		$strOutput = "";
		if (!empty($this->strResumo))    $strOutput .= " * {$this->strResumo}". $strEOL;
		if (!empty($this->strDescricao)) $strOutput .= " * {$this->strDescricao}". $strEOL;
		if (!empty($this->strResumo) || !empty($this->strDescricao)) $strOutput .= " * ". $strEOL;
		if (!empty($this->strAcesso))    $strOutput .= " * @access {$this->strAcesso}". $strEOL;
		if (!empty($this->arrObjParametros)) {
			foreach ($this->arrObjParametros as $objParametro) {
				$strTipoAbreviado = Util::tipoAbreviado($objParametro->getTipo());
				$strOutput .= " * @param {$objParametro->getTipo()} $". $strTipoAbreviado . ucfirst($objParametro->getNome());
				$strValorPadrao = $objParametro->getValorPadrao();
				if (strlen($strValorPadrao) > 0) $strOutput .= "=". $strValorPadrao;
				$strOutput .= $strEOL;
			}
		}
		if (!empty($this->arrObjThrows)) {
			foreach ($this->arrObjThrows as $objThrows) {
				$strOutput .= " * @throws {$objThrows->getNome()}" . $strEOL;
			}
		}
		if (!empty($this->strRetorno))   $strOutput .= " * @return {$this->strRetorno}". $strEOL;
		if (!empty($strOutput)) $strOutput = "/**". $strEOL . $strOutput ." */". $strEOL;
		return $strOutput;
	}
	
	/**
	 * Método que atualiza todos os Ids dos parametros para o Id do método atual
	 *
	 * @access private
	 * @return void
	 */
	private function atualizarMetodoId() {
		// Atualizando os MetodoIds dos parametros
		if (is_array($this->arrObjParametros)) {
			foreach ($this->arrObjParametros as $objParametro) $objParametro->setMetodoId($this->intMetodoId);
		}
		
		// Atualizando os MetodoIds dos throws
		if (is_array($this->arrObjThrows)) {
			foreach ($this->arrObjThrows as $objThrows) $objThrows->setMetodoId($this->intMetodoId);
		}
	}
}
