<!--Page header-->
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Notice Board Answer</h4>
    </div>
    <div class="page-rightheader ms-md-auto">
        <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">

        </div>
    </div>
</div>
<style>
    <style>.quiz-container {
        max-width: 100%;
        width: 100%;
    }

    .quiz-body h2 {
        padding: 0rem 0;
        font-size: 24px;
        font-weight: 500;
        text-align: center;
        margin: 0;
    }

    .quiz-body ul {
        list-style: none;
        padding: 0;
    }

    .quiz-body ul li {
        margin: 1rem 0;
        font-size: 1rem;
        border: 1px solid #aab7b8;
        padding: 0.7rem;
        border-radius: 5px;
        cursor: pointer;
    }

    .quiz-body ul li label {
        cursor: pointer;
        padding: 0 0.4rem;
    }
</style>
</style>
<!--End Page header-->
<!-- Row -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header  border-0">
                <h4 class="card-title">Notice Summary</h4>
            </div>
            <div class="card-body">

                @if($noticeAnswers->type == "survey")

                <div class="quiz-container">

                    <div class="quiz-body">
                        @foreach ($noticeAnswers->questions as $question)
                        <div class="mb-4">
                            <h2>{{ $question['question'] }}</h2>
                            <input type="hidden" name="question_id[]" value="{{ $question['id'] }}">
                            <ul class="list-unstyled">
                                @foreach ($question['options'] as $option)
                                <li>
                                    <div class="form-check" for="option_{{ $option['id'] }}">
                                        <label class="form-check-label d-flex align-items-center justify-content-between">
                                            for="option_{{ $option['id'] }}">
                                            <span>{{ $option['option'] }}</span>
                                            <a href="#" class="action-btns1 answer-user-btn" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="View" data-notice-id="{{ $option->id }}">
                                                <i class="feather feather-users sidemenu_icon"></i>{{
                                                count($option->answers) }}
                                            </a>
                                        </label>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="answerUsers" tabindex="-1" aria-labelledby="answerUsersLabel" aria-hidden="true"
    data-backdrop="static">
    <div class="modal-dialog modal-lg" id="answerViewContent">
        @include('livewire.notice.view-notice-borads-answers')
    </div>
</div>

<script>
    $('.answer-user-btn').click(function() {
        var optionId = $(this).data('notice-id');
    var url = "{{ route('view.answer.user') }}";
    $.ajax({    
        url: url,
        type: 'GET',
        data: {
            optionId: optionId,
        },
        success: function(response) {   
            $('#answerViewContent').html(response);
            $('#answerUsers').modal('show');
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failFed:", error);
        }
    });
});

</script>