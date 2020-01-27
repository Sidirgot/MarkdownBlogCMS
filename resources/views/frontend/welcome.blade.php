@extends('frontend.layouts.app')

@section('title', '| Welcome')

@section('content')
    <section class="">
        <div class="bg-gray-600">
            <img src="{{ $pinned->image }}" class="w-full object-cover" style="height:700px" alt="">
        </div>

        <div class="flex justify-center items-center my-12">
            @foreach($categories as $category)
                <span class="text-lg mx-6 tracking-widest">{{ $category->name }}</span>
            @endforeach
        </div>

        <div class="mx-auto container w-full">
            @foreach($posts as $post)
                <div class="md:flex items-center mx-2 mb-24">

                    <div class="w-full md:w-2/4">
                        <a href="">
                            <img src="{{ $post->image }}" class=" w-full object-cover rounded hover:opacity-50" alt="">
                        </a>
                    </div>

                    <div class="w-full md:w-2/4 p-4 text-center mt-6 md:mx-20">

                            <div class="tracking-wider text-sm py-4">
                                <span class="text-blue-600 font-bold uppercase">{{ $post->category->name }}</span> |
                                <span class="text-gray-600">{{ $post->published->diffForHumans() }}</span>
                            </div>

                            <div class="text-2xl">
                                <a href="#" class="tracking-wide hover:opacity-50">
                                    {{ $post->title }}
                                </a>
                            </div>

                            <div class="py-6">
                                <a href="#" class="tracking-wide hover:opacity-50 text-gray-600">
                                    {{ substr($post->content, 0, 150) }}...
                                </a>
                            </div>


                            <div class="py-6">
                                <button class="btn btn-blue">
                                    Read More...
                                </button>
                            </div>
                    </div>
                </div>
            @endforeach
        </div>

        <newsletter></newsletter>
    </section>
@endsection