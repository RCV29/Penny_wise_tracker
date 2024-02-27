<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Saving;
use Illuminate\Support\Facades\Auth;
class SavingController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $savings = $user->savings; // Fetch expenses associated with the authenticated user

        if ($request->is('api/*')) {
            return response()->json(['savings' => $savings]);
        } else {
            return view('saving', compact('savings'));
        }
    }

    public function create(){
        return view('create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $saving = new Saving([
            'amount' => $request->input('amount')
            
        ]);

        $user->savings()->save($saving);

        if ($request->is('api/*')) {
            return response()->json(["message" => "Successfully created the savings' data"]);
        } else {
            return redirect()->route('savings.index')->with('message', 'Savings Created');
        }
    }

    public function edit(Saving $saving)
    {
        // Check if authenticated user owns this expense
        if ($saving->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('edit', compact('expense'));
    }
    public function update(Request $request, $id){
        $saving = Saving::find($id);
        $saving->update($request->all());

        if ($request->is('api/*')) {
            return response()->json(["message" => "Successfully updated the expense's data"]);
        } else {
            return redirect()->route('savings.index')->with('message', 'Savings Updated');
        }
    }

    public function destroy($id){
        $saving = Saving::find($id);
        $saving->delete();

        if (request()->is('api/*')) {
            return response()->json(["message" => "Successfully deleted the savings; data"]);
        } else {
            return redirect()->route('savings.index')->with('message', 'Savings Deleted');
        }
    }
}
