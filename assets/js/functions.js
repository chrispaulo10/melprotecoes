$(document).ready(function() {
    const url_atual = window.location.href;

    let page = url_atual.split("/");
    let titulo = page[page.length-1].split("-");
    let local = "";

    for (let index = 3; index < titulo.length; index++) {
        local += `${titulo[index]} `;
    }
    
    $(".local").text(local);
});