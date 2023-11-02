@extends('front.layouts.master')
@section('title',$title)
@section('description', $title)

@push('style')
    <style>
        .radio-inline__label {
            border: 1px solid #075385;
        }
        .radio-inline__label {
            display: inline-block;
            padding: 0.5rem 1rem;
            margin-right: 18px;
            border-radius: 3px;
            transition: all .2s;
        }
        .radio-inline__input:checked + .radio-inline__label {
            /*background: #040F2E;*/
            background-image: linear-gradient(to left, #075385 0%, #0c476e 100%);
            color: #fff;
            text-shadow: 0 0 1px #0c476e;
        }
        .radio-inline__input {
            visibility: hidden;
        }
        .card-header {
            text-transform: uppercase;
        }
    </style>
@endpush

@section('content')

    <main>
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 side-bar-dashboard">
                        @include('front.customer.partials.sidebar')
                    </div>
                    <div class="col-md-9 main-dashboard">

                        <div class="card">
                            <h5 class="card-header">Personal Information</h5>
                            <div class="card-body">
                                @include('front.customer.edit_partials.personal')
                                <div class="row">
                                    <div class="col-12 text-end">
                                        <button onclick="savePersonalInfo(this)" type="button" class="button-theme-dark">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--<div class="card">
                            <h5 class="card-header">Qualification</h5>
                            <div class="card-body">
                                @include('front.customer.edit_partials.qualification')
                                <div class="row">
                                    <div class="col-12 text-end">
                                        <button onclick="saveEducation(this)" type="button" class="button-theme-dark">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>--}}

                        <div class="card">
                            <h5 class="card-header">Career Information</h5>
                            <div class="card-body">
                                @include('front.customer.edit_partials.career')
                                <div class="row">
                                    <div class="col-12 text-end">
                                        <button onclick="saveCareerInfo(this)" type="button" class="button-theme-dark">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <h5 class="card-header">Religion</h5>
                            <div class="card-body">
                                @include('front.customer.edit_partials.religion')
                                <div class="row">
                                    <div class="col-12 text-end">
                                        <button onclick="saveReligionInfo(this)" type="button" class="button-theme-dark">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <h5 class="card-header">Family Information</h5>
                            <div class="card-body">
                                @include('front.customer.edit_partials.family')
                                <div class="row">
                                    <div class="col-12 text-end">
                                        <button onclick="saveFamilyInfo(this)" type="button" class="button-theme-dark">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <h5 class="card-header">Residence Information</h5>
                            <div class="card-body">
                                @include('front.customer.edit_partials.residence')
                                <div class="row">
                                    <div class="col-12 text-end">
                                        <button onclick="saveResidenceInfo(this)" type="button" class="button-theme-dark">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <h5 class="card-header">Personal Note</h5>
                            <div class="card-body">
                                @include('front.customer.edit_partials.note')
                                <div class="row">
                                    <div class="col-12 text-end">
                                        <button onclick="savePersonalNote(this)" type="button" class="button-theme-dark">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <h5 class="card-header">Hobbies & Interest</h5>
                            <div class="card-body">
                                @include('front.customer.edit_partials.interest')
                                <div class="row">
                                    <div class="col-12 text-end">
                                        <button onclick="saveInterest(this)" type="button" class="button-theme-dark">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <h5 class="card-header">LIFE PARTNER EXPECTATIONS</h5>
                            <div class="card-body">
                                @include('front.customer.edit_partials.expectation')
                                <div class="row">
                                    <div class="col-12 text-end">
                                        <button onclick="saveExpectation(this)" type="button" class="button-theme-dark">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection

@push('script')
    <script>
        function savePersonalInfo(input) {
            $(input).attr('disabled',true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            axios.post("{{route('personal.save')}}", $('#personalInfoForm').serialize()).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                $(input).attr('disabled',false);
            }).catch(function (error) {
                $(input).attr('disabled',false);
                if (error.response.status==422) {
                    $.each(error.response.data.errors, function (k, v) {
                        $('#personalInfoForm :input[name="' + k + '"]').addClass("has-error");
                        $('#personalInfoForm :input[name="' + k + '"]').after("<span class='text-danger'>" + v[0] + "</span>");
                    });
                } else {
                    alertyFy('There is something wrong','warning',3000);
                }
            });
        }

        function saveEducation(input) {
            $(input).attr('disabled',true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            axios.post("{{route('education.save')}}", $('#educationInfoForm').serialize()).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                $(input).attr('disabled',false);
            }).catch(function (error) {
                $(input).attr('disabled',false);
                if (error.response.status==422) {
                    $.each(error.response.data.errors, function (k, v) {
                        $('#educationInfoForm :input[name="' + k + '"]').addClass("has-error");
                        $('#educationInfoForm :input[name="' + k + '"]').after("<span class='text-danger'>" + v[0] + "</span>");
                    });
                } else {
                    alertyFy('There is something wrong','warning',3000);
                }
            });
        }

        function saveCareerInfo(input) {
            $(input).attr('disabled',true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            axios.post("{{route('career.info.save')}}", $('#careerInfoForm').serialize()).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                $(input).attr('disabled',false);
            }).catch(function (error) {
                $(input).attr('disabled',false);
                if (error.response.status==422) {
                    $.each(error.response.data.errors, function (k, v) {
                        $('#careerInfoForm :input[name="' + k + '"]').addClass("has-error");
                        $('#careerInfoForm :input[name="' + k + '"]').after("<span class='text-danger'>" + v[0] + "</span>");
                    });
                } else {
                    alertyFy('There is something wrong','warning',3000);
                }
            });
        }

        function saveReligionInfo(input) {
            $(input).attr('disabled',true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            axios.post("{{route('religion.save')}}", $('#religionInfoForm').serialize()).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                $(input).attr('disabled',false);
            }).catch(function (error) {
                $(input).attr('disabled',false);
                if (error.response.status==422) {
                    $.each(error.response.data.errors, function (k, v) {
                        $('#religionInfoForm :input[name="' + k + '"]').addClass("has-error");
                        $('#religionInfoForm :input[name="' + k + '"]').after("<span class='text-danger'>" + v[0] + "</span>");
                    });
                } else {
                    alertyFy('There is something wrong','warning',3000);
                }
            });
        }

        function saveFamilyInfo(input) {
            $(input).attr('disabled',true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            axios.post("{{route('family.info.save')}}", $('#familyInfoForm').serialize()).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                $(input).attr('disabled',false);
            }).catch(function (error) {
                $(input).attr('disabled',false);
                if (error.response.status==422) {
                    $.each(error.response.data.errors, function (k, v) {
                        $('#familyInfoForm :input[name="' + k + '"]').addClass("has-error");
                        $('#familyInfoForm :input[name="' + k + '"]').after("<span class='text-danger'>" + v[0] + "</span>");
                    });
                } else {
                    alertyFy('There is something wrong','warning',3000);
                }
            });
        }

        function saveResidenceInfo(input) {
            $(input).attr('disabled',true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            axios.post("{{route('residense.info.save')}}", $('#residenseInfoForm').serialize()).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                $(input).attr('disabled',false);
            }).catch(function (error) {
                $(input).attr('disabled',false);
                if (error.response.status==422) {
                    $.each(error.response.data.errors, function (k, v) {
                        $('#residenseInfoForm :input[name="' + k + '"]').addClass("has-error");
                        $('#residenseInfoForm :input[name="' + k + '"]').after("<span class='text-danger'>" + v[0] + "</span>");
                    });
                } else {
                    alertyFy('There is something wrong','warning',3000);
                }
            });
        }

        function savePersonalNote(input) {
            $(input).attr('disabled',true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            axios.post("{{route('personal.note.save')}}", $('#personalNoteForm').serialize()).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                $(input).attr('disabled',false);
            }).catch(function (error) {
                $(input).attr('disabled',false);
                if (error.response.status==422) {
                    $.each(error.response.data.errors, function (k, v) {
                        $('#personalNoteForm :input[name="' + k + '"]').addClass("has-error");
                        $('#personalNoteForm :input[name="' + k + '"]').after("<span class='text-danger'>" + v[0] + "</span>");
                    });
                } else {
                    alertyFy('There is something wrong','warning',3000);
                }
            });
        }

        function saveInterest(input) {
            $(input).attr('disabled',true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            axios.post("{{route('hobbies.interests.save')}}", $('#interestForm').serialize()).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                $(input).attr('disabled',false);
            }).catch(function (error) {
                $(input).attr('disabled',false);
                if (error.response.status==422) {
                    $.each(error.response.data.errors, function (k, v) {
                        $('#interestForm :input[name="' + k + '"]').addClass("has-error");
                        $('#interestForm :input[name="' + k + '"]').after("<span class='text-danger'>" + v[0] + "</span>");
                    });
                } else {
                    alertyFy('There is something wrong','warning',3000);
                }
            });
        }

        function saveExpectation(input) {
            $(input).attr('disabled',true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            axios.post("{{route('expectation.save')}}", $('#expectationForm').serialize()).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                $(input).attr('disabled',false);
            }).catch(function (error) {
                $(input).attr('disabled',false);
                if (error.response.status==422) {
                    $.each(error.response.data.errors, function (k, v) {
                        $('#expectationForm :input[name="' + k + '"]').addClass("has-error");
                        $('#expectationForm :input[name="' + k + '"]').after("<span class='text-danger'>" + v[0] + "</span>");
                    });
                } else {
                    alertyFy('There is something wrong','warning',3000);
                }
            });
        }



    </script>
@endpush