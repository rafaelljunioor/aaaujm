@extends('layout.adm.app') 
@section('conteudo') 



@if (session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@elseif (session()->has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


    <div class="card-header">
       <div class="card-title"> 
            <h1>Registrar Venda de Produto</h1>
        </div>
    </div>

    <div class="card-body">

        <form method="post" action="{{route('venda.store')}}">
            @csrf
            <div class="form-group">
                <label for="associados">Comprador</label>
                <select class="form-control {{$errors->has('associado') ? 'is-invalid' : ''}}" id="associados" name="associado">
                    <option value="">Venda Avulsa</option>
                    @foreach($associados as $a)
                    <option value="{{ $a->id }}"> {{ $a->pessoa->nome }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('associado'))
                <div class="invalid-feedback">
                    {{$errors->first('associado')}}
                </div>
                @endif
            </div>
            <div class="form-group">
                <label for="pagamentos">Forma de Pagamento</label>
                <select class="form-control {{$errors->has('pagamento') ? 'is-invalid' : ''}}" id="pagamentos" name="pagamento">
                    <option value="">Selecione:</option>
                    @foreach($pagamentos as $p)
                    <option value="{{ $p->id }}"> {{ $p->nome }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('pagamento'))
                <div class="invalid-feedback">
                    {{$errors->first('pagamento')}}
                </div>
                @endif
            </div>
            <div class="form-group">
                <label for="inputDesconto">Desconto:</label>
                <!--<input type="number" class="form-control {{$errors->has('desconto') ? 'is-invalid' : ''}}" id="inputDesconto" placeholder="Valor de Desconto" name="desconto">-->
                <select class="form-control {{$errors->has('desconto') ? 'is-invalid' : ''}}" id="descontos" name="desconto">
                    <option value="">Selecione:</option>
                     @for ($i = 0; $i <= 100; $i++)
                         <option value="{{ $i }}"> {{ $i }} %
                    </option>
                    @endfor
                    
                </select>
                @if($errors->has('desconto'))
                <div class="invalid-feedback">
                    {{$errors->first('desconto')}}
                </div>
                @endif
            </div>

            
           
            <div class="form-group">
                <label for="inputParcelas">Quantidade de Parcelas</label>
                <input type="number" class="form-control {{$errors->has('parcelas') ? 'is-invalid' : ''}}" id="inputParcelas" placeholder="Numero de Parcelas" name="parcelas"> 
                @if($errors->has('parcelas'))
                <div class="invalid-feedback">
                    {{$errors->first('parcelas')}}
                </div>
                @endif
            </div>
            <div class="form-group">
                <label for="inputDataPagamento">Data Pagamento</label>
                <input type="date" class="form-control {{$errors->has('data_pagamento') ? 'is-invalid' : ''}}" id="inputDataPagamento" placeholder="18/09/2018" name="data_pagamento"> @if($errors->has('data_pagamento'))
                <div class="invalid-feedback">
                    {{$errors->first('data_pagamento')}}
                </div>
                @endif
            </div>
            <br>
            <input type="hidden" id="valor_total_venda" name="valor_total_venda" value="">

             <h3 class="card-title text-center">Carrinho <i class="fas fa-cart-arrow-down"></i></h4>
             <br>
            <table class="table table-condensed table-hover"  id="tabela-produtos">
                <thead>
                    <tr>
                       <!-- <th style="width: 15%">Produto</th>
                        <th style="width: 25%">Quantidade</th>
                        <th style="width: 25%">Valor Unitário</th>
                        <th style="width: 25%">Valor Total</th>
                        <th style="width: 25%">Remover</th>-->
                        <th class="text-center">Descrição</th>
                        <th class="text-center">Valor</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>

                        <td colspan="2" style="text-align: left;">
                            <button class="btn btn-primary btn-sm " onclick="adicionarLinhaProduto2()" type="button"><i class="fas fa-plus"></i></button>
                        </td>

                    </tr>
                </tfoot>
            </table>
            <table class="table table-condensed table-hover" id="tabela-servicos">
                <thead>
                    <tr>
                        <!--<th>Serviço</th>
                        <th>Valor Unitário</th>
                        <th>Valor Total</th>
                        <th>Remover</th>-->
                        <th class="text-center">Descrição</th>
                        <th class="text-center">Valor</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" style="text-align: left;">
                            <button class="btn btn-primary btn-sm " onclick="adicionarLinhaServico2()" type="button"><i class="fas fa-plus"></i></button>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <button class="btn btn-success btn-sm" type="submit">Concluir</button>
            </div>
            </div>
        </form>
    </div>
    <div class="card-footer">
        <!--Servicos-->
        @if($errors->has('servicos.*'))

                    <div class="alert alert-danger" role="alert">
                        {{$errors->first('servicos.*')}}
                    </div>
            
        @endif

        @if($errors->has('valor_unitario_servicos.*'))

                    <div class="alert alert-danger" role="alert">
                        {{$errors->first('valor_unitario_servicos.*')}}
                    </div>
            
        @endif

         @if($errors->has('preco_total_servicos.*'))

                    <div class="alert alert-danger" role="alert">
                        {{$errors->first('preco_total_servicos.*')}}
                    </div>
            
        @endif

        <!--Produtos-->

        @if($errors->has('produtos.*'))

                    <div class="alert alert-danger" role="alert">
                        {{$errors->first('produtos.*')}}
                    </div>
            
        @endif

        @if($errors->has('valor_unitario.*'))

                    <div class="alert alert-danger" role="alert">
                        {{$errors->first('valor_unitario.*')}}
                    </div>
            
        @endif

        @if($errors->has('preco_total.*'))

                    <div class="alert alert-danger" role="alert">
                        {{$errors->first('preco_total.*')}}
                    </div>
            
        @endif

        @if($errors->has('quantidade.*'))

                    <div class="alert alert-danger" role="alert">
                        {{$errors->first('quantidade.*')}}
                    </div>
            
        @endif

        </div><!--FIM CARD FOOTER-->
@endsection('conteudo') 


@section('javascript')
<script type="text/javascript">
    removeLinha = function(handler) {
        var tr = $(handler).closest('tr');
        tr.fadeOut(400, function() {
            //var i;
            //for(i=tr.rowIndex;i<)
            tr.remove();
        });
        return false;
    };

    remove = function(handler){

        //$(handler).parent().parent().remove();
        var linha = handler.parentNode.parentNode.rowIndex;
        var tr = $(handler).closest('tr');
        var i;
       // document.getElementById("tabela-produtos").deleteRow(linha);

       tr.fadeOut(400, function() {
            //var i;
            //for(i=tr.rowIndex;i<)
            for(i=linha; i>=linha-5;i--){

            document.getElementById("tabela-produtos").deleteRow(i);
        }
           
        });
        
    };

    remove2 = function(handler){

        //$(handler).parent().parent().remove();
        var linha = handler.parentNode.parentNode.rowIndex;
        var tr = $(handler).closest('tr');
        var i;
       // document.getElementById("tabela-produtos").deleteRow(linha);

       tr.fadeOut(400, function() {
            //var i;
            //for(i=tr.rowIndex;i<)
            for(i=linha; i>=linha-4;i--){

            document.getElementById("tabela-servicos").deleteRow(i);
        }
           
        });
        
    };

   adicionarLinhaProduto2 = function(handler) {


       var cols = '<tr class="text-center table-secondary"><td colspan="2" style="text-align: center;">Novo Produto</td><tr/>';

        cols += '<tr><td><label>Produto</label></td> <td><select class="form-control product" id="tamanho" name="produtos[]"><option value="">Selecione:</option>@foreach($produtos as $p)<option value="{{ $p->id }}"> {{ $p->nome }} - R$ {{$p->preco_sugerido}}</option>@endforeach</select></td></tr>';

        $("#tabela-produtos").append(cols);

        cols = '<tr ><td><label>Quantidade</label></td><td id="quantidade"><input id="quantidade" type="number" class="form-control quantidade" name="quantidade[]"></td></tr>';

        $("#tabela-produtos").append(cols);

        cols = '<tr><td><label>Valor Unitário</label></td><td><input id="valor_unitario" type="number" step= "0.01" class="form-control preco" name="valor_unitario[]"></td></tr>';
         
         $("#tabela-produtos").append(cols);

         //cols = '<tr><td><label>Preco Total</label></td><td class="total"><input readonly id="valor_total" type="number" class="form-control" name="preco_total[]" step= "0.01"></td></tr>';

         //$("#tabela-produtos").append(cols);

        cols = '<tr><td><label>Ação</label></td>';
        cols += '<td><button class="btn btn-danger btn-sm excluir" onclick="remove(this)"  type="button">Remover</</button></td></tr>';
        cols += '';


        $("#tabela-produtos").append(cols);
        

       /* $(".quantidade, .preco").unbind('blur keyup');
        $(".quantidade, .preco").on("blur keyup", function() {
           // var tr = $(this).parent().parent();

           
            //var quantidade = document.getElementById("quantidade").value;
            //var valor_unitario = document.getElementById("valor_unitario").value;
           // document.getElementById("valor_total").value = quantidade * valor_unitario;

         // $('#id').prev().children('td').children(':text').val();
         //tbl.rows[rCount-1].cells[0].children[0].value
         /*var table = document.getElementById("tabela-produtos");

                for (var i = 0 ; i < table.rows.length; i++) {

                    for (var j = 0; j < table.rows[i].cells.length; j++) {
                        
                        //if(table.rows[i].cells[j].classList.contains("quantidade"))
                        var celulas = document.getElementById("tabela-produtos").rows[i].cells;
                          

                            
                    }
                    
                }
            
        });*/

        return false;
    };


 adicionarLinhaServico2 = function() {

     var cols = '<tr class="text-center table-secondary"><td colspan="2" style="text-align: center;">Novo Serviço</td><tr/>';

        cols += '<tr><td><label>Servico</label></td> <td><select class="form-control product" id="nome" name="servicos[]"><option value="">Selecione:</option>@foreach($servicos as $s)<option value="{{ $s->id }}"> {{ $s->nome }} - R$ {{$s->preco_sugerido}}</option>@endforeach</select></td></tr>';

        $("#tabela-servicos").append(cols);

        cols = '<tr><td><label>Valor Unitário</label></td><td><input id="valor_unitario" type="number" step= "0.01" class="form-control preco" name="valor_unitario_servicos[]"></td></tr>';
         
         $("#tabela-servicos").append(cols);

         //cols = '<tr><td><label>Preco Total</label></td><td class="total"><input readonly id="valor_total" type="number" class="form-control" name="preco_total[]" step= "0.01"></td></tr>';

         //$("#tabela-produtos").append(cols);

        cols = '<tr><td><label>Ação</label></td>';
        cols += '<td><button class="btn btn-danger btn-sm excluir" onclick="remove2(this)"  type="button">Remover</</button></td></tr>';
        cols += '';


        $("#tabela-servicos").append(cols);

        

        return false;
    };


    /*adicionarLinhaServico = function() {

        var newRow = $("<tr>");
        var cols = "";

        cols += '<td > <select class="form-control product" id="tamanho" name="servicos[]"><option value="" >Selecione:</option>@foreach($servicos as $s)<option value="{{ $s->id }}"> {{ $s->nome }}</option>@endforeach</select></td>';
        cols += '<td ><input id="#valor_unitario" type="number" step= "0.01" class="form-control preco" name="valor_unitario_servicos[]"></td>';
        cols += '<td class="total"><input readonly id="#valor_total" type="number" class="form-control" name="preco_total_servicos[]" step= "0.01"></td>';
        cols += '<td>';
        cols += '<button class="btn btn-danger btn-sm" onclick="removeLinha(this)" type="button"><i class="fas fa-minus"></i></button>';
        cols += '</td>';

        newRow.append(cols);
        $("#tabela-servicos").append(newRow);

        $(".quantidade, .preco").unbind('blur keyup');
        $(".quantidade, .preco").on("blur keyup", function() {
            const tr = $(this).parent().parent();

            const valor = tr.find('.preco').val();
            var total = 1 * valor;

            if (!isNaN(valor)) {
                tr.find('.total').html('<input readonly type="text" class="form-control" name="preco_total_servicos[]" step= "0.01" id="#valor_total" value=" ' + total + ' ">');

            }
        });

        return false;
    };*/


    /*adicionarLinhaProduto = function() {
 
       var newRow = $("<tr>");
        var cols = "";

        cols += '<td > <select class="form-control product" id="tamanho" name="produtos[]"><option value="">Selecione:</option>@foreach($produtos as $p)<option value="{{ $p->id }}"> {{ $p->nome }}</option>@endforeach</select></td>';
        cols += '<td ><input type="number" class="form-control quantidade" name="quantidade[]"></td>';
        cols += '<td ><input id="#valor_unitario" type="number" step= "0.01" class="form-control preco" name="valor_unitario[]"></td>';
        cols += '<td class="total"><input readonly id="#valor_total" type="number" class="form-control" name="preco_total[]" step= "0.01"></td>';
        cols += '<td>';
        cols += '<button class="btn btn-danger btn-sm" onclick="removeLinha(this)" type="button"><i class="fas fa-minus"></i></button>';
        cols += '</td>';

        newRow.append(cols);
        $("#tabela-produtos").append(newRow);
        

        $(".quantidade, .preco").unbind('blur keyup');
        $(".quantidade, .preco").on("blur keyup", function() {
            const tr = $(this).parent().parent();

            const quant = tr.find('.quantidade').val();
            const valor = tr.find('.preco').val();
            var total = quant * valor;
            
            


            if (!isNaN(quant) && !isNaN(valor)) {
                tr.find('.total').html('<input readonly type="text" class="form-control" name="preco_total[]" step= "0.01" id="#valor_total" value=" ' + total + ' ">');
                //var aux = quantidade*valor_unitario;
                //alert(aux);
            }
        });

        return false;
    };*/

    
</script>
@endsection('javascript')