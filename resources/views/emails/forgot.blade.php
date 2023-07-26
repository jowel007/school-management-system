@component('mail::message')
Hello {{ $user->name }},

<p>We Understand it Happens. </p>

@component('mail::button',['url' => url('reset/'.$user->rember_token)])
Reset Your Password
@endcomponent
    <p>In case you have any issuse recovering your password,please contact us.</p>

    Thanks,

    {{ config('app.name') }}

@endcomponent