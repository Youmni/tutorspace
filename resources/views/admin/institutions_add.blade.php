@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Add Institution</h1>

    <form method="POST" action="{{ route('admin.institutions.store') }}">
        @csrf

        <div class="mb-4">
            <x-input-label for="name" :value="__('Name of the Institution')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="country" :value="__('Country where the Institution is located')" />
            <select id="country" name="country" class="block mt-1 w-full" required>
                <option value="" disabled selected>Select a country</option>
                @foreach(config('countries') as $country)
                    <option value="{{ $country }}">{{ $country }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('country')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Add Institution') }}
            </x-primary-button>
        </div>
    </form>
@endsection