<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta content="{{ csrf_token() }}" name="csrf-token">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Fonts -->
	<link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

	<!-- Production Vite Assets -->
	<link as="style" href="{{ asset('build/assets/app-839edf75.css') }}" rel="preload" />
	<link href="{{ asset('build/assets/app-f45bc62d.js') }}" rel="modulepreload" />
	<link href="{{ asset('build/assets/app-839edf75.css') }}" rel="stylesheet" />
	<script type="module" src="{{ asset('build/assets/app-f45bc62d.js') }}"></script>
	<!-- Scripts -->
	{{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body class="font-sans text-gray-900 antialiased">
	<div class="space-x-5 p-10">
		<a class="ml-10" href="{{ route('register') }}">Register</a>
		<a href="{{ route('login') }}">Login</a>
	</div>
	<div class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0">
		<div>
			<h1>
				Login to access shop
			</h1>
		</div>

		<div class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg">
			{{ $slot }}
		</div>
	</div>
</body>

</html>
