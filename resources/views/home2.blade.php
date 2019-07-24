@extends('layout.adm.app')

@section('conteudo')
<div class="container">
    <h1 class="text-center">Dashboard</h1>
    <div class="row justify-content-left">

        <div class="col-md-6" style="margin-top: 10px;">
            <div class="card">
                <div class="card-header text-center"><strong>Associados Ativos</strong></div>

                <div class="card-body">

                    <h1 id="quantidadeAssociados" class="text-center"></h1>
                </div>
            </div>
        </div>

        <div class="col-md-6" style="margin-top: 10px;">
            <div class="card">
                <div class="card-header text-center"><strong>Associados Desativados</strong></div>

                <div class="card-body">

                     <h1 id="quantidadeAssociadosDesativados" class="text-center"></h1>
                </div>
            </div>
        </div>
    
        <div class="col-md-6" style="margin-top: 10px;">
            <div class="card">
                <div class="card-header text-center"><strong>Atletas</strong></div>

                <div class="card-body">
                     <h1 id="quantidadeAtletas" class="text-center"></h1>
                </div>
            </div>
        </div>
        <br>
        <div class="col-md-6" style="margin-top: 10px;">
            <div class="card">
                <div class="card-header text-center"><strong>Produtos Ativos</strong></div>

                <div class="card-body">

                     <h1 id="quantidadeProdutos" class="text-center"></h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('conteudo')

@section('javascript')

<script type="text/javascript">


    window.onload = function()
        {
          // quantidadeAssociados();
           //quantidadeAtletas();
          // quantidadeProdutos();  
           preencheDashboard();
        }

    function quantidadeAssociados()
        {
        //$.getJSON('/public/dadosassociadopormatricula/'+mat, function(data)
        $.getJSON('/quantidadeAssociados', function(data)
        {
            console.log(data);

                
                if (data.lenght != 0) 
                {
                    $('#quantidadeAssociados').append(data);
                   
                }
                
        })
    }

    function quantidadeAtletas()
        {
        //$.getJSON('/public/dadosassociadopormatricula/'+mat, function(data)
        $.getJSON('/quantidadeAtletas', function(data)
        {
            console.log(data);

                
                if (data.lenght != 0) 
                {
                    $('#quantidadeAtletas').append(data);
                   
                }  
        })
    }

     function quantidadeProdutos()
        {
        //$.getJSON('/public/dadosassociadopormatricula/'+mat, function(data)
        $.getJSON('/quantidadeProdutos', function(data)
        {
            console.log(data);

                
                if (data.lenght != 0) 
                {
                    $('#quantidadeProdutos').append(data);
                   
                }  
        })
    }


     function preencheDashboard()
        {
        //$.getJSON('/public/dadosassociadopormatricula/'+mat, function(data)
        $.getJSON('/dashboard', function(data)
        {
            console.log(data);

                
                if (data.lenght != 0) 
                {
                    $('#quantidadeProdutos').append(data.produtos).hide()
                        .fadeIn(2000);
                    $('#quantidadeAssociados').append(data.associados).hide()
                        .fadeIn(2000);
                    $('#quantidadeAtletas').append(data.atletas).hide()
                        .fadeIn(2000);
                    $('#quantidadeAssociadosDesativados').append(data.associadosDesativados).hide()
                        .fadeIn(2000);

                    //alert('dador encontrados');
                   
                }  
        })
    }

</script>

@endsection('javascript')