<?php

// app/Listeners/SetSessionForNotice.php
namespace App\Listeners;

use App\Events\NoticeCreated;
use Illuminate\Support\Facades\Session;

class SetSessionForNotice
{
    public function handle(NoticeCreated $event)
    {
        Session::put('interval', 'true');
    }   
}
