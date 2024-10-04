<?php

// app/Events/NoticeCreated.php
namespace App\Events;

use App\Models\Notice\Notice;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NoticeCreated
{
    use Dispatchable, SerializesModels;

    public $notice;

    public function __construct(Notice $notice)
    {
        $this->notice = $notice;
    }
}
