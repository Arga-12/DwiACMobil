document.addEventListener('DOMContentLoaded', function () {
  var input = document.getElementById('tanggalBookingInput');
  var container = document.getElementById('bookingDatePopover');
  if (!input || !container) return;

  // Popover trigger and handlers
  var trigger = document.getElementById('openDatePickerBtn');
  if (!trigger) return;
  var isOpen = false;
  function openPopover(){
    if (isOpen) return; isOpen = true;
    container.classList.remove('hidden');
    document.addEventListener('click', onDocClick, true);
    document.addEventListener('keydown', onKeydown, true);
  }
  function closePopover(){
    if (!isOpen) return; isOpen = false;
    container.classList.add('hidden');
    document.removeEventListener('click', onDocClick, true);    document.removeEventListener('keydown', onKeydown, true);
  }
  function togglePopover(){ isOpen ? closePopover() : openPopover(); }
  function onDocClick(e){
    if (!container.contains(e.target) && !trigger.contains(e.target)) closePopover();
  }
  function onKeydown(e){ if (e.key === 'Escape') closePopover(); }
  trigger.addEventListener('click', function(e){ e.preventDefault(); e.stopPropagation(); togglePopover(); });

  // Read config from data attributes
  var minStr = input.getAttribute('min');
  var minDate = minStr ? new Date(minStr + 'T00:00:00') : new Date();
  var skipSunday = input.getAttribute('data-skip-sunday') === '1';
  var rawBlocked = input.getAttribute('data-blocked-dates') || '[]';
  var blockedDates = [];
  try { blockedDates = JSON.parse(rawBlocked); } catch (e) { blockedDates = []; }
  var blocked = new Set(blockedDates);

  var rawBooked = input.getAttribute('data-booked-dates') || '[]';
  var bookedDates = [];
  try { bookedDates = JSON.parse(rawBooked); } catch (e) { bookedDates = []; }
  var booked = new Set(bookedDates);

  var rawHolidays = input.getAttribute('data-holidays') || '[]';
  var holidaysArr = [];
  try { holidaysArr = JSON.parse(rawHolidays); } catch (e) { holidaysArr = []; }
  var holidays = new Set(holidaysArr);

  // State for calendar
  var today = new Date();
  var initial = input.value ? new Date(input.value + 'T00:00:00') : today;
  // Ensure initial not before min
  if (initial < minDate) initial = new Date(minDate);
  var viewYear = initial.getFullYear();
  var viewMonth = initial.getMonth(); // 0..11
  var selected = input.value ? input.value : '';

  var monthsID = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
  var daysHead = ['Sen','Sel','Rab','Kam','Jum','Sab']; // Sunday removed

  // Utility
  function pad(n) { return (n < 10 ? '0' : '') + n; }
  function ymd(d) { return d.getFullYear() + '-' + pad(d.getMonth() + 1) + '-' + pad(d.getDate()); }
  function isSameDay(a, b) { return a.getFullYear() === b.getFullYear() && a.getMonth() === b.getMonth() && a.getDate() === b.getDate(); }

  function render() {
    container.innerHTML = '';

    // Wrapper card
    var card = document.createElement('div');
    card.className = 'bg-white border border-[#0F044C]/20 rounded-xl p-4';

    // Header: month controls
    var header = document.createElement('div');
    header.className = 'flex items-center justify-between mb-3 gap-3 sm:gap-4';

    var prevBtn = document.createElement('button');
    prevBtn.type = 'button';
    prevBtn.className = 'px-3 py-1.5 rounded-lg border border-[#0F044C]/20 text-[#0F044C] hover:bg-[#0F044C]/5 shrink-0';

    prevBtn.innerHTML = '&#8592;';
    prevBtn.addEventListener('click', function(){
      // Move to previous month
      if (viewMonth === 0) { viewMonth = 11; viewYear -= 1; } else { viewMonth -= 1; }
      render();
    });

    var title = document.createElement('div');
    title.className = 'font-montserrat-48 font-bold text-[#0F044C] flex-1 text-center px-2 sm:px-4';

    title.textContent = monthsID[viewMonth] + ' ' + viewYear;

    var nextBtn = document.createElement('button');
    nextBtn.type = 'button';
    nextBtn.className = 'px-3 py-1.5 rounded-lg border border-[#0F044C]/20 text-[#0F044C] hover:bg-[#0F044C]/5 shrink-0';

    nextBtn.innerHTML = '&#8594;';
    nextBtn.addEventListener('click', function(){
      // Move to next month
      if (viewMonth === 11) { viewMonth = 0; viewYear += 1; } else { viewMonth += 1; }
      render();
    });

    header.appendChild(prevBtn);
    header.appendChild(title);
    header.appendChild(nextBtn);
    card.appendChild(header);

    // Week header (Mon-Sat)
    var headRow = document.createElement('div');
    headRow.className = 'grid grid-cols-6 gap-7 text-xs text-[#0F044C] font-semibold mb-2 select-none';
    daysHead.forEach(function(d){
      var c = document.createElement('div');
      c.className = 'text-center';
      c.textContent = d;
      headRow.appendChild(c);
    });
    card.appendChild(headRow);

    // Dates grid
    var grid = document.createElement('div');
    grid.className = 'grid grid-cols-6 gap-2';

    var first = new Date(viewYear, viewMonth, 1);
    var daysInMonth = new Date(viewYear, viewMonth + 1, 0).getDate();

    // Compute first display date (skip Sunday)
    var firstDisplay = new Date(first);
    if (skipSunday && firstDisplay.getDay() === 0) {
      firstDisplay.setDate(firstDisplay.getDate() + 1);
    }
    // Determine offset for Monday-start grid (Mon=1..Sat=6)
    var dow = firstDisplay.getDay(); // 0..6 (Sun..Sat)
    var monIdx = dow === 0 ? 7 : dow; // Sun=7
    var blanks = monIdx - 1; // 0..6, but since Sunday excluded, max 6 -> grid has 6 cols
    for (var b = 0; b < blanks; b++) {
      var empty = document.createElement('div');
      empty.className = 'h-8';
      grid.appendChild(empty);
    }

    for (var day = 1; day <= daysInMonth; day++) {
      var d = new Date(viewYear, viewMonth, day);
      if (skipSunday && d.getDay() === 0) {
        // Skip rendering Sundays entirely
        continue;
      }
      var dStr = ymd(d);
      var isPast = d < new Date(minDate.getFullYear(), minDate.getMonth(), minDate.getDate());
      var isHoliday = holidays.has(dStr) || (skipSunday && d.getDay() === 0);
      var isBooked = booked.has(dStr);
      var isBlocked = blocked.has(dStr) || isHoliday || isBooked; // user request: both booked and holiday become unselectable
      var isToday = isSameDay(d, today);
      var isSelected = selected && dStr === selected;

      var btn = document.createElement('button');
      btn.type = 'button';
      btn.textContent = String(day);

      var base = 'h-8 rounded-md border flex items-center justify-center text-xs';
      var cls = '';
      if (isPast) {
        cls = ' bg-gray-100 border-gray-300 text-gray-400 cursor-not-allowed pointer-events-none';
      } else if (isHoliday) {
        cls = ' bg-red-200 border-red-700 text-red-700 cursor-not-allowed pointer-events-none';
      } else if (isBooked) {
        cls = ' bg-[#787A91]/20 border-[#787A91]/60 text-[#0F044C] cursor-not-allowed pointer-events-none';
      } else if (blocked.has(dStr)) {
        cls = ' bg-gray-100 border-gray-300 text-gray-400 cursor-not-allowed pointer-events-none';
      } else {
        cls = ' bg-white border-gray-200 text-gray-700 hover:border-[#1D2C90] hover:bg-[#1D2C90]/5';
      }

      if (isToday && !isPast && !isBlocked) {
        cls += ' ring-1 ring-[#1D2C90]/30';
      }
      if (isSelected) {
        cls += ' bg-[#1D2C90]/10 border-[#1D2C90] text-[#0F044C] font-semibold';
      }
      btn.className = base + cls;
      if (isPast || isHoliday || isBooked || blocked.has(dStr)) {
        btn.disabled = true;
        btn.setAttribute('aria-disabled', 'true');
      }

      if (!(isPast || isBlocked)) {
        btn.addEventListener('click', function (dateString) {
          return function () {
            selected = dateString;
            input.value = dateString;
            // Hide inline error if shown
            var msg = document.getElementById('dateBlockedMsg');
            if (msg) msg.classList.add('hidden');
            closePopover();
            render();
          };
        }(dStr));
      }

      grid.appendChild(btn);
    }

    card.appendChild(grid);
    container.appendChild(card);
  }

  render();
});