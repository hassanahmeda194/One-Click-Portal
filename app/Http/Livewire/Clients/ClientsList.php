<?php

namespace App\Http\Livewire\Clients;

use App\Models\BasicModels\OrderCountry;
use App\Models\ResearchOrders\OrderClientInfo;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Yajra\DataTables\DataTables;

class ClientsList extends Component
{
    public function render()
    {
        $Countries = OrderCountry::get();
        $clients = OrderClientInfo::latest('id')->get();
        return view('livewire.clients.clients-list', compact('Countries', 'clients'))->layout('layouts.authorized');
    }

    /**
     * @return JsonResponse
     * @throws Exception
     */
//   

    public function updateClientInfo(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        $OrderClientInfo = OrderClientInfo::where('id', $request->Client_Code)
            ->update([
            'Client_Name' => $request->Client_Name,
            'Client_Country' => $request->Client_Country,
            'Client_Email' => $request->Client_Email,
            'Client_Phone' => $request->Client_Phone,
        ]);
        if ($OrderClientInfo){
            DB::commit();
            return back()->with('Success!', "Client Information Updated!");
        }
        DB::rollBack();
        return back()->with('Error!', "Client Editing Failed!");
    }

}
