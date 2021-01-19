<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $suppliers = Supplier::all();

        return response()->json([
            'suppliers' => $suppliers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            's_name' => 'required|min:5|max:100',
            's_contact' => 'required|numeric',
            's_email' => 'required|email',
            's_address' => 'required',
            's_remarks' => 'required'
        ]);

        Supplier::create([
            's_name' => $request->s_name,
            's_contact' => $request->s_contact,
            'slug' => slugify($request->s_name),
            's_email' => $request->s_email,
            's_address' => $request->s_address,
            's_remarks' => $request->s_remarks,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($slug)
    {
        $category = Supplier::where('slug', $slug)->first();

        return response()->json(['category', $category], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, supplier $supplier)
    {
        $request->validate([
            's_name' => 'required|min:5|max:100',
            's_contact' => 'required|numeric',
            's_email' => 'required|email',
            's_address' => 'required',
            's_remarks' => 'required'
        ]);
        $supplier = Supplier::find($request->slug);
        $supplier->s_name = $request->s_name;
        $supplier->s_contact = $request->s_contact;
        $supplier->slug = slugify($request->s_name);
        $supplier->s_email = $request->s_email;
        $supplier->s_address = $request->s_address;
        $supplier->s_remarks = $request->s_remarks;
        if ($supplier->update()) {
            $success = true;
        }else{
            $success = false;
        }

        return response()->json(['success', $success], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(supplier $supplier)
    {
        //
    }
}
