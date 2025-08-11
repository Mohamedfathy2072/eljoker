document.addEventListener('DOMContentLoaded', function () {
    const typeSelect = document.getElementById('type');
    const optionsContainer = document.getElementById('options-container');
    const optionsList = document.getElementById('options-list');
    const addOptionBtn = document.getElementById('add-option');




    function toggleOptions() {
        if (['select', 'radio', 'checkbox'].includes(typeSelect.value)) {
            optionsContainer.style.display = 'block';
        } else {
            optionsContainer.style.display = 'none';
        }
    }

    function removeOption(option){
        document.remove(option);
    }

    function addOption(value = '') {
        const optionRow = document.createElement('div');
        optionRow.className = 'input-group mb-2 option-row';
        optionRow.innerHTML = `
            <input type="text" class="form-control" name="options[]" value="${value}" required>
            <button type="button" class="btn btn-outline-danger remove-option" data-bs-toggle="tooltip" title="Remove option">
                <i class="bi bi-x-lg"></i>
            </button>
        `;
        optionsList.appendChild(optionRow);


        const removeBtn = optionRow.querySelector('.remove-option');



        removeBtn.addEventListener('click', function () {
            if (document.querySelectorAll('.option-row').length > 1) {
                optionRow.remove();
            } else {
                optionRow.querySelector('input').value = '';
            }
        });
    }


    typeSelect.addEventListener('change', toggleOptions);

    addOptionBtn.addEventListener('click', function () {
        addOption();
    });


    toggleOptions();


    if (document.querySelectorAll('.option-row').length === 0) {
        addOption();
    }
});