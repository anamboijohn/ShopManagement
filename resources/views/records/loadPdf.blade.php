<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>records</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>


		<div class="mb-3">
            <h1> Sails record for {{now()->format('d-m-y')}}</h1>
		</div>
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
				@foreach ($records as $record)
					<tr class="border-b bg-gray-50 dark:border-gray-700 dark:bg-gray-800">
						<th class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white" scope="row">
							{{ $record->product_name }}
						</th>
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
	</div>

</body>
</html>
