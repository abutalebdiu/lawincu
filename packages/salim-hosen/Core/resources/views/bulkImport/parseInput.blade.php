@extends('core::layouts.admin')

@section('content')

    <div class='row'>
        <div class='col-md-12'>
            <form class="form-horizontal" method="POST" action="{{ route('bulk.import.process') }}">

                <div class="card panel-default">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        {{ __('Bulk Import Data') }}
                        <button type="submit" class="btn btn-primary">
                            {{ __('Import Data') }}
                        </button>
                    </div>

                    <div class="card-body table-responsive">
                        @csrf

                        <input type="hidden" name="filename" value="{{ $filename }}" />
                        <input type="hidden" name="hasHeader" value="{{ $hasHeader }}" />
                        <input type="hidden" name="modelName" value="{{ $modelName }}" />
                        <input type="hidden" name="redirect" value="{{ $redirect }}" />
                        <input type="hidden" name="additional_data" value="{{ $additional_data }}" />

                        {{-- <select name="mailing_list" id="mailing_list" class="form-control mb-3" required>
                            <option value="">{{ __("Select Mailing List") }}</option>
                            @foreach ($mailing_lists as $list)
                                <option value="{{ $list->id }}">{{ $list->name }}</option>
                            @endforeach
                        </select> --}}
                        <table class="table">
                            <tr>
                                @foreach ($headers as $key => $header)
                                    <td>
                                        <select name="fields[{{ $key }}]">
                                            <option value=''>{{ __("Please select") }}</option>
                                            @foreach ($fillables as $k => $fillable)
                                                <option value="{{ $fillable }}"
                                                    {{ strtolower($header) === strtolower($fillable) ? 'selected' : '' }}>
                                                    {{ $fillable }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                @endforeach
                            </tr>
                            {{-- Headers --}}
                            @if (isset($headers))
                                <tr>
                                    @foreach ($headers as $field)
                                        <th>{{ $field }}</th>
                                    @endforeach
                                </tr>
                            @endif

                            {{-- Table Row --}}
                            @if ($rows)
                                @foreach ($rows as $i => $row)
                                    <tr @if ($loop->index > 20) class="d-none" @endif>
                                        @foreach ($row as $field)
                                            <td>
                                                {{ $field }}
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            @endif

                        </table>
                        @if (count($rows) > 20)
                            <div class="text-center">
                                <span class="text text-info font-weight-bold">{{ __("More ") }}  {{ count($rows) - 20 }} {{  __(" rows are Available") }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
