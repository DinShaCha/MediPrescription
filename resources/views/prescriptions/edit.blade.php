<x-app-layout>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Prescriptions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex flex-wrap">
                <!-- Left: Prescription Viewer (50%) -->
                <div class="w-full md:w-1/2 p-4">
                    <div class="zoom-container" style="display: flex; flex-direction: column; align-items: flex-start; max-height: 700px; overflow-y: auto;">
                        {{-- Main Zoomable Image --}}
                        <img id="mainImage"
                            src="{{ isset($prescription->prescription[0]) ? asset($prescription->prescription[0]) : '' }}"
                            alt="Zoomed Prescription"
                            onclick="toggleZoom()"
                            style="max-width: 100%; max-height: 400px; object-fit: contain; border: 2px solid #444; border-radius: 8px; margin-bottom: 20px;">
                        {{-- Thumbnail Images --}}
                        <div style="display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; max-width: 570px; overflow-y: auto;">
                            @foreach ($prescription->prescription ?? [] as $image)
                            <img src="{{ asset($image) }}"
                                alt="Thumbnail"
                                onclick="showInMainImage('{{ asset($image) }}')"
                                style="width: 80px; height: 80px; object-fit: cover; cursor: pointer; border: 1px solid #ccc; border-radius: 6px;">
                            @endforeach
                        </div>
                    </div>
                </div>


                <!-- Right: Calculations Placeholder (50%) -->
                <div class="w-full md:w-1/2 p-4">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-bold mb-4 border-b pb-2">Quotation</h3>

                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 border-b">Drug</th>
                                    <th class="px-4 py-2 border-b">Quantity</th>
                                    <th class="px-4 py-2 border-b">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($presMedi as $pres)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $pres->medicine->name }}</td>
                                    <td class="px-4 py-2">{{ $pres->medicine->unit_price }} x {{ $pres->quantity }}</td>
                                    <td class="px-4 py-2">{{ number_format($pres->total_price, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @php
                        $total = $presMedi->sum('total_price');
                        @endphp

                        <div class="mt-4 text-right">
                            <span class="font-semibold text-lg">Total:</span>
                            <span class="text-lg">{{ number_format($total, 2) }}</span>
                        </div>

                        @if(auth()->user()->is_admin)
                        <!-- Add Medicine Form -->
                        <form method="POST" action="{{ route('orders.store', $prescription) }}" class="mt-6 space-y-4">
                            @csrf
                            <div>
                                <label class="block font-medium mb-1">Drug:</label>
                                <select name="drug" class="w-full border border-gray-300 rounded px-3 py-2">
                                    @foreach($medicines as $medicine)
                                    <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block font-medium mb-1">Quantity:</label>
                                <input type="number" name="quantity" class="w-full border border-gray-300 rounded px-3 py-2" min="1" step="1">
                            </div>

                            <button type="submit" class="w-full bg-black text-white rounded px-4 py-2 hover:bg-gray-800 transition">
                                Add
                            </button>
                        </form>

                        <!-- Send Quotation Form -->
                        <form method="POST" action="{{ route('orders.update', $prescription) }}" class="mt-4">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="w-full bg-black text-white rounded px-4 py-2 hover:bg-gray-800 transition">
                                Send Quotation
                            </button>
                        </form>
                        @endif
                        @if(!auth()->user()->is_admin)
                        <form method="POST" action="{{ route('prescriptions.update', $prescription) }}" class="mt-4">
                            @csrf
                            @method('PUT')
                            <button type="submit" value="ACCEPTED" name="status" class="w-full bg-black text-white rounded px-4 py-2 hover:bg-gray-800 transition">
                                Accept Quotation
                            </button>
                        </form>
                        <form method="POST" action="{{ route('prescriptions.update', $prescription) }}" class="mt-4">
                            @csrf
                            @method('PUT')
                            <button type="submit" value="REJECTED" name="status" class="w-full bg-black text-white rounded px-4 py-2 hover:bg-gray-800 transition">
                                Reject Quotation
                            </button>
                        </form>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>