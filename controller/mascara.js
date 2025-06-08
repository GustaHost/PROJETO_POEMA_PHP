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
    .replace(/\D/g, '')                     
    .replace(/^(\d{2})(\d)/, '($1) $2')     
    .replace(/(\d{5})(\d)/, '$1-$2')        
    .replace(/(-\d{4})\d+?$/, '$1');       
}

