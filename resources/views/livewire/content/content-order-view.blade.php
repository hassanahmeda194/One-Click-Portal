<style>
    .msg_card_body {
        background: rgba(255, 255, 255, 0.02) url('') !important;
        overflow-y: auto;
    }

    .chatbox .card,
    #chatmodel {
        min-height: 100vh !important;
    }

    .card-body.pt-2.ps-3.pr-3 tr {
        text-align: right !important;
    }
</style>
{{-- Admin View --}}
@php
    $total_words = 0;
    $assign = 0;
@endphp
@if ((int) $auth_user->Role_ID === 1)
    <!--Page header-->
    <div class="page-header d-xl-flex d-block">
        <div class="page-rightheader ms-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                <div class="btn-list">
                    <div class="dropdown">
                        <button class="btn btn-info dropdown-toggle px-5" data-bs-toggle="dropdown">
                            <i class="fe fe-activity me-2"></i>Actions
                        </button>
                        <div class="dropdown-menu">
                            @if ($Content_Order->content_info->Order_Status !== 'Completed')
                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal"
                                    data-bs-target="#AssignModal">Assign Order</a>
                            @endif
                            @if ($Content_Order->content_info->Order_Status !== 'Revision')
                                <a class="dropdown-item Order-Revision" href="JavaScript:void(0);"
                                    data-bs-toggle="modal" data-bs-target="#TaskRevisionModal">Add Revision
                                    <input type="hidden" id="Order_ID" value="{{ $Content_Order->Order_ID }}"></a>
                            @endif
                            <a class="dropdown-item"
                                href="{{ route('Content.Edit.Order', ['Order_ID' => $Content_Order->Order_ID]) }}">Edit
                                Order</a>
                            <a class="dropdown-item"
                                href="{{ route('Cancel.Content.Order', ['Order_ID' => $Content_Order->id]) }}">Cancel
                                Order</a>
                            <a class="dropdown-item"
                                href="{{ route('Delete.Content.Order', ['Order_ID' => $Content_Order->id]) }}">Delete
                                Order</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Page header-->
    <!-- Row -->
    <div class="row">
        <div class="col-xl-9 col-md-12 col-lg-12">
            <div class="tab-menu-heading hremp-tabs p-0 ">
                <div class="tabs-menu1">
                    <!-- Tabs -->
                    <ul class="nav panel-tabs">
                        <li class="ms-4"><a href="#tab5" class="active" data-bs-toggle="tab">Order Description</a>
                        </li>
                        <li><a href="#tab7" data-bs-toggle="tab">Order Attachments</a></li>
                        <li><a href="#tab10" data-bs-toggle="tab">Final Submission</a></li>
                        @if (
                            !empty($Content_Order->submission_info->F_DeadLine) ||
                                !empty($Content_Order->submission_info->S_DeadLine) ||
                                !empty($Content_Order->submission_info->T_DeadLine) ||
                                !empty($Content_Order->submission_info->Four_DeadLine) ||
                                !empty($Content_Order->submission_info->Fifth_DeadLine) ||
                                !empty($Content_Order->submission_info->Sixth_DeadLine) ||
                                !empty($Content_Order->submission_info->Seven_DeadLine) ||
                                !empty($Content_Order->submission_info->Eight_DeadLine) ||
                                !empty($Content_Order->submission_info->nine_DeadLine) ||
                                !empty($Content_Order->submission_info->ten_DeadLine) ||
                                !empty($Content_Order->submission_info->eleven_DeadLine) ||
                                !empty($Content_Order->submission_info->twelve_DeadLine) ||
                                !empty($Content_Order->submission_info->thirteen_DeadLine) ||
                                !empty($Content_Order->submission_info->fourteen_DeadLine) ||
                                !empty($Content_Order->submission_info->fifteen_DeadLine))
                            <li><a href="#tab12" data-bs-toggle="tab">Draft Submission</a></li>
                        @endif

                        @if (!empty($Content_Order->revision))
                            <li><a href="#tab11" data-bs-toggle="tab">Order Revisions</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab5">
                        <div class="card-body">
                            {!! $Content_Order->order_desc->Description !!}
                        </div>
                    </div>
                    <div class="tab-pane" id="tab7">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                    id="files-tables">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0 text-center w-5">No</th>
                                            <th class="border-bottom-0">File Name</th>
                                            <th class="border-bottom-0">Download File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($Content_Order->attachments as $attachment)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{ asset($attachment->order_attachment_path) }}"
                                                        target="_blank" download
                                                        class="font-weight-semibold fs-14 mt-5">{{ $attachment->File_Name }}
                                                        <span class="text-muted ms-2">(23 KB)</span></a>
                                                    <div class="clearfix"></div>
                                                    <small class="text-muted">{{ $attachment->created_at }}</small>
                                                </td>

                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ asset($attachment->order_attachment_path) }}"
                                                            class="action-btns1" data-bs-toggle="tooltip" download
                                                            data-bs-placement="top" title="Download" target="_blank"><i
                                                                class="feather feather-download   text-success"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">Files are Not Attached</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab8">
                        <div class="card-body">
                            <div class="table-responsive" style="min-height: 30vh;">

                                <table class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                    id="responsive-datatable">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0 text-center">Task</th>
                                            <th class="border-bottom-0">Writer</th>
                                            <th class="border-bottom-0">Assign Date</th>
                                            <th class="border-bottom-0">Assign Words</th>
                                            <th class="border-bottom-0">Remaining Words</th>
                                            <th class="border-bottom-0">Deadline</th>
                                            <th class="border-bottom-0">Status</th>
                                            <th class="border-bottom-0">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($Content_Order->tasks as $Task)
                                            <tr>
                                                <td class="font-weight-bold">Task-{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ $Task->assign->basic_info->full_name }}
                                                </td>
                                                <td>
                                                    {{ $Task->created_at }}
                                                </td>
                                                <td>
                                                    {{ $Task->Assign_Words }}
                                                </td>
                                                <td>
                                                    {{ $Task->Due_Words }}
                                                </td>
                                                <td>
                                                    {{ $Task->DeadLine }} &nbsp; {{ $Task->DeadLine_Time }}
                                                </td>
                                                <td>
                                                    {{ $Task->Task_Status }}
                                                </td>
                                                <td>
                                                    <div class="btn-list">
                                                        <div class="dropdown">
                                                            <button class="btn btn-info dropdown-toggle px-5"
                                                                data-bs-toggle="dropdown">
                                                                <i class="fe fe-activity me-2"></i>Actions
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="javascript:void(0)">View
                                                                    Detail</a>
                                                                <a class="dropdown-item Task_ID"
                                                                    href="javascript:void(0)" data-bs-toggle="modal"
                                                                    data-bs-target="#ChangedWriter">
                                                                    <input type="hidden" id="Task_ID"
                                                                        value="{{ $Task->id }}">Change
                                                                    Writer</a>
                                                                <a class="dropdown-item Edit-Task Task_ID"
                                                                    href="javascript:void(0)" data-bs-toggle="modal"
                                                                    data-bs-target="#EditTaskModal">
                                                                    <input type="hidden" id="Task_ID"
                                                                        value="{{ $Task->id }}">
                                                                    Edit Task</a>
                                                                <a class="dropdown-item Delete_Task"
                                                                    href="{{ route('Delete.Task', ['Task_ID' => $Task->id]) }}">
                                                                    Delete Task
                                                                </a>
                                                                <a class="dropdown-item Task_ID"
                                                                    href="javascript:void(0)" data-bs-toggle="modal"
                                                                    data-bs-target="#TaskRevisionModal">
                                                                    <input type="hidden" id="Task_ID"
                                                                        value="{{ $Task->id }}">
                                                                    Add Revision</a>
                                                                @if (count($Task->revision) > 0)
                                                                    <a class="dropdown-item View-Revision"
                                                                        href="javascript:void(0)"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#ViewRevisionModal">View
                                                                        Revision
                                                                        <input type="hidden" id="Task_ID"
                                                                            value="{{ $Task->id }}"></a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php
                                                $assign += (float) Str::replace(['$ ', ','], '', $Task->Assign_Words);
                                                $wordcount = (float) Str::replace(
                                                    ['$', ','],
                                                    '',
                                                    $Content_Order->content_info->Word_Count,
                                                );
                                                $total_words = $wordcount - $assign;
                                            @endphp
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab9">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                    id="files-tables">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0 text-center w-5">No</th>
                                            <th class="border-bottom-0">File Name</th>
                                            <th class="border-bottom-0">Download File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($Content_Order->tasks as $task)
                                            @forelse($task->submit_info as $submission)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>
                                                        <a href="{{ asset($submission->task_file_path) }}"
                                                            target="_blank" download
                                                            class="font-weight-semibold fs-14 mt-5">{{ $submission->File_Name }}
                                                            <span class="text-muted ms-2">(23 KB)</span></a>
                                                        <div class="clearfix"></div>
                                                        <small class="text-muted">{{ $submission->created_at }} -
                                                            Submitted
                                                            By
                                                            {{ $submission->submitted->basic_info->full_name }}</small>
                                                    </td>

                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <a href="{{ asset($submission->task_file_path) }}"
                                                                class="action-btns1" data-bs-toggle="tooltip" download
                                                                data-bs-placement="top" title="Download"
                                                                target="_blank"><i
                                                                    class="feather feather-download   text-success"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse
                                        @empty
                                            <tr>
                                                <td colspan="3">Files are Not Attached</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab10">
                        <div class="card-body">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-danger mb-4" data-bs-toggle="modal"
                                    data-bs-target="#FinalSubmissionModal"> Upload Files
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                    id="files-tables">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0 text-center w-5">No</th>
                                            <th class="border-bottom-0">File Name</th>
                                            <th class="border-bottom-0">Download File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($Content_Order->final_submission as $submission)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{ asset($submission->final_submission_path) }}"
                                                        target="_blank" download
                                                        class="font-weight-semibold fs-14 mt-5">{{ $submission->File_Name }}
                                                        <span class="text-muted ms-2">(23 KB)</span></a>
                                                    <div class="clearfix"></div>
                                                    <span>{{ $submission->authorized_user->basic_info->F_Name . ' ' . $submission->authorized_user->basic_info->L_Name }}</span><br>
                                                    <small class="text-muted">{{ $submission->created_at }}</small>
                                                </td>

                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ asset($submission->final_submission_path) }}"
                                                            class="action-btns1" data-bs-toggle="tooltip" download
                                                            data-bs-placement="top" title="Download"
                                                            target="_blank"><i
                                                                class="feather feather-download   text-success"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">Files are Not Attached</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if (!empty($Content_Order->revision))
                        <div class="tab-pane" id="tab11">

                            <div class="card-body">
                                <div class="d-flex justify-content-end">

                                </div>
                                <div class="table-responsive">
                                    <table
                                        class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                        id="files-tables">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0 text-center w-5">No</th>
                                                <th class="border-bottom-0">Revised By</th>
                                                <th class="border-bottom-0">Date</th>
                                                <th class="border-bottom-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Content_Order->revision as $revision)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>

                                                        @if (in_array($auth_user->Role_ID, [1, 9, 10, 11]))
                                                            {{ $revision->revision_by->basic_info->F_Name . ' ' . $revision->revision_by->basic_info->L_Name }}
                                                        @else
                                                            {{ 'Sales' }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $revision->created_at }}</td>
                                                    <td>
                                                        <div class="btn-list">
                                                            <div class="dropdown">
                                                                <button class="btn btn-info dropdown-toggle px-5"
                                                                    data-bs-toggle="dropdown">
                                                                    <i class="fe fe-activity me-2"></i>Actions
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item Order-Revision-view"
                                                                        id="Revision_ID"
                                                                        data-id="{{ $revision->id }}"
                                                                        href="JavaScript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#ViewRevision">View
                                                                        Revision</a>
                                                                    <a class="dropdown-item edit-Revision"
                                                                        data-id="{{ $revision->id }}"
                                                                        href="JavaScript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#EditRevision">Edit
                                                                        Revision</a>
                                                                    <a class="dropdown-item Order-Revision Upload_Revision_ID"
                                                                        data-id="{{ $revision->id }}"
                                                                        href="JavaScript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#SubmitRevision">Upload
                                                                        Revision</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    @endif
                    @if (
                        !empty($Content_Order->submission_info->F_DeadLine) ||
                            !empty($Content_Order->submission_info->S_DeadLine) ||
                            !empty($Content_Order->submission_info->T_DeadLine) ||
                            !empty($Content_Order->submission_info->Four_DeadLine) ||
                            !empty($Content_Order->submission_info->Fifth_DeadLine) ||
                            !empty($Content_Order->submission_info->Sixth_DeadLine) ||
                            !empty($Content_Order->submission_info->Seven_DeadLine) ||
                            !empty($Content_Order->submission_info->Eight_DeadLine) ||
                            !empty($Content_Order->submission_info->nine_DeadLine) ||
                            !empty($Content_Order->submission_info->ten_DeadLine) ||
                            !empty($Content_Order->submission_info->eleven_DeadLine) ||
                            !empty($Content_Order->submission_info->twelve_DeadLine) ||
                            !empty($Content_Order->submission_info->thirteen_DeadLine) ||
                            !empty($Content_Order->submission_info->fourteen_DeadLine) ||
                            !empty($Content_Order->submission_info->fifteen_DeadLine))


                        <div class="tab-pane" id="tab12">
                            <div class="card-body">
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-danger mb-4" data-bs-toggle="modal"
                                        data-bs-target="#uploaddraft"> Upload Draft
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table
                                        class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                        id="files-tables">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0 text-center w-5">No</th>
                                                <th class="border-bottom-0">File Name</th>
                                                <th class="border-bottom-0">Download File</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $a = 1;
                                            @endphp
                                            @foreach ($draft_submission as $submission)
                                                @forelse ($submission->attachments as $attachment)
                                                    <tr>
                                                        <td class="text-center">{{ $a }}</td>
                                                        <td>
                                                            <a href="{{ asset($attachment->File_Path) }}"
                                                                target="_blank" download
                                                                class="font-weight-semibold fs-14 mt-5">
                                                                {{ $attachment->File_Name }}
                                                            </a>
                                                            @if ($submission->draft_number == 1)
                                                                <div class="">First Draft</div>
                                                            @elseif($submission->draft_number == 2)
                                                                <div class="">Second Draft</div>
                                                            @elseif($submission->draft_number == 3)
                                                                <div class="">Third Draft</div>
                                                            @else
                                                                <div class="">Unknown Draft</div>
                                                            @endif
                                                            <div>
                                                                {{ $submission->submittedByUser->basic_info->F_Name . ' ' . $submission->submittedByUser->basic_info->L_Name }}
                                                            </div>
                                                            <div>{{ $submission->created_at }}</div>

                                                        </td>
                                                        <td>{{ $submission->submittedByUser->basic_info->F_Name }}</td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <a href="{{ asset($attachment->File_Path) }}"
                                                                    class="action-btns1" data-bs-toggle="tooltip"
                                                                    download="" data-bs-placement="top"
                                                                    title="" target="_blank"
                                                                    data-bs-original-title="Download"
                                                                    aria-label="Download">
                                                                    <i
                                                                        class="feather feather-download text-success"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $a++;
                                                    @endphp
                                                @empty
                                                    <tr>
                                                        <td colspan="3">No Files Attached</td>
                                                    </tr>
                                                @endforelse
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="chatbox mt-lg-5" id="chatmodel">
                <div class="chat border-0">
                    <div class="card overflow-hidden mb-0 border-0">
                        <!-- action-header -->
                        <div class="card-header">
                            <div class="float-start hidden-xs d-flex ms-2">
                                <div class="img_cont me-3">
                                    <img src="{{ !empty($auth_user->basic_info->profile_photo_path) ? asset($auth_user->basic_info->profile_photo_path) : asset('assets/images/users/16.jpg') }}"
                                        class="rounded-circle user_img avatar avatar-md" alt="img">
                                </div>
                                <div class="align-items-center mt-2 text-black">
                                    <h5 class="mb-0">{{ $auth_user->basic_info->full_name }}</h5>
                                    <span class="w-2 h-2 brround bg-success d-inline-block"></span><span
                                        class="ms-2 fs-12">Online</span>
                                </div>
                            </div>
                        </div>
                        <!-- action-header end -->
                        <!-- msg_card_body -->
                        <div class="card-body msg_card_body" id="Order-Messages">

                        </div>
                        <!-- msg_card_body end -->
                        <!-- card-footer -->
                        <div class="card-footer">
                            <form data-action="{{ route('Post.Message') }}" method="POST"
                                enctype="multipart/form-data" id="Chat-Form">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $Content_Order->id }}">
                                <input type="hidden" name="user_id"
                                    value="{{ Auth::guard('Authorized')->user()->id }}">
                                <div class="msb-reply-button d-flex mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-white" placeholder="Typing...."
                                            name="Chat_Message" required>
                                        <div class="input-group-append ">
                                            <button type="submit" class="btn btn-primary ">
                                                <span class="feather feather-send"></span> Send
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="msb-reply-button d-flex">
                                    <div class="input-group">
                                        <input type="file" class="form-control bg-white"
                                            placeholder="Any Attachments" name="files[]" multiple>
                                    </div>
                                </div>
                            </form>
                        </div><!-- card-footer end -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="card-title">Order Details</div>
                </div>
                <div class="card-body pt-2 ps-3 pr-3">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="w-50">Order ID </span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span class="font-weight-semibold">{{ $Content_Order->Order_ID }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Industry</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Industry_Name }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Words</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Word_Count }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Writing Style</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Writing_Style }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Preferred Voice</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Preferred_Voice }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Target Audience</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Target_Audience }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Target Gender</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Target_Gender }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Free Image</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Free_Image }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Generic Type</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Generic_Type }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Keywords</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Keywords }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Meta Description</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Meta_Description }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Website</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Order_Website }}</span>
                                    </td>
                                </tr>

                                 <tr>
                                    <td>
                                        <span class="w-50">Preferred Language</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Preferred_Language ?? '' }}</span>
                                    </td>
                                </tr>
                                @if (!empty($Content_Order->reference_info->Reference_Code))
                                    <tr>
                                        <td>
                                            <span class="w-50">Reference</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold">{{ $Content_Order->reference_info->Reference_Code }}</span>
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($Content_Order->submission_info->F_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">First Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->F_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->S_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Second Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->S_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->T_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Third Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->T_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Four_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Fourth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Four_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Fifth_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Fifth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Fifth_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Sixth_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Sixth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Sixth_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Seven_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Seventh Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Seven_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Eight_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Eighth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Eight_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->nine_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Ninth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->nine_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->ten_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Tenth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->ten_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->eleven_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Eleventh Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->eleven_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->twelve_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Twelfth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->twelve_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->thirteen_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Thirteenth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->thirteen_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->fourteen_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Fourteenth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->fourteen_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->fifteen_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Fifteenth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->fifteen_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                <tr>
                                    <td>
                                        <span class="w-50">Final Deadline</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->DeadLine }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Final Dealine Time</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->DeadLine_Time }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Status</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold text-info">{{ $Content_Order->content_info->Order_Status }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Created Date</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ date('F d, Y', strtotime($Content_Order->created_at)) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Created Time</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ date('H:i:s A', strtotime($Content_Order->created_at)) }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-header border-0">
                    <div class="card-title">Client Information</div>
                </div>
                <div class="card-body pt-2 ps-3 pr-3">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="w-50">Name</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->client_info->Client_Name }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Country </span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->client_info->Client_Country }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Phone</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->client_info->Client_Phone }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Email</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->client_info->Client_Email }}</span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-header  border-0">
                    <div class="card-title">Content Department</div>
                </div>
                <div class="card-body pt-2 ps-3 pr-3">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                @if (!empty($Content_Order->assign))
                                    @foreach ($Content_Order->assign as $User)
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0)" data-bs-target="#RemoveWriter"
                                                    class="action-btns1 RemoveContentWriter" data-bs-toggle="modal"
                                                    data-bs-placement="top" title="Remove Writer"><i
                                                        class="feather feather-trash text-danger"></i>
                                                    <input type="hidden" class="order_id"
                                                        value="{{ $Content_Order->id }}">
                                                    <input type="hidden" class="user_id"
                                                        value="{{ $User->id }}">
                                                </a>
                                                <a href="javascript:void(0)" data-bs-target="#ChangedWriter"
                                                    class="action-btns1 ChangeContentWriter" data-bs-toggle="modal"
                                                    data-bs-placement="top" title="Change Writer"><i
                                                        class="feather feather-repeat text-warning"></i>
                                                    <input type="hidden" class="order_id"
                                                        value="{{ $Content_Order->id }}">
                                                    <input type="hidden" class="user_id"
                                                        value="{{ $User->id }}">
                                                </a>
                                                <span class="w-50">Content Writer</span>
                                            </td>
                                            <td>:</td>
                                            <td>
                                                <span
                                                    class="font-weight-semibold">{{ $User->basic_info->full_name }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-header  border-0">
                    <div class="card-title">Sales Department</div>
                </div>
                <div class="card-body pt-2 ps-3 pr-3">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="w-50">Create By</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ isset($Content_Order->authorized_user->basic_info->full_name) && $Content_Order->authorized_user->basic_info->full_name ? $Content_Order->authorized_user->basic_info->full_name : '' }}</span>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-header border-0">
                    <div class="card-title">Payment Detail</div>
                </div>
                <div class="card-body pt-2 ps-3 pr-3">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="w-50">Order Price</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->payment_info->Order_Price }}
                                            &nbsp; {{ $Content_Order->payment_info->Order_Currency }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Payment Status</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->payment_info->Payment_Status }}
                                        </span>
                                    </td>
                                </tr>
                                @if ($Content_Order->payment_info->Payment_Status === 'Partial')
                                    <tr>
                                        <td>
                                            <span class="w-50">Receive Amount</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold">{{ $Content_Order->payment_info->Rec_Amount }}
                                                &nbsp; {{ $Content_Order->payment_info->Order_Currency }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="w-50">Receive Amount</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold">{{ $Content_Order->payment_info->Due_Amount }}
                                                &nbsp; {{ $Content_Order->payment_info->Order_Currency }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <span class="font-weight-semibold">Description</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            {{ $Content_Order->payment_info->Partial_Info }}
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Final Submission Modal -->
    <div class="modal fade" id="FinalSubmissionModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('Content.Order.Final.Submit') }}" method="POST"
                    class="needs-validation was-validated" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Final Submission For Current Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="order_id" value="{{ $Content_Order->id }}">
                            <input type="hidden" name="Order_ID" value="{{ $Order_ID }}">
                            <input type="hidden" name="task_id" class="task-id">
                            <input type="hidden" name="submit_by"
                                value="{{ Auth::guard('Authorized')->user()->id }}">
                            <input type="hidden" name="user_id"
                                value="{{ Auth::guard('Authorized')->user()->id }}">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="form-label" class="form-label"></label>
                                    <input class="form-control" type="file" name="files[]" multiple>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Upload Final Submission</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Assign Modal -->
    <div class="modal fade" id="AssignModal">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <form action="{{ route('Assign.Order') }}" method="POST" class="needs-validation was-validated">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Assign Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="Order_ID" value="{{ $Order_ID }}">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="Assign_ID">Content Writers</label>
                                    <select name="Assign_ID[]" id="Assign_ID" class="form-control select2"
                                        data-placeholder="Select Coordinator" multiple required>
                                        <option value="">Select Writers</option>
                                        @forelse($Content_Writer_List as $Writer)
                                            <option value="{{ $Writer->id }}">
                                                {{ $Writer->basic_info->full_name }}
                                                &nbsp; {{ $Writer->skills->Skill_Name }}</option>
                                        @empty
                                            <option value="">No Writers available</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Assign Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Change Writer Modal -->
    <div class="modal fade" id="ChangedWriter">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('Change.Content.Writer') }}" method="POST"
                    class="needs-validation was-validated">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Change Writer on Current Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="Order_ID" value="{{ $Content_Order->Order_ID }}">
                            <input type="hidden" name="order_id" class="get_order_id">
                            <input type="hidden" name="user_id" class="get_user_id">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="W_Assign_ID">Select Writers</label>
                                    <select name="W_Assign_ID" class="form-control custom-select select2"
                                        id="W_Assign_ID" data-placeholder="Select Writer" aria-required="true"
                                        required>
                                        <option value="">Select Writers</option>
                                        @forelse($Content_Writer_List as $Writer)
                                            <option value="{{ $Writer->id }}">
                                                {{ $Writer->basic_info->full_name }}
                                            </option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Changed Writer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Remove Writer Modal -->
    <div class="modal fade" id="RemoveWriter">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('Remove.Content.Writer') }}" method="POST"
                    class="needs-validation was-validated">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Are You Sure?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="Order_ID" value="{{ $Content_Order->Order_ID }}">
                            <input type="hidden" name="order_id" class="get_order_id">
                            <input type="hidden" name="user_id" class="get_user_id">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="W_Assign_ID">Select Writers</label>
                                    <select name="W_Assign_ID" class="form-control custom-select select2 W_Assign_ID"
                                        data-placeholder="Select Writer" aria-required="true" required>
                                        <option value="">Select Writers</option>
                                        @forelse($Content_Writer_List as $Writer)
                                            <option value="{{ $Writer->id }}">
                                                {{ $Writer->basic_info->full_name }}
                                            </option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Remove Writer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="TaskRevisionModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('Content.Order.Revision') }}" method="POST"
                    class="needs-validation was-validated" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Revision For Current Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="order_id" value="{{ $Content_Order->id }}">
                            <input type="hidden" name="Order_ID" value="{{ $Content_Order->Order_ID }}">
                            <input type="hidden" name="revised_by"
                                value="{{ Auth::guard('Authorized')->user()->id }}">
                            <input type="hidden" name="user_id"
                                value="{{ Auth::guard('Authorized')->user()->id }}">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="form-label" class="form-label text-danger">The text area for the
                                        revision description must be filled; otherwise, it will throw an error.</label>
                                    <textarea id="summernote" class="form-control mb-4 is-invalid state-invalid" name="Order_Revision"
                                        placeholder="Textarea (invalid state)" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">DeadLine</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="feather feather-calendar"></i>
                                        </div>
                                    </div>
                                    <input class="form-control Order-DeadLine" placeholder="MM/DD/YYYY"
                                        name="DeadLine" type="date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">DeadLine Time</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="feather feather-clock"></span>
                                        </div>
                                    </div><!-- input-group-prepend -->
                                    <input class="form-control Order-Time" id="tp3" placeholder="Set time"
                                        name="DeadLine_Time" type="time" required>
                                </div><!-- input-group -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Total Words</label>
                                    <input class="form-control mb-4 is-valid Order-Words" name="Order_Words"
                                        placeholder="Enter Order Words" id="Order_Words" min="0"
                                        type="number" value="" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="form-label" class="form-label"></label>
                                    <input class="form-control" type="file" name="files[]" multiple>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block add-btn-loader">Upload
                            Revision</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endif
{{-- Sales Manager & Coordinator View --}}
@if ((int) $auth_user->Role_ID === 9 || (int) $auth_user->Role_ID === 10)
    <!--Page header-->
    <div class="page-header d-xl-flex d-block">
        <div class="page-rightheader ms-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                <div class="btn-list">
                    <div class="dropdown">
                        <button class="btn btn-info dropdown-toggle px-5" data-bs-toggle="dropdown">
                            <i class="fe fe-activity me-2"></i>Actions
                        </button>
                        <div class="dropdown-menu">
                            @if ($Content_Order->content_info->Order_Status !== 'Revision')
                                <a class="dropdown-item Order-Revision" href="JavaScript:void(0);"
                                    data-bs-toggle="modal" data-bs-target="#TaskRevisionModal">Add Revision
                                    <input type="hidden" id="Order_ID"
                                        value="{{ $Content_Order->Order_ID }}"></a>
                            @endif
                            <a class="dropdown-item"
                                href="{{ route('Content.Edit.Order', ['Order_ID' => $Content_Order->Order_ID]) }}">Edit
                                Order</a>
                            <a class="dropdown-item"
                                href="{{ route('Cancel.Content.Order', ['Order_ID' => $Content_Order->id]) }}">Cancel
                                Order</a>
                            <a class="dropdown-item"
                                href="{{ route('Delete.Content.Order', ['Order_ID' => $Content_Order->id]) }}">Delete
                                Order</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Page header-->
    <!-- Row -->
    <div class="row">
        <div class="col-xl-9 col-md-12 col-lg-12">
            <div class="tab-menu-heading hremp-tabs p-0 ">
                <div class="tabs-menu1">
                    <!-- Tabs -->
                    <ul class="nav panel-tabs">
                        <li class="ms-4"><a href="#tab5" class="active" data-bs-toggle="tab">Order
                                Description</a></li>
                        <li><a href="#tab7" data-bs-toggle="tab">Order Attachments</a></li>

                        @if (
                            !empty($Content_Order->submission_info->F_DeadLine) ||
                                !empty($Content_Order->submission_info->S_DeadLine) ||
                                !empty($Content_Order->submission_info->T_DeadLine) ||
                                !empty($Content_Order->submission_info->Four_DeadLine) ||
                                !empty($Content_Order->submission_info->Fifth_DeadLine) ||
                                !empty($Content_Order->submission_info->Sixth_DeadLine) ||
                                !empty($Content_Order->submission_info->Seven_DeadLine) ||
                                !empty($Content_Order->submission_info->Eight_DeadLine) ||
                                !empty($Content_Order->submission_info->nine_DeadLine) ||
                                !empty($Content_Order->submission_info->ten_DeadLine) ||
                                !empty($Content_Order->submission_info->eleven_DeadLine) ||
                                !empty($Content_Order->submission_info->twelve_DeadLine) ||
                                !empty($Content_Order->submission_info->thirteen_DeadLine) ||
                                !empty($Content_Order->submission_info->fourteen_DeadLine) ||
                                !empty($Content_Order->submission_info->fifteen_DeadLine))
                            <li><a href="#tab12" data-bs-toggle="tab">Draft Submission</a></li>
                        @endif
                        <li><a href="#tab9" data-bs-toggle="tab">Order Submission</a></li>
                        @if (!empty($Content_Order->revision))
                            <li><a href="#tab10" data-bs-toggle="tab">Order Revisions</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab5">
                        <div class="card-body">
                            {!! $Content_Order->order_desc->Description !!}
                        </div>
                    </div>
                    <div class="tab-pane" id="tab7">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                    id="files-tables">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0 text-center w-5">No</th>
                                            <th class="border-bottom-0">File Name</th>
                                            <th class="border-bottom-0">Download File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($Content_Order->attachments as $attachment)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{ asset($attachment->order_attachment_path) }}"
                                                        target="_blank" download
                                                        class="font-weight-semibold fs-14 mt-5">{{ $attachment->File_Name }}
                                                        <span class="text-muted ms-2">(23 KB)</span></a>
                                                    <div class="clearfix"></div>
                                                    <small class="text-muted">{{ $attachment->created_at }}</small>
                                                </td>

                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ asset($attachment->order_attachment_path) }}"
                                                            class="action-btns1" data-bs-toggle="tooltip" download
                                                            data-bs-placement="top" title="Download"
                                                            target="_blank"><i
                                                                class="feather feather-download   text-success"></i></a>
                                                                
                                                        @if($auth_user->Role_ID === 9)
                                                         <a href="{{ route('delete.attachment' , ['id' => $attachment->id]) }}"
                                                            class="action-btns1"
                                                            ><i
                                                                class="feather feather-trash   text-danger"></i></a>
                                                                
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">Files are Not Attached</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab9">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                    id="files-tables">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0 text-center w-5">No</th>
                                            <th class="border-bottom-0">File Name</th>
                                            <th class="border-bottom-0">Download File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($Content_Order->final_submission as $submission)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{ asset($submission->final_submission_path) }}"
                                                        target="_blank" download
                                                        class="font-weight-semibold fs-14 mt-5">{{ $submission->File_Name }}
                                                        <span class="text-muted ms-2">(23 KB)</span></a>
                                                    <div class="clearfix"></div>
                                                    <small class="text-muted">{{ $submission->created_at }}</small>
                                                </td>

                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ asset($submission->final_submission_path) }}"
                                                            class="action-btns1" data-bs-toggle="tooltip" download
                                                            data-bs-placement="top" title="Download"
                                                            target="_blank"><i
                                                                class="feather feather-download   text-success"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">Files are Not Attached</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if (!empty($Content_Order->revision))
                        <div class="tab-pane" id="tab10">

                            <div class="card-body">
                                <div class="d-flex justify-content-end">

                                </div>
                                <div class="table-responsive">
                                    <table
                                        class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                        id="files-tables">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0 text-center w-5">No</th>
                                                <th class="border-bottom-0">Revised By</th>
                                                <th class="border-bottom-0">Date</th>
                                                <th class="border-bottom-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Content_Order->revision as $revision)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $revision->revision_by->basic_info->F_Name . ' ' . $revision->revision_by->basic_info->L_Name }}
                                                    </td>
                                                    <td>{{ $revision->created_at }}</td>
                                                    <td>
                                                        <div class="btn-list">
                                                            <div class="dropdown">
                                                                <button class="btn btn-info dropdown-toggle px-5"
                                                                    data-bs-toggle="dropdown">
                                                                    <i class="fe fe-activity me-2"></i>Actions
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item Order-Revision-view"
                                                                        id="Revision_ID"
                                                                        data-id="{{ $revision->id }}"
                                                                        href="JavaScript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#ViewRevision">View
                                                                        Revision</a>
                                                                    <a class="dropdown-item edit-Revision"
                                                                        data-id="{{ $revision->id }}"
                                                                        href="JavaScript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#EditRevision">Edit
                                                                        Revision</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    @endif

                    @if (
                        !empty($Content_Order->submission_info->F_DeadLine) ||
                            !empty($Content_Order->submission_info->S_DeadLine) ||
                            !empty($Content_Order->submission_info->T_DeadLine) ||
                            !empty($Content_Order->submission_info->Four_DeadLine) ||
                            !empty($Content_Order->submission_info->Fifth_DeadLine) ||
                            !empty($Content_Order->submission_info->Sixth_DeadLine) ||
                            !empty($Content_Order->submission_info->Seven_DeadLine) ||
                            !empty($Content_Order->submission_info->Eight_DeadLine) ||
                            !empty($Content_Order->submission_info->nine_DeadLine) ||
                            !empty($Content_Order->submission_info->ten_DeadLine) ||
                            !empty($Content_Order->submission_info->eleven_DeadLine) ||
                            !empty($Content_Order->submission_info->twelve_DeadLine) ||
                            !empty($Content_Order->submission_info->thirteen_DeadLine) ||
                            !empty($Content_Order->submission_info->fourteen_DeadLine) ||
                            !empty($Content_Order->submission_info->fifteen_DeadLine))


                        <div class="tab-pane" id="tab12">
                            <div class="card-body">
                                <div class="d-flex justify-content-end">

                                </div>
                                <div class="table-responsive">
                                    <table
                                        class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                        id="files-tables">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0 text-center w-5">No</th>
                                                <th class="border-bottom-0">File Name</th>
                                                <th class="border-bottom-0">Upload By</th>
                                                <th class="border-bottom-0">Download File</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $b = 1;
                                            @endphp
                                            @foreach ($draft_submission as $submission)
                                                @forelse ($submission->attachments as $attachment)
                                                    <tr>
                                                        <td class="text-center">{{ $b }}</td>
                                                        <td>
                                                            <a href="{{ asset($attachment->File_Path) }}"
                                                                target="_blank" download
                                                                class="font-weight-semibold fs-14 mt-5">
                                                                {{ $attachment->File_Name }}
                                                            </a>
                                                            @if ($submission->draft_number == 1)
                                                                <div class="">First Draft</div>
                                                            @elseif($submission->draft_number == 2)
                                                                <div class="">Second Draft</div>
                                                            @elseif($submission->draft_number == 3)
                                                                <div class="">Third Draft</div>
                                                            @else
                                                                <div class="">Unknown Draft</div>
                                                            @endif
                                                            <div>{{ $submission->created_at }}</div>
                                                        </td>
                                                        <td>production team
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <a href="{{ asset($attachment->File_Path) }}"
                                                                    class="action-btns1" data-bs-toggle="tooltip"
                                                                    download="" data-bs-placement="top"
                                                                    title="" target="_blank"
                                                                    data-bs-original-title="Download"
                                                                    aria-label="Download">
                                                                    <i
                                                                        class="feather feather-download text-success"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $b++;
                                                    @endphp
                                                @empty
                                                    <tr>
                                                        <td colspan="3">No Files Attached</td>
                                                    </tr>
                                                @endforelse
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="chatbox mt-lg-5" id="chatmodel">
                <div class="chat border-0">
                    <div class="card overflow-hidden mb-0 border-0">
                        <!-- action-header -->
                        <div class="card-header">
                            <div class="float-start hidden-xs d-flex ms-2">
                                <div class="img_cont me-3">
                                    <img src="{{ !empty($auth_user->basic_info->profile_photo_path) ? asset($auth_user->basic_info->profile_photo_path) : asset('assets/images/users/16.jpg') }}"
                                        class="rounded-circle user_img avatar avatar-md" alt="img">
                                </div>
                                <div class="align-items-center mt-2 text-black">
                                    <h5 class="mb-0">{{ $auth_user->basic_info->full_name }}</h5>
                                    <span class="w-2 h-2 brround bg-success d-inline-block"></span><span
                                        class="ms-2 fs-12">Online</span>
                                </div>
                            </div>
                        </div>
                        <!-- action-header end -->
                        <!-- msg_card_body -->
                        <div class="card-body msg_card_body" id="Order-Messages">

                        </div>
                        <!-- msg_card_body end -->
                        <!-- card-footer -->
                        <div class="card-footer">
                            <form data-action="{{ route('Post.Message') }}" method="POST"
                                enctype="multipart/form-data" id="Chat-Form">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $Content_Order->id }}">
                                <input type="hidden" name="user_id"
                                    value="{{ Auth::guard('Authorized')->user()->id }}">
                                <div class="msb-reply-button d-flex mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-white" placeholder="Typing...."
                                            name="Chat_Message" required>
                                        <div class="input-group-append ">
                                            <button type="submit" class="btn btn-primary ">
                                                <span class="feather feather-send"></span> Send
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="msb-reply-button d-flex">
                                    <div class="input-group">
                                        <input type="file" class="form-control bg-white"
                                            placeholder="Any Attachments" name="files[]" multiple>
                                    </div>
                                </div>
                            </form>
                        </div><!-- card-footer end -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header  border-0">
                    <div class="card-title">Order Details</div>
                </div>
                <div class="card-body pt-2 ps-3 pr-3">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="w-50">Order ID </span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span class="font-weight-semibold">{{ $Content_Order->Order_ID }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Industry</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Industry_Name }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Words</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Word_Count }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Writing Style</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Writing_Style }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Preferred Voice</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Preferred_Voice }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Target Audience</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Target_Audience }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Target Gender</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Target_Gender }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Free Image</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Free_Image }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Generic Type</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Generic_Type }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Keywords</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Keywords }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Meta Description</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Meta_Description }}</span>
                                    </td>
                                </tr>
                                  <tr>
                                    <td>
                                        <span class="w-50">Preferred Language</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Preferred_Language ?? '' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Website</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Order_Website }}</span>
                                    </td>
                                </tr>
                                @if (!empty($Content_Order->reference_info->Reference_Code))
                                    <tr>
                                        <td>
                                            <span class="w-50">Reference</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold">{{ $Content_Order->reference_info->Reference_Code }}</span>
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($Content_Order->submission_info->F_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">First Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->F_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->S_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Second Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->S_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->T_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Third Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->T_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Four_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Fourth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Four_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Fifth_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Fifth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Fifth_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Sixth_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Sixth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Sixth_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Seven_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Seventh Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Seven_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Eight_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Eighth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Eight_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->nine_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Ninth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->nine_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->ten_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Tenth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->ten_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->eleven_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Eleventh Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->eleven_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->twelve_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Twelfth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->twelve_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->thirteen_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Thirteenth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->thirteen_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->fourteen_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Fourteenth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->fourteen_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->fifteen_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Fifteenth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->fifteen_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                <tr>
                                    <td>
                                        <span class="w-50">Final Deadline</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->DeadLine }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Status</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold text-info">{{ $Content_Order->content_info->Order_Status }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Created Date</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ date('F d, Y', strtotime($Content_Order->created_at)) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Created Time</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ date('H:i:s A', strtotime($Content_Order->created_at)) }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-header border-0">
                    <div class="card-title">Client Information</div>
                </div>
                <div class="card-body pt-2 ps-3 pr-3">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="w-50">Name</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->client_info->Client_Name }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-header  border-0">
                    <div class="card-title">Sales Department</div>
                </div>
                <div class="card-body pt-2 ps-3 pr-3">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="w-50">Create By</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ isset($Content_Order->authorized_user->basic_info->full_name) && $Content_Order->authorized_user->basic_info->full_name ? $Content_Order->authorized_user->basic_info->full_name : '' }}</span></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-header border-0">
                    <div class="card-title">Payment Detail</div>
                </div>
                <div class="card-body pt-2 ps-3 pr-3">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="w-50">Order Price</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->payment_info->Order_Price }}
                                            &nbsp; {{ $Content_Order->payment_info->Order_Currency }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Payment Status</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->payment_info->Payment_Status }}
                                        </span>
                                    </td>
                                </tr>
                                @if ($Content_Order->payment_info->Payment_Status === 'Partial')
                                    <tr>
                                        <td>
                                            <span class="w-50">Receive Amount</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold">{{ $Content_Order->payment_info->Rec_Amount }}
                                                &nbsp; {{ $Content_Order->payment_info->Order_Currency }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="w-50">Receive Amount</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold">{{ $Content_Order->payment_info->Due_Amount }}
                                                &nbsp; {{ $Content_Order->payment_info->Order_Currency }}</span>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td colspan="3">
                                            <span class="font-weight-semibold">Description</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            {{ $Content_Order->payment_info->Partial_Info }}
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Order Revision Modal -->
    <div class="modal fade" id="TaskRevisionModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('Content.Order.Revision') }}" method="POST"
                    class="needs-validation was-validated" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Revision For Current Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="order_id" value="{{ $Content_Order->id }}">
                            <input type="hidden" name="Order_ID" value="{{ $Content_Order->Order_ID }}">
                            <input type="hidden" name="revised_by"
                                value="{{ Auth::guard('Authorized')->user()->id }}">
                            <input type="hidden" name="user_id"
                                value="{{ Auth::guard('Authorized')->user()->id }}">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="form-label" class="form-label text-danger">The text area for the
                                        revision description must be filled; otherwise, it will throw an error.</label>
                                    <textarea id="summernote" class="form-control mb-4 is-invalid state-invalid" name="Order_Revision"
                                        placeholder="Textarea (invalid state)" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">DeadLine</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="feather feather-calendar"></i>
                                        </div>
                                    </div>
                                    <input class="form-control Order-DeadLine" placeholder="MM/DD/YYYY"
                                        name="DeadLine" type="date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">DeadLine Time</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="feather feather-clock"></span>
                                        </div>
                                    </div><!-- input-group-prepend -->
                                    <input class="form-control Order-Time" id="tp3" placeholder="Set time"
                                        name="DeadLine_Time" type="time" required>
                                </div><!-- input-group -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Total Words</label>
                                    <input class="form-control mb-4 is-valid Order-Words" name="Order_Words"
                                        placeholder="Enter Order Words" id="Order_Words" min="0"
                                        type="number" value="0" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="form-label" class="form-label"></label>
                                    <input class="form-control" type="file" name="files[]" multiple>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block add-btn-loader">Upload
                            Revision</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
{{-- Sales Executive View --}}
@if ((int) $auth_user->Role_ID === 11)
    <!--Page header-->
    <div class="page-header d-xl-flex d-block">
        <div class="page-rightheader ms-md-auto">
        </div>
    </div>
    <!--End Page header-->
    <!-- Row -->
    <div class="row">
        <div class="col-xl-9 col-md-12 col-lg-12">
            <div class="tab-menu-heading hremp-tabs p-0 ">
                <div class="tabs-menu1">
                    <!-- Tabs -->
                    <ul class="nav panel-tabs">
                        <li class="ms-4"><a href="#tab5" class="active" data-bs-toggle="tab">Order
                                Description</a></li>
                        <li><a href="#tab7" data-bs-toggle="tab">Order Attachments</a></li>
                        <li><a href="#tab9" data-bs-toggle="tab">Order Submission</a></li>
                        @if (
                            !empty($Content_Order->submission_info->F_DeadLine) ||
                                !empty($Content_Order->submission_info->S_DeadLine) ||
                                !empty($Content_Order->submission_info->T_DeadLine) ||
                                !empty($Content_Order->submission_info->Four_DeadLine) ||
                                !empty($Content_Order->submission_info->Fifth_DeadLine) ||
                                !empty($Content_Order->submission_info->Sixth_DeadLine) ||
                                !empty($Content_Order->submission_info->Seven_DeadLine) ||
                                !empty($Content_Order->submission_info->Eight_DeadLine) ||
                                !empty($Content_Order->submission_info->nine_DeadLine) ||
                                !empty($Content_Order->submission_info->ten_DeadLine) ||
                                !empty($Content_Order->submission_info->eleven_DeadLine) ||
                                !empty($Content_Order->submission_info->twelve_DeadLine) ||
                                !empty($Content_Order->submission_info->thirteen_DeadLine) ||
                                !empty($Content_Order->submission_info->fourteen_DeadLine) ||
                                !empty($Content_Order->submission_info->fifteen_DeadLine))
                            <li><a href="#tab12" data-bs-toggle="tab">Draft Submission</a></li>
                        @endif

                        @if (!empty($Content_Order->revision))
                            <li><a href="#tab10" data-bs-toggle="tab">Order Revisions</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab5">
                        <div class="card-body">
                            {!! $Content_Order->order_desc->Description !!}
                        </div>
                    </div>
                    <div class="tab-pane" id="tab7">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table
                                    class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                    id="files-tables">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0 text-center w-5">No</th>
                                            <th class="border-bottom-0">File Name</th>
                                            <th class="border-bottom-0">Download File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($Content_Order->attachments as $attachment)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{ asset($attachment->order_attachment_path) }}"
                                                        target="_blank" download
                                                        class="font-weight-semibold fs-14 mt-5">{{ $attachment->File_Name }}
                                                        <span class="text-muted ms-2">(23 KB)</span></a>
                                                    <div class="clearfix"></div>
                                                    <small class="text-muted">{{ $attachment->created_at }}</small>
                                                </td>

                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ asset($attachment->order_attachment_path) }}"
                                                            class="action-btns1" data-bs-toggle="tooltip" download
                                                            data-bs-placement="top" title="Download"
                                                            target="_blank"><i
                                                                class="feather feather-download   text-success"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">Files are Not Attached</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab9">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table
                                    class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                    id="files-tables">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0 text-center w-5">No</th>
                                            <th class="border-bottom-0">File Name</th>
                                            <th class="border-bottom-0">Download File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($Content_Order->final_submission as $submission)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{ asset($submission->final_submission_path) }}"
                                                        target="_blank" download
                                                        class="font-weight-semibold fs-14 mt-5">{{ $submission->File_Name }}
                                                        <span class="text-muted ms-2">(23 KB)</span></a>
                                                    <div class="clearfix"></div>
                                                    <small class="text-muted">{{ $submission->created_at }}</small>
                                                </td>

                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ asset($submission->final_submission_path) }}"
                                                            class="action-btns1" data-bs-toggle="tooltip" download
                                                            data-bs-placement="top" title="Download"
                                                            target="_blank"><i
                                                                class="feather feather-download   text-success"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">Files are Not Attached</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if (!empty($Content_Order->revision))
                        <div class="tab-pane" id="tab10">

                            <div class="card-body">
                                <div class="d-flex justify-content-end">

                                </div>
                                <div class="table-responsive">
                                    <table
                                        class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                        id="files-tables">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0 text-center w-5">No</th>
                                                <th class="border-bottom-0">Revised By</th>
                                                <th class="border-bottom-0">Date</th>
                                                <th class="border-bottom-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Content_Order->revision as $revision)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $revision->revision_by->basic_info->F_Name . ' ' . $revision->revision_by->basic_info->L_Name }}
                                                    </td>
                                                    <td>{{ $revision->created_at }}</td>
                                                    <td>
                                                        <div class="btn-list">
                                                            <div class="dropdown">
                                                                <button class="btn btn-info dropdown-toggle px-5"
                                                                    data-bs-toggle="dropdown">
                                                                    <i class="fe fe-activity me-2"></i>Actions
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item Order-Revision-view"
                                                                        id="Revision_ID"
                                                                        data-id="{{ $revision->id }}"
                                                                        href="JavaScript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#ViewRevision">View
                                                                        Revision</a>
                                                                    <a class="dropdown-item edit-Revision"
                                                                        data-id="{{ $revision->id }}"
                                                                        href="JavaScript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#EditRevision">Edit
                                                                        Revision</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    @endif
                    @if (
                        !empty($Content_Order->submission_info->F_DeadLine) ||
                            !empty($Content_Order->submission_info->S_DeadLine) ||
                            !empty($Content_Order->submission_info->T_DeadLine) ||
                            !empty($Content_Order->submission_info->Four_DeadLine) ||
                            !empty($Content_Order->submission_info->Fifth_DeadLine) ||
                            !empty($Content_Order->submission_info->Sixth_DeadLine) ||
                            !empty($Content_Order->submission_info->Seven_DeadLine) ||
                            !empty($Content_Order->submission_info->Eight_DeadLine) ||
                            !empty($Content_Order->submission_info->nine_DeadLine) ||
                            !empty($Content_Order->submission_info->ten_DeadLine) ||
                            !empty($Content_Order->submission_info->eleven_DeadLine) ||
                            !empty($Content_Order->submission_info->twelve_DeadLine) ||
                            !empty($Content_Order->submission_info->thirteen_DeadLine) ||
                            !empty($Content_Order->submission_info->fourteen_DeadLine) ||
                            !empty($Content_Order->submission_info->fifteen_DeadLine))

                        <div class="tab-pane" id="tab12">
                            <div class="card-body">
                                <div class="d-flex justify-content-end">

                                </div>
                                <div class="table-responsive">
                                    <table
                                        class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                        id="files-tables">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0 text-center w-5">No</th>
                                                <th class="border-bottom-0">File Name</th>
                                                <th class="border-bottom-0">Upload By</th>
                                                <th class="border-bottom-0">Download File</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $c = 1;
                                            @endphp
                                            @foreach ($draft_submission as $submission)
                                                @forelse ($submission->attachments as $attachment)
                                                    <tr>
                                                        <td class="text-center">{{ $c }}</td>
                                                        <td>
                                                            <a href="{{ asset($attachment->File_Path) }}"
                                                                target="_blank" download
                                                                class="font-weight-semibold fs-14 mt-5">
                                                                {{ $attachment->File_Name }}
                                                            </a>
                                                            @if ($submission->draft_number == 1)
                                                                <div class="">First Draft</div>
                                                            @elseif($submission->draft_number == 2)
                                                                <div class="">Second Draft</div>
                                                            @elseif($submission->draft_number == 3)
                                                                <div class="">Third Draft</div>
                                                            @else
                                                                <div class="">Unknown Draft</div>
                                                            @endif
                                                            <div>{{ $submission->created_at }}</div>
                                                        </td>
                                                        <td>production team
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <a href="{{ asset($attachment->File_Path) }}"
                                                                    class="action-btns1" data-bs-toggle="tooltip"
                                                                    download="" data-bs-placement="top"
                                                                    title="" target="_blank"
                                                                    data-bs-original-title="Download"
                                                                    aria-label="Download">
                                                                    <i
                                                                        class="feather feather-download text-success"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $c++;
                                                    @endphp
                                                @empty
                                                    <tr>
                                                        <td colspan="3">No Files Attached</td>
                                                    </tr>
                                                @endforelse
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="chatbox mt-lg-5" id="chatmodel">
                <div class="chat border-0">
                    <div class="card overflow-hidden mb-0 border-0">
                        <!-- action-header -->
                        <div class="card-header">
                            <div class="float-start hidden-xs d-flex ms-2">
                                <div class="img_cont me-3">
                                    <img src="{{ !empty($auth_user->basic_info->profile_photo_path) ? asset($auth_user->basic_info->profile_photo_path) : asset('assets/images/users/16.jpg') }}"
                                        class="rounded-circle user_img avatar avatar-md" alt="img">
                                </div>
                                <div class="align-items-center mt-2 text-black">
                                    <h5 class="mb-0">{{ $auth_user->basic_info->full_name }}</h5>
                                    <span class="w-2 h-2 brround bg-success d-inline-block"></span><span
                                        class="ms-2 fs-12">Online</span>
                                </div>
                            </div>
                        </div>
                        <!-- action-header end -->
                        <!-- msg_card_body -->
                        <div class="card-body msg_card_body" id="Order-Messages">

                        </div>
                        <!-- msg_card_body end -->
                        <!-- card-footer -->
                        <div class="card-footer">
                            <form data-action="{{ route('Post.Message') }}" method="POST"
                                enctype="multipart/form-data" id="Chat-Form">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $Content_Order->id }}">
                                <input type="hidden" name="user_id"
                                    value="{{ Auth::guard('Authorized')->user()->id }}">
                                <div class="msb-reply-button d-flex mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-white"
                                            placeholder="Typing...." name="Chat_Message" required>
                                        <div class="input-group-append ">
                                            <button type="submit" class="btn btn-primary ">
                                                <span class="feather feather-send"></span> Send
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="msb-reply-button d-flex">
                                    <div class="input-group">
                                        <input type="file" class="form-control bg-white"
                                            placeholder="Any Attachments" name="files[]" multiple>
                                    </div>
                                </div>
                            </form>
                        </div><!-- card-footer end -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header  border-0">
                    <div class="card-title">Order Details</div>
                </div>
                <div class="card-body pt-2 ps-3 pr-3">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="w-50">Order ID </span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span class="font-weight-semibold">{{ $Content_Order->Order_ID }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Industry</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Industry_Name }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Words</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Word_Count }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Writing Style</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Writing_Style }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Preferred Voice</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Preferred_Voice }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Target Audience</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Target_Audience }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Target Gender</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Target_Gender }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Free Image</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Free_Image }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Generic Type</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Generic_Type }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Keywords</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Keywords }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Meta Description</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Meta_Description }}</span>
                                    </td>
                                </tr>
                                  <tr>
                                    <td>
                                        <span class="w-50">Preferred Language</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Preferred_Language ?? '' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Website</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Order_Website }}</span>
                                    </td>
                                </tr>
                                @if (!empty($Content_Order->reference_info->Reference_Code))
                                    <tr>
                                        <td>
                                            <span class="w-50">Reference</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold">{{ $Content_Order->reference_info->Reference_Code }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->F_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">First Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->F_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->S_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Second Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->S_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->T_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Third Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->T_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Four_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Fourth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Four_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Fifth_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Fifth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Fifth_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Sixth_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Sixth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Sixth_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Seven_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Seventh Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Seven_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Eight_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Eighth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Eight_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->nine_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Ninth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->nine_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->ten_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Tenth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->ten_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->eleven_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Eleventh Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->eleven_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->twelve_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Twelfth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->twelve_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->thirteen_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Thirteenth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->thirteen_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->fourteen_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Fourteenth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->fourteen_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->fifteen_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Fifteenth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->fifteen_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!is_null($Content_Order->deadlines))
                                    @forelse($Content_Order->deadlines as $deadline)
                                        <tr>
                                            <td>
                                                <span class="w-50">Draft Deadline {{ $loop->iteration }}</span>
                                            </td>
                                            <td>:</td>
                                            <td>
                                                <span
                                                    class="font-weight-semibold text-danger">{{ $deadline->DeadLines }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                @endif
                                <tr>
                                    <td>
                                        <span class="w-50">Final Deadline</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->DeadLine }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Status</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold text-info">{{ $Content_Order->content_info->Order_Status }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Created Date</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ date('F d, Y', strtotime($Content_Order->created_at)) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Created Time</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ date('H:i:s A', strtotime($Content_Order->created_at)) }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-header border-0">
                    <div class="card-title">Client Information</div>
                </div>
                <div class="card-body pt-2 ps-3 pr-3">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="w-50">Name</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->client_info->Client_Name }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-header  border-0">
                    <div class="card-title">Sales Department</div>
                </div>
                <div class="card-body pt-2 ps-3 pr-3">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="w-50">Created By</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->authorized_user->basic_info->full_name }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endif
{{-- Manager View --}}
@if ((int) $auth_user->Role_ID === 17)
    <!--Page header-->
    <div class="page-header d-xl-flex d-block">
        <div class="page-rightheader ms-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                <div class="btn-list">
                    <div class="dropdown">
                        <button class="btn btn-info dropdown-toggle px-5" data-bs-toggle="dropdown">
                            <i class="fe fe-activity me-2"></i>Actions
                        </button>
                        <div class="dropdown-menu">
                            @if ($Content_Order->content_info->Order_Status !== 'Completed')
                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal"
                                    data-bs-target="#AssignModal">Assign Order</a>
                                {{--                                 <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" --}}
                                {{--                                    data-bs-target="#NewTaskModal">New Task</a> --}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Page header-->
    <!-- Row -->
    <div class="row">
        <div class="col-xl-9 col-md-12 col-lg-12">
            <div class="tab-menu-heading hremp-tabs p-0 ">
                <div class="tabs-menu1">
                    <!-- Tabs -->
                    <ul class="nav panel-tabs">
                        <li class="ms-4"><a href="#tab5" class="active" data-bs-toggle="tab">Order
                                Description</a></li>
                        <li><a href="#tab7" data-bs-toggle="tab">Order Attachments</a></li>
                        <li><a href="#tab10" data-bs-toggle="tab">Final Submission</a></li>
                        @if (
                            !empty($Content_Order->submission_info->F_DeadLine) ||
                                !empty($Content_Order->submission_info->S_DeadLine) ||
                                !empty($Content_Order->submission_info->T_DeadLine) ||
                                !empty($Content_Order->submission_info->Four_DeadLine) ||
                                !empty($Content_Order->submission_info->Fifth_DeadLine) ||
                                !empty($Content_Order->submission_info->Sixth_DeadLine) ||
                                !empty($Content_Order->submission_info->Seven_DeadLine) ||
                                !empty($Content_Order->submission_info->Eight_DeadLine) ||
                                !empty($Content_Order->submission_info->nine_DeadLine) ||
                                !empty($Content_Order->submission_info->ten_DeadLine) ||
                                !empty($Content_Order->submission_info->eleven_DeadLine) ||
                                !empty($Content_Order->submission_info->twelve_DeadLine) ||
                                !empty($Content_Order->submission_info->thirteen_DeadLine) ||
                                !empty($Content_Order->submission_info->fourteen_DeadLine) ||
                                !empty($Content_Order->submission_info->fifteen_DeadLine))
                            <li><a href="#tab12" data-bs-toggle="tab">Draft Submission</a></li>
                        @endif

                        @if (!empty($Content_Order->revision))
                            <li><a href="#tab11" data-bs-toggle="tab">Order Revisions</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab5">
                        <div class="card-body">
                            {!! $Content_Order->order_desc->Description !!}
                        </div>
                    </div>
                    <div class="tab-pane" id="tab7">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table
                                    class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                    id="files-tables">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0 text-center w-5">No</th>
                                            <th class="border-bottom-0">File Name</th>
                                            <th class="border-bottom-0">Download File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($Content_Order->attachments as $attachment)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{ asset($attachment->order_attachment_path) }}"
                                                        target="_blank" download
                                                        class="font-weight-semibold fs-14 mt-5">{{ $attachment->File_Name }}
                                                        <span class="text-muted ms-2">(23 KB)</span></a>
                                                    <div class="clearfix"></div>
                                                    <small class="text-muted">{{ $attachment->created_at }}</small>
                                                </td>

                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ asset($attachment->order_attachment_path) }}"
                                                            class="action-btns1" data-bs-toggle="tooltip" download
                                                            data-bs-placement="top" title="Download"
                                                            target="_blank"><i
                                                                class="feather feather-download   text-success"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">Files are Not Attached</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab10">
                        <div class="card-body">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-danger mb-4" data-bs-toggle="modal"
                                    data-bs-target="#FinalSubmissionModal"> Upload Files
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table
                                    class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                    id="files-tables">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0 text-center w-5">No</th>
                                            <th class="border-bottom-0">File Name</th>
                                            <th class="border-bottom-0">Download File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($Content_Order->final_submission as $submission)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{ asset($submission->final_submission_path) }}"
                                                        target="_blank" download
                                                        class="font-weight-semibold fs-14 mt-5">{{ $submission->File_Name }}
                                                        <span class="text-muted ms-2">(23 KB)</span></a>
                                                    <div class="clearfix"></div>
                                                    <span>{{ $submission->authorized_user->basic_info->F_Name . ' ' . $submission->authorized_user->basic_info->L_Name }}</span><br>
                                                    <small class="text-muted">{{ $submission->created_at }}</small>
                                                </td>

                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ asset($submission->final_submission_path) }}"
                                                            class="action-btns1" data-bs-toggle="tooltip" download
                                                            data-bs-placement="top" title="Download"
                                                            target="_blank"><i
                                                                class="feather feather-download   text-success"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">Files are Not Attached</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if (!empty($Content_Order->revision))
                        <div class="tab-pane" id="tab11">

                            <div class="card-body">
                                <div class="d-flex justify-content-end">

                                </div>
                                <div class="table-responsive">
                                    <table
                                        class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                        id="files-tables">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0 text-center w-5">No</th>
                                                <th class="border-bottom-0">Revised By</th>
                                                <th class="border-bottom-0">Date</th>
                                                <th class="border-bottom-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Content_Order->revision as $revision)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>Sales</td>
                                                    <td>{{ $revision->created_at }}</td>
                                                    <td>
                                                        <div class="btn-list">
                                                            <div class="dropdown">
                                                                <button class="btn btn-info dropdown-toggle px-5"
                                                                    data-bs-toggle="dropdown">
                                                                    <i class="fe fe-activity me-2"></i>Actions
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item Order-Revision-view"
                                                                        id="Revision_ID"
                                                                        data-id="{{ $revision->id }}"
                                                                        href="JavaScript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#ViewRevision">View
                                                                        Revision</a>

                                                                    <a class="dropdown-item Order-Revision Upload_Revision_ID"
                                                                        data-id="{{ $revision->id }}"
                                                                        href="JavaScript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#SubmitRevision">Upload
                                                                        Revision</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    @endif
                    @if (
                        !empty($Content_Order->submission_info->F_DeadLine) ||
                            !empty($Content_Order->submission_info->S_DeadLine) ||
                            !empty($Content_Order->submission_info->T_DeadLine) ||
                            !empty($Content_Order->submission_info->Four_DeadLine) ||
                            !empty($Content_Order->submission_info->Fifth_DeadLine) ||
                            !empty($Content_Order->submission_info->Sixth_DeadLine) ||
                            !empty($Content_Order->submission_info->Seven_DeadLine) ||
                            !empty($Content_Order->submission_info->Eight_DeadLine) ||
                            !empty($Content_Order->submission_info->nine_DeadLine) ||
                            !empty($Content_Order->submission_info->ten_DeadLine) ||
                            !empty($Content_Order->submission_info->eleven_DeadLine) ||
                            !empty($Content_Order->submission_info->twelve_DeadLine) ||
                            !empty($Content_Order->submission_info->thirteen_DeadLine) ||
                            !empty($Content_Order->submission_info->fourteen_DeadLine) ||
                            !empty($Content_Order->submission_info->fifteen_DeadLine))



                        <div class="tab-pane" id="tab12">
                            <div class="card-body">
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-danger mb-4" data-bs-toggle="modal"
                                        data-bs-target="#uploaddraft"> Upload Draft
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table
                                        class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                        id="files-tables">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0 text-center w-5">No</th>
                                                <th class="border-bottom-0">File Name</th>

                                                <th class="border-bottom-0">Download File</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $d = 1;
                                            @endphp
                                            @foreach ($draft_submission as $submission)
                                                @forelse ($submission->attachments as $attachment)
                                                    <tr>
                                                        <td class="text-center">{{ $d }}</td>
                                                        <td>
                                                            <a href="{{ asset($attachment->File_Path) }}"
                                                                target="_blank" download
                                                                class="font-weight-semibold fs-14 mt-5">
                                                                {{ $attachment->File_Name }}
                                                            </a>
                                                            @if ($submission->draft_number == 1)
                                                                <div class="">First Draft</div>
                                                            @elseif($submission->draft_number == 2)
                                                                <div class="">Second Draft</div>
                                                            @elseif($submission->draft_number == 3)
                                                                <div class="">Third Draft</div>
                                                            @else
                                                                <div class="">Unknown Draft</div>
                                                            @endif
                                                            <div>
                                                                {{ $submission->submittedByUser->basic_info->F_Name . ' ' . $submission->submittedByUser->basic_info->L_Name }}
                                                            </div>
                                                            <div>{{ $submission->created_at }}</div>
                                                        </td>

                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <a href="{{ asset($attachment->File_Path) }}"
                                                                    class="action-btns1" data-bs-toggle="tooltip"
                                                                    download="" data-bs-placement="top"
                                                                    title="" target="_blank"
                                                                    data-bs-original-title="Download"
                                                                    aria-label="Download">
                                                                    <i
                                                                        class="feather feather-download text-success"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $d++;
                                                    @endphp
                                                @empty
                                                    <tr>
                                                        <td colspan="3">No Files Attached</td>
                                                    </tr>
                                                @endforelse
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="chatbox mt-lg-5" id="chatmodel">
                <div class="chat border-0">
                    <div class="card overflow-hidden mb-0 border-0">
                        <!-- action-header -->
                        <div class="card-header">
                            <div class="float-start hidden-xs d-flex ms-2">
                                <div class="img_cont me-3">
                                    <img src="{{ !empty($auth_user->basic_info->profile_photo_path) ? asset($auth_user->basic_info->profile_photo_path) : asset('assets/images/users/16.jpg') }}"
                                        class="rounded-circle user_img avatar avatar-md" alt="img">
                                </div>
                                <div class="align-items-center mt-2 text-black">
                                    <h5 class="mb-0">{{ $auth_user->basic_info->full_name }}</h5>
                                    <span class="w-2 h-2 brround bg-success d-inline-block"></span><span
                                        class="ms-2 fs-12">Online</span>
                                </div>
                            </div>
                        </div>
                        <!-- action-header end -->
                        <!-- msg_card_body -->
                        <div class="card-body msg_card_body" id="Order-Messages">

                        </div>
                        <!-- msg_card_body end -->
                        <!-- card-footer -->
                        <div class="card-footer">
                            <form data-action="{{ route('Post.Message') }}" method="POST"
                                enctype="multipart/form-data" id="Chat-Form">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $Content_Order->id }}">
                                <input type="hidden" name="user_id"
                                    value="{{ Auth::guard('Authorized')->user()->id }}">
                                <div class="msb-reply-button d-flex mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-white"
                                            placeholder="Typing...." name="Chat_Message" required>
                                        <div class="input-group-append ">
                                            <button type="submit" class="btn btn-primary ">
                                                <span class="feather feather-send"></span> Send
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="msb-reply-button d-flex">
                                    <div class="input-group">
                                        <input type="file" class="form-control bg-white"
                                            placeholder="Any Attachments" name="files[]" multiple>
                                    </div>
                                </div>
                            </form>
                        </div><!-- card-footer end -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header  border-0">
                    <div class="card-title">Order Details</div>
                </div>
                <div class="card-body pt-2 ps-3 pr-3">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="w-50">Order ID </span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span class="font-weight-semibold">{{ $Content_Order->Order_ID }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Industry</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Industry_Name }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Words</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Word_Count }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Writing Style</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Writing_Style }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Preferred Voice</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Preferred_Voice }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Target Audience</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Target_Audience }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Target Gender</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Target_Gender }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Free Image</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Free_Image }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Generic Type</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Generic_Type }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Keywords</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Keywords }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Meta Description</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Meta_Description }}</span>
                                    </td>
                                </tr>
                                  <tr>
                                    <td>
                                        <span class="w-50">Preferred Language</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Preferred_Language ?? '' }}</span>
                                    </td>
                                </tr>
                                @if (!empty($Content_Order->reference_info->Reference_Code))
                                    <tr>
                                        <td>
                                            <span class="w-50">Reference</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold">{{ $Content_Order->reference_info->Reference_Code }}</span>
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($Content_Order->submission_info->F_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">First Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->F_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->S_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Second Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->S_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->T_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Third Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->T_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Four_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Fourth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Four_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Fifth_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Fifth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Fifth_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Sixth_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Sixth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Sixth_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Seven_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Seventh Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Seven_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Eight_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Eighth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Eight_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->nine_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Ninth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->nine_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->ten_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Tenth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->ten_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->eleven_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Eleventh Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->eleven_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->twelve_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Twelfth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->twelve_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->thirteen_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Thirteenth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->thirteen_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->fourteen_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Fourteenth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->fourteen_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->fifteen_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Fifteenth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->fifteen_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                <tr>
                                    <td>
                                        <span class="w-50">Final Deadline</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->DeadLine }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Final Deadline Time</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->DeadLine_Time }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Status</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold text-info">{{ $Content_Order->content_info->Order_Status }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Created Date</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ date('F d, Y', strtotime($Content_Order->created_at)) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Created Time</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ date('H:i:s A', strtotime($Content_Order->created_at)) }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-header  border-0">
                    <div class="card-title">Content Department</div>
                </div>
                <div class="card-body pt-2 ps-3 pr-3">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                @if (!empty($Content_Order->assign))
                                    @foreach ($Content_Order->assign as $User)
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0)" data-bs-target="#RemoveWriter"
                                                    class="action-btns1 RemoveContentWriter" data-bs-toggle="modal"
                                                    data-bs-placement="top" title="Remove Writer"><i
                                                        class="feather feather-trash text-danger"></i>
                                                    <input type="hidden" class="order_id"
                                                        value="{{ $Content_Order->id }}">
                                                    <input type="hidden" class="user_id"
                                                        value="{{ $User->id }}">
                                                </a>
                                                <a href="javascript:void(0)" data-bs-target="#ChangedWriter"
                                                    class="action-btns1 ChangeContentWriter" data-bs-toggle="modal"
                                                    data-bs-placement="top" title="Change Writer"><i
                                                        class="feather feather-repeat text-warning"></i>
                                                    <input type="hidden" class="order_id"
                                                        value="{{ $Content_Order->id }}">
                                                    <input type="hidden" class="user_id"
                                                        value="{{ $User->id }}">
                                                </a>
                                                <span class="w-50">Content Writer</span>
                                            </td>
                                            <td>:</td>
                                            <td>
                                                <span
                                                    class="font-weight-semibold">{{ $User->basic_info->full_name }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Assign Modal -->
    <div class="modal fade" id="AssignModal">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <form action="{{ route('Assign.Order') }}" method="POST"
                    class="needs-validation was-validated">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Assign Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="Order_ID" value="{{ $Order_ID }}">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="Assign_ID">Content Writers</label>
                                    <select name="Assign_ID[]" id="Assign_ID" class="form-control select2"
                                        data-placeholder="Select Coordinator" multiple required>
                                        <option value="">Select Writers</option>
                                        @forelse($Content_Writer_List as $Writer)
                                            <option value="{{ $Writer->id }}">
                                                {{ $Writer->basic_info->full_name }}
                                                &nbsp; {{ $Writer->skills->Skill_Name }}</option>
                                        @empty
                                            <option value="">No Writers available</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Assign Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Change Writer Modal -->
    <div class="modal fade" id="ChangedWriter">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('Change.Content.Writer') }}" method="POST"
                    class="needs-validation was-validated">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Change Writer on Current Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="Order_ID" value="{{ $Content_Order->Order_ID }}">
                            <input type="hidden" name="order_id" class="get_order_id">
                            <input type="hidden" name="user_id" class="get_user_id">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="W_Assign_ID">Select Writers</label>
                                    <select name="W_Assign_ID" class="form-control custom-select select2"
                                        id="W_Assign_ID" data-placeholder="Select Writer" aria-required="true"
                                        required>
                                        <option value="">Select Writers</option>
                                        @forelse($Content_Writer_List as $Writer)
                                            <option value="{{ $Writer->id }}">
                                                {{ $Writer->basic_info->full_name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Changed Writer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Remove Writer Modal -->
    <div class="modal fade" id="RemoveWriter">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('Remove.Content.Writer') }}" method="POST"
                    class="needs-validation was-validated">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Are You Sure?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="Order_ID" value="{{ $Content_Order->Order_ID }}">
                            <input type="hidden" name="order_id" class="get_order_id">
                            <input type="hidden" name="user_id" class="get_user_id">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="W_Assign_ID">Select Writers</label>
                                    <select name="W_Assign_ID"
                                        class="form-control custom-select select2 W_Assign_ID"
                                        data-placeholder="Select Writer" aria-required="true" required>
                                        <option value="">Select Writers</option>
                                        @forelse($Content_Writer_List as $Writer)
                                            <option value="{{ $Writer->id }}">
                                                {{ $Writer->basic_info->full_name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Remove Writer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endif
{{-- Content Writer View --}}
@if ((int) $auth_user->Role_ID === 120)
    <!--Page header-->
    <div class="page-header d-xl-flex d-block">
        <div class="page-rightheader ms-md-auto">
        </div>
    </div>
    <!--End Page header-->
    <!-- Row -->
    <div class="row">
        <div class="col-xl-9 col-md-12 col-lg-12">
            <div class="tab-menu-heading hremp-tabs p-0 ">
                <div class="tabs-menu1">
                    <!-- Tabs -->
                    <ul class="nav panel-tabs">
                        <li class="ms-4"><a href="#tab5" class="active" data-bs-toggle="tab">Order
                                Description</a></li>
                        <li><a href="#tab7" data-bs-toggle="tab">Order Attachments</a></li>
                        <li><a href="#tab10" data-bs-toggle="tab">Final Submission</a></li>
                        @if (!is_null($Content_Order->deadlines) && count($Content_Order->deadlines) > 0)
                            <li><a href="#tab12" data-bs-toggle="tab">Draft Submission</a></li>
                        @endif

                        @if (!empty($Content_Order->revision))
                            <li><a href="#tab11" data-bs-toggle="tab">Order Revisions</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab5">
                        <div class="card-body">
                            {!! $Content_Order->order_desc->Description !!}
                        </div>
                    </div>
                    <div class="tab-pane" id="tab7">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table
                                    class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                    id="files-tables">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0 text-center w-5">No</th>
                                            <th class="border-bottom-0">File Name</th>
                                            <th class="border-bottom-0">Download File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($Content_Order->attachments as $attachment)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{ asset($attachment->order_attachment_path) }}"
                                                        target="_blank" download
                                                        class="font-weight-semibold fs-14 mt-5">{{ $attachment->File_Name }}
                                                        <span class="text-muted ms-2">(23 KB)</span></a>
                                                    <div class="clearfix"></div>
                                                    <small class="text-muted">{{ $attachment->created_at }}</small>
                                                </td>

                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ asset($attachment->order_attachment_path) }}"
                                                            class="action-btns1" data-bs-toggle="tooltip" download
                                                            data-bs-placement="top" title="Download"
                                                            target="_blank"><i
                                                                class="feather feather-download   text-success"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">Files are Not Attached</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab10">
                        <div class="card-body">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-danger mb-4" data-bs-toggle="modal"
                                    data-bs-target="#FinalSubmissionModal"> Upload Files
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table
                                    class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                    id="files-tables">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0 text-center w-5">No</th>
                                            <th class="border-bottom-0">File Name</th>
                                            <th class="border-bottom-0">Download File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($Content_Order->final_submission as $submission)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{ asset($submission->final_submission_path) }}"
                                                        target="_blank" download
                                                        class="font-weight-semibold fs-14 mt-5">{{ $submission->File_Name }}
                                                        <span class="text-muted ms-2">(23 KB)</span></a>
                                                    <div class="clearfix"></div>
                                                    <small class="text-muted">{{ $submission->created_at }}</small>
                                                </td>

                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ asset($submission->final_submission_path) }}"
                                                            class="action-btns1" data-bs-toggle="tooltip" download
                                                            data-bs-placement="top" title="Download"
                                                            target="_blank"><i
                                                                class="feather feather-download   text-success"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">Files are Not Attached</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if (!empty($Content_Order->revision))
                        <div class="tab-pane" id="tab11">

                            <div class="card-body">
                                <div class="d-flex justify-content-end">

                                </div>
                                <div class="table-responsive">
                                    <table
                                        class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                        id="files-tables">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0 text-center w-5">No</th>
                                                <th class="border-bottom-0">Revised By</th>
                                                <th class="border-bottom-0">Date</th>
                                                <th class="border-bottom-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Content_Order->revision as $revision)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>Sales</td>
                                                    <td>{{ $revision->created_at }}</td>
                                                    <td>
                                                        <div class="btn-list">
                                                            <div class="dropdown">
                                                                <button class="btn btn-info dropdown-toggle px-5"
                                                                    data-bs-toggle="dropdown">
                                                                    <i class="fe fe-activity me-2"></i>Actions
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item Order-Revision-view"
                                                                        id="Revision_ID"
                                                                        data-id="{{ $revision->id }}"
                                                                        href="JavaScript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#ViewRevision">View
                                                                        Revision</a>

                                                                    <a class="dropdown-item Order-Revision Upload_Revision_ID"
                                                                        data-id="{{ $revision->id }}"
                                                                        href="JavaScript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#SubmitRevision">Upload
                                                                        Revision</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    @endif

                    @if (
                        !empty($Content_Order->submission_info->F_DeadLine) ||
                            !empty($Content_Order->submission_info->S_DeadLine) ||
                            !empty($Content_Order->submission_info->T_DeadLine) ||
                            !empty($Content_Order->submission_info->Four_DeadLine) ||
                            !empty($Content_Order->submission_info->Fifth_DeadLine) ||
                            !empty($Content_Order->submission_info->Sixth_DeadLine) ||
                            !empty($Content_Order->submission_info->Seven_DeadLine) ||
                            !empty($Content_Order->submission_info->Eight_DeadLine) ||
                            !empty($Content_Order->submission_info->nine_DeadLine) ||
                            !empty($Content_Order->submission_info->ten_DeadLine) ||
                            !empty($Content_Order->submission_info->eleven_DeadLine) ||
                            !empty($Content_Order->submission_info->twelve_DeadLine) ||
                            !empty($Content_Order->submission_info->thirteen_DeadLine) ||
                            !empty($Content_Order->submission_info->fourteen_DeadLine) ||
                            !empty($Content_Order->submission_info->fifteen_DeadLine))


                        <div class="tab-pane" id="tab12">
                            <div class="card-body">
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-danger mb-4" data-bs-toggle="modal"
                                        data-bs-target="#uploaddraft"> Upload Draft
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table
                                        class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                        id="files-tables">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0 text-center w-5">No</th>
                                                <th class="border-bottom-0">File Name</th>
                                                <th class="border-bottom-0">Upload By</th>
                                                <th class="border-bottom-0">Download File</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $e = 1;
                                            @endphp
                                            @foreach ($draft_submission as $submission)
                                                @forelse ($submission->attachments as $attachment)
                                                    <tr>
                                                        <td class="text-center">{{ $e }}</td>
                                                        <td>
                                                            <a href="{{ asset($attachment->File_Path) }}"
                                                                target="_blank" download
                                                                class="font-weight-semibold fs-14 mt-5">
                                                                {{ $attachment->File_Name }}
                                                            </a>
                                                            @if ($submission->draft_number == 1)
                                                                <div class="">First Draft</div>
                                                            @elseif($submission->draft_number == 2)
                                                                <div class="">Second Draft</div>
                                                            @elseif($submission->draft_number == 3)
                                                                <div class="">Third Draft</div>
                                                            @else
                                                                <div class="">Unknown Draft</div>
                                                            @endif
                                                            <div>{{ $submission->created_at }}</div>
                                                        </td>
                                                        <td>{{ $submission->submittedByUser->basic_info->F_Name }}
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <a href="{{ asset($attachment->File_Path) }}"
                                                                    class="action-btns1" data-bs-toggle="tooltip"
                                                                    download="" data-bs-placement="top"
                                                                    title="" target="_blank"
                                                                    data-bs-original-title="Download"
                                                                    aria-label="Download">
                                                                    <i
                                                                        class="feather feather-download text-success"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $e++;
                                                    @endphp
                                                @empty
                                                    <tr>
                                                        <td colspan="3">No Files Attached</td>
                                                    </tr>
                                                @endforelse
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif



                </div>
            </div>
            <div class="chatbox mt-lg-5" id="chatmodel">
                <div class="chat border-0">
                    <div class="card overflow-hidden mb-0 border-0">
                        <!-- action-header -->
                        <div class="card-header">
                            <div class="float-start hidden-xs d-flex ms-2">
                                <div class="img_cont me-3">
                                    <img src="{{ !empty($auth_user->basic_info->profile_photo_path) ? asset($auth_user->basic_info->profile_photo_path) : asset('assets/images/users/16.jpg') }}"
                                        class="rounded-circle user_img avatar avatar-md" alt="img">
                                </div>
                                <div class="align-items-center mt-2 text-black">
                                    <h5 class="mb-0">{{ $auth_user->basic_info->full_name }}</h5>
                                    <span class="w-2 h-2 brround bg-success d-inline-block"></span><span
                                        class="ms-2 fs-12">Online</span>
                                </div>
                            </div>
                        </div>
                        <!-- action-header end -->
                        <!-- msg_card_body -->
                        <div class="card-body msg_card_body" id="Order-Messages">

                        </div>
                        <!-- msg_card_body end -->
                        <!-- card-footer -->
                        <div class="card-footer">
                            <form data-action="{{ route('Post.Message') }}" method="POST"
                                enctype="multipart/form-data" id="Chat-Form">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $Content_Order->id }}">
                                <input type="hidden" name="user_id"
                                    value="{{ Auth::guard('Authorized')->user()->id }}">
                                <input type="hidden" name="is_executive" value="1">
                                <div class="msb-reply-button d-flex mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-white"
                                            placeholder="Typing...." name="Chat_Message" required>
                                        <div class="input-group-append ">
                                            <button type="submit" class="btn btn-primary ">
                                                <span class="feather feather-send"></span> Send
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="msb-reply-button d-flex">
                                    <div class="input-group">
                                        <input type="file" class="form-control bg-white"
                                            placeholder="Any Attachments" name="files[]" multiple>
                                    </div>
                                </div>
                            </form>
                        </div><!-- card-footer end -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header  border-0">
                    <div class="card-title">Order Details</div>
                </div>
                <div class="card-body pt-2 ps-3 pr-3">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="w-50">Order ID </span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span class="font-weight-semibold">{{ $Content_Order->Order_ID }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Industry</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Industry_Name }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Words</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Word_Count }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Writing Style</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Writing_Style }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Preferred Voice</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Preferred_Voice }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Target Audience</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Target_Audience }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Target Gender</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Target_Gender }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Free Image</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Free_Image }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Generic Type</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Generic_Type }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Keywords</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Keywords }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Meta Description</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Meta_Description }}</span>
                                    </td>
                                </tr>
                                  <tr>
                                    <td>
                                        <span class="w-50">Preferred Language</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Preferred_Language ?? '' }}</span>
                                    </td>
                                </tr>
                                @if (!empty($Content_Order->reference_info->Reference_Code))
                                    <tr>
                                        <td>
                                            <span class="w-50">Reference</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold">{{ $Content_Order->reference_info->Reference_Code }}</span>
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($Content_Order->submission_info->F_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">First Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->F_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->S_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Second Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->S_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->T_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Third Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->T_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Four_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Fourth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Four_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Fifth_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Fifth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Fifth_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Sixth_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Sixth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Sixth_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Seven_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Seventh Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Seven_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Eight_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Eighth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Eight_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->nine_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Ninth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->nine_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->ten_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Tenth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->ten_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->eleven_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Eleventh Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->eleven_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->twelve_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Twelfth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->twelve_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->thirteen_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Thirteenth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->thirteen_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->fourteen_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Fourteenth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->fourteen_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->fifteen_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Fifteenth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->fifteen_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                <tr>
                                    <td>
                                        <span class="w-50">Final Deadline</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->DeadLine }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Status</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold text-info">{{ $Content_Order->content_info->Order_Status }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Created Date</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ date('F d, Y', strtotime($Content_Order->created_at)) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Created Time</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ date('H:i:s A', strtotime($Content_Order->created_at)) }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endif
{{-- Independent Content Writer View --}}
@if ((int) $auth_user->Role_ID === 8 || (int) $auth_user->Role_ID === 12)
    <!--Page header-->
    <div class="page-header d-xl-flex d-block">
        <div class="page-rightheader ms-md-auto">
        </div>
    </div>
    <!--End Page header-->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-9 col-md-12 col-lg-12">
            <div class="tab-menu-heading hremp-tabs p-0 ">
                <div class="tabs-menu1">
                    <!-- Tabs -->
                    <ul class="nav panel-tabs">
                        <li class="ms-4"><a href="#tab5" class="active" data-bs-toggle="tab">Order
                                Description</a></li>
                        <li><a href="#tab7" data-bs-toggle="tab">Order Attachments</a></li>
                        <li><a href="#tab10" data-bs-toggle="tab">Final Submission</a></li>
                        @if (
                            !empty($Content_Order->submission_info->F_DeadLine) ||
                                !empty($Content_Order->submission_info->S_DeadLine) ||
                                !empty($Content_Order->submission_info->T_DeadLine) ||
                                !empty($Content_Order->submission_info->Four_DeadLine) ||
                                !empty($Content_Order->submission_info->Fifth_DeadLine) ||
                                !empty($Content_Order->submission_info->Sixth_DeadLine) ||
                                !empty($Content_Order->submission_info->Seven_DeadLine) ||
                                !empty($Content_Order->submission_info->Eight_DeadLine) ||
                                !empty($Content_Order->submission_info->nine_DeadLine) ||
                                !empty($Content_Order->submission_info->ten_DeadLine) ||
                                !empty($Content_Order->submission_info->eleven_DeadLine) ||
                                !empty($Content_Order->submission_info->twelve_DeadLine) ||
                                !empty($Content_Order->submission_info->thirteen_DeadLine) ||
                                !empty($Content_Order->submission_info->fourteen_DeadLine) ||
                                !empty($Content_Order->submission_info->fifteen_DeadLine))
                            <li><a href="#tab12" data-bs-toggle="tab">Draft Submission</a></li>
                        @endif
                        @if (!empty($Content_Order->revision))
                            <li><a href="#tab11" data-bs-toggle="tab">Order Revisions</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab5">
                        <div class="card-body">
                            {!! $Content_Order->order_desc->Description !!}
                        </div>
                    </div>
                    <div class="tab-pane" id="tab7">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table
                                    class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                    id="files-tables">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0 text-center w-5">No</th>
                                            <th class="border-bottom-0">File Name</th>
                                            <th class="border-bottom-0">Download File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($Content_Order->attachments as $attachment)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{ asset($attachment->order_attachment_path) }}"
                                                        target="_blank" download
                                                        class="font-weight-semibold fs-14 mt-5">{{ $attachment->File_Name }}
                                                        <span class="text-muted ms-2">(23 KB)</span></a>
                                                    <div class="clearfix"></div>
                                                    <small class="text-muted">{{ $attachment->created_at }}</small>
                                                </td>

                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ asset($attachment->order_attachment_path) }}"
                                                            class="action-btns1" data-bs-toggle="tooltip" download
                                                            data-bs-placement="top" title="Download"
                                                            target="_blank"><i
                                                                class="feather feather-download   text-success"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">Files are Not Attached</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab10">
                        <div class="card-body">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-danger mb-4" data-bs-toggle="modal"
                                    data-bs-target="#FinalSubmissionModal"> Upload Files
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table
                                    class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                    id="files-tables">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0 text-center w-5">No</th>
                                            <th class="border-bottom-0">File Name</th>
                                            <th class="border-bottom-0">Download File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($Content_Order->final_submission as $submission)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{ asset($submission->final_submission_path) }}"
                                                        target="_blank" download
                                                        class="font-weight-semibold fs-14 mt-5">{{ $submission->File_Name }}
                                                        <span class="text-muted ms-2">(23 KB)</span></a>
                                                    <div class="clearfix"></div>
                                                    <small class="text-muted">{{ $submission->created_at }}</small>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ asset($submission->final_submission_path) }}"
                                                            class="action-btns1" data-bs-toggle="tooltip" download
                                                            data-bs-placement="top" title="Download"
                                                            target="_blank"><i
                                                                class="feather feather-download   text-success"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">Files are Not Attached</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if (!empty($Content_Order->revision))
                        <div class="tab-pane" id="tab11">

                            <div class="card-body">
                                <div class="d-flex justify-content-end">

                                </div>
                                <div class="table-responsive">
                                    <table
                                        class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                        id="files-tables">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0 text-center w-5">No</th>
                                                <th class="border-bottom-0">Revised By</th>
                                                <th class="border-bottom-0">Date</th>
                                                <th class="border-bottom-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Content_Order->revision as $revision)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>Sales </td>
                                                    <td>{{ $revision->created_at }}</td>
                                                    <td>
                                                        <div class="btn-list">
                                                            <div class="dropdown">
                                                                <button class="btn btn-info dropdown-toggle px-5"
                                                                    data-bs-toggle="dropdown">
                                                                    <i class="fe fe-activity me-2"></i>Actions
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item Order-Revision-view"
                                                                        id="Revision_ID"
                                                                        data-id="{{ $revision->id }}"
                                                                        href="JavaScript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#ViewRevision">View
                                                                        Revision</a>

                                                                    <a class="dropdown-item Order-Revision Upload_Revision_ID"
                                                                        data-id="{{ $revision->id }}"
                                                                        href="JavaScript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#SubmitRevision">Upload
                                                                        Revision</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    @endif

                    @if (
                        !empty($Content_Order->submission_info->F_DeadLine) ||
                            !empty($Content_Order->submission_info->S_DeadLine) ||
                            !empty($Content_Order->submission_info->T_DeadLine) ||
                            !empty($Content_Order->submission_info->Four_DeadLine) ||
                            !empty($Content_Order->submission_info->Fifth_DeadLine) ||
                            !empty($Content_Order->submission_info->Sixth_DeadLine) ||
                            !empty($Content_Order->submission_info->Seven_DeadLine) ||
                            !empty($Content_Order->submission_info->Eight_DeadLine) ||
                            !empty($Content_Order->submission_info->nine_DeadLine) ||
                            !empty($Content_Order->submission_info->ten_DeadLine) ||
                            !empty($Content_Order->submission_info->eleven_DeadLine) ||
                            !empty($Content_Order->submission_info->twelve_DeadLine) ||
                            !empty($Content_Order->submission_info->thirteen_DeadLine) ||
                            !empty($Content_Order->submission_info->fourteen_DeadLine) ||
                            !empty($Content_Order->submission_info->fifteen_DeadLine))

                        <div class="tab-pane" id="tab12">
                            <div class="card-body">
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-danger mb-4" data-bs-toggle="modal"
                                        data-bs-target="#uploaddraft"> Upload Draft
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table
                                        class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                        id="files-tables">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0 text-center w-5">No</th>
                                                <th class="border-bottom-0">File Name</th>
                                                <th class="border-bottom-0">Upload By</th>
                                                <th class="border-bottom-0">Download File</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $f = 1;
                                            @endphp
                                            @foreach ($draft_submission as $submission)
                                                @forelse ($submission->attachments as $attachment)
                                                    <tr>
                                                        <td class="text-center">{{ $f }}</td>
                                                        <td>
                                                            <a href="{{ asset($attachment->File_Path) }}"
                                                                target="_blank" download
                                                                class="font-weight-semibold fs-14 mt-5">
                                                                {{ $attachment->File_Name }}
                                                            </a>
                                                            @if ($submission->draft_number == 1)
                                                                <div class="">First Draft</div>
                                                            @elseif($submission->draft_number == 2)
                                                                <div class="">Second Draft</div>
                                                            @elseif($submission->draft_number == 3)
                                                                <div class="">Third Draft</div>
                                                            @else
                                                                <div class="">Unknown Draft</div>
                                                            @endif
                                                            <div>{{ $submission->created_at }}</div>
                                                        </td>
                                                        <td>{{ $submission->submittedByUser->basic_info->F_Name }}
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <a href="{{ asset($attachment->File_Path) }}"
                                                                    class="action-btns1" data-bs-toggle="tooltip"
                                                                    download="" data-bs-placement="top"
                                                                    title="" target="_blank"
                                                                    data-bs-original-title="Download"
                                                                    aria-label="Download">
                                                                    <i
                                                                        class="feather feather-download text-success"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $f++;
                                                    @endphp
                                                @empty
                                                    <tr>
                                                        <td colspan="3">No Files Attached</td>
                                                    </tr>
                                                @endforelse
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="chatbox mt-lg-5" id="chatmodel">
                <div class="chat border-0">
                    <div class="card overflow-hidden mb-0 border-0">
                        <!-- action-header -->
                        <div class="card-header">
                            <div class="float-start hidden-xs d-flex ms-2">
                                <div class="img_cont me-3">
                                    <img src="{{ !empty($auth_user->basic_info->profile_photo_path) ? asset($auth_user->basic_info->profile_photo_path) : asset('assets/images/users/16.jpg') }}"
                                        class="rounded-circle user_img avatar avatar-md" alt="img">
                                </div>
                                <div class="align-items-center mt-2 text-black">
                                    <h5 class="mb-0">{{ $auth_user->basic_info->full_name }}</h5>
                                    <span class="w-2 h-2 brround bg-success d-inline-block"></span><span
                                        class="ms-2 fs-12">Online</span>
                                </div>
                            </div>
                        </div>
                        <!-- action-header end -->
                        <!-- msg_card_body -->
                        <div class="card-body msg_card_body" id="Order-Messages">

                        </div>
                        <!-- msg_card_body end -->
                        <!-- card-footer -->
                        <div class="card-footer">
                            <form data-action="{{ route('Post.Message') }}" method="POST"
                                enctype="multipart/form-data" id="Chat-Form">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $Content_Order->id }}">
                                <input type="hidden" name="user_id"
                                    value="{{ Auth::guard('Authorized')->user()->id }}">
                                <input type="hidden" name="is_executive" value="1">
                                <div class="msb-reply-button d-flex mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-white"
                                            placeholder="Typing...." name="Chat_Message" required>
                                        <div class="input-group-append ">
                                            <button type="submit" class="btn btn-primary ">
                                                <span class="feather feather-send"></span> Send
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="msb-reply-button d-flex">
                                    <div class="input-group">
                                        <input type="file" class="form-control bg-white"
                                            placeholder="Any Attachments" name="files[]" multiple>
                                    </div>
                                </div>
                            </form>
                        </div><!-- card-footer end -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header  border-0">
                    <div class="card-title">Order Details</div>
                </div>
                <div class="card-body pt-2 ps-3 pr-3">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="w-50">Order ID </span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span class="font-weight-semibold">{{ $Content_Order->Order_ID }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Industry</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Industry_Name }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Words</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Word_Count }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Writing Style</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Writing_Style }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Preferred Voice</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Preferred_Voice }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Target Audience</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Target_Audience }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Target Gender</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Target_Gender }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Free Image</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Free_Image }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Generic Type</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Generic_Type }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Keywords</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Keywords }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Meta Description</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Meta_Description }}</span>
                                    </td>
                                </tr>
                                  <tr>
                                    <td>
                                        <span class="w-50">Preferred Language</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $Content_Order->content_info->Preferred_Language ?? '' }}</span>
                                    </td>
                                </tr>
                                @if (!empty($Content_Order->reference_info->Reference_Code))
                                    <tr>
                                        <td>
                                            <span class="w-50">Reference</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold">{{ $Content_Order->reference_info->Reference_Code }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->F_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">First Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->F_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->S_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Second Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->S_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->T_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Third Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->T_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Four_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Fourth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Four_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Fifth_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Fifth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Fifth_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Sixth_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Sixth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Sixth_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Seven_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Seventh Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Seven_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->Eight_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Eighth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->Eight_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->nine_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Ninth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->nine_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->ten_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Tenth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->ten_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->eleven_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Eleventh Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->eleven_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->twelve_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Twelfth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->twelve_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->thirteen_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Thirteenth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->thirteen_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->fourteen_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Fourteenth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->fourteen_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($Content_Order->submission_info->fifteen_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Fifteenth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->fifteen_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif

                                <tr>
                                    <td>
                                        <span class="w-50">Final Deadline</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->DeadLine }}</span>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Final Deadline</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold text-danger">{{ $Content_Order->submission_info->DeadLine_Time }}</span>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Status</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold text-info">{{ $Content_Order->content_info->Order_Status }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Created Date</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ date('F d, Y', strtotime($Content_Order->created_at)) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="w-50">Created Time</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ date('H:i:s A', strtotime($Content_Order->created_at)) }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endif
<!-- Final Submission Modal -->
<div class="modal fade" id="FinalSubmissionModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('Content.Order.Final.Submit') }}" method="POST"
                class="needs-validation was-validated" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Final Submission For Current Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="order_id" value="{{ $Content_Order->id }}">
                        <input type="hidden" name="Order_ID" value="{{ $Order_ID }}">
                        <input type="hidden" name="submit_by"
                            value="{{ Auth::guard('Authorized')->user()->id }}">
                        <input type="hidden" name="user_id"
                            value="{{ Auth::guard('Authorized')->user()->id }}">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="form-label" class="form-label"></label>
                                <input class="form-control" type="file" name="files[]" multiple>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block">Upload Final Submission</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="uploaddraft">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('Order.Draft.Submit') }}" method="POST"
                class="needs-validation was-validated" enctype="multipart/form-data">

                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Draft Submission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="order_id" value="{{ $Content_Order->id }}">
                        <input type="hidden" name="Order_Number" value="{{ $Order_ID }}">
                        <input type="hidden" name="submit_by"
                            value="{{ Auth::guard('Authorized')->user()->id }}">
                        <input type="hidden" name="user_id"
                            value="{{ Auth::guard('Authorized')->user()->id }}">
                        <div class="col-lg-12">
                            <p class="text-danger">Please select the draft number from the dropdown that you are
                                submitting.</p>
                            <div class="form-group">
                                <label for="form-label" class="form-label"> Select Draft</label>
                                <select name="draft_number" id="draft_number" class="form-select" required>
                                    <option value="" disabled>Select Deadline</option>
                                    @if (!empty($Content_Order->submission_info->F_DeadLine))
                                        <option value="1">1st Draft</option>
                                    @endif
                                    @if (!empty($Content_Order->submission_info->S_DeadLine))
                                        <option value="2">2nd Draft</option>
                                    @endif
                                    @if (!empty($Content_Order->submission_info->T_DeadLine))
                                        <option value="3">3rd Draft</option>
                                    @endif
                                    @if (!empty($Content_Order->submission_info->Four_DeadLine))
                                        <option value="4">4th Draft</option>
                                    @endif
                                    @if (!empty($Content_Order->submission_info->Fifth_DeadLine))
                                        <option value="5">5th Draft</option>
                                    @endif
                                    @if (!empty($Content_Order->submission_info->Sixth_DeadLine))
                                        <option value="6">6th Draft</option>
                                    @endif
                                    @if (!empty($Content_Order->submission_info->Seven_DeadLine))
                                        <option value="7">7th Draft</option>
                                    @endif
                                    @if (!empty($Content_Order->submission_info->Eight_DeadLine))
                                        <option value="8">8th Draft</option>
                                    @endif
                                    @if (!empty($Content_Order->submission_info->nine_DeadLine))
                                        <option value="9">9th Draft</option>
                                    @endif
                                    @if (!empty($Content_Order->submission_info->ten_DeadLine))
                                        <option value="10">10th Draft</option>
                                    @endif
                                    @if (!empty($Content_Order->submission_info->eleven_DeadLine))
                                        <option value="11">11th Draft</option>
                                    @endif
                                    @if (!empty($Content_Order->submission_info->twelve_DeadLine))
                                        <option value="12">12th Draft</option>
                                    @endif
                                    @if (!empty($Content_Order->submission_info->thirteen_DeadLine))
                                        <option value="13">13th Draft</option>
                                    @endif
                                    @if (!empty($Content_Order->submission_info->fourteen_DeadLine))
                                        <option value="14">14th Draft</option>
                                    @endif
                                    @if (!empty($Content_Order->submission_info->fifteen_DeadLine))
                                        <option value="15">15th Draft</option>
                                    @endif


                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="form-label" class="form-label"></label>
                                <input class="form-control" type="file" name="files[]" multiple>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block">Upload Draft Submission</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="ViewRevision">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="" method="POST" class="needs-validation was-validated"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">View Revision Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="order_id" value="">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="form-label" class="form-label"></label>
                                <div class="p-2">
                                    <h4>Order Description</h4>
                                    <p id="revision_details"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-5">
                            <label class="form-label">DeadLine</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="feather feather-calendar"></i>
                                    </div>
                                </div>
                                <input class="form-control" id="Order_Deadline_Date" name="DeadLine"
                                    type="text" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 mt-5">
                            <label class="form-label">DeadLine Time</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="feather feather-clock"></span>
                                    </div>
                                </div><!-- input-group-prepend -->
                                <input class="form-control Order-Time" placeholder="Set time" name="DeadLine_Time"
                                    type="time" id="Order_Deadline_Time" required readonly>
                            </div><!-- input-group -->
                        </div>

                        <div class="col-md-6 mt-5">
                            <div class="form-group">
                                <label class="form-label">Additional Words</label>
                                <input class="form-control mb-4 is-valid" name="Order_Words"
                                    placeholder="Enter Order Words" id="Show_Order_Revision_Words" min="0"
                                    type="number" required readonly>
                            </div>
                        </div>
                        <div class="table-responsive mt-5">
                            <h4 class="my-4">Upload by Sales</h4>
                            <table class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                id="Revision_view_table">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-center w-5">No</th>
                                        <th class="border-bottom-0">File Name</th>
                                        <th class="border-bottom-0">Download File</th>
                                    </tr>
                                </thead>
                                <tbody>



                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive mt-5">
                            <h4 class="my-4">Upload by Writer</h4>
                            <table class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                id="Writer_Submission_view_table">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-center w-5">No</th>
                                        <th class="border-bottom-0">File Name</th>
                                        <th class="border-bottom-0">Upload By</th>
                                        <th class="border-bottom-0">Download File</th>
                                    </tr>
                                </thead>
                                <tbody>



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="SubmitRevision">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('Submit.Upload.Content.Revision') }}" method="POST"
                class="needs-validation was-validated" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Upload Revision</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="hidden_Revision_ID" name="Revision_ID" value="">
                        <input type="hidden" name="upload_by"
                            value="{{ Auth::guard('Authorized')->user()->id }}">
                        <input type="hidden" name="Order_ID" value="{{ $Content_Order->id }}">
                        <input type="hidden" name="Order_Number" value="{{ $Content_Order->Order_ID }}">

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="form-label" class="form-label"></label>
                                <input class="form-control" type="file" name="files[]" multiple>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-block add-btn-loader">Submit Revision
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="EditRevision">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('Update.Content.Revision.Order') }}" method="POST"
                class="needs-validation was-validated" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Edit Revision Deatils</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="Revision_id" value="" id="Edit_Revision_ID">
                        <input type="hidden" name="Order_ID" id="Edit_Revision_Order_ID" value="">
                        <input type="hidden" name="revised_by"
                            value="{{ Auth::guard('Authorized')->user()->id }}">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="form-label" class="form-label text-danger">The text area for the
                                    revision description must be filled; otherwise, it will throw an error.</label>
                                <textarea id="summernote2" class="form-control mb-4 is-invalid state-invalid" name="Order_Revision"
                                    placeholder="Textarea (invalid state)" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">DeadLine</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="feather feather-calendar"></i>
                                    </div>
                                </div>
                                <input class="form-control Order-DeadLine" id="Edit_Revision_Date"
                                    placeholder="MM/DD/YYYY" name="DeadLine" type="date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">DeadLine Time</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="feather feather-clock"></span>
                                    </div>
                                </div><!-- input-group-prepend -->
                                <input class="form-control Order-Time" id="Edit_Revision_Time"
                                    placeholder="Set time" name="DeadLine_Time" type="time" required>
                            </div><!-- input-group -->
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Additional Words</label>
                                <input class="form-control mb-4 is-valid" name="Order_Words"
                                    placeholder="Enter Order Words" id="Order_Revision_Words" min="0"
                                    type="number" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="form-label" class="form-label"></label>
                                <input class="form-control" type="file" name="files[]" multiple>
                            </div>
                        </div>

                        <div class="table-responsive mt-5">
                            <h4 class="my-4">Revision Attachment</h4>
                            <table class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
                                id="Edit_Sales_Revision">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-center w-5">No</th>
                                        <th class="border-bottom-0">File Name</th>

                                        <th class="border-bottom-0">Download File</th>
                                        <th class="border-bottom-0">Delete File</th>
                                    </tr>
                                </thead>
                                <tbody>



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block">Upload Revision</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function confirmCancelOrder(url) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'This action will cancel the order!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, cancel it!',
            cancelButtonText: 'No, cancel!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            } else {
                Swal.fire('Cancelled', 'Order cancellation cancelled', 'info');
            }
        });
    }

    $(document).ready(function() {


        $(".Upload_Revision_ID").click(function() {
            var Revision_ID = $(this).data("id");
            console.log(Revision_ID);

            $("#hidden_Revision_ID").val(Revision_ID);
        });

        $(".Order-Revision-view").click(function() {
            var Revision_ID = $(this).data("id");
            $("#Revision_view_table tbody").html("");
            $("#Writer_Submission_view_table tbody").html("");
            $("#Order_Deadline_Time").val("");
            $("#Order_Deadline_Date").val("");
            $("#revision_details").html("");

            $.ajax({
                url: "{{ route('Get.Revision.Deatils.Attachment') }}",
                type: "GET",
                data: {
                    Revision_ID: Revision_ID,
                },
                dataType: "json",
                success: function(data) {
                    $("#Revision_view_table").append(data.SalesTableHtml);
                    $("#Writer_Submission_view_table").append(data.WriterAttachment);
                    $("#Show_Order_Revision_Words").val(data.send_Revision_word);
                    $("#Order_Deadline_Time").val(data.Revision_deadline_Time);
                    $("#Order_Deadline_Date").val(data.Revision_deadline_Date);
                    $("#revision_details").append(data.Revision_Description);
                },

                error: function(xhr) {
                    var errorMessage = xhr.responseText;
                    console.log("Error message:", errorMessage);
                },
            });
        });
        $('.edit-Revision').click(function() {

            var Edit_Revision_ID = $(this).data('id');
            console.log(Edit_Revision_ID);
            $('#Edit_Sales_Revision').html('');
            $('#summernote2').summernote('code', '');


            $.ajax({
                url: '{{ route('Get.Revision.Data') }}',
                type: 'GET',
                data: {

                    'Revision_ID': Edit_Revision_ID // Use a colon (:) here, not an equal sign (=)
                },
                dataType: 'json', // Specify the expected data type

                success: function(data) {

                    console.log(data.Order_Revision_Words);

                    var date = new Date(data.Order_Deadline_Date);
                    var formattedDate = date.getFullYear() + "-" + ("0" + (date.getMonth() +
                        1)).slice(-2) + "-" + ("0" + date.getDate()).slice(-2);

                    $('#Edit_Revision_ID').val(data.Revision_ID);
                    $('#Edit_Revision_Order_ID').val(data.Order_ID);
                    $('#Order_Revision_Words').val(data.Order_Revision_Words);
                    $('#summernote2').summernote('code', data.Order_description);
                    $('#Edit_Revision_Date').val(formattedDate);
                    $('#Edit_Revision_Time').val(data.Order_Deadline_Time);
                    $('#Edit_Sales_Revision').append(data.salesAttachment);

                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                }
            });
        });
        $('.Order-Revision').on('click', function() {
            const getOrder_ID = $(this).find('#Order_ID').val();

            $.ajax({
                url: '{{ route('Get.Order.Rev.Info') }}',
                type: 'GET',
                data: {
                    'Order_ID': getOrder_ID
                },
                success: function(data) {

                    $('.Order-DeadLine').val(data.Selected_Date);
                    $('.Order-Time').val(data.Selected_Time);
                    $('.Order-Words').val(0);
                },
                error: function(data) {

                }
            });
        });

        $('#summernote2').summernote({
            height: 300,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                ['para', ['ul', 'ol']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview']],
            ],
            callbacks: {
                onInit: function() {
                    console.log('Summernote initialized');
                },
                onChange: function(contents, $editable) {
                    console.log('Content changed:', contents);
                },
            },
        });

        $('.ChangeContentWriter').on('click', function() {
            const getOrder_ID = $(this).find('.order_id').val();
            const getUser_ID = $(this).find('.user_id').val();

            $.ajax({
                url: '{{ route('Get.Content.Writer.Info') }}',
                type: 'GET',
                data: {
                    'Order_ID': getOrder_ID,
                    'User_ID': getUser_ID,
                },
                success: function(data) {
                    $('.get_order_id').val(data.Order_ID);
                    $('.get_user_id').val(data.Assign_ID);
                    $('#W_Assign_ID').val(data.Assign_ID).trigger('change');
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        $('.RemoveContentWriter').on('click', function() {
            const getOrder_ID = $(this).find('.order_id').val();
            const getUser_ID = $(this).find('.user_id').val();

            $.ajax({
                url: '{{ route('Get.Content.Writer.Info') }}',
                type: 'GET',
                data: {
                    'Order_ID': getOrder_ID,
                    'User_ID': getUser_ID,
                },
                success: function(data) {
                    $('.get_order_id').val(data.Order_ID);
                    $('.get_user_id').val(data.Assign_ID);
                    $('.W_Assign_ID').val(data.Assign_ID).trigger('change');
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        $('.Order-Revision').on('click', function() {
            const getOrder_ID = $(this).find('#Order_ID').val();

            $.ajax({
                url: '{{ route('Get.Order.Rev.Info') }}',
                type: 'GET',
                data: {
                    'Order_ID': getOrder_ID
                },
                success: function(data) {
                    $('.Order-DeadLine').val(data.Selected_Date);
                    $('.Order-Time').val(data.Selected_Time);
                    $('.Order-Words').val(0);
                },
                error: function(data) {
                    console.log(data.responseJSON);
                }
            });
        });

        var form = '#Chat-Form';

        $(form).on('submit', function(event) {
            event.preventDefault();

            var submitButton = $(form).find('button[type="submit"]');
            submitButton.addClass('btn-loading');
            submitButton.html('<span class="px-3">&nbsp;</span>');

            var url = $(this).attr('data-action');
            var div = document.getElementById('Order-Messages');

            $.ajax({
                url: url,
                method: 'POST',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    $(form).trigger("reset");
                    div.scrollTop = div.scrollHeight;
                    submitButton.removeClass('btn-loading');
                    submitButton.html('<span class="feather feather-send"></span> Send');
                },
                error: function(response) {
                    alert(response);
                }
            });
        });

        $(document).on('click', '.parent-container .Message_Forward', function() {
            const Msg_ID = $(this).find('input.Msg_ID').val();

            $.ajax({
                url: '{{ route('Forward.To.Executive') }}',
                type: 'GET',
                data: {
                    'Msg_ID': Msg_ID
                },
                success: function(data) {
                    console.log(data);
                    sendRequest(Order_ID);
                },
                error: function(data) {
                    alert(data.responseJSON);
                }
            });
        });

        // Get All Order Messages
        const Order_ID = {{ $Content_Order->id }};

        setInterval(function() {
            sendRequest(Order_ID);
        }, 1000);

        function sendRequest(Order_ID) {
            $.ajax({
                url: '{{ route('Get.Messages') }}',
                type: 'GET',
                data: {
                    'Order_ID': Order_ID
                },
                success: function(data) {
                    $('#Order-Messages').html(data);
                }
            });
        }

        document.addEventListener('submit', function(event) {
            var submitButton = document.querySelector('.add-btn-loader');
            submitButton.disabled = true;
            submitButton.classList.add('btn-loading');
        });
    });
</script>
