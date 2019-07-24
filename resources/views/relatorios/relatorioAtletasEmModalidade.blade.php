<!DOCTYPE html>
<html>
<head>
	<title>Relatorio de Atletas em Modalidade </title>
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

    <h1>Atletas em modalidade: {{$titulo}}</h1>


    
    <table >
		  <thead >
		        <tr>
			         <th>Id Atleta</th>
		             <th>Nome do Atleta</th>
		             <th>Matricula</th>
		             <th>Tamanho Uniforme</th>
		             <th>Altura</th>
		             <th>Peso</th>
		        </tr>
		   </thead>  
			<tbody>
		@foreach($modalidade as $m)
			@if(isset($m->atletas))
				@foreach($m->atletas as $a)

				<tr>
					<td>{{$a->id}}</td>
					<td>{{$a->pessoa->nome}}</td>
					<td>{{$a->pessoa->matricula}}</td>
					<td>{{$a->tamanho->nome}}</td>
					<td>{{$a->altura}}</td>
					<td>{{$a->peso}}</td>
				</tr>
				@endforeach
			@endif	
		@endforeach
        	</tbody>
       
        
       
        
        
    </table>

</div>
</html>