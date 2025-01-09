console.log(111111111111111111111111);

(function () {
    const { createElement } = wp.element;
    const { dispatch, select } = wp.data;

    const addDropdownField = () => {
        const editPopup = document.querySelector('.your-edit-popup-class'); // Change this to the actual class of the popup

        if (!editPopup || editPopup.querySelector('.custom-dropdown-field')) return; // Prevent adding multiple dropdowns

        // Create a new dropdown element
        const dropdown = createElement('select', {
            className: 'custom-dropdown-field',
            onChange: (event) => {
                // Handle dropdown value change
                const selectedValue = event.target.value;
                // Save selected value to block attributes (adjust as necessary)
                const blockId = select('core/block-editor').getSelectedBlock().clientId;
                dispatch('core/block-editor').updateBlockAttributes(blockId, { customDropdown: selectedValue });
            },
        });

        // Add options to the dropdown
        dropdown.innerHTML = `
            <option value="">Select an option</option>
            <option value="option1">Option 1</option>
            <option value="option2">Option 2</option>
            <option value="option3">Option 3</option>
        `;

        // Append the dropdown to the popup
        const pointTitleField = editPopup.querySelector('.point-title-class'); // Adjust to the actual class of the title field
        if (pointTitleField) {
            pointTitleField.parentNode.insertBefore(dropdown, pointTitleField.nextSibling); // Insert after title field
        }
    };

    // Listen for the opening of the Edit Point popup
    document.addEventListener('click', (event) => {
        if (event.target.closest('.your-trigger-class')) { // Change to the class that triggers the popup
            setTimeout(addDropdownField, 0); // Delay to ensure the popup is fully rendered
        }
    });
})();
