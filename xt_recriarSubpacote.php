<?php
// Includes
require_once('classes/config.classes.php');

// Inicializando a Fachada
$objFachada = FachadaBDR::getInstance();

// Obtendo os dados via get
$intSistemaId = (int)    @$_GET['sistemaId'];
$strSubpacote = (string) @$_GET['subpacote'];

// Validando o SistemaId
if ($intSistemaId > 0 && !empty($strSubpacote)) {
	
	// Recriando todas as classes do SistemaId e Subpacote especificados
	$objFachada->recriarClassesPorSistemaIdPorSubpacote($intSistemaId, $strSubpacote);
}
