@component('mail::message')
    # Cadastro portal da transparência

    Olá {{ $name }}, Foi realizado o cadastro do seu usuário no portal da transparência.

    Login: {{ $username }}
    Senha Temporária: {{ $password }}

@component('mail::button', ['url' => url(config('app.url').'/admin')])
    Acessar Portal
@endcomponent

    Atenciosamente,
    {{ config('app.name') }}
@endcomponent