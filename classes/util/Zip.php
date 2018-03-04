<?php
/**
 * Classe para manipulação de arquivos Zip
 * 
 * @author Marcelo Burégio
 * @subpackage util
 * @version 1.0
 * @since 23/10/2008 16:24:48
 */
class Zip {
	/**
	 * Objeto Zip
	 *
	 * @access private
	 * @var object
	 */
	private $objZip;
	
	/**
	 * Nome do arquivo associado a este Zip
	 *
	 * @access private
	 * @var string
	 */
	private $strZipFile;
	
	/**
	 * Flag que indica se o arquivo é temporário ou não
	 *
	 * @access private
	 * @var boolean
	 */
	private $bolTempFile = false;
	
	/**
	 * Flag que indica se existe algum conteúdo carregado no objeto Zip
	 *
	 * @access private
	 * @var boolean
	 */
	private $bolIsLoaded = false;
	
	/**
	 * Método construtor da classe
	 *
	 * @access public
	 * @param string $strZipFile=""
	 */
	public function __construct($strZipFile="") {
		$this->objZip = new ZipArchive();
		if (!empty($strZipFile)) $this->load($strZipFile);
	}
	
	/**
	 * Método destrutor da classe
	 *
	 * @access public
	 */
	public function __destruct() {
		$this->close();
		if ($this->bolTempFile) unlink($this->strZipFile);
	}
	
	/**
	 * Método que carrega um arquivo Zip
	 *
	 * @access public
	 * @param string $strZipFile=""
	 * @return void
	 */
	public function load($strZipFile) {
		if ($this->objZip->open($strZipFile, ZipArchive::OVERWRITE) === true) {
			$this->strZipFile = $strZipFile;
			$this->bolIsLoaded = true;
		}
		else {
			throw new ZipException("Não foi possível carregar o arquivo ({$strZipFile})");
		}
	}
	
	/**
	 * Método que cria e carrega um arquivo Zip temporário
	 *
	 * @access public
	 * @return void
	 */
	public function create() {
		// Criando um arquivo temporário no diretório temp
		if ($strZipFile = tempnam(dirname(__FILE__) .'/', 'ZIP')) {
			$this->load($strZipFile);
			$this->bolTempFile = true;
		}
		else {
			throw new ZipException("Não foi possível criar o arquivo temporário ({$strZipFile})");
		}
	}
	
	/**
	 * Método que adiciona um arquivo baseado em uma string ao aquivo Zip
	 *
	 * @access public
	 * @param string $strFileName
	 * @param string $strContent
	 * @return void
	 */
	public function addFromString($strFileName, $strContent) {
		$this->objZip->addFromString($strFileName, $strContent);
		$this->bolIsLoaded = true;
	}
	
	/**
	 * Método que fecha o arquivo Zip
	 *
	 * @access public
	 * @return void
	 */
	public function close() {
		if ($this->bolIsLoaded) {
			$this->objZip->close();
			$this->bolIsLoaded = false;
		}
	}
	
	/**
	 * Método que exibe o conteúdo do arquivo para o output padrão
	 *
	 * @access public
	 * @param string $strZipFile
	 * @param boolean $bolHeaders
	 * @return void
	 */
	public function output($strZipFile="", $bolHeaders=true) {
		if ($this->bolIsLoaded) {
			if (empty($strZipFile)) $strZipFile = basename($this->strZipFile);
			if ($bolHeaders) {
				header("Content-type: application/zip");
				header("Content-Disposition: attachment; filename={$strZipFile}");
				header("Pragma: no-cache");
				header("Expires: 0");
			}
			
			// Fechando o arquivo para habilitar a leitura do mesmo
			$this->objZip->close();
			readfile($this->strZipFile);
			
			// Reabrindo o arquivo fechado
			$this->objZip->open($this->strZipFile);
		}
	}
	
}
/**
 * Classe de exceção do Zip
 *
 * @author Marcelo Burégio - marceloburegio@gmail.com
 * @subpackage util
 * @version 1.0
 * @since 23/10/2008 16:24:48
 */
class ZipException extends Exception {
	
	/**
	 * Método construtor da classe
	 * 
	 * @access private
	 * @param string $strMensage
	 */
	public function __construct($strMensage="ZipException") {
		parent::__construct($strMensage);
	}
}
