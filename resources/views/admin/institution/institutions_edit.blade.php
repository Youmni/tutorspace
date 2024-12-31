@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Institution</h1>

    <form method="POST" action="{{ route('admin.institutions.update', ['id'=>$institution->institution_id]) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <x-input-label for="name" :value="__('Name of the Institution')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $institution->name)" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="country" :value="__('Country where the Institution is located')" />
            <select id="country" name="country" class="block mt-1 w-full" required>
                <option value="" disabled selected>Select a country</option>
                @foreach(config('countries') as $country)
                    <option value="{{ $country }}" {{ old('country', $institution->country) == $country ? 'selected' : '' }}>{{ $country }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('country')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <x-primary-button class="ml-4">
                {{ __('Update Institution') }}
            </x-primary-button>
            <a class="underline hover:text-navy-500" href="{{ route('admin.institutions.index') }}">Back</a>
        </div>
    </form>
@endsection