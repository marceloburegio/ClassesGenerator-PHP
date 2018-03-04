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
	<h3 class="box_label_filtro">Classes Cadastradas</h3>
	<div class="box_filtro">
		<label>Sistema:</label>
		<select class="filtro" id="sel_sistema">
			<option value=""> --- </option>
<?php
foreach ($arrObjSistemas as $objSistema) {
?>
			<option value="<?php echo $objSistema->getSistemaId();?>"><?php echo $objSistema->getNome();?></option>
<?php
}
?>
		</select>
		<input type="hidden" id="sel_sistema_atual" value="<?php echo @$_COOKIE['CLASSES_SistemaId'];?>">
	</div>
	<div class="clear"></div>
</div>


<div id="conteudo" align="center">Nenhum sistema selecionado.</div>
<br/>
<br/>
<iframe name="ifacao" style="display:none;"></iframe>

<?php
// Rodapé
include_once('includes/incRodape.php');
