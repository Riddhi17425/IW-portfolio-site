$(document).ready(function () {
 
    // thats for index datatables 
    var imagePath = window.APP_URLS.image_path;
    var table = $('#milestone_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: window.APP_URLS.getmilestonedata,
        order: [[0, 'desc']],
        columns: [
            { data: 'id', name: 'id' },
            { data: 'year', name: 'year' },
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

    // delete milestone
    $(document).on('click', '.delete_milestone', function () {
        let id = $(this).data('id'); 

        var url = window.APP_URLS.deletemilestone.replace(':id' , id);
        if (confirm('Are you sure you want to delete this milestone?')) {
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






function validateAndPreviewImage() {
        const input = document.getElementById("milestone_image");
        const file = input.files[0];
        const errorSpan = document.getElementById("span_milestone_image");
        const previewImg = document.getElementById("preview_milestone_image");
        const bannerId = document.getElementById("span_milestone_image_id")?.value;
        // Check if file selected
        if (bannerId && !file) {
            errorSpan.innerText = ""; 
            return true; // allow update without new image
        }
        if (!file) {
            errorSpan.innerText = "product image image is required.";
            previewImg.style.display = "none";
            return false; 
        }
 
        if (!file.type.startsWith("image/")) {
            errorSpan.innerText = "Only image files are allowed.";
            input.value = ""; // reset input
            previewImg.style.display = "none";
            return false;
        }
 
        // Show image preview
        const reader = new FileReader();
        reader.onload = function (e) {
            previewImg.src = e.target.result;
            previewImg.style.display = "block";
            errorSpan.innerText = "";
        }
        reader.readAsDataURL(file);
        return true;
    }


