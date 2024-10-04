<?php

namespace App\Http\Livewire\Notice;

use App\Models\Notice\Notice;
use App\Models\Notice\SurveyOptions;
use Illuminate\Http\Request;
use Livewire\Component;
use PhpOption\Option;

class ViewNoticeAnswers extends Component
{
    public $Notice_ID;

    public function mount($Notice_ID)
    {
        $this->Notice_ID = $Notice_ID;
    }

    public function render()
    {
        $noticeAnswers = Notice::with(['questions.options.answers'])->find($this->Notice_ID);
        return view('livewire.notice.view-notice-answers', compact('noticeAnswers'))->layout('layouts.authorized');
    }

    public function ViewAnswerUsers(Request $request)
    {

        $options = SurveyOptions::with('answers.user.basic_info')->find($request->optionId);
        return view('livewire.notice.view-notice-borads-answers', compact('options'))->render();
    }
}
