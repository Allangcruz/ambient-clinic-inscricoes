import $ from 'jquery'

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

    init() {
        console.info('Initialize module inscricao ...');
        this.search();
    },

    search() {
        $.ajax({
            url: getPathAmbientClinic('api/inscricoes'),
            type: 'GET',
            dataType: 'json',
            contentType: 'application/json',
            beforeSend: () => {
                // $.LoadingOverlay("show")
            },
            complete: () => {
                // $.LoadingOverlay("hide")
            },
            error: (response) => {
                console.error('Erro na busca:', response);
            },
            success: (response) => {
                console.log('Sucesso:', response);
            }
        });
    },

    destroy(id, nome) {
        console.log(`Destruindo registro: ${id} - ${nome}`);
    }
};

export default Inscricao;