$(document).ready(function() {
    //Função para deletar administrador
    $(".btn-excluir-admin").on("click", function() {
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
                var id = $(this).attr('id');
                $.ajax({
                    type: "post",
                    url: "/admins_delete",
                    data: {
                        "_token": $('#token').val(),
                         "id": id
                     }
                });
                window.location.reload();
            }
        })
        return false;
    });
})
