<script>
    $('.edit-Revision').click(function() {

        $('#Edit_Sales_Revision').html('');

        var Edit_Revision_ID = $(this).data('id');
        $.ajax({
            url: '{{ route('Get.Revision.Data') }}',
            type: 'GET',
            data: {

                'Revision_ID': Edit_Revision_ID
            },
            dataType: 'json',

            success: function(data) {
                $('#Edit_Revision_ID').val(data.Revision_ID);
                var date = new Date(data.Order_Deadline_Date);
                var formattedDate = date.getFullYear() + "-" + ("0" + (date.getMonth() +
                    1)).slice(-2) + "-" + ("0" + date.getDate()).slice(-2);
                $('#Edit_Revision_Order_ID').val(data.Order_ID);
                $('#Edit_Sales_Revision').append(data.salesAttachment);
                $('#Edit_Revision_Date').val(formattedDate);
                $('#Edit_Revision_Time').val(data.Order_Deadline_Time);
            },
            error: function(xhr, status, error) {
                console.log('Error:', error);
            }
        });
    });


    $('.Order-Revision-view').click(function() {
        var Revision_ID = $(this).data('id');

        $('#Revision_view_table tbody').html('');
        $('#Writer_Submission_view_table tbody').html('');
        $('#Order_Deadline_Time').val('');
        $('#Order_Deadline_Date').val('');
        $('#revision_details').html('');

        $.ajax({
            url: "{{ route('Get.Revision.Deatils.Attachment') }}",
            type: 'GET',
            data: {
                'Revision_ID': Revision_ID
            },
            dataType: 'json',
            success: function(data) {

                $('#Revision_view_table').append(data.SalesTableHtml);
                $('#Writer_Submission_view_table').append(data.WriterAttachment);
                $('#Show_Order_Revision_Words').val(data.send_Revision_word)
                $('#Order_Deadline_Time').val(data.Revision_deadline_Time);
                $('#Order_Deadline_Date').val(data.Revision_deadline_Date);
                $('#revision_details').append(data.Revision_Description);

            },
            error: function(xhr) {
                var errorMessage = xhr.responseText;
                console.log("Error message:", errorMessage);
            }
        });
    });

    $('.Upload_Revision_ID').click(function() {
        var Revision_ID = $(this).data('id');
        console.log(Revision_ID);

        $('#hidden_Revision_ID').val(Revision_ID);

    });

    var form = '#Development-Chat-Form';
    $(form).on('submit', function(event) {
        event.preventDefault();

        var submitButton = $(form).find('button[type="submit"]');
        submitButton.addClass('btn-loading');
        submitButton.html('<span class="px-3">&nbsp;</span>');

        var url = $(this).attr('data-action');
        var div = document.getElementById('Order-Messages');

        $.ajax({
            url: url,
            method: 'POST',
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                $(form).trigger("reset");
                div.scrollTop = div.scrollHeight;
                submitButton.removeClass('btn-loading');
                submitButton.html('<span class="feather feather-send"></span>Send');
            },
            error: function(response) {
                console.log(response);
            }
        });
    });


    $(document).on('click', '.popover-body ul li a.Message_Forward', function() {
        const Msg_ID = $(this).find('.Msg_ID').html();
        const Assign_ID = $(this).find('.Assign_ID').html();
        const Order_ID = $(this).find('.Order_ID').html();

        $.ajax({
            url: '{{ route('Forward.To.Executive') }}',
            type: 'GET',
            data: {
                'Msg_ID': Msg_ID,
                'Assign_ID': Assign_ID,
                'Order_ID': Order_ID,
            },
            success: function(data) {
                sendRequest(Order_ID);
                alert(data.message);
            },
            error: function(data) {
                console.log(data);
                alert(data);
            }
        });
    });

    // Get All Order Messages
    const Order_ID = {{ (int) $DevelopmentOrder->id }};

    setInterval(function() {
        sendRequest(Order_ID);
    }, 5000);

    // Function to initialize the popover
    function initializePopover() {
        $('[data-toggle="popover"]').popover({
            html: true,
            sanitize: false,
        })
        var popoverTriggerEl = document.querySelector('[data-bs-toggle="popover"]');
        var popoverInstance = new bootstrap.Popover(popoverTriggerEl);

        // Remove popover when clicking on the otherside
        document.addEventListener('click', function(event) {
            var targetElement = event.target;

            // Check if the clicked element is outside the popover and its trigger element
            if (!targetElement.closest('.popover') && targetElement !== popoverTriggerEl) {
                popoverInstance.hide();
            }
        });
    }

    function sendRequest(Order_ID) {

        $.ajax({
            url: '{{ route('Get.Messages') }}',
            type: 'GET',
            data: {
                'Order_ID': Order_ID
            },
            success: function(data) {
                $('#Order-Messages').html(data);
                initializePopover();
            }
        });
    }
    document.addEventListener('submit', function(event) {
        var submitButton = document.querySelector('.add-btn-loader');
        submitButton.disabled = true;
        submitButton.classList.add('btn-loading');
    });
</script>
