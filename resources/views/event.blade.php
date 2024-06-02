<x-app-layout>
<x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Event') }}
        </h2>
        <a href="#" class="text-sm hover:text-gray-700 btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDataModal">Add Event</a>
    </div>
</x-slot>

<!-- Modal Insert-->
<div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="editDataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataModalLabel">New Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="post" action="{{ route('event.insert') }}">
                @csrf
                @method('post')
                    <!-- Input fields -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
                    </div>
                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input type="date" class="form-control" name="year" id="year" placeholder="Enter year">
                    </div>
                    <div class="mb-3">
                        <label for="implementation" class="form-label">Implementation</label>
                        <input type="text" class="form-control" name="implementation" id="implementation" placeholder="" readonly>
                    </div>
                    <!-- End input fields -->
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Input" class="btn btn-primary" id="saveDataButton"></input>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Update -->
<div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataModalLabel">Edit Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="editDataForm" method="post" action="">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="editName" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="editName" placeholder="Enter new name">
                </div>
                <div class="mb-3">
                    <label for="editYear" class="form-label">Year</label>
                    <input type="date" class="form-control" name="year" id="editYear" placeholder="Enter new year">
                </div>
                <div class="mb-3">
                    <label for="editImplementation" class="form-label">Implementation</label>
                    <input type="text" class="form-control" name="implementation" id="editImplementation" placeholder="Enter new implementation" readonly>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Edit" class="btn btn-primary" id="saveDataButton">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<!-- body -->
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Year
                            </th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Implementation
                            </th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nominal
                            </th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Delete</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($lists as $event)
                        <tr>
                            <td class="px-4 py-2">{{ $event->name }}</td>
                            <td class="px-4 py-2">{{ $event->year }}</td>
                            <td class="px-4 py-2">{{ $event->implementation }}</td>
                            <td class="px-4 py-2">{{ $event->nominal }}</td>

                            <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="edit-btn"
                                data-name="{{ $event->name }}" data-year="{{ $event->year }}" data-implementation="{{ $event->implementation }}"
                                data-action="{{ route('event.update', ['event_id' => $event->id]) }}"
                                data-bs-toggle="modal" data-bs-target="#editDataModal">Edit</a>
                            </td>

                            <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <form method="post" action="{{ route('event.delete', ['event_id' => $event]) }}">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Delete" class="text-red-600 hover:text-red-900"></input>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var yearInput = document.getElementById('year');
        var implementationInput = document.getElementById('implementation');

        yearInput.addEventListener('change', function () {
            var date = new Date(yearInput.value);
            var month = date.toLocaleString('default', { month: 'long' });
            implementationInput.value = month;
        });

        var editYearInput = document.getElementById('editYear');
        var editImplementationInput = document.getElementById('editImplementation');

        editYearInput.addEventListener('change', function () {
            var date = new Date(editYearInput.value);
            var month = date.toLocaleString('default', { month: 'long' });
            editImplementationInput.value = month;
        });

        var editButtons = document.querySelectorAll('.edit-btn');
        editButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var name = this.getAttribute('data-name');
                var year = this.getAttribute('data-year');
                var implementation = this.getAttribute('data-implementation');
                var action = this.getAttribute('data-action');
                var form = document.getElementById('editDataForm');
                form.action = action;
                form.querySelector('#editName').value = name;
                form.querySelector('#editYear').value = year;
                form.querySelector('#editImplementation').value = implementation;
            });
        });
    });
</script>
