<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App - Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-4xl mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-tasks text-indigo-600"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-800">Todo Dashboard</h1>
                    <p class="text-sm text-gray-600">Welcome, {{ auth()->user()->username }}!</p>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex items-center space-x-2 text-gray-600 hover:text-gray-800 transition duration-200">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-8">
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Add Todo Form -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-plus-circle text-indigo-600 mr-2"></i>
                Add New Todo
            </h2>

            <form method="POST" action="{{ route('todos.store') }}" class="flex space-x-4">
                @csrf
                <div class="flex-1">
                    <input type="text" name="title" placeholder="What needs to be done?"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                        required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-200 font-medium">
                    <i class="fas fa-plus mr-1"></i>
                    Add Todo
                </button>
            </form>
        </div>

        <!-- Todo Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-list text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Total Tasks</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $todos->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-check text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Completed</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $todos->where('completed', true)->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-clock text-orange-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Pending</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $todos->where('completed', false)->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Todo List -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">
                    <i class="fas fa-tasks text-indigo-600 mr-2"></i>
                    Your Tasks
                </h2>
            </div>

            @if ($todos->count() > 0)
                <div class="divide-y divide-gray-200">
                    @foreach ($todos as $todo)
                        <div class="p-6 flex items-center justify-between {{ $todo->completed ? 'bg-gray-50' : '' }}">
                            <div class="flex items-center space-x-4 flex-1">
                                <form method="POST" action="{{ route('todos.update', $todo) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="completed" value="{{ $todo->completed ? '0' : '1' }}">
                                    <button type="submit"
                                        class="w-6 h-6 rounded-full border-2 flex items-center justify-center transition duration-200 {{ $todo->completed ? 'border-green-500 bg-green-500' : 'border-gray-300 hover:border-green-400' }}">
                                        @if ($todo->completed)
                                            <i class="fas fa-check text-white text-xs"></i>
                                        @endif
                                    </button>
                                </form>

                                <div class="flex-1">
                                    <p
                                        class="text-gray-800 {{ $todo->completed ? 'line-through text-gray-500' : '' }}">
                                        {{ $todo->title }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Created {{ $todo->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('todos.destroy', $todo) }}" class="ml-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Are you sure you want to delete this todo?')"
                                    class="text-red-500 hover:text-red-700 transition duration-200 p-2">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="p-12 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-inbox text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-800 mb-2">No todos yet</h3>
                    <p class="text-gray-600">Add your first todo above to get started!</p>
                </div>
            @endif
        </div>
    </main>
</body>

</html>
