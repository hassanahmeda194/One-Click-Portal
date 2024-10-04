<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Research<span class="font-weight-normal text-muted ms-2"> Writing Orders</span></h4>
    </div>
</div>
<div class="card">
    <div class="card-header border-bottom-0"><h3 class="card-title">Update Order Details</h3></div>
    <div class="card-body pb-2">
        <form action="{{ route('Update.Research.Order') }}" method="POST" class="needs-validation was-validated"
              enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="Order_Type" value="1">
            <div class="row row-sm">
                <input type="hidden" name="order_id" value="{{ $Research_Order->id }}">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label">Order ID</label>
                        <input class="form-control mb-4" name="Order_ID"
                               placeholder="Order ID" readonly type="text"
                               value="{{ $Order_ID }}">
                    </div>
                </div>
            </div>
            <h4 class="my-4">Client Information</h4>
            <div class="row row-sm mb-4">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Client Name</label>
                        <input class="form-control mb-4 is-valid Get-Client typeahead Client_Name" id="myTypeahead"
                               name="Client_Name"
                               placeholder="Client Name" type="text" required
                               value="{{ $Research_Order->client_info->Client_Name }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Client Country</label>
                        <select name="Client_Country"
                                class="form-control select2-show-search custom-select select2 Client_Country"
                                data-placeholder="Select Country" required>
                            <option label="Select Country"></option>
                            @foreach($Countries as $Country)
                                <option
                                    @selected($Research_Order->client_info->Client_Country === $Country->name) value="{{ $Country->name }}">{{ $Country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Client Email</label>
                        <input class="form-control mb-4 is-valid Client_Email" name="Client_Email"
                               placeholder="Client Email" type="email"
                               value="{{ $Research_Order->client_info->Client_Email }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Client Phone</label>
                        <input class="form-control mb-4 is-valid Client_Phone" name="Client_Phone"
                               placeholder="Client Phone" type="text"
                               value="{{ $Research_Order->client_info->Client_Phone }}">
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
                            @foreach($Order_Services as $Service)
                                <option
                                    @selected($Research_Order->basic_info->Order_Services === $Service->Service_Name) value="{{ $Service->Service_Name }}">{{ $Service->Service_Name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label">Education Level</label>
                        <select name="Education_Level" class="form-control custom-select select2"
                                data-placeholder="Select Education Level" required>
                            <option label="Select Education"></option>
                            <option
                                @selected($Research_Order->basic_info->Education_Level === "High School") value="High School">
                                High School
                            </option>
                            <option
                                @selected($Research_Order->basic_info->Education_Level === "UnderGraduate") value="UnderGraduate">
                                UnderGraduate
                            </option>
                            <option
                                @selected($Research_Order->basic_info->Education_Level === "Graduate") value="Graduate">
                                Graduate
                            </option>
                            <option
                                @selected($Research_Order->basic_info->Education_Level === "Mastered") value="Mastered">
                                Mastered
                            </option>
                            <option
                                @selected($Research_Order->basic_info->Education_Level === "Doctoral") value="Doctoral">
                                Doctoral
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label">Word Count</label>
                        <input class="form-control mb-4 is-valid" name="Word_Count"
                               placeholder="Enter No. of Words" type="number" min="0" required
                               value="{{ (double)Str::replace(['$ ', ','], "", $Research_Order->basic_info->Word_Count) }}">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label">Spacing</label>
                        <select name="Spacing" class="form-control custom-select select2"
                                data-placeholder="Select Spacing" required>
                            <option label="Select Spacing"></option>
                            <option @selected($Research_Order->basic_info->Spacing === "0.5") value="0.5">0.5</option>
                            <option @selected($Research_Order->basic_info->Spacing === "1.0") value="1.0">1.0</option>
                            <option @selected($Research_Order->basic_info->Spacing === "1.5") value="1.5">1.5</option>
                            <option @selected($Research_Order->basic_info->Spacing === "2.0") value="2.0">2.0</option>
                            <option @selected($Research_Order->basic_info->Spacing === "2.5") value="2.5">2.5</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label">Citation Style</label>
                        <select name="Citation_Style" class="form-control custom-select select2"
                                data-placeholder="Select Document Style" required>
                            <option label="Select Spacing"></option>
                            <option @selected($Research_Order->basic_info->Citation_Style === "APA") value="APA">APA
                            </option>
                            <option @selected($Research_Order->basic_info->Citation_Style === "MLA") value="MLA">MLA
                            </option>
                            <option
                                @selected($Research_Order->basic_info->Citation_Style === "Chicago/Turban") value="Chicago/Turban">
                                Chicago/Turban
                            </option>
                            <option
                                @selected($Research_Order->basic_info->Citation_Style === "IEEE Style") value="IEEE Style">
                                IEEE Style
                            </option>
                            <option
                                @selected($Research_Order->basic_info->Citation_Style === "Harvard") value="Harvard">
                                Harvard
                            </option>
                            <option
                                @selected($Research_Order->basic_info->Citation_Style === "Oxford") value="Oxford">
                                Oxford
                            </option>
                            <option
                                @selected($Research_Order->basic_info->Citation_Style === "Oscala") value="Oscala">
                                Oscala
                            </option>
                            <option
                                @selected($Research_Order->basic_info->Citation_Style === "Others") value="Others">
                                Others
                            </option>
                            <option
                                @selected($Research_Order->basic_info->Citation_Style === "As Per Requirement") value="As Per Requirement">
                                As Per Requirement
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label">Sources Needed</label>
                        <input class="form-control mb-4 is-valid"
                               placeholder="Enter Source" name="Sources" type="text"
                               value="{{ $Research_Order->basic_info->Sources }}">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label">Websites</label>
                        <select name="Order_Website" class="form-control select2-show-search custom-select select2"
                                data-placeholder="Select Website" required>
                            <option label="Select Website"></option>
                            @foreach($Order_Websites as $Website)
                                <option
                                    @selected($Research_Order->basic_info->Order_Website === $Website->Website_Name) value="{{ $Website->Website_Name }}">{{ $Website->Website_Name }}</option>
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
                                <option value="{{ $language->name }}" @selected($Research_Order->basic_info->Preferred_Language == $language->name)>{{ $language->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label">Order Status</label>
                        <select name="Order_Status" class="form-control custom-select select2"
                                data-placeholder="Select Status" required>
                            <option label="Select Status"></option>
                            <option @selected($Research_Order->basic_info->Order_Status === "Working") value="0">
                                Working
                            </option>
                            <option @selected($Research_Order->basic_info->Order_Status === "Cancelled") value="1">
                                Canceled
                            </option>
                            <option @selected($Research_Order->basic_info->Order_Status === "Completed") value="2">
                                Completed
                            </option>
                            <option @selected($Research_Order->basic_info->Order_Status === "Revision") value="3">
                                Revision
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <h4 class="my-4">Submission Date Information</h4>
            <div class="row row-sm mb-4">
                <div class="col-lg-3">
                    <label class="form-label">DeadLine Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="feather feather-calendar"></span>
                            </div>
                        </div>
                        <input class="form-control" placeholder="MM/DD/YYYY" name="DeadLine" required
                               value="{{ date('Y-m-d', strtotime($Research_Order->submission_info->DeadLine)) }}"
                               type="date">
                    </div>
                </div>
                <div class="col-lg-3">
                    <label class="form-label">DeadLine Time</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="feather feather-clock"></span>
                            </div>
                        </div><!-- input-group-prepend -->
                        <input class="form-control" id="tp3" placeholder="Set time" name="DeadLine_Time" type="time"
                               required
                               value="{{ date('H:i:s', strtotime($Research_Order->submission_info->DeadLine_Time)) }}">
                        <button class="btn btn btn-primary br-tl-0 br-bl-0" type="button" id="setTimeButton">Current
                            Time
                        </button>
                    </div><!-- input-group -->
                </div>
                <div class="col-lg-2">
                    <label class="form-label">1st Draft DeadLine</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="feather feather-calendar"></span>
                            </div>
                        </div>
                        <input class="form-control" placeholder="MM/DD/YYYY" name="F_DeadLine"
                               type="date"
                               value="{{ (!empty($Research_Order->submission_info->F_DeadLine))?date('Y-m-d', strtotime($Research_Order->submission_info->F_DeadLine)):'' }}">
                    </div>
                </div>
                <div class="col-lg-2">
                    <label class="form-label">2nd Draft DeadLine</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="feather feather-calendar"></span>
                            </div>
                        </div>
                        <input class="form-control" placeholder="MM/DD/YYYY" name="S_DeadLine"
                               type="date"
                               value="{{ (!empty($Research_Order->submission_info->S_DeadLine))?date('Y-m-d', strtotime($Research_Order->submission_info->S_DeadLine)) : '' }}">
                    </div>
                </div>
                <div class="col-lg-2">
                    <label class="form-label">3rd Draft DeadLine</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="feather feather-calendar"></span>
                            </div>
                        </div>
                        <input class="form-control" placeholder="MM/DD/YYYY" name="T_DeadLine"
                               type="date"
                               value="{{ (!empty($Research_Order->submission_info->T_DeadLine))?date('Y-m-d', strtotime($Research_Order->submission_info->T_DeadLine)): '' }}">
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
                        value="{{ (!empty($Research_Order->submission_info->Four_DeadLine))?date('Y-m-d', strtotime($Research_Order->submission_info->Four_DeadLine)):'' }}"
                        >
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
                         value="{{ (!empty($Research_Order->submission_info->Fifth_DeadLine))?date('Y-m-d', strtotime($Research_Order->submission_info->Fifth_DeadLine)):'' }}"
                        >
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
                         value="{{ (!empty($Research_Order->submission_info->Sixth_DeadLine))?date('Y-m-d', strtotime($Research_Order->submission_info->Sixth_DeadLine)):'' }}"
                        >
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
                           value="{{ (!empty($Research_Order->submission_info->Seven_DeadLine))?date('Y-m-d', strtotime($Research_Order->submission_info->Seven_DeadLine)):'' }}"
                        >
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
                           value="{{ (!empty($Research_Order->submission_info->Eight_DeadLine))?date('Y-m-d', strtotime($Research_Order->submission_info->Eight_DeadLine)):'' }}"
                        >
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
                           value="{{ (!empty($Research_Order->submission_info->nine_DeadLine))?date('Y-m-d', strtotime($Research_Order->submission_info->nine_DeadLine)):'' }}"
                        >
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
                           value="{{ (!empty($Research_Order->submission_info->ten_DeadLine))?date('Y-m-d', strtotime($Research_Order->submission_info->ten_DeadLine)):'' }}"
                        >
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
                           value="{{ (!empty($Research_Order->submission_info->eleven_DeadLine))?date('Y-m-d', strtotime($Research_Order->submission_info->eleven_DeadLine)):'' }}"
                        >
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
                           value="{{ (!empty($Research_Order->submission_info->twelve_DeadLine))?date('Y-m-d', strtotime($Research_Order->submission_info->twelve_DeadLine)):'' }}"
                        >
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
                            type="date"
                               value="{{ (!empty($Research_Order->submission_info->thirteen_DeadLine))?date('Y-m-d', strtotime($Research_Order->submission_info->thirteen_DeadLine)):'' }}"
                            >
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
                           value="{{ (!empty($Research_Order->submission_info->fourteen_DeadLine))?date('Y-m-d', strtotime($Research_Order->submission_info->fourteen_DeadLine)):'' }}"
                        >
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
                           value="{{ (!empty($Research_Order->submission_info->fifteen_DeadLine))?date('Y-m-d', strtotime($Research_Order->submission_info->fifteen_DeadLine)):'' }}"
                        >
                    </div>
                </div>
            </div>
            <h4 class="my-4">Any References</h4>
            <div class="row row-sm mb-4">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label">Reference Order Code</label>
                        <input class="form-control mb-4 is-valid" name="Reference_Code"
                               placeholder="Reference" type="text"
                               value="{{ $Research_Order->reference_info->Reference_Code }}">
                    </div>
                </div>
            </div>
            <h4 class="my-4">Order Description</h4>
            <div class="row row-sm mb-4">
                <div class="col-lg-12">
                    <div class="form-group">
                        <textarea id="summernote" class="form-control mb-4 is-invalid state-invalid"
                                  name="Order_Description"
                                  placeholder="Textarea (invalid state)">{{ $Research_Order->order_desc->Description }}</textarea>
                    </div>
                </div>
            </div>
            <h4 class="my-4">Payment Information</h4>
            <div class="row row-sm mb-4">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Order Price</label>
                        <input class="form-control mb-4 is-valid" name="Order_Price"
                               placeholder="Enter Order Amount" id="Order_Price" min="0" type="number" required
                               value="{{ (double)Str::replace(['$ ', ','], "", $Research_Order->payment_info->Order_Price) }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Order Currency</label>
                        <select name="Order_Currency" class="form-control select2-show-search custom-select select2"
                                data-placeholder="Select Currencies" required>
                            <option label="Select Currency"></option>
                            @foreach($Currencies as $Currency)
                                <option
                                    @selected($Research_Order->payment_info->Order_Currency === $Currency->code) value="{{ $Currency->code }}">{{ $Currency->code }}</option>
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
                            <option @selected($Research_Order->payment_info->Payment_Status === 'Paid') value="0">Paid
                            </option>
                            <option @selected($Research_Order->payment_info->Payment_Status === 'Un-Paid') value="1">
                                Un-Paid
                            </option>
                            <option @selected($Research_Order->payment_info->Payment_Status === 'Partial') value="2">
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
                               value="{{ (double)Str::replace(['$ ', ','], "", $Research_Order->payment_info->Rec_Amount) }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Due Amount</label>
                        <input class="form-control mb-4 is-valid" name="Due_Amount" readonly
                               placeholder="Enter Due Amount" type="number" id="Due_Amount"
                               value="{{ (double)Str::replace(['$ ', ','], "", $Research_Order->payment_info->Due_Amount) }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label">Partial Payment Information</label>
                        <input class="form-control mb-4 is-valid" name="Partial_Info"
                               placeholder="Enter Partial Payment Information" type="text"
                               value="{{ $Research_Order->payment_info->Partial_Info }}">
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
    $(document).ready(function () {

        const searchOrderID = '{{ route('Get.Clients') }}';
        $('#myTypeahead').autocomplete({
            source: function (request, response) {
                $.get(searchOrderID, {query: request.term}, function (data) {
                    response(data);
                });
            },
            select: function (event, ui) {
                // The selected value is available in the 'ui.item.value' parameter
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
                success: function (data) {
                    $('.Client_Name').val(data.Client_Name);
                    $('.Client_Phone').val(data.Client_Phone);
                    $('.Client_Country').val(data.Client_Country).trigger('change');
                    $('.Client_Email').val(data.Client_Email);
                }
            });
        }
        $('.Client_Name').keyup(function (){
            var Client_Name = $(this).val();
            if (Client_Name === ''){
                $('.Client_Name').val('');
                $('.Client_Phone').val('');
                $('.Client_Country').val('').trigger('change');
                $('.Client_Email').val('');
            }
        });

        $('.Partial-Info').hide();
        var P_Status = $('.Partial_Payment').val();
        if (P_Status === '2'){
            $('.Partial-Info').show();
        }
        $('.Partial_Payment').change(function () {
            const mode = $(this).val();
            if (mode === '2') {
                $('.Partial-Info').show();
            } else {
                $('.Partial-Info').hide();
            }
        });

        $('#Rec_Amount').keyup(function () {
            var Payment = $('#Order_Price').val();
            var Rec_Amount = $(this).val();
            var Due_Amount = Payment - Rec_Amount;
            $('#Due_Amount').val(Due_Amount);
        });
    });
</script>
