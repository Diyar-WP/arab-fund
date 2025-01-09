wp.domReady(() => {
    const { InspectorControls } = wp.blockEditor || wp.editor;
    const { PanelBody, SelectControl } = wp.components;
    const { Fragment, createElement } = wp.element;
    const { addFilter } = wp.hooks;
    // fetch countries from API
    const titleOptions = [
        { label: 'Option 1', value: 'option1' },
        { label: 'Option 2', value: 'option2' },
        { label: 'Option 3', value: 'option3' }
    ];

    function addCustomDropdownField(BlockEdit) {
        return (props) => {
            if (props.name === 'getwid/image-hotspot') {
                return createElement(
                    Fragment,
                    null,
                    createElement(BlockEdit, props),
                    createElement(
                        InspectorControls,
                        null,
                        createElement(
                            PanelBody,
                            { title: 'Custom Dropdown' },
                            createElement(
                                SelectControl,
                                {
                                    label: 'Custom Field',
                                    value: props.attributes.customDropdown || '',
                                    options: titleOptions,
                                    onChange: (newValue) => {
                                        props.setAttributes({ customDropdown: newValue });
                                    }
                                }
                            )
                        )
                    )
                );
            }
            return createElement(BlockEdit, props);
        };
    }

    // Apply the filter to add custom control
    addFilter(
        'editor.BlockEdit',
        'custom/gitwid-image-hotspot-custom-dropdown',
        addCustomDropdownField
    );
});
