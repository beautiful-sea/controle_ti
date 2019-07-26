<!-- VERIFICA A AÇÃO E O CONTROLLER ATUAL -->

@php
$routeArray = app('request')->route()->getAction();
$controllerAction = class_basename($routeArray['controller']);
list($controller, $action) = explode('@', $controllerAction);
@endphp


<!-- MENU DASHBOARD -->

@php
$class = '';

if ($controller == 'HomeController') {
$class = 'active';
}
@endphp

<li class="nav-item {{ $class }}">
    <a href="{{ route('home') }}" class="nav-link ">
        <i class="fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>

@can('avisar',\App\User::class)
<!-- MENU AVISOS -->

@php
$class = '';

if ($controller == 'AvisosController') {
$class = 'active';
}
@endphp

<li class="nav-item {{ $class }}">
    <a href="{{ route('avisos.index') }}" class="nav-link ">
        <i class="fas fa-exclamation"></i>
        <p>Avisos</p>
    </a>
</li>
@endcan


@can('avisar',\App\User::class)
<!-- MENU FOLHA DE PAGAMENTOS -->

@php
$class = '';

if ($controller == 'FolhaPagamentosController') {
$class = 'active';
}
@endphp

<li class="nav-item {{ $class }}">
    <a href="{{ route('folha_pagamentos.index') }}" class="nav-link ">
        <i class="fas fa-file-invoice-dollar"></i>
        <p>Folha de Pagamento</p>
    </a>
</li>
@endcan
<!-- MENU SUPORTE -->

@php
$class = '';

if ($controller == 'OrdemServicosController') {
$class = 'active show';
}
@endphp
<li class="nav-item {{ $class }} ">
    <a data-toggle="collapse" href="#suporte">
        <i class="nav-icon fa fa-phone-square-alt"></i>
        <p>Suporte</p>
        <span class="caret"></span>
    </a>
    <div class="{{ $class }} collapse " id="suporte">
        <ul class="nav nav-collapse">

         @php
         $class = '';

         if ($controller == 'OrdemServicosController')
         {
             $class = 'active';
         }
         @endphp
         <li class="{{ $class }}">
            <a href="{{ route('ordem_servicos.index') }}" class="nav-link ">
                <i class="fa fa-ticket-alt"></i>
                <p>Ordem de Serviço</p>
            </a>
        </li>

    </ul>
</div>
</li>

<!-- MENU RAMAIS -->

@php
$class = '';

if ($controller == 'RamaisValencaController' || $controller == 'RamaisRJController') {
$class = 'active show';
}
@endphp
<li class="nav-item {{ $class }} ">
    <a data-toggle="collapse" href="#ramais">
        <i class="nav-icon fa fa-phone-alt"></i>
        <p>Ramais</p>
        <span class="caret"></span>
    </a>
    <div class="{{ $class }} collapse " id="ramais">
        <ul class="nav nav-collapse">

         @php
         $class = '';

         if ($controller == 'RamaisValencaController')
         {
             $class = 'active';
         }
         @endphp
         <li class="{{ $class }}">
            <a href="{{ route('ramais_valenca.index') }}">
                <i class="fas fa-phone-volume"></i>
                <p>Valença</p>
            </a>
        </li>


        @php
        $class = '';

        if ($controller == 'RamaisRJController') 
        {
            $class = 'active';
        }
        @endphp
        <li class="{{ $class }}">
            <a href="{{ route('ramais_rj.index') }}">
                <i class="fas fa-phone-volume"></i>
                <p>Rio de Janeiro</p>
            </a>
        </li>
    </ul>
</div>
</li>

<!-- MENU CONTROLE -->
@can('index',\App\User::class)

@php
$class = '';

if ($controller == 'EquipamentosController' || $controller == 'LicencasController' || $controller == 'ProdutosController' || $controller == 'SetoresController') {
$class = 'active show';
}
@endphp
<li class="nav-item {{ $class }} ">
    <a data-toggle="collapse" href="#controle">
        <i class="nav-icon fa fa-tasks"></i>
        <p>Controle</p>
        <span class="caret"></span>
    </a>
    <div class="{{ $class }} collapse " id="controle">
        <ul class="nav nav-collapse">


            <!-- MENU EQUIPAMENTOS -->

            @php
            $class = '';

            if ($controller == 'EquipamentosController') {
            $class = 'active';
        }
        @endphp

        <li class="nav-item {{ $class }}">
            <a href="{{ route('equipamentos.index') }}" class="nav-link ">
                <i class="fas fa-desktop"></i>
                <p>Equipamentos</p>
            </a>
        </li>

        <!-- MENU LICENÇAS-->

        @php
        $class = '';

        if ($controller == 'LicencasController') {
        $class = 'active';
    }
    @endphp

    <li class="nav-item {{ $class }}">
        <a href="{{ route('licencas.index') }}" class="nav-link ">
            <i class="fas fa-key"></i>
            <p>Licenças</p>
        </a>
    </li>


    <!-- MENU PRODUTOS -->

    @php

    $class = '';

    if ($controller == 'ProdutosController') {
    $class = 'active';
}
@endphp

<li class="nav-item {{ $class }}">
    <a href="{{ route('produtos.index') }}" class="nav-link ">
        <i class="fab fa-accusoft"></i>
        <p>Produtos</p>
    </a>
</li>

<!-- MENU SETORES -->

@php

$class = '';

if ($controller == 'SetoresController') {
$class = 'active';
}
@endphp

<li class="nav-item {{ $class }}">
    <a href="{{ route('setores.index') }}" class="nav-link ">
        <i class="fas fa-building"></i>
        <p>Setores</p>
    </a>
</li>

</ul>
</div>
</li>


<!-- MENU CONFIGURAÇÕES -->

@php
$class = '';

if ($controller == 'UsersController') {
$class = 'active show';
}
@endphp
<li class="nav-item {{ $class }} ">
    <a data-toggle="collapse" href="#configuracoes">
        <i class="nav-icon fa fa-users-cog"></i>
        <p>Configurações</p>
        <span class="caret"></span>
    </a>
    <div class="{{ $class }} collapse collapsed " id="configuracoes">
        <ul class="nav nav-collapse">

         @can('index', \App\User::class)    
         @php
         $class = '';

         if ($controller == 'UsersController' && $action <> 'profile')
         {
             $class = 'active';
         }
         @endphp
         <li class="{{ $class }}">
            <a href="{{ route('users.index') }}">
                <p class="sub-item">Usuários</p>
            </a>
        </li>

        @endcan

        @php
        $class = '';

        if ($controller == 'UsersController' && $action == 'profile') 
        {
            $class = 'active';
        }
        @endphp
        <li class="{{ $class }}">
            <a href="{{ route('users.profile') }}">
                <p class="sub-item">Perfil</p>
            </a>
        </li>
    </ul>
</div>
</li>
@endcan

</li>

<!-- MENU FAQ -->


@php
$class = '';

if ($controller == 'FaqController') {
$class = 'active';
}
@endphp

<li class="nav-item {{ $class }}">
    <a href="{{ route('faq') }}" class="nav-link ">
        <i class="fa fa-question"></i>
        <p>Ajuda</p>
    </a>
</li>

</li>


