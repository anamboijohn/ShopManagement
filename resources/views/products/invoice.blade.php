<html>

<head>
	<!-- Scripts -->
	<!-- Production Vite Assets -->
	<link as="style" href="{{ asset('build/assets/app-839edf75.css') }}" rel="preload" />
	<link href="{{ asset('build/assets/app-f45bc62d.js') }}" rel="modulepreload" />
	<link href="{{ asset('build/assets/app-839edf75.css') }}" rel="stylesheet" />
	<link href="{{ asset('print.css') }}" rel="stylesheet">
	<script type="module" src="{{ asset('build/assets/app-f45bc62d.js') }}"></script>

	<div class="flex min-h-screen items-center justify-center bg-gray-100">
</head>

<body>
	<div class="w-3/5 bg-white shadow-lg print">
		<div class="flex justify-between p-4">
			<div>
				<h1 class="text-3xl font-extrabold italic tracking-widest text-indigo-500">{{ auth()->user()?->name }}</h1>
				<p class="text-base">An invoice of payment made on {{ now()->format('d-m-Y') }}.</p>
			</div>
		</div>
		<div class="h-0.5 w-full bg-indigo-500"></div>
		<div class="flex justify-between p-4">
			<div>
				<h6 class="font-bold">Order Date : <span class="text-sm font-medium">{{ now()->format('d/m/Y') }}</span></h6>
			</div>
			<div></div>
		</div>
		<div class="flex justify-center p-4">
			<div class="border-b border-gray-200 shadow">
				<table class="">
					<thead class="bg-gray-50">
						<tr>
							<th class="px-4 py-2 text-xs text-gray-500">
								#
							</th>
							<th class="px-4 py-2 text-xs text-gray-500">
								Product Name
							</th>
							<th class="px-4 py-2 text-xs text-gray-500">
								Quantity
							</th>
							<th class="px-4 py-2 text-xs text-gray-500">
								Unit Price
							</th>
							<th class="px-4 py-2 text-xs text-gray-500">
								Subtotal
							</th>
						</tr>
					</thead>
					<tbody class="bg-white">
						@foreach ($items as $item)
							<tr class="whitespace-nowrap">
								<td class="px-6 py-4 text-sm text-gray-500">
									{{ $item->id }}
								</td>
								<td class="px-6 py-4">
									<div class="text-sm text-gray-900">
										{{ $item->name }}
									</div>
								</td>
								<td class="px-6 py-4">
									<div class="text-sm text-gray-500">{{ $item->quantity }}</div>
								</td>
								<td class="px-6 py-4">
									<div class="text-sm text-gray-500">{{ $item->price }}</div>
								</td>
								<td class="px-6 py-4">
									{{ $item->quantity * $item->price }}
								</td>
							</tr>
						@endforeach
						<!--end tr-->
						<tr class="bg-gray-800 text-white">
							<th colspan="3"></th>
							<td class="text-sm font-bold"><b>Total</b></td>
							<td class="text-sm font-bold"><b>GH₵{{ $total }}</b></td>
						</tr>
						<!--end tr-->

					</tbody>
				</table>
			</div>
		</div>
		<div class="flex justify-between p-4">
			{{-- <div>
					<h3 class="text-xl">Terms And Condition :</h3>
					<ul class="list-inside list-disc text-xs">
						<li>All accounts are to be paid within 7 days from receipt of invoice.</li>
						<li>To be paid by cheque or credit card or direct payment online.</li>
						<li>If account is not paid within 7 days the credits details supplied.</li>
					</ul>
				</div> --}}
			<div class="p-4">
				<h3>Signature</h3>
				<div class="text-4xl italic text-indigo-500">AAA</div>
			</div>
		</div>
		<div class="h-0.5 w-full bg-indigo-500"></div>

		<div class="p-4">
			<div class="flex items-center justify-center">
				Thank you very much for doing business with us.
			</div>
			<div class="flex items-end justify-end space-x-3">
				<button class="bg-green-100 px-4 py-2 text-sm text-green-600"  onclick="window.print(); return false;">Print</button>
				<a class="bg-red-100 px-4 py-2 text-sm text-red-600" href="{{route('cart.list')}}" >Cancel</a>
			</div>
		</div>

	</div>
	</div>
</body>

</html>
