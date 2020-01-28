@extends('frontend.layouts.app')

@section('title')
| {{ $post->title }}
@endsection

@section('content')
    <section>
        <categories name="{{ $post->category->name }}"></categories>

        <div class="container mx-auto">

            <h1 class="tracking-wider text-4xl font-bold pt-6 pb-3">{{$post->title }}</h1>

            <div class="tracking-wider text-sm pb-16">
                <a href="{{ route('category', $post->category->name) }}" class="hover:opacity-50">
                    <span class="text-blue-600 font-bold uppercase">{{ $post->category->name }}</span>
                </a> |
                <span class="text-gray-600">{{ $post->published->diffForHumans() }}</span>
            </div>

            <div>
                <img class="w-full rounded object-cover" style="height:700px" src="{{ url($post->image) }}" alt="{{ $post->image }}">
            </div>

            <div class="markdown_css py-8 mx-32">{!! $post->parsed !!}</div>
        </div>
    </section>
@endsection