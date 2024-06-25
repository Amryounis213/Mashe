@extends('layouts.admin.app')

@section('title', translate('messages.Update_Country'))

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h2 class="page-header-title text-capitalize">
                        <div class="card-header-icon d-inline-flex mr-2 img">
                            <img src="{{ dynamicAsset('public/assets/admin/img/sub-country.png') }}" alt="">
                        </div>
                        <span>
                            {{ $country->position ? translate('messages.sub') . ' ' : '' }}{{ translate('messages.Country_Update') }}
                        </span>
                    </h2>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.country.update', [$country['id']]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @php($language = \App\Models\BusinessSetting::where('key', 'language')->first())
                    @php($language = $language->value ?? null)
                    @php($default_lang = str_replace('_', '-', app()->getLocale()))

                    <div class="row">
                        <div class="col-lg-12">
                            @if ($language)
                                <ul class="nav nav-tabs mb-4">
                                    <li class="nav-item">
                                        <a class="nav-link lang_link active" href="#"
                                            id="default-link">{{ translate('Default') }}</a>
                                    </li>
                                    @foreach (json_decode($language) as $lang)
                                        <li class="nav-item">
                                            <a class="nav-link lang_link" href="#"
                                                id="{{ $lang }}-link">{{ \App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')' }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="form-group lang_form" id="default-form">
                                    <label class="input-label"
                                        for="exampleFormControlInput1">{{ translate('messages.name') }}</label>
                                    <input type="text" name="name[]" class="form-control"
                                        placeholder="{{ translate('Ex:_Country_Name') }}"
                                        value="{{ $country?->getRawOriginal('name') }}" maxlength="191">
                                    <input type="hidden" name="lang[]" value="default">
                                </div>
                                @foreach (json_decode($language) as $lang)
                                    <?php
                                    if (count($country['translations'])) {
                                        $translate = [];
                                        foreach ($country['translations'] as $t) {
                                            if ($t->locale == $lang && $t->key == 'name') {
                                                $translate[$lang]['name'] = $t->value;
                                            }
                                        }
                                    }
                                    ?>
                                    <div class="form-group d-none lang_form" id="{{ $lang }}-form">
                                        <label class="input-label"
                                            for="exampleFormControlInput1">{{ translate('messages.name') }}
                                            ({{ strtoupper($lang) }})</label>
                                        <input id="name" type="text" name="name[]" class="form-control"
                                            placeholder="{{ translate('messages.new_country') }}" maxlength="191"
                                            value="{{ $translate[$lang]['name'] ?? null }}">
                                    </div>
                                    <input type="hidden" name="lang[]" value="{{ $lang }}">
                                @endforeach
                            @else
                                <div class="form-group lang_form" id="default-form">
                                    <label class="input-label"
                                        for="exampleFormControlInput1">{{ translate('messages.name') }}</label>
                                    <input type="text" name="name[]" class="form-control"
                                        placeholder="{{ translate('Ex:_country_Name') }}" value="{{ $country['name'] }}"
                                        maxlength="191">
                                    <input type="hidden" name="lang[]" value="default">
                                </div>
                            @endif
                        </div>

                        <div class="btn--container justify-content-end">
                            <button id="reset_btn" type="button"
                                class="btn btn--reset">{{ translate('messages.reset') }}</button>
                            <button type="submit" class="btn btn--primary">{{ translate('messages.update') }}</button>
                        </div>
                </form>
            </div>
            <!-- End Table -->
        </div>
    </div>

@endsection

@push('script_2')
    <script src="{{ dynamicAsset('public/assets/admin') }}/js/view-pages/country-index.js"></script>
    <script>
        "use strict";
        $('#reset_btn').click(function() {
            {{-- $('input[name="name[]"]').val("{{$lang==$default_lang?$country['name']:($translate[$lang]['name']??'')}}"); --}}
            {{-- $('#viewer').attr('src', "{{dynamicStorage('storage/app/public/country')}}/{{$country['image']}}"); --}}
            {{-- $('#customFileEg1').val(null); --}}
            location.reload();
        })

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function() {
            readURL(this);
        });
    </script>
@endpush
