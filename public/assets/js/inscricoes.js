var ambientclinic = ambientclinic || {}

ambientclinic.inscricao = (function() {
    const $formIncricao = $("#form-inscricao")

    const $id = $('#id')
    const $nome = $('#nome')
    const $email = $('#email')
    const $telefone = $('#telefone')
    const $perfil = $('#perfil')
    const $cpf = $('#cpf')

    const init = function () {
        console.info('Initialize module inscricao ...')
        search()
    }

    const search = function () {
        $.ajax({
            url: getPathAmbientClinic('api/inscricoes'),
            type: 'get',
            dataType: 'json',
            contentType: 'application/json',
            beforeSend: function() {
                // $.LoadingOverlay("show")
            },
            complete: function() {
                // $.LoadingOverlay("hide")
            },
            error: function (response) {
                console.log(response)
            },
            success: function (response) {
                console.log(response)
            }
        })
        // $('#table-inscricao').DataTable({
        //     language: ambientclinic.dataTablesPtBr,
        //     order: [[ 0, 'desc' ]],
        //     lengthChange: true,
        //     autoWidth: false,
        //     searching: false,
        //     processing: false,
        //     serverSide: true,
        //     destroy: true,
        //     columns: [
        //         { data: 'id', name: 'id', className : "text-center" },
        //         { data: 'nome', name: 'nome', className : "text-center" },
        //         { data: 'email', name: 'email' },
        //         { data: 'telefone', name: 'telefone' },
        //         {
        //             data: null,
        //             orderable: false,
        //             className : "text-center",
        //             render: function (data) {
        //                 const actionHtml = `
        //                     <div class="btn-group">
        //                         <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52" aria-expanded="false">
        //                             <i class="fas fa-bars"></i>
        //                         </button>
        //                         <div class="dropdown-menu" role="menu" style="">
        //                             <a class="dropdown-item" href="javascript:ambientclinic.inscricoes.show('${data.id}')">Editar</a>
        //                             <a class="dropdown-item" href="javascript:ambientclinic.inscricoes.destroy('${data.id}', '${data.nome}')">Excluir</a>
        //                         </div>
        //                     </div>
        //                 `

        //                 return actionHtml 
        //             }
        //         }
        //     ],
        //     ajax: {
        //         url : getPathAmbientClinic('api/inscricoes'),
        //         type : 'GET',
        //         dataType: 'json',
        //         contentType: 'application/json',
        //         async: true,
        //         data : function (d) {
        //             $.extend(d, ambientclinic.getDataFormaFilter('#form-inscricao-listagem'))
        //             return d
        //         },
        //         error: function (response) {
        //             if (response.status === 500) {
        //                 ambientclinic.openModalError(response.responseJSON.message)
        //             }
        //             ambientclinic.showErrorGeneric(response)
        //         },
        //     },
        // })
    }

    const show = function (id) {
        $.ajax({
            url: getPathAmbientClinic('api/inscricoes/'+id),
            type: 'get',
            dataType: 'json',
            contentType: 'application/json',
            beforeSend: function() {
                $.LoadingOverlay("show")
            },
            complete: function() {
                $.LoadingOverlay("hide")
            },
            error: function (response) {
                ambientclinic.errorAjaxGeneric(response)
            },
            success: function (response) {
                showFormSave('update')
                $('.toggle-content-password-only-new').removeClass('d-none')
                $('#toggle-content-password').prop('checked', false)
                $('#toggle-content-password').change()

                const usuario = response.data
                $usuarioId.val(usuario.id)
                $usuarioNome.val(usuario.nome)
                $usuarioEmail.val(usuario.email)
                $usuarioTelefone.val(usuario.telefone)
                $usuarioPerfil.val(usuario.perfil).trigger('change')
            }
        })
    }

    const destroy = function (id, nome) {
        Swal.fire({
            title: "Confirme a exclusão?",
            text: nome,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Confirmar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: getPathAmbientClinic('api/inscricoes/'+id),
                    type: 'delete',
                    dataType: 'json',
                    contentType: 'application/json',
                    beforeSend: function() {
                        $.LoadingOverlay("show")
                    },
                    complete: function() {
                        $.LoadingOverlay("hide")
                    },
                    error: function (response) {
                        ambientclinic.errorAjaxGeneric(response)
                    },
                    success: function (data, status, response) {
                        if (response.status === 204) {
                            ambientclinic.adicionarSa("s", "O usuário '"+nome+"' excluido com sucesso!")
                            search()
                        }
                    }
                })
            }
        })
    }

    return {
        init : init,
        show : show,
        search : search,
    }

})()
