// function para redirecionar as paginas
function redirect(event, page, title) {
    event.preventDefault();
    document.title = "Administrador - "+title;
    $("#main-content").load(page+'.html');
}

$(document).ready(function() {    
    document.title = "Administrador - Páginas de Conteúdo";
    $("#main-content").load('link_page.html');

    $(".link_conteudos").click(function (event) {
        redirect(event, "conteudo", "Páginas de Conteúdo");  
    }); 

    $(".link_categorias").click(function (event) {
        redirect(event, "categorias", "Categorias");  
    }); 

    $(".link_page").click(function (event) {
        redirect(event, "link_page", "Links");  
    }); 
})