<?php

namespace App\Http\Controllers;

use App\Http\Requests\HabitRequest;
use App\Models\Habit;
use App\Models\HabitLog;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class HabitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        $habits = Auth::user()->habits;

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

        Auth::user()->habits()->create($validated);

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
        if($habit->user_id != Auth::user()->id){
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
        if($habit->user_id != Auth::user()->id){
            abort(403, 'Não é possivel concluir essa ação!');
        }

        $habit->delete();

        return redirect()
            ->route('habits.settings')
            ->with('success', 'Hábito removido com sucesso!');
    }

    public function settings()
    {
        $habits = Auth::user()->habits;

        return view('habits.settings', compact('habits'));
    }

    public function toggle(Habit $habit)
    {

        // 1. User Atual
        if($habit->user_id != Auth::user()->id){
            abort(403, 'Não é possivel concluir essa ação!');
        }

        // Pegar data de hoje
        $today = Carbon::today()->toDateString();
        
        // Pegar o log

        $log = HabitLog::query()
            ->where('habit_id', $habit->id)
            ->where('completed_at', $today)
            ->first();


        // Validar se nessa data já existe registro
        if($log){
            // Se existir, remvoer o registro
            $log->delete();
            $message = 'Hábito desmarcado';
        } else {
            // Se não existir, criar o registros
        
            HabitLog::create([
                'user_id' => Auth::user()->id,
                'habit_id' => $habit->id,
                'completed_at' => $today,
            ]);
            $message = 'Hábito concluido!';
        }
    
        // Retornar para a pagina anterior
        return redirect()
            ->route('habits.index')
            ->with('success', $message);

    }
}
