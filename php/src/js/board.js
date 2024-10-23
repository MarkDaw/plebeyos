document.querySelectorAll('button[data-value]').forEach(button => {
    button.addEventListener('click', function() {
        const value = this.getAttribute('data-value'); 

        const inputCol = document.getElementById('col');

        inputCol.value = value;

        document.getElementById('colsform').submit();
    });
});