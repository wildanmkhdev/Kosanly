@extends('layouts.app')
@section('content')
    <div id="Background"
        class="absolute top-0 w-full h-[570px] rounded-b-[75px] bg-[linear-gradient(180deg,#F2F9E6_0%,#D2EDE4_100%)]"></div>

    <div id="TopNav" class="relative flex items-center justify-between px-5 mt-[60px]">
        <a href="find-kos.html"
            class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-white">
            <img src="assets/images/icons/arrow-left.svg" class="w-[28px] h-[28px]" alt="icon">
        </a>
        <p class="font-semibold">Search Results</p>
        <div class="dummy-btn w-12"></div>
    </div>
    <div id="Header" class="relative flex items-center justify-between gap-2 px-5 mt-[18px]">
        <div class="flex flex-col gap-[6px]">
            <h1 class="font-bold text-[32px] leading-[48px]">Search Result</h1>
            <p class="text-ngekos-grey">Tersedia 1,304 Kos</p>
        </div>
    </div>
    <section id="Result" class="relative flex flex-col gap-4 px-5 mt-5 mb-9">
        @forelse ($boardingHouses as $house)
            <a href="{{ route('find-kos.results', ['search' => $house->name]) }}" class="card">
                {{-- bakal mencari pencarian dengan key search name --}}

                <div
                    class="flex rounded-[30px] border border-[#F1F2F6] p-4 gap-4 bg-white hover:border-[#91BF77] transition-all duration-300">

                    {{-- Thumbnail kos --}}
                    <div class="flex w-[120px] h-[183px] shrink-0 rounded-[30px] bg-[#D9D9D9] overflow-hidden">
                        <img src="{{ asset('storage/' . $house->thumbnail) }}" class="w-full h-full object-cover"
                            alt="thumbnail">
                    </div>

                    {{-- Detail kos --}}
                    <div class="flex flex-col gap-3 w-full">
                        <h3 class="font-semibold text-lg leading-[27px] line-clamp-2 min-h-[54px]">
                            {{ $house->name }}
                        </h3>
                        <hr class="border-[#F1F2F6]">

                        <div class="flex items-center gap-[6px]">
                            <img src="{{ asset('assets/images/icons/location.svg') }}" class="w-5 h-5 flex shrink-0"
                                alt="icon">
                            <p class="text-sm text-ngekos-grey">{{ $house->city->name ?? '-' }}</p>
                        </div>

                        <div class="flex items-center gap-[6px]">
                            <img src="{{ asset('assets/images/icons/profile-2user.svg') }}" class="w-5 h-5 flex shrink-0"
                                alt="icon">
                            <p class="text-sm text-ngekos-grey">{{ $house->capacity ?? 'N/A' }} People</p>
                        </div>
                        <hr class="border-[#F1F2F6]">

                        <p class="font-semibold text-lg text-ngekos-orange">
                            Rp {{ number_format($house->price, 0, ',', '.') }}
                            <span class="text-sm text-ngekos-grey font-normal">/bulan</span>
                        </p>
                    </div>
                </div>
            </a>
        @empty
            <p class="text-center text-gray-500">Tidak ada kos ditemukan.</p>
        @endforelse
    </section>
@endsection
