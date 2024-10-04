<div id="Portal-Errors"></div>

<script>

    function getErrors() {
        // Make the AJAX request
        $.ajax({
            url: '{{ route('Get.Portal.Errors') }}',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $('#Portal-Errors').html(data.html);
            },
            error: function (xhr, textStatus, errorThrown) {
                $('#Portal-Errors').text('An error occurred while fetching data.');
                console.log(xhr, textStatus, errorThrown);
            }
        });
    }

    getErrors();
    setInterval(function () {
        getErrors();
    }, 5000);
</script>
