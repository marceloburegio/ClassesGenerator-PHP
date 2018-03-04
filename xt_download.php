<?php
// Includes
require_once('classes/config.classes.php');

// Inicializando a Fachada
$objFachada = FachadaBDR::getInstance();

// Obtendo os dados postados
$intSistemaId = (int)    @$_GET['sistemaId'];
$strSubpacote = (string) @$_GET['subpacote'];

// Habilitando um tempo maior para o processamento da página
set_time_limit(120); // Tempo = 2 minutos

// Inicializando a mensagem
$strMensagem = "";

// Validando os dados postados
if ($intSistemaId > 0) {
	
	// Carregando todas as classes do sistema especificado
	$strNomeArquivoZip = "";
	if (empty($strSubpacote)) {
		$arrObjClasses = $objFachada->listarClassesPorSistemaId($intSistemaId);
		$objSistema = $objFachada->procurarSistema($intSistemaId);
		$strNomeArquivoZip = str_replace(" ", "_", strtolower(Util::stringNormal($objSistema->getNome()))) .".zip";
	}
	// Carregando todas as classes do pacote especificado
	else {
		$arrObjClasses = $objFachada->listarClassesPorSistemaIdPorSubpacote($intSistemaId, $strSubpacote);
		$strNomeArquivoZip = $arrObjClasses[0]->getSubpacote() .".zip";
	}
	
	// Validando se existe pelo menos uma classe
	if (!empty($arrObjClasses) && is_array($arrObjClasses)) {
		
		// Criando um novo arquivo Zip
		$objZip = new Zip();
		$objZip->create();
		
		// Processando todas as classes
		foreach ($arrObjClasses as $objClasse) {
			
			// Gerando o conteúdo da classe PHP
			$strConteudo  = "<?php\r\n";
			$strConteudo .= Util::organizarCodigo( $objClasse->toString() );
			
			// Adicionando a classe ao arquivo Zip
			$strArquivo = $objClasse->getSubpacote() .'/'. $objClasse->getNome() .'.php';
			$objZip->addFromString($strArquivo, $strConteudo);
		}
		
		// Exibindo o arquivo para download
		$objZip->output($strNomeArquivoZip);
		$objZip->close();
		exit();
	}
	else $strMensagem = "Não foi encontrada nenhuma classe para ser gerada.";
}
else $strMensagem = "Sua solicitação apresenta dados inconsistentes ou inválidos.";
?>
<script language="javascript" type="text/javascript">alert('<?php echo $strMensagem; ?>');</script>
