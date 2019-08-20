<html>

<head>
   
    <title>A.A.A.U.J.M</title>

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" >
    
    <!--Icones do menu-->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <!--FUNCIONA MENU E FUNCIONA JQUEY COM AJAX-->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

      <!--Mascara de campos input-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

    <!--ICONES-->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>

    <meta name="viewport" content="width=device-width, user-scalable=no">
    
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
  

     <!-- Bootstrap JS -->
   <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script> -->

    <!--Nao identificado dependencia-->
    <!---->
   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>-->

    
</head>

<body>
<!--https://getbootstrap.com/docs/4.0/components/navbar/ FONTE-->

@if(Auth::user()->type==1)
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{route('home')}}"> <img src="{{asset('images/logotipo_vermelho_preto.png')}}" width="120px" height="50px" ></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('user.index')}}"><i class="fas fa-user"></i> Usuários </a>
      </li>
  
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="rp" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-users"></i> Associação/Renovação
        </a>
        <div class="dropdown-menu" aria-labelledby="rp">
          <a class="dropdown-item" href="{{ route('associado.index')}}">Associados</a>
          <a class="dropdown-item" href="{{ route('associado.index2')}}">Associados em Débito</a>
          
          <!--<div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Lista de Desejos</a>-->
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="lojamenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-tags"></i> Loja
        </a>
        <div class="dropdown-menu" aria-labelledby="lojamenu">
          <a class="dropdown-item" href="{{ route('produto.index')}}">Produtos</a>
          <a class="dropdown-item" href="{{ route('servico.index')}}">Serviços</a>
          <a class="dropdown-item" href="{{ route('fornecedor.index')}}">Fornecedores</a>
          <a class="dropdown-item" href="{{ route('venda.index')}}">Vendas</a>
          <!--<div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Lista de Desejos</a>-->
        </div>
      </li>

       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="esportivomenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-futbol"></i> Esportivo
        </a>
        <div class="dropdown-menu" aria-labelledby="esportivomenu">
          <a class="dropdown-item" href="{{ route('modalidade.index')}}">Modalidades</a>
          <a class="dropdown-item" href="{{ route('competicao.index')}}">Competições</a>
          <a class="dropdown-item" href="{{ route('atleta.index')}}" > Atletas</a>
        </div>
      </li>
   
      </ul>
  		
  		<ul class="navbar-nav">
	  	 <li class="nav-item navbar-right dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="logout" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             {{Auth::user()->name}} 
	        </a>
	        <div class="dropdown-menu" aria-labelledby="logout">
	          <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
	        </div>
	      </li>
	     </ul>
       
   <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>-->
  </div>
</nav>
@elseif(Auth::user()->type==2)

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{route('home')}}"> <img src="{{asset('images/logotipo_vermelho_preto.png')}}" width="120px" height="50px" ></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
     
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="rp" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-users"></i> Associação/Renovação
        </a>
        <div class="dropdown-menu" aria-labelledby="rp">
          <a class="dropdown-item" href="{{ route('associado.index')}}">Associados</a>
          <a class="dropdown-item" href="{{ route('associado.index2')}}">Associados em Débito</a>
          
          <!--<div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Lista de Desejos</a>-->
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="lojamenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-tags"></i> Loja
        </a>
        <div class="dropdown-menu" aria-labelledby="lojamenu">
          <a class="dropdown-item" href="{{ route('produto.index')}}">Produtos</a>
          <a class="dropdown-item" href="{{ route('servico.index')}}">Serviços</a>
          <a class="dropdown-item" href="{{ route('fornecedor.index')}}">Fornecedores</a>
          <a class="dropdown-item" href="{{ route('venda.index')}}">Vendas</a>
          <!--<div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Lista de Desejos</a>-->
        </div>
   
      </ul>
      
      <ul class="navbar-nav">
       <li class="nav-item navbar-right dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="logout" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             {{Auth::user()->name}} 
          </a>
          <div class="dropdown-menu" aria-labelledby="logout">
            <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
          </div>
        </li>
       </ul>
       
   <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>-->
  </div>
</nav>

@elseif(Auth::user()->type==3)

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{route('home')}}"> <img src="{{asset('images/logotipo_vermelho_preto.png')}}" width="120px" height="50px" ></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
  
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="rp" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-users"></i> Associação/Renovação
        </a>
        <div class="dropdown-menu" aria-labelledby="rp">
          <a class="dropdown-item" href="{{ route('associado.index')}}">Associados</a>
          <a class="dropdown-item" href="{{ route('associado.index2')}}">Associados em Débito</a>
          
          <!--<div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Lista de Desejos</a>-->
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="lojamenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-tags"></i> Loja
        </a>
        <div class="dropdown-menu" aria-labelledby="lojamenu">
          <a class="dropdown-item" href="{{ route('venda.index')}}">Vendas</a>
          <!--<div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Lista de Desejos</a>-->
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="esportivomenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-futbol"></i> Esportivo
        </a>
        <div class="dropdown-menu" aria-labelledby="esportivomenu">
          <a class="dropdown-item" href="{{ route('modalidade.index')}}">Modalidades</a>
          <a class="dropdown-item" href="{{ route('competicao.index')}}">Competições</a>
          <a class="dropdown-item" href="{{ route('atleta.index')}}" > Atletas</a>
        </div>
      </li>

      </ul>


      
      <ul class="navbar-nav">
       <li class="nav-item navbar-right dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="logout" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{Auth::user()->name}} 
          </a>
          <div class="dropdown-menu" aria-labelledby="logout">
            <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
          </div>
        </li>
       </ul>
       
   <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>-->
  </div>
</nav>



@elseif(Auth::user()->type==4)

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{route('home')}}"> <img src="{{asset('images/logotipo_vermelho_preto.png')}}" width="120px" height="50px" ></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
  
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="rp" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-users"></i> Associação/Renovação
        </a>
        <div class="dropdown-menu" aria-labelledby="rp">
          <a class="dropdown-item" href="{{ route('associado.index')}}">Associados</a>
          <a class="dropdown-item" href="{{ route('associado.index2')}}">Associados em Débito</a>
          
          <!--<div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Lista de Desejos</a>-->
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="lojamenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-tags"></i> Loja
        </a>
        <div class="dropdown-menu" aria-labelledby="lojamenu">
          <a class="dropdown-item" href="{{ route('venda.index')}}">Vendas</a>
          <!--<div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Lista de Desejos</a>-->
        </div>
      </li>
   
      </ul>
      
      <ul class="navbar-nav">
       <li class="nav-item navbar-right dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="logout" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{Auth::user()->name}} 
          </a>
          <div class="dropdown-menu" aria-labelledby="logout">
            <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
          </div>
        </li>
       </ul>
       
   <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>-->
  </div>
</nav>


@endif
    
    <div class="card" style="margin: 2% 5%;  padding: 1%;">
      <div id="content">

               @yield('conteudo')
      </div>
    </div>

    
    


</body>
<script src="{{asset('js/bootstrap.js')}}" type="text/javascript"></script>
<!--<script src="{{asset('js/jquery.maskMoney.js')}}" type="text/javascript"></script>-->
<!--https://plentz.github.io/jquery-maskmoney/-->
    @hasSection('javascript')
        @yield('javascript')
    @endif
</html>