<?php
// Includes
require_once('classes/config.classes.php');

// Inicializando a Fachada
$objFachada = FachadaBDR::getInstance();

// Listando os sistemas
$arrObjSistemas = $objFachada->listarSistemas();

// Obtendo o sistema atual
$intSistemaIdAtual = @$_COOKIE['CLASSES_SistemaId'];

// Topo
include_once('includes/incTopo.php');
?>
<!-- <script language="javascript" type="text/javascript" src="js/jquery-ui-core-sortable-1.6rc2.min.js"></script> -->
<script language="javascript" type="text/javascript" src="js/jquery-ui-1.10.2.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="js/cadastrarClasse.js.php?versao=1.1"></script>


<div id="box">
	<h3 class="box_label_filtro">Cadastro de Classes</h3>
	<div class="clear"></div>
</div>


<form id="formCadastrarClasse" action="xt_cadastrarClasse.php" method="post">

<div id="cls_info">
	<table cellspacing="2" cellspadding="2" border="0" bgcolor="#EEEEEE" align="center">
		<tr>
			<td><b>Sistema</b></td>
			<td>
				<select name="sistemaId">
					<option value=""> --- </option>
<?php
foreach ($arrObjSistemas as $objSistema) {
?>
					<option value="<?php echo $objSistema->getSistemaId();?>" <?php echo ($objSistema->getSistemaId() == $intSistemaIdAtual) ? 'selected="selected"':'';?>><?php echo $objSistema->getNome();?></option>
<?php
}
?>
				</select>
			</td>
		</tr>
		<tr>
			<td><b>Nome da Classe</b></td>
			<td><input type="text" name="nomeClasse"/></td>
		</tr>
		<tr>
			<td><b>Resumo</b></td>
			<td><input type="text" name="resumoClasse"/></td>
		</tr>
		<tr>
			<td><b>Autor</b></td>
			<td><input type="text" name="autorClasse"/></td>
		</tr>
		<tr>
			<td><b>Tabela do BDR</b></td>
			<td><input type="text" name="tabelaBd"/></td>
		</tr>
		<tr>
			<td><b>Nova Vers&atilde;o</b></td>
			<td><input type="checkbox" name="novaVersao" value="true" checked="checked"/></td>
		</tr>
		<tr>
			<td><b>NameSpace</b></td>
			<td><input type="text" name="nameSpace"/></td>
		</tr>
	</table>
</div>
<br/>


<div id="conteudo_atributos">
	<!-- Ação: adicionar atributo -->
	<div align="center"><a href="javascript:;" id="adicionar"><b>Adicionar Atributo</b></a></div>
	<br/>
	
	<!-- Cabeçalho dos atributos -->
	<table cellspacing="1" cellpadding="2" border="0" bgcolor="#DDDDDD">
		<tr>
			<td class="atr_tipo"><b>Tipo</b></td>
			<td class="atr_nome"><b>Nome</b></td>
			<td class="atr_desc"><b>Descricao</b></td>
			<td class="atr_coluna"><b>Coluna do BDR</b></td>
			<td class="atr_check" align="center"><b>PK</b></td>
			<td class="atr_excl" align="center"><b>Excl.</b></td>
			<td class="atr_mover" align="center"><b>Mover</b></td>
		</tr>
	</table>
	
	<!-- Lista de atributos -->
	<div id="atributos"></div>
</div>
<br/>

<div align="center">
	<div id="mensagem">&nbsp;</div>
	<br/>
	<input type="submit" value="Cadastrar Estrutura de Classes"/>
</div>

</form>

<?php
// Rodapé
include_once('includes/incRodape.php');
