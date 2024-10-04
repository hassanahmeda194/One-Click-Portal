<!--Page header-->
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Development<span class="font-weight-normal text-muted ms-2"> Orders</span></h4>
    </div>
</div>
<div class="card">
    <div class="card-header border-bottom-0">
        <h3 class="card-title">Edit Order Details</h3>
    </div>
    <div class="card-body pb-2">
        <form action="{{ route('post.update.development.order', ['Order_ID' => $DevelopmentOrder->Order_ID]) }}"
            method="POST" class="needs-validation was-validated" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="Order_Type" value="3">
            <div class="row row-sm">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label">Order ID</label>
                        <input class="form-control mb-4" name="Order_ID" placeholder="Order ID" readonly type="text"
                            value="{{ $DevelopmentOrder->Order_ID }}">
                    </div>
                </div>
                @if (!empty($DevelopmentOrder->Client_Code))
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-label">Client ID</label>
                            <input class="form-control mb-4" placeholder="Order ID" readonly type="text"
                                value="{{ $DevelopmentOrder->Client_Code }}">
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
                            value="{{ $DevelopmentOrder->client_info->Client_Name }}">
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
                                @if (!empty($DevelopmentOrder->client_info->Client_Country))
                                    <option @selected($DevelopmentOrder->client_info->Client_Country === $Country->name) value="{{ $Country->name }}">
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
                            value="{{ !empty($DevelopmentOrder->client_info->Client_Email) ? $DevelopmentOrder->Client_Info->Client_Email : null }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Client Phone</label>
                        <input class="form-control mb-4 is-valid Client_Phone" name="Client_Phone"
                            placeholder="Client Phone" type="text"
                            value="{{ !empty($DevelopmentOrder->client_info->Client_Phone) ? $DevelopmentOrder->client_info->Client_Phone : null }}">
                    </div>
                </div>
            </div>
            <h4 class="my-4">Order Information</h4>
            <div class="row row-sm mb-4">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Project Title</label>
                        <input class="form-control mb-4 is-valid" name="project_title" placeholder="Enter No. of Words"
                            type="text" required value="{{ $DevelopmentOrder->development_info->project_title }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Service</label>
                        <select name="project_Service" id="Project-Service" class="form-control custom-select select2"
                            data-placeholder="Choose Service" required>
                            <option label="Select Project Service"></option>
                            <option value="1"
                                {{ $DevelopmentOrder->development_info->project_service == 1 ? 'selected' : '' }}>
                                Wordpress</option>
                            <option value="2"
                                {{ $DevelopmentOrder->development_info->project_service == 2 ? 'selected' : '' }}>
                                Custom</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Order Websites</label>
                        <select name="website_order" class="form-control custom-select select2"
                            data-placeholder="Choose Order Website" required>
                            @foreach ($Order_Websites as $website)
                                <option value="{{ $website->Website_Name }}" @selected($DevelopmentOrder->development_info->website_order == $website->Website_Name) }} >{{ $website->Website_Name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Order Status</label>
                        <select name="Order_Status" class="form-control custom-select select2"
                            data-placeholder="Select Status" required>
                            <option label="Select Status"></option>
                            <option value="0"
                                {{ $DevelopmentOrder->development_info->order_status == 0 ? 'selected' : '' }}>Working
                            </option>
                            <option
                                value="1"{{ $DevelopmentOrder->development_info->order_status == 1 ? 'selected' : '' }}>
                                Canceled</option>
                            <option
                                value="2"{{ $DevelopmentOrder->development_info->order_status == 2 ? 'selected' : '' }}>
                                Completed</option>
                            <option
                                value="3"{{ $DevelopmentOrder->development_info->order_status == 3 ? 'selected' : '' }}>
                                Revision</option>
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
                        <input class="form-control" placeholder="MM/DD/YYYY" name="DeadLine" required type="date"
                            value="{{ \Carbon\Carbon::parse($DevelopmentOrder->submission_info->DeadLine)->format('Y-m-d') }}">
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
                        <input class="form-control" placeholder="Set time" name="DeadLine_Time" type="time"
                            required value="{{ $DevelopmentOrder->submission_info->DeadLine_Time }}">
                    </div>
                </div>
                <div class="col-lg-3 mb-2">
                    <label class="form-label">First Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="feather feather-calendar"></span>
                            </div>
                        </div>
                        <input class="form-control" placeholder="MM/DD/YYYY" name="F_DeadLine" type="date"
                            value="{{ $DevelopmentOrder->submission_info->F_DeadLine }}">
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
                        <input class="form-control" placeholder="MM/DD/YYYY" name="S_DeadLine" type="date"
                            value="{{ $DevelopmentOrder->submission_info->S_DeadLine }}">
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
                        <input class="form-control" placeholder="MM/DD/YYYY" name="T_DeadLine" type="date"
                            value="{{ $DevelopmentOrder->submission_info->T_DeadLine }}">
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
                        <input class="form-control" placeholder="MM/DD/YYYY" name="Four_DeadLine" type="date"
                            value="{{ $DevelopmentOrder->submission_info->Four_DeadLine }}">
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
                        <input class="form-control" placeholder="MM/DD/YYYY" name="Fifth_DeadLine" type="date"
                            value="{{ $DevelopmentOrder->submission_info->Fifth_DeadLine }}">
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
                        <input class="form-control" placeholder="MM/DD/YYYY" name="Sixth_DeadLine" type="date"
                            value="{{ $DevelopmentOrder->submission_info->Sixth_DeadLine }}">
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
                        <input class="form-control" placeholder="MM/DD/YYYY" name="Seven_DeadLine" type="date"
                            value="{{ $DevelopmentOrder->submission_info->Seven_DeadLine }}">
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
                        <input class="form-control" placeholder="MM/DD/YYYY" name="Eight_DeadLine" type="date"
                            value="{{ $DevelopmentOrder->submission_info->Eight_DeadLine }}">
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
                        <input class="form-control" placeholder="MM/DD/YYYY" name="nine_DeadLine" type="date"
                            value="{{ $DevelopmentOrder->submission_info->nine_DeadLine }}">
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
                        <input class="form-control" placeholder="MM/DD/YYYY" name="ten_DeadLine" type="date"
                            value="{{ $DevelopmentOrder->submission_info->ten_DeadLine }}">
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
                        <input class="form-control" placeholder="MM/DD/YYYY" name="eleven_DeadLine" type="date"
                            value="{{ $DevelopmentOrder->submission_info->eleven_DeadLine }}">
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
                        <input class="form-control" placeholder="MM/DD/YYYY" name="twelve_DeadLine" type="date"
                            value="{{ $DevelopmentOrder->submission_info->twelve_DeadLine }}">
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
                        <input class="form-control" placeholder="MM/DD/YYYY" name="thirteen_DeadLine" type="date"
                            value="{{ $DevelopmentOrder->submission_info->thirteen_DeadLine }}">
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
                        <input class="form-control" placeholder="MM/DD/YYYY" name="fourteen_DeadLine" type="date"
                            value="{{ $DevelopmentOrder->submission_info->fourteen_DeadLine }}">
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
                        <input class="form-control" placeholder="MM/DD/YYYY" name="fifteen_DeadLine" type="date"
                            value="{{ $DevelopmentOrder->submission_info->fifteen_DeadLine }}">
                    </div>
                </div>
            </div>
            <h4 class="my-4">Any References</h4>
            <div class="row row-sm mb-4">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label">Reference Order Code</label>
                        <input class="form-control mb-4 is-valid" name="Reference_Code" placeholder="Reference"
                            type="text" value="{{ $DevelopmentOrder->reference_info->Reference_Code }}">
                    </div>
                </div>
            </div>
            <h4 class="my-4">Order Description</h4>
            <div class="row row-sm mb-4">
                <div class="col-lg-12">
                    <div class="form-group">
                        <textarea id="summernote" class="form-control mb-4 is-invalid state-invalid" name="Order_Description"
                            placeholder="Textarea (invalid state)">{!! $DevelopmentOrder->order_desc->Description !!}</textarea>
                    </div>
                </div>
            </div>
            <h4 class="my-4">Payment Information</h4>
            <div class="row row-sm mb-4">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Order Price</label>
                        <input class="form-control mb-4 is-valid" name="Order_Price" placeholder="Enter Order Amount"
                            id="Order_Price" min="0" type="number" required
                            value="{{ $DevelopmentOrder->payment_info->Order_Price }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Order Currency</label>
                        <select name="Order_Currency" class="form-control select2-show-search custom-select select2"
                            data-placeholder="Select Currencies" required>
                            <option label="Select Currency"></option>
                            @foreach ($Currencies as $Currency)
                                <option @selected($Currency->code == $DevelopmentOrder->payment_info->Order_Currency) value="{{ $Currency->code }}">
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
                            <option value="0"
                                {{ $DevelopmentOrder->payment_info->Payment_Status == 'Paid' ? 'selected' : '' }}>Paid
                            </option>
                            <option value="1"
                                {{ $DevelopmentOrder->payment_info->Payment_Status == 'Un-Paid' ? 'selected' : '' }}>
                                Un-Paid
                            </option>
                            <option value="2"
                                {{ $DevelopmentOrder->payment_info->Payment_Status == 'Partial' ? 'selected' : '' }}>
                                Partial
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row row-sm mb-4 Partial-Info">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Receive Amount</label>
                        <input class="form-control mb-4 is-valid" name="Rec_Amount"
                            placeholder="Enter Receive Amount" id="Rec_Amount" type="number"
                            value="{{ $DevelopmentOrder->payment_info->Rec_Amount }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Due Amount</label>
                        <input class="form-control mb-4 is-valid" name="Due_Amount" readonly
                            placeholder="Enter Due Amount" type="number" id="Due_Amount"
                            {{ $DevelopmentOrder->payment_info->Due_Amount }}>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label">Partial Payment Information</label>
                        <input class="form-control mb-4 is-valid" name="Partial_Info"
                            placeholder="Enter Partial Payment Information" type="text"
                            value="{{ $DevelopmentOrder->Partial_Info }}">
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
                <button type="submit" class="btn btn-primary btn-block">Update Order</button>
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
