<!-- Main sidebar -->
<div class="sidebar sidebar-main">
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">
                    <a href="#" class="media-left"><img src="{{ asset('public/backend/assets/images/perfil.png') }}"
                                                        class="img-circle img-sm" alt=""></a>
                    <div class="media-body">
                        <span class="media-heading text-semibold">{{ text_limit(auth()->user()->name,20) }}</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">

                    <!-- Main -->
                    <li class="navigation-header"><span>Gerenciamento</span> <i class="icon-menu"
                                                                                title="Main pages"></i></li>
                    <li class="{{ isUrlActive('/') }}"><a href="{{ route('admin.home') }}"><i class="icon-home4"></i> <span>Início</span></a></li>
                    <li class="{{ isUrlActive('admin/files') }}"><a href="{{ route('admin.arquivos.index') }}"><i class="icon-file-spreadsheet"></i> <span>Gerenciador de Arquivos</span></a></li>
                    <li class="{{ arUrlActive(['organization','menu','paginas','remunera','dirigentes','tecnicos']) }}">
                        <a href="#"><i class="icon-stack"></i> <span>Páginas Dinámicas</span></a>
                        <ul class="{{ boolReturn(['organization','menu','paginas','remunera','dirigentes','tecnicos']) ? '':'hidden-ul' }}">
                            <li class="{{ isUrlActive('admin/organization') }}"><a href="{{ route('admin.casas.index') }}"><i class="icon-office"></i> Casas</a></li>
                            <li class="{{ isUrlActive('admin/menu') }}"><a href="{{ route('admin.menus.index') }}"><i class="icon-more2"></i> Menu</a></li>
                            <li class="{{ isUrlActive('admin/paginas') }}"><a href="{{ route('admin.paginas.index') }}"><i class="icon-printer4"></i>Páginas</a></li>
                            <li class="{{ isUrlActive('admin/remunera') }}"><a href="{{ route('admin.remunera.index') }}"><i class="icon-tree7"></i>Estrutura Remuneratória</a></li>
                            <li class="{{ isUrlActive('admin/dirigentes') }}"><a href="{{ route('admin.dirigentes.index') }}"><i class="icon-profile"></i>Dirigentes</a></li>
                            <li class="{{ isUrlActive('admin/tecnicos') }}"><a href="{{ route('admin.tecnicos.index') }}"><i class="icon-man-woman"></i>Corpo Técnico</a></li>
                        </ul>
                    </li>
                    <!-- /main -->

                    <!-- Layout -->
                    @if(Entrust::can('view-admin') || user_role() == true)
                        <li class="navigation-header"><span>Administração</span> <i class="icon-menu"
                                                                                    title="Layout options"></i></li>
                        <li class="{{ arUrlActive(['users','roles','logs']) }}">
                            <a href="#"><i class="icon-lock"></i> <span>Segurança</span></a>
                            <ul class="{{ boolReturn(['roles','users', 'logs']) ? '':'hidden-ul' }}">
                                @if(Entrust::can('manage-users') || user_role() == true)
                                    <li class="{{ isUrlActive('admin/users') }}"><a href="{{ route('admin.users.index') }}"><i
                                                    class="icon-user"></i> Usuários</a></li>
                                @endif
                                @if(Entrust::can('manage-roles') || user_role() == true)
                                    <li class="{{ isUrlActive('admin/roles') }}"><a href="{{ route('admin.roles.index') }}"><i
                                                    class="icon-users4"></i> Perfis</a></li>
                                @endif
                                    <li class="{{ isUrlActive('admin/roles') }}"><a href="{{ route('admin.roles.index') }}"><i
                                                    class="icon-cog6"></i> Parâmetros do Sistema</a></li>
                                @if(Entrust::can('manage-logs') || user_role() == true)
                                    <li class="{{ isUrlActive('admin/logs') }}"><a href="{{ route('admin.logs.index') }}"><i
                                                    class="icon-comment"></i> Logs</a></li>
                                @endif
                            </ul>
                        </li>
                        @endif
                                <!-- /layout -->

                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>
<!-- /main sidebar -->