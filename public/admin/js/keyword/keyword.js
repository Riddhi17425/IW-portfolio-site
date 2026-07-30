$(document).ready(function () {

        $(".modal").on("hidden.bs.modal", function(){
            $('#keyword_form')[0].reset();
        });
        $('#Savekeyword').on('click', function() {
        
            if (validate_title() & validate_status()) {
                submitForm();
            }
        }); 

        function validate_title() {
            if ($("#title").val().trim() == '') {
                $("#span_title").text('Keyword name is required.');
                return false;
            } else {
                $("#span_title").text('');
                return true;
            }
        }

        function validate_status() {
            if ($("input[name='status']:checked").length == 0) {
                $("#span_status").text('Please select a status.');
                return false;
            } else {
                $("#span_status").text('');
                return true;
            }
        }

        function submitForm() {
            const formData = $('#keyword_form').serialize();
            var url = window.APP_URLS.keywordStore;
            var saveBtn = $('#Savekeyword');
            var messagePopUp = $('#message-pop-up');
            var successMessage = $('#success-message');

            saveBtn.prop('disabled', true);
            saveBtn.text('Submitting...');

            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                success: function(response) {
                    if (response.status) {
                        showMessage('success', response.message);

                        $('#keyword_modal').modal('hide');
                        $('#keyword_form')[0].reset();
                        table.draw();
                    } else {
                        if (response.errors) {
                            handleErrors(response);
                        }
                        showMessage('danger', 'Please fix the errors and try again.');
                    }

                    resetButton();
                },
                error: function(xhr, status, error) {
                    let message = 'An unexpected error occurred.';

                    if(xhr.responseJSON && xhr.responseJSON.errors) {
                        // If validation errors exist, show the first one
                        const errors = xhr.responseJSON.errors;
                        if(errors.title) {
                            message = errors.title[0];
                        } else if(errors.status) {
                            message = errors.status[0];
                        }
                    } else if(xhr.responseJSON && xhr.responseJSON.message) {
                        // If a general message is returned from the server
                        message = xhr.responseJSON.message;
                    }
                    $('#keyword_modal').modal('hide');
                    showMessage('danger', message);
                    resetButton();
                }
            });

            function showMessage(type, message) {
                // Remove both alert classes and add the appropriate one
                messagePopUp.removeClass('alert-success alert-danger')
                        .addClass(type === 'success' ? 'alert-success' : 'alert-danger');
                
                successMessage.text(message);
                messagePopUp.fadeIn();

                // Hide after 20 seconds
                setTimeout(function() {
                    messagePopUp.fadeOut();
                }, 3000);
            }

            function resetButton() {
                saveBtn.prop('disabled', false);
                saveBtn.text('Save');
            }
        }

        function handleErrors(response) {
            if(response.errors) {
                if(response.errors.title){
                    $("#span_title").text(response.errors.title[0]);
                }
                if(response.errors.status){
                    $("#span_status").text(response.errors.status[0]);
                }
            }
        }

        




    // thats for index datatables 
    var table = $('#keywordtable').DataTable({
        processing: true,
        serverSide: true,
        ajax: window.APP_URLS.keyword_get_data,
        order: [[0, 'desc']],
        columns: [
            { data: 'id', name: 'id' }, 
            { data: 'title', name: 'title' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    // delete products
    $(document).on('click', '.delete_keyword', function () {
        let id = $(this).data('id');

        var url = window.APP_URLS.keyword_delete_data.replace(':id' , id);
        if (confirm('Are you sure you want to delete this Keyword?')) {
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

   

    $(document).on('click', '.edit_keyword', function () {
        let id = $(this).data('id');
        var url = window.APP_URLS.keyword_edit_data.replace(':id', id);

        // Fetch keyword data for editing
        $.ajax({
            url: url,
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': window.APP_URLS.csrfToken
            },
            success: function(response) {
                if(response.status) {
                    // Populate form fields with the data
                    $('#keyword_id').val(response.data.id);
                    $('#title').val(response.data.title);
                    
                    // Set the status radio button
                    $("input[name='status']").prop('checked', false); // Clear previous selection
                    $("input[name='status'][value='" + response.data.status + "']").prop('checked', true);

                    // Clear any previous error messages
                    $('#span_title').text('');
                    $('#span_status').text('');

                    // Show the modal
                    $('#keyword_modal').modal('show');
                } else {
                    showMessage('danger', response.message);
                }
            },
            error: function(xhr, status, error) {
                showMessage('danger', 'Failed to fetch keyword data.');
                console.error(error);
            }
        });
    });

}); 


