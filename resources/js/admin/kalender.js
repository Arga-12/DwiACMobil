const escapeHtml = (unsafe = '') =>
    unsafe
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');

const renderBookings = (bookings = []) => {
    if (!bookings.length) {
        return '<p class="text-[11px] text-gray-500">Tidak ada booking.</p>';
    }

    const items = bookings
        .slice(0, 4)
        .map((booking) => {
            const pelanggan = escapeHtml(booking.pelanggan || 'Pelanggan');
            const layanan = escapeHtml(booking.mobil || '-');
            const plat = escapeHtml(booking.plat_nomor || '-');
            const waktu = escapeHtml(booking.waktu || '--:--');
            const status = escapeHtml((booking.status || '').replace('_', ' '));

            return `
                <div class="border border-gray-200 rounded-lg px-3 py-2 mb-2 last:mb-0">
                    <p class="text-[11px] font-semibold text-[#0F044C]">${pelanggan}</p>
                    <p class="text-[10px] text-gray-500">${layanan} • ${plat}</p>
                    <p class="text-[10px] text-gray-600 mt-1">${waktu} • <span class="capitalize">${status}</span></p>
                </div>
            `;
        })
        .join('');

    if (bookings.length > 4) {
        return items + '<p class="text-[10px] text-gray-500 mt-1">+' + (bookings.length - 4) + ' booking lainnya</p>';
    }

    return items;
};

const renderTooltipHtml = (data) => {
    if (!data) return '';
    const dateLabel = escapeHtml(data.date || '');
    const holiday = data.holiday;
    const bookings = data.bookings || [];

    let html = `<p class="text-sm font-semibold text-[#0F044C] mb-1">${dateLabel}</p>`;

    if (holiday) {
        html += `<div class="mb-2 text-[11px] text-red-600 font-medium">Libur: ${escapeHtml(holiday.title || '')}`;
        if (holiday.note) {
            html += `<br><span class="text-[10px] text-red-500">${escapeHtml(holiday.note)}</span>`;
        }
        html += '</div>';
    }

    if (bookings.length) {
        html += `<p class="text-[11px] font-semibold text-[#1D2C90] mb-1">${bookings.length} booking</p>`;
    }

    html += renderBookings(bookings);

    return html;
};

const attachCalendarTooltip = () => {
    const tooltip = document.getElementById('calendarTooltip');
    if (!tooltip) return;

    const dayElements = document.querySelectorAll('.calendar-day[data-day-info]');
    if (!dayElements.length) return;

    const hideTooltip = () => {
        tooltip.classList.add('hidden');
    };

    const positionTooltip = (event) => {
        const offset = 18;
        tooltip.style.left = `${event.pageX + offset}px`;
        tooltip.style.top = `${event.pageY + offset}px`;
    };

    dayElements.forEach((day) => {
        day.addEventListener('mouseenter', (event) => {
            const payload = day.getAttribute('data-day-info');
            if (!payload) return;

            let parsed;
            try {
                parsed = JSON.parse(payload);
            } catch (error) {
                return;
            }

            tooltip.innerHTML = renderTooltipHtml(parsed);
            tooltip.classList.remove('hidden');
            positionTooltip(event);
        });

        day.addEventListener('mousemove', positionTooltip);
        day.addEventListener('mouseleave', hideTooltip);
    });

    document.addEventListener('scroll', hideTooltip);
    window.addEventListener('resize', hideTooltip);
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', attachCalendarTooltip);
} else {
    attachCalendarTooltip();
}
