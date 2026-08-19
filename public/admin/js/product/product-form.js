$(document).ready(function () {
    var $name = $('#product_name');
    var $url = $('#product_url');

    function slugify(text) {
        return text
            .toString()
            .toLowerCase()
            .trim()
            .replace(/&/g, '-and-')
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }

    if ($name.length && $url.length) {
        var initialUrl = ($url.val() || '').trim();
        var autoMode = initialUrl === '' || initialUrl === slugify($name.val() || '');

        $name.on('input keyup change', function () {
            if (autoMode) {
                $url.val(slugify($(this).val()));
            }
        });

        $url.on('input', function () {
            autoMode = false;
        });

        $url.on('blur', function () {
            var currentSlug = slugify($name.val() || '');
            var currentValue = ($(this).val() || '').trim();

            if (currentValue === '' || currentValue === currentSlug) {
                autoMode = true;
                $(this).val(currentSlug);
            }
        });
    }

    function renderPreviewCards(files, $container, title, emptyMessage) {
        if (!$container.length) {
            return;
        }

        $container.empty();

        if (!files || !files.length) {
            $container.append('<div class="product-image-preview-empty">' + emptyMessage + '</div>');
            return;
        }

        Array.prototype.forEach.call(files, function (file) {
            if (!file.type || file.type.indexOf('image/') !== 0) {
                return;
            }

            var imageUrl = URL.createObjectURL(file);
            var fileSize = file.size ? Math.round(file.size / 1024) + ' KB' : '';

            $container.append(
                '<div class="product-image-preview-card">' +
                    '<img src="' + imageUrl + '" alt="' + file.name + '" class="product-image-preview-thumb">' +
                    '<div class="product-image-preview-meta">' +
                        '<div class="product-image-preview-title">' + title + '</div>' +
                        '<div class="product-image-preview-name">' + file.name + '</div>' +
                        '<div class="product-image-preview-size">' + fileSize + '</div>' +
                    '</div>' +
                '</div>'
            );
        });
    }

    $('#product_main_image').on('change', function () {
        renderPreviewCards(this.files, $('#productMainImagePreview'), 'Main Image', 'No main image selected.');
    });

    $('#product_gallery_images').on('change', function () {
        renderPreviewCards(this.files, $('#productGalleryPreview'), 'Gallery Image', 'No gallery images selected.');
    });
});