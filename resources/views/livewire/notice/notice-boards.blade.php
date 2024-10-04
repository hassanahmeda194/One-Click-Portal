<!--Page header-->
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Notice Board</h4>

    </div>


    <div class="page-rightheader ms-md-auto">
        <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
            <div class="btn-list">
                <a href="#" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addnoticemodal">Add New
                    Notice</a>
            </div>
        </div>
    </div>
</div>

<!--End Page header-->
<!-- Row -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header border-0 d-flex align-items-center justify-content-between">
                <h4 class="card-title">Notice Summary</h4>

            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger fade show" role="alert">
                    @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                    @endforeach
                </div>
                @endif

                <div class="table-responsive">
                    <table class="table datatable table-vcenter text-nowrap table-bordered border-bottom"
                        id="hr-notice">
                        <thead>
                            <tr>
                                <th class="border-bottom-0 w-5">No</th>
                                <th class="border-bottom-0">Title</th>
                                <th class="border-bottom-0">Type</th>
                                <th class="border-bottom-0">Start DateTime</th>
                                <th class="border-bottom-0">End DateTime</th>
                                <th class="border-bottom-0">Create By</th>
                                <th class="border-bottom-0">Created On</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($notices as $notice)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $notice->title }}</td>
                                <td>{{ $notice->type }}</td>
                                </td>
                                <td>{{ $notice->start_datetime }}</td>
                                <td>{{ $notice->end_datetime }}</td>
                                <td>{{ $notice->createdBy->basic_info->full_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($notice->created_at)->format('d-m-Y') }}</td>

                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('Delete.Notice', ['Notice_ID' => $notice->id]) }}"
                                            class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Delete">
                                            <i class="feather feather-trash-2 text-danger"></i>
                                        </a>
                                        <a href="#" class="action-btns1 view-detail-btn" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="View" data-notice-id="{{ $notice->id }}">
                                            <i class="feather feather-eye text-info"></i>
                                        </a>

                                        @if($notice->type == "survey")

                                        <a href="{{ route('view.notice.boards.answers', ['Notice_ID' => $notice->id]) }}"
                                            class="action-btns1 view-asnwers-btn" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="View Answers">
                                            <i class="feather feather-message-circle text-success"></i>
                                        </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addnoticemodal">
    <div class="modal-dialog modal-lg" style="max-width: 1200px  !important;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Notice</h5>
                <button class="btn btn-success survey-question" id="add_new_question">Add New Question</button>
            </div>
            <form action="{{ route('Post.Notice') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" style="max-height: calc(90vh - 200px); overflow-y: auto;">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Title</label>
                            <input class="form-control" placeholder="Notice Title" type="text" name="title">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Notice Type</label>
                            <select id="notice-type-select" name="type" class="form-control">
                                <option selected disabled>Select Type</option>
                                <option value="description">Description</option>
                                <option value="image">Image</option>
                                <option value="video">Video</option>
                                <option value="survey">Survey</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Start DateTime</label>
                            <input type="datetime-local" class="form-control choose-date flatpickr-input"
                                name="start_datetime">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">End DateTime</label>
                            <input type="datetime-local" class="form-control choose-date flatpickr-input"
                                name="end_datetime">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Time Limit</label>
                            <div class="input-group">
                                <input type="number" class="form-control" min="1" name="time_limit"
                                    placeholder="Enter minutes">
                                <span class="input-group-text">In Minutes</span>
                            </div>
                        </div>
                    </div>
                    <div class="survey-question mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Survey Question 1</label>
                                <div class="input-group">
                                    <input type="text" name="Question[1]" class="form-control">
                                    <span class="input-group-text">
                                        <button class="btn btn-primary btn-sm add-options" id="add_options_1"
                                            data-question="1">Add Options</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2" id="options_1"></div>
                    </div>

                    <div class="form-group" id="description" style="display: none;">
                        <label class="form-label">Description:</label>
                        <textarea name="description" class="form-control" cols="30" rows="5"></textarea>
                    </div>
                    <div class="form-group" id="Image" style="display: none;">
                        <label class="form-label">Upload Image:</label>
                        <input type="file" class="form-control" name="image[]" multiple>
                    </div>
                    <div class="form-group" id="Video" style="display: none;">
                        <label class="form-label">Upload Video:</label>
                        <input type="file" class="form-control" name="video">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add Notice</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#description, #Image, #Video, .survey-question').hide();

        $('select[name="type"]').change(function() {
            const selectedValue = $(this).val();
            $('#description').toggle(selectedValue === 'description');
            $('#Image').toggle(selectedValue === 'image');
            $('#Video').toggle(selectedValue === 'video');
            $('.survey-question').toggle(selectedValue === 'survey');
        });

        $(document).on('click', '.add-question', function() {
            var questionContainer = $('<div class="question-container"></div>');
            var questionInput = $(
                '<input type="text" class="form-control question" placeholder="Question" name="survey_question[]">'
            );

            questionContainer.append(questionInput);

            $('#survey-questions').append(questionContainer);
        });

        $('#options').hide();
        var questionCount = 1;

        $(function() {
            $('#add_new_question').click(function(e) {
                e.preventDefault();

                questionCount++;
                let questionHtml = `<div class="survey-question mb-3" data-question="${questionCount}">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Survey Question ${questionCount}</label>
                                    <div class="input-group">
                                        <input type="text" name="Question[${questionCount}]" class="form-control">
                                    <span class="input-group-text">
                                        <button class="btn btn-danger btn-sm remove-question" data-question="${questionCount}">Remove</button>
                                    </span>
                                    <span class="input-group-text">
                                        <button class="btn btn-primary btn-sm add-options" id="add_options_${questionCount}" data-question="${questionCount}">Add Options</button>
                                    </span>
                                </div>
                                </div>
                            </div>
                            <div class="row mt-2" id="options_${questionCount}"></div>
                        </div>`;
                $('.modal-body').append(questionHtml);
            });

            $(document).on('click', '.add-options', function(e) {
                e.preventDefault();
                let questionNum = $(this).data('question');
                let optionCount = $(`#options_${questionNum} > div`).length + 1;

                let optionsHtml = `<div class="col-md-6 ms-0 option_${questionNum}" data-optionid="${optionCount}">
                    <label for="option_${questionNum}" class="form-label mt-2">Option ${optionCount} for Question ${questionNum}</label>
                    <div class="input-group">
                        <input type="text" id="option_${questionNum}_${optionCount}" name="Option_${questionNum}[]" class="form-control">
                        <span class="input-group-text">
                            <button class="btn btn-danger btn-sm remove-option" data-question="${questionNum}" data-option="${optionCount}">Remove</button>
                        </span>
                        </div>
                </div>`;
                $(`#options_${questionNum}`).show().append(optionsHtml);
            });

            $(document).on('click', '.remove-option', function(e) {
                e.preventDefault();
                let questionNum = $(this).data('question');
                let optionNum = $(this).data('option');
                $(`.option_${questionNum}[data-optionid="${optionNum}"]`).remove();
            });

            $(document).on('click', '.remove-question', function(e) {
                e.preventDefault();
                let questionNum = $(this).data('question');
                $(`.survey-question[data-question="${questionNum}"]`).remove();
            });
        });
    });
</script>




<div class="modal fade" id="EditnoticeDetailModal" tabindex="-1" aria-labelledby="EditnoticeDetailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" id="EditnoticeDetailContent">
        @include('livewire.notice.edit-notice-detail')
    </div>
</div>


<script>

    $('.view-detail-btn').click(function() {
        
        var noticeId = $(this).data('notice-id');
        var submitbtn = "hide";

        var url = "{{ route('Detail.Notice') }}";
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                noticeId: noticeId,submitbtn:submitbtn,
            },
            success: function(response) {
                console.log(response);
                $('.noticeDetailContent').html(response);
                $('.noticeDetailModal').modal('show');
                $('.noticeDetailModal').modal({ backdrop: 'static', keyboard: false });
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", error);
            }
        });
    });
    
    $('.edit-detail-btn').click(function() {
        var noticeId = $(this).data('notice-id');
        var url = "{{ route('Edit.Detail.Notice') }}";
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                noticeId: noticeId,
            },
            success: function(response) {
                $('#EditnoticeDetailContent').html(response);
                $('#EditnoticeDetailModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", error);
            }
        });
    });
</script>

    