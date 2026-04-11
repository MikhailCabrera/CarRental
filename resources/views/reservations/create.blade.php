<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OrangeCrush Car Rental | Booking Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --page: #fbfbfc;
            --surface: #ffffff;
            --line: #e6e8ef;
            --soft: #f3f4f7;
            --text: #0a1020;
            --muted: #72788b;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--page);
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
        }

        .page-shell {
            max-width: 1440px;
            margin: 0 auto;
            padding: 24px;
        }

        .booking-layout {
            display: grid;
            grid-template-columns: minmax(0, 1.8fr) minmax(320px, 0.85fr);
            gap: 34px;
            align-items: start;
        }

        .panel {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 22px;
        }

        .form-panel {
            padding: 24px 28px 20px;
        }

        .summary-panel {
            padding: 24px;
            position: sticky;
            top: 24px;
        }

        .panel-title {
            margin: 0 0 28px;
            font-size: 1rem;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .group {
            margin-top: 10px;
        }

        .group + .group {
            margin-top: 32px;
        }

        .group-title {
            margin: 0 0 16px;
            font-size: 1.05rem;
            font-weight: 800;
            letter-spacing: -0.03em;
        }

        .fields {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px 16px;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        .field label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.95rem;
            font-weight: 700;
        }

        .field input {
            width: 100%;
            height: 40px;
            border: 1px solid var(--line);
            border-radius: 12px;
            background: var(--soft);
            padding: 0 14px;
            font-size: 0.95rem;
        }

        .field input:focus {
            outline: 2px solid rgba(10, 16, 32, 0.12);
            background: #fff;
        }

        .confirm-btn {
            width: 100%;
            margin-top: 24px;
            height: 50px;
            border: 0;
            border-radius: 12px;
            background: #8c8a95;
            color: white;
            font-size: 0.98rem;
            font-weight: 800;
            transition: background 0.2s ease;
        }

        .confirm-btn.ready {
            background: #0d6efd;
        }

        .confirm-btn.ready:hover {
            background: #0b5ed7;
        }

        .summary-image {
            width: 100%;
            aspect-ratio: 16 / 9;
            border-radius: 16px;
            object-fit: cover;
            display: block;
            margin-bottom: 18px;
        }

        .summary-name {
            margin: 0;
            font-size: 0.98rem;
            font-weight: 800;
            letter-spacing: -0.03em;
        }

        .summary-brand {
            margin-top: 4px;
            color: var(--muted);
            font-size: 0.92rem;
        }

        .summary-specs {
            display: grid;
            gap: 10px;
            margin: 18px 0 18px;
        }

        .summary-spec {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--muted);
            font-size: 0.92rem;
        }

        .divider {
            margin: 18px 0;
            border: 0;
            border-top: 1px solid var(--line);
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            color: var(--muted);
            font-size: 0.94rem;
            margin-bottom: 10px;
        }

        .summary-row strong {
            color: var(--text);
            font-weight: 700;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1rem;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .feature-title {
            margin-bottom: 12px;
            font-size: 0.95rem;
            font-weight: 800;
        }

        .feature-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .feature-pill {
            display: inline-flex;
            padding: 7px 11px;
            border-radius: 999px;
            background: #eef2f7;
            font-size: 0.84rem;
            font-weight: 700;
            line-height: 1;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 18px;
            color: var(--muted);
            text-decoration: none;
            font-weight: 700;
        }

        @media (max-width: 960px) {
            .booking-layout,
            .fields {
                grid-template-columns: 1fr;
            }

            .summary-panel {
                position: static;
            }
        }
    </style>
</head>
<body>
    <div class="page-shell">
        <a class="back-link" href="/">← Back to Vehicles</a>

        <div class="booking-layout">
            <section class="panel form-panel">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Please complete the booking form correctly.</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h3 class="panel-title">Booking Details</h3>

                <form method="POST" action="/reservation" id="reservationForm">
                    @csrf
                    <input type="hidden" name="vehicle_id" value="{{ $vehicle['id'] }}">

                    <div class="group">
                        <h4 class="group-title">Personal Information</h4>
                        <div class="fields">
                            <div class="field">
                                <label for="firstName">First Name *</label>
                                <input id="firstName" name="first_name" type="text" value="{{ old('first_name') }}" data-required-booking="true">
                            </div>
                            <div class="field">
                                <label for="lastName">Last Name *</label>
                                <input id="lastName" name="last_name" type="text" value="{{ old('last_name') }}" data-required-booking="true">
                            </div>
                            <div class="field">
                                <label for="email">Email *</label>
                                <input id="email" name="email" type="email" value="{{ old('email') }}" data-required-booking="true">
                            </div>
                            <div class="field">
                                <label for="phoneNumber">Phone Number *</label>
                                <input id="phoneNumber" name="phone_number" type="text" value="{{ old('phone_number') }}" data-required-booking="true">
                            </div>
                            <div class="field full">
                                <label for="licenseNumber">Driver's License Number *</label>
                                <input id="licenseNumber" name="license_number" type="text" value="{{ old('license_number') }}" data-required-booking="true">
                            </div>
                        </div>
                    </div>

                    <div class="group">
                        <h4 class="group-title">Rental Period</h4>
                        <div class="fields">
                            <div class="field">
                                <label for="pickupDate">Pick-up Date *</label>
                                <input id="pickupDate" name="pickup_date" type="date" min="{{ $today->toDateString() }}" value="{{ $defaultPickupDate }}" data-required-booking="true">
                            </div>
                            <div class="field">
                                <label for="returnDate">Return Date *</label>
                                <input id="returnDate" name="return_date" type="date" min="{{ $defaultReturnDate }}" value="{{ $defaultReturnDate }}" data-required-booking="true">
                            </div>
                        </div>
                    </div>

                    <div class="group">
                        <h4 class="group-title">Payment Information</h4>
                        <div class="fields">
                            <div class="field">
                                <label for="cardNumber">Card Number *</label>
                                <input id="cardNumber" name="card_number" type="text" value="{{ old('card_number') }}" data-required-booking="true">
                            </div>
                            <div class="field">
                                <label for="cardholderName">Cardholder Name *</label>
                                <input id="cardholderName" name="cardholder_name" type="text" value="{{ old('cardholder_name') }}" data-required-booking="true">
                            </div>
                            <div class="field">
                                <label for="expiryDate">Expiry Date (MM/YY) *</label>
                                <input id="expiryDate" name="expiry_date" type="text" value="{{ old('expiry_date') }}" data-required-booking="true">
                            </div>
                            <div class="field">
                                <label for="cvv">CVV *</label>
                                <input id="cvv" name="cvv" type="text" value="{{ old('cvv') }}" data-required-booking="true">
                            </div>
                        </div>
                    </div>

                </form>
            </section>

            <aside class="panel summary-panel">
                <h3 class="panel-title">Booking Summary</h3>
                <img class="summary-image" src="{{ $vehicle['image'] }}" alt="{{ $vehicle['name'] }}">

                <h4 class="summary-name">{{ $vehicle['name'] }}</h4>
                <div class="summary-brand">{{ $vehicle['brand'] }}</div>

                <div class="summary-specs">
                    <div class="summary-spec">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                        </svg>
                        {{ $vehicle['seats'] }} seats
                    </div>
                    <div class="summary-spec">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M13 2L3 14h7l-1 8 10-12h-7z"></path>
                        </svg>
                        {{ $vehicle['transmission'] }}
                    </div>
                    <div class="summary-spec">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M14 3h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2"></path>
                            <path d="M12 12v6"></path>
                            <path d="M9 15h6"></path>
                            <path d="M10 3h4v4h-4z"></path>
                        </svg>
                        {{ $vehicle['fuel'] }}
                    </div>
                </div>

                <hr class="divider">

                <div class="summary-row">
                    <span>Rate per day</span>
                    <strong>PHP {{ number_format($vehicle['price'], 0) }}</strong>
                </div>
                <div class="summary-row">
                    <span>Number of days</span>
                    <strong id="numberOfDays">1</strong>
                </div>

                <hr class="divider">

                <div class="summary-total">
                    <span>Total</span>
                    <span id="bookingTotal">PHP {{ number_format($vehicle['price'], 0) }}</span>
                </div>

                <div class="feature-title">Features</div>
                <div class="feature-list">
                    @foreach($vehicle['features'] as $feature)
                        <span class="feature-pill">{{ $feature }}</span>
                    @endforeach
                </div>

                <button class="confirm-btn" type="submit" form="reservationForm">Confirm Booking</button>
            </aside>
        </div>
    </div>

    <script>
        const pickupDate = document.getElementById('pickupDate');
        const returnDate = document.getElementById('returnDate');
        const numberOfDays = document.getElementById('numberOfDays');
        const bookingTotal = document.getElementById('bookingTotal');
        const dailyRate = {{ (float) $vehicle['price'] }};
        const reservationForm = document.getElementById('reservationForm');
        const confirmButton = document.querySelector('.confirm-btn');

        function formatPeso(amount) {
            return `PHP ${Number(amount).toLocaleString('en-PH', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            })}`;
        }

        function updateSummaryTotal() {
            let days = 1;

            if (pickupDate.value) {
                returnDate.min = pickupDate.value;

                if (returnDate.value && returnDate.value <= pickupDate.value) {
                    const nextDay = new Date(pickupDate.value);
                    nextDay.setDate(nextDay.getDate() + 1);
                    returnDate.value = nextDay.toISOString().split('T')[0];
                }
            }

            if (pickupDate.value && returnDate.value) {
                const start = new Date(pickupDate.value);
                const end = new Date(returnDate.value);
                const diff = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
                if (diff > 0) {
                    days = diff;
                }
            }

            numberOfDays.textContent = days;
            bookingTotal.textContent = formatPeso(Math.round(dailyRate * days));
        }

        function updateConfirmButtonState() {
            const requiredFields = Array.from(reservationForm.querySelectorAll('[data-required-booking="true"]'));
            const isComplete = requiredFields.every((field) => field.value.trim() !== '');
            confirmButton.classList.toggle('ready', isComplete);
        }

        pickupDate.addEventListener('change', updateSummaryTotal);
        returnDate.addEventListener('change', updateSummaryTotal);
        reservationForm.addEventListener('input', updateConfirmButtonState);
        reservationForm.addEventListener('change', updateConfirmButtonState);
        updateSummaryTotal();
        updateConfirmButtonState();
    </script>
</body>
</html>
