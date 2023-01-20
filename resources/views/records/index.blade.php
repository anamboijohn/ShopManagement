<x-app-layout>

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
		<div class="mb-3">
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
			</form>.
            <form action="{{route('pdf')}}"" method="get" class="ml-5">
                @php
                    $url = request()->fullUrl();
                    $ammount = 0;
                @endphp

                @if (request('date'))
					<input name="date" type="hidden" value="{{ request('date') }}">
				@endif

                @if (request('search'))
					<input name="search" type="hidden" value="{{ request('search') }}">
				@endif
                <input type="submit" value="Download Pdf" class="hover:cursor-pointer hover:text-blue-600" style="color:blue">
            </form>

        </div>
		<table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
			<thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
				<tr>
					<th class="px-6 py-3" scope="col">
						SN
					</th>
					<th class="px-6 py-3" scope="col">
						Product name
					</th>
					<th class="px-6 py-3" scope="col">
						Unit Price (GH₵)
					</th>
					<th class="px-6 py-3" scope="col">
						Quantity Sold
					</th>
					<th class="px-6 py-3" scope="col">
						Quantity in Stock
					</th>
					<th class="px-6 py-3" scope="col">
						Price (GH₵)
					</th>
					<th class="px-6 py-3" scope="col">
						Date
					</th>
				</tr>
			</thead>
			<tbody>
                @php
                    $count = 0;
                @endphp
				@foreach ($records as $record)
                @php
                    $count++;
                    $ammount += $record->price * $record->quantity_sold;
                @endphp
					<tr class="border-b bg-gray-50 dark:border-gray-700 dark:bg-gray-800">
						<th class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white" scope="row">
							{{ $count }}
						</th>
						<td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white" scope="row">
							{{ $record->product_name }}
						</td>
						<td class="px-6 py-4">
							{{ $record->price }}
						</td>
						<td class="px-6 py-4">
							{{ $record->quantity_sold }}
						</td>
						<td class="px-6 py-4">
							{{ $record->quantity_inStock }}
						</td>
						<td class="px-6 py-4">
							{{ $record->price * $record->quantity_sold }}
						</td>
						<td class="px-6 py-4">
							{{ $record->created_at->format('d-m-Y') }}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

        <p class="text-center">Total: GH₵{{$ammount}}</p>

		<div class="my-10">
			{{ $records->links() }}
		</div>
	</div>
</x-app-layout>
