<?php
/**
 * Classe de conexão do sistema
 * Iremos utilizar a abstração de banco nativa do PHP, o PDO
 * 
 * @author Marcelo Burégio
 * @subpackage conexao
 * @version 1.0
 * @since 17/09/2008 09:01:15
 */
Class ConexaoBDR {
	
	/**
	 * Conexão do sistema
	 *
	 * @access private
	 * @var PDO
	 */
	private $objConexao;
	
	/**
	 * Instância da conexão do sistema
	 *
	 * @access private
	 * @static 
	 * @var ConexaoBDR
	 */
	private static $objInstancia;
	
	/**
	 * Instância da conexão do erro
	 *
	 * @access private
	 * @static 
	 * @var ConexaoBDR
	 */
	private static $objInstanciaErro;
	
	/**
	 * Método construtor da classe
	 *
	 * @access public
	 * @param string $strBase
	 */
	public function __construct($strBase)
	{
		//Verificando erro
		try
		{
			//Verificando o tipo da base de conexão
			switch($strBase)
			{
				//Caso sistema
				case "sistema":
					$this->objConexao = new PDO('mysql:host=localhost;dbname=geradorweb', 'root', '');
					$this->objConexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$this->objConexao->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,TRUE);
			}
		}
		//Estourando o erro
		catch(PDOException $ex)
		{
			//Levantando a mensagem
			die($ex->getMessage());
		}
	}
	
	/**
	 * Método que irá pegar as intâncias das conexões
	 *
	 * @access public
	 * @static
	 * @param string $strBase
	 * @return ConexaoBDR
	 */
	public static function getInstancia($strBase)
	{
		
		//Verificando o tipo da base
		switch($strBase)
		{
			
			//Base do sistema
			case "sistema":
				
				if(!isset(self::$objInstancia))
				{
					
					self::$objInstancia	= new ConexaoBDR($strBase);
					
				}
				return self::$objInstancia;
				
			break;
			
			//Base de erro
			case "erro":
				
				if(!isset(self::$objInstanciaErro))
				{
					
					self::$objInstanciaErro	= new ConexaoBDR($strBase);
					
				}
				return self::$objInstanciaErro;
			
			break;
			
		}
		
	}
	
	/**
	 * Retornando o valor de <var>$this->objConexao</var>
	 *
	 * @access public
	 * @return ConexaoBDR
	 */
	public function getConexao()
	{
		
		return $this->objConexao;
		
	}
}
