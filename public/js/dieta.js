$(document).ready(function() {

    //Função de confirmação para mudança de página
    $("#botaoContinuar").click(function() {
        Swal.fire({
            title: 'Continuar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não'
        }).then((result) => {
            if (result.isConfirmed) {
                $("#linkContinuar")[0].click();
            }
        })
    });

    //Função para deletar alimento/receita Selecionado
    $(".btn-excluir").on("click", function() {
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
                var dietas_pacientes_id = $(this).attr('dietas_pacientes_id');
                var paciente_id = $(this).attr('paciente_id');
                var tipo_dieta = $(this).attr('tipo_dieta');
                $.ajax({
        			type: "post",
        			url: "/excluirAlimentoSelecionado",
        			data: {
                        "_token": $('#token').val(),
                         "dietas_pacientes_id": dietas_pacientes_id,
                         "paciente_id": paciente_id,
                         "tipo_dieta": tipo_dieta
                      },
        		});
                window.location = '/dieta/' + tipo_dieta + '/' + paciente_id;
            }
        })
        return false;
    });
})
