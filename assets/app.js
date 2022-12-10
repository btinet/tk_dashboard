import './styles/app.css';

import * as coreui from '@coreui/coreui';


require('bootstrap');
require('./apps/sorter/js/sortable.min');
require('./sortable-main/sortable.min');



document.onreadystatechange = function () {
    'use strict'

    const tooltipTriggerList = document.querySelectorAll('[data-coreui-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new coreui.Tooltip(tooltipTriggerEl))



    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })

}






