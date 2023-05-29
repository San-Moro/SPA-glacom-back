@extends('layouts.admin')

@section('content')
    <div class="container">
        {{-- button to go back --}}
        <div>
            <a class="btn btn-secondary mt-4" href="{{ route('admin.articles.index') }}">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>
        </div>
        
        <h2 class="py-3 mt-3">Add a new article</h2>
        <div class="row">
            <div class="col-10">
                @include('partials.errors')
                <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- input to add Title --}}
                    <div class="form-group mb-3">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div> 
                        @enderror
                    </div>
                    {{-- input to add Image --}}
                    <div class="form-group mb-3">
                        <label for="cover_image">Image</label>
                        <input type="file" id="cover_image" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror">
                        @error('cover_image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div> 
                        @enderror
                    </div>
                    {{-- image preview --}}
                    <div class="mt-3">
                        <img id="img_preview" src="" alt="" style="max-height:200px">
                    </div>
                    {{-- input to add Description --}}
                    <div class="form-group">
                        <label for="description">description</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                    </div>

                    <button class="btn btn-primary mt-3 " type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection