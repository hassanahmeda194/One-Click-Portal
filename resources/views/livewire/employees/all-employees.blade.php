
<!-- Include jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

 
<div class="page-header d-xl-flex d-block dataTables_paginate paging_simple_numbers">
    <div class="page-leftheader">
        <h4 class="page-title">All Registered<span class="font-weight-normal text-muted ms-2">Employee</span></h4>
    </div>
</div>
<!--End Page header-->
<div class="card">
    <div class="card-body pb-2">
        <div class="row">
            <div class="col mb-4">
                <a href="{{ route('New.Employee') }}" class="btn btn-primary"><i class="fe fe-plus"></i> Add New
                    User</a>
                <!--<a href="{{ route('Delete.All.Employee') }}" class="btn btn-danger">-->
                <!--    <i class="fe fe-trash-2"></i> Delete All Users</a>-->
            </div>
             <div class="col col-auto mb-4">
                <div class="form-group w-100">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fe fe-search"></i></span>
                        <input id="searchInput" type="text" class="form-control" placeholder="Search User">
                    </div>
                </div>
            </div>
        </div>
        @include('partials.fetch-users', ['Users' => $All_Users])
    </div>

</div>
<script>
      function filterUsers() {
        var input, filter, cards, cardContainer, h4, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        cardContainer = document.getElementById("userList");
        cards = cardContainer.getElementsByClassName("col-xl-4 col-lg-6");
        for (i = 0; i < cards.length; i++) {
            h4 = cards[i].querySelector(".card-body p");
            txtValue = h4.textContent || h4.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                cards[i].style.display = "";
            } else {
                cards[i].style.display = "none";
            }
        }
    }

    // Attach event listener to input field
    document.getElementById("searchInput").addEventListener("keyup", filterUsers);
</script>
