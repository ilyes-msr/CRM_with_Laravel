<?php

namespace App\Http\Controllers;

use Crm\Customer\Services\CustomerService;
use Crm\Project\Events\ProjectCreation;
use Crm\Project\Requests\CreateProject;
use Crm\Project\Requests\UpdateProject;
use Crm\Project\Services\ProjectService;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    private ProjectService $projectService;
    private CustomerService $customerService;


    public function __construct(ProjectService $projectService, CustomerService $customerService)
    {
        $this->setProjectService($projectService);
        $this->setCustomerService($customerService);
    }
    /**
     * @return ProjectService
     */
    public function getProjectService(): ProjectService
    {
        return $this->projectService;
    }

    /**
     * @param ProjectService $projectService
     */
    public function setProjectService(ProjectService $projectService): void
    {
        $this->projectService = $projectService;
    }

    /**
     * @return CustomerService
     */
    public function getCustomerService(): CustomerService
    {
        return $this->customerService;
    }

    /**
     * @param CustomerService $customerService
     */
    public function setCustomerService(CustomerService $customerService): void
    {
        $this->customerService = $customerService;
    }

    public function createProject(CreateProject $request, $customerId) {
        $customer = $this->customerService->show($customerId);
        if( !$customer ) {
            return response()->json(['status' => 'Customer not found'], Response::HTTP_NOT_FOUND);
        }
        return $this->projectService->createProject($request, $customerId);
    }

    public function UpdateProject(UpdateProject $request, $customerId, $id) {
        $customer = $this->customerService->show($customerId);
        if( !$customer ) {
            return response()->json(['status' => 'Customer Not Found'], Response::HTTP_NOT_FOUND);
        }

        return $this->projectService->UpdateProject($request, $customerId, $id);
    }
}
