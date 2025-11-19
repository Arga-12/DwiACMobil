document.addEventListener('DOMContentLoaded', () => {
  const timeEl = document.getElementById('status-time');
  const dateEl = document.getElementById('status-date');

  if (!timeEl && !dateEl) return;

  const tz = 'Asia/Jakarta';
  const timeFmt = new Intl.DateTimeFormat('id-ID', {
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit',
    hour12: false,
    timeZone: tz,
  });

  const dateFmt = new Intl.DateTimeFormat('id-ID', {
    day: '2-digit',
    month: 'long',
    year: 'numeric',
    timeZone: tz,
  });

  function updateClock() {
    const now = new Date();
    if (timeEl) timeEl.textContent = timeFmt.format(now);
    if (dateEl) dateEl.textContent = dateFmt.format(now);
  }

  updateClock();
  setInterval(updateClock, 1000);
});
