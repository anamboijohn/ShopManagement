<x-app-layout>

    <center><h1 class="mt-5 font-semibold underline">Displayed Here are Products a Three Months away from Expiry</h1></center>
	<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
		<div class="flex gap-5 p-3">
			<form action="{{ url()->current() }}" method="GET">
				@if (request('search'))
					<input name="search" type="hidden" value="{{ request('search') }}">
				@endif
				<div class="flex gap-5">
					<input class="border border-none bg-gray-500" id="date" name="date" type="date">
					<input class="rounded-sm bg-blue-400 py-3 px-2 font-semibold text-white" type="submit" value="filter">
				</div>
			</form>
			<form action="{{ url()->current() }}" method="GET">
				<div class="flex gap-5">
					<input class="rounded-sm text-blue-400 py-3 px-2 font-semibold hover:text-white" type="submit" value="All Products">
				</div>
			</form>
		</div>
		{{-- <div class="mb-3">
			<form action="{{ url()->current() }}" method="GET">
				@if (request('date'))
					<input name="date" type="hidden" value="{{ request('date') }}">
				@endif
				<label class="m b-2 sr-only text-sm font-medium text-gray-900 dark:text-gray-300"
					for="default-search">Search</label>
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
            <a href="{{route('pdf')}}">Download Pdf</a>
		</div> --}}
		<table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
			<thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
				<tr>
					<th class="px-6 py-3" scope="col">
						Product name
					</th>
					<th class="px-6 py-3" scope="col">
						Quantity in Stock
					</th>
					<th class="px-6 py-3" scope="col">
						Exp Date
					</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($products as $product)
					<tr class="border-b bg-gray-50 dark:border-gray-700 dark:bg-gray-800">
						<th class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white" scope="row">
							{{ $product->name }}
						</th>
						<td class="px-6 py-4">
							{{ $product->quantity }}
						</td>
						<td class="px-6 py-4">
							{{$product->exp . ' ('. Illuminate\Support\Carbon::createFromFormat('Y-m-d', $product->exp)->diffForHumans() . ')' }}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="my-10">
			{{ $products->links() }}
		</div>
	</div>
</x-app-layout>
