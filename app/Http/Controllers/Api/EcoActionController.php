<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EcoAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EcoActionController extends Controller
{
    // list actions for current user
    public function index(Request $request)
    {
        $actions = $request->user()->ecoActions()->latest()->get();
        return response()->json($actions);
    }

    // store new action
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string',
            'impact_co2' => 'nullable|numeric',
            'impact_water' => 'nullable|numeric',
            'impact_waste' => 'nullable|numeric',
            'date' => 'nullable|date',
        ]);

        if ($v->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $v->errors()], 422);
        }

        $action = $request->user()->ecoActions()->create($v->validated());

        return response()->json($action, 201);
    }

    // show
    public function show(Request $request, $id)
    {
        $action = $request->user()->ecoActions()->findOrFail($id);
        return response()->json($action);
    }

    // update
    public function update(Request $request, $id)
    {
        $action = $request->user()->ecoActions()->findOrFail($id);

        $v = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'sometimes|required|string',
            'impact_co2' => 'nullable|numeric',
            'impact_water' => 'nullable|numeric',
            'impact_waste' => 'nullable|numeric',
            'date' => 'nullable|date',
        ]);

        if ($v->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $v->errors()], 422);
        }

        $action->update($v->validated());
        return response()->json($action);
    }

    // destroy
    public function destroy(Request $request, $id)
    {
        $action = $request->user()->ecoActions()->findOrFail($id);
        $action->delete();
        return response()->json(['message' => 'Deleted']);
    }

    // summary stats
    public function summary(Request $request)
    {
        $q = $request->user()->ecoActions();
        $total_co2 = $q->sum('impact_co2');
        $total_water = $q->sum('impact_water');
        $total_waste = $q->sum('impact_waste');
        $count = $q->count();

        return response()->json([
            'count' => $count,
            'total_co2' => (float) $total_co2,
            'total_water' => (float) $total_water,
            'total_waste' => (float) $total_waste,
        ]);
    }
}
