<x-app-layout>
	<main class="my-8">
		<div class="container mx-auto px-6">
			<div class="my-6 flex justify-center">
				<div class="pin-r pin-y flex w-full flex-col bg-white p-8 text-gray-800 shadow-lg md:w-4/5 lg:w-4/5">
					@if ($message = Session::get('success'))
						<div class="mb-3 rounded bg-green-400 p-4">
							<p class="text-green-800">{{ $message }}</p>
						</div>
					@endif
					<h3 class="text-bold text-3xl">Cart List</h3>
					<div class="flex-1">
						<table cellspacing="0" class="w-full text-sm lg:text-base">
							<thead>
								<tr class="h-12 uppercase">

									<th class="text-left">Name</th>
									<th class="pl-5 text-left lg:pl-0 lg:text-right">
										<span class="lg:hidden" title="Quantity">Qtd</span>
										<span class="hidden lg:inline">Quantity</span>
									</th>
									<th class="hidden text-right md:table-cell"> price/unit price</th>
									<th class="hidden text-right md:table-cell"> Remove </th>
								</tr>
							</thead>
							<tbody>
								@foreach ($cartItems as $item)
									<tr>
										<td>
											<a href="#">
												<p class="mb-2 md:ml-4">{{ $item->name }}</p>

											</a>
										</td>
										<td class="mt-6 justify-center md:flex md:justify-end">
											<div class="h-10 w-28">
												<div class="relative flex h-8 w-full flex-row">

													<form action="{{ route('cart.update') }}" method="POST">
														@csrf
														<input name="id" type="hidden" value="{{ $item->id }}">
														<input class="w-20 border-none bg-white text-center" name="quantity" type="number" step="any" min="1"
															value="{{ $item->quantity }}" />
														<button class="ml-2 mt-0 bg-blue-500 px-2 pb-2 text-white" type="submit">update</button>
													</form>
												</div>
											</div>
										</td>
										<td class="hidden text-right md:table-cell">
											<span class="text-sm font-medium lg:text-base">
												GH₵{{ $item->quantity * $item->price . '/' . $item->price }}
											</span>
										</td>
										<td class="hidden text-right md:table-cell">
											<form action="{{ route('cart.remove') }}" method="POST">
												@csrf
												<input name="id" type="hidden" value="{{ $item->id }}">
												<button class="bg-red-600 px-4 py-2 text-white">x</button>
											</form>

										</td>
									</tr>

								@endforeach

							</tbody>
						</table>
						<div class="font-bold">
							Total: GH₵{{ Cart::getTotal() }}
						</div>
						<div x-data="{ message: '' }">
                            <br><br>
                            <label for="num">Enter ammount paid to get change: </label> <br>
                            <input type="number" id="num" name="num" x-model="message" step="0.01" style="max-width: 100px" placeholder="Get Change">

                            <span :class="(message-{{Cart::getTotal()}}) < 0?'text-red-500':'text-green-500'" x-text="((message - {{Cart::getTotal()}}).toFixed(2) >= 0?'Give a balance of GH₵' + (message - {{Cart::getTotal()}}).toFixed(2) : 'The customer Owes GH₵' + ({{Cart::getTotal()}}-message )  )">
                        </div>
						<div class="mt-5 flex flex-row gap-5 lg:ml-72">
							<div>
								<form action="{{ route('cart.clear') }}" method="POST">
									@csrf
									<button class="bg-red-300 px-6 py-2 text-red-800">Remove All Cart</button>
								</form>
							</div>
                            @if (!$cartItems->isEmpty())
                            <form action="{{ route('cart.sell') }}" method="POST">
                                @csrf
                                <button class="bg-blue-700 px-6 py-2 text-white" type="submit">Sell</button>
                            </form>
                            @endif
                            <div>
                                <a href="{{route('invoice.index')}}" class="text-blue-600" style="color:blue">Print Invoice</a>
                            </div>
							<div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
</x-app-layout>
