<?php

namespace App\Http\Controllers;

use App\Mail\QuotationSent;
use App\Models\Medicine;
use App\Models\Order;
use App\Models\Prescription;
use App\Models\PrescriptionMedicine;
use App\Models\PrescriptionOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $orders = Order::whereHas('prescriptions', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with('prescriptions')->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Prescription $prescription)
    {
        $validated = $request->validate([
            'drug' => 'required|exists:medicines,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $medicine = Medicine::findOrFail($validated['drug']);
        $quantity = $validated['quantity'];
        $totalValue = $medicine->unit_price * $quantity;

        PrescriptionMedicine::create([
            'prescription_id' => $prescription->id,
            'medicine_id' => $medicine->id,
            'quantity' => $quantity,
            'total_price' => $totalValue,
        ]);

        $prescription->update(['status' => 'SUBMITTED']);

        return redirect()->route('prescriptions.edit', $prescription->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prescription $prescription)
    {

        $total = PrescriptionMedicine::where('prescription_id', $prescription->id)->sum('total_price');

        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $total,
        ]);

        $order->prescriptions()->attach($prescription->id);

        if (auth()->user()->is_admin) {
            $prescription->load('user');
            $user = $prescription->user;
            if ($user) {
                // Send email immediately (consider queueing for production)
                Mail::to($user->email)->send(new QuotationSent($prescription, $user));
            }
        }

        return redirect()->route('prescriptions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
