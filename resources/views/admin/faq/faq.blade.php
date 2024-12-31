@extends('layouts.admin')

@section('content')
    @if(session('success'))
        <div id="success-message" class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    <h1 class="text-2xl font-bold mb-4">FAQ Management: categories</h1>
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
                        <th class="py-2 px-4 border-b text-left">Update</th>
                        <th class="py-2 px-4 border-b text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr class="hover:bg-gray-50 cursor-pointer" data-url="{{ route('admin.faq.faq_questions.index', ['id' => $category->category_id]) }}">
                            <td class="border px-4 py-2">{{ $category->category_id }}</td>
                            <td class="border px-4 py-2">{{ $category->name }}</td>
                            <td class="border px-4 py-2">{{ $category->created_at }}</td>
                            <td class="border px-4 py-2"><a href="{{ route('admin.faq.faq_category.edit', ['id' => $category->category_id]) }}" class="text-blue-500 hover:text-blue-700">Update</a></td>
                            <td class="border px-4 py-2">
                                <form action="{{ route('admin.faq.faq_category.destroy', $category->category_id)}}" method="POST">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 ml-2">Delete</button>
                                </form>
                            </td>
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