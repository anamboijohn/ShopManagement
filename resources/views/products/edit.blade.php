<x-app-layout>
	<center>
		<div class="mt-5 grid max-w-md rounded-lg bg-white p-6 shadow-lg">
			<form action="{{ route('product.update', ['product'=>$product->id]) }}" method="POST">
				@csrf
                @method('PATCH')
				<x-form.input :value="old('name')" name="name" placeholder="name" value="{{$product->name}}"/>

				<x-form.text-area name="description">{{ old('description', $product->description) }}</x-form.text-area>

				<x-form.input :value="old('price', $product->price)" name='price' placeholder="₵Unit Price" type='number' step="0.01" min="0" />

				<x-form.input :value="old('quantity', $product->quantity)" name='quantity' placeholder="Total Number" type='number' />

				<center>
					<x-primary-button class="ml-3">
						{{ __('Update') }}
					</x-primary-button>
				</center>

			</form>
	</center>
	</div>
</x-app-layout>
