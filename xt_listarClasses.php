<?php
// Includes
require_once('classes/config.classes.php');

// Inicializando a Fachada
$objFachada = FachadaBDR::getInstance();

// Obtendo os dados via get
$intSistemaId = (int) @$_GET['sistemaId'];

// Armazenando o SistemaId
@setcookie('CLASSES_SistemaId', $intSistemaId, time()+2592000, '/');

// Validando o SistemaId
if (!empty($intSistemaId)) {
	
	// Listando todas as classes do sistema especificado
	$arrObjClasses = $objFachada->listarClassesPorSistemaId($intSistemaId);
	
	// Verificando se existe alguma classe
	if (!empty($arrObjClasses) && is_array($arrObjClasses)) {
		
		// Separando as classes em pacotes
		$arrObjClassesPkg = array();
		foreach ($arrObjClasses as $objClasse) $arrObjClassesPkg[ $objClasse->getSubpacote() ][] = $objClasse;
		$arrPackages = array_keys($arrObjClassesPkg);
		sort($arrPackages);
?>
<table border="0" cellspacing="1" cellpadding="0" id="tb_classes">
	<thead>
		<tr>
			<th>Sistema</th>
			<th>Pacote</th>
			<th class="th_classe">Classe</th>
			<th>Download</th>
			<th>Editar</th>
			<th>Excluir</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="3"><b>Nome do Sistema</b></td>
			<td align="center"><a href="xt_download.php?sistemaId=<?php echo $intSistemaId;?>" target="ifacao" alt="Download" title="Download" class="download">Download</a></td>
			<td align="center">&nbsp;</td>
			<td align="center">&nbsp;</td>
		</tr>
	</tbody>
<?php
		$intPackage = 0;
		foreach ($arrPackages as $strPackage) {
?>
	<tbody>
		<tr id="pkg<?php echo $intPackage; ?>">
			<td>&nbsp;</td>
			<td align="left" colspan="2"><a href="javascript:;" class="package" alt="<?php echo count($arrObjClassesPkg[ $strPackage ]); ?> arquivo(s)" title="<?php echo count($arrObjClassesPkg[ $strPackage ]); ?> arquivo(s)"><?php echo $strPackage; ?></a></td>
			<td align="center"><a href="xt_download.php?sistemaId=<?php echo $intSistemaId;?>&subpacote=<?php echo $strPackage; ?>" target="ifacao" alt="Download" title="Download" class="download">Download</a></td>
			<!--
			<td align="center"><a href="xt_recriarSubpacote.php?sistemaId=<?php echo $intSistemaId;?>&subpacote=<?php echo $strPackage; ?>" target="ifacao" alt="Recriar" title="Recriar" class="recriar">Recriar</a></td>
			-->
			<td align="center"><a href="editarClasse.php?sistemaId=<?php echo $intSistemaId;?>&subpacote=<?php echo $strPackage; ?>" alt="Editar" title="Editar" class="recriar">Editar</a></td>
			<td align="center"><a href="xt_excluirSubpacote.php?sistemaId=<?php echo $intSistemaId;?>&subpacote=<?php echo $strPackage; ?>" target="ifacao" alt="Excluir" title="Excluir" class="excluir">Excluir</a></td>
		</tr>
<?php
			sort($arrObjClassesPkg[ $strPackage ]);
			foreach ($arrObjClassesPkg[ $strPackage ] as $objClasse) {
?>
		<tr class="pkg<?php echo $intPackage; ?> hide">
			<td colspan="2">&nbsp;</td>
			<td align="left" colspan="4"><a href="xt_visualizar.php?sistemaId=<?php echo $intSistemaId;?>&nome=<?php echo $objClasse->getNome(); ?>" target="_blank"><?php echo $objClasse->getNome(); ?></a></td>
		</tr>
<?php
			}
?>
	</tbody>
<?php
			$intPackage++;
		}
?>
</table>
<?php
	}
	else {
?>
<div id="mensagem"><div class="erro">Nenhuma classe foi encontrada.</div></div>
<?php
	}
}
else {
?>
Nenhum sistema selecionado.
<?php
}
