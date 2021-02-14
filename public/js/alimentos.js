$(document).ready(function() {
    //Função para deletar alimento Selecionado
    $("#btn-confirmation").on("click", function() {
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
                $("#btn-excluir-alimento")[0].click();
            }
        })
        return false;
    });
})
