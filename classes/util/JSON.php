<?php
/**
 * Classe utilitária para o uso do JSON
 * Facilita as incompatibilidades entre a versão do PHP 5.2
 *
 * @author Marcelo Burégio
 * @subpackage util
 * @version 1.0
 * @since 10/10/2008 13:27
 */
class JSON {
	
	/**
	 * Objeto Services_JSON instanciado apenas nas versões < 5.2.0
	 *
	 * @access private
	 * @var Services_JSON
	 **/
	private static $objServices_JSON = null;
	
	/**
	 * Método construtor da classe
	 * 
	 * @access private
	 */
	private function __construct() {
	}
	
	/**
	 * Método estático Singleton que retorna uma instância do objeto Services_JSON
	 *
	 * @access public
	 * @return Services_JSON
	 */
	private static function getInstance() {
			if (is_null(JSON::$objServices_JSON)) {
				require_once("Services_JSON.php");
				JSON::$objServices_JSON = new Services_JSON();
			}
			return JSON::$objServices_JSON;
	}
	
	/**
	 * Método que decodifica a string JSON nos objetos referenciados
	 * Este método escolhe se usará os métodos da versão 5.2.0 ou a classe Services_JSON
	 *
	 * @access static public
	 * @param string $strJson
	 * @param boolean $bolAssoc (PHP >= 5.2.0)
	 * @return mixed
	 */
	public static function decode($strJson, $bolAssoc=true) {
		if (version_compare(phpversion(), "5.2.0") == -1) {
			$JSON = JSON::getInstance();
			return $JSON->decode($strJson);
		}
		else {
			return json_decode($strJson, $bolAssoc);
		}
	}
	
	/**
	 * Método que codifica qualquer objeto em uma string JSON
	 * Este método escolhe se usará os métodos da versão 5.2.0 ou a classe Services_JSON
	 *
	 * @access static public
	 * @param mixed $mixValue
	 * @return string
	 */
	public static function encode($mixValue) {
		if (version_compare(phpversion(), "5.2.0") == -1) {
			$JSON = JSON::getInstance();
			return $JSON->encode($mixValue);
		}
		else {
			return json_encode($mixValue);
		}
	}
}
