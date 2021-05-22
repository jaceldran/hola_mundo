<html>

<head>
	<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>{{ config('app.name', 'Laravel') }}</title>

		<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

		{{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}" /> --}}

		<script defer src="{{ mix('js/app.js') }}"></script>
	</head>

</head>

<body class="bg-indigo-50">
	<header class="bg-indigo-600">
		<div class="container mx-auto py-4 flex justify-between items-center">
			<a href="/" class=" text-white text-lg font-semibold uppercase">
				HOME
			</a>
			<nav class="uppercase font-semibold flex gap-4 text-sm text-white">
				<a class="py-2 px-4 inline-block  hover:bg-indigo-500 rounded-full" href="/contact">Contact</a>

				<a class="py-2 px-4 inline-block hover:bg-indigo-500 rounded-full" href="/manage">Manage</a>
				{{-- <a class="py-2 px-4 inline-block text-white hover:bg-indigo-700" href="/sandbox/mailtrap">mailtrap</a> --}}
				{{-- <a class="py-2 px-4 inline-block text-white hover:bg-indigo-700" href="/sandbox/pdf">pdf</a> --}}
			</nav>
		</div>
	</header>

	<main id="app">
		@yield('content')
	</main>

	{{-- <footer class="bg-indigo-600">
		<div class="container mx-auto py-4 text-white text-lg font-semibold uppercase">
			footer
		</div>
	</footer> --}}
</body>

</html>