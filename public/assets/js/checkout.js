// Initialize Swiper for date selection
const dateSwiper = new Swiper(".swiper", {
    slidesPerView: "auto",
    spaceBetween: 14,
    slidesOffsetAfter: 20,
    slidesOffsetBefore: 20,
    freeMode: true,
});

// Get DOM elements
const dateContainer = document.querySelector(".select-dates");
const currentDate = new Date();
const availableDates = [];

// Ensure all elements are loaded before proceeding
document.addEventListener("DOMContentLoaded", function () {
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
        const monthName = dateObj.toLocaleString("default", { month: "short" });

        // Create ISO date string (YYYY-MM-DD format)
        const isoDateString = new Date(dateObj.getTime() + 24 * 60 * 60 * 1000)
            .toISOString()
            .substring(0, 10);

        availableDates.push(isoDateString);

        // Create date selection element
        const dateElement = `
            <div class="swiper-slide !w-fit py-[2px]">
                <label class="date-option relative flex flex-col items-center justify-center w-fit rounded-3xl p-[14px_20px] gap-3 bg-white border border-white hover:border-[#91BF77] has-[:checked]:ring-2 has-[:checked]:ring-[#91BF77] transition-all duration-300 cursor-pointer">
                    <img src="{{ asset('assets/images/icons/calendar.svg') }}" class="w-8 h-8" alt="calendar">
                    <p class="font-semibold text-nowrap">${day} ${monthName}</p>
                    <input type="radio" name="start_date" value="${isoDateString}" 
                           class="absolute top-1/2 left-1/2 opacity-0" ${
                               day === currentDate.getDate() ? "checked" : ""
                           } required>
                </label>
            </div>`;

        if (dateContainer) {
            dateContainer.insertAdjacentHTML("beforeend", dateElement);
        }
    }

    // Initialize Swiper after content is added
    if (dateSwiper) {
        dateSwiper.update();
    }

    // Set initial active state for today's date
    const checkedRadio = document.querySelector(
        'input[name="start_date"]:checked'
    );
    if (checkedRadio) {
        const parentLabel = checkedRadio.closest(".date-option");
        if (parentLabel) {
            parentLabel.classList.add(
                "border-[#91BF77]",
                "ring-2",
                "ring-[#91BF77]"
            );
        }
    }
});

// Handle date selection clicks
document.addEventListener("click", function (event) {
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
        const radioInput = dateOption.querySelector('input[name="start_date"]');
        if (radioInput) {
            radioInput.checked = true;
        }
    }
});

// Duration control elements
const decreaseBtn = document.getElementById("Minus");
const increaseBtn = document.getElementById("Plus");
const durationField = document.getElementById("Duration");
const totalPriceDisplay = document.getElementById("price");
const maximumDuration = 999;

// Check if defaultPrice is defined, if not use fallback
const roomPrice = typeof defaultPrice !== "undefined" ? defaultPrice : 793444;

// Update total price calculation
function calculateTotalPrice() {
    const durationValue = parseInt(durationField.value, 10);

    if (
        !isNaN(durationValue) &&
        durationValue >= 1 &&
        durationValue <= maximumDuration
    ) {
        const calculatedTotal = roomPrice * durationValue;
        if (totalPriceDisplay) {
            totalPriceDisplay.innerHTML = `Rp ${calculatedTotal.toLocaleString(
                "id-ID"
            )}`;
        }
    } else {
        if (totalPriceDisplay) {
            totalPriceDisplay.innerHTML = "Rp 0";
        }
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
if (durationField) {
    durationField.addEventListener("input", function () {
        let sanitizedValue = sanitizeDurationInput(durationField.value);

        // Allow empty input for user typing
        if (sanitizedValue === "") {
            durationField.value = "";
            if (totalPriceDisplay) {
                totalPriceDisplay.innerHTML = "Rp 0";
            }
            return;
        }

        durationField.value = sanitizedValue;
        calculateTotalPrice();
    });

    // Handle input blur (when user clicks away)
    durationField.addEventListener("blur", function () {
        if (
            durationField.value === "" ||
            parseInt(durationField.value, 10) === 0
        ) {
            durationField.value = "1";
            calculateTotalPrice();
        }
    });
}

// Decrease duration button
if (decreaseBtn) {
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
}

// Increase duration button
if (increaseBtn) {
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
}

// Initialize price display when page loads
document.addEventListener("DOMContentLoaded", function () {
    // Small delay to ensure all elements are rendered
    setTimeout(() => {
        calculateTotalPrice();
    }, 100);
});
