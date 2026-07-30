$(document).ready(function () {
    var tabings = window.PRODUCT_TABINGS || [];
    var selectedTabings = window.PRODUCT_SELECTED_TABINGS || [];
    var $categoryInputs = $('input[name="category_id[]"]');
    var $tabingDropdown = $('#tabingCheckboxDropdown');
    var $tabingButton = $('#tabingDropdownBtn');
    var $selectedTabingText = $('#selectedTabingText');

    if (!$tabingDropdown.length || !$tabingButton.length || !$categoryInputs.length) {
        return;
    }

    function getSelectedCategoryIds() {
        return $categoryInputs
            .filter(':checked')
            .map(function () {
                return String($(this).val());
            })
            .get();
    }

    function updateSelectedTabingText() {
        var selectedLabels = $tabingDropdown
            .find('input[name="tabing_id[]"]:checked')
            .map(function () {
                return $(this).data('label');
            })
            .get();

        if (selectedLabels.length) {
            $selectedTabingText.text(selectedLabels.join(', '));
        } else {
            $selectedTabingText.text('Select Tabings');
        }
    }

    function buildOptions(selectedValues) {
        var selectedCategoryIds = getSelectedCategoryIds();
        var selectedLookup = (selectedValues || []).map(function (value) {
            return String(value);
        });
        var filteredTabings = tabings.filter(function (tabing) {
            return selectedCategoryIds.indexOf(String(tabing.category_id)) !== -1;
        });

        $tabingDropdown.empty();

        if (!filteredTabings.length) {
            $tabingDropdown.append('<div class="px-3 py-2 text-muted">No tabings available for selected categories.</div>');
            updateSelectedTabingText();
            return;
        }

        filteredTabings.forEach(function (tabing) {
            var isChecked = selectedLookup.indexOf(String(tabing.id)) !== -1 ? 'checked' : '';
            $tabingDropdown.append(
                '<div class="form-check px-3 py-1">' +
                    '<input class="form-check-input" type="checkbox" name="tabing_id[]" id="tabing_' + tabing.id + '" value="' + tabing.id + '" data-label="' + tabing.name.replace(/"/g, '&quot;') + '" ' + isChecked + '>' +
                    '<label class="form-check-label" for="tabing_' + tabing.id + '">' + tabing.name + '</label>' +
                '</div>'
            );
        });

        updateSelectedTabingText();
    }

    buildOptions(selectedTabings);

    $categoryInputs.on('change', function () {
        var currentValues = $tabingDropdown
            .find('input[name="tabing_id[]"]:checked')
            .map(function () {
                return $(this).val();
            })
            .get();

        buildOptions(currentValues);
    });

    $tabingButton.on('click', function () {
        $tabingDropdown.toggle();
    });

    $(document).on('change', 'input[name="tabing_id[]"]', function () {
        updateSelectedTabingText();
    });

    $(document).on('click', function (event) {
        if (!$tabingButton.is(event.target) && $tabingButton.has(event.target).length === 0 && !$tabingDropdown.is(event.target) && $tabingDropdown.has(event.target).length === 0) {
            $tabingDropdown.hide();
        }
    });
});