<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta content="{{ csrf_token() }}" name="csrf-token">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Fonts -->
	<link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

	<!-- Scripts -->
	<!-- Production Vite Assets -->
	<link as="style" href="{{ asset('build/assets/app-839edf75.css') }}" rel="preload" />
	<link href="{{ asset('build/assets/app-f45bc62d.js') }}" rel="modulepreload" />
	<link href="{{ asset('build/assets/app-839edf75.css') }}" rel="stylesheet" />
	<script type="module" src="{{ asset('build/assets/app-f45bc62d.js') }}"></script>
	{{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body class="font-sans antialiased">
	<div class="min-h-screen bg-gray-100">
		@include('layouts.navigation')

		<!-- Page Heading -->
		@if (isset($header))
			<header class="bg-white shadow">
				<div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
					{{ $header }}
				</div>

			</header>
		@endif

		<!-- Page Content -->
		<main>
			{{ $slot }}
		</main>
	</div>
	<x-flash />
</body>

</html>
