const escapeHtml = (unsafe = "") =>
    unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");

const renderBookings = (bookings = []) => {
    if (!bookings.length) {
        return '<p class="text-[11px] text-gray-500">Tidak ada booking.</p>';
    }

    const items = bookings
        .slice(0, 4)
        .map((booking) => {
            const pelanggan = escapeHtml(booking.pelanggan || "Pelanggan");
            const layanan = escapeHtml(booking.mobil || "-");
            const plat = escapeHtml(booking.plat_nomor || "-");
            const waktu = escapeHtml(booking.waktu || "--:--");
            const status = escapeHtml((booking.status || "").replace("_", " "));

            return `
                <div class="border border-gray-200 rounded-lg px-3 py-2 mb-2 last:mb-0">
                    <p class="text-[11px] font-semibold text-[#0F044C]">${pelanggan}</p>
                    <p class="text-[10px] text-gray-500">${layanan} • ${plat}</p>
                    <p class="text-[10px] text-gray-600 mt-1">${waktu} • <span class="capitalize">${status}</span></p>
                </div>
            `;
        })
        .join("");

    if (bookings.length > 4) {
        return (
            items +
            '<p class="text-[10px] text-gray-500 mt-1">+' +
            (bookings.length - 4) +
            " booking lainnya</p>"
        );
    }

    return items;
};

const renderTooltipHtml = (data) => {
    if (!data) return "";
    const dateLabel = escapeHtml(data.date || "");
    const holiday = data.holiday;
    const bookings = data.bookings || [];

    let html = `<p class="text-sm font-semibold text-[#0F044C] mb-1">${dateLabel}</p>`;

    if (holiday) {
        html += `<div class="mb-2 text-[11px] text-red-600 font-medium">Libur: ${escapeHtml(holiday.title || "")}`;
        if (holiday.note) {
            html += `<br><span class="text-[10px] text-red-500">${escapeHtml(holiday.note)}</span>`;
        }
        html += "</div>";
    }

    if (bookings.length) {
        html += `<p class="text-[11px] font-semibold text-[#1D2C90] mb-1">${bookings.length} booking</p>`;
    }

    html += renderBookings(bookings);

    return html;
};

let tooltipEventListeners = [];

const attachCalendarTooltip = () => {
    const tooltip = document.getElementById("calendarTooltip");
    if (!tooltip) {
        console.warn("Calendar tooltip element not found");
        return;
    }

    // Remove existing event listeners
    tooltipEventListeners.forEach(({ element, event, handler }) => {
        element.removeEventListener(event, handler);
    });
    tooltipEventListeners = [];

    const dayElements = document.querySelectorAll(
        ".calendar-day[data-day-info]",
    );
    if (!dayElements.length) {
        console.warn("No calendar days with data-day-info found");
        return;
    }

    const hideTooltip = () => {
        tooltip.classList.add("hidden");
        tooltip.style.left = "";
        tooltip.style.top = "";
    };

    const positionTooltip = (event) => {
        const offset = 15;
        const tooltipRect = tooltip.getBoundingClientRect();
        const viewportWidth = window.innerWidth;
        const viewportHeight = window.innerHeight;

        let left = event.clientX + offset;
        let top = event.clientY + offset;

        // Adjust if tooltip goes off screen to the right
        if (left + tooltipRect.width > viewportWidth) {
            left = event.clientX - tooltipRect.width - offset;
        }

        // Adjust if tooltip goes off screen to the bottom
        if (top + tooltipRect.height > viewportHeight) {
            top = event.clientY - tooltipRect.height - offset;
        }

        // Ensure tooltip doesn't go off screen to the left
        if (left < 0) {
            left = offset;
        }

        // Ensure tooltip doesn't go off screen to the top
        if (top < 0) {
            top = offset;
        }

        tooltip.style.left = `${left}px`;
        tooltip.style.top = `${top}px`;
    };

    dayElements.forEach((day) => {
        const mouseEnterHandler = (event) => {
            const payload = day.getAttribute("data-day-info");
            if (!payload) return;

            let parsed;
            try {
                parsed = JSON.parse(payload);
            } catch (error) {
                console.error("Error parsing day info:", error);
                return;
            }

            // Only show tooltip if there's actual content (holiday or bookings)
            if (
                !parsed.holiday &&
                (!parsed.bookings || parsed.bookings.length === 0)
            ) {
                return;
            }

            tooltip.innerHTML = renderTooltipHtml(parsed);
            tooltip.classList.remove("hidden");
            // Force a reflow to ensure tooltip is rendered before positioning
            tooltip.offsetHeight;
            positionTooltip(event);
        };

        const mouseMoveHandler = (event) => {
            if (!tooltip.classList.contains("hidden")) {
                positionTooltip(event);
            }
        };

        day.addEventListener("mouseenter", mouseEnterHandler);
        day.addEventListener("mousemove", mouseMoveHandler);
        day.addEventListener("mouseleave", hideTooltip);

        // Store references for cleanup
        tooltipEventListeners.push(
            { element: day, event: "mouseenter", handler: mouseEnterHandler },
            { element: day, event: "mousemove", handler: mouseMoveHandler },
            { element: day, event: "mouseleave", handler: hideTooltip },
        );
    });

    // Add global listeners only once
    if (!window.calendarTooltipGlobalListeners) {
        document.addEventListener("scroll", hideTooltip, true);
        window.addEventListener("resize", hideTooltip);
        window.calendarTooltipGlobalListeners = true;
    }
};

// Make function globally available for calendar updates
window.reattachCalendarTooltip = attachCalendarTooltip;

if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", attachCalendarTooltip);
} else {
    attachCalendarTooltip();
}
