<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Backend;

class BackendController extends Controller
{
    public function index()
    {
        $backends = auth()->user()->backends;
 
        return response()->json([
            'success' => true,
            'data' => $backends
        ]);
    }
 
    public function show($id)
    {
        $bankend = auth()->user()->backends()->find($id);
 
        if (!$backend) {
            return response()->json([
                'success' => false,
                'message' => 'backend with id ' . $id . ' not found'
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $backend->toArray()
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
 
        $backend = new Backend();
        $backend->date = $request->date;
        $backend->accounthead = $request->accounthead;
        $backend->description = $request->description;
        $backend->debit = $request->debit;
        $backend->credit = $request->credit;
        $backend->cashbalance = $request->cashbalance;
 
        if (auth()->user()->backends()->save($backend))
            return response()->json([
                'success' => true,
                'data' => $backend->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Backend could not be added'
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
        $backend = auth()->user()->backends()->find($id);
 
        if (!$backend) {
            return response()->json([
                'success' => false,
                'message' => 'Backend with id ' . $id . ' not found'
            ], 400);
        }
 
        $updated = $backend->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Backend could not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        $backend = auth()->user()->backends()->find($id);
 
        if (!$backend) {
            return response()->json([
                'success' => false,
                'message' => 'Backend with id ' . $id . ' not found'
            ], 400);
        }
 
        if ($backend->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Backend could not be deleted'
            ], 500);
        }
    }
}
