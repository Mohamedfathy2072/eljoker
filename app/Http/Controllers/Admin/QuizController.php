<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::latest()->get();
        return view('pages.quizzes', compact('quizzes'));
    }

    public function create()
    {
        return view('pages.quiz-form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'attribute' => 'required|string|max:100',
            'type' => 'required|in:text,select,radio,checkbox',
            'options' => 'required_if:type,select,radio,checkbox|array',
            'is_required' => 'boolean',
        ]);

        if (isset($validated['options']) && is_array($validated['options'])) {
            $validated['options'] = array_values($validated['options']);
        } else {
            $validated['options'] = [];
        }

        $validated['is_required'] = $request->has('is_required');

        Quiz::create($validated);

        return redirect()->route('admin.Quizzes')
            ->with('success', 'Quiz created successfully.');
    }

    public function edit(Quiz $quiz)
    {
        return view('pages.quiz-form', compact('quiz'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'attribute' => 'required|string|max:100',
            'type' => 'required|in:text,select,radio,checkbox',
            'options' => 'required_if:type,select,radio,checkbox|array',
            'is_required' => 'boolean',
        ]);

        if (isset($validated['options']) && is_array($validated['options'])) {
            $validated['options'] = array_values($validated['options']);
        } else {
            $validated['options'] = [];
        }

        $validated['is_required'] = $request->has('is_required');

        $quiz->update($validated);

        return redirect()->route('admin.Quizzes')
            ->with('success', 'Quiz updated successfully');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('admin.Quizzes')
            ->with('success', 'Quiz deleted successfully');
    }
}
