<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Models\Partner;
use App\Models\Project;
use App\Models\User;
use App\Models\JoinRequest;
use Illuminate\Http\Request;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $partners = Partner::all();
        $artists = User::role('artist')->get();
        return view('admin.projects.create', compact('partners', 'artists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $project = Project::create($request->validated());

        if ($request->has('artist_ids')) {
            $project->artists()->attach($request->artist_ids);
        }

        if ($request->has('partner_ids')) {
            $project->partners()->attach($request->partner_ids);
        }

        if ($request->hasFile('image')) {
            $project->addMediaFromRequest('image')->toMediaCollection('projects');
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load('artists', 'partners');

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::findOrFail($id);
        $partners = Partner::all();

        $artists = User::role('artist')->get();
        return view('admin.projects.edit', compact('project', 'partners', 'artists'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProjectRequest $request, Project $project)
    {
        $project->update($request->validated());

        if ($request->has('artist_ids')) {
            $project->artists()->sync($request->validated()['artist_ids']);
        }

        if ($request->has('partner_ids')) {
            $project->partners()->sync($request->validated()['partner_ids']);
        }

        if ($request->hasFile('image')) {
            $project->clearMediaCollection('projects');
            $project->addMediaFromRequest('image')->toMediaCollection('projects');
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return back();
    }

    public function requestJoin(JoinRequest $request, $projectId)
    {
        $user = auth()->user();
        $project = Project::findOrFail($projectId);

        $existingRequest = $project->requests()->where('user_id', $user->id)->first();

        if ($existingRequest) {
            $existingRequest->update(['status' => 0]);
            return back()->with('success', 'Your request to join the project has been submitted.');
        }

        JoinRequest::create([
            'user_id' => $user->id,
            'project_id' => $project->id,
            'status' => 0,
        ]);



        return back()->with('success', 'Your request to join the project has been submitted.');
    }

    public function listRequests()
    {
        $artist = User::role('artist')->get();
        $projects = Project::all();

        $joinRequests = JoinRequest::with(['user', 'project'])->get();
        return view('admin.requests.index', compact('joinRequests' , 'artist', 'projects'));
    }


    public function updateRequestStatus(Request $request, $joinRequestId)
    {
        $joinRequest = JoinRequest::findOrFail($joinRequestId);
        $status = $request->input('status');

        if ($status === 'accept') {
            // Update the join request status to accepted (1)
            $joinRequest->status = 1;
            $joinRequest->save();

            // Add the user to the project_user table
            $project = Project::find($joinRequest->project_id);
            $project->users()->syncWithoutDetaching([$joinRequest->user_id]);

            return redirect()->back()->with('success', "Request accepted and user added to the project.");
        } elseif ($status === 'decline') {
            $joinRequest->status = 2;
            $joinRequest->save();

            $project = Project::find($joinRequest->project_id);
            $project->users()->detach($joinRequest->user_id);

            return redirect()->back()->with('success', "Request declined and user removed from the project, if they were added previously.");
        }

        return redirect()->back()->with('error', "Invalid status.");
    }


}
