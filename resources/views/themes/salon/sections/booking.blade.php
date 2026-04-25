@php
    $bookingSetting = $site->bookingSetting;
    $bookingEnabled = $bookingSetting?->is_enabled ?? false;
    $isOwner        = auth()->check() && auth()->id() === $site->user_id;
@endphp

@if ($bookingEnabled || $isOwner)
<section id="booking" class="section-wrap section-light">
    <div class="section-inner">
        <div class="section-heading">
            <h2>Reserva tu cita</h2>
            <div class="heading-line"></div>
        </div>

        @if (!$bookingEnabled && $isOwner)
            <p style="text-align:center;color:var(--on-surface-muted);">
                Activa las reservas desde el panel de edición para que los clientes puedan reservar.
            </p>
        @else
            <div id="booking-widget"
                 data-slug="{{ $site->slug }}"
                 data-advance="{{ $bookingSetting->advance_booking_days }}"
                 data-working-days="{{ json_encode($bookingSetting->working_days) }}">
                {{-- Renderizado por JS --}}
            </div>
        @endif
    </div>
</section>

<script>
(function () {
    const widget = document.getElementById('booking-widget');
    if (!widget) return;

    const SLUG         = widget.dataset.slug;
    const ADVANCE      = parseInt(widget.dataset.advance);
    const WORKING_DAYS = JSON.parse(widget.dataset.workingDays);
    const DAY_KEYS     = ['sun','mon','tue','wed','thu','fri','sat'];

    let selectedDate = null;
    let selectedTime = null;

    // ── Render calendar ──────────────────────────────────────────
    function buildCalendar() {
        const today   = new Date();
        const maxDate = new Date(); maxDate.setDate(today.getDate() + ADVANCE);

        widget.innerHTML = `
            <div id="bw-calendar" style="max-width:480px;margin:0 auto;">
                <div id="bw-weeks" style="display:grid;grid-template-columns:repeat(7,1fr);gap:.35rem;margin-bottom:1.5rem;"></div>
            </div>
            <div id="bw-slots" style="max-width:480px;margin:0 auto;"></div>
            <div id="bw-form"  style="max-width:480px;margin:0 auto;display:none;"></div>
        `;

        const grid = document.getElementById('bw-weeks');

        ['L','M','X','J','V','S','D'].forEach(d => {
            const h = document.createElement('div');
            h.textContent = d;
            h.style.cssText = 'text-align:center;font-size:.7rem;font-weight:700;color:var(--on-surface-muted);padding-bottom:.25rem;';
            grid.appendChild(h);
        });

        const startDay = new Date(today);
        const dow = (today.getDay() + 6) % 7; // 0=lun
        startDay.setDate(today.getDate() - dow);

        for (let i = 0; i < ADVANCE + 7; i++) {
            const d = new Date(startDay);
            d.setDate(startDay.getDate() + i);
            if (d < today || d > maxDate) {
                const empty = document.createElement('div'); grid.appendChild(empty);
                continue;
            }
            const key     = DAY_KEYS[d.getDay()];
            const isWork  = WORKING_DAYS.includes(key);
            const dateStr = d.toISOString().split('T')[0];
            const btn     = document.createElement('button');
            btn.type       = 'button';
            btn.textContent = d.getDate();
            btn.dataset.date = dateStr;
            btn.style.cssText = `
                border:2px solid ${isWork ? 'var(--primary)' : 'var(--outline)'};
                background:transparent;
                color:${isWork ? 'var(--primary)' : 'var(--on-surface-muted)'};
                border-radius:8px;padding:.4rem 0;font-size:.85rem;
                cursor:${isWork ? 'pointer' : 'default'};
                font-family:inherit;font-weight:600;transition:all .15s;
            `;
            if (isWork) btn.addEventListener('click', () => selectDate(dateStr, btn));
            grid.appendChild(btn);
        }
    }

    function selectDate(dateStr, btn) {
        selectedDate = dateStr;
        selectedTime = null;
        document.querySelectorAll('#bw-weeks button').forEach(b => b.style.background = 'transparent');
        btn.style.background = 'var(--primary)';
        btn.style.color      = 'var(--text-on-primary)';

        const slotsEl = document.getElementById('bw-slots');
        slotsEl.innerHTML = '<p style="text-align:center;color:var(--on-surface-muted);font-size:.85rem;margin:1rem 0;">Cargando horarios…</p>';
        document.getElementById('bw-form').style.display = 'none';

        fetch(`/site/${SLUG}/booking/slots?date=${dateStr}`)
            .then(r => r.json())
            .then(({ slots }) => renderSlots(slots));
    }

    function renderSlots(slots) {
        const el = document.getElementById('bw-slots');
        if (!slots.length) {
            el.innerHTML = '<p style="text-align:center;color:var(--on-surface-muted);font-size:.85rem;margin:1rem 0;">Sin disponibilidad este día.</p>';
            return;
        }
        el.innerHTML = '<div style="display:flex;flex-wrap:wrap;gap:.5rem;justify-content:center;margin-bottom:1.5rem;">' +
            slots.map(t => `<button type="button" class="slot-btn" data-time="${t}"
                style="padding:.45rem 1rem;border:2px solid var(--primary);background:transparent;color:var(--primary);
                border-radius:999px;font-size:.85rem;cursor:pointer;font-family:inherit;font-weight:600;transition:all .15s;">
                ${t}</button>`).join('') + '</div>';

        el.querySelectorAll('.slot-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                el.querySelectorAll('.slot-btn').forEach(b => { b.style.background='transparent'; b.style.color='var(--primary)'; });
                btn.style.background = 'var(--primary)';
                btn.style.color      = 'var(--text-on-primary)';
                selectedTime = btn.dataset.time;
                renderForm();
            });
        });
    }

    function renderForm() {
        const formEl = document.getElementById('bw-form');
        formEl.style.display = 'block';
        formEl.innerHTML = `
            <div style="background:var(--surface-high);border:1px solid var(--outline);border-radius:12px;padding:1.5rem;margin-top:.5rem;">
                <p style="font-weight:700;margin-bottom:1rem;color:var(--on-surface);">
                    Cita el ${selectedDate} a las ${selectedTime}
                </p>
                <div style="display:grid;gap:.75rem;">
                    <input id="bw-name"  type="text"  placeholder="Nombre *"  style="padding:.65rem 1rem;border:1px solid var(--outline);border-radius:8px;font-family:inherit;font-size:.9rem;width:100%;box-sizing:border-box;">
                    <input id="bw-email" type="email" placeholder="Email *"   style="padding:.65rem 1rem;border:1px solid var(--outline);border-radius:8px;font-family:inherit;font-size:.9rem;width:100%;box-sizing:border-box;">
                    <input id="bw-phone" type="tel"   placeholder="Teléfono"  style="padding:.65rem 1rem;border:1px solid var(--outline);border-radius:8px;font-family:inherit;font-size:.9rem;width:100%;box-sizing:border-box;">
                    <textarea id="bw-notes" placeholder="Notas (opcional)" rows="2"
                        style="padding:.65rem 1rem;border:1px solid var(--outline);border-radius:8px;font-family:inherit;font-size:.9rem;width:100%;box-sizing:border-box;resize:vertical;"></textarea>
                </div>
                <button type="button" id="bw-submit"
                    style="width:100%;margin-top:1rem;padding:.8rem;background:var(--primary);color:var(--text-on-primary);
                    border:none;border-radius:999px;font-size:1rem;font-weight:700;cursor:pointer;font-family:inherit;transition:opacity .2s;">
                    Confirmar cita
                </button>
                <p id="bw-msg" style="text-align:center;font-size:.85rem;margin-top:.75rem;min-height:1.2em;"></p>
            </div>`;

        document.getElementById('bw-submit').addEventListener('click', submitBooking);
    }

    function submitBooking() {
        const name  = document.getElementById('bw-name').value.trim();
        const email = document.getElementById('bw-email').value.trim();
        if (!name || !email) { document.getElementById('bw-msg').textContent = 'Nombre y email son obligatorios.'; return; }

        const btn = document.getElementById('bw-submit');
        btn.disabled = true;
        btn.textContent = 'Enviando…';

        fetch(`/site/${SLUG}/booking`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '',
            },
            body: JSON.stringify({
                customer_name:    name,
                customer_email:   email,
                customer_phone:   document.getElementById('bw-phone').value.trim(),
                appointment_date: selectedDate,
                appointment_time: selectedTime,
                notes:            document.getElementById('bw-notes').value.trim(),
            }),
        })
        .then(r => r.json())
        .then(d => {
            if (d.ok) {
                document.getElementById('bw-form').innerHTML =
                    '<div style="text-align:center;padding:2rem;"><p style="font-size:1.25rem;font-weight:700;color:var(--primary);">✓ ¡Cita confirmada!</p>' +
                    `<p style="color:var(--on-surface-muted);margin-top:.5rem;">Te esperamos el ${selectedDate} a las ${selectedTime}.</p></div>`;
                document.getElementById('bw-slots').innerHTML = '';
            } else {
                document.getElementById('bw-msg').textContent = 'Error al confirmar. Intenta de nuevo.';
                btn.disabled = false;
                btn.textContent = 'Confirmar cita';
            }
        })
        .catch(() => {
            document.getElementById('bw-msg').textContent = 'Error de conexión.';
            btn.disabled = false;
            btn.textContent = 'Confirmar cita';
        });
    }

    buildCalendar();
})();
</script>
@endif
