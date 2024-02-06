<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'description' => 'sometimes',
            ]);

            $task = new Task;
            $task->user_id = auth()->user()->id;
            $task->name = $validatedData['name'];
            $task->description = $request->input('description') ?? '';
            $task->is_completed = false;
            $task->save();

            return response()->json($task, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }
    }

    public function getStore(Request $request)
    {
        $tasks = Task::where('user_id', auth()->user()->id)->get();

        return response()->json($tasks, 200);
    }

    public function updateTask(Request $request, $id)
    {
        try {
            $task = Task::find($id);
    
            if (!$task) {
                return response()->json(['error' => 'Task not found'], 404);
            }
    
            if ($task->user_id !== auth()->user()->id) {
                return response()->json(['error' => 'You do not have permission to edit this task'], 403);
            }
    
            $validatedData = $request->validate([
                'name' => 'sometimes|required',
                'description' => 'sometimes|nullable',
                'is_completed' => 'sometimes|boolean',
            ]);
    
            // Si description viene vacío, se guarda como un string vacío
            if (empty($validatedData['description'])) {
                $validatedData['description'] = '';
            }
    
            $task->update($validatedData);
    
            return response()->json($validatedData, 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }
    }
    
    public function destroyTask($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        if ($task->user_id !== auth()->user()->id) {
            return response()->json(['error' => 'You do not have permission to edit this task'], 403);
        }

        $task->delete();

        return response()->json(['message' => 'Task successfully deleted'], 200);
    }
}
