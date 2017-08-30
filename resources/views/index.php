<?php include("header.php") ?>
	<div class="container">
	<h1>Places Lists</h1>
		<table>
			<tr>	
				@foreach($datas[0] as $key => $data):@
					<td>{{str_replace("_"," ",$key)}}</td>
				@endforeach@
			</tr>
			@foreach($datas as $data):@
				<tr>
					@foreach($data as $dat):@
						<td>{{$dat}}</td>
					@endforeach@
				</tr>
			@endforeach@
		</table>
	</div>
<?php include("footer.php") ?>
