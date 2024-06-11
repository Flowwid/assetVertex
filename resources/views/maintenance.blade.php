<x-app-layout>
<x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Maintenance') }}
        </h2>
        <div class="flex space-x-2">
            <a href="#" class="text-sm hover:text-gray-700 btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDataModal">Add Data</a>
        </div>
    </div>
</x-slot>

<!-- Modal Insert-->
<div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="editDataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataModalLabel">Add Datas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="post" action="{{route('maintenance.insert')}}" enctype="multipart/form-data">
                @csrf
                @method('post')
                    <!-- Input fields -->
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" name="date" id="date" placeholder="Enter date" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" name="description" id="description" placeholder="Enter description" required>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Condition</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="On-Repair">On-Repair</option>
                            <option value="Repaired">Repaired</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <input type="hidden" class="form-control" name="asset_name" id="asset_name" value="">
                    </div>
                    <div class="mb-3">
                        <label for="asset-option" class="form-label">Asset</label>
                        <select class="form-control" id="asset-option" name="asset_id" required>
                            @foreach ($asset as $asset)
                                <option value="{{ $asset->id }}">{{ $asset->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <input type="hidden" class="form-control" name="bom_serial" id="bom_serial" value="">
                    </div>
                    <div class="mb-3">
                        <label for="bom-option" class="form-label">Bom Serial</label>
                        <select class="form-control" id="bom-option" name="bom_id" required>
                            @foreach ($bom as $bom)
                                <option value="{{ $bom->id }}">{{ $bom->serial }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <input type="hidden" class="form-control" name="division_name" id="division_name" value="">
                    </div>
                    <div class="mb-3">
                        <label for="division-option" class="form-label">Division Name</label>
                        <select class="form-control" id="division-option" name="division_id" required>
                            @foreach ($division as $division)
                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" id="image" accept="image/*" placeholder="Choose image">
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

@foreach($maintenance as $maintenanceItem)
<div class="modal fade" id="deleteConfirmationModal{{$maintenanceItem->id}}" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel{{$maintenanceItem->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel{{$maintenanceItem->id}}">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this Maintenance item?
            </div>
            <div class="modal-footer">
                <form method="post" action="{{ route('maintenance.delete', ['maintenance_id' => $maintenanceItem->id]) }}">
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
    <div class="container">
        <div class="row">
            @foreach($maintenance as $maintenanceItem)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset($maintenanceItem->image) }}" class="card-img-top" alt="Maintenance Image" style="max-width: 100%; max-height: 200px;">
                    <div class="card-body">
                        <h5 class="card-title">Asset Name: {{ $maintenanceItem->asset_name }}</h5>
                        <p class="card-text"><strong>Date:</strong> {{ $maintenanceItem->date }}</p>
                        <p class="card-text"><strong>Description:</strong> {{ $maintenanceItem->description }}</p>
                        
                        <p class="card-text"><strong>Serial ID:</strong> {{ $maintenanceItem->bom_serial }}</p>
                        <p class="card-text"><strong>Division Requester:</strong> {{ $maintenanceItem->division_name }}</p>
                        <!-- Status dropdown -->
                        <form action="{{ route('maintenance.update', ['maintenance_id' => $maintenanceItem]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3" style="display:flex; align-items:center; text-align:center; gap: 15px;">
                                <p class="card-text"><strong>Status:</strong></p>
                                <select class="form-control" id="status" name="status" onchange="this.form.submit()" style="width: 150px;">
                                    <option value="On-Repair" {{ $maintenanceItem->status === 'On-Repair' ? 'selected' : '' }}>On-Repair</option>
                                    <option value="Repaired" {{ $maintenanceItem->status === 'Repaired' ? 'selected' : '' }}>Repaired</option>
                                </select>
                            </div>
                        </form>
                        <!-- End Status dropdown -->
                        <!-- Edit and Delete buttons -->
                        <div class="mt-3">
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{$maintenanceItem->id}}">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</x-app-layout>

<script>
    document.getElementById("asset-option").addEventListener("change", function() {
        var selectedAssetOption = this.options[this.selectedIndex];
        var assetName = selectedAssetOption.text;
        document.getElementById("asset_name").value = assetName;
    });

    document.getElementById("bom-option").addEventListener("change", function() {
        var selectedBomOption = this.options[this.selectedIndex];
        var bomName = selectedBomOption.text;
        document.getElementById("bom_serial").value = bomName;
    });

    document.getElementById("division-option").addEventListener("change", function() {
        var selectedDivisionOption = this.options[this.selectedIndex];
        var divisionName = selectedDivisionOption.text;
        document.getElementById("division_name").value = divisionName;
    });

</script>

<script>
    $(document).ready(function() {
        $('#asset-option').change(function() {
            var assetId = $(this).val();
            $.ajax({
                url: '{{ route("getBomSerials") }}', 
                type: 'GET',
                data: { asset_id: assetId },
                success: function(response) {
                    $('#bom-option').empty();
                    $.each(response, function(index, bomItem) {
                        $('#bom-option').append('<option value="' + bomItem.id + '">' + bomItem.serial + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

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