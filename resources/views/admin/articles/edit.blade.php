@extends('layouts.admin')

@section('content')
    <div class="container">
        {{-- button to go back --}}
        <div>
            <a class="btn btn-secondary mt-4" href="{{ route('admin.articles.index') }}">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>
        </div>
        
        <h2 class="py-3 mt-3"> article changes </h2>
        <div class="row">
            <div class="col-10">
                @include('partials.errors')
                
                <form action="{{ route('admin.articles.update', $article->slug) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Title --}}
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" class="form-control" value="{{old('title', $article->title)}}">
                    </div>

                    {{-- Image --}}
                    <div class="form-group">
                        <label for="cover_image">Image</label>
                        <input type="file" name="cover_image" id="cover_image" class="form-control">
                        {{-- Image Preview --}}
                        <div id="image-preview" >
                            @if ($article->cover_image)
                                <img class="w-50" src="{{ asset('storage/' . $article->cover_image) }}" alt="{{ 'image of ' . $article->title }}">
                            @else
                                <p>No Image</p>
                            @endif
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{old('description', $article->description) }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Save changes</button>
                </form>
            </div>
        </div>
    </div>
@endsection