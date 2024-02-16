<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePartnerRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Partner;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('affiliate_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $partners = Partner::all();
        return view('admin.partners.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.partners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartnerRequest $request)
    {
        $partnerData = $request->validated();
        $partner = Partner::create($partnerData);

        if ($request->hasFile('image')) {
            $partner->addMediaFromRequest('image')->toMediaCollection('partners');
        }
        return redirect()->route("admin.partners.index")->with('success', 'Partner created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProjectRequest $request, Partner $partner)
    {
        $partner->update($request->validated());
        if ($request->hasFile('image')) {
            $partner->clearMediaCollection('partner');
            $partner->addMediaFromRequest('image')->toMediaCollection('partner');
        }
        return redirect()->route("admin.partners.index")->with('success', 'Partner updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        $partner->delete();

        return back()->with('success', 'Partner deleted successfully.');
    }
}
