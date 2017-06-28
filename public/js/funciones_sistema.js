//Solo números y letras. Permite tabulación y DEL
function nWKey(e) {
    evt = e ? e : event;
    tcl = (window.Event) ? evt.which : evt.keyCode;
    if ((tcl >= 65 && tcl <= 90) || (tcl >= 97 && tcl <= 122) ||
        (tcl >= 48 && tcl <= 57) || (tcl == 0 || tcl == 8)) {
        return true;
    }
    return false;
}
//Solo letras. Permite tabulación y DEL
function wKey(e) {
    evt = e ? e : event;
    tcl = (window.Event) ? evt.which : evt.keyCode;
    //alert(tcl);
    if ((tcl >= 65 && tcl <= 90) || (tcl >= 97 && tcl <= 122)
    || (tcl == 241 || tcl == 209 || tcl == 225 || tcl == 0 || tcl == 8
        || tcl == 223 || tcl == 237 || tcl == 243 || tcl == 250
        || tcl == 193 || tcl == 201 || tcl == 205 || tcl == 211
        || tcl == 218 || tcl == 32)) {
        return true;
    }
    return false;
}