@extends('layouts.profile')

@section('content')
<div class="container mx-auto p-6">
    @if(session('success'))
        <div id="success-message" class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('profile.reservations.index') }}" class="inline-block text-gray-800 hover:text-gray-900 font-semibold underline px-4 rounded transition duration-300 ease-in-out">
        Back
    </a>
    <h1 class="text-3xl font-extrabold text-center text-indigo-600 mb-8">Nieuwe Reservering</h1>
    <form action="{{ route('profile.reservations.store') }}" method="POST" class="bg-white shadow-lg rounded-lg p-6" id="reservation-form">
        @csrf

        <!-- Cursus selecteren -->
        <div class="mb-4">
            <x-input-label for="course_id" :value="__('Cursus*')" />
            <select id="course_id" name="course_id" class="block w-full mt-1 rounded border-gray-300" required>
                <option value="">{{ __('Selecteer een cursus') }}</option>
                @foreach($courses as $course)
                    <option value="{{ $course->course_id }}" {{ old('course_id') == $course->course_id ? 'selected' : '' }}>
                        {{ $course->title }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('course_id')" class="mt-2" />
        </div>

        <!-- Client selecteren -->
        <div class="mb-4">
            <x-input-label for="participant_name" :value="__('Client*')" />

            <!-- Zoekbare input met datalist -->
            <input id="participant_name" name="participant_name" type="text" list="clients_list" class="block w-full mt-1 p-2 border rounded" placeholder="Zoek client..." value="{{ old('participant_name') }}" required>

            <!-- Verborgen input voor het client ID -->
            <input type="hidden" id="participant_id" name="participant_id" value="{{ old('participant_id') }}" required>

            <!-- Datalist voor beschikbare klanten -->
            <datalist id="clients_list">
                @foreach($clients as $client)
                    <option value="{{ $client->first_name }} {{ $client->last_name }}" data-id="{{ $client->user_id }}">
                @endforeach
            </datalist>

            <x-input-error :messages="$errors->get('participant_id')" class="mt-2 text-red-500" />
        </div>

        <!-- Starttijd -->
        <div class="mb-4">
            <x-input-label for="start_time" :value="__('Start*')" />
            <input id="start_time" name="start_time" type="datetime-local" value="{{ old('start_time') }}" required class="block mt-1 w-full rounded border-gray-300" />
            <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
        </div>

        <!-- Eindtijd -->
        <div class="mb-4">
            <x-input-label for="end_time" :value="__('End')" />
            <input id="end_time" name="end_time" type="datetime-local" value="{{ old('end_time') }}" required class="block mt-1 w-full rounded border-gray-300" />
            <x-input-error :messages="$errors->get('end_time')" class="mt-2" />
        </div>

        <!-- Sessietype -->
        <div class="mb-4">
            <x-input-label for="session_type" :value="__('Session type')" />
            <select id="session_type" name="session_type" class="block w-full mt-1 rounded border-gray-300" required>
                <option value="">{{ __('Selecteer een sessietype') }}</option>
                <option value="online" {{ old('session_type') == 'online' ? 'selected' : '' }}>Online</option>
                <option value="physical" {{ old('session_type') == 'physical' ? 'selected' : '' }}>Fysiek</option>
            </select>
            <x-input-error :messages="$errors->get('session_type')" class="mt-2" />
        </div>

        <!-- Prijs -->
        <div class="mb-4">
            <x-input-label for="price" :value="__('Price')" />
            <input id="price" name="price" type="number" step="0.01" value="{{ old('price') }}" class="block mt-1 w-full rounded border-gray-300" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>

        <!-- Betalingsstatus -->
        <div class="mb-4">
            <x-input-label for="payment_status" :value="__('Payment Status')" />
            <select id="payment_status" name="payment_status" class="block w-full mt-1 rounded border-gray-300" required>
                <option value="pending" {{ old('payment_status') == 'pending' ? 'selected' : '' }}>In afwachting</option>
                <option value="paid" {{ old('payment_status') == 'paid' ? 'selected' : '' }}>Betaald</option>
                <option value="canceled" {{ old('payment_status') == 'canceled' ? 'selected' : '' }}>Geannuleerd</option>
            </select>
            <x-input-error :messages="$errors->get('payment_status')" class="mt-2" />
        </div>

        <!-- Opmerkingen -->
        <div class="mb-4">
            <x-input-label for="comments" :value="__('Notes')" />
            <textarea id="comments" name="comments" class="block mt-1 w-full rounded border-gray-300" rows="4">{{ old('comments') }}</textarea>
        </div>

        <!-- Feedback -->
        <div class="mb-4">
            <x-input-label for="feedback" :value="__('Feedback')" />
            <textarea id="feedback" name="feedback" class="block mt-1 w-full rounded border-gray-300" rows="4">{{ old('feedback') }}</textarea>
        </div>

        <div class="text-center">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                {{ __('Reservering maken') }}
            </button>
        </div>
    </form>
</div>
<script>
    document.getElementById('participant_name').addEventListener('input', function () {
        let inputValue = this.value;
        let clientFound = false;
        let clientId = '';

        // Loop door alle opties in de datalist en zoek naar de bijbehorende klantnaam
        const options = document.querySelectorAll('#clients_list option');
        options.forEach(function (option) {
            if (inputValue === option.value) {
                clientFound = true;
                clientId = option.getAttribute('data-id');  // Haal het klant-ID op
            }
        });

        // Als een klant wordt gevonden, vul dan het verborgen veld in met het klant-ID
        if (clientFound) {
            document.getElementById('participant_id').value = clientId;
        } else {
            document.getElementById('participant_id').value = '';  // Maak het klant-ID leeg als geen match is
        }
    });
</script>
@endsection