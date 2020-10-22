<!-- Modal -->
<div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="fileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        {{-- <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">@lang('Create Account')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> --}}
        <div class="modal-body">

            @csrf
            <div class="card">
                <div class="card-header card-header-primary text-center">
                    <h4 class="card-title"><strong>{{ $titleCard }}</strong></h4>
                </div>
                <div class="card-body ">
                    <div class="bmd-form-group{{ $errors->has('id') ? ' has-danger' : '' }}">
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">person_add</i>
                        </span>
                        </div>
                        <input type="number" maxlength="10" onkeypress="return isNumerKey (event)" name="id" class="form-control" placeholder="{{ __('Cedula') }}" value="{{ old('id') }}" required>
                    </div>
                    @if ($errors->has('id'))
                        <div id="id-error" class="error text-danger pl-3" for="id" style="display: block;">
                        <strong>{{ $errors->first('id') }}</strong>
                        </div>
                    @endif
                    </div>
                    <div class="bmd-form-group{{ $errors->has('name') ? ' has-danger' : '' }} mt-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">face</i>
                        </span>
                        </div>
                        <input type="name" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required>
                    </div>
                    @if ($errors->has('name'))
                        <div id="name-error" class="error text-danger pl-3" for="name" style="display: block;">
                        <strong>{{ $errors->first('name') }}</strong>
                        </div>
                    @endif
                    </div>
                    <div class="card-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">{{ $btnText }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>