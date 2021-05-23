@extends('layouts.app')

@section('style')
<style>
	body {
		background-color: lavender !important;
		background-color: #818CF8 !important;
		overflow: hidden;
	}
</style>
@endsection

@section('body_class') overflow-hidden @endsection

@section('content')
	<div class="-mt-9 h-screen flex items-center justify-center">
		@for($i=3; $i>=1; $i--)
			<div class="w-full py-5 bg-indigo-{{$i*100}}">
		@endfor

		<div class="h-32 w-full bg-indigo-50 flex items-center justify-center">
			<p class="text-4xl text-gray-700 font-semibold">
				¡Hola Mundo!
			</p>
		</div>

		@for($i=1; $i<4; $i++)
			</div>
		@endfor
	</div>
@endsection


