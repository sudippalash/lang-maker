@extends(config('lang-maker.layout_name'))

<style>
.lang-maker .nav-pills-tab {
    border-right: 1px solid #f5f5f5;
}
.lang-maker .nav-pills .lang-maker-link {
    color: #000000;
    display: block;
    padding: 0.5rem 1rem;
    border-bottom: 1px solid #e5e2e2;
    text-decoration: none;
}
.lang-maker .nav-pills .lang-maker-link.active {
    color: #ffffff;
    background-color: #8898aa;
}
</style>

@section(config('lang-maker.section_name'))
<section class="lang-maker {{ $cssClass['container'] }}">
    <div class="{{ $cssClass['card'] }}">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h4 class="m-0">{{ trans('lang-maker::sp_lang_maker.language') }}</h4>
                <div class="d-flex">
                    <div class="dropdown">
                        <button class="btn {{ $cssClass['btn'] }} dropdown-toggle" type="button" id="dropdownMenuButton" {{ $dataBs }}-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $currantLang }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach($languages as $lang)
                                <a class="dropdown-item {{($currantLang == $lang)?'active':''}}" href="{{ route(config('lang-maker.route_name'), [$lang]) }}" class="nav-link">{{Str::upper($lang)}}</a>
                            @endforeach
                        </div>
                    </div>

                    <button type="button" class="btn {{ $cssClass['btn'] }} m{{ config('lang-maker.bootstrap_v') == 5 ? 's' : 'l' }}-3" {{ $dataBs }}-toggle="modal" {{ $dataBs }}-target="#langCreateModal">{{ trans('lang-maker::sp_lang_maker.create') }}</button>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form method="post" action="{{route(config('lang-maker.route_name') . '.update', [$currantLang])}}">
                @csrf

                <div class="row">
                    <div class="col-12 col-sm-4 col-md-3 col-lg-2 nav-pills-tab">
                        <div class="nav flex-column nav-pills" id="v-pills-tab">
                            @if(!empty($jsonFileArray))
                            <a class="{{ $cssClass['link'] }} active" {{ $dataBs }}-toggle="pill" href="#v-pills-json">{{ trans('lang-maker::sp_lang_maker.json') }}</a>
                            @endif

                            @php
                                $x = 0;
                            @endphp
                            @foreach($pageArray as $fileName => $fileValue)
                            <a class="{{ $cssClass['link'] }}{{ (empty($jsonFileArray) && $x == 0) ? ' active' : null }}" {{ $dataBs }}-toggle="pill" href="#v-pills-{{ $fileName }}">{{ucfirst($fileName)}}</a>
                            @php
                                $x++;
                            @endphp
                            @endforeach
                        </div>
                    </div>

                    <div class="col-12 col-sm-8 col-md-9 col-lg-10">
                        <div class="tab-content" id="v-pills-tabContent">
                            @if(!empty($jsonFileArray))
                            <div class="tab-pane fade show active" id="v-pills-json">
                                <div class="row">
                                    @foreach($jsonFileArray as $label => $value)
                                    <div class="col-md-6">
                                        <div class="{{ $formGroup }}">
                                            <label>{{ $label }} </label>
                                            <input type="text" class="{{ $cssClass['input'] }}" name="label[{{ $label }}]" value="{{ $value }}">
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            @php
                                $x = 0;
                            @endphp
                            @foreach($pageArray as $fileName => $fileValue)
                            <div class="tab-pane fade{{ (empty($jsonFileArray) && $x == 0) ? ' show active' : null }}" id="v-pills-{{ $fileName }}">
                                <div class="row">
                                    @foreach($fileValue as $label => $value)
                                        @if(is_array($value))
                                            @foreach($value as $label2 => $value2)
                                                @if(is_array($value2))
                                                    @foreach($value2 as $label3 => $value3)
                                                        @if(is_array($value3))
                                                            @foreach($value3 as $label4 => $value4)
                                                                @if(is_array($value4))
                                                                    @foreach($value4 as $label5 => $value5)
                                                                        <div class="col-md-6">
                                                                            <div class="{{ $formGroup }}">
                                                                                <label>{{$label}}.{{$label2}}.{{$label3}}.{{$label4}}.{{$label5}}</label>
                                                                                <input type="text" class="{{ $cssClass['input'] }}" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}][{{$label4}}][{{$label5}}]" value="{{$value5}}">
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @else
                                                                    <div class="col-lg-6">
                                                                        <div class="{{ $formGroup }}">
                                                                            <label>{{$label}}.{{$label2}}.{{$label3}}.{{$label4}}</label>
                                                                            <input type="text" class="{{ $cssClass['input'] }}" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}][{{$label4}}]" value="{{$value4}}">
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <div class="col-lg-6">
                                                                <div class="{{ $formGroup }}">
                                                                    <label>{{$label}}.{{$label2}}.{{$label3}}</label>
                                                                    <input type="text" class="{{ $cssClass['input'] }}" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}]" value="{{$value3}}">
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <div class="col-lg-6">
                                                        <div class="{{ $formGroup }}">
                                                            <label>{{$label}}.{{$label2}}</label>
                                                            <input type="text" class="{{ $cssClass['input'] }}" name="message[{{$fileName}}][{{$label}}][{{$label2}}]" value="{{$value2}}">
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <div class="col-lg-6">
                                                <div class="{{ $formGroup }}">
                                                    <label>{{$label}}</label>
                                                    <input type="text" class="{{ $cssClass['input'] }}" name="message[{{$fileName}}][{{$label}}]" value="{{$value}}">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            @php
                                $x++;
                            @endphp
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button class="btn {{ $cssClass['btn'] }} {{ $floatRight }}" type="submit">{{ trans('lang-maker::sp_lang_maker.save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="langCreateModal" tabindex="-1" role="dialog" aria-labelledby="langCreateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" action="{{ route(config('lang-maker.route_name') .'.store') }}">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="langCreateModalLabel">{{ trans('lang-maker::sp_lang_maker.language_create') }}</h5>
                        @if (config('lang-maker.bootstrap_v') == 5)
                            <button type="button" class="btn-close" {{ $dataBs }}-dismiss="modal" aria-label="Close"></button>
                        @else
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        @endif
                    </div>
                    <div class="modal-body">
                        <div class="{{ $formGroup }}">
                            <label for="code" class="col-form-label">{{ trans('lang-maker::sp_lang_maker.language_code') }}</label>
                            <input type="text" class="{{ $cssClass['input'] }}" id="code" name="code" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn {{ $cssClass['btn'] }}">{{ trans('lang-maker::sp_lang_maker.save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
