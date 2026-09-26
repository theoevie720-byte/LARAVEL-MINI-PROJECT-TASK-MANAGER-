@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header Section -->
    <div class="flex justify-between items-center bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Personal Task Manager</h1>
            <p class="text-xs text-slate-500 mt-0.5">Organize and manage your everyday goals</p>
        </div>
        <a href="/tasks/create" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl text-xs font-semibold tracking-wide transition shadow-sm flex items-center gap-1.5">
            <span>+</span> Add Task
        </a>
    </div>

    <!-- Table Card Container -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-slate-200">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-800 text-white text-xs uppercase tracking-wider font-semibold">
                    <th class="p-4">Task</th>
                    <th class="p-4">Description</th>
                    <th class="p-4">Due Date</th>
                    <th class="p-4">Status</th>
                    <th class="p-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse($tasks as $task)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="p-4 font-semibold text-slate-800">
                        <span class="{{ $task->status === 'Completed' ? 'line-through text-slate-400' : '' }}">
                            {{ $task->task_name }}
                        </span>
                    </td>
                    <td class="p-4 text-slate-600 max-w-xs truncate">{{ $task->description ?: '—' }}</td>
                    <td class="p-4 text-slate-500 text-xs font-medium">{{ $task->due_date ?: 'No date' }}</td>
                    <td class="p-4">
                        <form action="/tasks/{{ $task->id }}/status" method="POST" class="status-form">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="px-3 py-1 rounded-full text-xs font-semibold transition-all shadow-sm cursor-pointer {{ $task->status === 'Completed' ? 'bg-emerald-100 text-emerald-700 hover:bg-emerald-200' : 'bg-amber-100 text-amber-700 hover:bg-amber-200' }}">
                                {{ $task->status }}
                            </button>
                        </form>
                    </td>
                    <td class="p-4 text-right">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="/tasks/{{ $task->id }}/edit" class="bg-slate-100 hover:bg-slate-200 text-slate-700 border border-slate-300 px-3 py-1 rounded-lg text-xs font-medium transition">Edit</a>
                            <form action="/tasks/{{ $task->id }}" method="POST" class="delete-form" onsubmit="return confirm('Delete task?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-rose-600 hover:bg-rose-700 text-white px-3 py-1 rounded-lg text-xs font-medium transition shadow-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-12 text-center text-slate-400">
                        <div class="space-y-1">
                            <p class="font-medium text-slate-500">No tasks found</p>
                            <p class="text-xs">Click "Add Task" above to get started!</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    // Status Toggle Handler
    document.querySelectorAll('.status-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            }).then(() => {
                window.location.href = '/tasks';
            }).catch(() => {
                window.location.href = '/tasks';
            });
        });
    });

    // Delete Form Handler (Guarantees redirecting directly back to dashboard)
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            }).then(() => {
                window.location.href = '/tasks';
            }).catch(() => {
                window.location.href = '/tasks';
            });
        });
    });
</script>
@endsection