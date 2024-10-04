
@if ($date->isToday())
    <div class="chat-box-single-line">
        <abbr class="timestamp">Today</abbr>
    </div>
@else
    <div class="chat-box-single-line">
        <abbr class="timestamp">{{ $date->format('M d, Y') }}</abbr>
    </div>
@endif


