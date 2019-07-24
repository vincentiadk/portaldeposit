<html>
	<table>
		<tr>
			<td><b>No</b></td>
			<td><b>Title</b></td>
			<td><b>Author</b></td>
			<td><b>Publisher</b></td>
			<td><b>No Deposit</b></td>
			<td><b>Tanggal Terima</b></td>
		</tr>
		@php
			$no = 1;
		@endphp
		@foreach($data as $data)
			<tr>
				<td>{{$no}}</td>
				<td>{{$data->title}}</td>
				<td>{{$data->author}}</td>
				<td>{{$data->publisher}}</td>
				<td>{{$data->noinduk_deposit}}</td>
				<td>{{$data->createdate}}</td>
			</tr>
			@php
				$no++;
			@endphp
		@endforeach
	</table>
</html>