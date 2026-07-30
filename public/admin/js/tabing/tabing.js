$(document).ready(function () {
    function slugify(text) {
        return text
            .toString()
            .toLowerCase()
            .trim()
            .replace(/&/g, '-and-')
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }

    var $name = $('#tabing_name');
    var $url = $('#tabing_url');

    if (!$name.length || !$url.length) {
        return;
    }

    var initialUrl = ($url.val() || '').trim();
    var initialSlug = slugify($name.val() || '');
    var autoMode = initialUrl === '' || initialUrl === initialSlug;

    $name.on('input keyup change', function () {
        if (autoMode) {
            $url.val(slugify($(this).val()));
        }
    });

    $url.on('input', function () {
        autoMode = false;
    });

    $url.on('focus', function () {
        $(this).data('before-focus', ($(this).val() || '').trim());
    });

    $url.on('blur', function () {
        var currentValue = ($(this).val() || '').trim();
        var currentNameSlug = slugify($name.val() || '');
        if (currentValue === '' || currentValue === currentNameSlug) {
            autoMode = true;
            $(this).val(currentNameSlug);
        }
    });
});