<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Fund') }}
            </h2>
            <h5>{{ $budgets->name }}</h5>
            <a href="#" class="text-sm hover:text-gray-700 btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDataModal">Add Data</a>
        </div>
    </x-slot>

<!-- Modal Insert-->
<div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="editDataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataModalLabel">Add Fund</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="post" action="{{ route('fund.insert', ['budget_id' => $budgets->id]) }}">
                @csrf
                @method('post')
                    <!-- Input fields -->
                    <div class="mb-3">
                        <label for="used" class="form-label">Used</label>
                        <input type="number" class="form-control" name="used" id="used" placeholder="Enter Used Nominal">
                    </div>
                    <div class="mb-3">
                        <input type="hidden" class="form-control" name="event_name" id="event_name" placeholder="Enter Used Nominal" value="{{ $budgets->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="event-option" class="form-label">Event</label>
                        <select class="form-control" id="event-option" name="event_id">
                            @foreach ($events as $event)
                                <option value="{{ $event->id }}">{{ $event->name }}</option>
                            @endforeach
                        </select>
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
                <h5 class="modal-title" id="editDataModalLabel">Edit Fund</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editDataForm" method="post" action="">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editUsed" class="form-label">Name</label>
                        <input type="text" class="form-control" name="used" id="editUsed" placeholder="Enter used nominal">
                    </div>
                    <div class="mb-3">
                        <input type="hidden" class="form-control" name="event_name" id="editEventName">
                    </div>
                    <div class="mb-3">
                        <label for="event-option" class="form-label">Event</label>
                        <select class="form-control" id="editEventOption" name="event_id">
                            @foreach ($events as $event)
                                <option value="{{ $event->id }}">{{ $event->name }}</option>
                            @endforeach
                        </select>
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

<!-- Delete Confirmation Modal -->
@foreach($funds as $fund)
<div class="modal fade" id="deleteConfirmationModal{{$fund->id}}" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel{{$fund->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel{{$fund->id}}">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this fund?
            </div>
            <div class="modal-footer">
                <form method="post" action="{{ route('fund.delete', ['budget_id' => $fund->budget_id, 'fund_id' => $fund->id]) }}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- body -->
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session('alert'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('alert') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Used
                            </th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Event
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
                        @foreach($funds as $fund)
                        <tr>
                            <td class="px-4 py-2">{{$fund->used}}</td>
                            <td class="px-4 py-2">{{$fund->event_name}}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="edit-btn btn btn-warning" 
                                data-used="{{$fund->used}}" data-event-id="{{$fund->event_id}}" data-event-name="{{$fund->event_name}}"
                                data-action="{{route('fund.update', ['fund_id' => $fund->id, 'budget_id' => $fund->budget_id])}}"
                                data-bs-toggle="modal" data-bs-target="#editDataModal">Edit</a>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <button type="button" class="delete-btn btn btn-danger" 
                                        data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{$fund->id}}">
                                    Delete
                                </button>
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
    document.getElementById("event-option").addEventListener("change", function() {
        var selectedEventOption = this.options[this.selectedIndex];
        var eventName = selectedEventOption.text;
        document.getElementById("event_name").value = eventName; 
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var editButtons = document.querySelectorAll('.edit-btn');
        
        editButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var used = this.getAttribute('data-used');
                var event_id = this.getAttribute('data-event-id');
                var event_name = this.getAttribute('data-event-name');
                var action = this.getAttribute('data-action');

                var form = document.getElementById('editDataForm');
                form.action = action;
                form.querySelector('#editUsed').value = used;
                form.querySelector('#editEventOption').value = event_id;
                form.querySelector('#editEventName').value = event_name;
            });
        });

        var eventOptionElement = document.getElementById("editEventOption");
        eventOptionElement.addEventListener("change", function() {
            var selectedEventOption = this.options[this.selectedIndex];
            var eventName = selectedEventOption.text;
            document.getElementById("editEventName").value = eventName;
        });
    });
</script>

