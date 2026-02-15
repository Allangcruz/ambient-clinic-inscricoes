import $ from 'jquery'
import DataTable from 'datatables.net-dt'
import 'datatables.net-dt/css/dataTables.dataTables.css'

const Inscricao = {
    elements: {
        formInscricao: $("#form-inscricao"),
        id: $('#id'),
        nome: $('#nome'),
        email: $('#email'),
        telefone: $('#telefone'),
        perfil: $('#perfil'),
        cpf: $('#cpf')
    },

    instance: null,

    init() {
        console.info('Initialize module inscricao ...')
        
        const tableElement = document.querySelector('#table-inscricao')
        if (tableElement) {
            this.setupTable(tableElement)
        }
    },

    setupTable(el) {
        // No DataTables 2.0, usamos 'new DataTable()' passando o elemento do DOM
        this.instance = new DataTable(el, {
        processing: true,
        serverSide: true,
        searching: false,
        ajax: {
            url: '/api/inscricoes',
            type: 'GET'
        },
        columns: [
            { data: 'id' },
            { data: 'nome' },
            { data: 'email' },
            { data: 'telefone' },
            { data: 'cpf' },
            { data: 'pago' },
            { 
            data: null,
            orderable: false,
            render: (data) => {
                return `<button class="pico-button" data-id="${data.id}">Editar</button>`
            }
            }
        ],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
        }
        })
    },

    destroy(id, nome) {
        console.log(`Destruindo registro: ${id} - ${nome}`)
    }
}

export default Inscricao