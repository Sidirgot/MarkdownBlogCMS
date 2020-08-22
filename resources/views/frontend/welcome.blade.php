@extends('frontend.layouts.app')

@section('title', '| Welcome')

@section('content')
    <section class="">
        <div class="bg-gray-600 relative">
            <span class="absolute w-full h-full" style="background: rgba(0,0,0,0.3);"></span>

            <img src="{{ $pinned->image }}" class="image-cover w-full object-cover" style="height:700px" alt="{{ $pinned->image }}">

            <div class="absolute text-white text-2xl tracking-wider rounded p-4" style="left: 2%; bottom: 10%; background: rgba(0,0,0,0.3);">
                <h1>
                    <a href="{{ route('post', $pinned->slug) }}" class="hover:opacity-50">
                        {{ $pinned->title }}
                    </a>
                </h1>
                <div class="tracking-wider text-sm py-4 text-center">
                    <span class="text-blue-600 font-bold uppercase">
                        <a href="{{ route('category', $pinned->category->name) }}" class="hover:opacity-50">
                            {{ $pinned->category->name }}
                        </a>
                    </span> |
                    <span class="text-gray-600">{{ $pinned->published->diffForHumans() }}</span>
                </div>
            </div>
        </div>

       <categories></categories>

        <div class="mx-auto container w-full">
            @foreach($posts as $post)
                <div class="md:flex items-center mx-2 mb-24">

                    <div class="w-full md:w-2/4">
                        <a href="{{ route('post', $post->slug) }}">
                            <img src="{{ $post->image }}" class=" w-full object-cover rounded hover:opacity-75" alt="{{ $post->image }}">
                        </a>
                    </div>

                    <div class="w-full md:w-2/4 p-4 text-center mt-6 md:mx-20">

                            <div class="tracking-wider text-sm py-4">
                                <a href="{{ route('category', $post->category->name) }}" class="hover:opacity-50">
                                    <span class="text-blue-600 font-bold uppercase">{{ $post->category->name }}</span>
                                </a> |
                                <span class="text-gray-600">{{ $post->published->diffForHumans() }}</span>
                            </div>

                            <div class="text-2xl">
                                <a href="{{ route('post', $post->slug) }}" class="tracking-wide hover:opacity-50">
                                    {{ $post->title }}
                                </a>
                            </div>

                            <div class="py-6">
                                <a href="{{ route('post', $post->slug) }}" class="tracking-wide hover:opacity-50 text-gray-600">
                                    {{ substr($post->content, 0, 150) }}...
                                </a>
                            </div>


                            <div class="py-6">
                                <a href="{{ route('post', $post->slug) }}" class="btn btn-blue">
                                    Read More...
                                </a>
                            </div>
                    </div>
                </div>
            @endforeach
        </div>


    </section>
@endsection