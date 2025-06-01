<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Prescriptions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-lg mt-6">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                        Image
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                        Note
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                        Delivery Address
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                        Delivery Time
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                        Actions
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($prescriptions as $prescription)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($prescription->prescription as $image)
                                            <img src="{{ asset($image) }}" alt="Prescription" class="w-16 h-16 object-cover rounded border" />
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">
                                        {{ $prescription->note }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">
                                        {{ $prescription->delivery_address }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">
                                        {{ \Carbon\Carbon::parse($prescription->delivery_time)->format('h:i A') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('prescriptions.edit', $prescription) }}" class="w-full bg-black text-white rounded px-4 py-2 hover:bg-gray-800 transition">
                                            View
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('prescriptions.edit', $prescription) }}">
                                            {{ $prescription->status }}
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>