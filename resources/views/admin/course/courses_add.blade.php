@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Add Course</h1>

    <form method="POST" action="{{ route('admin.courses.store') }}">
        @csrf

        <div class="mb-4">
            <x-input-label for="title" :value="__('Course Title')" />
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="description" :value="__('Course Description')" />
            <textarea id="description" class="block mt-1 w-full" name="description" required>{{ old('description') }}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="institution_id" :value="__('Institution')" />
            <select id="institution_id" name="institution_id" class="block mt-1 w-full" required>
                <option value="" disabled selected>Select an institution</option>
                @foreach($institutions as $institution)
                    <option value="{{ $institution->institution_id }}">{{ $institution->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('institution_id')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <x-primary-button class="ml-4">
                {{ __('Add Course') }}
            </x-primary-button>
            <a class="underline hover:text-navy-500" href="{{ route('admin.courses.index') }}">Back</a>
        </div>
    </form>
@endsection