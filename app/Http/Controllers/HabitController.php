<?php

namespace App\Http\Controllers;

use App\Http\Requests\HabitRequest;
use App\Models\Habit;
use Illuminate\View\View;

class HabitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        $habits = auth()->user()->habits;

        return view('dashboard', compact('habits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view("habits.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HabitRequest $request)
    {
        $validated = $request->validated();

        auth()->user()->habits()->create($validated);

        return redirect()
            ->route('habits.index')
            ->with('success', 'Habito criado com sucesso!');
        ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Habit $habit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Habit $habit)
    {
        return view('habits.edit', compact('habit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HabitRequest $request, Habit $habit)
    {
        if($habit->user_id != auth()->user()->id){
            abort(403, 'Não é possivel concluir essa ação!');
        }

        $habit->update($request->all());

        return redirect()
            ->route('habits.settings')
            ->with('success', 'Hábito atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Habit $habit)
    {
        if($habit->user_id != auth()->user()->id){
            abort(403, 'Não é possivel concluir essa ação!');
        }

        $habit->delete();

        return redirect()
            ->route('habits.settings')
            ->with('success', 'Hábito removido com sucesso!');
    }

    public function settings()
    {
        $habits = auth()->user()->habits;

        return view('habits.settings', compact('habits'));
    }
}
