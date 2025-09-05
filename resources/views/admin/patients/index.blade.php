<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Patients List') }}
            </h2>
            <a href="{{ route('admin.patients.create') }}"
                class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                + Create Patient
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    {{-- hospital Select based on selected hospital --}}
                    <div class="mb-4">
                        <label for="hospital" class="block text-gray-700 font-bold mb-2">Select Hospital to
                            Filter</label>
                        <select id="hospital" name="hospital"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">N\A</option>
                            @foreach ($hospitals as $hospital)
                                <option value="{{ $hospital->id }}"
                                    {{ request()->query('hospital') == $hospital->id ? 'selected' : '' }}>
                                    {{ $hospital->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('hospital')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
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
                            @foreach ($patients as $patient)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $patient->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $patient->address }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $patient->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $patient->phone_number }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 flex space-x-2">
                                        <a href="{{ route('admin.patients.show', $patient) }}"
                                            class="text-blue-600 hover:underline">Detail</a>
                                        <form action="{{ route('admin.patients.destroy', $patient) }}" method="POST"
                                            id="delete-form-{{ $patient->id }}" style="display:inline;">
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
                        {{ $patients->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


@stack('scripts')
<script>
    console.log('script loaded');
    $(function() {
        $('form[id^="delete-form-"]').on('submit', function(e) {
            e.preventDefault();

            if (!confirm('Are you sure you want to delete this hospital?')) return;

            var $form = $(this);
            var $row = $form.closest('tr');
            var token = $form.find('input[name="_token"]').val();

            $.ajax({
                url: $form.attr('action'),
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                success: function() {
                    $row.remove();
                },
                error: function(xhr) {
                    console.error(xhr.responseJSON);
                    alert('Failed to delete hospital. Check the console for details.');
                }
            });
        });

        $('#hospital').on('change', function() {
            var selected = $(this).val();
            var url = window.location.pathname;
            if (selected) {
                url += '?hospital=' + encodeURIComponent(selected);
            }
            window.location.href = url;
        });
    });
</script>
