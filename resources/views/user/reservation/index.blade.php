@extends('layouts.profile')

@section('content')
    @if(session('success'))
        <div id="success-message" class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-2xl font-bold mb-4">Reservation Management</h1>

    <!-- Status Legend -->
    <div class="mb-4 flex gap-6">
        <div class="flex items-center">
            <span class="block w-3 h-3 rounded-full bg-blue-500 mr-2"></span>
            <span class="text-gray-700">Scheduled</span>
        </div>
        <div class="flex items-center">
            <span class="block w-3 h-3 rounded-full bg-green-500 mr-2"></span>
            <span class="text-gray-700">Pending</span>
        </div>
        <div class="flex items-center">
            <span class="block w-3 h-3 rounded-full bg-red-500 mr-2"></span>
            <span class="text-gray-700">Canceled</span>
        </div>
    </div>

    <div class="flex justify-end gap-5 mb-4">
        @auth
            @if(auth()->user()->role == 'tutor' || auth()->user()->role == 'admin')
                <a href="{{ route('profile.reservations.create') }}" class="underline text-black hover:text-blue-700">Add reservation</a>
            @endif
        @endauth
    </div>

    <form method="GET" action="{{ route('profile.reservations.index') }}" class="mb-4 flex gap-2">
        <input type="text" name="search_reservation" placeholder="Search by tutor, participant, or status..." value="{{ request('search_reservation') }}" class="border rounded py-2 px-4 w-full">
        <input type="date" name="start_date" value="{{ request('start_date') }}" class="border rounded py-1 px-2 w-32">
        <button type="submit" class="bg-navy-500 text-white py-2 px-4 rounded hover:bg-blue-700">Search</button>
    </form>



    @if($reservations->isEmpty())
        <p class="text-gray-500">No reservations available.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b text-left">Status</th>
                        <th class="py-2 px-4 border-b text-left">Tutor</th>
                        <th class="py-2 px-4 border-b text-left">Participant</th>
                        <th class="py-2 px-4 border-b text-left">Date</th>
                        <th class="py-2 px-4 border-b text-left">Details</th>
                        <th class="py-2 px-4 border-b text-left">Update</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                        <tr class="hover:bg-gray-50">
                            <td class="border flex items-center justify-evenly px-4 py-2">
                                <!-- Show status as colored circle -->
                                @if($reservation->status == 'scheduled')
                                    <span class="block w-3 h-3 rounded-full bg-blue-500 mr-2"></span>
                                @elseif($reservation->status == 'pending')
                                    <span class="block w-3 h-3 rounded-full bg-green-500 mr-2"></span>
                                @elseif($reservation->status == 'canceled')
                                    <span class="block w-3 h-3 rounded-full bg-red-500 mr-2"></span>
                                @endif

                                <!-- Status Change Dropdown -->
                                <form action="{{ route('profile.reservations.updateStatus', $reservation->id) }}" method="POST" class="relative">
                                    @csrf
                                    @method('PATCH')

                                    <select name="status" class="bg-gray-200 rounded border p-2 appearance-none pr-10" onchange="this.form.submit()">
                                        <option value="scheduled" {{ $reservation->status == 'scheduled' ? 'selected' : '' }}>
                                            Scheduled
                                        </option>
                                        <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>
                                            Pending
                                        </option>
                                        <option value="canceled" {{ $reservation->status == 'canceled' ? 'selected' : '' }}>
                                            Canceled
                                        </option>
                                    </select>

                                    <!-- Dropdown Arrow Icon -->
                                    <div class="absolute top-1/2 right-3 transform -translate-y-1/2 pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </form>
                            </td>

                            <td class="border px-4 py-2">{{ strtoupper($reservation->tutor->last_name) }} {{ $reservation->tutor->first_name }}</td>
                            <td class="border px-4 py-2">{{ strtoupper($reservation->participant->last_name) }} {{ $reservation->participant->first_name }}</td>
                            <td class="border px-4 py-2">
                                {{ \Carbon\Carbon::parse($reservation->start_time)->format('d-m-Y H:i') }} - 
                                {{ \Carbon\Carbon::parse($reservation->end_time)->format('d-m-Y H:i') }}
                            </td> 
                            <td class="hover:bg-gray-50 cursor-pointer text-center" onclick="openModal({{ $reservation->id }})" data-reservation="{{ json_encode($reservation) }}">
                                <span class="material-icons">info</span>
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <a href="{{ route('profile.reservations.edit', $reservation->id) }}" class="text-blue-500 hover:underline">Update</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </tbody>
            </table>
        </div>
    @endif
    <div id="reservationModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden z-50 p-4 sm:p-0">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md sm:w-96">
            <h2 class="text-2xl font-bold mb-4 text-center">Reservation Details</h2>
            <div id="modalContent" class="space-y-2">
            </div>
            <button onclick="closeModal()" class="mt-6 w-full bg-red-500 text-white py-2 px-4 rounded hover:bg-red-700">Close</button>
        </div>
    </div>
    <script>
        function openModal(reservationId) {
            const reservationData = document.querySelector(`[onclick="openModal(${reservationId})"]`).getAttribute('data-reservation');
            const reservation = JSON.parse(reservationData);

            const modalContent = document.getElementById('modalContent');
            modalContent.innerHTML = `
                <p><strong>Tutor:</strong> ${reservation.tutor ? reservation.tutor.last_name + ' ' + reservation.tutor.first_name : 'N/A'}</p>
                <p><strong>Participant:</strong> ${reservation.participant ? reservation.participant.last_name + ' ' + reservation.participant.first_name : 'N/A'}</p>
                <p><strong>Status:</strong> ${reservation.status ? reservation.status : 'N/A'}</p>
                <p><strong>Price:</strong> ${reservation.price ? reservation.price + ' Euro' : 'N/A'}</p>
                <p><strong>Session Type:</strong> ${reservation.session_type ? reservation.session_type : 'N/A'}</p>
                <p><strong>Material Links:</strong> ${reservation.material_links ? reservation.material_links : 'N/A'}</p>
                <p><strong>Payment Status:</strong> ${reservation.payment_status ? reservation.payment_status : 'N/A'}</p>
                <p><strong>Comment:</strong> ${reservation.comments ? reservation.comments : 'N/A'}</p>
                <p><strong>Feedback:</strong> ${reservation.feedback ? reservation.feedback : 'N/A'}</p>
                <p><strong>Start Time:</strong> ${reservation.start_time ? new Date(reservation.start_time).toLocaleString() : 'N/A'}</p>
                <p><strong>End Time:</strong> ${reservation.end_time ? new Date(reservation.end_time).toLocaleString() : 'N/A'}</p>
                <p><strong>Created At:</strong> ${reservation.created_at ? new Date(reservation.created_at).toLocaleString() : 'N/A'}</p>
                <p><strong>Updated At:</strong> ${reservation.updated_at ? new Date(reservation.updated_at).toLocaleString() : 'N/A'}</p>
            `;
            document.getElementById('reservationModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('reservationModal').classList.add('hidden');
        }
    </script>
@endsection
