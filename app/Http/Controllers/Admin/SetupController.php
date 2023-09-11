<?php

namespace App\Http\Controllers\Admin;

use App\helpers\FakerURL;
use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Http\Requests\GeneralRequest;
use App\Models\AnnualInCome;
use App\Models\AreYouRevert;
use App\Models\Caste;
use App\Models\Complexion;
use App\Models\Country;
use App\Models\Disability;
use App\Models\DoYouHaveBeard;
use App\Models\DoYouKeepHalal;
use App\Models\DoYouPerformSalaah;
use App\Models\DoYouPreferHijab;
use App\Models\Drink;
use App\Models\Education;
use App\Models\EyeColor;
use App\Models\FamilyValue;
use App\Models\FuturePlan;
use App\Models\HairColor;
use App\Models\Height;
use App\Models\HobbiesAndInterest;
use App\Models\HouseSize;
use App\Models\IAmLookingToMarry;
use App\Models\JobPost;
use App\Models\MaritalStatus;
use App\Models\MotherTongue;
use App\Models\MyBuild;
use App\Models\MyLivingArrangement;
use App\Models\Occupation;
use App\Models\OnBehalf;
use App\Models\RegistrationsReason;
use App\Models\Religion;
use App\Models\ResidenceArea;
use App\Models\ResidenceStatus;
use App\Models\Sect;
use App\Models\Smoke;
use App\Models\State;
use App\Models\University;
use App\Models\Weight;
use App\Models\WhereDidYouHearAboutUs;
use App\Models\WillingToRelocate;
use Illuminate\Support\Str;

class SetupController extends Controller
{

    /*Countries*/
    public function getCountries()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = Country::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('name', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Countries';
        return view('admin.site_ups.countries',compact('title'));
    }

    public function countryDetail($countryId)
    {
        $country = Country::findOrFail(FakerURL::id_d($countryId));
        return response()->json([
            'status' => 'success',
            'data' => $country
        ]);
    }

    public function countrySave(CountryRequest $request,$countryId='')
    {
        $request = $request->all();
        if (!empty($countryId)) {
            $country = Country::findOrFail(FakerURL::id_d($countryId));
            $requestRes = $country->update($request);
        } else {
            $requestRes = Country::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function countryDelete($countryId='')
    {
        if ($countryId) {
            $country = Country::where('id',FakerURL::id_d($countryId))->first();
            if (!empty($country)) {
                $country->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*States*/
    public function getStates()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = State::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'States';
        return view('admin.site_ups.states',compact('title'));
    }

    public function stateDetail($stateId)
    {
        $state = State::findOrFail(FakerURL::id_d($stateId));
        return response()->json([
            'status' => 'success',
            'data' => $state
        ]);
    }

    public function stateSave(GeneralRequest $request,$stateId='')
    {
        $request = $request->all();
        if (!empty($stateId)) {
            $state = State::findOrFail(FakerURL::id_d($stateId));
            $requestRes = $state->update($request);
        } else {
            $requestRes = State::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function stateDelete($stateId='')
    {
        if ($stateId) {
            $state = State::where('id',FakerURL::id_d($stateId))->first();
            if (!empty($state)) {
                $state->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*Cities*/
    public function getCities()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = State::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Cities';
        return view('admin.site_ups.cities',compact('title'));
    }

    public function cityDetail($cityId)
    {
        $city = State::findOrFail(FakerURL::id_d($cityId));
        return response()->json([
            'status' => 'success',
            'data' => $city
        ]);
    }

    public function citySave(GeneralRequest $request,$cityId='')
    {
        $request = $request->all();
        if (!empty($cityId)) {
            $city = State::findOrFail(FakerURL::id_d($cityId));
            $requestRes = $city->update($request);
        } else {
            $requestRes = State::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function cityDelete($cityId='')
    {
        if ($cityId) {
            $city = State::where('id',FakerURL::id_d($cityId))->first();
            if (!empty($city)) {
                $city->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*Religions*/
    public function getReligions()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = Religion::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Religions';
        return view('admin.site_ups.religions',compact('title'));
    }

    public function religionDetail($religionId)
    {
        $religion = Religion::findOrFail(FakerURL::id_d($religionId));
        return response()->json([
            'status' => 'success',
            'data' => $religion
        ]);
    }

    public function religionSave(GeneralRequest $request,$religionId='')
    {
        $request = $request->all();
        if (!empty($religionId)) {
            $religion = Religion::findOrFail(FakerURL::id_d($religionId));
            $requestRes = $religion->update($request);
        } else {
            $requestRes = Religion::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function religionDelete($religionId='')
    {
        if ($religionId) {
            $religion = Religion::where('id',FakerURL::id_d($religionId))->first();
            if (!empty($religion)) {
                $religion->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*Sects*/
    public function getSects()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = Sect::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Sects';
        return view('admin.site_ups.sects',compact('title'));
    }

    public function sectDetail($sectId)
    {
        $sect = Sect::findOrFail(FakerURL::id_d($sectId));
        return response()->json([
            'status' => 'success',
            'data' => $sect
        ]);
    }

    public function sectSave(GeneralRequest $request,$sectId='')
    {
        $request = $request->all();
        if (!empty($sectId)) {
            $sect = Sect::findOrFail(FakerURL::id_d($sectId));
            $requestRes = $sect->update($request);
        } else {
            $requestRes = Sect::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function sectDelete($sectId='')
    {
        if ($sectId) {
            $sect = Sect::where('id',FakerURL::id_d($sectId))->first();
            if (!empty($sect)) {
                $sect->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*Castes*/
    public function getCastes()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = Caste::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Castes';
        return view('admin.site_ups.castes',compact('title'));
    }

    public function casteDetail($casteId)
    {
        $caste = Caste::findOrFail(FakerURL::id_d($casteId));
        return response()->json([
            'status' => 'success',
            'data' => $caste
        ]);
    }

    public function casteSave(GeneralRequest $request,$casteId='')
    {
        $request = $request->all();
        if (!empty($casteId)) {
            $caste = Caste::findOrFail(FakerURL::id_d($casteId));
            $requestRes = $caste->update($request);
        } else {
            $requestRes = Caste::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function casteDelete($casteId='')
    {
        if ($casteId) {
            $caste = Caste::where('id',FakerURL::id_d($casteId))->first();
            if (!empty($caste)) {
                $caste->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*MaritalStatuses*/
    public function getMaritalStatuses()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = MaritalStatus::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Marital Statuses';
        return view('admin.site_ups.marital_statuses',compact('title'));
    }

    public function maritalStatusDetail($maritalStatusId)
    {
        $maritalStatus = MaritalStatus::findOrFail(FakerURL::id_d($maritalStatusId));
        return response()->json([
            'status' => 'success',
            'data' => $maritalStatus
        ]);
    }

    public function maritalStatusSave(GeneralRequest $request,$maritalStatusId='')
    {
        $request = $request->all();
        if (!empty($maritalStatusId)) {
            $maritalStatus = MaritalStatus::findOrFail(FakerURL::id_d($maritalStatusId));
            $requestRes = $maritalStatus->update($request);
        } else {
            $requestRes = MaritalStatus::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function maritalStatusDelete($maritalStatusId='')
    {
        if ($maritalStatusId) {
            $maritalStatus = MaritalStatus::where('id',FakerURL::id_d($maritalStatusId))->first();
            if (!empty($maritalStatus)) {
                $maritalStatus->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*HobbiesInterests*/
    public function getHobbiesInterests()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = HobbiesAndInterest::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Hobbies & Interests';
        return view('admin.site_ups.hobbies_interests',compact('title'));
    }

    public function hobbiesInterestDetail($hobbiesInterestId)
    {
        $hobbiesInterest = HobbiesAndInterest::findOrFail(FakerURL::id_d($hobbiesInterestId));
        return response()->json([
            'status' => 'success',
            'data' => $hobbiesInterest
        ]);
    }

    public function hobbiesInterestSave(GeneralRequest $request,$hobbiesInterestId='')
    {
        $request = $request->all();
        $slug = Str::snake($request['title']);
        $slug = str_replace("/","_",$slug);
        $slug = str_replace("(","_",$slug);
        $slug = str_replace(")","_",$slug);
        $slug = str_replace("__","_",$slug);
        $request['slug'] = $slug;
        if (!empty($hobbiesInterestId)) {
            $hobbiesInterest = HobbiesAndInterest::findOrFail(FakerURL::id_d($hobbiesInterestId));
            $requestRes = $hobbiesInterest->update($request);
        } else {
            $requestRes = HobbiesAndInterest::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function hobbiesInterestDelete($hobbiesInterestId='')
    {
        if ($hobbiesInterestId) {
            $hobbiesInterest = HobbiesAndInterest::where('id',FakerURL::id_d($hobbiesInterestId))->first();
            if (!empty($hobbiesInterest)) {
                $hobbiesInterest->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*OnBehalfs*/
    public function getOnBehalfs()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = OnBehalf::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'OnBehalfs';
        return view('admin.site_ups.on_behalfs',compact('title'));
    }

    public function onBehalfDetail($onBehalfId)
    {
        $onBehalf = OnBehalf::findOrFail(FakerURL::id_d($onBehalfId));
        return response()->json([
            'status' => 'success',
            'data' => $onBehalf
        ]);
    }

    public function onBehalfSave(GeneralRequest $request,$onBehalfId='')
    {
        $request = $request->all();
        if (!empty($onBehalfId)) {
            $onBehalf = OnBehalf::findOrFail(FakerURL::id_d($onBehalfId));
            $requestRes = $onBehalf->update($request);
        } else {
            $requestRes = OnBehalf::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function onBehalfDelete($onBehalfId='')
    {
        if ($onBehalfId) {
            $onBehalf = OnBehalf::where('id',FakerURL::id_d($onBehalfId))->first();
            if (!empty($onBehalf)) {
                $onBehalf->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*MotherTongues*/
    public function getMotherTongues()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = MotherTongue::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Mother Tongues';
        return view('admin.site_ups.mother_tongues',compact('title'));
    }

    public function motherTongueDetail($motherTongueId)
    {
        $motherTongue = MotherTongue::findOrFail(FakerURL::id_d($motherTongueId));
        return response()->json([
            'status' => 'success',
            'data' => $motherTongue
        ]);
    }

    public function motherTongueSave(GeneralRequest $request,$motherTongueId='')
    {
        $request = $request->all();
        if (!empty($motherTongueId)) {
            $motherTongue = MotherTongue::findOrFail(FakerURL::id_d($motherTongueId));
            $requestRes = $motherTongue->update($request);
        } else {
            $requestRes = MotherTongue::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function motherTongueDelete($motherTongueId='')
    {
        if ($motherTongueId) {
            $motherTongue = MotherTongue::where('id',FakerURL::id_d($motherTongueId))->first();
            if (!empty($motherTongue)) {
                $motherTongue->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*FamilyValues*/
    public function getFamilyValues()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = FamilyValue::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Family Values';
        return view('admin.site_ups.family_values',compact('title'));
    }

    public function familyValueDetail($familyValueId)
    {
        $familyValue = FamilyValue::findOrFail(FakerURL::id_d($familyValueId));
        return response()->json([
            'status' => 'success',
            'data' => $familyValue
        ]);
    }

    public function familyValueSave(GeneralRequest $request,$familyValueId='')
    {
        $request = $request->all();
        if (!empty($familyValueId)) {
            $familyValue = FamilyValue::findOrFail(FakerURL::id_d($familyValueId));
            $requestRes = $familyValue->update($request);
        } else {
            $requestRes = FamilyValue::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function familyValueDelete($familyValueId='')
    {
        if ($familyValueId) {
            $familyValue = FamilyValue::where('id',FakerURL::id_d($familyValueId))->first();
            if (!empty($familyValue)) {
                $familyValue->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*Educations*/
    public function getEducations()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = Education::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Educations';
        return view('admin.site_ups.educations',compact('title'));
    }

    public function educationDetail($educationId)
    {
        $education = Education::findOrFail(FakerURL::id_d($educationId));
        return response()->json([
            'status' => 'success',
            'data' => $education
        ]);
    }

    public function educationSave(GeneralRequest $request,$educationId='')
    {
        $request = $request->all();
        if (!empty($educationId)) {
            $education = Education::findOrFail(FakerURL::id_d($educationId));
            $requestRes = $education->update($request);
        } else {
            $requestRes = Education::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function educationDelete($educationId='')
    {
        if ($educationId) {
            $education = Education::where('id',FakerURL::id_d($educationId))->first();
            if (!empty($education)) {
                $education->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*Occupations*/
    public function getOccupations()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = Occupation::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Occupations';
        return view('admin.site_ups.occupations',compact('title'));
    }

    public function occupationDetail($occupationId)
    {
        $occupation = Occupation::findOrFail(FakerURL::id_d($occupationId));
        return response()->json([
            'status' => 'success',
            'data' => $occupation
        ]);
    }

    public function occupationSave(GeneralRequest $request,$occupationId='')
    {
        $request = $request->all();
        if (!empty($occupationId)) {
            $occupation = Occupation::findOrFail(FakerURL::id_d($occupationId));
            $requestRes = $occupation->update($request);
        } else {
            $requestRes = Occupation::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function occupationDelete($occupationId='')
    {
        if ($occupationId) {
            $occupation = Occupation::where('id',FakerURL::id_d($occupationId))->first();
            if (!empty($occupation)) {
                $occupation->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*MonthlyInComes*/
    public function getMonthlyInComes()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = AnnualInCome::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Monthly Incomes';
        return view('admin.site_ups.monthly_incomes',compact('title'));
    }

    public function monthlyInComeDetail($monthlyInComeId)
    {
        $monthlyInCome = AnnualInCome::findOrFail(FakerURL::id_d($monthlyInComeId));
        return response()->json([
            'status' => 'success',
            'data' => $monthlyInCome
        ]);
    }

    public function monthlyInComeSave(GeneralRequest $request,$monthlyInComeId='')
    {
        $request = $request->all();
        if (!empty($monthlyInComeId)) {
            $monthlyInCome = AnnualInCome::findOrFail(FakerURL::id_d($monthlyInComeId));
            $requestRes = $monthlyInCome->update($request);
        } else {
            $requestRes = AnnualInCome::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function monthlyInComeDelete($monthlyInComeId='')
    {
        if ($monthlyInComeId) {
            $monthlyInCome = AnnualInCome::where('id',FakerURL::id_d($monthlyInComeId))->first();
            if (!empty($monthlyInCome)) {
                $monthlyInCome->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*Complexions*/
    public function getComplexions()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = Complexion::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Complexions';
        return view('admin.site_ups.complexions',compact('title'));
    }

    public function complexionDetail($complexionId)
    {
        $complexion = Complexion::findOrFail(FakerURL::id_d($complexionId));
        return response()->json([
            'status' => 'success',
            'data' => $complexion
        ]);
    }

    public function complexionSave(GeneralRequest $request,$complexionId='')
    {
        $request = $request->all();
        if (!empty($complexionId)) {
            $complexion = Complexion::findOrFail(FakerURL::id_d($complexionId));
            $requestRes = $complexion->update($request);
        } else {
            $requestRes = Complexion::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function complexionDelete($complexionId='')
    {
        if ($complexionId) {
            $complexion = Complexion::where('id',FakerURL::id_d($complexionId))->first();
            if (!empty($complexion)) {
                $complexion->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*Disabilities*/
    public function getDisabilities()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = Disability::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Disabilities';
        return view('admin.site_ups.disabilities',compact('title'));
    }

    public function disabilityDetail($disabilityId)
    {
        $disability = Disability::findOrFail(FakerURL::id_d($disabilityId));
        return response()->json([
            'status' => 'success',
            'data' => $disability
        ]);
    }

    public function disabilitySave(GeneralRequest $request,$disabilityId='')
    {
        $request = $request->all();
        if (!empty($disabilityId)) {
            $disability = Disability::findOrFail(FakerURL::id_d($disabilityId));
            $requestRes = $disability->update($request);
        } else {
            $requestRes = Disability::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function disabilityDelete($disabilityId='')
    {
        if ($disabilityId) {
            $disability = Disability::where('id',FakerURL::id_d($disabilityId))->first();
            if (!empty($disability)) {
                $disability->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*WhereDidYouHearAbouts*/
    public function getWhereDidYouHearAbouts()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = WhereDidYouHearAboutUs::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Where did you hear about us?';
        return view('admin.site_ups.where_did_you_hear_abouts',compact('title'));
    }

    public function whereDidYouHearAboutDetail($whereDidYouHearAboutId)
    {
        $whereDidYouHearAbout = WhereDidYouHearAboutUs::findOrFail(FakerURL::id_d($whereDidYouHearAboutId));
        return response()->json([
            'status' => 'success',
            'data' => $whereDidYouHearAbout
        ]);
    }

    public function whereDidYouHearAboutSave(GeneralRequest $request,$whereDidYouHearAboutId='')
    {
        $request = $request->all();
        if (!empty($whereDidYouHearAboutId)) {
            $whereDidYouHearAbout = WhereDidYouHearAboutUs::findOrFail(FakerURL::id_d($whereDidYouHearAboutId));
            $requestRes = $whereDidYouHearAbout->update($request);
        } else {
            $requestRes = WhereDidYouHearAboutUs::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function whereDidYouHearAboutDelete($whereDidYouHearAboutId='')
    {
        if ($whereDidYouHearAboutId) {
            $whereDidYouHearAbout = WhereDidYouHearAboutUs::where('id',FakerURL::id_d($whereDidYouHearAboutId))->first();
            if (!empty($whereDidYouHearAbout)) {
                $whereDidYouHearAbout->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*RegistrationsReasons*/
    public function getRegistrationsReasons()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = RegistrationsReason::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Registrations Reasons';
        return view('admin.site_ups.registrations_reasons',compact('title'));
    }

    public function registrationsReasonDetail($registrationsReasonId)
    {
        $registrationsReason = RegistrationsReason::findOrFail(FakerURL::id_d($registrationsReasonId));
        return response()->json([
            'status' => 'success',
            'data' => $registrationsReason
        ]);
    }

    public function registrationsReasonSave(GeneralRequest $request,$registrationsReasonId='')
    {
        $request = $request->all();
        if (!empty($registrationsReasonId)) {
            $registrationsReason = RegistrationsReason::findOrFail(FakerURL::id_d($registrationsReasonId));
            $requestRes = $registrationsReason->update($request);
        } else {
            $requestRes = RegistrationsReason::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function registrationsReasonDelete($registrationsReasonId='')
    {
        if ($registrationsReasonId) {
            $registrationsReason = RegistrationsReason::where('id',FakerURL::id_d($registrationsReasonId))->first();
            if (!empty($registrationsReason)) {
                $registrationsReason->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*Heights*/
    public function getHeights()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = Height::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Heights';
        return view('admin.site_ups.heights',compact('title'));
    }

    public function heightDetail($heightId)
    {
        $height = Height::findOrFail(FakerURL::id_d($heightId));
        return response()->json([
            'status' => 'success',
            'data' => $height
        ]);
    }

    public function heightSave(GeneralRequest $request,$heightId='')
    {
        $request = $request->all();
        if (!empty($heightId)) {
            $height = Height::findOrFail(FakerURL::id_d($heightId));
            $requestRes = $height->update($request);
        } else {
            $requestRes = Height::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function heightDelete($heightId='')
    {
        if ($heightId) {
            $height = Height::where('id',FakerURL::id_d($heightId))->first();
            if (!empty($height)) {
                $height->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*Weights*/
    public function getWeights()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = Weight::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Weights';
        return view('admin.site_ups.weights',compact('title'));
    }

    public function weightDetail($weightId)
    {
        $weight = Weight::findOrFail(FakerURL::id_d($weightId));
        return response()->json([
            'status' => 'success',
            'data' => $weight
        ]);
    }

    public function weightSave(GeneralRequest $request,$weightId='')
    {
        $request = $request->all();
        if (!empty($weightId)) {
            $weight = Weight::findOrFail(FakerURL::id_d($weightId));
            $requestRes = $weight->update($request);
        } else {
            $requestRes = Weight::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function weightDelete($weightId='')
    {
        if ($weightId) {
            $weight = Weight::where('id',FakerURL::id_d($weightId))->first();
            if (!empty($weight)) {
                $weight->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*Universities*/
    public function getUniversities()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = University::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Universities';
        return view('admin.site_ups.universities',compact('title'));
    }

    public function universityDetail($universityId)
    {
        $university = University::findOrFail(FakerURL::id_d($universityId));
        return response()->json([
            'status' => 'success',
            'data' => $university
        ]);
    }

    public function universitySave(GeneralRequest $request,$universityId='')
    {
        $request = $request->all();
        if (!empty($universityId)) {
            $university = University::findOrFail(FakerURL::id_d($universityId));
            $requestRes = $university->update($request);
        } else {
            $requestRes = University::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function universityDelete($universityId='')
    {
        if ($universityId) {
            $university = University::where('id',FakerURL::id_d($universityId))->first();
            if (!empty($university)) {
                $university->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*ResidenceStatuses*/
    public function getResidenceStatuses()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = ResidenceStatus::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Residence Statuses';
        return view('admin.site_ups.residence_statuses',compact('title'));
    }

    public function residenceStatusDetail($residenceStatusId)
    {
        $residenceStatus = ResidenceStatus::findOrFail(FakerURL::id_d($residenceStatusId));
        return response()->json([
            'status' => 'success',
            'data' => $residenceStatus
        ]);
    }

    public function residenceStatusSave(GeneralRequest $request,$residenceStatusId='')
    {
        $request = $request->all();
        if (!empty($residenceStatusId)) {
            $residenceStatus = ResidenceStatus::findOrFail(FakerURL::id_d($residenceStatusId));
            $requestRes = $residenceStatus->update($request);
        } else {
            $requestRes = ResidenceStatus::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function residenceStatusDelete($residenceStatusId='')
    {
        if ($residenceStatusId) {
            $residenceStatus = ResidenceStatus::where('id',FakerURL::id_d($residenceStatusId))->first();
            if (!empty($residenceStatus)) {
                $residenceStatus->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*HouseSizes*/
    public function getHouseSizes()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = HouseSize::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'House Sizes';
        return view('admin.site_ups.house_sizes',compact('title'));
    }

    public function houseSizeDetail($houseSizeId)
    {
        $houseSize = HouseSize::findOrFail(FakerURL::id_d($houseSizeId));
        return response()->json([
            'status' => 'success',
            'data' => $houseSize
        ]);
    }

    public function houseSizeSave(GeneralRequest $request,$houseSizeId='')
    {
        $request = $request->all();
        if (!empty($houseSizeId)) {
            $houseSize = HouseSize::findOrFail(FakerURL::id_d($houseSizeId));
            $requestRes = $houseSize->update($request);
        } else {
            $requestRes = HouseSize::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function houseSizeDelete($houseSizeId='')
    {
        if ($houseSizeId) {
            $houseSize = HouseSize::where('id',FakerURL::id_d($houseSizeId))->first();
            if (!empty($houseSize)) {
                $houseSize->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*ResidenceAreas*/
    public function getResidenceAreas()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = ResidenceArea::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Residence Areas';
        return view('admin.site_ups.residence_areas',compact('title'));
    }

    public function residenceAreaDetail($residenceAreaId)
    {
        $residenceArea = ResidenceArea::findOrFail(FakerURL::id_d($residenceAreaId));
        return response()->json([
            'status' => 'success',
            'data' => $residenceArea
        ]);
    }

    public function residenceAreaSave(GeneralRequest $request,$residenceAreaId='')
    {
        $request = $request->all();
        if (!empty($residenceAreaId)) {
            $residenceArea = ResidenceArea::findOrFail(FakerURL::id_d($residenceAreaId));
            $requestRes = $residenceArea->update($request);
        } else {
            $requestRes = ResidenceArea::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function residenceAreaDelete($residenceAreaId='')
    {
        if ($residenceAreaId) {
            $residenceArea = ResidenceArea::where('id',FakerURL::id_d($residenceAreaId))->first();
            if (!empty($residenceArea)) {
                $residenceArea->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*JobPosts*/
    public function getJobPosts()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = JobPost::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Job Posts';
        return view('admin.site_ups.job_posts',compact('title'));
    }

    public function jobPostDetail($jobPostId)
    {
        $jobPost = JobPost::findOrFail(FakerURL::id_d($jobPostId));
        return response()->json([
            'status' => 'success',
            'data' => $jobPost
        ]);
    }

    public function jobPostSave(GeneralRequest $request,$jobPostId='')
    {
        $request = $request->all();
        if (!empty($jobPostId)) {
            $jobPost = JobPost::findOrFail(FakerURL::id_d($jobPostId));
            $requestRes = $jobPost->update($request);
        } else {
            $requestRes = JobPost::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function jobPostDelete($jobPostId='')
    {
        if ($jobPostId) {
            $jobPost = JobPost::where('id',FakerURL::id_d($jobPostId))->first();
            if (!empty($jobPost)) {
                $jobPost->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*FuturePlans*/
    public function getFuturePlans()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = FuturePlan::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Future Plans';
        return view('admin.site_ups.future_plans',compact('title'));
    }

    public function futurePlanDetail($futurePlanId)
    {
        $futurePlan = FuturePlan::findOrFail(FakerURL::id_d($futurePlanId));
        return response()->json([
            'status' => 'success',
            'data' => $futurePlan
        ]);
    }

    public function futurePlanSave(GeneralRequest $request,$futurePlanId='')
    {
        $request = $request->all();
        if (!empty($futurePlanId)) {
            $futurePlan = FuturePlan::findOrFail(FakerURL::id_d($futurePlanId));
            $requestRes = $futurePlan->update($request);
        } else {
            $requestRes = FuturePlan::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function futurePlanDelete($futurePlanId='')
    {
        if ($futurePlanId) {
            $futurePlan = FuturePlan::where('id',FakerURL::id_d($futurePlanId))->first();
            if (!empty($futurePlan)) {
                $futurePlan->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*EyeColors*/
    public function getEyeColors()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = EyeColor::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Eye Colors';
        return view('admin.site_ups.eye_colors',compact('title'));
    }

    public function eyeColorDetail($eyeColorId)
    {
        $eyeColor = EyeColor::findOrFail(FakerURL::id_d($eyeColorId));
        return response()->json([
            'status' => 'success',
            'data' => $eyeColor
        ]);
    }

    public function eyeColorSave(GeneralRequest $request,$eyeColorId='')
    {
        $request = $request->all();
        if (!empty($eyeColorId)) {
            $eyeColor = EyeColor::findOrFail(FakerURL::id_d($eyeColorId));
            $requestRes = $eyeColor->update($request);
        } else {
            $requestRes = EyeColor::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function eyeColorDelete($eyeColorId='')
    {
        if ($eyeColorId) {
            $eyeColor = EyeColor::where('id',FakerURL::id_d($eyeColorId))->first();
            if (!empty($eyeColor)) {
                $eyeColor->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*HairColors*/
    public function getHairColors()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = HairColor::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Hair Colors';
        return view('admin.site_ups.hair_colors',compact('title'));
    }

    public function hairColorDetail($hairColorId)
    {
        $hairColor = HairColor::findOrFail(FakerURL::id_d($hairColorId));
        return response()->json([
            'status' => 'success',
            'data' => $hairColor
        ]);
    }

    public function hairColorSave(GeneralRequest $request,$hairColorId='')
    {
        $request = $request->all();
        if (!empty($hairColorId)) {
            $hairColor = HairColor::findOrFail(FakerURL::id_d($hairColorId));
            $requestRes = $hairColor->update($request);
        } else {
            $requestRes = HairColor::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function hairColorDelete($hairColorId='')
    {
        if ($hairColorId) {
            $hairColor = HairColor::where('id',FakerURL::id_d($hairColorId))->first();
            if (!empty($hairColor)) {
                $hairColor->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*Smokes*/
    public function getSmokes()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = Smoke::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Smokes';
        return view('admin.site_ups.smokes',compact('title'));
    }

    public function smokeDetail($smokeId)
    {
        $smoke = Smoke::findOrFail(FakerURL::id_d($smokeId));
        return response()->json([
            'status' => 'success',
            'data' => $smoke
        ]);
    }

    public function smokeSave(GeneralRequest $request,$smokeId='')
    {
        $request = $request->all();
        if (!empty($smokeId)) {
            $smoke = Smoke::findOrFail(FakerURL::id_d($smokeId));
            $requestRes = $smoke->update($request);
        } else {
            $requestRes = Smoke::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function smokeDelete($smokeId='')
    {
        if ($smokeId) {
            $smoke = Smoke::where('id',FakerURL::id_d($smokeId))->first();
            if (!empty($smoke)) {
                $smoke->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*Drinks*/
    public function getDrinks()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = Drink::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Drinks';
        return view('admin.site_ups.drinks',compact('title'));
    }

    public function drinkDetail($drinkId)
    {
        $drink = Drink::findOrFail(FakerURL::id_d($drinkId));
        return response()->json([
            'status' => 'success',
            'data' => $drink
        ]);
    }

    public function drinkSave(GeneralRequest $request,$drinkId='')
    {
        $request = $request->all();
        if (!empty($drinkId)) {
            $drink = Drink::findOrFail(FakerURL::id_d($drinkId));
            $requestRes = $drink->update($request);
        } else {
            $requestRes = Drink::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function drinkDelete($drinkId='')
    {
        if ($drinkId) {
            $drink = Drink::where('id',FakerURL::id_d($drinkId))->first();
            if (!empty($drink)) {
                $drink->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*DoYouPreferHijabs*/
    public function getDoYouPreferHijabs()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = DoYouPreferHijab::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Do you prefer hijabs?';
        return view('admin.site_ups.do_you_prefer_hijabs',compact('title'));
    }

    public function doYouPreferHijabDetail($doYouPreferHijabId)
    {
        $doYouPreferHijab = DoYouPreferHijab::findOrFail(FakerURL::id_d($doYouPreferHijabId));
        return response()->json([
            'status' => 'success',
            'data' => $doYouPreferHijab
        ]);
    }

    public function doYouPreferHijabSave(GeneralRequest $request,$doYouPreferHijabId='')
    {
        $request = $request->all();
        if (!empty($doYouPreferHijabId)) {
            $doYouPreferHijab = DoYouPreferHijab::findOrFail(FakerURL::id_d($doYouPreferHijabId));
            $requestRes = $doYouPreferHijab->update($request);
        } else {
            $requestRes = DoYouPreferHijab::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function doYouPreferHijabDelete($doYouPreferHijabId='')
    {
        if ($doYouPreferHijabId) {
            $doYouPreferHijab = DoYouPreferHijab::where('id',FakerURL::id_d($doYouPreferHijabId))->first();
            if (!empty($doYouPreferHijab)) {
                $doYouPreferHijab->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*DoYouHaveBeards*/
    public function getDoYouHaveBeards()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = DoYouHaveBeard::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Do you have beards?';
        return view('admin.site_ups.do_you_have_beards',compact('title'));
    }

    public function doYouHaveBeardDetail($doYouHaveBeardId)
    {
        $doYouHaveBeard = DoYouHaveBeard::findOrFail(FakerURL::id_d($doYouHaveBeardId));
        return response()->json([
            'status' => 'success',
            'data' => $doYouHaveBeard
        ]);
    }

    public function doYouHaveBeardSave(GeneralRequest $request,$doYouHaveBeardId='')
    {
        $request = $request->all();
        if (!empty($doYouHaveBeardId)) {
            $doYouHaveBeard = DoYouHaveBeard::findOrFail(FakerURL::id_d($doYouHaveBeardId));
            $requestRes = $doYouHaveBeard->update($request);
        } else {
            $requestRes = DoYouHaveBeard::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function doYouHaveBeardDelete($doYouHaveBeardId='')
    {
        if ($doYouHaveBeardId) {
            $doYouHaveBeard = DoYouHaveBeard::where('id',FakerURL::id_d($doYouHaveBeardId))->first();
            if (!empty($doYouHaveBeard)) {
                $doYouHaveBeard->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*AreYouReverts*/
    public function getAreYouReverts()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = AreYouRevert::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Are you reverts?';
        return view('admin.site_ups.are_you_reverts',compact('title'));
    }

    public function areYouRevertDetail($areYouRevertId)
    {
        $areYouRevert = AreYouRevert::findOrFail(FakerURL::id_d($areYouRevertId));
        return response()->json([
            'status' => 'success',
            'data' => $areYouRevert
        ]);
    }

    public function areYouRevertSave(GeneralRequest $request,$areYouRevertId='')
    {
        $request = $request->all();
        if (!empty($areYouRevertId)) {
            $areYouRevert = AreYouRevert::findOrFail(FakerURL::id_d($areYouRevertId));
            $requestRes = $areYouRevert->update($request);
        } else {
            $requestRes = AreYouRevert::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function areYouRevertDelete($areYouRevertId='')
    {
        if ($areYouRevertId) {
            $areYouRevert = AreYouRevert::where('id',FakerURL::id_d($areYouRevertId))->first();
            if (!empty($areYouRevert)) {
                $areYouRevert->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*DoYouKeepHalals*/
    public function getDoYouKeepHalals()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = DoYouKeepHalal::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Do you keep halals?';
        return view('admin.site_ups.do_you_keep_halals',compact('title'));
    }

    public function doYouKeepHalalDetail($doYouKeepHalalId)
    {
        $doYouKeepHalal = DoYouKeepHalal::findOrFail(FakerURL::id_d($doYouKeepHalalId));
        return response()->json([
            'status' => 'success',
            'data' => $doYouKeepHalal
        ]);
    }

    public function doYouKeepHalalSave(GeneralRequest $request,$doYouKeepHalalId='')
    {
        $request = $request->all();
        if (!empty($doYouKeepHalalId)) {
            $doYouKeepHalal = DoYouKeepHalal::findOrFail(FakerURL::id_d($doYouKeepHalalId));
            $requestRes = $doYouKeepHalal->update($request);
        } else {
            $requestRes = DoYouKeepHalal::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function doYouKeepHalalDelete($doYouKeepHalalId='')
    {
        if ($doYouKeepHalalId) {
            $doYouKeepHalal = DoYouKeepHalal::where('id',FakerURL::id_d($doYouKeepHalalId))->first();
            if (!empty($doYouKeepHalal)) {
                $doYouKeepHalal->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*DoYouPerformSalaahs*/
    public function getDoYouPerformSalaahs()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = DoYouPerformSalaah::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Do you perform salaahs?';
        return view('admin.site_ups.do_you_perform_salaahs',compact('title'));
    }

    public function doYouPerformSalaahDetail($doYouPerformSalaahId)
    {
        $doYouPerformSalaah = DoYouPerformSalaah::findOrFail(FakerURL::id_d($doYouPerformSalaahId));
        return response()->json([
            'status' => 'success',
            'data' => $doYouPerformSalaah
        ]);
    }

    public function doYouPerformSalaahSave(GeneralRequest $request,$doYouPerformSalaahId='')
    {
        $request = $request->all();
        if (!empty($doYouPerformSalaahId)) {
            $doYouPerformSalaah = DoYouPerformSalaah::findOrFail(FakerURL::id_d($doYouPerformSalaahId));
            $requestRes = $doYouPerformSalaah->update($request);
        } else {
            $requestRes = DoYouPerformSalaah::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function doYouPerformSalaahDelete($doYouPerformSalaahId='')
    {
        if ($doYouPerformSalaahId) {
            $doYouPerformSalaah = DoYouPerformSalaah::where('id',FakerURL::id_d($doYouPerformSalaahId))->first();
            if (!empty($doYouPerformSalaah)) {
                $doYouPerformSalaah->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*WillingToRelocates*/
    public function getWillingToRelocates()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = WillingToRelocate::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Willing to Relocates';
        return view('admin.site_ups.willing_to_relocates',compact('title'));
    }

    public function willingToRelocateDetail($willingToRelocateId)
    {
        $willingToRelocate = WillingToRelocate::findOrFail(FakerURL::id_d($willingToRelocateId));
        return response()->json([
            'status' => 'success',
            'data' => $willingToRelocate
        ]);
    }

    public function willingToRelocateSave(GeneralRequest $request,$willingToRelocateId='')
    {
        $request = $request->all();
        if (!empty($willingToRelocateId)) {
            $willingToRelocate = WillingToRelocate::findOrFail(FakerURL::id_d($willingToRelocateId));
            $requestRes = $willingToRelocate->update($request);
        } else {
            $requestRes = WillingToRelocate::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function willingToRelocateDelete($willingToRelocateId='')
    {
        if ($willingToRelocateId) {
            $willingToRelocate = WillingToRelocate::where('id',FakerURL::id_d($willingToRelocateId))->first();
            if (!empty($willingToRelocate)) {
                $willingToRelocate->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*IAmLookingToMarries*/
    public function getIAmLookingToMarries()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = IAmLookingToMarry::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'I am looking to marry';
        return view('admin.site_ups.i_am_looking_to_marries',compact('title'));
    }

    public function iAmLookingToMarryDetail($iAmLookingToMarryId)
    {
        $iAmLookingToMarry = IAmLookingToMarry::findOrFail(FakerURL::id_d($iAmLookingToMarryId));
        return response()->json([
            'status' => 'success',
            'data' => $iAmLookingToMarry
        ]);
    }

    public function iAmLookingToMarrySave(GeneralRequest $request,$iAmLookingToMarryId='')
    {
        $request = $request->all();
        if (!empty($iAmLookingToMarryId)) {
            $iAmLookingToMarry = IAmLookingToMarry::findOrFail(FakerURL::id_d($iAmLookingToMarryId));
            $requestRes = $iAmLookingToMarry->update($request);
        } else {
            $requestRes = IAmLookingToMarry::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function iAmLookingToMarryDelete($iAmLookingToMarryId='')
    {
        if ($iAmLookingToMarryId) {
            $iAmLookingToMarry = IAmLookingToMarry::where('id',FakerURL::id_d($iAmLookingToMarryId))->first();
            if (!empty($iAmLookingToMarry)) {
                $iAmLookingToMarry->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*MyLivingArrangements*/
    public function getMyLivingArrangements()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = MyLivingArrangement::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'My Living Arrangements';
        return view('admin.site_ups.my_living_arrangements',compact('title'));
    }

    public function myLivingArrangementDetail($myLivingArrangementId)
    {
        $myLivingArrangement = MyLivingArrangement::findOrFail(FakerURL::id_d($myLivingArrangementId));
        return response()->json([
            'status' => 'success',
            'data' => $myLivingArrangement
        ]);
    }

    public function myLivingArrangementSave(GeneralRequest $request,$myLivingArrangementId='')
    {
        $request = $request->all();
        if (!empty($myLivingArrangementId)) {
            $myLivingArrangement = MyLivingArrangement::findOrFail(FakerURL::id_d($myLivingArrangementId));
            $requestRes = $myLivingArrangement->update($request);
        } else {
            $requestRes = MyLivingArrangement::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function myLivingArrangementDelete($myLivingArrangementId='')
    {
        if ($myLivingArrangementId) {
            $myLivingArrangement = MyLivingArrangement::where('id',FakerURL::id_d($myLivingArrangementId))->first();
            if (!empty($myLivingArrangement)) {
                $myLivingArrangement->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

    /*MyBuilds*/
    public function getMyBuilds()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = MyBuild::where(['deleted'=>0]);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('title', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'My Builds';
        return view('admin.site_ups.my_builds',compact('title'));
    }

    public function myBuildDetail($myBuildId)
    {
        $myBuild = MyBuild::findOrFail(FakerURL::id_d($myBuildId));
        return response()->json([
            'status' => 'success',
            'data' => $myBuild
        ]);
    }

    public function myBuildSave(GeneralRequest $request,$myBuildId='')
    {
        $request = $request->all();
        if (!empty($myBuildId)) {
            $myBuild = MyBuild::findOrFail(FakerURL::id_d($myBuildId));
            $requestRes = $myBuild->update($request);
        } else {
            $requestRes = MyBuild::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Record has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Record has not been saved.'
            ]);
        }
    }

    public function myBuildDelete($myBuildId='')
    {
        if ($myBuildId) {
            $myBuild = MyBuild::where('id',FakerURL::id_d($myBuildId))->first();
            if (!empty($myBuild)) {
                $myBuild->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Record has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Record has not been deleted.'
        ]);
    }

}
