/**
 * Retorna um log no console destacado com o css em questão,
 * contendo a mensagem passada por parâmetro.
 * @param  {[Objeto]} msg [conteúdo a ser logado.]
 */
function log(msg) {
    return console.log('%c ' + hora() +msg, 'background: #222; color: #bada55');
}

/**
 * Retorna um warning no console destacado com o css em questão,
 * contendo a mensagem passada por parâmetro.
 * @param  {[Objeto]} msg [conteúdo a ser logado no warning]
 */
function warn(msg) {
    console.warn('%c ' + hora() +msg, 'background: #222; color: #bada55');
}

/**
 * Retorna um erro no console destacado com o css em questão,
 * contendo a mensagem passada por parâmetro.
 * @param  {[Objeto]} msg [conteúdo a ser logado no error]
 */
function error(msg) {
    console.error('%c ' + hora() +msg, 'background: #222; color: #bada55');
}

/**
 * Mostra no console o conteúdo de docData, para fins de debug, precedido do conteúdo
 * de  msg, cujo preenchimento é opcional.
 * @param  {[Objeto]} docData  [description]
 * @param  {String} [msg=""] [description]
 */
function debug(docData, msg="") {
    console.log('%c ' + hora() + msg + JSON.stringify(docData), 'background: #111; color: #bada55');
}

/**
 * Retorna a hora atual.
 * @return {[String]} [description]
 */
function hora() {
    now = new Date;
    return addZero(now.getHours()) + ":" + addZero(now.getMinutes()) + ":" + addZero(now.getSeconds()) + ":" + addZero(now.getMilliseconds()) + " ";
}

/**
 * Auxilia na formatação de data.
 *
 * @param {type} i
 * @returns {String}
 */
function addZero(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

/**
 *
 * @param string
 */
function al(string){
    swal({
        title: 'Opa!',
        text: string,
        type: 'info',
        confirmButtonText: 'Beleza!'
    })
}