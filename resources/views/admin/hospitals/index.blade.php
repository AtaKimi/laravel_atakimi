<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Hospitals List') }}
            </h2>
            <a href="{{ route('admin.hospitals.create') }}"
                class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                + Create Hospital
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Address</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Phone Number</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($hospitals as $hospital)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $hospital->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $hospital->address }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $hospital->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $hospital->phone_number }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 flex space-x-2">
                                        <a href="{{ route('admin.hospitals.show', $hospital) }}"
                                            class="text-blue-600 hover:underline">Detail</a>
                                        <form action="{{ route('admin.hospitals.destroy', $hospital) }}" method="POST"
                                            id="delete-form-{{ $hospital->id }}" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $hospitals->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


@stack('scripts')
<script>
    console.log('script loaded');
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('form[id^="delete-form-"]').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                if (!confirm('Are you sure you want to delete this hospital?')) return;

                let row = form.closest('tr');
                let token = form.querySelector('input[name="_token"]').value;

                fetch(form.action, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            // DO NOT set Content-Type; the browser does it for FormData
                        },
                        // body: new FormData(form) // A body is often not needed for a simple DELETE
                    })
                    .then(response => {
                        console.log('Response Status:', response.status);
                        if (response.ok) {
                            row.remove();
                        } else {
                            // Log the error for better debugging
                            response.json().then(data => console.error(data));
                            alert(
                                'Failed to delete hospital. Check the console for details.'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Fetch Error:', error);
                        alert('A network error occurred. Failed to delete hospital.');
                    });
            });
        });
    });
</script>
