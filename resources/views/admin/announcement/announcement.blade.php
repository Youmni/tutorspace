@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Announcement management</h1>
    <div class="flex justify-end gap-5 mb-4">
        <a href="{{ route('admin.news_items.create') }}" class="underline text-black hover:text-blue-700">Create announcement</a>
    </div>

    <form method="GET" action="{{ route('admin.news_items.index') }}" class="mb-4 flex gap-2">
        <input type="text" name="search" placeholder="Search announcements..." value="{{ request('search') }}" class="border rounded py-2 px-4 w-full">
        <button type="submit" class="bg-navy-500 text-white py-2 px-4 rounded hover:bg-navy-700">Search</button>
    </form>

    @if($newsItems->isEmpty())
        <p class="text-gray-500">No announcements available.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b text-left">ID</th>
                        <th class="py-2 px-4 border-b text-left">Title</th>
                        <th class="py-2 px-4 border-b text-left">Content</th>
                        <th class="py-2 px-4 border-b text-left">Publication date</th>
                        <th class="py-2 px-4 border-b text-left">Image</th>
                        <th class="py-2 px-4 border-b text-left">Update</th>
                        <th class="py-2 px-4 border-b text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($newsItems as $newsItem)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2">{{ $newsItem->item_id }}</td>
                            <td class="border px-4 py-2">{{ $newsItem->title }}</td>
                            <td class="border px-4 py-2">{{ $newsItem->content }}</td>
                            <td class="border px-4 py-2">{{ $newsItem-> publication_date }}</td>
                            <td class="border px-4 py-2">
                                @if ($newsItem->image_path)
                                    <a href="{{ asset('storage/' . $newsItem->image_path) }}" target="_blank" class="text-blue-500 hover:text-blue-800">View Image</a>
                                @else
                                    No Image
                                @endif
                            </td>
                            <td class="border px-4 py-2"><a class="text-blue-500 hover:text-blue-800" href="{{ route('admin.news_items.edit', ['id'=>$newsItem->item_id])}}">Update</a></td>
                            <td class="border px-4 py-2">
                                <form action="{{ route('admin.news_items.destroy', $newsItem->item_id)}}" method="POST">
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
@endsection