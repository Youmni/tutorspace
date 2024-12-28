@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Add News Item</h1>

<form method="POST" action="{{ route('admin.news_items.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-4">
        <x-input-label for="title" :value="__('Title')" />
        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>

    <div class="mb-4">
        <x-input-label for="content" :value="__('Content')" />
        <textarea id="content" class="block mt-1 w-full" name="content" required>{{ old('content') }}</textarea>
        <x-input-error :messages="$errors->get('content')" class="mt-2" />
    </div>

    <div class="mb-4">
        <x-input-label for="image_path" :value="__('Image')" />
        <input id="image_path" class="block mt-1 w-full" type="file" name="image_path" />
        <x-input-error :messages="$errors->get('image_path')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end mt-4">
        <x-primary-button class="ml-4">
            {{ __('Add Announcement') }}
        </x-primary-button>
    </div>
</form>
@endsection