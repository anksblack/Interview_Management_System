<p>Dear {{ $interview->user->name }},</p>

<p>Your interview has been Rescheduled:</p>
<ul>
    <li>Date: {{ $interview->date }}</li>
    <li>Time: {{ $interview->time }}</li>
    <li>Type: {{ $interview->type }}</li>
</ul>
