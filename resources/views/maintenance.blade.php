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

<!-- body -->
<div class="py-12">
        <div class="container">
            <div class="row">
                <!-- Card 1 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="https://images.pexels.com/photos/20182039/pexels-photo-20182039/free-photo-of-top-view-of-laptop-keyboard.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="Asset Image">
                        <div class="card-body">
                            <h5 class="card-title">Asset Name: <span id="assetName1">Laptop Thinkpad-321</span></h5>
                            <p class="card-text"><strong>Date:</strong> <span id="date1">2024-05-21</span></p>
                            <p class="card-text"><strong>Description:</strong> <span id="description1">Kerusakan pada motherboard</span></p>
                            <p class="card-text"><strong>Status:</strong> <span id="status1">Assigned</span></p>
                            <p class="card-text"><strong>Serial ID:</strong> <span id="serialId1">1234567890</span></p>
                            <p class="card-text"><strong>Division Requester:</strong> <span id="divisionRequester1">Finance Department</span></p>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="https://images.pexels.com/photos/20182039/pexels-photo-20182039/free-photo-of-top-view-of-laptop-keyboard.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="Asset Image">
                        <div class="card-body">
                            <h5 class="card-title">Asset Name: <span id="assetName2">Laptop Lenovo</span></h5>
                            <p class="card-text"><strong>Date:</strong> <span id="date2">2024-05-21</span></p>
                            <p class="card-text"><strong>Description:</strong> <span id="description2">Kerusakan pada keyboard</span></p>
                            <p class="card-text"><strong>Status:</strong> <span id="status2">Assigned</span></p>
                            <p class="card-text"><strong>Serial ID:</strong> <span id="serialId2">0987654321</span></p>
                            <p class="card-text"><strong>Division Requester:</strong> <span id="divisionRequester2">IT Department</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>