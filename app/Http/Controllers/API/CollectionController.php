<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Collection;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = auth()->user()->collections;
 
        return response()->json([
            'success' => true,
            'data' => $collections
        ]);
    }
 
    public function show($id)
    {
        $bankend = auth()->user()->collections()->find($id);
 
        if (!$backend) {
            return response()->json([
                'success' => false,
                'message' => 'backend with id ' . $id . ' not found'
            ], 404);
        }
 
        return response()->json([
            'success' => true,
            'data' => $backend->toArray()
        ], 200);
    }
 
    public function store(Request $request)
    {
    	$this->validate($request, [
    		'date' => 'required',
            'account_head' => 'required',
            'description' => 'required',
            'type' => 'required|in:debit,credit,cash_balance',
            'amount' => 'integer',
    	]);
 
        $backend = new Collection();
        $backend->date = $request->date;
        $backend->account_head = $request->account_head;
        $backend->description = $request->description;
        $backend->type = $request->type;

        if ($request->type == 'cash_balance'){
        	$backend->cash_balance = $request->amount;
        }
       	else {
       		$collection = Collection::latest()->first();
       		$last_balance = $collection ? $collection['cash_balance'] : 0;

       		if($request->type == 'debit'){
       			$cash_balance = $last_balance - $request->amount;
       		} else {
       			$cash_balance = $last_balance + $request->amount;
       		}

       		$backend->amount = $request->amount;
       		$backend->cash_balance = $cash_balance;
       	}
 
        if (auth()->user()->collections()->save($backend))
            return response()->json([
                'success' => true,
                'data' => $backend->toArray()
            ], 201);
        else
            return response()->json([
                'success' => false,
                'message' => 'Bad Request'
            ], 400);
    }
 
    public function update(Request $request, $id)
    {
        $backend = auth()->user()->collections()->find($id);
 
        if (!$backend) {
            return response()->json([
                'success' => false,
                'message' => 'Collection with id ' . $id . ' not found'
            ], 404);
        }
 
        $updated = $backend->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true
            ], 201);
        else
            return response()->json([
                'success' => false,
                'message' => 'Collection could not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        $backend = auth()->user()->collections()->find($id);
 
        if (!$backend) {
            return response()->json([
                'success' => false,
                'message' => 'Collection with id ' . $id . ' not found'
            ], 404);
        }
 
        if ($backend->delete()) {
            return response()->json([
                'success' => true
            ], 204);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Collection could not be deleted'
            ], 500);
        }
    }
}
