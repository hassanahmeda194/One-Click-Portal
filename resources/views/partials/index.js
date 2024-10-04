$(".Upload_Revision_ID").click(function () {
    var Revision_ID = $(this).data("id");
    console.log(Revision_ID);

    $("#hidden_Revision_ID").val(Revision_ID);
});

$(".Order-Revision-view").click(function () {
    var Revision_ID = $(this).data("id");

    $("#Revision_view_table tbody").html("");
    $("#Writer_Submission_view_table tbody").html("");
    $("#Order_Deadline_Time").val("");
    $("#Order_Deadline_Date").val("");
    $("#revision_details").html("");

    $.ajax({
        url: "{{ route('Get.Revision.Deatils.Attachment') }}",
        type: "GET",
        data: {
            Revision_ID: Revision_ID,
        },
        dataType: "json",
        success: function (data) {
            $("#Revision_view_table").append(data.SalesTableHtml);
            $("#Writer_Submission_view_table").append(data.WriterAttachment);
            $("#Show_Order_Revision_Words").val(data.send_Revision_word);
            $("#Order_Deadline_Time").val(data.Revision_deadline_Time);
            $("#Order_Deadline_Date").val(data.Revision_deadline_Date);
            $("#revision_details").append(data.Revision_Description);
        },

        error: function (xhr) {
            var errorMessage = xhr.responseText;
            console.log("Error message:", errorMessage);
        },
    });
});
$('.edit-Revision').click(function () {

    var Edit_Revision_ID = $(this).data('id');
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