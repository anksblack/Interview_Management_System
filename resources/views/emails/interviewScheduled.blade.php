<p>Dear {{ $interview->user->name }},</p>

<p>Your interview has been scheduled:</p>
<ul>
    <li>Date: {{ $interview->date }}</li>
    <li>Time: {{ $interview->time }}</li>
    <li>Type: {{ $interview->type }}</li>
</ul>

<p>Your login credentials are as follows:</p>
<ul>
    <li>Email: {{ $loginEmail }}</li>
    <li>Password: {{ $password }}</li>
</ul>

<p>Please make sure to change your password after logging in. You can login <a href="{{ url('/login') }}">here</a>.</p>
