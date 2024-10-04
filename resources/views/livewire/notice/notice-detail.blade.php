@isset($noticeDetail)
<style>
    .quiz-container {
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
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">{{ $noticeDetail->title }}</h5>
        @if(isset($submitbtn) && $submitbtn === 'show')
        <div class="timmerdisplay">
            Please wait, you'll be able to close and submit this form in just <span id="timerDisplay" class="bg-primary"></span>
        </div>
        @endif
        <button class="btn-close" id="closeButton" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <form action="{{ route('submit.survey.answers') }}" method="POST">
            @csrf
            @if ($noticeDetail->type === 'description')
            <p>{{ $noticeDetail->content }}</p>
            @elseif ($noticeDetail->type === 'image')
            @if ($noticeDetail->images->count() > 1)
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($noticeDetail->images as $key => $image)
                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                        <img src="{{ asset($image->image) }}" class="d-block w-100" style="height: 40vh !important"
                            alt="Notice Image">
                    </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            @else
            @foreach ($noticeDetail->images as $image)
            <img src="{{ asset($image->image) }}" alt="Notice Image" style="width: 100%; height: 40vh;">
            @endforeach
            @endif
            @elseif ($noticeDetail->type === 'video')
            <video style="width: 100%; height: 40vh;" src="{{ asset($noticeDetail->content) }}" autoplay
                controls></video>
            @elseif ($noticeDetail->type === 'survey')
            <div class="quiz-container">

                <div class="quiz-body">
                    @foreach ($noticeDetail->questions as $question)
                    <div class="mb-4">
                        <h2>{{ $question['question'] }}</h2>
                        <input type="hidden" name="question_id[]" value="{{ $question['id'] }}">
                       <ul class="list-unstyled">
    @foreach ($question['options'] as $option)
    <li>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="answer[{{ $question['id'] }}]"
                id="option_{{ $option['id'] }}" value="{{ $option['id'] }}">
            <label class="form-check-label" for="option_{{ $option['id'] }}">
                {{ $option['option'] }}
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
            @if(isset($submitbtn) && $submitbtn === 'show' && $noticeDetail->type === 'survey')
            <input class="btn btn-primary submit_btn" name="submit_notice_answers" type="submit" value="Submit">
            @endif

        </form>

    </div>
</div>
@endisset
