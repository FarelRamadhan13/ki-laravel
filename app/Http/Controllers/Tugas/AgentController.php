<?php

namespace App\Http\Controllers\Tugas;

use App\Models\Agent;
use Illuminate\Http\Request;
use App\Http\Requests\AgentRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = request()->q;

        if($query) {
            $agents = Agent::where('name', 'LIKE', "%$query%")->orWhereLike('description', "%$query%")->paginate(10);
        } else {
            $agents = Agent::paginate(10);
        }
        return view('agents.index', ['agents' => $agents]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AgentRequest $request)
    {
        $validated = $request->validated();

        $image = $request->file('image');
        $imageName = $image->hashName();
        $validated['image'] = 'agents/'.$imageName;

        if(Agent::create($validated))
            $image->storeAs('agents/', $imageName, 'public');
        

        return to_route('tugas.agents.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Agent $agent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agent $agent)
    {
        return view('agents.edit', ['agent' => $agent]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AgentRequest $request, Agent $agent)
    {
        $validated = $request->validated();

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();

            Storage::disk('public')->delete($agent->image);
            $image->storeAs('agents/', $imageName, 'public');
        } else {
            $imageName = ltrim($agent->image, 'agents/');
        }

        $validated['image'] = 'agents/'.$imageName;

        $agent->update($validated);

        return to_route('tugas.agents.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agent $agent)
    {
        if($agent->delete());
            Storage::disk('public')->delete($agent->image);

        return to_route('tugas.agents.index');
    }
}
