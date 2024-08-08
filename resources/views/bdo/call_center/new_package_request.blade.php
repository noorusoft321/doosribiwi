@extends('bdo.layouts.master')

@section('title', $title)

@push('style')
    <style>
        .circle--image {
            text-align: center !important;
        }
        .circle--image img {
            width: 200px;
            height: 200px;
        }
    </style>
@endpush

@section('content')

    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{route('bdo.get.customers.center')}}"><i class="bx bx-home-alt"></i></a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                {{$title}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <form class="row" id="packageRequestForm">
                        @csrf
                        <div class="col-md-6 border">
                            <div class="form-group mt-3">
                                <label for="search_by">Search By</label>
                                <select name="search_by" id="search_by" class="form-control">
                                    <option value=""> -- Select -- </option>
                                    <option value="Link">Link</option>
                                    <option value="Email">Email</option>
                                    <option value="Username">Username</option>
                                    <option value="Phone">Phone</option>
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <label for="search_value">Search Value</label>
                                <input type="text" name="search_value" id="search_value" class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <label for="package_id">Package</label>
                                <select name="package_id" id="package_id" class="form-control">
                                    <option value=""> -- Select -- </option>
                                    @foreach($packages as $package)
                                        <option value="{{$package->id}}">{{$package->package_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <button onclick="fetchCustomer(this)" class="btn btn-outline-danger">Find Customer</button>
                            </div>
                        </div>
                        <div class="col-md-6 border">
                            <div class="fetch-customer"></div>
                        </div>
                    </form>
                </div>
            </div>
            <hr/>
        </div>
    </div>

@endsection

@push('script')
    <script>
        function fetchCustomer(input) {
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            $('.fetch-customer').empty();
            $(input).attr('disabled',true);
            axios.post("{{route('bdo.fetch.customer')}}", $('form#packageRequestForm').serialize()).then(function (res) {
                $(input).removeAttr('disabled');
                if (res.data.status=='success') {
                    if (res.data.data) {
                        $('.fetch-customer').html(res.data.data);
                        return;
                    }
                }
                alertyFy(res.data.msg,res.data.status,3000);
            }).catch(function (error) {
                if (error.response.status==422) {
                    $.each(error.response.data.errors, function (k, v) {
                        $('#packageRequestForm :input[name="' + k + '"]').addClass("has-error");
                        $('#packageRequestForm :input[name="' + k + '"]').after("<span class='text-danger'>" + v[0] + "</span>");
                    });
                } else {
                    alertyFy('There is something wrong','warning',3000);
                }
                $(input).removeAttr('disabled');
            });
        }

        function deleteRecord(input, mainId) {
            $(input).attr('disabled', true);
            if (confirm("Are you sure you want to delete this?")) {
                $.get(`{{route('bdo.package.request.delete')}}/${mainId}`, function (res) {
                    if (res.status == 'success') {
                        alertyFy(res.msg, res.status, 2000);
                        listTable.ajax.reload();
                    } else {
                        alertyFy(res.msg, res.status, 2000);
                        listTable.ajax.reload();
                    }
                });
            }
        }

        function sendPackageRequest(input) {
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            $(input).attr('disabled',true);
            let formData = new FormData();
            formData.append('search_by', $(':input[name="search_by"] option:selected').val());
            formData.append('search_value', $(':input[name="search_value"]').val());
            formData.append('package_id', $(':input[name="package_id"] option:selected').val());
            formData.append('customer_id', $(':input[name="customer_id"]').val());
            formData.append('approved_by', $(':input[name="approved_by"] option:selected').val());
            axios.post("{{route('bdo.save.package.request')}}", formData).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                if (res.data.status=='success') {
                    setTimeout(function () {
                        location.href = '{{route('bdo.get.package.request')}}';
                    },3000);
                }
                $(input).removeAttr('disabled');
            }).catch(function (error) {
                if (error.response.status==422) {
                    $.each(error.response.data.errors, function (k, v) {
                        $('#packageRequestForm :input[name="' + k + '"]').addClass("has-error");
                        $('#packageRequestForm :input[name="' + k + '"]').after("<span class='text-danger'>" + v[0] + "</span>");
                    });
                } else {
                    alertyFy('There is something wrong','warning',3000);
                }
                $(input).removeAttr('disabled');
            });
        }

    </script>
@endpush