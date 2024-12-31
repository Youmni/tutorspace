@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Question</h1>

    <form method="POST" action="{{ route('admin.faq.faq_question.update', ['category_id' => $category->category_id, 'question_id' => $question->question_id]) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <x-input-label for="category" :value="__('Category')" />
            <x-text-input id="category" class="block mt-1 w-full" type="text" name="category" :value="$category->name" disabled />
        </div>

        <div class="mb-4">
            <x-input-label for="question" :value="__('Question')" />
            <x-text-input id="question" class="block mt-1 w-full" type="text" name="question" :value="old('question', $question->question)" required autofocus />
            <x-input-error :messages="$errors->get('question')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="answer" :value="__('Answer')" />
            <textarea id="answer" class="block mt-1 w-full" name="answer" required>{{ old('answer', $question->answer) }}</textarea>
            <x-input-error :messages="$errors->get('answer')" class="mt-2" />
        </div>

        <input type="hidden" name="category_id" value="{{ $category->category_id }}">

        <div class="flex items-center justify-between mt-4">
            <x-primary-button class="ml-4">
                {{ __('Update Question') }}
            </x-primary-button>
            <a class="underline hover:text-navy-500" href="{{ route('admin.faq.faq_questions.index', ['id'=>$category->category_id]) }}">Back</a>
        </div>
    </form>
@endsection