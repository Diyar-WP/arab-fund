wp.domReady(() => {
    const { InspectorControls } = wp.blockEditor || wp.editor;
    const { PanelBody, SelectControl } = wp.components;
    const { Fragment, createElement } = wp.element;
    const { addFilter } = wp.hooks;

    const titleOptions = [
        { label: 'Option 1', value: 'option1' },
        { label: 'Option 2', value: 'option2' },
        { label: 'Option 3', value: 'option3' }
    ];

    function addCustomDropdownField(BlockEdit) {
        return (props) => {
            const { attributes, setAttributes } = props;
            const { imagePoints } = attributes;

            // Ensure imagePoints is an array and has default values if not
            const points = Array.isArray(imagePoints) ? imagePoints : [];

            return createElement(
                Fragment,
                null,
                createElement(BlockEdit, props),
                createElement(
                    InspectorControls,
                    null,
                    createElement(
                        PanelBody,
                        { title: 'Country List' },
                        points.map((point, index) => {
                            // Ensure each point has a customDropdown property
                            const customDropdownValue = point.customDropdown || '';

                            return createElement(
                                SelectControl,
                                {
                                    key: index,
                                    label: `Point ${index + 1} Dropdown`,
                                    value: customDropdownValue,
                                    options: titleOptions,
                                    onChange: (newValue) => {
                                        // Update the specific point's dropdown value
                                        const updatedPoints = [...points];
                                        updatedPoints[index] = {
                                            ...point,
                                            customDropdown: newValue,
                                        };
                                        setAttributes({ imagePoints: updatedPoints });
                                    }
                                }
                            );
                        })
                    )
                )
            );
        };
    }

    // Apply the filter to add custom control
    addFilter(
        'editor.BlockEdit',
        'custom/gitwid-image-hotspot-custom-dropdown',
        addCustomDropdownField
    );
});
