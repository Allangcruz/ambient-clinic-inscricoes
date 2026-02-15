// css
import '@picocss/pico'

import $ from 'jquery'
window.$ = window.jQuery = $;

import Inscricao from './js/inscricao'

// Inicializa quando o DOM estiver pronto
$(function() {
    Inscricao.init()
})

const Init = () => {
    
}

export default Init;
