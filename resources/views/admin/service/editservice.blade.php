@extends('admin.layouts.app')

@section('title', 'Edit Service')

@section('content')
<div class="container-xxl">
    <div class="row align-items-center mb-4">
        <div class="col-12">
            <div class="card-header py-3 no-bg bg-transparent d-flex justify-content-between align-items-center border-bottom flex-wrap">
                <h3 class="fw-bold mb-0">Edit Service</h3>
            </div>
        </div>
    </div>

    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="{{ route('service.update', $service->id) }}">
            @csrf
            @method('PUT')
            
            <div class="card mb-3 p-3">
                <div class="card-header py-3 p-0 bg-transparent border-bottom-0">
                    <h6 class="mb-0 fw-bold">Service Information</h6>
                </div>

                <div class="row g-3 align-items-center mt-2">
                    @php
                        // Get the existing service titles, timelines, and budgets
                        $serviceTitles = $service->service_title ?? [];
                        $timelineTitles = $service->timeline_title ?? [];
                        $budgets = $service->budget ?? [];
                    @endphp

                    <div class="card mb-4 border">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <strong>Service Titles</strong>
                            <button type="button" id="addServiceBlock" class="btn btn-sm btn-success">+ Add More</button>
                        </div>
                        <div class="card-body" id="serviceRepeater">
                            @foreach ($serviceTitles as $title)
                            <div class="serviceGroup border rounded p-3 mb-3">
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="service_title[]" class="form-control" value="{{ $title }}">
                                </div>
                                <div class="text-end">
                                    <button type="button" class="btn btn-danger removeService">Remove</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="card mb-4 border">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <strong>Timeline Titles</strong>
                            <button type="button" id="addTimelineBlock" class="btn btn-sm btn-success">+ Add More</button>
                        </div>
                        <div class="card-body" id="timelineRepeater">
                            @foreach ($timelineTitles as $title)
                            <div class="timelineGroup border rounded p-3 mb-3">
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="timeline_title[]" class="form-control" value="{{ $title }}">
                                </div>
                                <div class="text-end">
                                    <button type="button" class="btn btn-danger removeTimeline">Remove</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="card mb-4 border">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <strong>Budgets</strong>
                            <button type="button" id="addBudgetBlock" class="btn btn-sm btn-success">+ Add More</button>
                        </div>
                        <div class="card-body" id="budgetRepeater">
                            @foreach ($budgets as $budget)
                            <div class="budgetGroup border rounded p-3 mb-3">
                                <div class="mb-3">
                                    <label class="form-label">Budget</label>
                                    <input type="text" name="budget[]" class="form-control" value="{{ $budget }}">
                                </div>
                                <div class="text-end">
                                    <button type="button" class="btn btn-danger removeBudget">Remove</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-success py-2 px-5 text-uppercase">Update</button>
        </form>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
<link rel="stylesheet" href="{!! asset('public/admin/dist/assets/plugin/dropify/dist/css/dropify.min.css') !!}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
<script src="{!! asset('public/admin/dist/assets/bundles/dropify.bundle.js') !!}"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const addServiceButton = document.getElementById('addServiceBlock');
    const serviceRepeater = document.getElementById('serviceRepeater');

    // Add Service Title field dynamically
    addServiceButton.addEventListener('click', function () {
        const serviceGroup = document.createElement('div');
        serviceGroup.classList.add('serviceGroup', 'border', 'rounded', 'p-3', 'mb-3');

        serviceGroup.innerHTML = `
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="service_title[]" class="form-control">
            </div>
            <div class="text-end">
                <button type="button" class="btn btn-danger removeService">Remove</button>
            </div>
        `;

        serviceRepeater.appendChild(serviceGroup);

        // Attach event to remove button
        serviceGroup.querySelector('.removeService').addEventListener('click', function () {
            serviceGroup.remove();
        });
    });

    // Remove Service Title block
    serviceRepeater.addEventListener('click', function (event) {
        if (event.target.classList.contains('removeService')) {
            event.target.closest('.serviceGroup').remove();
        }
    });

    // Add Timeline Title field dynamically
    const addTimelineButton = document.getElementById('addTimelineBlock');
    const timelineRepeater = document.getElementById('timelineRepeater');
    
    addTimelineButton.addEventListener('click', function () {
        const timelineGroup = document.createElement('div');
        timelineGroup.classList.add('timelineGroup', 'border', 'rounded', 'p-3', 'mb-3');
        
        timelineGroup.innerHTML = `
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="timeline_title[]" class="form-control">
            </div>
            <div class="text-end">
                <button type="button" class="btn btn-danger removeTimeline">Remove</button>
            </div>
        `;
        
        timelineRepeater.appendChild(timelineGroup);
        
        // Attach event to remove button
        timelineGroup.querySelector('.removeTimeline').addEventListener('click', function () {
            timelineGroup.remove();
        });
    });

    // Remove Timeline Title block
    timelineRepeater.addEventListener('click', function (event) {
        if (event.target.classList.contains('removeTimeline')) {
            event.target.closest('.timelineGroup').remove();
        }
    });

    // Add Budget field dynamically
    const addBudgetButton = document.getElementById('addBudgetBlock');
    const budgetRepeater = document.getElementById('budgetRepeater');

    addBudgetButton.addEventListener('click', function () {
        const budgetGroup = document.createElement('div');
        budgetGroup.classList.add('budgetGroup', 'border', 'rounded', 'p-3', 'mb-3');

        budgetGroup.innerHTML = `
            <div class="mb-3">
                <label class="form-label">Budget</label>
                <input type="text" name="budget[]" class="form-control">
            </div>
            <div class="text-end">
                <button type="button" class="btn btn-danger removeBudget">Remove</button>
            </div>
        `;
        
        budgetRepeater.appendChild(budgetGroup);
        
        // Attach event to remove button
        budgetGroup.querySelector('.removeBudget').addEventListener('click', function () {
            budgetGroup.remove();
        });
    });

    // Remove Budget block
    budgetRepeater.addEventListener('click', function (event) {
        if (event.target.classList.contains('removeBudget')) {
            event.target.closest('.budgetGroup').remove();
        }
    });
});
</script>
@endpush
