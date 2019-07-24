<!DOCTYPE html>
<html>
<head>
	<title>Relatorio de Atletas</title>
 <style type="text/css">
 	
table {
  border-collapse: collapse;
  border-spacing: 15px;
}

 th, td {
  border: 1px solid #ddd;
  padding: 3px;
}

 

th {
 background-color: #f5f5f5;
}

td{
	
}

 </style>
</head>
<body>

    <h1>Atletas</h1>


    
    <table >
		  <thead >
		        <tr>
		            <th>Id Atleta</th>
		            <th>Nome</th>
		            <th>Matricula</th>
		            <th>Curso</th>
		            <th>Email</th>
		            <th>Tamanho Uniforme</th>
		            <th>Altura(m)</th>
		            <th>Peso (Kg)</th>
		        </tr>
		   </thead>  
		    <tbody>
		@foreach($atleta as $a)
		  
		            <tr>
		                <td>{{ $a->id }}</td>
		                <td>{{ $a->pessoa->nome}}</td>
		                <td>{{ $a->pessoa->matricula}}</td>
		                <td>{{ $a->pessoa->curso->nome}}</td>
		                <td>{{ $a->pessoa->email }}</td>
		                <td>{{ $a->tamanho->nome}}</td>
		                <td>{{ $a->altura}}</td>
		                <td>{{ $a->peso}} </td>


		               <!--<td>Competicoes
		                        /*@if(isset($a->competicoes)){

		                            <ul>
		                                @foreach($a->competicoes as $c)

		                                    <li>{{$c->local}}</li>
		                                    <li>{{$c->nome}}</li>
		                                @endforeach
		                            </ul>
		                        @endif*/
		                    }
		                </td>-->

		                
		            </tr>
		        @endforeach
        	</tbody>
       
        
       
        
        
    </table>

</div>
</html>