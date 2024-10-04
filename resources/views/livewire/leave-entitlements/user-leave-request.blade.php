<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Leave Request</h4>
    </div>
</div>
<!--End Page header-->

<!-- Row -->
<div class="row">
    <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header  border-0">
                <h4 class="card-title">Apply Leaves</h4>
            </div>
            <form action="{{ route('Post.Leave.Request') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="leave-types">
                        <div class="row">
                            <div class="col-xl-3">
                                <div class="form-group">
                                    <label class="form-label">Subject</label>
                                    <input type="text" name="Leave_Subject" class="form-control"
                                           placeholder="Leave Subject">
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="form-group">
                                    <label class="form-label">From</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="feather feather-calendar"></span>
                                            </div>
                                        </div>
                                        <input class="form-control fc-datepicker-2" placeholder="MM/DD/YYYY" name="F_Date"
                                               type="date" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="form-group">
                                    <label class="form-label">To</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="feather feather-calendar"></span>
                                            </div>
                                        </div>
                                        <input class="form-control fc-datepicker-2" placeholder="MM/DD/YYYY" name="L_Date"
                                               type="date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="form-group">
                                    <label class="form-label">Leaves Types</label>
                                    <select name="Leave_Type" class="form-control custom-select select2"
                                            data-placeholder="Select">
                                        <option label="Select"></option>
                                        @foreach ($Leave_Info as $Leave)
                                            @if($Leave_Quota->Sick_Leaves === 0 && $Leave->id === 3)
                                                @continue
                                            @endif
                                            @if($Leave_Quota->Casual_Leaves === 0 && $Leave->id === 2)
                                                @continue
                                            @endif
                                            @if($Leave_Quota->Annual_Leaves === 0 && $Leave->id === 1)
                                                @continue
                                            @endif
                                            <option value="{{ $Leave->id }}">{{ $Leave->Leave_Type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label class="form-label">Reason:</label>
                                    <textarea class="form-control" name="Leave_Reason" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary w-100">Send Leave Request</button>
                </div>
            </form>
        </div>
    </div>
</div>
