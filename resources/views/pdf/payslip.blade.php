<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OneClick PaySlip</title>
    <style>
        .container {
            margin-top: 5rem;
            margin-left: auto;
            margin-right: auto;
            width: 90%;
            padding-top: 5rem;
        }
        .img-fluid {
            width: 180px;
            height: 90px;
        }
        .mb-0 {
            margin-bottom: 0;
        }
        .mb-5 {
            margin-bottom: 1.5rem;
        }
        .mt-4 {
            margin-top: 2rem;
        }
        .table-bordered {
            border: 1px solid black;
        }
        .border-black {
            border-color: black;
        }
        tr td {
            border: 1px solid black;
            padding: 8px 6px;
        }
        .bg-yellow {
            background-color: #FFC000;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
    </style>
</head>

<body style="font-family: sans-serif; font-size: 14px;">
    <div class="container">
        <img src="data:image/png;base64,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" alt=""
            class="img-fluid mb-5">
        <p class="mb-0">Address: Kashif Center, Suite # 1602, 16th Floor near Hotel Mehran, Main</p>
        <p class="mb-0">Shahra-e-Faisal, Karachi.</p>
        <p class="mb-0">Contact: +92-21-36450005</p>
        <p class="mb-0">Website: 1click.com.pk</p>

        <div class="mt-4">
            <table class="table table-bordered border-black">
                <tr>
                    <td colspan="1">Pay Month</td>
                    <td colspan="3">{{ $currentMonth }}</td>
                </tr>
                <tr>
                    <td colspan="1">Payment Method</td>
                    <td colspan="3">Online bank transfer</td>
                </tr>
                <tr>
                    <td class="bg-yellow" colspan="4">Employee Detail</td>
                </tr>
                <tr>
                    <td colspan="1">Employee Name</td>
                    <td colspan="3">{{ $user->basic_info->F_Name .' ' . $user->basic_info->L_Name  }}</td>
                </tr>
                <tr>
                    <td colspan="1">Employee ID</td>
                    <td colspan="3">{{ $user->EMP_ID }}</td>
                </tr>
                <tr>
                    <td colspan="1">Designation </td>
                    <td colspan="3">{{ $user->designation->Designation_Name }}</td>
                </tr>
                <tr class="bg-yellow">
                    <td>Earning</td>
                    <td>Amount (PKR)</td>
                    <td>Deduction</td>
                    <td>Amount (PKR)</td>
                </tr>
                <tr>
                    <td>Basic Pay</td>
                    <td>{{ $basicSalarywithoutDetaction }}</td>
                    <td>Leave Without Pay: {{ $unpaid_Leave_Count }}</td>
                    <td>{{ $leaveDetact }} </td>
                </tr>
                <tr>
                    <td>Bonus</td>
                    <td>{{ $monthlyAllowance }}</td>
                    <td>Half days: {{ $halfDay_Count }}</td>
                    <td> {{ $halfdaydetaction }}</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Total Earning</td>
                    <td>{{ $basicSalarywithoutDetaction +  $monthlyAllowance }}</td>
                    <td>Total Deduction</td>
                    <td>{{  $leaveDetact + $halfdaydetaction  }}</td>
                </tr>
                <tr>
                    <td colspan="3">Net Salary</td>
                    <td>{{ ($basicSalarywithoutDetaction +  $monthlyAllowance) -  ($leaveDetact + $halfdaydetaction) }}</td>
                </tr>
            </table>
        </div>

    </div>
</body>
</html>