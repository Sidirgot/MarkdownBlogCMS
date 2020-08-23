@extends('frontend.layouts.app')

@section('title')
| {{ $category->name }}
@endsection

@section('content')
    <section>
        <categories name="{{ $category->name }}"></categories>

        <div class="container mx-auto flex flex-wrap justify-center items-center">
            @forelse($posts as $post)
           <div class="md:flex items-center mx-2 mb-24 mt-12">

                    <div class="w-full md:w-2/4">
                        <a href="{{ route('post', $post->slug) }}">
                            <img src="{{ '/storage/' .$post->image }}" class=" w-full object-cover rounded hover:opacity-75" alt="{{ $post->image }}">
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
                                <a href="{{ route('post', $post->slug) }}"class="btn btn-blue">
                                    Read More...
                                </a>
                            </div>
                    </div>
                </div>
            @empty
            <div class="text-2xl text-center w-full my-20">
                <p>No posts for the specified category.</p>
            </div>
            @endforelse
        </div>

    </section>
@endsection