@component('mail::message')
# Hello {{ $user->name }},

Your quotation for prescription ID **#{{ $prescription->id }}** is ready.

@component('mail::button', ['url' => route('prescriptions.edit', $prescription->id)])
View Quotation
@endcomponent

Thank you for using our service!

Regards,<br>
{{ config('app.name') }}
@endcomponent