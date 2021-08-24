$("#solicitar_orcamento").click(function () {
    const button = $(this);
    button.prop('disabled', true);

    const dados = {
        solicitar_orcamento : true,
        nome : $("#nome_orcamento").val(),
        fone : $("#fone_orcamento").val(),
    };

    $.post("back-end/controller/ControllerMail.php", dados, function (retorno) {
        button.prop('disabled', false);

        $("#nome_orcamento").val('');
        $("#fone_orcamento").val('');

        const mensagem = JSON.parse(retorno);

        $("#alerta_mail_orcamento").removeClass().addClass(`alert alert-${mensagem.tipo} mt-2`);
        $("#alerta_mail_orcamento").text(mensagem.resposta);
        $("#alerta_mail_orcamento").show("fast");
        
        setTimeout(() => {
            $("#alerta_mail_orcamento").fadeOut("slow");
        }, 3000);
    });
});