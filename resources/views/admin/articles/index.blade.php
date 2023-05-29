@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="py-3 text-start mt-4">List of All Articles</h2>
        <div class="text-start mb-3">
            <a class="btn btn-primary btn-lg" href="{{route('admin.articles.create')}}">
                <i class="fa-solid fa-plus"></i>
                New Article
            </a>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-10">
                @if (session('message'))
                    <div class="alert alert-info">
                        {{ session('message') }}
                    </div>
                @endif
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Date</th>
                        <th scope="col">Image</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($articles as $article)
                            <tr>
                                <th scope="row">{{ $article->title }}</th>
                                <td>{{ $article->created_at }}</td>
                                <td>
                                    @if ($article->cover_image)
                                        <img src="{{ asset('storage/' . $article->cover_image)}}" alt="{{ 'image of ' . $article->title }}">
                                    @else
                                        <div class="bg-secondary p-3 text-center text-white">No image</div>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-dark" href="{{ route('admin.articles.show', $article->slug) }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a class="btn btn-info" href="{{ route('admin.articles.edit', $article->slug) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-article-{{$article->id}}">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="delete-article-{{$article->id}}" tabindex="-1" aria-labelledby="delete-label-{{$article->id}}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2 class="modal-title fs-5" id="delete-label-{{$article->id}}">Sei sicuro di voler eliminare {{$article->title}}?</h2>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>

                                                    <form action="{{route('admin.articles.destroy', $article->slug)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-primary">
                                                            Conferma
                                                        </button>
                                                    
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
@endsection