@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Add FAQ Category</h1>

    <form method="POST" action="{{ route('admin.faq.faq_category.store') }}">
        @csrf

        <div class="mb-4">
            <x-input-label for="name" :value="__('Name of the Category')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <x-primary-button class="ml-4">
                {{ __('Add Category') }}
            </x-primary-button>
            <a class="underline hover:text-navy-500" href="{{ route('admin.faq.index') }}">Back</a>
        </div>
    </form>
@endsection