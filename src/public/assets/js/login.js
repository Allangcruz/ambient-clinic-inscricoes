let ambientClinic = (function($) {
    const $formLogin = $('#form-login')
    $formLogin.validate()

    const init = function() {
        console.log('inicializando modulo de login')
    }

    const autenticar = function() {
        if ($formLogin.valid()) {
            $.ajax({
                type: 'post',
                url: $formLogin.attr("action"),
                data: $formLogin.serialize(),
                beforeSend: function() {
                    $.LoadingOverlay("show")
                },
                complete: function() {
                    $.LoadingOverlay("hide")
                },
                error: function (response) {
                    if (response.status >= 400) {
                        if ('messages' in response.responseJSON) {
                            enterprise.adicionarNotificacao("e", response.responseJSON.messages.error, '.message-login')
                            return
                        }

                        if ('errors' in response.responseJSON) {
                            var message = Object.values(response.responseJSON.errors).join('<br>')
                            enterprise.adicionarNotificacao("e", message, '.message-login')
                            return
                        }
                    }
                },
                success: function (response) {
                    window.location.href = "/dashboard/home"
                }
            })
            return
        }

        $formLogin.validate().focusInvalid()
    }

    return {
        init: init,
        autenticar: autenticar
    }
})(jQuery)