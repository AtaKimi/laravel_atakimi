<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hospital Details') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <tbody>
                        <tr>
                            <th class="px-6 py-4 text-left font-medium text-gray-700">Name</th>
                            <td class="px-6 py-4">{{ $hospital->name }}</td>
                        </tr>
                        <tr>
                            <th class="px-6 py-4 text-left font-medium text-gray-700">Phone</th>
                            <td class="px-6 py-4">{{ $hospital->phone_number }}</td>
                        </tr>
                        <tr>
                            <th class="px-6 py-4 text-left font-medium text-gray-700">Email</th>
                            <td class="px-6 py-4">{{ $hospital->email }}</td>
                        </tr>
                        <tr>
                            <th class="px-6 py-4 text-left font-medium text-gray-700">Address</th>
                            <td class="px-6 py-4">{{ $hospital->address }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="px-6 py-4">
                    <a href="{{ route('admin.hospitals.edit', $hospital->id) }}"
                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
