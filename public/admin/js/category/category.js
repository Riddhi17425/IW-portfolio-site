$(document).ready(function () {
    console.log("Category JS Loaded");
     // Slugify function
    function slugify(text) {
        return text
            .toString()
            .toLowerCase()
            .trim()
            .replace(/&/g, '-and-')        // Replace & with 'and'
            .replace(/[\s\W-]+/g, '-')     // Replace spaces, non-word chars with -
            .replace(/^-+|-+$/g, '');      // Trim - from start & end
    }

    let urlChanged = false; 

    // Auto-generate slug + meta title
    $('#title').on('keyup change', function () {
        if (!urlChanged) {
            let slug = slugify($(this).val()); 
            $('#url').val(slug);
            $('#meta_title').val(slug);   
        }
    });

    $('#url, #meta_title').on('input', function () {
        urlChanged = true;
    });

 
    // ===== Image Preview =====
    function readAndPreview(input, previewId) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $('#' + previewId).attr('src', e.target.result).show();
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
  
    // Mobile preview
    $('#image').on('change', function () {
        readAndPreview(this, 'preview_image'); 
    });

    $('#backgorund_image').on('change', function () {
        readAndPreview(this, 'preview_backgorund_image'); 
    });

    // thats for index datatables
    var imagePath = window.APP_URLS.image_path;
    var table = $('#category_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
        url: window.APP_URLS.getCategoryData,
        type: "GET",
        dataSrc: function (json) {
            console.log("Datatables Response:", json); // 👈 Full Laravel JSON here
            return json.data; // DataTables expects array of rows here
        }
    },
        order: [[0, 'desc']],
        columns: [
            { data: 'id', name: 'id' }, 
            { data: 'title', name: 'title' },
            {
                data: 'image',
                name: 'image',
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    if (data) {
                        return '<img src="'+ imagePath + '/' +  data + '" alt="' + row.image + '" width="60" height="60">';
                    } else {
                        return '<span class="text-muted">No Image</span>';
                    }
                }
            }, 
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    // delete blogs
    $(document).on('click', '.delete_category', function () {
        let id = $(this).data('id');

        var url = window.APP_URLS.deletecategory.replace(':id', id);
        if (confirm('Are you sure you want to delete this category ?')) {
            $.ajax({
                url: url,  // Make sure your route matches this
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': window.APP_URLS.csrfToken
                },
                success: function (response) {
                    if (response.result) { 
                        $("#message-pop-up").attr('style', 'display:block')
                        $("#message-pop-up").addClass('alert-success')
                        $("#success-message").html(response.message);
                        setTimeout(() => {
                            $("#message-pop-up").attr('style', 'display:none')
                        }, 3000);
                        table.draw();
                    } else {
                        $("#message-pop-up").attr('style', 'display:block')
                        $("#message-pop-up").addClass('alert-warning')
                        $("#success-message").html(response.message);
                        setTimeout(() => {
                            $("#message-pop-up").attr('style', 'display:none')
                        }, 3000);
                    }
                },
                error: function (xhr) {
                    alert('Something went wrong!');
                }
            });
        }
    });
});






document.addEventListener('DOMContentLoaded', function() {
    const key_benefitCheckboxes = document.querySelectorAll('.key_benefit_checkbox');
    const selectedkey_benefitsText = document.getElementById('selectedkey_benefitsText');
    
    function updateSelectedkey_benefits() {
        const selected = [];
        key_benefitCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                selected.push(checkbox.value);
            }
        }); 
        
        if (selected.length > 0) {
            selectedkey_benefitsText.textContent = selected.join(', ');
            selectedkey_benefitsText.classList.remove('text-muted');
            selectedkey_benefitsText.classList.add('text-primary');
        } else {
            selectedkey_benefitsText.textContent = 'None';
            selectedkey_benefitsText.classList.remove('text-primary');
            selectedkey_benefitsText.classList.add('text-muted');
        }
    }
    
    // Add event listeners
    key_benefitCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectedkey_benefits);
    });
     
    // Initial update
    updateSelectedkey_benefits();
    
    // Form validation
    const form = document.querySelector('form'); 
    if (form) {
        form.addEventListener('submit', function(e) {
            const checkedkey_benefits = document.querySelectorAll('.key_benefit_checkbox:checked');
            if (checkedkey_benefits.length === 0) {
                e.preventDefault();
                alert('Please select at least one key benefit.');
                document.querySelector('.key_benefit_checkbox').focus();
                return false;
            } 
        });
    } 
});
