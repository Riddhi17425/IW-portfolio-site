@extends('admin.layouts.app')

@section('title', 'Add Service')

@section('content')
<div class="container-xxl">
    <div class="row align-items-center mb-4">
        <div class="col-12">
            <div class="card-header py-3 no-bg bg-transparent d-flex justify-content-between align-items-center border-bottom flex-wrap">
                <h3 class="fw-bold mb-0">Add Service</h3>
            </div>
        </div>
    </div>

    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="{{ route('service.store') }}">
            @csrf
            <div class="card mb-3 p-3">
                <div class="card-header py-3 p-0 bg-transparent border-bottom-0">
                    <h6 class="mb-0 fw-bold">Service Information</h6>
                </div>

                <div class="row g-3 align-items-center mt-2">
                    <div class="card mb-4 border">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <strong>Service Titles</strong>
                            <button type="button" id="addServiceBlock" class="btn btn-sm btn-success">+ Add More</button>
                        </div>
                        <div class="card-body" id="serviceRepeater">
                            <!-- Initial Title Field -->
                            <div class="serviceGroup border rounded p-3 mb-3">
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="service_title[]" class="form-control">
                                </div>
                                <div class="text-end">
                                    <button type="button" class="btn btn-danger removeService">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3 align-items-center mt-2">
                    <div class="card mb-4 border">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <strong>Expected Timeline</strong>
                            <button type="button" id="addTimelineBlock" class="btn btn-sm btn-success">+ Add More</button>
                        </div>
                        <div class="card-body" id="timelineRepeater">
                            <!-- Initial Timeline Field -->
                            <div class="timelineGroup border rounded p-3 mb-3">
                                <div class="mb-3">
                                    <label class="form-label">Timeline Title</label>
                                    <input type="text" name="timeline_title[]" class="form-control">
                                </div>
                                <div class="text-end">
                                    <button type="button" class="btn btn-danger removeTimeline">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add Budget Fields -->
                <div class="row g-3 align-items-center mt-2">
                    <div class="card mb-4 border">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <strong>Budget</strong>
                            <button type="button" id="addBudgetBlock" class="btn btn-sm btn-success">+ Add More</button>
                        </div>
                        <div class="card-body" id="budgetRepeater">
                            <!-- Initial Budget Field -->
                            <div class="budgetGroup border rounded p-3 mb-3">
                                <div class="mb-3">
                                    <label for="budget" class="form-label">Budget</label>
                                    <input type="text" name="budget[]" class="form-control"  placeholder="Enter Budget">
                                </div>
                                <div class="text-end">
                                    <button type="button" class="btn btn-danger removeBudget">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-primary py-2 px-5 text-uppercase">Save</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const addServiceButton = document.getElementById('addServiceBlock');
    const serviceRepeater = document.getElementById('serviceRepeater');

    // Add Service title field dynamically
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

    // Remove Service title block
    serviceRepeater.addEventListener('click', function (event) {
        if (event.target.classList.contains('removeService')) {
            event.target.closest('.serviceGroup').remove();
        }
    });

    // Add Timeline title field dynamically
    const addTimelineButton = document.getElementById('addTimelineBlock');
    const timelineRepeater = document.getElementById('timelineRepeater');

    addTimelineButton.addEventListener('click', function () {
        const timelineGroup = document.createElement('div');
        timelineGroup.classList.add('timelineGroup', 'border', 'rounded', 'p-3', 'mb-3');

        timelineGroup.innerHTML = `
            <div class="mb-3">
                <label class="form-label">Timeline Title</label>
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

    // Remove Timeline block
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
                <label for="budget" class="form-label">Budget (in USD)</label>
                <input type="text" name="budget[]" class="form-control" step="0.01" min="0" placeholder="Enter Budget">
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
