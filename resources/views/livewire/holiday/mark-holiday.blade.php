<!--Page header-->
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Mark Holiday</h4>
    </div>

</div>
<!--End Page header-->
<!-- Row -->
<div class="row">
    <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('Post.Mark.Holiday') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-lg-3">
                            <div class="form-group">
                                <label class="form-label">Select Date:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    </div><input class="form-control" type="date" id="datepicker" name="date"
                                        value="{{ request('date') }}">
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12 col-lg-3">
                            <div class="form-group">
                                <label class="form-label">Enter Holiday Name:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    </div><input class="form-control" placeholder="Enter Holiday Name" type="text"
                                        name="name">
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mt-5">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>

                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="hr-checkall">

                        </div>
                    </div>
                </div>
                <div class="table-responsive" id="Marked-Attandence-Table">
                    <table class="table table-vcenter text-nowrap table-bordered border-bottom"
                        id="responsive-datatable">
                        <thead>
                            <tr>
                                <th class="border-bottom-0 w-5">#S:no</th>
                                <th class="border-bottom-0">Title</th>
                                <th class="border-bottom-0">Date</th>
                                <th class="border-bottom-0">Day</th>
                                <th class="border-bottom-0">Created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Holidays as $Holiday)

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $Holiday->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($Holiday->date)->format('d-m-Y') }}</td>

<td>{{ \Carbon\Carbon::parse($Holiday->date)->format('l') }}</td>

                                <td>{{ $Holiday->created_at->format('d-m-Y') }}</td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Row-->


<script src="../../assets/plugins/daterangepicker/moment.min.js"></script>
<script src="../../assets/plugins/daterangepicker/daterangepicker.js"></script>
