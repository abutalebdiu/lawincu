@extends('core::layouts.admin')



@section("meta_tags")
<title>{{ __("Leads List") }}</title>
    <meta name="description" content="Leads List and Manage Leads Details">
    <meta name="keywords" content="lead,lead_list">
@endsection


@push("head_tags")
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<style>
    .connectedSortable{
        border: 1px solid #ccc;
        padding: 15px;
        border-radius: 10px;
    }
</style>
@endpush

@section('content')

<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <div class="d-flex justify-content-between align-items-center">
            <a class="btn btn-success" href="{{ route('leads.create') }}">
                {{ __("Create Lead") }}
            </a>
            <div>
                <select name="pipeline" id="pipeline" class="form-select" onchange="window.location.href = this.value">
                    @foreach ($pipelines as $pipe)
                        <option @if($pipe->id == $pipeline) selected @endif value="{{ route("leads.index", ['pipeline' => $pipe->id]) }}">{{ $pipe->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>

<div class="row" style="overflow-x: scroll;flex-wrap: nowrap;">

    @foreach ($stages as $i => $stage)
        <div class="col-md-4">
            <div class="d-flex justify-content-between">
                <h5>{{ $stage->name }}</h5>
                <span> {{ config("settings.currency") }} {{ $stage->leads()->sum("lead_value") }}</span>
            </div>
            <div class="connectedSortable sortable" data-id="{{ $stage->id }}">
                @foreach ($stage->leads as $lead)
                    <div class="card mb-1" data-id="{{ $lead->id }}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">
                                    <a href="{{ route("leads.show", $lead->id) }}" class="">{{ $lead->title }}</a>
                                </h6>
                                <div>
                                    <a href="{{ route("leads.edit", $lead->id) }}" class="btn btn-secondary btn-xs"><i class="fas fa-pen m-0"></i></a>
                                    <x-core-delete-dialog :id="$lead->id" :action="route('leads.destroy', $lead->id)"></x-core-delete-dialog>
                                </div>
                            </div>
                            <p>{{ config("settings.currency") }}  {{ $lead->lead_value }}</p>
                            <p>{{ $lead->price }}</p>
                            @if ($lead->contact_id)
                            <a href="{{ route("contacts.show", $lead->contact_id) }}" class="text-small text-info">
                                <i class="fas fa-user"></i>
                                {{ $lead->contact->name }}
                            </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach



</div>

@endsection


@push('body_scripts')
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( ".sortable" ).sortable({
      connectWith: ".connectedSortable",
      receive: function( event, ui ) {

            var stage_id = event.target.getAttribute("data-id");
            var lead_id = ui.item.attr("data-id");

            $.ajax({
                url: "/lead/stage/"+lead_id,
                type: "post",
                data: {_method: "PUT", _token: "{{ csrf_token() }}", stage_id: stage_id} ,
                success: function (response) {
                    window.location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });

      }
    }).disableSelection();



  });
  </script>
@endpush
