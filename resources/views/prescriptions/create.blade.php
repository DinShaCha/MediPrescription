<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Upload Prescription') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('prescriptions.store') }}" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
                        @csrf

                        <!-- Title -->
                        <h2 class="text-xl font-bold mb-4 text-center">Upload Prescription</h2>

                        <!-- Prescription Upload -->
                        <div class="mb-4">
                            <label for="prescriptions" class="block font-medium text-gray-700 mb-1">Upload Prescription Images (Max 5):</label>
                            <input type="file" name="prescriptions[]" multiple accept="image/*" required
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <p class="mt-1 text-xs text-gray-500">You can upload up to 5 images.</p>
                        </div>

                        <!-- Note -->
                        <div class="mb-4">
                            <label for="note" class="block font-medium text-gray-700 mb-1">Note (Optional):</label>
                            <textarea name="note" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                placeholder="Additional information..."></textarea>
                        </div>

                        <!-- Delivery Address -->
                        <div class="mb-4">
                            <label for="address" class="block font-medium text-gray-700 mb-1">Delivery Address:</label>
                            <input type="text" name="address" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                placeholder="123 Example Street, City">
                        </div>

                        <!-- Delivery Time Slot -->
                        <div class="mb-4">
                            <label for="delivery_time" class="block font-medium text-gray-700 mb-1">Preferred Delivery Time Slot:</label>
                            <select name="delivery_time" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="">Select a time slot</option>
                                <option value="08:00:00">08:00 - 10:00</option>
                                <option value="10:00:00">10:00 - 12:00</option>
                                <option value="12:00:00">12:00 - 14:00</option>
                                <option value="14:00:00">14:00 - 16:00</option>
                                <option value="16:00:00">16:00 - 18:00</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="w-full bg-black text-white rounded px-4 py-2 hover:bg-gray-800 transition">
                                Submit Prescription
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>