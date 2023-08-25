@extends('layouts/layoutMaster')

@section('title', 'Credit Check - Page')

@section('content')
    <div class="row">
        <div class="col-12 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ trans('global.show') }} {{ trans('cruds.requestCredit.title') }}</h5>
                </div>

                <div class="card-body">
                    <table class="table table-responsive table-striped">
                        <tbody>
                        <tr>
                            <th class="w-25">
                                {{ trans('cruds.requestCredit.fields.dealer') }}
                            </th>
                            <td>
                                {{ $requestCredit->auto_planner->name ?? '' }}
                            </td>
                        </tr>

                        @foreach($requestCredit->request_debtors as $debtors)
                            <tr>
                                <th class="w-25">
                                    {{ \App\Models\RequestCreditDebtor::PERSONEL_TYPE_SELECT[$debtors->personel_type] }}
                                    {{ trans('cruds.requestCreditDebtor.fields.name') }}
                                </th>
                                <td>
                                    {{ $debtors->name }}
                                </td>
                            </tr>
                            <tr>
                                <th class="w-25">
                                    {{ \App\Models\RequestCreditDebtor::PERSONEL_TYPE_SELECT[$debtors->personel_type] }}
                                    {{ trans('cruds.requestCreditDebtor.fields.identity_type') }}
                                </th>
                                <td>
                                    {{ $debtors->identity_type }}
                                </td>
                            </tr>
                            <tr>
                                <th class="w-25">
                                    {{ \App\Models\RequestCreditDebtor::PERSONEL_TYPE_SELECT[$debtors->personel_type] }}
                                    {{ trans('cruds.requestCreditDebtor.fields.identity_type') }}
                                </th>
                                <td>
                                    {{ $debtors->identity_type }}
                                </td>
                            </tr>
                        @endforeach


                        @foreach($requestCredit->request_attributes as $attributes)
                            <tr>
                                <th class="w-25">
                                    {{ trans('cruds.requestCredit.fields.'.$attributes->object_name) }}
                                </th>
                                <td>
                                    {{ $attributes->attribute }}
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <th class="w-25">
                                {{ trans('cruds.requestCredit.fields.id_photos') }}
                            </th>
                            <td>
                                @foreach($requestCredit->id_photos as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl() }}" height="70px">
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th class="w-25">
                                {{ trans('cruds.requestCredit.fields.kk_photos') }}
                            </th>
                            <td>
                                @foreach($requestCredit->kk_photos as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl() }}" height="70px">
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th class="w-25">
                                {{ trans('cruds.requestCredit.fields.npwp_photos') }}
                            </th>
                            <td>
                                @foreach($requestCredit->npwp_photos as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl() }}" height="70px">
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th class="w-25">
                                {{ trans('cruds.requestCredit.fields.other_photos') }}
                            </th>
                            <td>
                                @foreach($requestCredit->other_photos as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl() }}" height="70px">
                                    </a>
                                @endforeach
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <a class="btn btn-primary" href="{{ route('admin.request-credits.index') }}">Back</a>
                </div>
            </div>
        </div>
    </div>

@endsection
