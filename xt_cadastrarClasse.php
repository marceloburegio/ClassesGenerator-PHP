<?php
// Includes
require_once('classes/config.classes.php');

// Inicializando a Fachada
$objFachada = FachadaBDR::getInstance();

// Obtendo os dados postados
$intSistemaId       = (int) @$_POST['sistemaId'];
$strNome            = @$_POST['nomeClasse'];
$strResumo          = @$_POST['resumoClasse'];
$strAutor           = @$_POST['autorClasse'];
$strTabelaBd        = @$_POST['tabelaBd'];
$bolNovaVersao      = @$_POST['novaVersao'];
$strNameSpace       = @$_POST['nameSpace'];

$arrTipoAtributos   = @$_POST['tipoAtributos'];
$arrNomeAtributos   = @$_POST['nomeAtributos'];
$arrResumoAtributos = @$_POST['resumoAtributos'];
$arrColunasBd       = @$_POST['colunasBd'];
$arrAtributosPk     = @$_POST['atributosPk'];

// Convertendo os parametros PK de String para Boolean
if (!empty($arrAtributosPk) && is_array($arrAtributosPk)) {
	foreach ($arrAtributosPk as $intKey => $strAtributosPk) {
		$arrAtributosPk[$intKey] = ($strAtributosPk == "true") ? true : false;
	}
}
$bolNovaVersao = ($bolNovaVersao == "true") ? true : false;

// Armazenando o SistemaId
@setcookie('CLASSES_SistemaId', $intSistemaId, time()+2592000, '/');

// Inicializando a resposta
$bolResposta = false;
$strMensagem = "";

// Gerando as classes
try {
	$objFachada->cadastrarClasses($intSistemaId, $strNome, $strResumo, $strAutor, $strTabelaBd, $bolNovaVersao, $strNameSpace, $arrTipoAtributos, $arrNomeAtributos, $arrResumoAtributos, $arrColunasBd, $arrAtributosPk);
	$bolResposta = true;
}
catch (Exception $ex) {
	$strMensagem = $ex->getMessage();
}

// Montando o array de resposta
$arrResposta["resposta"] = $bolResposta;
$arrResposta["mensagem"] = htmlentities($strMensagem);

// Exibindo a resposta serializada pelo JSON
echo JSON::encode($arrResposta);
