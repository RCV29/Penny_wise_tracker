<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $expenses = $user->expenses; // Fetch expenses associated with the authenticated user

        if ($request->is('api/*')) {
            return response()->json(['expenses' => $expenses]);
        } else {
            return view('expense', compact('expenses'));
        }
    }

    public function create(){
        return view('create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $expense = new Expense([
            'exp' => $request->input('exp'),
            'price' => $request->input('price'),
        ]);

        $user->expenses()->save($expense);

        if ($request->is('api/*')) {
            return response()->json(["message" => "Successfully created the expense's data"]);
        } else {
            return redirect()->route('expenses.index')->with('message', 'Expense Created');
        }
    }

    public function edit(Expense $expense)
    {
        // Check if authenticated user owns this expense
        if ($expense->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('edit', compact('expense'));
    }
    public function update(Request $request, $id){
        $expense = Expense::find($id);
        $expense->update($request->all());

        if ($request->is('api/*')) {
            return response()->json(["message" => "Successfully updated the expense's data"]);
        } else {
            return redirect()->route('expenses.index')->with('message', 'Expense Updated');
        }
    }

    public function destroy($id){
        $expense = Expense::find($id);
        $expense->delete();

        if (request()->is('api/*')) {
            return response()->json(["message" => "Successfully deleted the expense's data"]);
        } else {
            return redirect()->route('expenses.index')->with('message', 'Expense Deleted');
        }
    }
}

