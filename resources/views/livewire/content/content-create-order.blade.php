<!--Page header-->
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Content<span class="font-weight-normal text-muted ms-2"> Writing Orders</span></h4>
    </div>
</div>
<!--End Page header-->
<div class="card">
    <div class="card-header border-bottom-0">
        <h3 class="card-title">New Order Details</h3>
    </div>
    <div class="card-body pb-2">
        <form action="{{ route('Post.Content.Create.Order') }}" method="POST" class="needs-validation was-validated"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="Order_Type" value="2">
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
                            class="form-control select2-show-search custom-select select2 Client_Country"
                            data-placeholder="Select Country" required>
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
                        <label class="form-label">Services</label>
                        <select name="Order_Services" class="form-control select2-show-search custom-select select2"
                            data-placeholder="Select Services" required>
                            <option label="Select Services"></option>
                            @foreach ($Writer_Skills as $Skill)
                                <option value="{{ $Skill->Skill_Name }}">{{ $Skill->Skill_Name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <div class="form-group">
                            <label class="form-label">Title</label>
                            <input class="form-control mb-4 is-valid " name="Content_Title" placeholder="Enter a Title"
                                type="text" required value="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label">Industries related To Subject</label>
                        <select name="Industry_Name" class="form-control custom-select select2"
                            data-placeholder="Select Industry" required>
                            <option label="Select Industries"></option>
                            @foreach ($Order_Industries as $Industry)
                                <option value="{{ $Industry->Industry_Name }}">{{ $Industry->Industry_Name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label">Preferred Writing Style </label>
                        <select name="Writing_Style" class="form-control custom-select select2"
                            data-placeholder="Writing Style" required>
                            <option label="Writing Style"></option>
                            @foreach ($Writing_Styles as $Style)
                                <option value="{{ $Style->Style_Name }}">{{ $Style->Style_Name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label">Preferred Voice </label>
                        <select name="Preferred_Voice" class="form-control custom-select select2"
                            data-placeholder="Preferred_Voice" required>
                            <option label="Select Voices"></option>
                            @foreach ($Order_Voices as $Voice)
                                <option value="{{ $Voice->Voice_Name }}">{{ $Voice->Voice_Name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label">Target Audience</label>
                        <select name="Target_Audience" class="form-control custom-select select2"
                            data-placeholder="Select Target Audience" required>
                            <option label="Select Target Audience"></option>
                            <option value="0">Male</option>
                            <option value="1">Female</option>
                            <option value="2">Male & Female Both</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label">Target Gender</label>
                        <select name="Target_Gender" class="form-control custom-select select2"
                            data-placeholder="Select Gender" required>
                            <option label="Select Gender"></option>
                            <option value="0">Male</option>
                            <option value="1">Female</option>
                            <option value="2">Other</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label">Include Free Image</label>
                        <select name="Free_Image" class="form-control custom-select select2"
                            data-placeholder="Select Image" required>
                            <option label="Select Image"></option>
                            <option value="0">Yes</option>
                            <option value="1">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label">Generic Type</label>
                        <select name="Generic_Type" class="form-control custom-select select2"
                            data-placeholder="Select Generic" required>
                            <option label="Select Generic"></option>
                            @foreach ($Generic_Types as $Generic)
                                <option value="{{ $Generic->Generic_Type }}">{{ $Generic->Generic_Type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <div class="form-group">
                            <label class="form-label">Include Keyword (if Any)</label>
                            <input class="form-control mb-4 is-valid " name="Keywords" placeholder="Enter a Keyword"
                                type="text" required value="">
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <div class="form-group">
                            <label class="form-label">Meta Description + Header</label>
                            <input class="form-control mb-4 is-valid" name="Meta_Description"
                                placeholder="Enter a Meta Description" type="text" required value="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <div class="form-group">
                            <label class="form-label">Reference Link (if Any)</label>
                            <input class="form-control mb-4 is-valid " name="Reference_Link"
                                placeholder="Enter a Reference Link" type="text" required value="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label">Websites</label>
                        <select name="Order_Website" class="form-control select2-show-search custom-select select2"
                            data-placeholder="Select Website" required>
                            <option label="Select Website"></option>
                            @foreach ($Order_Websites as $Website)
                                <option value="{{ $Website->Website_Name }}">{{ $Website->Website_Name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label">Preferred Language</label>
                        <select name="Preferred_Language"
                            class="form-control select2-show-search custom-select select2"
                            data-placeholder="Select Preferred Language" required>
                            <option label="Select Preferred Language"></option>
                            @foreach ($languages as $language)
                                <option value="{{ $language->name }}">{{ $language->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <div class="form-group">
                            <label class="form-label">Words</label>
                            <input class="form-control mb-4 is-valid " name="Word_Count" placeholder="Enter a Word"
                                type="number" required value="">
                        </div>
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
                        </div><!-- input-group-prepend -->
                        <input class="form-control" placeholder="Set time" name="DeadLine_Time" type="time"
                            required>
                    </div><!-- input-group -->
                </div>
                <div class="col-lg-3 mb-3">
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
                <div class="col-lg-3 mb-3">
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
                <div class="col-lg-3 mb-3">
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
                        <input class="form-control" placeholder="MM/DD/YYYY" name="fourteen_DeadLine" type="date">
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
                <button type="submit" class="btn btn-primary btn-block">Finish & Save</button>
            </div>
        </form>
    </div>
</div>


<script>
    $(document).ready(function() {
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
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const repeaterContainer = document.getElementById("repeater-container");
        const addButton = document.querySelector(".add-button");

        addButton.addEventListener("click", function() {
            const repeaterItem = repeaterContainer.querySelector(".repeater-item").cloneNode(true);
            repeaterItem.querySelector(".remove-button").addEventListener("click", function() {
                repeaterItem.remove();
            });

            repeaterContainer.appendChild(repeaterItem);
        });
    });
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
</script>
