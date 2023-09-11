@extends('admin.layouts.master')

@section('title', $title)

@push('style')

@endpush

@section('content')

    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
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

            <div class="card">
                <div class="card-body">
                    <form id="permissionsForm">
                        <h4>Roles</h4>
                        <select onchange="getPermissions(this)" name="role_id" id="role_id" class="form-control">
                            <option value=""> -- Select -- </option>
                            @foreach($roles as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                            @endforeach
                        </select>
                        <hr>
                        <h3>Permissions</h3>
                        <div class="data--content"></div>
                    </form>
                </div>
            </div>
            <hr/>
        </div>
    </div>

@endsection

@push('script')
    <script>

        function saveAllPermission(input) {
            $(input).attr('disabled',true);
            axios.post("{{route('admin.save.permissions')}}", $('#permissionsForm').serialize()).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                $(input).attr('disabled',false);
            }).catch(function (error) {
                alertyFy('There is something wrong','warning',3000);
                $(input).attr('disabled',false);
            });
        }

        function getPermissions(input) {
            let roleId = $(input).val();
            $('.data--content').empty().hide();
            if (roleId) {
                axios.post("{{route('admin.get.related.permissions')}}", {
                    role_id:roleId
                }).then(function (res) {
                    if (res.data) {
                        $('.data--content').html(res.data).show('slow');
                    }
                }).catch(function (error) {
                    console.log('errors',error.response.data);
                    alertyFy('There is something wrong','warning',3000);
                });
            }
        }

    </script>
@endpush
