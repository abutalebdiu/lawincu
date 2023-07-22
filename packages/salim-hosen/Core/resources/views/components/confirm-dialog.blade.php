<div class="modal fade" id="id_{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ __("Delete Dialog") }}</h5>
          <i role="button" class="fas fa-times close"   aria-label="Close" data-bs-dismiss="modal"></i>
        </div>
        <div class="modal-body">
          {{ __("Are you Sure to Delete?") }}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __("No") }}</button>

            {{-- <a class="btn btn-danger" href="{{ $action }}"
                onclick="event.preventDefault();
                                document.getElementById(@json($action)).submit();">
                {{ __('Yes') }}
            </a> --}}

            <form action="{{ $action }}" method="POST" >
                @csrf
                @method("DELETE")
                <button type="submit" class="btn btn-danger">{{ __("Yes") }}</button>
            </form>
        </div>
      </div>
    </div>
  </div>


