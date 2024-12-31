@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Announcement</h1>

<form method="POST" action="{{ route('admin.news_items.update', ['id' => $announcement->item_id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <x-input-label for="title" :value="__('Title')" />
        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $announcement->title)" required autofocus />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>

    <div class="mb-4">
        <x-input-label for="content" :value="__('Content')" />
        <textarea id="content" class="block mt-1 w-full" name="content" required>{{ old('content', $announcement->content) }}</textarea>
        <x-input-error :messages="$errors->get('content')" class="mt-2" />
    </div>

    <div class="mb-4">
        <x-input-label for="image_path" :value="__('Image')" />
        <input id="image_path" class="block mt-1 w-full" type="file" name="image_path" />
        <x-input-error :messages="$errors->get('image_path')" class="mt-2" />
        @if ($announcement->image_path)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $announcement->image_path) }}" alt="Current Image" class="w-32 h-32 object-cover">
            </div>
        @endif
    </div>

    <div class="flex items-center justify-between mt-4">
        <a class="underline hover:text-navy-500" href="{{ route('admin.news_items.index')}}">Back</a>
        <x-primary-button class="ml-4">
            {{ __('Update Announcement') }}
        </x-primary-button>
    </div>
</form>
@endsection