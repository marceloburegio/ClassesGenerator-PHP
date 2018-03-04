$(document).ajaxStart(function() {
	$('#loading').show();
});
$(document).ajaxStop(function() {
	$('#loading').fadeOut("slow");
});
$(document).ready(function() {
	/* Habilitando/desabilitando as classes */
	$(document).on("click", "#tb_classes .package", function() {
		$("#tb_classes ."+ $(this).parents("tr").attr("id")).toggleClass("hide");
	});
	
	/* Carregando a lista de classes */
	$("#sel_sistema").change(function() {
		listarClassesPorSistemaId($(this).val());
	});
	
	/* Selecionando o sistema atual e carregando as classes */
	if ($("#sel_sistema_atual").val() != "") {
		$("#sel_sistema").val($("#sel_sistema_atual").val());
		$("#conteudo").load("xt_listarClasses.php?sistemaId="+ $("#sel_sistema_atual").val() +"&time="+ (new Date()).getTime());
	}
});

function listarClassesPorSistemaId(sistemaId) {
	$("#conteudo").load("xt_listarClasses.php?sistemaId="+ sistemaId +"&time="+ (new Date()).getTime());
}
