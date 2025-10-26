<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Categories') }}
            </h2>
            <a href="{{ route('categories.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create New Category
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($categories->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($categories as $category)
                                <div class="border rounded-lg p-4 hover:shadow-md transition">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-4 h-4 rounded-full" style="background-color: {{ $category->color }}"></div>
                                            <h3 class="font-semibold text-lg">{{ $category->name }}</h3>
                                        </div>
                                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">
                                            {{ $category->tasks_count }} tasks
                                        </span>
                                    </div>
                                    
                                    @if($category->description)
                                        <p class="text-sm text-gray-600 mb-3">{{ Str::limit($category->description, 100) }}</p>
                                    @endif

                                    <div class="flex gap-2">
                                        <a href="{{ route('categories.edit', $category) }}" 
                                            class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white text-center px-3 py-2 rounded text-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST" 
                                            onsubmit="return confirm('Are you sure? All tasks in this category will be deleted!')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded text-sm">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">No categories found. Create your first category!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>