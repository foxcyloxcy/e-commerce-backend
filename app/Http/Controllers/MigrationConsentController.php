<?php

namespace App\Http\Controllers;

use App\Models\MigrationConsent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MigrationConsentController extends Controller
{
    public function show()
    {
        $consent = MigrationConsent::where('user_id', auth()->user()->id)->latest()->first();

        return response(['data' => $consent], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'preference' => 'required|in:migrate,decline',
            'terms_accepted' => 'required|boolean',
            'profile_snapshot' => 'nullable|array',
            'selected_items' => 'nullable|array',
        ]);

        if ($validated['preference'] === 'migrate' && !$validated['terms_accepted']) {
            return response(['message' => 'Migration terms must be accepted before migrating.'], 422);
        }

        DB::beginTransaction();

        try {
            $consent = MigrationConsent::create([
                'user_id' => auth()->user()->id,
                'preference' => $validated['preference'],
                'terms_accepted' => $validated['terms_accepted'],
                'profile_snapshot' => $validated['preference'] === 'migrate' ? ($validated['profile_snapshot'] ?? []) : null,
                'selected_items' => $validated['preference'] === 'migrate' ? ($validated['selected_items'] ?? []) : null,
                'accepted_at' => now(),
            ]);

            DB::commit();

            return response(['data' => $consent, 'message' => 'Migration preference saved.'], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response(['message' => $e->getMessage()], 400);
        }
    }
}
