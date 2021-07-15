$(document).ready(function () {
    $("#cep").keydown(function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            pesquisacep($("#cep").val());
        }
    });
})

/**************************************************
 *                                                *
 *                      CEP                       *
 *                                                *
 **************************************************/

function limpa_formulario_cep() {
    /** Limpa valores do formulário de cep. */
    document.getElementById('cep').value = ("");
    document.getElementById('rua').value = ("");
    document.getElementById('bairro').value = ("");
    document.getElementById('cidade').value = ("");
    document.getElementById('uf').value = ("");
}

function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
        /** Atualiza os campos com os valores. */
        document.getElementById('rua').value = (conteudo.logradouro);
        document.getElementById('bairro').value = (conteudo.bairro);
        document.getElementById('cidade').value = (conteudo.localidade);
        document.getElementById('uf').value = (conteudo.uf);
    } else {
        /** CEP não Encontrado. */
        limpa_formulario_cep();
        alert("CEP não encontrado.");
    }
}

function pesquisacep(valor) {

    /** Nova variável "cep" somente com dígitos. */
    var cep = valor.replace(/\D/g, '');

    /** Verifica se campo cep possui valor informado. */
    if (cep !== "") {

        /** Expressão regular para validar o CEP. */
        var validacep = /^[0-9]{8}$/;

        /** Valida o formato do CEP. */
        if (validacep.test(cep)) {

            /** Preenche os campos com "..." enquanto consulta webservice. */
            document.getElementById('rua').value = "...";
            document.getElementById('bairro').value = "...";
            document.getElementById('cidade').value = "...";
            document.getElementById('uf').value = "...";

            /** Cria um elemento javascript. */
            var script = document.createElement('script');

            /** Sincroniza com o callback. */
            script.src = 'https:/** */viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

            /** Insere script no documento e carrega o conteúdo. */
            document.body.appendChild(script);

        } else {
            /** cep é inválido. */
            limpa_formulario_cep();
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Formato de CEP inválido."
            })
        }
    } else {
        /** cep sem valor, limpa formulário. */
        limpa_formulario_cep();
    }
}

function somenteNumeros(num, maxlenght) {
    var er = /[^0-9.]/;
    er.lastIndex = 0;
    var campo = num;
    var max = maxlenght;

    /** Aceita somente letras */
    if (er.test(campo.value)) {
        campo.value = "";
    }

    /** limita a quantidade de digitos no campo */
    if (campo.value.length >= max) {
        campo.value = stop;
    } else {
        stop = campo.value;
    }
}

function phoneMask(campo) {
    campo.value = campo.value.replace(/[^\d]/g, '')
        .replace(/^(\d\d)(\d)/, '($1) $2')
        .replace(/(\d{4})(\d)/, '$1-$2');
    if (campo.value.length === 15) {
        campo.value = campo.value.replace(/[^\d]/g, '')
            .replace(/^(\d\d)(\d)/, '($1) $2')
            .replace(/(\d{5})(\d)/, '$1-$2');
    }
    if (campo.value.length >= 16) {
        campo.value = stop;
    } else {
        stop = campo.value;
    }
}

function cpfMask(v) {
    v.value = v.value.replace(/\D/g, "")
        .replace(/(\d{3})(\d)/, "$1.$2")
        .replace(/(\d{3})(\d)/, "$1.$2")
        .replace(/(\d{3})(\d{1,2})$/, "$1-$2")

    if (v.value.length >= 15) {
        v.value = stop;
    } else {
        stop = v.value;
    }
}

function mascaraData(val) {
    var pass = val.value;
    var expr = /[0123456789]/;

    for (i = 0; i < pass.length; i++) {
        /** charAt -> retorna o caractere posicionado no índice especificado */
        var lchar = val.value.charAt(i);
        var nchar = val.value.charAt(i + 1);

        if (i === 0) {
            /** search -> retorna um valor inteiro, indicando a posição do inicio da primeira */
            /** ocorrência de expReg dentro de instStr. Se nenhuma ocorrencia for encontrada o método retornara -1 */
            /** instStr.search(expReg); */
            if ((lchar.search(expr) !== 0) || (lchar > 3)) {
                val.value = "";
            }

        } else if (i === 1) {

            if (lchar.search(expr) !== 0) {
                /** substring(indice1,indice2) */
                /** indice1, indice2 -> será usado para delimitar a string */
                var tst1 = val.value.substring(0, (i));
                val.value = tst1;
                continue;
            }

            if ((nchar !== '/') && (nchar !== '')) {
                var tst1 = val.value.substring(0, (i) + 1);

                if (nchar.search(expr) !== 0)
                    var tst2 = val.value.substring(i + 2, pass.length);
                else
                    var tst2 = val.value.substring(i + 1, pass.length);

                val.value = tst1 + '/' + tst2;
            }

        } else if (i === 4) {

            if (lchar.search(expr) !== 0) {
                var tst1 = val.value.substring(0, (i));
                val.value = tst1;
                continue;
            }

            if ((nchar !== '/') && (nchar !== '')) {
                var tst1 = val.value.substring(0, (i) + 1);

                if (nchar.search(expr) !== 0)
                    var tst2 = val.value.substring(i + 2, pass.length);
                else
                    var tst2 = val.value.substring(i + 1, pass.length);

                val.value = tst1 + '/' + tst2;
            }
        }

        if (i >= 6) {
            if (lchar.search(expr) !== 0) {
                var tst1 = val.value.substring(0, (i));
                val.value = tst1;
            }
        }
    }

    if (pass.length > 10)
        val.value = val.value.substring(0, 10);
    return true;
}