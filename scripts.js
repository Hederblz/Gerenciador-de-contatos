document.addEventListener('DOMContentLoaded', function() {

    // --- MÁSCARA DE TELEFONE ---
    const campoTelefone = document.getElementById('telefone');

    if (campoTelefone) {
        campoTelefone.addEventListener('input', function(e) {
            let valor = e.target.value.replace(/\D/g, ''); // Remove tudo que não é dígito
            valor = valor.replace(/^(\d{2})(\d)/g, '($1) $2'); // Coloca parênteses em volta dos dois primeiros dígitos
            valor = valor.replace(/(\d{5})(\d)/, '$1-$2'); // Coloca hífen entre o quinto e o sexto dígitos
            e.target.value = valor.slice(0, 15); // Limita o tamanho
        });
    }

    // --- VALIDAÇÃO DE FORMULÁRIO ---
    const form = document.getElementById('form-contato');
    
    if(form) {
        form.addEventListener('submit', function(e){
            const emailInput = form.querySelector('input[name="email"]');
            const emailValue = emailInput.value;

            // Expressão regular simples para validar e-mail
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailPattern.test(emailValue)) {
                alert('Por favor, insira um endereço de e-mail válido.');
                e.preventDefault(); // Impede o envio do formulário
            }
        });
    }


    // --- BUSCA DINÂMICA NA TABELA ---
    const campoBusca = document.getElementById('busca');
    
    if (campoBusca) {
        campoBusca.addEventListener('keyup', function() {
            const termoBusca = campoBusca.value.toLowerCase();
            const tabela = document.getElementById('tabela-contatos');
            const linhas = tabela.getElementsByTagName('tr');

            // Começa em 1 para pular o cabeçalho (thead > tr)
            for (let i = 1; i < linhas.length; i++) {
                const celulas = linhas[i].getElementsByTagName('td');
                let encontrou = false;
                
                // Pega o texto da primeira célula (Nome Completo)
                const nomeCompleto = celulas[0].textContent || celulas[0].innerText;

                if (nomeCompleto.toLowerCase().indexOf(termoBusca) > -1) {
                    encontrou = true;
                }
                
                if (encontrou) {
                    linhas[i].style.display = "";
                } else {
                    linhas[i].style.display = "none";
                }
            }
        });
    }
});