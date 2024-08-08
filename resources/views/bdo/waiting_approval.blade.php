@extends('bdo.layouts.master')

@section('title','Approval Request')

@push('style')
    <style></style>
@endpush

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="alert alert-outline-danger">Your login approval request is {{$authyApprovalStatus}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection