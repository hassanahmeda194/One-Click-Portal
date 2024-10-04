<script>

$(document).ready(function () { 


    $('.Upload_Revision_ID').click(function () {
        var Revision_ID = $(this).data('id');
        console.log(Revision_ID);
        
        $('#hidden_Revision_ID').val(Revision_ID);

    })

   $('.Order-Revision-view').click(function () {
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
    success: function (data) {
       
        $('#Revision_view_table').append(data.SalesTableHtml);
        $('#Writer_Submission_view_table').append(data.WriterAttachment);
        $('#Show_Order_Revision_Words').val(data.send_Revision_word)
        $('#Order_Deadline_Time').val(data.Revision_deadline_Time);
        $('#Order_Deadline_Date').val(data.Revision_deadline_Date);
        $('#revision_details').append(data.Revision_Description);     

    },

    error: function (xhr) {
        var errorMessage = xhr.responseText;
        console.log("Error message:", errorMessage);
    }
});


   
    });

    $('.view-assign-task').click(function () {
        var currentTaskID = $(this).data('id');
        $.ajax({
            url: "{{ route('View.Assign.Task') }}"
            , type: 'GET'
            , data: {
                'task_id': currentTaskID
            }
            , success: function (data) {

                $('#task-table-body tbody').empty().append(data); // Clear existing content and append new rows
            }
            , error: function (xhr) {
                var errorMessage = xhr.responseText;
                console.log(errorMessage);
            }
        });
    });

    $('.edit-Revision').click(function () {

        var Edit_Revision_ID  = $(this).data('id'); 
        console.log(Edit_Revision_ID);
         $('#Edit_Sales_Revision').html('');  
          $('#summernote2').summernote('code', ''); 
        
        
        $.ajax({
        url: '{{ route('Get.Revision.Data') }}',
        type: 'GET',
        data: {

            'Revision_ID': Edit_Revision_ID  // Use a colon (:) here, not an equal sign (=)
        },
        dataType: 'json',  // Specify the expected data type

        success: function (data) {

            console.log(data.Order_Revision_Words);

            var date = new Date(data.Order_Deadline_Date);
            var formattedDate = date.getFullYear() + "-" + ("0" + (date.getMonth() + 1)).slice(-2) + "-" + ("0" + date.getDate()).slice(-2);

            $('#Edit_Revision_ID').val(data.Revision_ID);
            $('#Edit_Revision_Order_ID').val(data.Order_ID);
            $('#Order_Revision_Words').val(data.Order_Revision_Words);
            $('#summernote2').summernote('code', data.Order_description);
            $('#Edit_Revision_Date').val(formattedDate);
            $('#Edit_Revision_Time').val(data.Order_Deadline_Time);
            $('#Edit_Sales_Revision').append(data.salesAttachment);

        },
        error: function (xhr, status, error) {
            console.log('Error:', error);
        }
    });
        

      });


      

    $('#Assign_Words').keyup(function () {
        var Rec_Amount = parseInt($(this).val());
        var Payment = parseInt($('#Total_Words').val());

        if (Rec_Amount > Payment) {
            alert('Entered Words Exceeds!');
            $('#Rem_Word').val(0);
            $(this).val(Payment);
        } else {
            var Due_Amount = Payment - Rec_Amount;
            $('#Rem_Word').val(Due_Amount);
        }
    });

    $('.Task_ID').on('click', function () {
        var getTask_ID = $(this).find('#Task_ID').val();
        $(".task-id").val(getTask_ID);
    });

    $('.View-Revision').on('click', function () {
        const getTask_ID = $(this).find('#Task_ID').val();
        $.ajax({
            url: '{{ route('Get.Task.Revisions') }}'
                , type: 'GET'
            , data: {
                'task_id': getTask_ID
            }
            , success: function (data) {
                $('.Get-Revisions').html(data);
            }
            , error: function (data) {
                alert(data.responseJSON);
            }
        });
    });

    $('#Edit_Assign_Words').keyup(function () {
        var Rec_Amount = parseInt($(this).val());
        var Payment = parseInt($('#Edit_Total_Words').val());
        console.log(Payment);
        console.log(Rec_Amount);
        if (Rec_Amount > Payment) {
            alert('Entered Words Exceeds!');
            $('#Edit_Rem_Word').val(0);
            $(this).val(Payment);
        } else {
            var Due_Amount = Payment - Rec_Amount;
            $('#Edit_Rem_Word').val(Due_Amount);
        }
    });

    $('.Edit-Task').on('click', function () {
        const getTask_ID = $(this).find('#Task_ID').val();
        $.ajax({
            url: '{{ route('Get.Edit.Task.Info') }}'
                , type: 'GET'
            , data: {
                'task_id': getTask_ID
            }
            , success: function (data) {
                $('.Selected-Date').val(data.Selected_Date);
                $('.Selected-Time').val(data.Selected_Time);
                $('.Selected-Writer').val(data.Selected_Writer).trigger('change');
                $('.Selected-Words').val(data.Selected_Words);
                $('.Selected-Total-Words').val(data.Selected_Total_Words);
                $('.Selected-Due-Words').val(data.Selected_Due_Words);
            }
            , error: function (data) {
                alert(data.responseJSON);
            }
        });
    });

    $('.Add-Revision').on('click', function () {
        const getTask_ID = $(this).find('#Task_ID').val();
        $.ajax({
            url: '{{ route('Get.Edit.Task.Info') }}'
                , type: 'GET'
            , data: {
                'task_id': getTask_ID
            }
            , success: function (data) {
                $('.Rev-DeadLine').val(data.Selected_Date);
                $('.Rev-Time').val(data.Selected_Time);
            }
            , error: function (data) {
                alert(data.responseJSON);
            }
        });
    });

    $('.Order-Revision').on('click', function () {
        const getOrder_ID = $(this).find('#Order_ID').val();

        $.ajax({
            url: '{{ route('Get.Order.Rev.Info') }}'
                , type: 'GET'
            , data: {
                'Order_ID': getOrder_ID
            }
            , success: function (data) {
                
                $('.Order-DeadLine').val(data.Selected_Date);
                $('.Order-Time').val(data.Selected_Time);
                $('.Order-Words').val(data.Selected_Words);
            }
            , error: function (data) {
                
            }
        });
    });

    $('#summernote2').summernote({
    height: 300,
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough']],
        ['para', ['ul', 'ol']],
        ['table', ['table']],
        ['insert', ['link']],
        ['view', ['fullscreen', 'codeview']],
    ],
    callbacks: {
        onInit: function () {
            console.log('Summernote initialized');
        },
        onChange: function (contents, $editable) {
            console.log('Content changed:', contents);
        },
    },
});


});

var form = '#Chat-Form';

$(form).on('submit', function (event) {
    event.preventDefault();
    
    var submitButton = $(form).find('button[type="submit"]');
    submitButton.addClass('btn-loading');
    submitButton.html('<span class="px-3">&nbsp;</span>');
    
    var url = $(this).attr('data-action');
    var div = document.getElementById('Order-Messages');

    $.ajax({
        url: url
        , method: 'POST'
        , data: new FormData(this)
        , dataType: 'JSON'
        , contentType: false
        , cache: false
        , processData: false
        , success: function (response) {
            $(form).trigger("reset");
            div.scrollTop = div.scrollHeight;
            submitButton.removeClass('btn-loading');
            submitButton.html('<span class="feather feather-send"></span> Send');
        }
        , error: function (response) {
            alert(response);
        }
    });
});

$(document).on('click', '.popover-body ul li a.Message_Forward', function () {
    const Msg_ID = $(this).find('.Msg_ID').html();
    const Assign_ID = $(this).find('.Assign_ID').html();
    const Order_ID = $(this).find('.Order_ID').html();

    $.ajax({
        url: '{{ route('Forward.To.Executive') }}'
                , type: 'GET'
        , data: {
            'Msg_ID': Msg_ID
            , 'Assign_ID': Assign_ID
            , 'Order_ID': Order_ID
            ,
        }
        , success: function (data) {
            sendRequest(Order_ID);
            alert(data.message);
        }
        , error: function (data) {
            console.log(data);
            alert(data);
        }
    });
});

// Get All Order Messages
const Order_ID = {{ (int) $Research_Order -> id}};

setInterval(function () {
    sendRequest(Order_ID);
}, 5000);

// Function to initialize the popover
function initializePopover() {
    $('[data-toggle="popover"]').popover({
        html: true
        , sanitize: false
        ,
    })
    var popoverTriggerEl = document.querySelector('[data-bs-toggle="popover"]');
    var popoverInstance = new bootstrap.Popover(popoverTriggerEl);

    // Remove popover when clicking on the otherside
    document.addEventListener('click', function (event) {
        var targetElement = event.target;

        // Check if the clicked element is outside the popover and its trigger element
        if (!targetElement.closest('.popover') && targetElement !== popoverTriggerEl) {
            popoverInstance.hide();
        }
    });
}

function sendRequest(Order_ID) {

    $.ajax({
        url: '{{ route('Get.Messages') }}'
                , type: 'GET'
        , data: {
            'Order_ID': Order_ID
        }
        , success: function (data) {
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