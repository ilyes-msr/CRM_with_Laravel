<?php

namespace Crm\Project\Services;

use Crm\Project\Events\ProjectCreation;
use Crm\Project\Models\Project;
use Crm\Project\Requests\CreateProject;
use Crm\Project\Requests\UpdateProject;
use Illuminate\Http\Response;

class ProjectService
{
    public function createProject(CreateProject $request, int $customerId) {
        $project = new Project();
        $project->project_name = $request->project_name;
        $project->status = (bool)$request->status;
        $project->customer_id = $customerId;
        $project->project_cost = (float)$request->project_cost;

        $project->save();

        event(new ProjectCreation($project));
        return $project;
    }

    public function updateProject(UpdateProject $request, int $customerId, int $id) {
        $project = Project::find($id);
        if(!$project) {
            return response()->json(['status' => 'Not Found'], Response::HTTP_NOT_FOUND);
        }
        if($project->customer_id != $customerId) {
            return response()->json(['status' => 'Access Denied'], Response::HTTP_BAD_REQUEST);
        }
        $project->project_name = $request->project_name;
        $project->status = (bool)$request->status;
        $project->project_cost = (float)$request->project_cost;

        $project->save();

        return $project;
    }
}
