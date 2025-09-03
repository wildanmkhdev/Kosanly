@extends('layouts.app')

@section('content')
    <div id="Background"
        class="absolute top-0 w-full h-[230px] rounded-b-[75px] bg-[linear-gradient(180deg,#F2F9E6_0%,#D2EDE4_100%)]">
    </div>
    <div id="TopNav" class="relative flex items-center justify-between px-5 mt-[60px]">
        <a href="{{ route('kos.rooms', $boardingHouse->slug) }}"
            class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-white">
            <img src="{{ asset('assets/images/icons/arrow-left.svg') }}" class="w-[28px] h-[28px]" alt="icon">
        </a>
        <p class="font-semibold">Customer Information</p>
        <div class="dummy-btn w-12"></div>
    </div>
    <div id="Header" class="relative flex items-center justify-between gap-2 px-5 mt-[18px]">
        <div class="flex flex-col w-full rounded-[30px] border border-[#F1F2F6] p-4 gap-4 bg-white">
            <div class="flex gap-4">
                <div class="flex w-[120px] h-[132px] shrink-0 rounded-[30px] bg-[#D9D9D9] overflow-hidden">
                    <img src="{{ asset('storage/' . $boardingHouse->thumbnail) }}" class="w-full h-full object-cover"
                        alt="icon">
                </div>
                <div class="flex flex-col gap-3 w-full">
                    <p class="font-semibold text-lg leading-[27px] line-clamp-2 min-h-[54px]">{{ $boardingHouse->name }}</p>
                    <hr class="border-[#F1F2F6]">
                    <div class="flex items-center gap-[6px]">
                        <img src="{{ asset('assets/images/icons/location.svg') }}" class="w-5 h-5 flex shrink-0"
                            alt="icon">
                        <p class="text-sm text-ngekos-grey">{{ $boardingHouse->city->name }}</p>
                    </div>
                    <div class="flex items-center gap-[6px]">
                        <img src="{{ asset('assets/images/icons/profile-2user.svg') }}" class="w-5 h-5 flex shrink-0"
                            alt="icon">
                        <p class="text-sm text-ngekos-grey">In {{ $boardingHouse->category->name }}</p>
                    </div>
                </div>
            </div>
            <hr class="border-[#F1F2F6]">
            <div class="flex gap-4">
                <div class="flex w-[120px] h-[156px] shrink-0 rounded-[30px] bg-[#D9D9D9] overflow-hidden">
                    <img src="{{ asset('storage/' . ($room?->images?->first()->image ?? 'default.jpg')) }}"
                        class="w-full h-full object-cover" alt="icon">
                </div>
                <div class="flex flex-col gap-3 w-full">
                    <p class="font-semibold text-lg leading-[27px]">{{ $room->name ?? 'kamar tidak ada' }}</p>
                    <hr class="border-[#F1F2F6]">
                    <div class="flex items-center gap-[6px]">
                        <img src="{{ asset('assets/images/icons/profile-2user.svg') }}" class="w-5 h-5 flex shrink-0"
                            alt="icon">
                        <p class="text-sm text-ngekos-grey">{{ $room->capacity ?? 'capacity tidak ada' }}People</p>
                    </div>
                    <div class="flex items-center gap-[6px]">
                        <img src="{{ asset('assets/images/icons/3dcube.svg') }}" class="w-5 h-5 flex shrink-0"
                            alt="icon">
                        <p class="text-sm text-ngekos-grey">{{ $room->square_feet ?? 'td ada' }} sqft flat</p>
                    </div>
                    <hr class="border-[#F1F2F6]">
                    <p class="font-semibold text-lg text-ngekos-orange">
                        {{ number_format($room->price_per_month ?? 0, 0, ',', '.') }}<span
                            class="text-sm text-ngekos-grey font-normal">/bulan</span></p>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('booking.information.save', $boardingHouse->slug) }}"
        class="relative flex flex-col gap-6 mt-5 pt-5 bg-[#F5F6F8] min-h-screen" method="POST" id="bookingForm">
        @csrf

        <!-- Header Section -->
        <div class="flex flex-col gap-[6px] px-5">
            <input type="hidden" name="room_id" value="{{ $room->id ?? '' }}">
            <h1 class="font-semibold text-lg">Your Information</h1>
            <p class="text-sm text-ngekos-grey">Please fill in all required fields with valid information</p>
        </div>

        <!-- User Input Fields -->
        <div id="UserInputFields" class="flex flex-col gap-[18px]">
            <!-- Full Name Field -->
            <div class="flex flex-col w-full gap-2 px-5">
                <label class="font-semibold">Full Name</label>
                <div
                    class="flex items-center w-full rounded-full p-[14px_20px] gap-3 bg-white focus-within:ring-1 focus-within:ring-[#91BF77] transition-all duration-300 @error('name') border-red-500 @enderror">
                    <img src="{{ asset('assets/images/icons/profile-2user.svg') }}" class="w-5 h-5 flex-shrink-0"
                        alt="icon">
                    <input type="text" name="name"
                        class="appearance-none outline-none w-full font-semibold placeholder:text-ngekos-grey placeholder:font-normal"
                        placeholder="Enter your full name" value="{{ old('name') }}" required>
                </div>
                @error('name')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="flex flex-col w-full gap-2 px-5">
                <label class="font-semibold">Email Address</label>
                <div
                    class="flex items-center w-full rounded-full p-[14px_20px] gap-3 bg-white focus-within:ring-1 focus-within:ring-[#91BF77] transition-all duration-300 @error('email') border-red-500 @enderror">
                    <img src="{{ asset('assets/images/icons/sms.svg') }}" class="w-5 h-5 flex-shrink-0" alt="icon">
                    <input type="email" name="email"
                        class="appearance-none outline-none w-full font-semibold placeholder:text-ngekos-grey placeholder:font-normal"
                        placeholder="Enter your email address" value="{{ old('email') }}" required>
                </div>
                @error('email')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone Number Field -->
            <div class="flex flex-col w-full gap-2 px-5">
                <label class="font-semibold">Phone Number</label>
                <div
                    class="flex items-center w-full rounded-full p-[14px_20px] gap-3 bg-white focus-within:ring-1 focus-within:ring-[#91BF77] transition-all duration-300 @error('phone_number') border-red-500 @enderror">
                    <img src="{{ asset('assets/images/icons/call.svg') }}" class="w-5 h-5 flex-shrink-0" alt="icon">
                    <input type="tel" name="phone_number"
                        class="appearance-none outline-none w-full font-semibold placeholder:text-ngekos-grey placeholder:font-normal"
                        placeholder="Enter your phone number" value="{{ old('phone_number') }}" required>
                </div>
                @error('phone_number')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Duration Selector -->
        <div class="flex items-center justify-between px-5">
            <label class="font-semibold">Rental Duration (Months)</label>
            <div class="relative flex items-center gap-[10px] w-fit">
                <button type="button" id="Minus"
                    class="w-12 h-12 flex-shrink-0 bg-white rounded-lg hover:bg-gray-50 transition-colors duration-200 flex items-center justify-center">
                    <img src="{{ asset('assets/images/icons/minus.svg') }}" alt="minus" class="w-5 h-5">
                </button>
                <input id="Duration" type="text" value="1" name="duration"
                    class="appearance-none outline-none !bg-transparent w-[42px] text-center font-semibold text-[22px] leading-[33px]"
                    inputmode="numeric" pattern="[0-9]*" required>
                <button type="button" id="Plus"
                    class="w-12 h-12 flex-shrink-0 bg-white rounded-lg hover:bg-gray-50 transition-colors duration-200 flex items-center justify-center">
                    <img src="{{ asset('assets/images/icons/plus.svg') }}" alt="plus" class="w-5 h-5">
                </button>
            </div>
        </div>

        <!-- Date Selection Section -->
        <div class="flex flex-col gap-3">
            <label class="font-semibold px-5">Select Move-in Date</label>
            <div class="swiper w-full overflow-hidden">
                <div class="swiper-wrapper select-dates">
                    <!-- Date options will be generated by JavaScript -->
                </div>
            </div>
            @error('start_date')
                <p class="text-sm text-red-500 px-5">{{ $message }}</p>
            @enderror
        </div>
        <div id="BottomNavigationBar" class="relative bottom-0 left-0 right-0 z-500">
            <div class="w-full max-w-[640px] mx-auto px-5 pb-5 pt-3 bg-white">
                <div class="flex items-center justify-between rounded-[40px] py-4 px-6 bg-ngekos-black shadow-xl">
                    <div class="flex flex-col gap-[2px]">
                        <p id="price" class="font-bold text-xl leading-[30px] text-white">
                            Rp 0
                        </p>
                        <span class="text-sm text-gray-300">Grand Total</span>
                    </div>
                    <button type="submit"
                        class="flex shrink-0 rounded-full py-[14px] px-5 bg-ngekos-orange hover:bg-orange-600 font-bold text-white transition-colors duration-200">
                        Book Now
                    </button>
                </div>
            </div>
        </div>
        <!-- Spacer to make room for fixed bottom -->
        <div class="h-[150px]"></div>

        <!-- Bottom Navigation / Submit Section - Fixed Position -->

    </form>
@endsection

@section('scripts')
    <script>
        // Pass room price to JavaScript
        const defaultPrice = {{ $room->price_per_month ?? 793444 }};
    </script>
    <script src="{{ asset('assets/js/cust-info.js') }}"></script>
@endsection
