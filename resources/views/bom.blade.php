<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Bom') }}
            </h2>
            <h5>{{ $assets->name }}</h5>
            <a href="#" class="text-sm hover:text-gray-700 btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDataModal">Add Bom</a>
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
            <form method="post" action="{{ route('bom.insert', ['asset_id' => $assets->id]) }}">
                @csrf
                @method('post')
                    <!-- Input fields -->
                    <div class="mb-3">
                        <label for="serial" class="form-label">Serial</label>
                        <input type="text" class="form-control" name="serial" id="serial" placeholder="Enter Serial">
                    </div>
                    <div class="mb-3">
                        <label for="condition" class="form-label">Condition</label>
                        <input type="text" class="form-control" name="condition" id="condition" placeholder="Enter Condition">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" name="status" id="status" placeholder="Enter Status">
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Note</label>
                        <input type="text" class="form-control" name="note" id="note" placeholder="Enter Note">
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
                        <label for="serial" class="form-label">Serial</label>
                        <input type="text" class="form-control" name="serial" id="editSerial" placeholder="Enter Serial">
                    </div>
                    <div class="mb-3">
                        <label for="condition" class="form-label">Condition</label>
                        <input type="text" class="form-control" name="condition" id="editCondition" placeholder="Enter Condition">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" name="status" id="editStatus" placeholder="Enter Status">
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Note</label>
                        <input type="text" class="form-control" name="note" id="editNote" placeholder="Enter Note">
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
                                Serial
                            </th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Condition
                            </th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Note
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
                        @foreach($boms as $bom)
                        <tr>
                            <td class="px-4 py-2">{{$bom->serial}}</td>
                            <td class="px-4 py-2">{{$bom->condition}}</td>
                            <td class="px-4 py-2">{{$bom->status}}</td>
                            <td class="px-4 py-2">{{$bom->note}}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="edit-btn btn btn-warning"
                                data-serial="{{$bom->serial}}" data-condition="{{$bom->condition}}" data-status="{{$bom->status}}" data-note="{{$bom->note}}"
                                data-action="{{route('bom.update', ['bom_id' => $bom->id, 'asset_id' => $bom->asset_id])}}"
                                data-bs-toggle="modal" data-bs-target="#editDataModal">Edit</a>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <form method="post" action="{{ route('bom.delete', ['asset_id' => $bom->asset_id, 'bom_id' => $bom->id]) }}">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Delete" class="btn btn-danger"></input>
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
    var editButtons = document.querySelectorAll('.edit-btn');
    
    editButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var serial = this.getAttribute('data-serial');
            var condition = this.getAttribute('data-condition');
            var status = this.getAttribute('data-status');
            var note = this.getAttribute('data-note');
            var action = this.getAttribute('data-action');  // Correctly get the action attribute

            var form = document.getElementById('editDataForm');
            form.action = action;
            form.querySelector('#editSerial').value = serial;
            form.querySelector('#editCondition').value = condition;
            form.querySelector('#editStatus').value = status;
            form.querySelector('#editNote').value = note;
        });
    });
});
</script>