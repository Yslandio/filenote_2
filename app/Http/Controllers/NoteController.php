<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function dashboard() {
        $notes = Note::where('user_id', Auth::user()->id)->get();
        return view('dashboard', compact('notes'));
    }

    public function create(Request $request) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'color' => 'required',
        ],[
            'required' => 'O campo :attribute é obrigatório!'
        ]);

        $note = $request->except('_token');
        $note['user_id'] = Auth::user()->id;
        Note::create($note);

        return back();
    }

    public function update(Request $request) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'color' => 'required',
        ],[
            'required' => 'O campo :attribute é obrigatório!'
        ]);

        $note = $request->except('_token');

        Note::find($request->id)->update($note);

        return back();
    }
}
