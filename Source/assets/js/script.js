function validar(){
    msg = '<ul class="list-group">';
    if(validaForm() == -1){
        $("#retorno").slideDown().html(msg);
        return false;
    }else{
        return true;
    }
}

function validaForm(){
    var input = $('input');
    var textarea = $('textarea');
    var primeiro = 0;
    for(i = 0; i < input.length; i++){
        var text = input[i];
        if(text.getAttribute('data-ob') == "1" && text.value == ''){
            msg = msg+'<li class="list-group-item list-group-item-danger">O campo ' + text.getAttribute('data-alt') + ' é obrigatório</li>';
            primeiro = 1;
        }
    }
    for(i = 0; i < textarea.length; i++){
        var text = textarea[i];
        if(text.getAttribute('data-ob') == "1" && text.value == ''){
            msg = msg+'<li class="list-group-item list-group-item-danger">O campo ' + text.getAttribute('data-alt') + ' é obrigatório</li>';
            primeiro = 1;
        }
    }
    if($("#email").val() != null && $("#email").val() != ''){
        if(validaEmail($("#email").val())){
            msg = msg+'<li class="list-group-item list-group-item-danger">E-mail inválido</li>';
            primeiro = 1;
        }
    }
    if($("#cpf").val() != null && $("#cpf").val() != ''){
        var cpf = $("#cpf").val().replace(/\D+/g, '');
        if(!validaCPF(cpf)){
            msg = msg+'<li class="list-group-item list-group-item-danger">CPF inválido</li>';
            primeiro = 1;
        }
    }

    msg = msg+'</ul>';
    if (primeiro == 1){
        return -1;
    } else{
        return 0;
    }
}

function validaEmail(text) {
    usuario = text.substring(0, text.indexOf("@"));
    dominio = text.substring(text.indexOf("@")+ 1, text.length);

    if ((usuario.length >=1) &&
        (dominio.length >=3) &&
        (usuario.search("@")==-1) &&
        (dominio.search("@")==-1) &&
        (usuario.search(" ")==-1) &&
        (dominio.search(" ")==-1) &&
        (dominio.search(".")!=-1) &&
        (dominio.indexOf(".") >=1)&&
        (dominio.lastIndexOf(".") < dominio.length - 1)) {
        return 0;
    }
    else{
        return -1;
    }
}