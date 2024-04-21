document.getElementById('cargo').onchange = function () {
    var medicoCampos = document.getElementById('medicoCampos');
    if (this.value === 'medico') {
        medicoCampos.style.display = 'block';
    } else {
        medicoCampos.style.display = 'none';
    }
};


