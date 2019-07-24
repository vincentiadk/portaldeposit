<html>
	<table>
		<tr>
			<td><b>No</b></td>
			<td><b>Deksripsi</b></td>
			<td><b>Jumlah</b></td>

		</tr>
		@php
			$no = 1;
		@endphp
		@foreach($data as $data)
			<tr>
				<td>{{$no}}</td>
				<td>{{$data->label}}</td>
				<td>{{$data->total}}</td>
			</tr>
			@php
				$no++;
			@endphp
		@endforeach
	</table>
</html>