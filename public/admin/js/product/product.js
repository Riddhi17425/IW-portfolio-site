$(document).ready(function () {
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
    $('#product_name').on('keyup change', function () {
        if (!urlChanged) {
            let slug = slugify($(this).val());
            $('#product_url').val(slug); 
            $('#meta_title').val(slug); 
        }
    });

    $('#url, #meta_title').on('input', function () {
        urlChanged = true;
    });

    var imagePath = window.APP_URLS.imagePath;
    // thats for index datatables 
    var table = $('#product_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: window.APP_URLS.getproductdata,
        order: [[0, 'desc']],
        columns: [
            { data: 'id', name: 'id' }, 
            { data: 'product_name', name: 'product_name' },
            { data: 'product_url', name: 'product_url' },  
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
            { data: 'product_status', name: 'product_status' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    // delete products
    $(document).on('click', '.delete_product', function () {
        let id = $(this).data('id');

        var url = window.APP_URLS.deleteproduct.replace(':id' , id);
        if (confirm('Are you sure you want to delete this product?')) {
            $.ajax({
                url: url,  // Make sure your route matches this
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': window.APP_URLS.csrfToken
                },
                success: function (response) {
                   if(response.result){
                        $("#message-pop-up").attr('style' , 'display:block')
                        $("#message-pop-up").addClass('alert-success')
                        $("#success-message").html(response.message);
                        setTimeout(() => {
                            $("#message-pop-up").attr('style' , 'display:none')
                        }, 3000);
                        table.draw();
                    }else{ 
                        $("#message-pop-up").attr('style' , 'display:block')
                        $("#message-pop-up").addClass('alert-warning')
                        $("#success-message").html(response.message);
                        setTimeout(() => {
                            $("#message-pop-up").attr('style' , 'display:none')
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


// 👉 Main Image Preview
    document.getElementById('image').addEventListener('change', function (e) {
        let preview = document.getElementById('preview_image');
        let file = e.target.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result; 
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    });


// // 👉 Main details  Image Preview
// document.getElementById('details_image').addEventListener('change', function (e) {
//     let preview = document.getElementById('preview_details_image');
//     let file = e.target.files[0];
//     if (file) {
//         let reader = new FileReader();
//         reader.onload = function (e) {
//             preview.src = e.target.result; 
//             preview.style.display = 'block';
//         }
//         reader.readAsDataURL(file);
//     } else {
//         preview.style.display = 'none';
//     }
// });



document.addEventListener('DOMContentLoaded', function() {
    const keywordCheckboxes = document.querySelectorAll('.keyword-checkbox');
    const selectedkeywordsText = document.getElementById('selectedkeywordsText');
    
    function updateSelectedkeywords() {
        const selected = [];
        keywordCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                selected.push(checkbox.value);
            }
        });
        
        if (selected.length > 0) {
            selectedkeywordsText.textContent = selected.join(', ');
            selectedkeywordsText.classList.remove('text-muted');
            selectedkeywordsText.classList.add('text-primary');
        } else {
            selectedkeywordsText.textContent = 'None';
            selectedkeywordsText.classList.remove('text-primary');
            selectedkeywordsText.classList.add('text-muted');
        }
    }
    
    // Add event listeners
    keywordCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectedkeywords);
    });
    
    // Initial update
    updateSelectedkeywords();
    
    // Form validation
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const checkedkeywords = document.querySelectorAll('.keyword-checkbox:checked');
            if (checkedkeywords.length === 0) {
                e.preventDefault();
                alert('Please select at least one keyword.');
                document.querySelector('.keyword-checkbox').focus();
                return false;
            } 
        });
    }
});

// for pdf viewer

let currentPDFUrls = {}; // Store URLs per input to avoid conflicts

function handlePDFPreview(inputId, containerId, frameId) {
    const input = document.getElementById(inputId);
    const container = document.getElementById(containerId);
    const frame = document.getElementById(frameId);

    input.addEventListener('change', function(event) {
        const file = event.target.files[0];

        // Revoke previous URL if exists
        if (currentPDFUrls[inputId]) {
            URL.revokeObjectURL(currentPDFUrls[inputId]);
        }

        if (file && file.type === "application/pdf") {
            currentPDFUrls[inputId] = URL.createObjectURL(file);
            frame.src = currentPDFUrls[inputId];
            container.style.display = 'block';
        } else {
            frame.src = '';
            container.style.display = 'none';
        }
    });
}

// Clean up on page unload
window.addEventListener('unload', function() {
    for (let key in currentPDFUrls) {
        if (currentPDFUrls[key]) {
            URL.revokeObjectURL(currentPDFUrls[key]);
        }
    } 
});

// Initialize handlers for each PDF input
document.addEventListener('DOMContentLoaded', function() {
    handlePDFPreview('brochure_pdf', 'brochurepdfPreviewContainer', 'brochurepdfPreview');
    handlePDFPreview('msds_pdf', 'MSDSpdfPreviewContainer', 'MSDSpdfPreview');
    handlePDFPreview('tds_pdf', 'TDSpdfPreviewContainer', 'TDSpdfPreview');
});


document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('ProductFormSubmit');
    const loader = document.querySelector('.loader-wrapper');

    if (form) {
        form.addEventListener('submit', function(e) {
            // Show loader 
            loader.style.display = 'flex';
        });
    }
});