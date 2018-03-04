<?php
// Includes
require_once('classes/config.classes.php');

// Inicializando a Fachada
$objFachada = FachadaBDR::getInstance();

// Obtendo os dados via get
$intSistemaId = (int)    @$_GET['sistemaId'];
$strSubpacote = (string) @$_GET['subpacote'];

// Validando o SistemaId e o Subpacote
if ($intSistemaId > 0 && !empty($strSubpacote)) {
	
	// Excluindo todas as classes do SistemaId e Subpacote especificados
	if (empty($strNome)) $objFachada->excluirClassesPorSistemaIdPorSubpacote($intSistemaId, $strSubpacote);
}
?>
<script language="javascript" type="text/javascript">
	/*listarClassesPorSistemaId($("#sel_sistema").val());*/
</script>
