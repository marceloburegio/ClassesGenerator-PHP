<?php
// Includes
require_once("../config.inc.php");
?>
// Preload da imagem evitando BUG do IE6
//img = new Image();
//img.src = 'imagens/excluir.gif';

var html = 
'	<div class="atributo">'+
'		<table cellspacing="1" cellpadding="2" border="0" bgcolor="#EEEEEE">'+
'			<tbody>'+
'				<tr>'+
'					<td class="atr_tipo">'+
'						<select name="tipoAtributos[]">'+
'							<option value=""> --- </option>'+
<?php
foreach ($arrTiposAtributo as $arrTipoAtributo) {
?>
'							<option value="<?php echo $arrTipoAtributo[0];?>"><?php echo $arrTipoAtributo[1];?></option>'+
<?php
}
?>
'						</select>'+
'					</td>'+
'					<td class="atr_nome"><input type="text" name="nomeAtributos[]" /></td>'+
'					<td class="atr_desc"><input type="text" name="resumoAtributos[]" /></td>'+
'					<td class="atr_coluna"><input type="text" name="colunasBd[]" /></td>'+
'					<td class="atr_check" align="center">'+
'						<input type="checkbox" class="check_pk"/>'+
'						<input type="hidden" name="atributosPk[]" class="atributosPk" value="false">'+
'					</td>'+
'					<td class="atr_excl" align="center"><a href="javascript:;" class="remover"><img src="imagens/excluir.gif" width="25" height="25" border="0" alt="Excluir" title="Excluir" /></a></td>'+
'					<td class="atr_mover" align="center"><img src="imagens/change.gif" width="31" height="25" border="0" alt="Mover" title="Mover" /></td>'+
'				</tr>'+
'			</tbody>'+
'		</table>'+
'	</div>';

$(document).ajaxStart(function() {
	$('#loading').show();
});
$(document).ajaxStop(function() {
	$('#loading').fadeOut("slow");
});
$(document).ready(function() {
	/* Habilitando a lista de atributos ser ordenada dinamicamente */
	$("#atributos").sortable({"axis":"y", "cursor":"move", "opacity":"0.65"}); /* "revert":"true" */
	
	/* Atribuindo a ação de remover o atributo */
	$(document).on("click", "#atributos .remover", function() {
		$(this).parents(".atributo").hide();
		$(this).parents(".atributo").empty();
	});
	
	/*Ação de adicionar uma nova linha de atributos */
	$("#adicionar").click(function() {
		$("#atributos").append(html);
	});
	
	/* Adicionando o primeiro atributo */
	$("#atributos").append(html);
	
	/* Captura do check de PK para um campo hidden */
	$(document).on("click", "#atributos .check_pk", function() {
		$(this).next().attr("value", $(this).prop("checked"));
	});
	
	/* Validação do Formulário */
	$("form#formCadastrarClasse").bind("submit", function() {
		var mensagem = "";
		var bolIsFocus = true;
		var bolIsValid = true;
		
		// Validando os campos obrigatórios
		
		
		// Se todo o formulário for válido, faça o post dos dados 
		if (bolIsValid) {
			$.post("xt_cadastrarClasse.php", $(this).serializeArray(), function(res, textStatus) {
				
				// Inicializando as variáveis
				var resposta = false;
				
				// Processando a resposta
				if (textStatus != "success") mensagem = "Ocorreu um erro de comunica&ccedil;&atilde;o com o servidor. Por favor, tente novamente.";
				else if (!res.resposta) mensagem = res.mensagem;
				else {
					mensagem = "Classes cadastradas com sucesso!";
					resposta = true;
				}
				
				// Exibindo a mensagem
				mensagem = mensagem.replace("\n", "<br/>");
				if (resposta) mensagem = "<div class=\"ok\">"+ mensagem +"</div>";
				else mensagem = "<div class=\"erro\">"+ mensagem +"</div>";
				$("div#mensagem").html(mensagem);
				
			}, "json");
		}
		return false;
	});
});
