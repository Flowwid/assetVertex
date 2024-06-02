<x-app-layout>
<x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Asset') }}
        </h2>
        <div class="flex space-x-2">
            <a href="#" class="text-sm hover:text-gray-700 btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDataModal">Add Data</a>
            <form action="{{ route('asset.export') }}" method="POST">
                @csrf
                <button type="submit" class="text-sm hover:text-gray-700 btn btn-grey btn-export">Export Data</button>
            </form>
        </div>
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
                <div id="inputFields">
                    <form method="post" id="addDataForm" action="{{ route('asset.insert') }}">
                        @csrf
                        @method('post')
                        <!-- Input fields -->
                        <div class="mb-3">
                            <label for="inputMethod">Choose Input Method:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="inputMethod" id="inputType" value="type" checked>
                                <label class="form-check-label" for="inputType">
                                    Normal Typing
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="inputMethod" id="inputCSV" value="csv">
                                <label class="form-check-label" for="inputCSV">
                                    CSV Upload
                                </label>
                            </div>
                        </div>
                        <div id="normalInputFields">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select class="form-control" name="type" id="type">
                                    <option value="electronic">Electronic</option>
                                    <option value="atk">ATK</option>
                                    <option value="furniture">furniture</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="specification" class="form-label">Specification</label>
                                <input type="text" class="form-control" name="specification" id="specification" placeholder="Enter specification">
                            </div>
                        </div>
                        <!-- End input fields -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="saveDataButton">Input</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
                <div id="csvInputFields" style="display: none;">
                    <form action="{{ route('asset.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">Import CSV</label>
                            <input type="file" name="file" id="file" accept=".csv">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="saveDataButton">Input</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
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
                    <label for="type" class="form-label">Type</label>
                    <select class="form-control" name="type" id="type">
                        <option value="electronic">Electronic</option>
                        <option value="atk">ATK</option>
                        <option value="furniture">furniture</option>
                    </select>
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

<!-- Delete Confirmation Modal -->
@foreach($lists as $asset)
<div class="modal fade" id="deleteConfirmationModal{{$asset->id}}" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel{{$asset->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel{{$asset->id}}">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this asset?
            </div>
            <div class="modal-footer">
                <form method="post" action="{{ route('asset.delete', ['asset_id' => $asset->id]) }}">
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
                            <td><a href="{{ route('bom.index', ['asset_id' => $asset->id]) }}" class="btn btn-outline-primary">Detail</a></td>
                            <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="edit-btn" 
                                data-name="{{$asset->name}}" data-type="{{$asset->type}}" data-specification="{{$asset->specification}}"
                                data-action="{{route('asset.update', ['asset_id' => $asset->id])}}"
                                data-bs-toggle="modal" data-bs-target="#editDataModal">Edit</a>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <button type="button" class="delete-btn btn btn-danger" 
                                        data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{$asset->id}}">
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

    //Edit modal
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

    //Radio View
    document.addEventListener("DOMContentLoaded", function () {
        const inputTypeRadio = document.getElementById('inputType');
        const inputCSVRadio = document.getElementById('inputCSV');
        
        const normalInputFields = document.getElementById('normalInputFields');
        const csvInputFields = document.getElementById('csvInputFields');
        
        const modalFooter = document.querySelector('.modal-footer');
        
        function toggleInputFields() {
            if (inputTypeRadio.checked) {
                normalInputFields.style.display = 'block';
                csvInputFields.style.display = 'none';
                modalFooter.style.display = 'block'; 
            } else if (inputCSVRadio.checked) {
                normalInputFields.style.display = 'none';
                csvInputFields.style.display = 'block';
                modalFooter.style.display = 'none'; 
            }
        }
        
        toggleInputFields();
        
        inputTypeRadio.addEventListener('change', toggleInputFields);
        inputCSVRadio.addEventListener('change', toggleInputFields);
    });

    //Export csv
    // document.addEventListener('DOMContentLoaded', function () {
    // var exportButton = document.querySelector('.btn-export');

    // exportButton.addEventListener('click', function () {
    //     exportTableToCSV();
    // });

    // function exportTableToCSV() {
    //     var rows = document.querySelectorAll('table tbody tr');
    //     var csvContent = "data:text/csv;charset=utf-8,";

    //     rows.forEach(function(row) {
    //         var rowData = [];
    //         var cols = row.querySelectorAll('td');

    //         cols.forEach(function(col, index) {
    //             if (index === 0 || index === 1 || index === 2) {
    //                 rowData.push('"' + col.innerText.replace(/"/g, '""') + '"'); // Escape double quotes
    //             }
    //         });

    //         csvContent += rowData.join(',') + '\n';
    //     });

    //     // Create a CSV file
    //     var encodedUri = encodeURI(csvContent);
    //     var link = document.createElement("a");
    //     link.setAttribute("href", encodedUri);
    //     link.setAttribute("download", "table_data.csv");
    //     document.body.appendChild(link);

    //     // Trigger download
    //     link.click();
    //     }
    // });
    
</script>


