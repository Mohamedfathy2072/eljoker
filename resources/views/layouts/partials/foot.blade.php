<a href="#" class="back-to-top d-flex align-items-center justify-content-center">
  <i class="bi bi-arrow-up-short"></i>
</a>

<script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
<script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script>
    function addFlagInput() {
        const flagContainer = document.getElementById('flagContainer');
        const newFlagInput = document.createElement('div');
        newFlagInput.classList.add('flagInput');

        // Create a new input field
        const newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.classList.add('form-control');
        newInput.classList.add('mt-3');
        flagContainer.appendChild(newFlagInput);
        newFlagInput.appendChild(newInput);
    }
</script>
<script>
    function addFeatureBlock() {
        const container = document.getElementById('featureBlockContainer');
        const newBlock = document.createElement('div');
        newBlock.classList.add('feature-block', 'mb-3'); // Add margin-bottom to create space between blocks

        // Create the "Features" dropdown and label
        const featureLabel = document.createElement('label');
        featureLabel.classList.add('form-label');
        featureLabel.setAttribute('for', 'inputFeatures'); // Add "for" attribute to associate with the input
        featureLabel.innerText = 'Features'; // Label text

        const select = document.createElement('select');
        select.classList.add('form-select');
        select.name = 'inputFeatures[]';
        select.innerHTML = `
        <option selected>Choose...</option>
        @foreach ($features as $item)
        <option value="{{ $item->value }}">{{ $item->name }}</option>
        @endforeach
        `;

        // Create the "Label" input and label
        const labelField = document.createElement('label');
        labelField.classList.add('form-label');
        labelField.setAttribute('for', 'inputLabel');
        labelField.innerText = 'Label'; // Label text

        const labelInput = document.createElement('input');
        labelInput.type = 'text';
        labelInput.classList.add('form-control');
        labelInput.name = 'inputLabel[]';

        // Create the "Value" input and label
        const valueLabel = document.createElement('label');
        valueLabel.classList.add('form-label');
        valueLabel.setAttribute('for', 'inputValue');
        valueLabel.innerText = 'Value'; // Label text

        const valueInput = document.createElement('input');
        valueInput.type = 'text';
        valueInput.classList.add('form-control');
        valueInput.name = 'inputValue[]';

        // Append the new elements to the new block
        const col1 = document.createElement('div');
        col1.classList.add('col-md-4');
        col1.appendChild(featureLabel); // Add label before the dropdown
        col1.appendChild(select);

        const col2 = document.createElement('div');
        col2.classList.add('col-md-4');
        col2.appendChild(labelField); // Add label before the input
        col2.appendChild(labelInput);

        const col3 = document.createElement('div');
        col3.classList.add('col-md-4');
        col3.appendChild(valueLabel); // Add label before the input
        col3.appendChild(valueInput);

        newBlock.appendChild(col1);
        newBlock.appendChild(col2);
        newBlock.appendChild(col3);

        // Append the new block to the container
        container.appendChild(newBlock);
    }
</script>

<script>
    function addConditionBlock() {
        const container = document.getElementById('conditionBlockContainer');
        const newBlock = document.createElement('div');
        newBlock.classList.add('condition-block', 'mb-3'); // Add margin-bottom to create space between blocks

        // Create the "Conditions" dropdown and label
        const conditionsLabel = document.createElement('label');
        conditionsLabel.classList.add('form-label');
        conditionsLabel.setAttribute('for', 'inputConditions');
        conditionsLabel.innerText = 'Conditions';

        const select = document.createElement('select');
        select.classList.add('form-select');
        select.name = 'inputConditions[]';
        select.innerHTML = `
            <option selected>Choose...</option>
            @foreach ($conditions as $item)
        <option value="{{ $item->value }}">{{ $item->name }}</option>
            @endforeach
        `;

        // Create the "Part" input and label
        const partLabel = document.createElement('label');
        partLabel.classList.add('form-label');
        partLabel.setAttribute('for', 'inputPart');
        partLabel.innerText = 'Part';

        const partInput = document.createElement('input');
        partInput.type = 'text';
        partInput.classList.add('form-control');
        partInput.name = 'inputPart[]';

        // Create the "Description" input and label
        const descriptionLabel = document.createElement('label');
        descriptionLabel.classList.add('form-label');
        descriptionLabel.setAttribute('for', 'inputDescription');
        descriptionLabel.innerText = 'Description';

        const descriptionInput = document.createElement('textarea');
        descriptionInput.classList.add('form-control');
        descriptionInput.name = 'inputDescription[]';
        descriptionInput.rows = 3;

        // Append the new elements to the new block
        const col1 = document.createElement('div');
        col1.classList.add('col-md-4');
        col1.appendChild(conditionsLabel); // Add label before the dropdown
        col1.appendChild(select);

        const col2 = document.createElement('div');
        col2.classList.add('col-md-4');
        col2.appendChild(partLabel); // Add label before the input
        col2.appendChild(partInput);

        const col3 = document.createElement('div');
        col3.classList.add('col-md-4');
        col3.appendChild(descriptionLabel); // Add label before the textarea
        col3.appendChild(descriptionInput);

        newBlock.appendChild(col1);
        newBlock.appendChild(col2);
        newBlock.appendChild(col3);

        // Append the new block to the container
        container.appendChild(newBlock);
    }
</script>
