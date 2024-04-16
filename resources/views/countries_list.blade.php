@extends('layout.layout')

@section('main-content')
<main class="bg-[#3d3d3d] w-[100%] items-center flex flex-col min-h-[100vh] pt-[40px] pb-[30px]  font-raleway">
    <input type="text" class="w-[80%] lg:w-[50%] h-[60PX] outline-none rounded-full pl-[20px]" placeholder="Search country..." id="search_input">
   <div class="flex flex-wrap w-[80%]  pt-[50px] justify-center items-center gap-[40px]">
   @foreach ($countries as $country)
   <a href="{{route("country.name", ["name" => "".$country["common_name"]])}}" alt="{{$country["common_name"]}}" class="w-[300px] img hover:scale-[1.1] transition-all">
       <img src="{{$country["flag"]}}" class="rounded-md">
       <p class="text-[white]">{{$country["common_name"]}}</p>
    </a>
   @endforeach
    </div>
    <div class="flex w-[95%] bottom-[50px] justify-end fixed" id="arrow_scroll_top_container">
        <i class="fa-solid fa-arrow-up text-white animate-bounce text-[40px] cursor-pointer" id="arrow_scroll_top"></i>
    </div>
    <script src="/holokolo/resources/js/script.js"></script>
</main>
@endsection