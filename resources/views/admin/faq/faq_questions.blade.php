@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Questions</h1>
    <div class="flex justify-end gap-5 mb-4">
        <a href="{{ route('admin.faq.faq_questions.create', ['category_id' => $id]) }}" class="underline text-black hover:text-blue-700">Add question</a>
    </div>

    <form method="GET" action="{{ route('admin.faq.faq_questions.index', ['id' => $id]) }}" class="mb-4 flex gap-2">
        <input type="text" name="search" placeholder="Search questions..." value="{{ request('search') }}" class="border rounded py-2 px-4 w-full">
        <button type="submit" class="bg-navy-500 text-white py-2 px-4 rounded hover:bg-navy-700">Search</button>
    </form>

    @if($questions->isEmpty())
        <p class="text-gray-500">No questions available.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b text-left">ID</th>
                        <th class="py-2 px-4 border-b text-left">Question</th>
                        <th class="py-2 px-4 border-b text-left">Answer</th>
                        <th class="py-2 px-4 border-b text-left">Created</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($questions as $question)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2">{{ $question-> question_id}}</td>
                            <td class="border px-4 py-2">{{ $question->question }}</td>
                            <td class="border px-4 py-2">{{ $question->answer }}</td>
                            <td class="border px-4 py-2">{{ $question->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection