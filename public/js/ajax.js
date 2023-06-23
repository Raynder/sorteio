(()=>{"use strict";var __webpack_exports__={};$(document).ajaxSend((function(e,o){$(".spinner").show()})),$(document).ajaxStop((function(e,o){$(".spinner").fadeOut("fast")}));var Ajax={carregarConteudo:function(e,o){$(".spinner").show(),$.ajax({url:e,encoding:"UTF-8",success:function(e){o.html(e)},error:function(e,o,t){Ajax.tratarErroAjax(e.status,e.responseText),Tela.fecharModal()},complete:function(){$(".spinner").hide()}})},carregarConteudoViaPost:function(e,o,t){$(".spinner").show(),$.ajax({url:e,encoding:"UTF-8",method:"POST",data:t,success:function(e){o.html(e)},error:function(e,o,t){Ajax.tratarErroAjax(e.status,e.responseText),Tela.fecharModal()},complete:function(){$(".spinner").hide()}})},tratarErroAjax:function(e,o){var t=o;if(o instanceof Object&&(t=o.responseJSON,o.responseJSON instanceof Object&&(t=o.responseJSON.message)),401===e)Tela.avisoComAlerta("Sua sessão expirou! Por favor, realize o login novamente!");else if(500==e)Tela.avisoComErro(t);else if(403==e)Tela.avisoComErro("Acesso negado. Favor verificar com o suporte.");else if(409==e)Tela.avisoComErro(t);else if(404==e)Tela.avisoComErro("Página não encontrada!");else if(422==e){var a=o.responseJSON.errors,r="<ul>";$.each(a,(function(e,o){r+="<li>"+o[0]+"</li>"})),r+="</ul>",Tela.avisoComErro(r)}else Tela.avisoComErro("Erro: "+e+" Mensagem: "+t)},buscarRegistros:function(e,o,t,a,r){$.ajax({url:o,type:a,data:t,success:function(o,t,a){$(e).html(o),"function"==typeof r&&r.call()},error:function(e,o,t){Ajax.tratarErroAjax(e.status,e)}})},salvarRegistro:function(e,o){var t=arguments.length>2&&void 0!==arguments[2]&&arguments[2],a=$(e).serialize(),r=$(e).attr("action"),n=$(e).find("#footerModal");$.ajax({url:r,type:"POST",data:a,beforeSend:function(){$(n).find("button[type=submit]").attr("disabled","true")},success:function(a,r,n){($("#formSearch").submit(),$(e).find("input[name$='continue']").is(":checked")||t)||$(e.closest(".modal-content")).find(".btn-close").click();$(e)[0].reset(),t&&$("#divForm_"+componente).html(a),Tela.avisoComSucesso(a),"function"==typeof o&&o.call()},error:function(e,o,t){Ajax.tratarErroAjax(e.status,e)},complete:function(){$(n).find("button[type=submit]").removeAttr("disabled")}})},salvarRegistroDireto:function(e,o,t,a){var r=$(form).find("#footerModal");$.ajax({url:e,type:t,data:o,beforeSend:function(){$(r).find("button[type=submit]").attr("disabled","true")},success:function(e,o,t){Tela.avisoComSucesso(e),"function"==typeof a&&a.call()},error:function(e,o,t){Ajax.tratarErroAjax(e.status,e)},complete:function(){$(r).find("button[type=submit]").removeAttr("disabled")}})},salvarRegistroComArquivo:function(e,o,t){void 0===t&&(t=!1);var a=new FormData(e[0]),r=$(e).attr("action"),n=$(e).attr("component"),s=$(e).find("#footerModal");$.ajax({url:r,type:"POST",data:a,contentType:!1,processData:!1,beforeSend:function(){$(s).find("button[type=submit]").attr("disabled","true")},success:function(a,r,s){($("#formSearch").submit(),$("input[name=continuar]").is(":checked")||t)||$(e.closest(".modal-content")).find(".btn-close").click();t?$("#divForm_"+n).html(a):$(e)[0].reset(),Tela.avisoComSucesso("Salvo com sucesso!"),"function"==typeof o&&o.call()},error:function(e,o,t){Ajax.tratarErroAjax(e.status,e)},complete:function(){$(s).find("button[type=submit]").removeAttr("disabled")}})},deletarRegistro:function deletarRegistro(){var formUrl=$("#modalDelete_urlExcluir").val(),callback=$("#modalDelete_callback").val(),id=$("#modalDelete_id").val();$.ajax({url:formUrl,type:"DELETE",beforeSend:function(){console.log("ok")},success:function success(data,textStatus,jqXHR){$("#row_"+id).remove(),$("#modalDelete").modal("hide"),Tela.avisoComSucesso("Excluído com sucesso!"),"function"==typeof eval(callback)&&callback.call()},error:function(e,o,t){Ajax.tratarErroAjax(e.status,e.responseJSON)},complete:function(){console.log("ok")}})},deletarRegistroDireto:function(e,o,t,a){var r=$(form).find("#footerModal");$.ajax({url:e,type:t,data:o,beforeSend:function(){$(r).find("button[type=submit]").attr("disabled","true")},success:function(e,o,t){$("#"+e).remove(),"function"==typeof a&&a.call()},error:function(e,o,t){Ajax.tratarErroAjax(e.status,e)},complete:function(){$(r).find("button[type=submit]").removeAttr("disabled")}})}},__WEBPACK_DEFAULT_EXPORT__=Ajax})();
//# sourceMappingURL=ajax.js.map