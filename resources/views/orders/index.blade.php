<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Quotations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 border-b border-gray-200 text-left">Order ID</th>
                                <th class="py-3 px-6 border-b border-gray-200 text-left">Prescription ID</th>
                                <th class="py-3 px-6 border-b border-gray-200 text-left">Total Price</th>
                                <th class="py-3 px-6 border-b border-gray-200 text-left">Status</th>
                                <th class="py-3 px-6 border-b border-gray-200 text-left"></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($orders as $order)
                            @foreach ($order->prescriptions as $prescription)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-6 whitespace-nowrap">{{ $order->id }}</td>
                                <td class="py-3 px-6 whitespace-nowrap">{{ $prescription->id }}</td>
                                <td class="py-3 px-6 whitespace-nowrap">{{ number_format($order->total, 2) }}</td>
                                <td class="py-3 px-6 whitespace-nowrap">{{ $prescription->status }}</td>
                                <td class="py-3 px-6 whitespace-nowrap">
                                    <a href="{{ route('prescriptions.edit', $prescription) }}" class="w-full bg-black text-white rounded px-4 py-2 hover:bg-gray-800 transition">
                                        View
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>