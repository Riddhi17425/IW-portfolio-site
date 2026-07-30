$(document).ready(function () {

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


    $(document).on('click', '.remove-image', function () {
        $(this).closest('.image-input-row').remove();
    });

    $(document).on('change', '.image-input', function (e) {
        let input = this;
        let preview = $(this).siblings('.img-preview');
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                preview.attr('src', e.target.result).show();
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.hide();
        } 
    });   

 
    // thats for index datatables 
    var imagePath = window.APP_URLS.image_path;
    var table = $('#jobs_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: window.APP_URLS.getJobsdata,
        order: [[0, 'desc']],
        columns: [
            { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    // delete milestone
    $(document).on('click', '.delete_jobs', function () {
        let id = $(this).data('id');

        var url = window.APP_URLS.deletejobs.replace(':id' , id); 
        if (confirm('Are you sure you want to delete this data?')) {
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

