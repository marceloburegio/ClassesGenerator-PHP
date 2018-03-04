<?php
// Includes
require_once('classes/config.classes.php');

// Inicializando a Fachada
$objFachada = FachadaBDR::getInstance();

// Obtendo os dados via get
$intSistemaId = (int) @$_GET['sistemaId'];
$strNome      = (string) @$_GET['nome'];

// Procurando a classe especificada
$objClasse = $objFachada->procurarClasse($intSistemaId, $strNome);

// Verificando se existe alguma classe
if (!empty($objClasse)) {
	
	// Exibindo o conteúdo no browser
	$strConteudo  = "<?php\r\n";
	$strConteudo .= Util::organizarCodigo($objClasse->toString());
	highlight_string($strConteudo);
}
