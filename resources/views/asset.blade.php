<x-app-layout>
<x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Asset') }}
        </h2>
        <a href="#" class="text-sm hover:text-gray-700 btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDataModal">Add Data</a>
    </div>
</x-slot>


<!-- Modal Insert-->
<div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="editDataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataModalLabel">Add Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="post" action="{{route('asset.insert')}}">
                @csrf
                @method('post')
                    <!-- Input fields -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" class="form-control" name="type" id="type" placeholder="Enter Type">
                    </div>
                    <div class="mb-3">
                        <label for="specification" class="form-label">Specification</label>
                        <input type="text" class="form-control" name="specification" id="specification" placeholder="Enter specification">
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
                <h5 class="modal-title" id="editDataModalLabel">Edit Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="editDataForm" method="post" action="">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="editName" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="editName" placeholder="Enter name">
                </div>
                <div class="mb-3">
                    <label for="editType" class="form-label">Type</label>
                    <input type="text" class="form-control" name="type" id="editType" placeholder="Enter Type">
                </div>
                <div class="mb-3">
                    <label for="editSpecification" class="form-label">Specification</label>
                    <input type="text" class="form-control" name="specification" id="editSpecification" placeholder="Enter Specification">
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
                                Type
                            </th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                specification
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
                        @foreach($lists as $asset)
                        <tr>
                            <td class="px-4 py-2">{{$asset->name}}</td>
                            <td class="px-4 py-2">{{$asset->type}}</td>
                            <td class="px-4 py-2">{{$asset->specification}}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="edit-btn" 
                                data-name="{{$asset->name}}" data-type="{{$asset->type}}" data-specification="{{$asset->specification}}"
                                data-action="{{route('asset.update', ['asset_id' => $asset->id])}}"
                                data-bs-toggle="modal" data-bs-target="#editDataModal">Edit</a>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <form method="post" action="{{route('asset.delete', ['asset_id' => $asset])}}">
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
        var editButtons = document.querySelectorAll('.edit-btn');
        editButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var name = this.getAttribute('data-name');
                var type = this.getAttribute('data-type');
                var specification = this.getAttribute('data-specification');
                var action = this.getAttribute('data-action');
                var form = document.getElementById('editDataForm');
                form.action = action;
                form.querySelector('#editName').value = name;
                form.querySelector('#editType').value = type;
                form.querySelector('#editSpecification').value = specification;
            });
        });
    });
</script>

