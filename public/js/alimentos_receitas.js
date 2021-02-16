$(document).ready(function() {
    //Função para deletar alimento da receita Selecionada
    $(".btn-excluir-ingrediente-receitas").on("click", function() {
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
                var id = $(this).attr('id');
                $.ajax({
                    type: "post",
                    url: "/deletar-alimento-receitas",
                    data: {
                        "_token": $('#token').val(),
                         "receita_id": receita_id,
                         "id": id
                      },
                });
                window.location.reload();
            }
        })
        return false;
    });
})
