<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Prescription;
use App\Models\PrescriptionMedicine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prescriptions = Prescription::all();

        return view('prescriptions.index', compact('prescriptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('prescriptions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'prescriptions.*' => 'required|array|max:5',
            'prescriptions.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'note' => 'nullable|string',
            'address' => 'required|string',
            'delivery_time' => 'required|string',
        ]);

        $userId = Auth::id();

        $imagePaths = [];

        foreach ($request->file('prescriptions') as $image) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/prescriptions'), $imageName);
            $imagePaths[] = 'uploads/prescriptions/' . $imageName;
        }

        Prescription::create([
            'prescription' => $imagePaths,
            'note' => $request->note,
            'delivery_address' => $request->address,
            'delivery_time' => $request->delivery_time,
            'image_paths' => $imagePaths,
            'user_id' => $userId
        ]);

        return redirect()->route('prescriptions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prescription $prescription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prescription $prescription)
    {
        $medicines = Medicine::all();

        $presMedi = PrescriptionMedicine::where('prescription_id', $prescription->id)
            ->with('medicine')
            ->get();
            
        return view('prescriptions.edit', compact('prescription', 'medicines', 'presMedi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prescription $prescription)
    {
        if ($request->has('status')) {
            $prescription->update([
                'status' => $request->input('status'),
            ]);
        }

        return redirect()->route('prescriptions.edit', $prescription->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prescription $prescription)
    {
        //
    }
}
