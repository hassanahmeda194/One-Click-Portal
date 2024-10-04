<?php

namespace Database\Seeders;

use App\Models\Auth\User;
use App\Models\Auth\UserBankDetails;
use App\Models\Auth\UserBasicInfo;
use App\Models\Auth\UserEmergencyInfo;
use App\Models\Auth\UserLeaveInfo;
use App\Models\Auth\UserOfficeTiming;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin Registrations
        User::create([
            'EMP_ID' => 'REG-1',
            'email' => 'Admin@OneClick.com',
            'password' => bcrypt('123456789')
        ]);

        UserBasicInfo::create([
            'F_Name' => 'Jon',
            'L_Name' => 'Doe',
            'Phone_Number' => '(+092) 000 0000000',
            'CNIC_Number' => '00000-0000000-0',
            'Join_Date' => Carbon::now(),
            'EMP_Status' => 'Permanent',
            'Job_Type' => 'Office_Based',
            'Basic_Salary' => 45151515,
            'user_id' => 1
        ]);

        UserEmergencyInfo::create([
            'Name' => 'David',
            'Phone_Number' => '(+092) 000 0000000',
            'Relation' => 'Father',
            'user_id' => 1
        ]);

        UserLeaveInfo::create([
            'Sick_Leaves' => 7,
            'Annual_Leaves' => 14,
            'Casual_Leaves' => 10,
            'Off_Day' => 'Sunday',
            'user_id' => 1
        ]);
        $curTime = new DateTime();
        UserOfficeTiming::create([
            'Start_Time' => $curTime->format("H:i:s"),
            'End_Time' => $curTime->format("H:i:s"),
            'user_id' => 1
        ]);
        UserBankDetails::create([
            'Bank_Name' => 'Meezan Bank',
            'Account_Title' => 'Jon Doe',
            'Account_Number' => '4209211',
            'user_id' => 1
        ]);
    }
}
