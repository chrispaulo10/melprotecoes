$.get("back-end/controller/ControllerListagem.php", {
    listar_links_page : true
}, function(retorno) {
    console.log(retorno);
})