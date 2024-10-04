<?php

namespace App\Http\Livewire\Notice;

use App\Models\Auth\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Notice\Notice;
use App\Models\Notice\notice_images;
use App\Models\Notice\NoticeImages;
use App\Models\Notice\SurveyAnswers;
use App\Models\Notice\SurveyOptions;
use App\Models\Notice\SurveyQuestions;
use Illuminate\Validation\Rule;
use Carbon\Carbon;



class NoticeBoards extends Component
{
    public function render()
    {
        $notices = Notice::with(['images', 'createdBy.basic_info', 'questions.options'])->get();
        return view('livewire.notice.notice-boards', compact('notices'))->layout('layouts.authorized');
    }

    public function postNotice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'type' => 'required|string',
            'time_limit' => 'required',
            'start_datetime' => 'required',
            'end_datetime' => 'required',
            'description' => Rule::requiredIf(function () use ($request) {
                return $request->type === 'description';
            }),
            'video' => Rule::requiredIf(function () use ($request) {
                return $request->type === 'video';
            }),
            'image' => Rule::requiredIf(function () use ($request) {
                return $request->type === 'image';
            }),
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'questions.*.question' => 'required|string',
            'questions.*.options.*' => 'required|string',
        ], [
            'description.required' => 'The description field is required.',
            'video.required' => 'The video field is required.',
            'image.required' => 'At least one image is required.',
            'image.*.required' => 'Each image field is required.',
            'image.*.image' => 'Each uploaded file must be an image.',
            'image.*.mimes' => 'Each image must be of type: jpeg, png, jpg, gif.',
            'image.*.max' => 'Each image must be less than 2MB in size.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $content = null;
        if ($request->type === 'description') {
            $content = $request->description;
        } elseif ($request->type === 'video' && $request->hasFile('video')) {
            $video = $request->file('video');
            $videoName = uniqid() . '_' . $video->getClientOriginalName();
            $directory = 'Uploads/NoticeVideos/';
            $video->move(public_path($directory), $videoName);
            $content = $directory . $videoName;
        }

        $notice = new Notice();
        $notice->title = $request->title;
        $notice->type = $request->type;
        $notice->content = $content;
        $notice->time_limit = $request->time_limit;
        $notice->start_datetime = \Carbon\Carbon::parse($request->start_datetime)->format('Y-m-d H:i:s');
        $notice->end_datetime =  \Carbon\Carbon::parse($request->end_datetime)->format('Y-m-d H:i:s');



        $notice->created_by = Auth::guard('Authorized')->user()->id;
        $notice->save();

        if ($request->type === 'survey') {
            $questionCount = count($request->input('Question'));
            for ($i = 1; $i <= $questionCount; $i++) {
                $questionText = $request->input("Question.$i");
                $options = $request->input("Option_$i");

                $question = SurveyQuestions::create([
                    'notice_id' => $notice->id,
                    'question' => $questionText,
                ]);

                foreach ($options as $optionText) {
                    SurveyOptions::create([
                        'question_id' => $question->id,
                        'option' => $optionText,
                    ]);
                }
            }
        }

        if ($request->type === 'image' && $request->hasFile('image')) {
            foreach ($request->file('image') as $key => $image) {
                $imageName = uniqid() . '_' . $image->getClientOriginalName();
                $directory = 'Uploads/NoticeImages/';
                $image->move(public_path($directory), $imageName);
                $imagePath = $directory . $imageName;
                NoticeImages::create([
                    'image' => $imagePath,
                    'notice_id' => $notice->id,
                ]);
            }
        }

        session(['interval' => 'true']);

        return redirect()->route('Get.Notices')->with('success', 'Notice has been added successfully.');
    }


    public function checkSessionStatus(Request $request)
    {
        $sessionStatus = session('interval', 'false');
      

        return response()->json([
            'sessionStatus' => $sessionStatus,
        ]);
    }
    
    public function destroySessionStatus()
{
    session()->forget('interval');
    return response()->json(['message' => 'Session interval reset successfully.']);
}
    public function submitSurveyAnswers(Request $request)
    {
        $authUser = Auth::guard('Authorized')->user();
        foreach ($request['question_id'] as $key => $questionId) {
            SurveyAnswers::create([
                'question_id' => $questionId,
                'user_id' => $authUser->id,
                'option_id' => $request['answer'][$questionId],
            ]);
        }
        return back()->with('success', 'Answer has been submitted.');
    }

    public function deleteNotice(Request $request)
    {

        $Notice_ID = $request->Notice_ID;
        $Notice = Notice::where('id', $Notice_ID)->delete();

        if ($Notice) {
            return back()->with('Success!', 'Notice Has been Deleted!');
        }
        return back()->with('Error!', 'Something Went Wrong!');
    }

    public function NoticeDetail(Request $request)

    {
        $submitbtn = $request->submitbtn;
        $noticeDetail = Notice::with(['images', 'createdBy.basic_info'])->find($request->noticeId);
        return view('livewire.notice.notice-detail', compact('noticeDetail', 'submitbtn'))->render();
    }
    public function editNoticeDetail(Request $request)

    {
        $editNoticeDetail = Notice::with(['images', 'createdBy.basic_info'])->find($request->noticeId);
        return view('livewire.notice.edit-notice-detail', compact('editNoticeDetail'))->render();
    }

    public function postEditNotice(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $notice = Notice::findOrFail($request->Notice_ID);

        $existingNotice = Notice::whereDate('created_at', $request->date)
            ->where('id', '<>', $request->Notice_ID)
            ->exists();

        if ($existingNotice && $notice->created_at != $request->date) {
            return back()->with('Error!', 'The selected date already has a notice.');
        }

        $current_user = Auth::guard('Authorized')->user();
        $content = null;

        if ($request->type == 'video' && $request->hasFile('video')) {
            $video = $request->file('video');
            $videoName = uniqid() . '_' . $video->getClientOriginalName();
            $directory = 'Uploads/NoticeVideos/';

            $video->move(public_path($directory), $videoName);
            $content = $directory . $videoName;
        } elseif ($request->type === 'description') {
            $content = $request->description;
        } elseif ($request->type == 'video' && empty($request->video)) {
            $content = $notice->content;
        }



        $notice->title = $request->title;
        $notice->content = $content;
        $notice->created_at = $request->date;
        $notice->created_by = $current_user->id;
        $notice->save();

        if ($request->type == 'image' && $request->hasFile('image')) {
            foreach ($request->file('image') as $key => $image) {
                $imageName = uniqid() . '_' . $image->getClientOriginalName();
                $directory = 'Uploads/NoticeImages/';
                $image->move(public_path($directory), $imageName);
                $imagePath = $directory . $imageName;
                NoticeImages::create([
                    'image' => $imagePath,
                    'notice_id' => $notice->id,
                ]);
            }
        }

        return back()->with('Success!', 'Notice has been updated successfully.');
    }

    public function deleteNoticeImage(Request $request)
    {
        $noticeId = $request->Notice_ID;
        $noticeImage = NoticeImages::find($noticeId);


        if (file_exists(public_path($noticeImage->image))) {
            unlink(public_path($noticeImage->image));
        }

        $noticeImage->delete();
        return back()->with('success', 'Notice image deleted successfully.');
    }

    public function checkActiveNotices(Request $request)
    {
        $submitbtn = $request->submitbtn;
        $currentDatetime = Carbon::now();

        $noticeDetail = Notice::with(['images', 'createdBy.basic_info'])
            ->where('start_datetime', '<=', $currentDatetime)
            ->where('end_datetime', '>=', $currentDatetime)
            ->first();


        if ($noticeDetail) {
            $noticeDetailView = view('livewire.notice.notice-detail', compact('noticeDetail', 'submitbtn'))->render();
            return response()->json(['success' => true, 'noticeDetail' => $noticeDetailView, 'time_limit' => $noticeDetail->time_limit],);
        } else {
            return response()->json(['success' => false, 'message' => 'No active notices found']);
        }
    }
}
