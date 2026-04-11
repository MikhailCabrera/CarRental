<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OrangeCrush Car rentals</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --surface: #ffffff;
            --surface-soft: #f4f6fb;
            --page: #fafafa;
            --text: #09101f;
            --muted: #687287;
            --line: #dde3ec;
            --dark: #06091b;
            --shadow: 0 12px 32px rgba(14, 18, 33, 0.08);
            --radius: 22px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--page);
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
        }

        .hero-banner {
            min-height: 362px;
            position: relative;
            background:
                linear-gradient(rgba(10, 13, 22, 0.52), rgba(10, 13, 22, 0.52)),
                url('https://images.unsplash.com/photo-1553440569-bcc63803a83d?auto=format&fit=crop&w=1800&q=80') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            padding: 48px 20px;
        }

        .hero-inner {
            max-width: 820px;
        }

        .hero-icon {
            width: 44px;
            height: 44px;
            margin: 0 auto 10px;
            opacity: 0.95;
        }

        .hero-banner h1 {
            margin: 0 0 12px;
            font-size: clamp(2.4rem, 6vw, 4rem);
            font-weight: 800;
            letter-spacing: -0.04em;
        }

        .hero-banner p {
            margin: 0;
            font-size: clamp(1rem, 2vw, 1.2rem);
            color: rgba(255, 255, 255, 0.92);
        }

        .page-shell {
            width: min(100%, 1600px);
            margin: 0 auto;
            padding: 0 16px 40px;
        }

        .filter-card {
            margin-top: 14px;
            background: var(--surface);
            border: 1px solid #edf1f6;
            border-radius: 18px;
            box-shadow: var(--shadow);
            padding: 26px;
        }

        .filter-title,
        .section-title {
            margin: 0 0 18px;
            font-size: clamp(1.8rem, 4vw, 2.2rem);
            font-weight: 800;
            letter-spacing: -0.04em;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: 1.2fr 1fr 1fr;
            gap: 16px;
        }

        .filter-field {
            position: relative;
        }

        .filter-field svg {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            color: #8e97a9;
        }

        .filter-control {
            width: 100%;
            height: 44px;
            border: 0;
            border-radius: 12px;
            background: var(--surface-soft);
            padding: 0 16px;
            color: var(--text);
            font-size: 1rem;
        }

        .filter-control.search {
            padding-left: 48px;
        }

        .filter-control:focus {
            outline: 2px solid rgba(9, 16, 31, 0.14);
        }

        .vehicles-section {
            padding-top: 48px;
        }

        .system-section {
            padding-top: 48px;
        }

        .section-subtitle {
            margin: 0 0 28px;
            color: var(--muted);
            font-size: 0.98rem;
        }

        .journey-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 28px;
        }

        .journey-card,
        .role-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 24px;
            box-shadow: var(--shadow);
            padding: 26px;
        }

        .journey-card h3,
        .role-card h3 {
            margin: 0 0 14px;
            font-size: 1.25rem;
            font-weight: 800;
            letter-spacing: -0.03em;
        }

        .journey-list {
            display: grid;
            gap: 14px;
        }

        .journey-step {
            display: grid;
            grid-template-columns: 48px 1fr;
            gap: 14px;
            align-items: start;
            padding: 16px;
            border-radius: 18px;
            background: var(--surface-soft);
        }

        .journey-step-number {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            font-weight: 800;
            color: white;
            background: linear-gradient(135deg, #ff8c3a 0%, #ff6b00 100%);
        }

        .journey-step strong {
            display: block;
            margin-bottom: 4px;
            font-size: 1rem;
        }

        .journey-step p,
        .role-card p {
            margin: 0;
            color: var(--muted);
            line-height: 1.55;
        }

        .module-stack {
            display: grid;
            gap: 12px;
            margin-top: 18px;
        }

        .module-pill {
            display: flex;
            justify-content: space-between;
            gap: 14px;
            align-items: center;
            padding: 14px 16px;
            border-radius: 16px;
            background: linear-gradient(135deg, rgba(255, 122, 24, 0.12) 0%, rgba(255, 122, 24, 0.06) 100%);
            border: 1px solid rgba(255, 122, 24, 0.16);
        }

        .module-pill span {
            font-weight: 800;
        }

        .module-pill small {
            color: var(--muted);
            font-size: 0.85rem;
            text-align: right;
        }

        .vehicle-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 28px;
        }

        .vehicle-card {
            border: 1px solid var(--line);
            border-radius: var(--radius);
            overflow: hidden;
            background: var(--surface);
            box-shadow: 0 2px 8px rgba(16, 24, 40, 0.03);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .vehicle-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 34px rgba(16, 24, 40, 0.08);
        }

        .vehicle-media {
            position: relative;
            aspect-ratio: 16 / 10;
            background: #dfe5ef;
            overflow: hidden;
        }

        .vehicle-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .vehicle-pill {
            position: absolute;
            top: 14px;
            right: 14px;
            background: #080b1d;
            color: white;
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 0.95rem;
            font-weight: 700;
            line-height: 1;
        }

        .vehicle-body {
            padding: 22px 20px 18px;
        }

        .vehicle-name {
            margin: 0;
            font-size: 1.02rem;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .vehicle-brand {
            margin-top: 6px;
            color: var(--muted);
            font-size: 0.96rem;
        }

        .vehicle-specs {
            display: flex;
            flex-wrap: wrap;
            gap: 18px;
            margin-top: 16px;
            color: var(--muted);
            font-size: 0.95rem;
        }

        .vehicle-spec {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .vehicle-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 16px;
        }

        .vehicle-tag {
            background: #eef2f8;
            color: var(--dark);
            border-radius: 999px;
            padding: 7px 12px;
            font-size: 0.88rem;
            font-weight: 700;
            line-height: 1;
        }

        .vehicle-footer {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 16px;
            margin-top: 34px;
        }

        .vehicle-price {
            font-size: 1.3rem;
            font-weight: 800;
            letter-spacing: -0.03em;
        }

        .vehicle-price small {
            display: block;
            margin-top: 2px;
            color: var(--muted);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .book-btn {
            border: 0;
            background: var(--dark);
            color: white;
            border-radius: 14px;
            padding: 14px 22px;
            font-size: 0.95rem;
            font-weight: 800;
            line-height: 1;
            text-decoration: none;
        }

        .book-btn:hover {
            background: #141a34;
            color: white;
        }

        .hidden-card {
            display: none;
        }

        @media (max-width: 1100px) {
            .vehicle-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 820px) {
            .filter-grid,
            .vehicle-grid {
                grid-template-columns: 1fr;
            }

            .hero-banner {
                min-height: 280px;
            }

            .filter-card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <section class="hero-banner">
        <div class="hero-inner">
            <svg class="hero-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M3 13l1.5-4.5A3 3 0 0 1 7.35 6h9.3a3 3 0 0 1 2.85 2.5L21 13"></path>
                <path d="M5 16h14"></path>
                <path d="M6 16v2a1 1 0 0 0 1 1h1"></path>
                <path d="M16 19h1a1 1 0 0 0 1-1v-2"></path>
                <circle cx="7.5" cy="15.5" r="1.5"></circle>
                <circle cx="16.5" cy="15.5" r="1.5"></circle>
            </svg>
            <h1>OrangeCrush Car rentals</h1>
            <p>Find the perfect vehicle for your journey</p>
        </div>
    </section>

    <main class="page-shell">
        <section class="filter-card" id="fleet">
            <h2 class="filter-title">Search &amp; Filter</h2>
            <div class="filter-grid">
                <div class="filter-field">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="11" cy="11" r="7"></circle>
                        <path d="M20 20l-3.5-3.5"></path>
                    </svg>
                    <input class="filter-control search" id="vehicleSearch" type="text" placeholder="Search by car name or brand...">
                </div>
                <div class="filter-field">
                    <select class="filter-control" id="typeFilter">
                        <option value="">All Types</option>
                        @foreach($vehicles->pluck('type')->unique()->values() as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-field">
                    <select class="filter-control" id="transmissionFilter">
                        <option value="">All Transmissions</option>
                        @foreach($vehicles->pluck('transmission')->unique()->values() as $transmission)
                            <option value="{{ $transmission }}">{{ $transmission }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </section>

        <section class="vehicles-section">
            <h2 class="section-title">Available Vehicles</h2>
            <p class="section-subtitle"><span id="vehicleCount">{{ $vehicles->count() }}</span> vehicles available</p>

            <div class="vehicle-grid" id="vehicleGrid">
                @foreach($vehicles as $vehicle)
                    <article
                        class="vehicle-card"
                        data-name="{{ strtolower($vehicle['name']) }}"
                        data-brand="{{ strtolower($vehicle['brand']) }}"
                        data-type="{{ strtolower($vehicle['type']) }}"
                        data-transmission="{{ strtolower($vehicle['transmission']) }}"
                    >
                        <div class="vehicle-media">
                            <img src="{{ $vehicle['image'] }}" alt="{{ $vehicle['name'] }}">
                            <span class="vehicle-pill">{{ $vehicle['type'] }}</span>
                        </div>

                        <div class="vehicle-body">
                            <h3 class="vehicle-name">{{ $vehicle['name'] }}</h3>
                            <div class="vehicle-brand">{{ $vehicle['brand'] }}</div>

                            <div class="vehicle-specs">
                                <span class="vehicle-spec">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    {{ $vehicle['seats'] }} seats
                                </span>
                                <span class="vehicle-spec">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M13 2L3 14h7l-1 8 10-12h-7z"></path>
                                    </svg>
                                    {{ $vehicle['transmission'] }}
                                </span>
                                <span class="vehicle-spec">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M14 3h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2"></path>
                                        <path d="M12 12v6"></path>
                                        <path d="M9 15h6"></path>
                                        <path d="M10 3h4v4h-4z"></path>
                                    </svg>
                                    {{ $vehicle['fuel'] }}
                                </span>
                            </div>

                            <div class="vehicle-tags">
                                @foreach($vehicle['features'] as $feature)
                                    <span class="vehicle-tag">{{ $feature }}</span>
                                @endforeach
                            </div>

                            <div class="vehicle-footer">
                                <div class="vehicle-price">
                                    PHP {{ number_format($vehicle['price'], 0) }}
                                    <small>per day</small>
                                </div>
                                <a class="book-btn" href="/reservation?vehicle={{ $vehicle['id'] }}">Book Now</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

    </main>
    <script>
        const searchInput = document.getElementById('vehicleSearch');
        const typeFilter = document.getElementById('typeFilter');
        const transmissionFilter = document.getElementById('transmissionFilter');
        const vehicleCards = Array.from(document.querySelectorAll('.vehicle-card'));
        const vehicleCount = document.getElementById('vehicleCount');

        function formatPeso(amount) {
            return `PHP ${Number(amount).toLocaleString('en-PH', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            })}`;
        }

        function filterVehicles() {
            const query = searchInput.value.trim().toLowerCase();
            const type = typeFilter.value.trim().toLowerCase();
            const transmission = transmissionFilter.value.trim().toLowerCase();

            let visibleCount = 0;

            vehicleCards.forEach((card) => {
                const matchesQuery =
                    !query ||
                    card.dataset.name.includes(query) ||
                    card.dataset.brand.includes(query);
                const matchesType = !type || card.dataset.type === type;
                const matchesTransmission = !transmission || card.dataset.transmission === transmission;
                const visible = matchesQuery && matchesType && matchesTransmission;

                card.classList.toggle('hidden-card', !visible);
                if (visible) visibleCount += 1;
            });

            vehicleCount.textContent = visibleCount;
        }

        searchInput.addEventListener('input', filterVehicles);
        typeFilter.addEventListener('change', filterVehicles);
        transmissionFilter.addEventListener('change', filterVehicles);
    </script>
</body>
</html>
