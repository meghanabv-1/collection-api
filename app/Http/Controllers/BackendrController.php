<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Backendr;

class BackendrController extends Controller
{
    public function index()
    {
        $backendrs = auth()->user()->backendrs;
 
        return response()->json([
            'success' => true,
            'data' => $backendrs
        ]);
    }
 
    public function show($id)
    {
        $bankendr = auth()->user()->backendrs()->find($id);
 
        if (!$backendr) {
            return response()->json([
                'success' => false,
                'message' => 'backendr with id ' . $id . ' not found'
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $backendr->toArray()
        ], 400);
    }
 
    public function store(Request $request)
    {
        $this->validate($request, [
            'date' => 'required',
            'accounthead' => 'required',
            'description' => 'required',
            'debit' => 'required|integer',
            'credit' => 'required|integer',
            'cashbalance' => 'required|integer'
        ]);
 
        $backendr = new Backendr();
        $backendr->date = $request->date;
        $backendr->accounthead = $request->accounthead;
        $backendr->description = $request->description;
        $backendr->debit = $request->debit;
        $backendr->credit = $request->credit;
        $backendr->cashbalance = $request->cashbalance;
 
        if (auth()->user()->backendrs()->save($backendr))
            return response()->json([
                'success' => true,
                'data' => $backendr->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Backend could not be added'
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
        $backendr = auth()->user()->backendrs()->find($id);
 
        if (!$backendr) {
            return response()->json([
                'success' => false,
                'message' => 'Backendr with id ' . $id . ' not found'
            ], 400);
        }
 
        $updated = $backendr->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Backendr could not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        $backendr = auth()->user()->backendrs()->find($id);
 
        if (!$backendr) {
            return response()->json([
                'success' => false,
                'message' => 'Backendr with id ' . $id . ' not found'
            ], 400);
        }
 
        if ($backendr->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Backendr could not be deleted'
            ], 500);
        }
    }
}





