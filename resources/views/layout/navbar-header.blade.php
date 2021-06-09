<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>

    <a class="navbar-brand col-lg-4 img-responsive" href="{{url()}}">
            <img src="{{url()}}/images/logo-menu.png"/>
        </a>
</div>
<!-- /.navbar-header -->

<ul class="nav navbar-top-links navbar-right">
    @if (Auth::guest())
    <li>
        <a class="menu-horizontal" href="{{route('auth/login')}}">Login</a>
    </li>
    @else
        <li class="dropdown">

            <a class="dropdown-toggle menu-horizontal" data-toggle="dropdown" href="#" style="padding:0;margin: 0;">
                {{  Auth::user()->name }}
                <i class="fa fa-caret-down"></i>
                @if(Auth::user()->imagem == NULL)
                    <i><img class="img-circle" style="border:solid 1px #DFFFBF; height: 42px; margin:3px; padding: 1px;"  alt="teste" src="{{url()}}/imagens-perfil/foto-perfil.png"></i>
                @else
                    <i><img class="img-circle" style="border:solid 1px #DFFFBF; height: 42px; margin:3px; padding: 1px;"  alt="teste" src="{{url()}}/imagens-perfil/{{ Auth::user()->imagem }}"></i>
                @endif
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="{{route('perfil.show', [Auth::user()->id]) }}"><i class="fa fa-user fa-fw"></i> Perfil do Usuário</a>
                </li>
                @if(Auth::user()->grupo == 0)
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Configurações</a></li>
                @endif
                <li class="divider"></li>
                <li><a href="{{route('auth/logout')}}"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
    @endif
    <!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->
