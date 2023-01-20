<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-semibold leading-tight text-gray-800">
			{{ __('Dashboard') }}
		</h2>
	</x-slot>

	<div class="py-12">

		<!-- Specify a custom Tailwind configuration -->
		<script type="tailwind-config">
        {
        theme: {
            extend: {
            colors: {
                blue: colors.sky,
            }
            }
        }
        }
    </script>

		<!-- Custom style for toggle -->
		<style type="postcss">
			#toggle:checked+label>span:first-child {
				@apply left-[22px];
			}
		</style>

		<!-- Snippet -->
		<section class="flex flex-col justify-center bg-gray-100 p-4 text-gray-600 antialiased">
			<div class="h-full">
				<!-- Toggle switch -->
				<div class="mb-10 flex justify-center space-x-2">
					<div class="flex-row">
						<form action="{{ url()->current() }}" method="GET">
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
									id="default-search" name="search" placeholder="Search Mockups, Logos..." required type="search">
								<button
									class="absolute right-2.5 bottom-2.5 rounded-lg bg-blue-700 px-4 py-2 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
									type="submit">Search</button>
							</div>
						</form>
					</div>

					<div class="flex-row">
						<a
							class="mb-2 rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
							href="{{ route('product.create') }}" role="button">Add Product+</a>
                        <a href="{{ route('dashboard') }}" class="ml-5 border border-solid border-blue-400 px-3 py-2 rounded-lg hover:bg-blue-400 ">All products</a>
					</div>
				</div>
				<center>
					<div class="mb-5 w-fit" x-data={show:false}>

						<button @click="show = !show" class="font-semibold"
							x-text="show ? 'Close Product card color meaning' : 'Show Product card color meaning'"> show</button>
						<ul class="bg-black" x-show="show" style="display:none">
							<li class="text-red-500">Red (Products in stock are less than or equal to 20)</li>
							<li class="text-yellow-500">Yellow (Products in stock are within the range 21-50)</li>
							<li class="text-orange-500">Orange (Products in stock are within the raange 51-100)</li>
							<li class="text-white">White (Products in stock are greater than 100)</li>
						</ul>
					</div>
				</center>
				@if ($products->isEmpty())
					<div class="text-xl text-red-400">
						No Products Added Yet. Please Click on Add Products to add some products
					</div>
				@endif
				<!-- Pricing tabs -->
				<div class="grid grid-cols-12 gap-6">
					<!-- Tab 3 -->
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
						<div
							class="{{ $class }} relative col-span-10 rounded-md border border-gray-200 bg-white shadow-md md:col-span-5 lg:col-span-4">
							<div aria-hidden="true" class="absolute top-0 left-0 right-0 h-0.5 bg-indigo-500"></div>
							<div class="border-b border-gray-200 px-5 pt-5 pb-6">
								<header class="mb-2 flex items-center">
									<a class="mr-3 h-6 w-6 flex-shrink-0 rounded-full bg-gradient-to-tr from-indigo-500 to-indigo-300"
										href="#">
										<svg class="h-6 w-6 fill-current text-white" viewBox="0 0 24 24">
											<path
												d="M12 17a.833.833 0 01-.833-.833 3.333 3.333 0 00-3.334-3.334.833.833 0 110-1.666 3.333 3.333 0 003.334-3.334.833.833 0 111.666 0 3.333 3.333 0 003.334 3.334.833.833 0 110 1.666 3.333 3.333 0 00-3.334 3.334c0 .46-.373.833-.833.833z" />
										</svg>
									</a>
									<h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
								</header>
								<div class="mb-2 text-sm">{{ $product->description }}</div>
								<!-- Price -->
								<div class="mb-4 font-bold text-gray-800">
									<span class="text-2xl">GH₵</span><span class="text-3xl">{{ $product->price }}</span><span
										class="text-sm font-medium text-gray-500">/item</span>
								</div>

								<!-- Image -->
								{{-- TO DO --}}
								<div class="flex gap-5">
									<div class="inline-flex">

										<form action="{{ route('cart.store') }}" enctype="multipart/form-data" method="POST">
											@csrf
											<input name="id" type="hidden" value="{{ $product->id }}">
											<input name="name" type="hidden" value="{{ $product->name }}">
											<input name="price" type="hidden" value="{{ $product->price }}">
											<input name="quantity" type="hidden" value="1">
											<button class="rounded bg-blue-800 px-4 py-2 text-white">Add To Cart</button>
										</form>
									</div>
									<div class="inline-flex">
										<a
											class="w-full items-center justify-center rounded border border-transparent bg-green-500 px-3 py-2 text-sm font-medium leading-5 text-white shadow-sm transition duration-150 ease-in-out hover:bg-green-600 focus:outline-none focus-visible:ring-2"
											href="{{ route('product.edit', ['product' => $product->id]) }}">Edit</a>
									</div>
									<div class="inline-flex">
										<a
											class="ease-in-ou w-full items-center justify-center rounded border border-transparent bg-orange-500 px-3 py-2 text-sm font-medium leading-5 text-white shadow-sm transition duration-150 hover:bg-orange-700 focus:outline-none focus-visible:ring-2"
											href="{{ route('product.stock', ['product' => $product->id]) }}"> Stock </a>
									</div>
									<div class="inline-flex">
										<x-alpine.modal>
											<x-slot name="trigger">
												<button
													class="w-full items-center justify-center rounded border border-transparent bg-red-500 px-3 py-2 text-sm font-medium leading-5 text-white shadow-sm transition duration-150 ease-in-out hover:bg-red-900 focus:outline-none focus-visible:ring-2">
													Delete </button>
											</x-slot>
											<x-slot name="content">
												Do you Really want to <span class="font-semibold text-red-400">Delete</span> this product:
												{{ $product->name }}?
											</x-slot>
											<x-slot name="buttons">
												<button
													class="rounded border border-black bg-black px-5 py-1 font-bold text-white hover:bg-white hover:text-black">
													NO
												</button>
												<x-form.submit-snippet :route="route('product.destroy', ['product' => $product->id])" value="Yes" />
											</x-slot>
										</x-alpine.modal>
									</div>
								</div>
							</div>
							<div class="px-5 pt-4 pb-5">
								<div class="mb-4 text-xs font-semibold uppercase text-gray-800">Item Info</div>
								<!-- List -->
								<ul>
									<li class="flex items-center py-1">
										<svg class="mr-2 h-3 w-3 flex-shrink-0 fill-current text-green-500" viewBox="0 0 12 12">
											<path d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
										</svg>
										<div class="text-sm">Quantity left: {{ $product->quantity }}</div>
									</li>
									<li class="flex items-center py-1">
										<svg class="mr-2 h-3 w-3 flex-shrink-0 fill-current text-green-500" viewBox="0 0 12 12">
											<path
												d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
										</svg>
										<div class="text-sm">Quantity Sold: {{ $product->quantity_sold }}</div>
									</li>
									<li class="flex items-center py-1">
										<svg class="mr-2 h-3 w-3 flex-shrink-0 fill-current text-green-500" viewBox="0 0 12 12">
											<path
												d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
										</svg>
										<div class="text-sm">Ammount Left in Stock: {{ 'GH₵' . $product->quantity * $product->price }}
										</div>
									</li>
									<li class="flex items-center py-1">
										<svg class="mr-2 h-3 w-3 flex-shrink-0 fill-current text-green-500" viewBox="0 0 12 12">
											<path
												d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
										</svg>
										<div class="text-sm">Ammount sold so far: GH₵{{ $product->quantity_sold * $product->price }}</div>
									</li>
									<li class="flex items-center py-1">
										<svg class="mr-2 h-3 w-3 flex-shrink-0 fill-current text-green-500" viewBox="0 0 12 12">
											<path
												d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
										</svg>
										<div class="text-sm">Last bought:
											{{ $product->records->sortByDesc('created_at')->first()?->created_at->diffForHumans() }}</div>
									</li>
									<li class="flex items-center py-1">
										<svg class="mr-2 h-3 w-3 flex-shrink-0 fill-current text-green-500" viewBox="0 0 12 12">
											<path
												d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
										</svg>
										<div class="text-sm">Last Edited/Stocked:
											{{ $product->updated_at?->format('d-m-Y') . ' ('.$product->updated_at?->diffForHumans() .')' }}</div>
									</li>
                                    <li class="flex items-center py-1">
										<svg class="mr-2 h-3 w-3 flex-shrink-0 fill-current text-green-500" viewBox="0 0 12 12">
											<path
												d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
										</svg>
										<div class="text-sm">Product added on: {{ $product->created_at->format('d-m-Y') . ' (' . $product->created_at->diffForHumans() .')'}}
										</div>
									</li>
									<li class="flex items-center py-1">
										<svg class="mr-2 h-3 w-3 flex-shrink-0 fill-current text-green-500" viewBox="0 0 12 12">
											<path
												d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
										</svg>
										<div class="text-sm">Expiry Date:
											{{ $product->exp . '(' . Carbon\Carbon::createFromFormat('Y-m-d', $product->exp)->diffForHumans() . ')' }}
										</div>
									</li>
								</ul>
							</div>
						</div>
					@endforeach
				</div>
			</div>
	</div>
	</section>
</x-app-layout>
