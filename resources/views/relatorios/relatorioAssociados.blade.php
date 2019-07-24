<!DOCTYPE html>
<html>
<head>
	<title>Relatorio de Associados</title>
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
		            <th>Telefone</th>
		            <th>Curso</th>
		            <th>Data Associação</th>
		            <th>Data Término</th>
		            <th>Email</th>
		            
		        </tr>
		   </thead>  
			<tbody>
				@foreach($associado as $a)
			            <tr>
			                <td>{{ $a->id }}</td>
			                <td>{{ $a->pessoa->nome}}</td>
			                <td>{{ $a->pessoa->matricula}}</td>
			                <td>{{ $a->pessoa->telefone}}</td>
			                <td>{{ $a->pessoa->curso->nome}}</td>
			                <td>{{ date( 'd/m/Y' , strtotime($a->data_inicio))}}</td>
                			<td>{{ date( 'd/m/Y' , strtotime($a->data_termino))}}</td>
			                <td>{{ $a->pessoa->email }}</td>
			   
			            </tr>
			    @endforeach
        	</tbody>
       
        
       
        
        
    </table>

</div>
</html>