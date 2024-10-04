<!--Page header-->
<div class="page-header d-lg-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Search Order:</h4>
    </div>
</div>
<!--End Page header-->

<!-- Row -->
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card custom-card">
            <div class="card-body pb-0 mb-2">
                <div class="search-container mt-3">
                    <label for="orderSearch" class="form-label">Enter Order ID:</label>
                    <div class="input-group">
                        <input type="text" class="form-control Search_Records" id="orderSearch"
                            placeholder="Search by Order ID...">
                        <button id="searchButton" class="btn btn-primary">Search</button>
                    </div>
                </div>
                <div class="card-body p-3">
                    <p class="text-muted mb-0 ps-3" id="Search-Info"></p>
                </div>
            </div>
        </div>
        <div id="Searching-Queries"></div>
    </div>
</div>
<!-- End Row -->

<script>
    function performSearch() {
        const Query = $('.Search_Records').val();

        if (Query.trim() !== '') {
            $.ajax({
                url: '{{ route('Get.Search.Records') }}',
                type: 'GET',
                data: {
                    'Query': Query
                },
                success: function(data) {
                    if (data.data) {
                        $('#Searching-Queries').html(data.data);
                        const resultInfo =
                            `<p class="text-muted mb-0 ps-3">About ${data.totalResults} results (${data.searchTime} Seconds)</p>`;
                        $('#Search-Info').html(resultInfo);
                    } else {
                        $('#Search-Info').html('<p class="text-danger">No results found</p>');
                        $('#Searching-Queries').html('');
                    }
                },
                error: function(data) {}
            });
        } else {
            $('#Searching-Queries').html('');
            $('#Search-Info').html('');
        }
    }

    $('#searchButton').click(function() {
        performSearch();
    });

   
</script>
