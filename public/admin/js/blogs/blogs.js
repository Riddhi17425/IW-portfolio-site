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
    $('#title').on('keyup change', function () {
        if (!urlChanged) {
            let slug = slugify($(this).val());
            $('#url').val(slug); 
            $('#meta_title').val(slug); 
        } 
    });

    $('#url' , '#meta_title').on('input', function () {
        urlChanged = true;
    });


    // thats for index datatables
    var imagePath = window.APP_URLS.image_path;
    var table = $('#blogs_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
        url: window.APP_URLS.getBlogsData,
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
                data: 'front_image',
                name: 'front_image',
                orderable: false, 
                searchable: false,
                render: function (data, type, row) {
                    if (data) {
                        return '<img src="'+ imagePath + "/" + data + '" alt="' + row.image + '" width="60" height="60">';
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
    $(document).on('click', '.delete_blogs', function () {
        let id = $(this).data('id');

        var url = window.APP_URLS.deleteblogs.replace(':id', id);
        if (confirm('Are you sure you want to delete this blogs ?')) {
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


function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
         
        reader.onload = function(e) {
            const preview = document.getElementById(previewId);
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

    // Event listeners
    document.getElementById('blogs_front_image').addEventListener('change', function() {
        previewImage(this, 'preview_blogs_front_image');
    });

    document.getElementById('blogs_detail_image').addEventListener('change', function() {
        previewImage(this, 'preview_blogs_detail_image');
    });

    document.getElementById('cta_image').addEventListener('change', function() {
        previewImage(this, 'preview_cta_image');
    });



