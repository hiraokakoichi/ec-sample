{{-- @extends('layouts.app')
@section('content')
<div class="container">
	<div class="main container-fluid">
		<div class="row bg-light text-dark py-5">
			<div class="col-md-8 offset-md-2">
				<h1>テスト</h1>
			</div>
		</div>
	</div>
</div>
@endsection --}}
@extends('layouts.app')

@section('content')

{{-- <section class="rounded shadow-sm bg-white p-3 "> --}}

	<div class="form-group">
		<label for="desiredDeliveryDay">配送希望日</label>
		<select class="form-select" id="desiredDeliveryDay">
			<option value="" selected>配送希望日を選択して下さい</option>
			@foreach( $optionDateList as $optionDate )
			<option value="{{ $optionDate[0] }}" >{{ $optionDate[1] }}</option>
			@endforeach
		</select>
	</div>
	{{-- <div class="dropdown">
		<button class="btn btn-secondary dropdown-toggle" type="button" id="desiredDeliveryDay" data-bs-toggle="dropdown" aria-expanded="false">
			配送希望日を選択して下さい
		</button>
		<ul class="dropdown-menu" aria-labelledby="desiredDeliveryDay">

			<li><a class="dropdown-item" href="#">Action</a></li>
			<li><a class="dropdown-item" href="#">Another action</a></li>
			<li><a class="dropdown-item" href="#">Something else here</a></li>
		</ul>
	</div> --}}

{{-- </section> --}}

@endsection
