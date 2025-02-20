<?php

namespace App\Http\Controllers;

use App\Models\ToDoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ToDoListController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    $today = Carbon::now();

    $tasksQuery = ToDoList::where('user_id', Auth::id());
    
    // Apply search filter if search parameter exists
    if ($search) {
        $tasksQuery->where(function($query) use ($search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('priority', 'like', "%{$search}%");
        });
    }

    $tasks = $tasksQuery->orderBy('created_at', 'desc')->get();

    // Calculate statistics based on filtered tasks
    $completedCount = $tasks->where('status', 'Completed')->count();
    $inProgressCount = $tasks->where('status', 'In Progress')->count();
    $notStartedCount = $tasks->where('status', 'Not Started')->count();
    $totalTasks = $tasks->count();

    $stats = [
        'completed' => $totalTasks > 0 ? round(($completedCount / $totalTasks) * 100) : 0,
        'inProgress' => $totalTasks > 0 ? round(($inProgressCount / $totalTasks) * 100) : 0,
        'notStarted' => $totalTasks > 0 ? round(($notStartedCount / $totalTasks) * 100) : 0,
    ];

    return view('dashboard', compact('tasks', 'stats', 'search'));
}

public function search(Request $request)
{
    return $this->index($request);
}

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:Low,Moderate,Extreme',
            'due_date' => 'required|date',
            'image' => 'nullable|image|max:5120'
        ]);        

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['status'] = 'In Progress'; // Set default status to In Progress

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('task-images', 'public');
            $data['image'] = $imagePath;
        }

        ToDoList::create($data);

        return redirect()->route('dashboard')->with('success', 'Task added successfully!');
    }

    public function update(Request $request, ToDoList $todolist)
    {
        if ($todolist->user_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access');
        }

        $request->validate([
            'title' => 'required_without:status|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required_without:status|in:Low,Moderate,Extreme',
            'due_date' => 'required_without:status|date',
            'status' => 'nullable|in:Not Started,In Progress,Completed',
            'image' => 'nullable|image|max:5120'
        ]);

        // Handle status-only updates
        if ($request->has('status')) {
            $todolist->update(['status' => $request->status]);
            return redirect()->route('dashboard')->with('success', 'Task status updated successfully!');
        }

        // Handle full task updates
        $data = $request->except(['_token', '_method', 'image']);
        
        if ($request->hasFile('image')) {
            if ($todolist->image) {
                Storage::disk('public')->delete($todolist->image);
            }
            $imagePath = $request->file('image')->store('task-images', 'public');
            $data['image'] = $imagePath;
        }

        $todolist->update($data);

        return redirect()->route('dashboard')->with('success', 'Task updated successfully!');
    }

    public function destroy(ToDoList $todolist)
    {
        if ($todolist->user_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access');
        }

        if ($todolist->image) {
            Storage::disk('public')->delete($todolist->image);
        }

        $todolist->delete();
        return redirect()->route('dashboard')->with('success', 'Task deleted successfully!');
    }

    public function history()
    {
        $completedTasks = ToDoList::where('user_id', Auth::id())
                            ->where('status', 'Completed')
                            ->orderBy('created_at', 'desc')
                            ->get();
                            
        return view('history', compact('completedTasks'));
    }
}