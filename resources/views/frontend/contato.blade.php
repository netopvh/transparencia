@component('mail::message')
    # SAC Portal da Transparência

    Atenção, Foi registrado um novo SAC para a casa {{ $casa }}

    Solicitante: {{ $nome }}
    Email: {{ $email }}
    @if($empresa)
    Empresa: {{ $empresa }}
    @endif
    Telefone: {{ $telefone }}
    Estado: {{ $estado==1?'RO':'' }}
    Cidade: {{ $cidade }}
    Assunto: {{ $assunto }}
    Categoria: {{ $categoria }}
    Mensagem:
    {{ $mensagem }}

@component('mail::button', ['url' => 'http://transparencia.fiero.org.br/admin'])
        Acessar Portal
@endcomponent

    Atenciosamente,
    {{ config('app.name') }}
@endcomponent