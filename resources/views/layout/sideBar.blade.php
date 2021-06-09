    <div class="sidebar" role="navigation"  style="background-color: #fff; border-top:solid 2px #016701;">
    <div class="sidebar-nav navbar-collapse">




        <ul class="nav" id="side-menu" style="border-top: solid 1px #E7E7E7;">
            {{--
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Buscar...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </li>
            --}}

            <!--  Usuários -->
            @can('view_users','usuarios')
            <li>
                <a href="#"><span class="lnr lnr-users icon-pequeno"></span> Segurança<span class="fa arrow align-m"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{route('usuarios.create')}}">Adicionar usuários</a></li>
                    <li><a href="{{route('usuarios.index')}}">Listar usuários</a></li>
                    <li><a href="{{route('permission.index')}}">Lista Permissões</a></li>
                    <li><a href="{{route('role.index')}}">Listar de Papeis</a></li>
                </ul>
            </li>
            @endcan


            <li>
                <a href="home"><span class="lnr lnr-chart-bars icon-pequeno"></span> Dashboard</a>
            </li>
            <!--  Eventos -->
            <li>
                <a href="#"><span class="lnr lnr-bullhorn icon-pequeno"></span> Eventos<span class="fa arrow align-m"></span></a>
                <ul class="nav nav-second-level">
                    <li><a  href="{{route('eventos.create') }}">Cadastrar</a></li>
                    {{--<li><a href="{{route('eventos.index') }}">Listar</a></li>--}}
                    <li><a href="{{route('eventos-solicitados') }}">Listar</a></li>
                </ul>
            </li>
            <!-- -->
            <li>
                <a href="#"><span class="lnr lnr-printer icon-pequeno"></span> Relatórios<span class="fa arrow align-m"></span></a>
                <ul class="nav nav-second-level">
                    <li><a  href="{{route('default')}}" target="_self">What's UP</a></li>
                    {{--<li><a  href="{{route('porSala')}}" target="_self">Por espaço</a></li>--}}
                    {{--<li><a  href="{{route('mapadeeventos')}}" target="_blank">Por Magnitude</a></li>--}}
                    {{--<li><a  href="{{route('mapadeeventos')}}" target="_blank">Por Tipologia</a></li>--}}
                    {{--<li><a  href="{{route('mapadeeventos')}}" target="_blank">Por data de Cadastro</a></li>--}}
                    <li><a  href="eventos/sindicatos">Resumo de Atendimentos</a></li>
                    <li><a  href="relatorio/timesheet">TimeSheet</a></li>
                    <li><a href="#"></a></li>
                </ul>
            </li>
            @if(!Auth::guest() && Auth::user()->grupo == 0)
            <!--  Espaços -->
            <li>
                <a href="#"><span class="lnr lnr-store icon-pequeno"></span> Espaços<span class="fa arrow align-m"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a  href="{{route('espacos.create') }}">Cadastrar</a>
                    </li>
                    <li>
                        <a href="{{route('espacos.index') }}">Listar</a>
                    </li>
                </ul>
            </li>

            <!--  Tipo de Espaço -->
            <li>
                <a href="#"><span class="lnr lnr-apartment icon-pequeno"></span> Tipos de Espaço<span class="fa arrow align-m"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a  href="{{route('tiposEspaco.create') }}">Cadastrar</a>
                    </li>
                    <li>
                        <a href="{{route('tiposEspaco.index') }}">Listar</a>
                    </li>
                </ul>
            </li>

            <!--  Tipos de Evento -->
            <li>
                <a href="#"><span class="lnr lnr-mic icon-pequeno"></span> Tipos de Evento<span class="fa arrow align-m"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a  href="{{route('tiposEvento.create') }}">Cadastrar</a>
                    </li>
                    <li>
                        <a href="{{route('tiposEvento.index') }}">Listar</a>
                    </li>
                </ul>
            </li>
            <!--  Recursos -->
            <li>
                <a href="#"><span class="lnr lnr-leaf icon-pequeno"></span> Recursos<span class="fa arrow align-m"></span></a>
                <ul class="nav nav-second-level">
                    <li><a  href="{{route('recursos.create') }}">Cadastrar</a></li>
                    <li><a href="{{route('recursos.index') }}">Listar</a></li>
                </ul>
            </li>

            <!--  Niveis -->
                <li>
                    <a href="#"><span class="lnr lnr-layers icon-pequeno"></span> Níveis<span class="fa arrow align-m"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a  href="{{route('niveis.create') }}">Cadastrar</a></li>
                        <li><a href="{{route('niveis.index') }}">Listar</a></li>
                    </ul>
                </li>

                <!--  Unidades -->

                    <li>
                        <a href="#"><span class="lnr lnr-map-marker icon-pequeno"></span> Unidades<span class="fa arrow align-m"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a  href="{{route('unidades.create') }}">Cadastrar</a>
                            </li>
                            <li><a href="{{route('unidades.index') }}">Listar</a></li>
                            <li><a href="{{route('lista-orcamento') }}">Orçamento</a></li>
                        </ul>
                    </li>


                    @endif


            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>

