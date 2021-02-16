$(document).ready(function() {
    //Função para deletar alimento Selecionado
    $(".btn-excluir-alimento").on("click", function() {
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
                var alimento_id = $(this).attr('alimento_id');
                $.ajax({
        			type: "post",
        			url: "/deletar-alimento",
        			data: {
                        "_token": $('#token').val(),
                         "alimento_id": alimento_id
                      },
        		});
                window.location.reload();
            }
        })
        return false;
    });
})
