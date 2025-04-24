<x-layouts.app>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">My Tasks</h2>
            <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                Create New Task
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-sm rounded-lg">
            @if($tasks->isEmpty())
                <div class="p-6 text-center text-gray-500">
                    No tasks found. Create your first task!
                </div>
            @else
                <ul class="divide-y divide-gray-200">
                    @foreach($tasks as $task)
                        <li class="p-6 hover:bg-gray-50">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="ml-3">
                                        <h3 class="text-lg font-medium text-gray-900">{{ $task->title }}</h3>
                                        <div class="flex space-x-4 mt-1">
                                            <span class="text-sm text-gray-500">
                                                Category: {{ ucfirst($task->category) }}
                                            </span>
                                            <span class="text-sm text-gray-500">
                                                Priority: {{ ucfirst($task->priority) }}
                                            </span>
                                            @if($task->due_date)
                                                <span class="text-sm text-gray-500">
                                                    Due: {{ $task->due_date->format('M d, Y') }}
                                                </span>
                                            @endif
                                        </div>
                                        @if($task->description)
                                            <p class="mt-2 text-sm text-gray-600">{{ $task->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- Add this inside the task list item, after the description -->
                            <div class="mt-4 flex space-x-3">
                                <a href="{{ route('tasks.edit', $task) }}" 
                                    class="text-sm text-blue-600 hover:text-blue-800">Edit</a>
                                
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 hover:text-red-800" 
                                        onclick="return confirm('Are you sure you want to delete this task?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-layouts.app>