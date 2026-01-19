/**
 * Real-time Clock Update for Dashboard
 * Updates time and date in hero sections
 */

const updateClock = () => {
    const now = new Date();
    
    // Format time (HH:MM:SS)
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    const timeString = `${hours}:${minutes}:${seconds}`;
    
    // Format date (Indonesian format)
    const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    const months = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    
    const dayName = days[now.getDay()];
    const day = String(now.getDate()).padStart(2, '0');
    const month = months[now.getMonth()];
    const year = now.getFullYear();
    const dateString = `${day} ${month} ${year}`;
    
    // Update time elements
    const timeElements = document.querySelectorAll('#status-time, #status-time-web');
    timeElements.forEach(el => {
        if (el) el.textContent = timeString;
    });
    
    // Update date elements
    const dateElements = document.querySelectorAll('#status-date, #status-date-web');
    dateElements.forEach(el => {
        if (el) el.textContent = dateString;
    });
};

// Initialize clock update
const initClock = () => {
    // Update immediately
    updateClock();
    
    // Update every second
    setInterval(updateClock, 1000);
};

// Start when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initClock);
} else {
    initClock();
}

