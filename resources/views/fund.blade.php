<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Fund') }}
            </h2>
            <h5>{{ $budgets->name }}</h5>
            <a href="#" class="text-sm hover:text-gray-700 btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDataModal">Add Fund</a>
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
            <form method="post">
                @csrf
                @method('post')
                    <!-- Input fields -->
                    <div class="mb-3">
                        <label for="used" class="form-label">Used</label>
                        <input type="number" class="form-control" name="used" id="used" placeholder="Enter Used Nominal">
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

<!-- body -->
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                            {{-- <td><a href="{{ route('fund.index', ['budget_id' => $budget->id]) }}">Detail</a></td>
                            <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="edit-btn" 
                                data-name="{{$budget->name}}" data-year="{{$budget->year}}" data-nominal="{{$budget->nominal}}"
                                data-action="{{route('budget.update', ['budget_id' => $budget->id])}}"
                                data-bs-toggle="modal" data-bs-target="#editDataModal">Edit</a>
                            </td>

                            <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <form method="post" action="{{route('budget.delete', ['budget_id' => $budget])}}">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Delete" class="text-red-600 hover:text-red-900"></input>
                                </form>
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</x-app-layout>