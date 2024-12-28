@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">FAQ Management</h1>
    <div class="flex justify-end gap-5 mb-4">
        <a href="{{ route('admin.faq.faq_category.create') }}" class="underline text-black hover:text-blue-700">Add category</a>
    </div>

    <form method="GET" action="{{ route('admin.faq.index') }}" class="mb-4 flex gap-2">
        <input type="text" name="search" placeholder="Search category..." value="{{ request('search') }}" class="border rounded py-2 px-4 w-full">
        <button type="submit" class="bg-navy-500 text-white py-2 px-4 rounded hover:bg-navy-700">Search</button>
    </form>

    @if($categories->isEmpty())
        <p class="text-gray-500">No categories available.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b text-left">ID</th>
                        <th class="py-2 px-4 border-b text-left">Name</th>
                        <th class="py-2 px-4 border-b text-left">Created</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr class="hover:bg-gray-50" data-url="{{ route('admin.faq.faq_questions.index', ['id' => $category->category_id]) }}">
                            <td class="border px-4 py-2">{{ $category->category_id }}</td>
                            <td class="border px-4 py-2">{{ $category->name }}</td>
                            <td class="border px-4 py-2">{{ $category->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <script>
        document.querySelectorAll('tr[data-url]').forEach(row => {
            row.addEventListener('click', () => {
                window.location.href = row.dataset.url;
            });
        });
    </script>
@endsection