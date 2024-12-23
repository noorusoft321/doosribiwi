@extends('bdo.layouts.master')

@section('title', $title)

@push('style')
    <style>
        table.general-info tr td{
            padding-top: 20px;
            height: 60px;
        }
        table.general-info tr td:first-child {
            width: 30% !important;
        }
        .form-switch .form-check-input {
            width: 4em!important;
            height: 2em!important;
            cursor: pointer;
        }
        .call-his-height{
            height: 410px;
            overflow-y: auto;
        }
        .card-header {
            text-transform: uppercase;
        }
        .bg-red {
            box-shadow:inset 0px 1px 0px 0px #171717;
            background:linear-gradient(to bottom, #171717 5%, #000000 100%);
            background-color:#171717;
            border-radius:11px;
            border:none;
            display:inline-block;
            cursor:pointer;
            color:#ffffff;
            font-size:14px;
            padding:4px 9px;
            text-decoration:none;
            text-shadow:0px 1px 0px #cc9f52;
        }
        .img-container {
            position: relative;
            width: 100%;
            margin-bottom: 10px;
        }

        .image {
            opacity: 1;
            display: block;
            width: 100%;
            height: auto;
            transition: .5s ease;
            backface-visibility: hidden;
        }

        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }

        .img-container:hover .image {
            opacity: 0.3;
        }

        .img-container:hover .middle {
            opacity: 1;
        }

        .text {
            background-color: #9B2C47;
            color: white;
            font-size: 14px;
            padding: 8px 16px;
        }
    </style>
@endpush
@php
    $discussions = explode("|||",$support->discussion);
@endphp
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
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Detail</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover general-info">
                                <tbody>
                                <tr>
                                    <td>Full Name</td>
                                    <td>{{$support->full_name}}</td>
                                </tr>
                                <tr>
                                    <td>Mobile #</td>
                                    <td>{{$support->mobile_number}}</td>
                                </tr>
                                <tr>
                                    <td>Message</td>
                                    <td>
                                        <ul>
                                            @foreach($discussions as $val)
                                                <li>{{$val}}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        <select onchange="changeSupportStatus(this)" name="issue" class="form-control">
                                            <option value="Pending" {{($support->issue=="Pending") ? 'selected' : ''}}>Pending</option>
                                            <option value="Progress" {{($support->issue=="Progress") ? 'selected' : ''}}>Progress</option>
                                            <option value="Fake" {{($support->issue=="Fake") ? 'selected' : ''}}>Fake</option>
                                            <option value="Fixed" {{($support->issue=="Fixed") ? 'selected' : ''}}>Fixed</option>
                                        </select>
                                    </td>
                                </tr>
                                @if(!empty($support->getCustomer))
                                    <tr>
                                        <td>
                                            <h5 class="edit-profile-side-heading font-size14"> Profile Link
                                                <span class="btn btn-sm btn-outline-primary" onclick="copyToClipBoard(this)">Copy</span>
                                            </h5>
                                        </td>
                                        <td>
                                            @php $uniqueProfileSlug = $support->getCustomer->gender_name.'-proposal-'.(!empty($support->getCustomer->getCitySlug)?$support->getCustomer->getCitySlug->slug:'NA').'-'.(!empty($support->getCustomer->getCountrySlug)?$support->getCustomer->getCountrySlug->slug:'NA').'-'.$support->getCustomer->faker_id; @endphp
                                            <input type="text" name="user__name"  value="{{route('search.by.slug',[$uniqueProfileSlug])}}" class="form-control">
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Website Support History</h4>
                        </div>
                        <div class="card-body call-his-height" id="callHisHeight">
                            @foreach($callHistory as $val)
                                <div class="chat-message-right mb-4">
                                    <div class="flex-shrink-1 bg-light rounded border  border-1 border-primary py-2 px-3 mr-3">
                                        <div class="mb-1 font-18">{{$val->user_name}} <span class="float-end">{{date('d M Y h:i A',strtotime($val->created_at))}}</span></div>
                                        {{$val->comment}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="card-footer">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="message" id="message" placeholder="Type your comment here...">
                                <span id="send_message" class="input-group-text bg-primary" role="button">
                                    <i class="bx bx-send text-white" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        let customerId = '{{$support->id}}';
        $(function (){
            $('#message').on('keyup', function (e) {
                if (e.key === 'Enter') {
                    if (e.target.value.trim()) {
                        saveComment(e.target.value.trim());
                    }
                }
                return false;
            });

            $('#send_message').on('click', function (e) {
                if ($('#message').val().trim()) {
                    saveComment($('#message').val().trim());
                }
                return false;
            });

            var objDiv = document.getElementById("callHisHeight");
            objDiv.scrollTop = objDiv.scrollHeight;

        });

        function saveComment(comment) {
            axios.post('{{route('bdo.save.support.history')}}', {
                comment:comment,
                customer_id: customerId
            }).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                if (res.data.status=='success') {
                    let newMes = `
                        <div class="chat-message-right mb-4">
                            <div class="flex-shrink-1 bg-light rounded border  border-1 border-primary py-2 px-3 mr-3">
                                <div class="mb-1 font-18">${res.data.data.user_name} <span class="float-end">${res.data.data.date_with_format}</span></div>
                                ${res.data.data.comment}
                            </div>
                        </div>`;
                    $('#callHisHeight').append(newMes);
                    $('#message').val('');
                    setTimeout(function(){
                        var objDiv = document.getElementById("callHisHeight");
                        objDiv.scrollTop = objDiv.scrollHeight;
                    }, 500);
                }
            }).catch(function (error) {
                alertyFy('There is something wrong*','warning',3000);
            });
        }

        function copyToClipBoard(input) {
            $(input).attr('disabled',false);
            var temp = $("<input>");
            $("body").append(temp);
            temp.val($('input[name="user__name"]').val()).select();
            document.execCommand("copy");
            temp.remove();
            alertyFy('Copied successfully','success',1500);
        }
        
        function changeSupportStatus(input) {
            if (confirm("Are you sure you want to change status?")) {
                axios.post('{{route('bdo.support.status')}}', {
                    issue:$(input).val(),
                    support_id: customerId
                }).then(function (res) {
                    alertyFy(res.data.msg,res.data.status,3000);
                    if (res.data.status=='success') {
                        let newMes = `
                        <div class="chat-message-right mb-4">
                            <div class="flex-shrink-1 bg-light rounded border  border-1 border-primary py-2 px-3 mr-3">
                                <div class="mb-1 font-18">${res.data.data.user_name} <span class="float-end">${res.data.data.date_with_format}</span></div>
                                ${res.data.data.comment}
                            </div>
                        </div>`;
                        $('#callHisHeight').append(newMes);
                        $('#message').val('');
                        setTimeout(function(){
                            var objDiv = document.getElementById("callHisHeight");
                            objDiv.scrollTop = objDiv.scrollHeight;
                        }, 500);
                    } else {
                        $(input).val('{{$support->issue}}');
                    }
                }).catch(function (error) {
                    $(input).val('{{$support->issue}}');
                    alertyFy('There is something wrong*','warning',3000);
                });
            } else {
                $(input).val('{{$support->issue}}');
            }
        }
    </script>
@endpush
