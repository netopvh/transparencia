@component('mail::message')
    # Olá, {{ $nome }}

    Sua solicitação foi realizada com sucesso!

    Para facilitar sua comunição conosco, segue o numero do protocolo de antendimento.

    # Nº 2017012151


    Atenciosamente,
    {{ config('app.name') }}
@endcomponent