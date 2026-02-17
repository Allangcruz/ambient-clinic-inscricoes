import 'admin-lte/dist/css/adminlte.min.css'
import './scss/styles.scss'
// import 'bootstrap-icons/font/bootstrap-icons.css'

import $ from 'jquery'
import 'admin-lte/dist/js/adminlte.min.js'
import * as bootstrap from 'bootstrap'

import Inscricao from './js/inscricao'

$(function() {
    Inscricao.init()
})


const Init = () => {}
export default Init