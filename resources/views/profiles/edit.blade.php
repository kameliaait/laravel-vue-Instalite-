@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editer mon profile</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profiles.update',['user'=> $user]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group ">
                            <label for="titre">{{ __('title') }}</label>

                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title')? old('title') : $user->profile->title }}" autocomplete="caption" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>
                          <div class="form-group ">
                            <label for="description">{{ __('description') }}</label>

                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description"  autocomplete="description" autofocus>{{ old('description')?old('description') : $user->profile->description }}"</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>

                        <div class="form-group ">
                            <label for="url">{{ __('Url') }}</label>

                                <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url')?? $user->profile->url }}" autocomplete="url" autofocus>

                                @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>

                        <div class="form-group">
                            <div class="custom-file">
                                 <input type="file" name="image" class="custom-file-input @error('image') is-invalid  @enderror" id="validatedCustomFile">
                                <label class="custom-file-label" for="customFileLang">Sélectionner une image</label>
                                 @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Modifier mon profile') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
