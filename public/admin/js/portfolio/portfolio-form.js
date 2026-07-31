$(document).ready(function () {
    /* ---------- Industry dropdown toggle ---------- */
    $("#industryDropdownBtn").on("click", function (e) {
        e.stopPropagation();
        $("#industryCheckboxDropdown").toggle();
    });
    $(document).on("click", function (e) {
        if (
            !$(e.target).closest(
                "#industryCheckboxDropdown, #industryDropdownBtn",
            ).length
        ) {
            $("#industryCheckboxDropdown").hide();
        }
    });

    /* ---------- Services tag input ---------- */
    const $tagWrapper = $("#servicesTagWrapper");
    const $tagInput = $("#servicesTagInput");
    const $tagHidden = $("#servicesHidden");
    let services = [];

    try {
        const existing =
            window.EXISTING_SERVICES || JSON.parse($tagHidden.val() || "[]");
        if (Array.isArray(existing)) services = existing;
    } catch (e) {
        services = [];
    }

    function renderTags() {
        $tagWrapper.find(".service-tag").remove();
        services.forEach((tag, idx) => {
            const $tag = $(`
                <span class="service-tag badge bg-primary d-inline-flex align-items-center me-1 mb-1" style="gap:6px;">
                    ${$("<div>").text(tag).html()}
                    <span class="tag-remove" data-idx="${idx}" style="cursor:pointer;">&times;</span>
                </span>
            `);
            $tag.insertBefore($tagInput);
        });
        $tagHidden.val(JSON.stringify(services));
    }

    $tagInput.on("keydown", function (e) {
        if (e.key === "Enter" || e.key === ",") {
            e.preventDefault();
            const val = $(this).val().trim();
            if (val && !services.includes(val)) {
                services.push(val);
                renderTags();
            }
            $(this).val("");
        } else if (
            e.key === "Backspace" &&
            $(this).val() === "" &&
            services.length
        ) {
            services.pop();
            renderTags();
        }
    });

    $tagWrapper.on("click", ".tag-remove", function () {
        services.splice($(this).data("idx"), 1);
        renderTags();
    });

    renderTags();

    /* ---------- Hero model preview ---------- */
    $("#heroModelInput").on("change", function () {
        const file = this.files[0];
        if (!file) return;
        const url = URL.createObjectURL(file);
        $("#heroModelPreview").attr("src", url);
        $("#heroModelPreviewWrap").show();
    });

    /* ---------- Banner image preview ---------- */
    $("#bannerImageInput").on("change", function () {
        const file = this.files[0];
        if (!file) return;
        const url = URL.createObjectURL(file);
        $("#bannerImagePreview").attr("src", url);
        $("#bannerImagePreviewWrap").show();
    });

    /* ---------- Media repeater ---------- */
    let mediaIndex = $("#media-rows .media-row").length;

    function updateRemoveButtons() {
        const $rows = $("#media-rows .media-row");
        $rows.find(".media-remove").toggle($rows.length > 1);
    }

    function buildMediaRow(index) {
        return $(`
            <div class="row g-3 align-items-center media-row border-bottom pb-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Title</label>
                    <input type="text" name="media[${index}][title]" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Type</label>
                    <select name="media[${index}][type]" class="form-control media-type-select">
                        <option value="">Select Type</option>
                        ${$(".media-type-select")
                            .first()
                            .html()
                            .replace(/selected/g, "")}
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="form-label">File</label>
                    <input type="file" name="media[${index}][file][]" class="form-control media-file-input" multiple>
                    <div class="media-preview-wrap mt-2"></div>
                </div>
                <div class="col-md-2 d-flex align-items-end gap-2">
                    <button type="button" class="btn btn-danger btn-sm media-remove">Remove</button>
                </div>
            </div>
        `);
    }

    function showPreviews($row, files) {
        const $wrap = $row.find(".media-preview-wrap");
        // remove only the "new" thumbs, keep existing-file thumbs already in the DOM
        $wrap.find(".new-thumb").remove();

        files.forEach((file, idx) => {
            const url = URL.createObjectURL(file);
            const ext = file.name.split(".").pop().toLowerCase();
            let inner = "";

            if (["jpg", "jpeg", "png", "webp", "gif"].includes(ext)) {
                inner = `<img src="${url}" title="${file.name}">`;
            } else if (["mp4", "mov", "webm"].includes(ext)) {
                inner = `<video src="${url}"></video><span class="thumb-badge">Video</span>`;
            } else if (["glb", "gltf"].includes(ext)) {
                inner = `<model-viewer src="${url}" camera-controls auto-rotate></model-viewer><span class="thumb-badge">3D</span>`;
            } else {
                inner = `<span class="d-flex align-items-center justify-content-center h-100 small text-muted px-1 text-center">${file.name}</span>`;
            }

            const $thumb = $(`
            <div class="media-thumb new-thumb" data-file-index="${idx}">
                ${inner}
                <button type="button" class="thumb-remove" title="Remove">&times;</button>
            </div>
        `);
            $wrap.append($thumb);
        });

        updateFileCount($row);
    }

    function updateFileCount($row) {
        const total = $row.find(".media-thumb").length;
        let $label = $row.find(".media-file-count");
        if (!$label.length) {
            $label = $('<div class="media-file-count"></div>');
            $row.find(".media-preview-wrap").after($label);
        }
        $label.text(
            total ? `${total} file${total > 1 ? "s" : ""} attached` : "",
        );
    }

    // Remove an existing (already-saved) file's thumbnail + its hidden input
    $("#media-rows").on("click", ".existing-thumb .thumb-remove", function () {
        const $thumb = $(this).closest(".existing-thumb");
        const filePath = $thumb.data("file");
        const $row = $thumb.closest(".media-row");

        $row.find(`input.existing-file[value="${filePath}"]`).remove();
        $thumb.remove();
        updateFileCount($row);
    });

    // Remove a newly-selected (not yet uploaded) file's thumbnail, and rebuild the input's FileList
    $("#media-rows").on("click", ".new-thumb .thumb-remove", function () {
        const $thumb = $(this).closest(".new-thumb");
        const removeIndex = parseInt($thumb.data("file-index"), 10);
        const $row = $thumb.closest(".media-row");
        const $input = $row.find(".media-file-input")[0];

        const dt = new DataTransfer();
        Array.from($input.files).forEach((file, idx) => {
            if (idx !== removeIndex) dt.items.add(file);
        });
        $input.files = dt.files;

        // rebuild all "new" thumb previews with corrected indices
        showPreviews($row, Array.from($input.files));
    });

    // Trigger previews when files are selected on any row's file input
    $("#media-rows").on("change", ".media-file-input", function () {
        const files = Array.from(this.files);
        if (!files.length) return;

        const $row = $(this).closest(".media-row");
        showPreviews($row, files);

        // auto-fill title from first file's name if empty
        const $title = $row.find('input[name*="[title]"]');
        if (!$title.val()) {
            $title.val(files[0].name.replace(/\.[^/.]+$/, ""));
        }
    });

    $("#mediaAddGlobal").on("click", function () {
        mediaIndex++;
        const $newRow = buildMediaRow(mediaIndex);
        $("#media-rows").append($newRow);
        updateRemoveButtons();
    });

    $("#media-rows").on("click", ".media-remove", function () {
        $(this).closest(".media-row").remove();
        updateRemoveButtons();
    });

    updateRemoveButtons();
});
