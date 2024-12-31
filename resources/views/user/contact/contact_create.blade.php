@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    @if(session('success'))
        <div id="success-message" class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-3xl font-extrabold text-center text-indigo-600 mb-8">Contact Us</h1>
    <form action="{{ route('contact.send') }}" method="post" enctype="multipart/form-data" class="bg-white shadow-lg rounded-lg p-6">
        @csrf
        <div class="mb-4">
            <x-input-label for="email" :value="__('Your Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="subject" :value="__('Subject')" />
            <x-text-input id="subject" class="block mt-1 w-full" type="text" name="subject" :value="old('subject')" required />
            <x-input-error :messages="$errors->get('subject')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="message" :value="__('Message')" />
            <textarea id="message" class="block mt-1 w-full" name="message" rows="6" required>{{ old('message') }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
        </div>

        <div class="text-center">
            <x-primary-button>
                {{ __('Send') }}
            </x-primary-button>
        </div>
    </form>
</div>
@endsection