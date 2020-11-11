  {{-- Form Files --}}
<form class="form" method="POST" action="{{ route('files.store') }}" enctype="multipart/form-data">
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
                            {{-- Name --}}
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

                            {{-- Created --}}
                            <div class="bmd-form-group{{ $errors->has('date') ? ' has-danger' : '' }} mt-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">date_range</i>
                                    </span>
                                    </div>
                                    <input type="date" name="date" class="form-control" placeholder="{{ __('Date') }}" value="{{ old('date') }}" required>
                                </div>
                                @if ($errors->has('date'))
                                    <div id="date-error" class="error text-danger pl-3" for="date" style="display: block;">
                                    <strong>{{ $errors->first('date') }}</strong>
                                    </div>
                                @endif
                            </div>

                            {{-- Category --}}
                            <div class="bmd-form-group{{ $errors->has('category') ? ' has-danger' : '' }} mt-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">category</i>
                                        </span>
                                    </div>
                                    <select v-for="category in categories" class="form-control" data-style="btn btn-link" name="category" id="">
                                            <option v-text="category.name">
                                            </option>
                                    </select>
                                
                                </div>
                                @if ($errors->has('category'))
                                    <div id="name-error" class="error text-danger pl-3" for="category" style="display: block;">
                                    <strong>{{ $errors->first('category') }}</strong>
                                    </div>
                                @endif
                            </div>

                            {{-- File --}}
                            <div class="bmd-form-group{{ $errors->has('file') ? ' has-danger' : '' }} mt-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">attach_file</i>
                                        </span>
                                    </div>
                                <input type="file" name="file" class="form-control">
                                
                                </div>
                                @if ($errors->has('file'))
                                    <div id="name-error" class="error text-danger pl-3" for="file" style="display: block;">
                                    <strong>{{ $errors->first('file') }}</strong>
                                    </div>
                                @endif
                            </div>

                            {{-- folder_id --}}
                            <input type="hidden" name="folder_id" class="form-control" value="{{ $folder->id }}">


                            {{-- Buttons --}}
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
</form>