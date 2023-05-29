@extends('layouts.admin')

@section('content')
    <div class="container">
        {{-- button to go back --}}
        <div>
            <a class="btn btn-secondary mt-4" href="{{ route('admin.articles.index') }}">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>
        </div>
        {{-- title --}}
        <h1 class="py-3 mt-3"> {{$article->title}} </h1>
        <h5>{{$article->created_at}}</h5>
        {{-- image --}}
        <div class="text-center">
            @if ($article->cover_image)
                <img class="w-50" src="{{ asset('storage/' . $article->cover_image)}}" alt="{{ 'image of ' . $article->title }}">
            @else
                <div class="w-50 bg-secondary p-3 text-center text-white d-inline-block">No image</div>
            @endif
        </div>
        {{-- description --}}
        <p class="py-3 mt-3">{{$article->description}}</p>
    </div>
@endsection