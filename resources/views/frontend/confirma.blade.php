@component('mail::message')
    # Olá, {{ $nome }}

    Sua solicitação foi realizada com sucesso!

    Atenciosamente,
    {{ config('app.name') }}
@endcomponent