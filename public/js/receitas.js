$(document).ready(function() {
    //Função para deletar alimento/receita Selecionado
    $(".btn-excluir-receitas").on("click", function() {
        Swal.fire({
            title: 'Excluir esse item?',
            text: 'Você não pode desfazer essa ação',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não'
        }).then((result) => {
            if (result.isConfirmed) {
                var receita_id = $(this).attr('receita_id');
                $.ajax({
                    type: "post",
                    url: "/deletar-receita",
                    data: {
                        "_token": $('#token').val(),
                         "receita_id": receita_id
                      },
                });
              window.location.reload();
            }
        })
        return false;
    });
})

$(document).ready(function() {
    //Função para deletar alimento/receita Selecionado
    $("#btn_questao").on("click", function() {
      Swal.fire(
        'Como cadastrar uma receita:',
        'Primeiramente deve-se clicar no botão de inserir receita na parte superior da tela, onde será feito o redirecionamento para a pagína de cadastro de receitas. Após realizar o cadastro de receita, deve-se inserir os alimentos da receita clicando-se no botão de "inserir alimento" na tabela ao lado, então será carregada a tela contendo os alimentos da receita onde para inserir um novo alimento deve-se clicar no botão de "inserir alimento" na parte superior da tela e realizar o seu cadastro.'
      )
    });
})
