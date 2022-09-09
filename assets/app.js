import './styles/main.css';

import Ausgabe from './test';

require('bootstrap');

document.onreadystatechange = function () {
    if (document.readyState === "interactive") {
        // Initialize your application or run some code.
        document.getElementById('contento').innerHTML = new Ausgabe(16,22).getAusgabe();
    }
}




