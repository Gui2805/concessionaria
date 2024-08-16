function cadastro(formElement) {

const nome = formElement.querySelector("#nome").value;
const email = formElement.querySelector("#email").value;
const senha = formElement.querySelector("#senha").value;

const formData = new FormData();
formData.append('acao', 'cadastro_usuario');
formData.append('nome', nome);
formData.append('email', email);
formData.append('senha', senha);
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
        alert("Cadastro realizado com sucesso!");
        window.location.href = "login.html";
    }
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