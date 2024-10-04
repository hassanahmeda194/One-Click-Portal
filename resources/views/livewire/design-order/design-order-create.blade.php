<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Desiging<span class="font-weight-normal text-muted ms-2"> Orders</span></h4>
    </div>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="mb-2">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card">
    <div class="card-header border-bottom-0">
        <h3 class="card-title">New Order Details</h3>
    </div>
    <div class="card-body pb-2">
        <form action="{{ route('post.create.design.order') }}" method="POST" class="needs-validation was-validated"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="Order_Type" value="3">
            <div class="row row-sm">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label">Order ID</label>
                        <input class="form-control mb-4" name="Order_ID" placeholder="Order ID" readonly type="text"
                            value="{{ $L_OID }}">
                    </div>
                </div>
                @if (!empty($Client_Info->Client_Code))
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-label">Client ID</label>
                            <input class="form-control mb-4" placeholder="Order ID" readonly type="text"
                                value="{{ $Client_Info->Client_Code }}">
                        </div>
                    </div>
                @endif
            </div>
            <h4 class="my-4">Client Information</h4>
            <div class="row row-sm mb-4">
                <input class="Client-Code" name="Client_Code" type="hidden"
                    value="{{ !empty($Client_Info->id) ? $Client_Info->id : null }}">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Client Name</label>
                        <input class="form-control mb-4 is-valid Get-Client typeahead Client_Name" id="myTypeahead"
                            name="Client_Name" placeholder="Client Name" type="text" required autocomplete="off"
                            value="{{ !empty($Client_Info->Client_Name) ? $Client_Info->Client_Name : null }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Client Country</label>
                        <select name="Client_Country"
                            class="form-control select2-show-search custom-select select2 Client_Country select2-hidden-accessible"
                            data-placeholder="Select Country" tabindex="-1" aria-hidden="true" required>
                            <option label="Select Country"></option>
                            @foreach ($Countries as $Country)
                                @if (!empty($Client_Info->Client_Country))
                                    <option @selected($Client_Info->Client_Country === $Country->name) value="{{ $Country->name }}">
                                        {{ $Country->name }}</option>
                                @else
                                    <option value="{{ $Country->name }}">{{ $Country->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Client Email</label>
                        <input class="form-control mb-4 is-valid Client_Email" name="Client_Email"
                            placeholder="Client Email" type="email"
                            value="{{ !empty($Client_Info->Client_Email) ? $Client_Info->Client_Email : null }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Client Phone</label>
                        <input class="form-control mb-4 is-valid Client_Phone" name="Client_Phone"
                            placeholder="Client Phone" type="text"
                            value="{{ !empty($Client_Info->Client_Phone) ? $Client_Info->Client_Phone : null }}">
                    </div>
                </div>
            </div>
            <h4 class="my-4">Order Information</h4>
            <div class="row row-sm mb-4">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label">Project Title</label>
                        <input class="form-control mb-4 is-valid" name="project_title" placeholder="Enter No. of Words"
                            type="text" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label">Service</label>
                        <select name="project_Service" id="Project-Service" class="form-control custom-select select2"
                            data-placeholder="Choose Service" required>
                            <option label="Select Project Service"></option>
                            <option value="1">Graphic Desiging</option>
                            <option value="2">Animation/Video Editing</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4" id="primary-color">
                    <div class="form-group">
                        <label class="form-label">Primary Color Palatte</label>
                        <input class="form-control mb-4 is-valid" name="Primary_Color_pelatte"
                            placeholder="Primary Color" type="text">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label">Website Order</label>
                        <select name="website_order" class="form-select">
                            @foreach ($Order_Websites as $website)
                                <option value="{{ $website->Website_Name }}">{{ $website->Website_Name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-4" id="secondary-color">
                    <div class="form-group">
                        <label class="form-label">Secondary Color Palatte</label>
                        <input class="form-control mb-4 is-valid" name="secondary_Color_pelatte"
                            placeholder="Secondary Color" type="text">
                    </div>
                </div>
                <div class="col-lg-4" id="font-size">
                    <div class="form-group">
                        <label class="form-label">Font Name</label>
                        <input class="form-control mb-4 is-valid" name="font_name" placeholder="Enter Font Name"
                            type="text">
                    </div>
                </div>
                <div class="col-lg-4" id="video-type">
                    <div class="form-group">
                        <label class="form-label">Video Type</label>
                        <select name="video_type" class="form-control custom-select select2"
                            data-placeholder="Select Video Type">
                            <option label="Video Type"></option>
                            <option value="2D explainer">2D explainer</option>
                            <option value="Video editing">Video editing</option>
                            <option value="Reel">Reel</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4" id="size-of-design">
                    <div class="form-group">
                        <label class="form-label">size of design</label>
                        <select name="size_of_design" class="form-control custom-select select2"
                            data-placeholder="Select Document Style">
                            <option label="Size Of Design"></option>
                            <option value="A4">A4</option>
                            <option value="A5">A5</option>
                            <option value="Letter">Letter</option>
                            <option value="Postcard Sizes">Postcard Sizes</option>
                            <option value="Square Sizes">Square Sizes</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4" id="">
                    <div class="form-group">
                        <label class="form-label">Delivery Formate</label>
                        <select name="delivery_formate" class="form-control custom-select select2"
                            data-placeholder="Select Document Style" required>
                            <option label="Select Spacing"></option>
                            <option value="JPEG">JPEG</option>
                            <option value="PNG">PNG</option>
                            <option value="GIF">GIF</option>
                            <option value="WebP">WebP</option>
                            <option value="SVG">SVG</option>
                            <option value="MP4">MP4</option>
                            <option value="PDF">PDF</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4" id="Source-Formate">
                    <div class="form-group">
                        <label class="form-label">Source File</label>
                        <select name="source_formate" class="form-control custom-select select2"
                            data-placeholder="Select Document Style" required>
                            <option label="Select Spacing"></option>
                            <option value="AI">AI</option>
                            <option value="PSD">PSD</option>
                            <option value="Ae">Ae</option>
                            <option value="INDD">INDD</option>
                            <option value="FLA">FLA</option>
                            <option value="SVG">CDR</option>
                            <option value="SVG">SVG</option>
                            <option value="AEP">AEP</option>
                            <option value="FCP">FCP</option>
                            <option value="ProTools">ProTools</option>
                            <option value="C4D">C4D</option>
                            <option value="Max">Max</option>
                            <option value="Blend">Blend</option>
                            <option value="Sketch">Sketch</option>
                            <option value="XD">XD</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label">Order Status</label>
                        <select name="Order_Status" class="form-control custom-select select2"
                            data-placeholder="Select Status" required>
                            <option label="Select Status"></option>
                            <option selected value="0">Working</option>
                            <option value="1">Canceled</option>
                            <option value="2">Completed</option>
                            <option value="3">Revision</option>
                        </select>
                    </div>
                </div>
            </div>
            <h4 class="my-4">Submission Date Information</h4>
            <div class="row row-sm mb-4">
                <div class="col-lg-3 mb-2">
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
                <div class="col-lg-3 mb-2">
                    <label class="form-label">DeadLine Time</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="feather feather-clock"></span>
                            </div>
                        </div>
                        <!-- input-group-prepend -->
                        <input class="form-control" placeholder="Set time" name="DeadLine_Time" type="time"
                            required>
                    </div>
                    <!-- input-group -->
                </div>
                <div class="col-lg-3 mb-2">
                    <label class="form-label">First Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="feather feather-calendar"></span>
                            </div>
                        </div>
                        <input class="form-control" placeholder="MM/DD/YYYY" name="F_DeadLine" type="date">
                    </div>
                </div>
                <div class="col-lg-3 mb-2">
                    <label class="form-label">Second Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="feather feather-calendar"></span>
                            </div>
                        </div>
                        <input class="form-control" placeholder="MM/DD/YYYY" name="S_DeadLine" type="date">
                    </div>
                </div>
                <div class="col-lg-3 mb-2">
                    <label class="form-label">Third Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="feather feather-calendar"></span>
                            </div>
                        </div>
                        <input class="form-control" placeholder="MM/DD/YYYY" name="T_DeadLine" type="date">
                    </div>
                </div>
                <div class="col-lg-3 mb-3" id="4">
                    <label class="form-label">Fourth Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="feather feather-calendar"></span>
                            </div>
                        </div>
                        <input class="form-control" placeholder="MM/DD/YYYY" name="Four_DeadLine" type="date">
                    </div>
                </div>
                <div class="col-lg-3 mb-3" id="5">
                    <label class="form-label">Fifth Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="feather feather-calendar"></span>
                            </div>
                        </div>
                        <input class="form-control" placeholder="MM/DD/YYYY" name="Fifth_DeadLine" type="date">
                    </div>
                </div>
                <div class="col-lg-3 mb-3" id="6">
                    <label class="form-label">Sixth Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="feather feather-calendar"></span>
                            </div>
                        </div>
                        <input class="form-control" placeholder="MM/DD/YYYY" name="Sixth_DeadLine" type="date">
                    </div>
                </div>
                <div class="col-lg-3 mb-3" id="7">
                    <label class="form-label">Seventh Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="feather feather-calendar"></span>
                            </div>
                        </div>
                        <input class="form-control" placeholder="MM/DD/YYYY" name="Seven_DeadLine" type="date">
                    </div>
                </div>
                <div class="col-lg-3 mb-3" id="8">
                    <label class="form-label">Eight Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="feather feather-calendar"></span>
                            </div>
                        </div>
                        <input class="form-control" placeholder="MM/DD/YYYY" name="Eight_DeadLine" type="date">
                    </div>
                </div>
                <div class="col-lg-3 mb-3" id="9">
                    <label class="form-label">Ninth Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="feather feather-calendar"></span>
                            </div>
                        </div>
                        <input class="form-control" placeholder="MM/DD/YYYY" name="nine_DeadLine" type="date">
                    </div>
                </div>
                <div class="col-lg-3 mb-3" id="10">
                    <label class="form-label">Tenth Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="feather feather-calendar"></span>
                            </div>
                        </div>
                        <input class="form-control" placeholder="MM/DD/YYYY" name="ten_DeadLine" type="date">
                    </div>
                </div>
                <div class="col-lg-3 mb-3" id="11">
                    <label class="form-label">Eleven Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="feather feather-calendar"></span>
                            </div>
                        </div>
                        <input class="form-control" placeholder="MM/DD/YYYY" name="eleven_DeadLine" type="date">
                    </div>
                </div>
                <div class="col-lg-3 mb-3" id="12">
                    <label class="form-label">Twelve Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="feather feather-calendar"></span>
                            </div>
                        </div>
                        <input class="form-control" placeholder="MM/DD/YYYY" name="twelve_DeadLine" type="date">
                    </div>
                </div>
                <div class="col-lg-3 mb-3" id="13">
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
                <div class="col-lg-3 mb-3" id="14">
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
                <div class="col-lg-3 mb-3" id="15">
                    <label class="form-label">Fifteen Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="feather feather-calendar"></span>
                            </div>
                        </div>
                        <input class="form-control" placeholder="MM/DD/YYYY" name="fifteen_DeadLine" type="date">
                    </div>
                </div>
                <div class="col-lg-3 mb-3 mt-5">
                    <button class="btn btn-secondary" id="addNewDraft">
                        Add Draft
                    </button>
                </div>
            </div>

            <h4 class="my-4">Any References</h4>
            <div class="row row-sm mb-4">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label">Reference Order Code</label>
                        <input class="form-control mb-4 is-valid" name="Reference_Code" placeholder="Reference"
                            type="text">
                    </div>
                </div>
            </div>
            <h4 class="my-4">Order Description</h4>
            <div class="row row-sm mb-4">
                <div class="col-lg-12">
                    <div class="form-group">
                        <textarea id="summernote" class="form-control mb-4 is-invalid state-invalid" name="Order_Description"
                            placeholder="Textarea (invalid state)"></textarea>
                    </div>
                </div>
            </div>
            <h4 class="my-4">Payment Information</h4>
            <div class="row row-sm mb-4">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Order Price</label>
                        <input class="form-control mb-4 is-valid" name="Order_Price" placeholder="Enter Order Amount"
                            id="Order_Price" min="0" type="number" required>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Order Currency</label>
                        <select name="Order_Currency" class="form-control select2-show-search custom-select select2"
                            data-placeholder="Select Currencies" required>
                            <option label="Select Currency"></option>
                            @foreach ($Currencies as $Currency)
                                <option @selected($Currency->code === 'USD') value="{{ $Currency->code }}">
                                    {{ $Currency->code }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Payment Status</label>
                        <select name="Payment_Status" class="form-control custom-select select2 Partial_Payment"
                            data-placeholder="Select Status" aria-required="true" required>
                            <option value="">Select Status</option>
                            <option value="0">Paid</option>
                            <option value="1">Un-Paid</option>
                            <option value="2">Partial</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row row-sm mb-4 Partial-Info">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Receive Amount</label>
                        <input class="form-control mb-4 is-valid" name="Rec_Amount"
                            placeholder="Enter Receive Amount" id="Rec_Amount" type="number">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Due Amount</label>
                        <input class="form-control mb-4 is-valid" name="Due_Amount" readonly
                            placeholder="Enter Due Amount" type="number" id="Due_Amount">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label">Partial Payment Information</label>
                        <input class="form-control mb-4 is-valid" name="Partial_Info"
                            placeholder="Enter Partial Payment Information" type="text">
                    </div>
                </div>
            </div>
            <h4 class="my-4">Upload Any Attachments</h4>
            <div class="row row-sm mb-4">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="form-label" class="form-label"></label>
                        <input class="form-control" type="file" name="files[]" multiple>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <button type="submit" class="btn btn-primary btn-block">Create Order</button>
            </div>
        </form>
    </div>
</div>


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

        const searchOrderID = '{{ route('Get.Clients') }}';
        $('#myTypeahead').autocomplete({
            source: function(request, response) {
                $.get(searchOrderID, {
                    query: request.term
                }, function(data) {
                    response(data);
                });
            },
            select: function(event, ui) {
                getClientInfo(ui.item.value)
            }
        });

        function getClientInfo(value) {
            $.ajax({
                url: '{{ route('Get.Client.Info') }}',
                type: 'GET',
                data: {
                    'query': value
                },
                success: function(data) {
                    $('.Client-Code').val(data.Client_Code);
                    $('.Client_Name').val(data.Client_Name);
                    $('.Client_Phone').val(data.Client_Phone);
                    $('.Client_Country').val(data.Client_Country).trigger('change');
                    $('.Client_Email').val(data.Client_Email);
                }
            });
        }

        $('.Client_Name').keyup(function() {
            var Client_Name = $(this).val();
            if (Client_Name === '') {
                $('.Client-Code').val('');
                $('.Client_Name').val('');
                $('.Client_Phone').val('');
                $('.Client_Country').val('').trigger('change');
                $('.Client_Email').val('');
            }
        });

        $('.Partial-Info').hide();
        $('.Partial_Payment').change(function() {
            const mode = $(this).val();
            if (mode === '2') {
                $('.Partial-Info').show();
            } else {
                $('.Partial-Info').hide();
            }
        });

        $('#Rec_Amount').keyup(function() {
            var Payment = $('#Order_Price').val();
            var Rec_Amount = $(this).val();
            var Due_Amount = Payment - Rec_Amount;
            $('#Due_Amount').val(Due_Amount);
        });

        // Initially hiding all elements
        var $elements = $(
            '#primary-color, #secondary-color, #font-size, #size-of-design, #graphic-formate, #video-formate, #video-type'
        ).hide();

        $('#Project-Service').change(function() {
            var Value = $(this).val();
            $elements.hide();
            if (Value == 1) {
                $('#primary-color, #secondary-color, #font-size, #size-of-design, #graphic-formate')
                    .show();
            } else if (Value == 2) {
                $('#video-formate, #video-type').show();
            }
        });


    });
</script>
