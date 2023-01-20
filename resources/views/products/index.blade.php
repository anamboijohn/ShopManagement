<x-app-layout>

	<div class="mb-3">
		<form action="{{ url()->current() }}" method="GET">
			<label class="m b-2 sr-only text-sm font-medium text-gray-900 dark:text-gray-300" for="default-search">Search</label>
			<div class="relative">
				<div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
					<svg class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
						xmlns="http://www.w3.org/2000/svg">
						<path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-linecap="round" stroke-linejoin="round"
							stroke-width="2"></path>
					</svg>
				</div>
				<input
					class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-4 pl-10 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
					id="default-search" name="search" placeholder="Search products" required type="search">
				<button
					class="absolute right-2.5 bottom-2.5 rounded-lg bg-blue-700 px-4 py-2 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
					type="submit">Search</button>
			</div>
		</form>
        <a href="{{ route('product.index') }}" class="ml-5 px-3 py-2 rounded-lg hover:text-blue-400 mt-20">All products</a>

	</div>

	<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
		<table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
			<thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
				<tr>
					<th class="px-6 py-3" scope="col">
						Product name
					</th>
					<th class="px-6 py-3" scope="col">
						Unit Price (GH₵)
					</th>
					<th class="px-6 py-3" scope="col">
						Quantity in Stock
					</th>
					<th class="px-6 py-3" scope="col">
						Actions
					</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($products as $product)
					@php
						$class = '';
						if ($product->quantity <= 20) {
						    $class = 'bg-red-500 text-white';
						} elseif ($product->quantity <= 50) {
						    $class = 'bg-yellow-500 text-white';
						} elseif ($product->quantity <= 100) {
						    $class = 'bg-orange-500 text-white';
						}
					@endphp
					<tr class="border-b bg-gray-50 dark:border-gray-700 dark:bg-gray-800 {{ $class }}">
						<th class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white" scope="row">
							{{ $product->name }}
						</th>
						<td class="px-6 py-4">
							{{ $product->price }}
						</td>
						<td class="px-6 py-4">
							{{ $product->quantity }}
						</td>
						<td class="px-6 py-4">
							<div class="flex gap-5">
								<div class="inline-flex">

									<form action="{{ route('cart.store') }}" enctype="multipart/form-data" method="POST">
										@csrf
										<input name="id" type="hidden" value="{{ $product->id }}">
										<input name="name" type="hidden" value="{{ $product->name }}">
										<input name="price" type="hidden" value="{{ $product->price }}">
										<input name="quantity" type="hidden" value="1">
										<button class="rounded bg-blue-800 px-4 py-2 text-white" type="submit">Add To Cart</button>
									</form>
								</div>
								@if ($class != '')
                                <div class="inline-flex">
									<p class="font-semibold"> This product is finishing...</p>
								</div>
                                @endif
							</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</x-app-layout>
