@if(in_array($auth_user->Role_ID, [1, 9, 10, 11, 16]))

<style>
    .msg_card_body {
        background: url({{ asset('assets/images/pattern2.png') }}) !important;
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
<div class="page-header d-xl-flex d-block">
    <div class="page-rightheader ms-md-auto">
        <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
            <div class="btn-list">
                @if ((int) $auth_user->Role_ID != 16)
                    <div class="dropdown">
                        <button class="btn btn-info dropdown-toggle px-5" data-bs-toggle="dropdown">
                            <i class="fe fe-activity me-2"></i>Actions
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item Order-Revision" href="JavaScript:void(0);" data-bs-toggle="modal"
                                data-bs-target="#TaskRevisionModal">Add Revision
                                <input type="hidden" id="Order_ID" value=""></a>

                            @if ((int) in_array($auth_user->Role_ID, [1, 9]))
                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal"
                                    data-bs-target="#AssignModal">Assign Order</a>
                            @endif
                            <a class="dropdown-item"
                                href="{{ route('Design.Order.edit', ['Order_ID' => $DesignOrder->Order_ID]) }}">Edit
                                Order</a>
                            <a class="dropdown-item" href="javascript:void(0);"
                                onclick="confirmCancelOrder('{{ route('cancle.design.order', ['Order_ID' => $DesignOrder->id]) }}')">
                                Cancel Order
                            </a>
                            <a class="dropdown-item"
                                href="{{ route('delete.design.order', ['Order_ID' => $DesignOrder->id]) }}">Delete
                                Order</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-9 col-md-12 col-lg-12">
        <div class="tab-menu-heading hremp-tabs p-0 ">
            <div class="tabs-menu1">
                <ul class="nav panel-tabs">
                    <li class="ms-4"><a href="#tab5" class="active" data-bs-toggle="tab">Order Description</a>
                    </li>
                    <li><a href="#tab7" data-bs-toggle="tab">Order Attachments</a></li>

                    <li><a href="#tab10" data-bs-toggle="tab">Final Submission</a></li>

                    <li><a href="#tab12" data-bs-toggle="tab">Draft Submission</a></li>

                    <li><a href="#tab11" data-bs-toggle="tab">Order Revisions</a></li>
                </ul>
            </div>
        </div>
        <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
            <div class="tab-content">
                <div class="tab-pane active" id="tab5">
                    <div class="card-body">
                        {!! $DesignOrder->order_desc->Description !!}
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
                                    @forelse ($DesignOrder->attachments as $attachment)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="" target="_blank" download
                                                    class="font-weight-semibold fs-14 mt-5">
                                                    {{ $attachment->File_Name }} <br>
                                                    <span class="text-muted ms-2">(23 KB)</span>
                                                </a>
                                                <div class="clearfix"></div>
                                                <small class="text-muted"></small>
                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ asset($attachment->order_attachment_path) }}"
                                                        class="action-btns1" data-bs-toggle="tooltip" download
                                                        data-bs-placement="top" title="Download" target="_blank">
                                                        <i class="feather feather-download text-success"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">No Attachment Found</td>
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


                                    <tr>
                                        <td class="text-center"></td>
                                        <td>
                                            <a href="" target="_blank" download
                                                class="font-weight-semibold fs-14 mt-5">
                                                <span class="text-muted ms-2">(23 KB)</span></a>
                                            <div class="clearfix"></div>
                                            <small class="text-muted"> -
                                                Submitted
                                                By
                                            </small>
                                        </td>

                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="" class="action-btns1" data-bs-toggle="tooltip" download
                                                    data-bs-placement="top" title="Download" target="_blank"><i
                                                        class="feather feather-download   text-success"></i></a>
                                            </div>
                                        </td>
                                    </tr>
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
                                    @forelse($DesignOrder->final_submission as $submission)
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
                @if (!empty($DesignOrder->revision))
                    <div class="tab-pane" id="tab11">

                        <div class="card-body">
                            <div class="d-flex justify-content-end">

                            </div>
                            <div class="table-responsive">
                                <table class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
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
                                        @foreach ($DesignOrder->revision as $revision)
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
                                                                    id="Revision_ID" data-id="{{ $revision->id }}"
                                                                    href="JavaScript:void(0);" data-bs-toggle="modal"
                                                                    data-bs-target="#ViewRevision">View
                                                                    Revision</a>

                                                                @if ((int) $auth_user->Role_ID != 16)
                                                                    <a class="dropdown-item edit-Revision"
                                                                        data-id="{{ $revision->id }}"
                                                                        href="JavaScript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#EditRevision">Edit
                                                                        Revision</a>
                                                                @endif
                                                                <a class="dropdown-item Order-Revision Upload_Revision_ID"
                                                                    data-id="{{ $revision->id }}"
                                                                    href="JavaScript:void(0);" data-bs-toggle="modal"
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
                <div class="tab-pane" id="tab12">
                    <div class="card-body">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-danger mb-4" data-bs-toggle="modal"
                                data-bs-target="#uploaddraft"> Upload Draft
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-center table-vcenter text-nowrap table-bordered border-bottom"
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
                                    @foreach ($DesignOrder->draftSubmissions as $submission)
                                        @forelse ($submission->attachments as $attachment)
                                            <tr>
                                                <td class="text-center">{{ $c }}</td>
                                                <td>
                                                    <a href="{{ asset($attachment->File_Path) }}" target="_blank"
                                                        download class="font-weight-semibold fs-14 mt-5">
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
                                                            download="" data-bs-placement="top" title=""
                                                            target="_blank" data-bs-original-title="Download"
                                                            aria-label="Download">
                                                            <i class="feather feather-download text-success"></i>
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
                                <h5 class="mb-0"> {{ Auth::guard('Authorized')->user()->full_name }}</h5>


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
                        <form data-action="{{ route('Post.Message') }}" method="POST" enctype="multipart/form-data"
                            id="Design-Chat-Form">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $DesignOrder->id }}">
                            <input type="hidden" name="user_id"
                                value="{{ Auth::guard('Authorized')->user()->id }}">
                            <div class="msb-reply-button d-flex mb-3">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-white" placeholder="Typing...."
                                        name="Chat_Message" required>
                                    <div class="input-group-append ">
                                        <button type="submit" class="btn btn-primary">
                                            <span class="feather feather-send"></span> Send
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="msb-reply-button d-flex">
                                <div class="input-group">
                                    <input type="file" class="form-control bg-white" placeholder="Any Attachments"
                                        name="files[]" multiple>
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
                                    <span class="font-weight-semibold">{{ $DesignOrder->Order_ID }}</span>
                                </td>
                            </tr>
                            
                                 @if ($auth_user->Role_ID != 16)
                                    <tr>
                                        <td>
                                            <span class="w-50">Order Website</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold">{{ $DesignOrder->design_info->website_order ?? '' }}</span>
                                        </td>
                                    </tr>
                                @endif
                            @if (!empty($DesignOrder->design_info->project_service))
                                <tr>
                                    <td>
                                        <span class="w-50">Order Service</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $DesignOrder->design_info->project_service == 1 ? 'Graphic Desigining' : 'video Editing' }}</span>
                                    </td>
                                </tr>
                            @endif
                            @if (!empty($DesignOrder->design_info->primary_color_palette))
                                <tr>
                                    <td>
                                        <span class="w-50">Primary Color Palette</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $DesignOrder->design_info->primary_color_palette }}</span>
                                    </td>
                                </tr>
                            @endif
                            @if (!empty($DesignOrder->design_info->secondary_Color_palette))
                                <tr>
                                    <td>
                                        <span class="w-50">Secondary Color Palette</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $DesignOrder->design_info->secondary_Color_palette }}</span>
                                    </td>
                                </tr>
                            @endif
                            @if (!empty($DesignOrder->design_info->font_name))
                                <tr>
                                    <td>
                                        <span class="w-50">Font Name</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $DesignOrder->design_info->font_name }}</span>
                                    </td>
                                </tr>
                            @endif
                            @if (!empty($DesignOrder->design_info->size_of_design))
                                <tr>
                                    <td>
                                        <span class="w-50">Size Of Design</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $DesignOrder->design_info->size_of_design }}</span>
                                    </td>
                                </tr>
                            @endif
                            @if (!empty($DesignOrder->design_info->delivery_formate))
                                <tr>
                                    <td>
                                        <span class="w-50">Delivery Formate</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $DesignOrder->design_info->delivery_formate }}</span>
                                    </td>
                                </tr>
                            @endif
                            @if (!empty($DesignOrder->design_info->source_file))
                                <tr>
                                    <td>
                                        <span class="w-50">Source File</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $DesignOrder->design_info->source_file }}</span>
                                    </td>
                                </tr>
                            @endif
                            @if (!empty($DesignOrder->design_info->video_type))
                                <tr>
                                    <td>
                                        <span class="w-50">Video Type</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $DesignOrder->design_info->video_type }}</span>
                                    </td>
                                </tr>
                            @endif
                            @if (!empty($DesignOrder->reference_info->Reference_Code))
                                <tr>
                                    <td>
                                        <span class="w-50">Reference</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $DesignOrder->reference_info->Reference_Code }}</span>
                                    </td>
                                </tr>
                            @endif
                            @if ($auth_user->Role_ID == 16)
                                @foreach ($DesignOrder->assign_dead_lines as $assign_dead_line)
                                    @if (!empty($assign_dead_line->first_draft))
                                        <tr>
                                            <td>
                                                <span class="w-50">First Draft</span>
                                            </td>
                                            <td>:</td>
                                            <td>
                                                <span
                                                    class="font-weight-semibold text-danger">{{ $assign_dead_line->first_draft }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($assign_dead_line->second_draft))
                                        <tr>
                                            <td>
                                                <span class="w-50">Second Draft</span>
                                            </td>
                                            <td>:</td>
                                            <td>
                                                <span
                                                    class="font-weight-semibold text-danger">{{ $assign_dead_line->second_draft }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($assign_dead_line->third_draft))
                                        <tr>
                                            <td>
                                                <span class="w-50">Third Draft</span>
                                            </td>
                                            <td>:</td>
                                            <td>
                                                <span
                                                    class="font-weight-semibold text-danger">{{ $assign_dead_line->third_draft }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($assign_dead_line->forth_draft))
                                        <tr>
                                            <td>
                                                <span class="w-50">Fourth Draft</span>
                                            </td>
                                            <td>:</td>
                                            <td>
                                                <span
                                                    class="font-weight-semibold text-danger">{{ $assign_dead_line->forth_draft }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($assign_dead_line->fifth_draft))
                                        <tr>
                                            <td>
                                                <span class="w-50">Fifth Draft</span>
                                            </td>
                                            <td>:</td>
                                            <td>
                                                <span
                                                    class="font-weight-semibold text-danger">{{ $assign_dead_line->fifth_draft }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($assign_dead_line->sixth_draft))
                                        <tr>
                                            <td>
                                                <span class="w-50">Sixth Draft</span>
                                            </td>
                                            <td>:</td>
                                            <td>
                                                <span
                                                    class="font-weight-semibold text-danger">{{ $assign_dead_line->sixth_draft }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($assign_dead_line->seventh_draft))
                                        <tr>
                                            <td>
                                                <span class="w-50">Seventh Draft</span>
                                            </td>
                                            <td>:</td>
                                            <td>
                                                <span
                                                    class="font-weight-semibold text-danger">{{ $assign_dead_line->seventh_draft }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($assign_dead_line->eighth_draft))
                                        <tr>
                                            <td>
                                                <span class="w-50">Eighth Draft</span>
                                            </td>
                                            <td>:</td>
                                            <td>
                                                <span
                                                    class="font-weight-semibold text-danger">{{ $assign_dead_line->eighth_draft }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($assign_dead_line->nineth_draft))
                                        <tr>
                                            <td>
                                                <span class="w-50">Ninth Draft</span>
                                            </td>
                                            <td>:</td>
                                            <td>
                                                <span
                                                    class="font-weight-semibold text-danger">{{ $assign_dead_line->nineth_draft }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($assign_dead_line->tenth_draft))
                                        <tr>
                                            <td>
                                                <span class="w-50">Tenth Draft</span>
                                            </td>
                                            <td>:</td>
                                            <td>
                                                <span
                                                    class="font-weight-semibold text-danger">{{ $assign_dead_line->tenth_draft }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($assign_dead_line->eleventh_draft))
                                        <tr>
                                            <td>
                                                <span class="w-50">Eleventh Draft</span>
                                            </td>
                                            <td>:</td>
                                            <td>
                                                <span
                                                    class="font-weight-semibold text-danger">{{ $assign_dead_line->eleventh_draft }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($assign_dead_line->twelveth_draft))
                                        <tr>
                                            <td>
                                                <span class="w-50">Twelfth Draft</span>
                                            </td>
                                            <td>:</td>
                                            <td>
                                                <span
                                                    class="font-weight-semibold text-danger">{{ $assign_dead_line->twelveth_draft }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($assign_dead_line->thirteen_draft))
                                        <tr>
                                            <td>
                                                <span class="w-50">Thirteenth Draft</span>
                                            </td>
                                            <td>:</td>
                                            <td>
                                                <span
                                                    class="font-weight-semibold text-danger">{{ $assign_dead_line->thirteen_draft }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($assign_dead_line->fourteen_draft))
                                        <tr>
                                            <td>
                                                <span class="w-50">Fourteenth Draft</span>
                                            </td>
                                            <td>:</td>
                                            <td>
                                                <span
                                                    class="font-weight-semibold text-danger">{{ $assign_dead_line->fourteen_draft }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($assign_dead_line->fifteen_draft))
                                        <tr>
                                            <td>
                                                <span class="w-50">Fifteenth Draft</span>
                                            </td>
                                            <td>:</td>
                                            <td>
                                                <span
                                                    class="font-weight-semibold text-danger">{{ $assign_dead_line->fifteen_draft }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($assign_dead_line->deadline_date))
                                        <tr>
                                            <td>
                                                <span class="w-50">Final Deadline</span>
                                            </td>
                                            <td>:</td>
                                            <td>
                                                <span
                                                    class="font-weight-semibold text-danger">{{ $assign_dead_line->deadline_date }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($assign_dead_line->deadline_time))
                                        <tr>
                                            <td>
                                                <span class="w-50">DeadLine Time</span>
                                            </td>
                                            <td>:</td>
                                            <td>
                                                <span
                                                    class="font-weight-semibold text-danger">{{ $assign_dead_line->deadline_time }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @else
                                @if (!empty($DesignOrder->submission_info->F_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">First Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $DesignOrder->submission_info->F_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($DesignOrder->submission_info->S_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Second Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $DesignOrder->submission_info->S_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($DesignOrder->submission_info->T_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Third Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $DesignOrder->submission_info->T_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($DesignOrder->submission_info->Four_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Fourth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $DesignOrder->submission_info->Four_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($DesignOrder->submission_info->Fifth_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Fifth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $DesignOrder->submission_info->Fifth_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($DesignOrder->submission_info->Sixth_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Sixth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $DesignOrder->submission_info->Sixth_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($DesignOrder->submission_info->Seven_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Seventh Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $DesignOrder->submission_info->Seven_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($DesignOrder->submission_info->Eight_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Eighth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $DesignOrder->submission_info->Eight_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($DesignOrder->submission_info->nine_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Ninth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $DesignOrder->submission_info->nine_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($DesignOrder->submission_info->ten_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Tenth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $DesignOrder->submission_info->ten_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($DesignOrder->submission_info->eleven_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Eleventh Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $DesignOrder->submission_info->eleven_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($DesignOrder->submission_info->twelve_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Twelfth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $DesignOrder->submission_info->twelve_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($DesignOrder->submission_info->thirteen_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Thirteenth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $DesignOrder->submission_info->thirteen_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($DesignOrder->submission_info->fourteen_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Fourteenth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $DesignOrder->submission_info->fourteen_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($DesignOrder->submission_info->fifteen_DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Fifteenth Draft</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $DesignOrder->submission_info->fifteen_DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($DesignOrder->submission_info->DeadLine))
                                    <tr>
                                        <td>
                                            <span class="w-50">Final Deadline</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $DesignOrder->submission_info->DeadLine }}</span>
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($DesignOrder->submission_info->DeadLine_Time))
                                    <tr>
                                        <td>
                                            <span class="w-50">DeadLine Time</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold text-danger">{{ $DesignOrder->submission_info->DeadLine_Time }}</span>
                                        </td>
                                    </tr>
                                @endif
                            @endif
                            @if (!empty($DesignOrder->design_info->order_status))
                                @php
                                    $status = '';
                                    if ($DesignOrder->design_info->order_status == 0) {
                                        $status = 'Working';
                                    } elseif ($DesignOrder->design_info->order_status == 1) {
                                        $status = 'Canceled';
                                    } elseif ($DesignOrder->design_info->order_status == 2) {
                                        $status = 'Completed';
                                    } elseif ($DesignOrder->design_info->order_status == 3) {
                                        $status = 'Revision';
                                    }
                                @endphp
                                <tr>
                                    <td>
                                        <span class="w-50">Status</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span class="font-weight-semibold text-danger">{{ $status }}</span>
                                    </td>
                                </tr>
                            @endif
                            @if (!empty($DesignOrder->created_at))
                                <tr>
                                    <td>
                                        <span class="w-50">Created Date</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $DesignOrder->created_at->format('Y-m-d') }}</span>
                                    </td>
                                </tr>
                            @endif
                            @if (!empty($DesignOrder->created_at))
                                <tr>
                                    <td>
                                        <span class="w-50">Created Time</span>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="font-weight-semibold">{{ $DesignOrder->created_at->format('H:i:s') }}</span>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        @if ((int) $auth_user->Role_ID != 16)

            <div class="card">
                <div class="card-header  border-0">
                    <div class="card-title">Sales Department</div>
                </div>
                <div class="card-body pt-2 ps-3 pr-3">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                @if ($DesignOrder->authorized_user->basic_info)
                                    <tr>
                                        <td>
                                            <span class="w-50">Create By</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold">{{ $DesignOrder->authorized_user->basic_info->F_Name . ' ' . $DesignOrder->authorized_user->basic_info->L_Name }}</span>
                                        </td>
                                    </tr>
                                @endif

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
                                @if (!empty($DesignOrder->client_info->Client_Name))
                                    <tr>
                                        <td>
                                            <span class="w-50">Name</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold">{{ $DesignOrder->client_info->Client_Name }}</span>
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($DesignOrder->client_info->Client_Country))
                                    <tr>
                                        <td>
                                            <span class="w-50">Country </span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold">{{ $DesignOrder->client_info->Client_Country }}</span>
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($DesignOrder->client_info->Client_Phone))
                                    <tr>
                                        <td>
                                            <span class="w-50">Phone</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold">{{ $DesignOrder->client_info->Client_Phone }}</span>
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($DesignOrder->client_info->Client_Email))
                                    <tr>
                                        <td>
                                            <span class="w-50">Email</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold">{{ $DesignOrder->client_info->Client_Email }}</span>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header  border-0">
                    <div class="card-title">Assiging Information</div>
                </div>
                <div class="card-body pt-2 ps-3 pr-3">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                @foreach ($DesignOrder->assign as $user)
                                    <tr>
                                        <td>
                                            <a href="javascript:void(0)" data-bs-target="#RemoveWriter"
                                                class="action-btns1 RemoveContentWriter" data-bs-toggle="modal"
                                                data-bs-placement="top" title="Remove Writer"><i
                                                    class="feather feather-trash text-danger"></i>
                                                <input type="hidden" class="order_id"
                                                    value="{{ $DesignOrder->Order_ID }}">
                                                <input type="hidden" class="user_id" value="{{ $user->id }}">
                                            </a>
                                            <a href="javascript:void(0)" data-bs-target="#ChangedWriter"
                                                class="action-btns1 ChangeContentWriter" data-bs-toggle="modal"
                                                data-bs-placement="top" title="Change Writer"><i
                                                    class="feather feather-repeat text-warning"></i>
                                                <input type="hidden" class="order_id"
                                                    value="{{ $DesignOrder->Order_ID }}">
                                                <input type="hidden" class="user_id" value="{{ $user->id }}">
                                            </a>
                                            <span class="w-50">{{ $user->designation->user_designations }}</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span
                                                class="font-weight-semibold">{{ $user->basic_info->F_Name . ' ' . $user->basic_info->L_Name }}</span>
                                        </td>
                                    </tr>
                                @endforeach
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
                                @if (!empty($DesignOrder->payment_info->Order_Price))
                                    <tr>
                                        <td>
                                            <span class="w-50">Order Price</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span class="font-weight-semibold">
                                                &nbsp; {{ $DesignOrder->payment_info->Order_Price }}</span>
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($DesignOrder->payment_info->Order_Price))
                                    <tr>
                                        <td>
                                            <span class="w-50">Payment Status</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span class="font-weight-semibold">
                                                {{ $DesignOrder->payment_info->Payment_Status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($DesignOrder->payment_info->Rec_Amount))
                                    <tr>
                                        <td>
                                            <span class="w-50">Receive Amount</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span class="font-weight-semibold">
                                                {{ $DesignOrder->payment_info->Rec_Amount }}
                                            </span>
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($DesignOrder->payment_info->Due_Amount))
                                    <tr>
                                        <td>
                                            <span class="w-50">Due Amout</span>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <span class="font-weight-semibold">
                                                {{ $DesignOrder->payment_info->Due_Amount }}</span>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        @endif
    </div>
</div>


<!-- Assign Modal -->
<div class="modal fade" id="AssignModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('Design.Assign.Order') }}" method="POST" class="needs-validation was-validated">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Assign Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="Order_ID" value="{{ $DesignOrder->Order_ID }}">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="Assign_ID">Designer & VideoEditor</label>
                                <select name="Assign_ID[]" id="Assign_ID" class="form-control select2"
                                    data-placeholder="Select Coordinator" multiple required>
                                    <option value="">Select User</option>
                                    @forelse($AssignUser as $User)
                                        <option value="{{ $User->id }}">{{ $User->basic_info->full_name }}
                                        </option>
                                    @empty
                                        <option value="">No User available</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-2">
                            <label class="form-label">DeadLine Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="feather feather-calendar"></span>
                                    </div>
                                </div>
                                <input class="form-control" placeholder="MM/DD/YYYY" name="DeadLine" required
                                    type="date">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-2">
                            <label class="form-label">DeadLine Time</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="feather feather-clock"></span>
                                    </div>
                                </div>
                                <!-- input-group-prepend -->
                                <input class="form-control" placeholder="Set time" name="DeadLine_Time"
                                    type="time" required>
                            </div>
                            <!-- input-group -->
                        </div>
                        <div class="col-lg-4 mb-2">
                            <label class="form-label">First Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="feather feather-calendar"></span>
                                    </div>
                                </div>
                                <input class="form-control" placeholder="MM/DD/YYYY" name="F_DeadLine"
                                    type="date">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-2">
                            <label class="form-label">Second Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="feather feather-calendar"></span>
                                    </div>
                                </div>
                                <input class="form-control" placeholder="MM/DD/YYYY" name="S_DeadLine"
                                    type="date">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-2">
                            <label class="form-label">Third Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="feather feather-calendar"></span>
                                    </div>
                                </div>
                                <input class="form-control" placeholder="MM/DD/YYYY" name="T_DeadLine"
                                    type="date">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3" id="4">
                            <label class="form-label">Fourth Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="feather feather-calendar"></span>
                                    </div>
                                </div>
                                <input class="form-control" placeholder="MM/DD/YYYY" name="Four_DeadLine"
                                    type="date">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3" id="5">
                            <label class="form-label">Fifth Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="feather feather-calendar"></span>
                                    </div>
                                </div>
                                <input class="form-control" placeholder="MM/DD/YYYY" name="Fifth_DeadLine"
                                    type="date">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3" id="6">
                            <label class="form-label">Sixth Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="feather feather-calendar"></span>
                                    </div>
                                </div>
                                <input class="form-control" placeholder="MM/DD/YYYY" name="Sixth_DeadLine"
                                    type="date">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3" id="7">
                            <label class="form-label">Seventh Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="feather feather-calendar"></span>
                                    </div>
                                </div>
                                <input class="form-control" placeholder="MM/DD/YYYY" name="Seven_DeadLine"
                                    type="date">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3" id="8">
                            <label class="form-label">Eight Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="feather feather-calendar"></span>
                                    </div>
                                </div>
                                <input class="form-control" placeholder="MM/DD/YYYY" name="Eight_DeadLine"
                                    type="date">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3" id="9">
                            <label class="form-label">Ninth Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="feather feather-calendar"></span>
                                    </div>
                                </div>
                                <input class="form-control" placeholder="MM/DD/YYYY" name="nine_DeadLine"
                                    type="date">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3" id="10">
                            <label class="form-label">Tenth Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="feather feather-calendar"></span>
                                    </div>
                                </div>
                                <input class="form-control" placeholder="MM/DD/YYYY" name="ten_DeadLine"
                                    type="date">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3" id="11">
                            <label class="form-label">Eleven Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="feather feather-calendar"></span>
                                    </div>
                                </div>
                                <input class="form-control" placeholder="MM/DD/YYYY" name="eleven_DeadLine"
                                    type="date">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3" id="12">
                            <label class="form-label">Twelve Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="feather feather-calendar"></span>
                                    </div>
                                </div>
                                <input class="form-control" placeholder="MM/DD/YYYY" name="twelve_DeadLine"
                                    type="date">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3" id="13">
                            <label class="form-label">Thirteen Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="feather feather-calendar"></span>
                                    </div>
                                </div>
                                <input class="form-control" placeholder="MM/DD/YYYY" name="thirteen_DeadLine"
                                    type="date">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3" id="14">
                            <label class="form-label">Fourteen Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="feather feather-calendar"></span>
                                    </div>
                                </div>
                                <input class="form-control" placeholder="MM/DD/YYYY" name="fourteen_DeadLine"
                                    type="date">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3" id="15">
                            <label class="form-label">Fifteen Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="feather feather-calendar"></span>
                                    </div>
                                </div>
                                <input class="form-control" placeholder="MM/DD/YYYY" name="fifteen_DeadLine"
                                    type="date">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3 mt-5">
                            <button class="btn btn-secondary" id="addNewDraft">
                                Add Draft
                            </button>
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

<div class="modal fade" id="FinalSubmissionModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('Design.final.Submission') }}" method="POST"
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
                        <input type="hidden" name="order_id" value="{{ $DesignOrder->id }}">
                        <input type="hidden" name="Order_ID" value="{{ $DesignOrder->Order_ID }}">
                        <input type="hidden" name="task_id" class="task-id">
                        <input type="hidden" name="submit_by" value="{{ Auth::guard('Authorized')->user()->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::guard('Authorized')->user()->id }}">
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
                        <input type="hidden" id="Order_ID" name="order_id" value="{{ $DesignOrder->Order_ID }}">
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
                                <input class="form-control" id="Order_Deadline_Date" name="DeadLine" type="text"
                                    readonly>
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
            <form action="{{ route('Submit.Upload.Order.Revision.Design') }}" method="POST"
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
                        <input type="hidden" name="upload_by" value="{{ Auth::guard('Authorized')->user()->id }}">
                        <input type="hidden" name="Order_ID" value="{{ $DesignOrder->id }}">
                        <input type="hidden" name="Order_Number" value="{{ $DesignOrder->Order_ID }}">

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="form-label" class="form-label"></label>
                                <input class="form-control" type="file" name="files[]" multiple>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-block">Submit Revision </button>
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
            <form action="{{ route('Update.Design.Revision.Order') }}" method="POST"
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
                                <input class="form-control Order-Time" id="Edit_Revision_Time" placeholder="Set time"
                                    name="DeadLine_Time" type="time" required>
                            </div><!-- input-group -->
                        </div>
                        <div class="col-lg-12 mt-5">
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
<!-- Change Writer Modal -->
<!-- <div class="modal fade" id="ChangedWriter">
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
                            <input type="hidden" name="Order_ID" value="">
                            <input type="hidden" name="order_id" class="get_order_id">
                            <input type="hidden" name="user_id" class="get_user_id">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="W_Assign_ID">Select Writers</label>
                                    <select name="W_Assign_ID" class="form-control custom-select select2"
                                        id="W_Assign_ID" data-placeholder="Select Writer" aria-required="true"
                                        required>
                                        <option value="">Select Writers</option>
                                        {{-- @forelse($Content_Writer_List as $Writer)
<option value="{{ $Writer->id }}">
                                                {{ $Writer->basic_info->full_name }}
                                            </option>
                                    @empty
@endforelse --}}
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
{{-- <div class="modal fade" id="RemoveWriter">
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
</div> --}}

<div class="modal fade" id="TaskRevisionModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('Design.Order.Revision') }}" method="POST"
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
                        <input type="hidden" name="order_id" value="{{ $DesignOrder->id }}">
                        <input type="hidden" name="Order_ID" value="{{ $DesignOrder->Order_ID }}">
                        <input type="hidden" name="revised_by"
                            value="{{ Auth::guard('Authorized')->user()->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::guard('Authorized')->user()->id }}">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="form-label" class="form-label text-danger">The text area for the revision
                                    description must be filled; otherwise, it will throw an error.</label>
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
                                <input class="form-control Order-DeadLine" placeholder="MM/DD/YYYY" name="DeadLine"
                                    type="date">
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
                        <div class="col-lg-12 mt-3">
                            <div class="form-group">
                                <label for="form-label" class="form-label"></label>
                                <input class="form-control" type="file" name="files[]" multiple>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block add-btn-loader">Upload Revision</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="uploaddraft">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('Design.draft.Submission') }}" method="POST"
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
                        <input type="hidden" name="order_id" value="{{ $DesignOrder->id }}">
                        <input type="hidden" name="Order_Number" value="{{ $DesignOrder->Order_ID }}">
                        <input type="hidden" name="submit_by" value="{{ Auth::guard('Authorized')->user()->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::guard('Authorized')->user()->id }}">
                        <div class="col-lg-12">
                            <p class="text-danger">Please select the draft number from the dropdown that you are
                                submitting.</p>
                            <div class="form-group">
                                <label for="form-label" class="form-label"> Select Draft</label>
                                <select name="draft_number" id="draft_number" class="form-select" required>
                                    <option value="" disabled>Select Deadline</option>
                                    @if (!empty($DesignOrder->submission_info->F_DeadLine))
                                        <option value="1">1st Draft</option>
                                    @endif
                                    @if (!empty($DesignOrder->submission_info->S_DeadLine))
                                        <option value="2">2nd Draft</option>
                                    @endif
                                    @if (!empty($DesignOrder->submission_info->T_DeadLine))
                                        <option value="3">3rd Draft</option>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    $(document).ready(function() {
        for (var i = 3; i <= 15; i++) {
            $('#' + i).hide();
        }
        var totalVal = 3;
        $('#addNewDraft').click(function(e) {
            e.preventDefault();
            totalVal++;
            $('#' + totalVal).show();
            if (totalVal === 15) {
                $('#addNewDraft').hide();
            }
        });
    });

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
</script>
@include('partials.design-order-custom-script');


@endif
