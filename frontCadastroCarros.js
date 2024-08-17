function cadastroVeiculo(formElement) {
    
    const modelo = formElement.querySelector("#modelo").value;
    const fabricante = formElement.querySelector("#fabricante").value;
    const tipo = formElement.querySelector("#tipo").value;
    const ano = formElement.querySelector("#ano").value;

    const formData = new FormData();
    formData.append('acao', 'insere_veiculo');
    formData.append('modelo', modelo);
    formData.append('fabricante', fabricante);
    formData.append('tipo', tipo);
    formData.append('ano', ano);
    fetch('control.php', {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.status == 200) {
                alert("Cadastro do veículo realizado com sucesso!");
            }
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });

}

function listagem_carros() {


    const formData = new FormData();
    formData.append('acao', 'lista_veiculos');
    fetch('control.php', {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data)
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });

}


function desativa_forms() {
    var forms = document.querySelectorAll('form');

    forms.forEach(function (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
        });
    });
}

desativa_forms();
