@extends('layout.layout')

@section('main-content')
<main class="bg-[linear-gradient(to_bottom,rgba(0,0,0,0.9),rgba(0,0,0,0.2))] min-h-[100vh] font-raleway pb-[50px]">
    <a href="{{route("countries_list")}}" class="hidden lg:block"> 
    <i class="fa-solid fa-arrow-left text-[white] hidden lg:absolute m-[50px] text-[50px] hover:text-[red] transition-all"></i>
    </a>
    <div class="image_and_name_bg flex bg-[linear-gradient(to_right_bottom,rgba(0,0,0,0.6),rgba(0,0,0,0.8)),url(/public/img/country_bg.jpg)] bg-center bg-cover w-[100%] justify-center">
        <div class=" flex flex-col lg:flex-row p-[20px] lg:p-[120px]">
            <div class="flex flex-col lg:w-[700px] text-white pb-[20px]">
                <H1 class="text-[40px] lg:text-[50px] mr-[20px]">{{$country["official_name"]}}</H1>
                <h3 class="text-[20px]">{{$country["common_name"]}}</h3>
            </div>
            <img src="{{$country["flag"]}}" class="w-[500px] rounded-lg" alt="">
        </div>
    </div>
    <div class="main_content flex flex-wrap max-w-[1700px] m-auto mt-[50px] gap-[50px] justify-center">
        <div class="box w-[80%] lg:w-[400px] h-[200px] bg-[white] border-b-[15px] border-[red] p-[20px]">
            <h2 class="text-[25px] lg:text-[50px]">{{$country["capital"]}}</h2>
            <h3>Capital</h3>
        </div>
        <div class="box w-[80%] lg:w-[400px] h-[200px] bg-[white] border-b-[15px] border-[red] p-[20px]">
            <h2 class="text-[25px] lg:text-[50px]">{{$country["population"]}}</h2>
            <h3>Population</h3>
        </div>
        <div class="box w-[80%] lg:w-[400px] h-[200px] bg-[white] border-b-[15px] border-[red] p-[20px]">
            <h2 class="text-[25px] lg:text-[50px] max-h-[77px] overflow-auto">{{$country["languages"]}}</h2>
            <h3>Languages</h3>
        </div>
        <div class="box2 w-[80%] lg:w-[625px] h-[400px] bg-[white] border-b-[15px] border-[red] p-[20px]">
            <h2 class="text-[25px] lg:text-[50px] max-h-[300px] overflow-auto">{{$country["timezones"]}}</h2>
            <h3>Timezones</h3>
        </div>
        <div class="box2 w-[80%] lg:w-[625px] h-[400px] bg-[white] border-b-[15px] border-[red] p-[20px]">
            <h2 class="text-[25px] lg:text-[50px]">{{$country["currency_name"]}}</h2>
            <h3 >Currency</h3>
            <div class="currency_box w-[100%] h-[200px] mt-[20px] overflow-x-auto whitespace-nowrap ">
                @if ($currency->isEmpty())
                    <p>No currency data for now</p>
                @endif
                @foreach ($currency as $one_currency)
                <div class="flex">
                        <p> {{$one_currency["currency"]}} ...................................................</p>
                        <p> {{$one_currency["rate"]}} to EURO at {{$one_currency["created_at"]}}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</main>
<script src="/holokolo/resources/js/country.js"></script>
@endsection