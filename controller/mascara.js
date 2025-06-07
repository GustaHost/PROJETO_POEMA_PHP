function mascaraCPF() 
    {
        var cpf = document.getElementById('cpf');
        if(cpf.value.length == 3 || cpf.value.length == 7)
        {
          cpf.value += ".";
        }
        else if(cpf.value.length == 11)
        {
          cpf.value += "-";
        }
    }

function mascaraTelefone() {
  var tel = document.getElementById('telefone');
  tel.value = tel.value
    .replace(/\D/g, '')                     // Remove tudo que não é dígito
    .replace(/^(\d{2})(\d)/, '($1) $2')     // Coloca parênteses nos dois primeiros dígitos
    .replace(/(\d{5})(\d)/, '$1-$2')        // Coloca hífen depois do quinto dígito
    .replace(/(-\d{4})\d+?$/, '$1');        // Impede digitação além do formato
}

