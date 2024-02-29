document.getElementById("btn").addEventListener("click", function() {
    var select = document.querySelector("select"); // Alteração aqui para selecionar o elemento <select>
    var selectedOption = select.value; // Alteração aqui para obter o valor selecionado diretamente do elemento <select>
    if (selectedOption) {
        window.location.href = selectedOption;
    } else {
        alert("Por favor, selecione uma opção antes de prosseguir.");
    }
});