@extends('layouts.app')

@section('content')
<section class="bg-indigo-500 text-white p-4 text-lg" >
	<div class="container mx-auto font-semibold">
		<h1>{{__('contact.form.title')}}</h1>
	</div>
</section>

<form class="container mx-auto p-4">
	@csrf
	<section class="grid md:grid-cols-2 gap-4">
		<p>
			<label class="block text-gray-600">
				{{__('contact.form.company_name')}}
				<input type="text" name="company_name" class="p-2 border w-full"/>
			</label>
		</p>

		<p>
			<label class="block text-gray-600">
				{{__('contact.form.annual_income')}}
				<input type="number" name="annual_income" step="any" class="p-2 border w-full"/>
			</label>
		</p>

		<p>
			<label class="block text-gray-600">
				{{__('contact.form.contact_name')}}
				<input type="text" name="contact_name" class="p-2 border w-full"/>
			</label>
		</p>

		<p>
			<label class="block text-gray-600">
				{{__('contact.form.contact_phone')}}
				<input type="tel" name="contact_phone" class="p-2 border w-full"/>
			</label>
		</p>

		<p>
			<label class="block text-gray-600">
				{{__('contact.form.message')}}
				<textarea name="message" class="p-2 border w-full"></textarea>
			</label>
		</p>

	</section>

	<p class="my-8">
		<input type="checkbox" name="legal_terms" value="1" id="input_legal_terms">
		<a class="underline text-indigo-500" href="#">{{__('contact.form.legal_terms')}}</a>
	</p>

	<p>
		<button class="block cursor-pointer p-4 w-2/3 mt-8 mx-auto rounded-full bg-indigo-500 text-white uppercase font-semibold" type="submit">
			{{__('contact.form.submit')}}
		</button>
	</p>
</form>
@endsection