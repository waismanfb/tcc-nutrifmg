$(document).ready(function() {
    //Função para deletar alimento Selecionado
    $("#btn-excluir-receitas").on("click", function() {
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
                $("#btn-excluir-receitas-confirmation")[0].click();
            }
        })
        return false;
    });
})
