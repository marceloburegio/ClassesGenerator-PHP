<?php
/**
 * Classe utilitária
 * 
 * @author Marcelo Burégio
 * @subpackage util
 * @version 1.0
 * @since 22/10/2008 11:34:48
 */
class Util {
	/**
	 * Método construtor da classe
	 *
	 * @access private
	 */
	private function __construct() {
	}
	
	/**
	 * Método estático que organiza todo o código PHP com as tabulações baseado nas chaves
	 *
	 * @access public
	 * @param string $strCodigo
	 * @param string $strEspacamento="	"
	 * @param string $strEOL="\r\n"
	 * @return string
	 */
	public static function organizarCodigo($strCodigo, $strEspacamento="	", $strEOL="\r\n") {
		$strOutput			= "";
		$intEspacosAnt	= 0;
		$intEspacos			= 0;
		
		$arrCodigo = explode("\n", $strCodigo);
		foreach ($arrCodigo as $strLinha) {
			$strLinha		 = rtrim($strLinha);
			$intEspacos	+= substr_count($strLinha, "{");
			$intEspacos	-= substr_count($strLinha, "}");
			if ($intEspacos < 0) $intEspacos = 0;
			
			if ($intEspacos < $intEspacosAnt) $intEspacosAnt = $intEspacos;
			$strOutput .= str_repeat($strEspacamento, $intEspacosAnt) . $strLinha . $strEOL;
			$intEspacosAnt = $intEspacos;
		}
		return $strOutput;
	}
	
	/**
	 * Método estático que retorna o tipo abreviado das variáveis
	 *
	 * @access public
	 * @param string $strTipo
	 * @return string
	 */
	public static function tipoAbreviado($strTipo) {
		$strTipo = strtolower($strTipo);
		switch ($strTipo) {
			case "boolean"	: return "bol";
			case "string"		: return "str";
			case "float"		: return "flo";
			case "int"			: return "int";
			case "array"		: return "arr";
			default					: return "obj";
		}
	}
	
	/*
	 * Método que corrige a acentuação para caracteres normais
	 *
	 * @access public
	 * @param string $strTipo
	 * @return string
	 */
	public static function stringNormal($strString) {
		$ts = array("/[À-Å]/","/Ç/","/[È-Ë]/","/[Ì-Ï]/","/Ð/","/Ñ/","/[Ò-ÖØ]/","/×/","/[Ù-Ü]/","/[Ý-ß]/","/[à-å]/","/ç/","/[è-ë]/","/[ì-ï]/","/ð/","/ñ/","/[ò-öø]/","/÷/","/[ù-ü]/","/[ý-ÿ]/"); 
		$tn = array("A","C","E","I","D","N","O","X","U","Y","a","c","e","i","d","n","o","x","u","y"); 
		return preg_replace($ts, $tn, $strString);
	}
}
