import $ from 'jquery'

import DataTable from 'datatables.net-dt'
import 'datatables.net-dt/css/dataTables.dataTables.css'

import Swal from 'sweetalert2'
import 'sweetalert2/src/sweetalert2.scss'

import { Modal } from 'bootstrap'


const Inscricao = {
    elements: {
        formInscricao: $("#form-inscricao"),
        id: $('#id'),
        nome: $('#nome'),
        email: $('#email'),
        telefone: $('#telefone'),
        perfil: $('#perfil'),
        cpf: $('#cpf'),
        instituicao: $('#instituicao'),
        matricula: $('#matricula'),
        crmv: $('#crmv'),
        pago: $('#pago'),
        createdAt: $('#created_at'),
        tableInscricao: $('#table-inscricao')[0],
        modalInscricao: $('#modal-inscricao')
    },

    instance: null,

    init() {
        console.info('Initialize module inscricao ...')

        this.elements.tableInscricao = $('#table-inscricao')[0]
        
        if (this.elements.tableInscricao) {
            this.setupTable(this.elements.tableInscricao)
        }

        this.indicadores()
    },

    search() {
        window.Inscricao.setupTable($('#table-inscricao')[0])
        this.indicadores()
    },

    setupTable(el) {
        this.instance = new DataTable(el, {
            pageLength: 100,
            processing: true,
            serverSide: true,
            searching: true,
            destroy: true,
            ajax: {
                url: '/api/inscricoes',
                type: 'GET'
            },
            columns: [
                {
                    data: 'id' ,
                    className : "text-center"
                },
                { 
                    data: null,
                    render: (data) => {
                        
                        let styleBadge = `<br><span class="badge bg-primary">${data.perfil}</span>`
                        let styleBadgeEstudante = ""
                        let styleBadgeCrmv = ""

                        if (data.crmv != null && data.crmv != "") {
                            styleBadgeCrmv = `<br><span class="badge bg-primary">CRMV: ${data.crmv}</span>`
                        }
                        
                        if (data.perfil === "estudante") {
                            styleBadge = `<br><span class="badge bg-secondary">${data.perfil}</span>`

                            if (data.matricula != null && data.instituicao != null) {
                                styleBadgeEstudante = `
                                    <br><span class="badge bg-secondary">Matricula: ${data.matricula}</span>
                                    <br><span class="badge bg-secondary">Instituição: ${data.instituicao}</span>
                                `
                            }
                        }

                        return `
                            ${data.nome}
                            ${styleBadge}
                            ${styleBadgeCrmv}
                            ${styleBadgeEstudante}
                        `
                    }
                },
                { data: 'email' },
                { data: 'telefone' },
                { data: 'cpf' },
                { 
                    data: null,
                    orderable: false,
                    render: (data) => {
                        const pagoCheckbox = (data.pago === 'Sim') ? 'checked' : ''
                        return `
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" onchange="Inscricao.changeStatusPagamento('${data.id}', '${data.pago}')" ${pagoCheckbox}>
                            </div>`
                    }
                },
                {
                    data: null,
                    orderable: false,
                    render: (data) => {
                        return `
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-card-checklist"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:Inscricao.show('${data.id}')">Detalhes</a></li>
                                    <li><a class="dropdown-item" href="javascript:Inscricao.destroy('${data.id}', '${data.nome}')">Excluir</a></li>
                                </ul>
                            </div>`
                    }
                }
            ],
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
            }
        })
    },

    destroy(id, nome) {
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
                    error: function (response) {
                        console.log(response )
                        Swal.fire({
                            icon: "error",
                            html: response.responseJSON.message
                        })
                    },
                    success: function () {
                        Swal.fire({
                            icon: "success",
                            html: "A inscrição '"+nome+"' excluido com sucesso!"
                        })
                        window.Inscricao.setupTable($('#table-inscricao')[0])
                    }
                })
            }
        })
    },

    show(id) {
        $.ajax({
            url: getPathAmbientClinic('api/inscricoes/'+id),
            type: 'get',
            dataType: 'json',
            contentType: 'application/json',
            error: function (response) {
                console.log(response)
                Swal.fire({
                    icon: "error",
                    html: response.responseJSON.message
                })
            },
            success: function (response) {
                console.log(response)
                const elementoModal = document.getElementById('modal-inscricao')
                const modalInstancia = new Modal(elementoModal)
                modalInstancia.show()
                const inscricao = response.data
                window.Inscricao.elements.nome.html(inscricao.nome)
                window.Inscricao.elements.cpf.html(inscricao.cpf)
                window.Inscricao.elements.email.html(inscricao.email)
                window.Inscricao.elements.telefone.html(inscricao.telefone)
                window.Inscricao.elements.createdAt.html(inscricao.created_at)
                window.Inscricao.elements.crmv.html(inscricao.crmv)
                window.Inscricao.elements.instituicao.html(inscricao.instituicao)
                window.Inscricao.elements.matricula.html(inscricao.matricula)
                window.Inscricao.elements.pago.html(inscricao.pago)
                window.Inscricao.elements.perfil.html(inscricao.perfil)
            }
        })
    },

    changeStatusPagamento(id, status) {
        const novoStatus = (status === "Sim") ? "Não" : "Sim"
        $.ajax({
            url: getPathAmbientClinic('api/inscricoes/'+id),
            type: 'put',
            dataType: 'json',
            contentType: 'application/json',
            data: JSON.stringify({
                status: novoStatus
            }),
            beforeSend: function() {
                window.Inscricao.loading()
            },
            complete: function() {
                setTimeout(() => {
                    Swal.close()
                }, 2000)
            },
            error: function (response) {
                console.log(response)
                Swal.fire({
                    icon: "error",
                    html: response.responseJSON.message
                }) 
            },
            success: function (response) {
                Swal.fire({
                    icon: "success",
                    html: response.message
                })
                window.Inscricao.setupTable($('#table-inscricao')[0])
            }
        })
    },

    indicadores() {
        $.ajax({
            url: getPathAmbientClinic('api/inscricoes-indicadores'),
            type: 'get',
            dataType: 'json',
            contentType: 'application/json',
            error: function (response) {
                console.log(response)
                Swal.fire({
                    icon: "error",
                    html: response.responseJSON.message
                }) 
            },
            success: function (response) {
                const indicador = response.data
                $('#total_inscritos').html(indicador.total_inscritos)
                $('#total_estudantes').html(indicador.total_estudantes)
                $('#total_estudantes_pagos').html(indicador.total_estudantes_pagos)
                $('#total_veterinarios').html(indicador.total_veterinarios)
                $('#total_veterinarios_pagos').html(indicador.total_veterinarios_pagos)

                $('#total_estudantes_pendente_pagamento').html(indicador.total_estudantes - indicador.total_estudantes_pagos)
                $('#total_veterinarios_pendente_pagamento').html(indicador.total_veterinarios - indicador.total_veterinarios_pagos)
                
            }
        })
    },

    loading() {
        Swal.fire({
            title: 'Carregando...',
            didOpen: () => {
                Swal.showLoading() // Mostra o spinner padrão
            },
            allowOutsideClick: false,
            showConfirmButton: false
        })
    },
    exportarExcel() {
        $.ajax({
            url: getPathAmbientClinic('api/inscricoes-exportar'),
            type: 'GET',
            beforeSend: function() {
                window.Inscricao.loading()
            },
            success: function(response) {
                Swal.close()
                if (response.url) {
                    window.location.href = response.url
                }
            },
            error: function() {
                Swal.fire("Erro", "Não foi possível gerar o Excel", "error")
            }
        })
    }
}
window.Inscricao = Inscricao

export default Inscricao