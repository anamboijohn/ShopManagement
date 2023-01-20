<x-app-layout>
    @include('components.form.validation-styles')
    <center><h1>Add mor Stock Here</h1></center>
    <center>
            <div class="mt-5 grid max-w-md rounded-lg bg-white p-6 shadow-lg">
                    <form action="{{ route('product.stockUpdate', ['product' => $product->id]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            Exp Date:<x-form.input :value="old('exp', $product->exp)" min="{{ now()->addMonth()->format('Y-m-d')}}" name="exp"
                                    type='date' />

                            <x-form.input  name='quantity' min="0" placeholder="how many products are you adding?" type='number' />

                            <center>
                                    <x-primary-button class="ml-3">
                                            {{ __('Update') }}
                                    </x-primary-button>
                            </center>

                    </form>
    </center>
    </div>
</x-app-layout>
