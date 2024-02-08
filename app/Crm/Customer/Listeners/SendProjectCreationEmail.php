<?php

namespace Crm\Customer\Listeners;
use Crm\Customer\Services\CustomerService;
use Crm\Project\Events\ProjectCreation;

class SendProjectCreationEmail
{
    private CustomerService $customerService;
    /**
     * Create the event listener.
     */
    public function __construct(CustomerService $customerService)
    {
        $this->setCustomerService($customerService);
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
    /**
     * Handle the event.
     */
    public function handle(ProjectCreation $event): void
    {
        $project = $event->getProject();
        $customer = $this->customerService->show($project->customer_id);

//        dd($project, $customer);
    }
}
