<x-app-layout>
		@include('components.form.validation-styles')
		<center>
				<div class="mt-5 grid max-w-md rounded-lg bg-white p-6 shadow-lg">
						<form action="{{ route('product.update', ['product' => $product->id]) }}" method="POST">
								@csrf
								@method('PATCH')
								<x-form.input :value="old('name')" name="name" placeholder="name" value="{{ $product->name }}" />

								<x-form.text-area name="description">{{ old('description', $product->description) }}</x-form.text-area>

								<x-form.input :value="old('price', $product->price)" min="0" name='price' placeholder="₵Unit Price" step="0.01"
										type='number' />
								Exp Date:<x-form.input :value="old('exp', $product->exp)" min="{{ now()->addMonth()->format('Y-m-d')}}" name="exp"
										type='date' />

								<x-form.input :value="old('quantity', $product->quantity)" name='quantity' placeholder="Total Number" type='number' min="0" />

								<center>
										<x-primary-button class="ml-3">
												{{ __('Update') }}
										</x-primary-button>
								</center>

						</form>
		</center>
		</div>
</x-app-layout>
