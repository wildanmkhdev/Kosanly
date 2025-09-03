// Initialize Swiper for date selection
const dateSwiper = new Swiper(".swiper", {
    slidesPerView: "auto",
    spaceBetween: 16,
    slidesOffsetAfter: 24,
    slidesOffsetBefore: 24,
    freeMode: true,
});

// Get DOM elements
const dateContainer = document.querySelector(".select-dates");
const currentDate = new Date();
const availableDates = [];

// Calculate last day of current month
const endOfMonth = new Date(
    currentDate.getFullYear(),
    currentDate.getMonth() + 1,
    0
).getDate();

// Generate date options starting from today
for (let day = currentDate.getDate(); day <= endOfMonth; day++) {
    const dateObj = new Date(
        currentDate.getFullYear(),
        currentDate.getMonth(),
        day
    );
    const monthName = dateObj.toLocaleString("en", { month: "short" });

    // Create ISO date string (YYYY-MM-DD format)
    const isoDateString = new Date(dateObj.getTime() + 24 * 60 * 60 * 1000)
        .toISOString()
        .substring(0, 10);

    availableDates.push(isoDateString);

    // Create date selection element
    const dateElement = `
        <div class="swiper-slide !w-auto py-1">
            <div class="date-option relative flex flex-col items-center justify-center w-auto rounded-2xl p-3 gap-2 bg-white border-2 border-transparent hover:border-[#91BF77] cursor-pointer transition-all duration-300">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span class="font-medium text-sm whitespace-nowrap">${day} ${monthName}</span>
                <input type="radio" name="start_date" value="${isoDateString}" 
                       class="sr-only date-radio" ${
                           day === currentDate.getDate() ? "checked" : ""
                       }>
            </div>
        </div>`;

    dateContainer.insertAdjacentHTML("beforeend", dateElement);
}

// Handle date selection clicks
dateContainer.addEventListener("click", function (event) {
    const dateOption = event.target.closest(".date-option");
    if (dateOption) {
        // Remove active state from all options
        document.querySelectorAll(".date-option").forEach((option) => {
            option.classList.remove(
                "border-[#91BF77]",
                "ring-2",
                "ring-[#91BF77]"
            );
        });

        // Add active state to clicked option
        dateOption.classList.add(
            "border-[#91BF77]",
            "ring-2",
            "ring-[#91BF77]"
        );

        // Check the radio button
        const radioInput = dateOption.querySelector(".date-radio");
        if (radioInput) {
            radioInput.checked = true;
        }
    }
});

// Set initial active state for today's date
document.addEventListener("DOMContentLoaded", function () {
    const checkedRadio = document.querySelector(".date-radio:checked");
    if (checkedRadio) {
        const parentOption = checkedRadio.closest(".date-option");
        if (parentOption) {
            parentOption.classList.add(
                "border-[#91BF77]",
                "ring-2",
                "ring-[#91BF77]"
            );
        }
    }
});

// Duration control elements
const decreaseBtn = document.getElementById("Minus");
const increaseBtn = document.getElementById("Plus");
const durationField = document.getElementById("Duration");
const totalPriceDisplay = document.getElementById("price");
const maximumDuration = 999;

// Update total price calculation
function calculateTotalPrice() {
    const durationValue = parseInt(durationField.value, 10);

    if (
        !isNaN(durationValue) &&
        durationValue >= 1 &&
        durationValue <= maximumDuration
    ) {
        const calculatedTotal = defaultPrice * durationValue;
        totalPriceDisplay.innerHTML = `Rp ${calculatedTotal.toLocaleString(
            "id-ID"
        )}`;
    } else {
        totalPriceDisplay.innerHTML = "Rp 0";
    }
}

// Validate duration input
function sanitizeDurationInput(inputValue) {
    // Remove non-numeric characters and limit to 3 digits
    let cleanValue = inputValue.replace(/[^\d]/g, "").substring(0, 3);

    // Prevent zero values
    if (parseInt(cleanValue, 10) === 0) {
        return "1";
    }

    return cleanValue;
}

// Duration input event handlers
durationField.addEventListener("input", function () {
    let sanitizedValue = sanitizeDurationInput(durationField.value);

    // Allow empty input for user typing
    if (sanitizedValue === "") {
        durationField.value = "";
        totalPriceDisplay.innerHTML = "Rp 0";
        return;
    }

    durationField.value = sanitizedValue;
    calculateTotalPrice();
});

// Handle input blur (when user clicks away)
durationField.addEventListener("blur", function () {
    if (durationField.value === "" || parseInt(durationField.value, 10) === 0) {
        durationField.value = "1";
        calculateTotalPrice();
    }
});

// Decrease duration button
decreaseBtn.addEventListener("click", function () {
    let currentValue = parseInt(durationField.value, 10);

    if (isNaN(currentValue) || currentValue <= 1) {
        currentValue = 1;
    } else {
        currentValue--;
    }

    durationField.value = currentValue;
    calculateTotalPrice();
});

// Increase duration button
increaseBtn.addEventListener("click", function () {
    let currentValue = parseInt(durationField.value, 10);

    if (isNaN(currentValue)) {
        currentValue = 1;
    } else if (currentValue < maximumDuration) {
        currentValue++;
    } else {
        currentValue = maximumDuration;
    }

    durationField.value = currentValue;
    calculateTotalPrice();
});

// Initialize price display
calculateTotalPrice();
