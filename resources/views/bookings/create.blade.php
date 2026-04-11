<!DOCTYPE html>
<html>
<head>
    <title>Create Booking Reservation</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .booking-wizard {
            max-width: 920px;
        }

        .wizard-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 18px;
        }

        .wizard-top p {
            margin: 8px 0 0;
            color: var(--text-muted);
        }

        .wizard-steps {
            margin-bottom: 28px;
        }

        .wizard-steps .pagination {
            margin: 0;
            flex-wrap: wrap;
            gap: 10px;
        }

        .wizard-steps .page-item .page-link {
            border-radius: 999px;
            border: 1px solid var(--border);
            color: var(--text-muted);
            padding: 10px 16px;
            min-width: 120px;
            text-align: center;
            background: #fff;
            box-shadow: none;
        }

        .wizard-steps .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
        }

        .wizard-steps .page-item.completed .page-link {
            background: rgba(79, 70, 229, 0.1);
            border-color: rgba(79, 70, 229, 0.2);
            color: var(--primary);
        }

        .wizard-panel {
            display: none;
        }

        .wizard-panel.active {
            display: block;
        }

        .wizard-panel h2 {
            margin: 0 0 8px;
            font-size: 1.35rem;
        }

        .wizard-panel p {
            margin: 0 0 22px;
            color: var(--text-muted);
        }

        .wizard-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .wizard-grid .form-group.full {
            grid-column: 1 / -1;
        }

        .summary-box {
            display: grid;
            gap: 14px;
            margin-top: 18px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 14px 16px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: #f8fafc;
        }

        .summary-label {
            color: var(--text-muted);
            font-weight: 600;
        }

        .summary-value {
            text-align: right;
            font-weight: 700;
        }

        .wizard-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-top: 26px;
        }

        .wizard-actions-right {
            display: flex;
            gap: 12px;
        }

        @media (max-width: 768px) {
            .wizard-grid {
                grid-template-columns: 1fr;
            }

            .wizard-actions,
            .wizard-actions-right,
            .wizard-top {
                flex-direction: column;
                align-items: stretch;
            }

            .wizard-steps .page-item .page-link {
                min-width: 0;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Car Rental</h2>
        <nav>
            <a href="/dashboard">Dashboard</a>
            <a href="/rental-costs">Vehicles</a>
            <a href="/categories">Brands</a>
            <a href="/customers">Customers</a>
            <a href="/bookings" class="active">Bookings</a>
            <a href="/transactions">Transactions</a>
            <a href="/maintenances">Maintenance</a>
            <a href="/employee">Employees</a>
        </nav>
    </div>

    <div class="main-content">
        <div class="page-header">
            <a href="/" class="btn-back">← Back</a>
            <h1>Create Booking Reservation</h1>
        </div>

        <div class="card booking-wizard">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Please complete the reservation form correctly.</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="wizard-top">
                <div>
                    <h2 style="margin: 0;">Step-by-step reservation</h2>
                    <p>Use the steps below to complete the booking reservation form.</p>
                </div>
                <span class="badge text-bg-warning">Bootstrap Pagination Wizard</span>
            </div>

            <div class="wizard-steps">
                <ul class="pagination" id="wizardPagination">
                    <li class="page-item active" data-step="0"><span class="page-link">1. Customer</span></li>
                    <li class="page-item" data-step="1"><span class="page-link">2. Vehicle</span></li>
                    <li class="page-item" data-step="2"><span class="page-link">3. Schedule</span></li>
                    <li class="page-item" data-step="3"><span class="page-link">4. Review</span></li>
                </ul>
            </div>

            <form action="/bookings" method="POST" id="bookingWizardForm">
                @csrf

                <section class="wizard-panel active" data-step-panel="0">
                    <h2>Customer Information</h2>
                    <p>Select the customer who will make the reservation.</p>

                    <div class="wizard-grid">
                        <div class="form-group full">
                            <label for="customer_id">Customer</label>
                            <select name="customer_id" id="customer_id" required>
                                <option value="">Choose a customer</option>
                                @foreach($customers as $c)
                                    <option value="{{ $c->id }}" {{ old('customer_id') == $c->id ? 'selected' : '' }}>
                                        {{ $c->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </section>

                <section class="wizard-panel" data-step-panel="1">
                    <h2>Vehicle Selection</h2>
                    <p>Choose the car to reserve for this booking.</p>

                    <div class="wizard-grid">
                        <div class="form-group full">
                            <label for="vehicle_id">Vehicle</label>
                            <select name="vehicle_id" id="vehicle_id" required>
                                <option value="">Choose a vehicle</option>
                                @foreach($vehicles as $v)
                                    <option value="{{ $v->id }}" {{ old('vehicle_id') == $v->id ? 'selected' : '' }}>
                                        {{ $v->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </section>

                <section class="wizard-panel" data-step-panel="2">
                    <h2>Rental Schedule</h2>
                    <p>Provide the pickup date, return date, and rental rate.</p>

                    <div class="wizard-grid">
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="datetime-local" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="datetime-local" id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                        </div>

                        <div class="form-group full">
                            <label for="rental_rate">Rental Rate (PHP)</label>
                            <input type="number" id="rental_rate" name="rental_rate" step="0.01" min="0" value="{{ old('rental_rate') }}" required>
                        </div>
                    </div>
                </section>

                <section class="wizard-panel" data-step-panel="3">
                    <h2>Review Reservation</h2>
                    <p>Check the entered details before submitting the reservation.</p>

                    <div class="summary-box">
                        <div class="summary-item">
                            <span class="summary-label">Customer</span>
                            <span class="summary-value" id="summaryCustomer">Not selected</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Vehicle</span>
                            <span class="summary-value" id="summaryVehicle">Not selected</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Start Date</span>
                            <span class="summary-value" id="summaryStart">Not set</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">End Date</span>
                            <span class="summary-value" id="summaryEnd">Not set</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Rental Rate</span>
                            <span class="summary-value" id="summaryRate">Not set</span>
                        </div>
                    </div>
                </section>

                <div class="wizard-actions">
                    <a href="/bookings" class="btn-secondary">Cancel</a>

                    <div class="wizard-actions-right">
                        <button type="button" class="btn-secondary" id="prevBtn" style="display:none;">Previous</button>
                        <button type="button" class="btn-primary" id="nextBtn">Next Step</button>
                        <button type="submit" class="btn-primary" id="submitBtn" style="display:none;">Submit Reservation</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        const panels = Array.from(document.querySelectorAll('[data-step-panel]'));
        const steps = Array.from(document.querySelectorAll('#wizardPagination .page-item'));
        const nextBtn = document.getElementById('nextBtn');
        const prevBtn = document.getElementById('prevBtn');
        const submitBtn = document.getElementById('submitBtn');
        const form = document.getElementById('bookingWizardForm');
        let currentStep = 0;

        function formatDate(value) {
            if (!value) return 'Not set';
            const date = new Date(value);
            if (Number.isNaN(date.getTime())) return value;
            return date.toLocaleString();
        }

        function updateSummary() {
            const customer = document.getElementById('customer_id');
            const vehicle = document.getElementById('vehicle_id');
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;
            const rate = document.getElementById('rental_rate').value;

            document.getElementById('summaryCustomer').textContent = customer.options[customer.selectedIndex]?.text || 'Not selected';
            document.getElementById('summaryVehicle').textContent = vehicle.options[vehicle.selectedIndex]?.text || 'Not selected';
            document.getElementById('summaryStart').textContent = formatDate(startDate);
            document.getElementById('summaryEnd').textContent = formatDate(endDate);
            document.getElementById('summaryRate').textContent = rate ? `PHP ${Number(rate).toFixed(2)}` : 'Not set';
        }

        function setStep(stepIndex) {
            currentStep = stepIndex;

            panels.forEach((panel, index) => {
                panel.classList.toggle('active', index === stepIndex);
            });

            steps.forEach((step, index) => {
                step.classList.toggle('active', index === stepIndex);
                step.classList.toggle('completed', index < stepIndex);
            });

            prevBtn.style.display = stepIndex === 0 ? 'none' : 'inline-flex';
            nextBtn.style.display = stepIndex === panels.length - 1 ? 'none' : 'inline-flex';
            submitBtn.style.display = stepIndex === panels.length - 1 ? 'inline-flex' : 'none';

            if (stepIndex === panels.length - 1) {
                updateSummary();
            }
        }

        function validateCurrentStep() {
            const currentPanel = panels[currentStep];
            const inputs = Array.from(currentPanel.querySelectorAll('input, select'));

            for (const input of inputs) {
                if (!input.checkValidity()) {
                    input.reportValidity();
                    return false;
                }
            }

            return true;
        }

        nextBtn.addEventListener('click', () => {
            if (!validateCurrentStep()) return;
            setStep(Math.min(currentStep + 1, panels.length - 1));
        });

        prevBtn.addEventListener('click', () => {
            setStep(Math.max(currentStep - 1, 0));
        });

        form.addEventListener('submit', (event) => {
            if (!validateCurrentStep()) {
                event.preventDefault();
            }
        });

        document.getElementById('customer_id').addEventListener('change', updateSummary);
        document.getElementById('vehicle_id').addEventListener('change', updateSummary);
        document.getElementById('start_date').addEventListener('input', updateSummary);
        document.getElementById('end_date').addEventListener('input', updateSummary);
        document.getElementById('rental_rate').addEventListener('input', updateSummary);

        setStep(0);
    </script>
</body>
</html>
