<form class="form" method="POST" @submit.prevent="createCategory()">
<!-- Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {{-- <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('Create Account')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div> --}}
                {{-- Content Modal --}}
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
                                        <i class="material-icons">article</i>
                                    </span>
                                    </div>
                                    <input type="name" name="name" v-model="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required>
                                </div>
                                @if ($errors->has('name'))
                                    <div id="name-error" class="error text-danger pl-3" for="name" style="display: block;">
                                    <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                            @endif
                            </div>

                            {{-- Description --}}
                            <div class="bmd-form-group{{ $errors->has('description') ? ' has-danger' : '' }} mt-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">description</i>
                                    </span>
                                    </div>
                                    <textarea class="form-control" name="description" v-model="description" placeholder="Descripción" ></textarea>
                                </div>
                                @if ($errors->has('description'))
                                    <div id="description-error" class="error text-danger pl-3" for="description" style="display: block;">
                                    <strong>{{ $errors->first('description') }}</strong>
                                    </div>
                                @endif
                            </div>

                            {{-- Buttons --}}
                            <div class="card-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" data-backdrop="false">Cerrar</button>
                                <button type="submit" class="btn btn-primary">{{ $btnText }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>