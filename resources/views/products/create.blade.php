<x-app-layout>
		@php
				$classes = 'form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded  transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-900 focus:outline-none';
				$minExpDate = now()
				    ->addMonth()
				    ->format('Y-m-d');
		@endphp
		@include('components.form.validation-styles')
		<center>
				<div class="mt-5 grid max-w-md rounded-lg bg-white p-6 shadow-lg">
						<form action="{{ route('product.store') }}" method="POST">
								@csrf
								<x-form.input :value="old('name')" name="name" placeholder="name" />

                                <label for="description">Description: </label>
								<x-form.text-area name="description">{{ old('description') }}</x-form.text-area>

								<x-form.input :value="old('price')" min="0" name='price' placeholder="₵Unit Price" step="0.01"
										type='number' />
								<label for="start">Exp Date</label>

                                <x-form.input :value="old('exp', $product->exp)" min="{{ now()->addMonth()->format('Y-m-d')}}" name="exp"
                                    type='date' id="exp" value="{{ $minExpDate }}"/>

								<x-form.input :value="old('quantity')" name='quantity' placeholder="Total Number" type='number' min="0" />

								<center>
										<x-primary-button class="ml-3">
												{{ __('Create') }}
										</x-primary-button>
								</center>

						</form>
		</center>
		</div>
</x-app-layout>
