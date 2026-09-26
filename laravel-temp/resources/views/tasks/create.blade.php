@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-black p-6 rounded-2xl shadow-lg border border-slate-200 space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-bold tracking-tight text-slate-800">New Task</h1>
            <span class="h-2 w-2 rounded-full bg-indigo-600 animate-pulse"></span>
        </div>

        <form id="createTaskForm" action="/tasks" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-medium text-slate-700 mb-1">Task Name</label>
                <input type="text" name="task_name" required placeholder="e.g., Complete Project" class="w-full bg-slate-50 border border-slate-200 text-slate-800 p-2.5 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
            </div>

            <div>
                <label class="block text-xs font-medium text-slate-700 mb-1">Description</label>
                <textarea name="description" rows="2" placeholder="Task details..." class="w-full bg-slate-50 border border-slate-200 text-slate-800 p-2.5 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition"></textarea>
            </div>

            <div>
                <label class="block text-xs font-medium text-slate-700 mb-1">Due Date</label>
                <input type="date" name="due_date" class="w-full bg-slate-50 border border-slate-200 text-slate-800 p-2.5 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
            </div>

            <div class="flex justify-between items-center pt-4 border-t border-slate-100">
                <a href="/tasks" class="text-xs text-slate-500 hover:text-indigo-600 font-medium transition">← Back to tasks</a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg text-xs font-semibold tracking-wide transition shadow-sm">CREATE TASK</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('createTaskForm').addEventListener('submit', function (e) {
        e.preventDefault();
        
        const form = this;
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        }).then(() => {
            window.location.href = '/tasks';
        }).catch(() => {
            window.location.href = '/tasks';
        });
    });
</script>
@endsection