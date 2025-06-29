<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScoreCategoryRequest;
use App\Models\Log;
use App\Models\ScoreCategory;
use App\Models\Employee;
use Illuminate\Http\Request;

class ScoreCategoriesController extends Controller
{
    private $scoreCategories;

    public function __construct()
    {
        $this->middleware('auth');
        $this->scoreCategories = resolve(ScoreCategory::class);    
    }

    public function index()
    {
        $scoreCategories = $this->scoreCategories->with('employee')->orderBy('id', 'ASC')->paginate(10);
        return view('pages.score-categories', compact('scoreCategories'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('pages.score-categories_create', compact('employees'));
    }

    public function store(StoreScoreCategoryRequest $request)
    {
        ScoreCategory::create([
            'name' => $request->input('name'),
            'score' => $request->input('score'),
            'employee_id' => $request->input('employee_id'),
        ]);

        Log::create([
            'description' => auth()->user()->employee->name . " created a score category for employee ID " . $request->input('employee_id'),
        ]);

        return redirect()->route('score-categories')->with('status', 'Successfully created a score category.');
    }

    public function edit(ScoreCategory $scoreCategory)
    {
        $employees = Employee::all();
        return view('pages.score-categories_edit', compact('scoreCategory', 'employees'));
    }

    public function update(Request $request, ScoreCategory $scoreCategory)
    {
        $scoreCategory->update([
            'name' => $request->input('name'),
            'score' => $request->input('score'),
            'employee_id' => $request->input('employee_id'),
        ]);

        Log::create([
            'description' => auth()->user()->employee->name . " updated a score category for employee ID " . $scoreCategory->employee_id,
        ]);

        return redirect()->route('score-categories')->with('status', 'Successfully updated score category.');
    }

    public function destroy(ScoreCategory $scoreCategory)
    {
        $scoreCategory->delete();

        Log::create([
            'description' => auth()->user()->employee->name . " deleted a score category named '" . $scoreCategory->name . "'",
        ]);

        return redirect()->route('score-categories')->with('status', 'Successfully deleted score category.');
    }

    public function print()
    {
        $scoreCategories = $this->scoreCategories->with('employee')->get();
        return view('pages.score-categories_print', compact('scoreCategories'));
    }
}
