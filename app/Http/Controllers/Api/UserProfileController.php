<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user()->load('profile');
        return response()->json($user->profile);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'eco_score' => 'nullable|integer',
            'total_co2_saved' => 'nullable|numeric',
            'total_water_saved' => 'nullable|numeric',
            'total_waste_reduced' => 'nullable|numeric',
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255|unique:users,email,' . $user->id,
        ]);

        // update user basic fields
        if (isset($data['name'])) $user->name = $data['name'];
        if (isset($data['email'])) $user->email = $data['email'];
        $user->save();

        // update profile
        $profile = $user->profile;
        if (!$profile) {
            $profile = $user->profile()->create([]);
        }

        $profile->fill(array_only($data = array_filter($data, function($k){ return in_array($k, ['eco_score','total_co2_saved','total_water_saved','total_waste_reduced']); }, ARRAY_FILTER_USE_KEY)));
        // To avoid array_only helper absence, do manually:
        foreach (['eco_score','total_co2_saved','total_water_saved','total_waste_reduced'] as $field) {
            if (array_key_exists($field, $data)) {
                $profile->{$field} = $data[$field];
            }
        }
        $profile->save();

        return response()->json(['message' => 'Profile updated', 'profile' => $profile]);
    }
}
