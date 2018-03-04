<?php
// Includes
require_once('classes/config.classes.php');

// Inicializando a Fachada
$objFachada = FachadaBDR::getInstance();

// Listando os sistemas
$arrObjSistemas = $objFachada->listarSistemas();

// Topo
include_once('includes/incTopo.php');
?>
<script language="javascript" type="text/javascript" src="js/listarClasses.js"></script>


<div id="box">
	<h3 class="box_label_filtro">Cadastro de Sistemas</h3>
	<div class="clear"></div>
</div>


<div align="center">Em desenvolvimento!!!</div>

<?php
// Rodapé
include_once('includes/incRodape.php');
