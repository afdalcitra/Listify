<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <!-- Styles -->
    @vite('resources/css/app.css')
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Space+Grotesk:wght@300..700&display=swap');
    </style>
    

    <title>Listify</title>
</head>
<body class="bg-gray-700">
    <nav>
        <div class="navbar-wrapper h-full flex items-center justify-center py-7 bg-gray-800">
            <p class="font-bold text-white text-2xl flex items-center gap-2">
                <span><img src="{{ asset('images/logo.png') }}" alt="Listify" class="h-10"></span>Listify
            </p>
        </div>
    </nav>


    <div class="alert-wrapper mx-5 my-10 xl:mx-60">
        @if(session('success'))
            <div class="alert bg-green-600 text-white p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert bg-red-600 text-white p-4 rounded-lg mb-4">
                {{ session('error') }}
            </div>
        @endif
    </div>


    <div class="dashboard mx-5 my-10 xl:mx-60">
        <div class="card-wrapper bg-gray-600  p-5 rounded-lg shadow-lg text-white">
            <div class="addTask">
                <form action="{{ route('task.createTask') }}" method="post" class="flex justify-between w-full gap-2">
                    @csrf
                    <input type="text" name="newTask" id="newTask" class="bg-gray-800 text-white p-2 rounded-lg w-full" placeholder="Add new task">
                    <button type="submit" class="bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-800 duration-300 ease-in-out cursor-pointer">Add</button>
                </form>
            </div>
            <hr class="my-5">
            <div class="listTask">
                <table class="w-full">
                    <thead>
                        <tr class="text-center">
                            <th class="w-10">No</th>
                            <th class="lg:w-auto">Task</th>
                            <th class="lg:w-50">Status</th>
                            <th class="lg:w-50">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                        <tr class="text-center mb-5">
                            <td class="w-10">{{$loop->iteration}}</td>
                            <td class="lg:w-auto">{{ $task->task_name }}</td>
                            <td class="w-25 lg:w-50">{{ $task->status }}</td>
                            <td class="w-25 lg:w-50">
                                <div class="lg:flex gap-2 justify-center my-5">
                                    <button onclick="openModal('editModal')" class="bg-green-600 w-full text-white p-2 rounded-lg hover:bg-green-800 duration-300 ease-in-out cursor-pointer mb-2">Edit</button>
                                    <div id="editModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
                                        <div class="bg-white p-5 rounded-lg shadow-lg mx-5 w-full lg:w-1/3">
                                            <h2 class="text-xl font-bold mb-4">Edit Task</h2>
                                            <form action="{{ route('task.editTask', $task->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="editTask" id="editTask" class="bg-gray-200 text-black p-2 rounded-lg w-full mb-4" placeholder="Edit task" value="{{ $task->task_name }}" required>
                                                <select name="editStatus" id="editStatus" class="bg-gray-200 text-black p-2 rounded-lg w-full mb-4">
                                                    <option value="pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                </select>   
                                                <div class="flex justify-end gap-2">
                                                    <button type="button" onclick="closeModal('editModal')" class="bg-gray-600 text-white p-2 rounded-lg hover:bg-gray-800 duration-300 ease-in-out cursor-pointer">Cancel</button>
                                                    <button type="submit" class="bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-800 duration-300 ease-in-out cursor-pointer">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <script>
                                        function openModal(modalId) {
                                            document.getElementById(modalId).classList.remove('hidden');
                                        }
                                        function closeModal(modalId) {
                                            document.getElementById(modalId).classList.add('hidden');
                                        }
                                    </script>
                                    <form action="{{ route('task.deleteTask', $task->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 w-full text-white p-2 rounded-lg hover:bg-red-800 duration-300 ease-in-out cursor-pointer mb-2">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>  
</body>
</html> 