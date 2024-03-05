document.forms.cadastro.onsubmit = validaForm;//chama a funcao validaForm para o formulario "cadastro".

function validaForm(e) {
    let form = e.target; //variavel para receber o formulario.
    let formValido = true; //variavel para ver se o formulario esta devidamente preenchido(nenhum campo vazio) ou nao. Inicializado como true.

    const spanEmail = form.email.nextElementSibling; //variavel para trabalhar com o campo de email.
    const spanSenha = form.senha.nextElementSibling; //variavel para trabalhar com o campo de senha.

    spanEmail.textContent = ""; //inicializa a variavel como vazia.
    spanSenha.textContent = ""; //inicializa a variavel como vazia.

    //se o campo de email estiver vazio a variavel spanEmail tem seu valor mudado e o formulario nao esta devidamente preenchido (false).
    if (form.email.value === "") {
        spanEmail.textContent = "Email deve ser preenchido";
        formValido = false;
    }

    //se o campo de senha estiver vazio a variavel spanSenha tem seu valor mudado e o formulario nao esta devidamente preenchido (false).
    if (form.senha.value === "") {
        spanSenha.textContent = "Senha deve ser preenchido";
        formValido = false;
    }


    //se o formulario nao estiver devidamente preenchido ele nao poderá ser submetido.
    if (!formValido) {
        e.preventDefault();
    }else{
        e.preventDefault();
        window.location.href = "../../PublicoRestrito/HomeRestrito.html";
    }
}