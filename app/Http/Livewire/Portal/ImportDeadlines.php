<?php

namespace App\Http\Livewire\Portal;

use App\Models\ResearchOrders\ResearchOrderSubmissionDeadline;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JsonException;
use Livewire\Component;

class ImportDeadlines extends Component
{
    public function render()
    {
        return view('livewire.portal.import-deadlines')->layout('layouts.authorized');
    }

    /**
     * @throws JsonException
     */
    public function import(Request $request): JsonResponse
    {
        $request->validate([
            'json_file' => 'required|mimes:json'
        ]);

        try {
            // Start a database transaction
            DB::beginTransaction();

            $file = $request->file('json_file');
            $json = file_get_contents($file);
            $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

            foreach ($data as $tableData) {
                if ($tableData['type'] === 'table' && $tableData['name'] === 'order_submission_infos') {
                    foreach ($tableData['data'] as $item) {
                        if (empty($item['F_DeadLine']) && empty($item['S_DeadLine']) && empty($item['T_DeadLine'])){
                            continue;
                        }
                        if (!empty($item['F_DeadLine'])) {
                            ResearchOrderSubmissionDeadline::create([
                                'DeadLines' => $item['F_DeadLine'],
                                'is_Submit' => 0,
                                'order_id' => $item['order_id'],
                            ]);
                        }
                        if (!empty($item['S_DeadLine'])) {
                            ResearchOrderSubmissionDeadline::create([
                                'DeadLines' => $item['S_DeadLine'],
                                'is_Submit' => 0,
                                'order_id' => $item['order_id'],
                            ]);
                        }

                        if (!empty($item['T_DeadLine'])) {
                            ResearchOrderSubmissionDeadline::create([
                                'DeadLines' => $item['T_DeadLine'],
                                'is_Submit' => 0,
                                'order_id' => $item['order_id'],
                            ]);
                        }
                    }
                }
            }

            // Commit the transaction
            DB::commit();
            return response()->json(['message' => 'Data imported successfully']);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollback();

            return response()->json(['error' => 'An error occurred during import: ' . $e->getMessage()], 500);
        }
    }
}
