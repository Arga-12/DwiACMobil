// Article Preview JavaScript
// Handles live preview updates for article creation/editing

document.addEventListener('DOMContentLoaded', function() {
    // Initialize preview functionality
    initArtikelPreview();
});

function initArtikelPreview() {
    // Form elements
    const elements = {
        title: document.getElementById('title'),
        slug: document.getElementById('slug'),
        foto: document.getElementById('foto'),
        priceHidden: document.getElementById('price'),
        priceDisplay: document.getElementById('price_display'),
        durationMinDisplay: document.getElementById('duration_min_display'),
        durationMinUnit: document.getElementById('duration_min_unit'),
        durationMaxDisplay: document.getElementById('duration_max_display'),
        durationMaxUnit: document.getElementById('duration_max_unit'),
        guarantee: document.getElementById('guarantee_days'),
        description: document.getElementById('description'),
        pointsContainer: document.getElementById('points_container'),
        addPointBtn: document.getElementById('add_point')
    };

    // Preview elements
    const preview = {
        title: document.getElementById('preview-title'),
        titleDesc: document.getElementById('preview-title-desc'),
        image: document.getElementById('preview-image'),
        duration: document.getElementById('preview-duration'),
        price: document.getElementById('preview-price'),
        priceCta: document.getElementById('preview-price-cta'),
        warranty: document.getElementById('preview-warranty'),
        description: document.getElementById('preview-description'),
        points: document.getElementById('preview-points'),
        slugPreview: document.getElementById('slug-preview')
    };

    // Utility functions
    const nfID = new Intl.NumberFormat('id-ID');

    function slugify(text) {
        return text.toString()
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
    }

    function formatDuration(minVal, maxVal, minUnit, maxUnit) {
        if (!minVal || !maxVal) return '1-2 jam';

        const min = parseInt(minVal, 10);
        const max = parseInt(maxVal, 10);

        if (minUnit === 'minute' && maxUnit === 'minute') {
            if (min >= 60 || max >= 60) {
                return Math.ceil(min/60) + '–' + Math.ceil(max/60) + ' jam';
            } else {
                return min + '–' + max + ' menit';
            }
        } else if (minUnit === 'hour' && maxUnit === 'hour') {
            return min + '–' + max + ' jam';
        } else if (minUnit === 'day' && maxUnit === 'day') {
            return min + '–' + max + ' hari';
        }

        return min + '–' + max + ' ' + minUnit;
    }

    function updatePreview() {
        // Title
        const titleValue = elements.title?.value || 'ISI FREON AC MOBIL';
        const titleUpper = titleValue.toUpperCase();

        if (preview.title) preview.title.textContent = titleUpper;
        if (preview.titleDesc) preview.titleDesc.textContent = titleUpper;

        // Slug
        if (elements.slug && preview.slugPreview) {
            const slugValue = elements.slug.value || slugify(titleValue);
            preview.slugPreview.textContent = slugValue;
        }

        // Duration
        if (preview.duration) {
            const durationText = formatDuration(
                elements.durationMinDisplay?.value,
                elements.durationMaxDisplay?.value,
                elements.durationMinUnit?.value,
                elements.durationMaxUnit?.value
            );
            preview.duration.textContent = durationText;
        }

        // Price
        if (preview.price && preview.priceCta) {
            const priceValue = elements.priceHidden?.value;
            const formattedPrice = priceValue ? nfID.format(parseInt(priceValue, 10)) : '150.000';
            preview.price.textContent = formattedPrice;
            preview.priceCta.textContent = formattedPrice;
        }

        // Warranty
        if (preview.warranty) {
            const warrantyValue = elements.guarantee?.value;
            preview.warranty.textContent = warrantyValue ? warrantyValue + ' hari' : '7 hari';
        }

        // Description
        if (preview.description) {
            const descValue = elements.description?.value ||
                'Freon adalah komponen utama yang membuat AC mobil mengeluarkan udara dingin. Jika freon berkurang atau habis, AC tidak akan bekerja maksimal...';
            preview.description.textContent = descValue;
        }

        // Points
        updatePreviewPoints();
    }

    function updatePreviewPoints() {
        if (!preview.points) return;

        const pointInputs = document.querySelectorAll('.point-input');
        let pointsHtml = '';
        let hasPoints = false;

        pointInputs.forEach(input => {
            const value = input.value?.trim();
            if (value) {
                hasPoints = true;
                pointsHtml += `
                    <li class="flex items-start gap-3">
                        <div class="w-2 h-2 bg-[#0F044C] rounded-full mt-2"></div>
                        <p class="defparagraf text-gray-700">${escapeHtml(value)}</p>
                    </li>
                `;
            }
        });

        if (!hasPoints) {
            pointsHtml = `
                <li class="flex items-start gap-3">
                    <div class="w-2 h-2 bg-[#0F044C] rounded-full mt-2"></div>
                    <p class="defparagraf text-gray-700">Tambahkan poin-poin penting yang perlu diketahui pelanggan...</p>
                </li>
            `;
        }

        preview.points.innerHTML = pointsHtml;
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // Event listeners
    function bindEvents() {
        // Title and slug
        if (elements.title) {
            elements.title.addEventListener('input', function() {
                if (elements.slug && !elements.slug.value) {
                    elements.slug.value = slugify(this.value);
                }
                updatePreview();
            });
        }

        if (elements.slug) {
            elements.slug.addEventListener('input', updatePreview);
        }

        // Price formatting
        if (elements.priceDisplay && elements.priceHidden) {
            function syncPrice() {
                const digits = (elements.priceDisplay.value || '').replace(/\D+/g, '');
                elements.priceHidden.value = digits || '';
                elements.priceDisplay.value = digits ? nfID.format(parseInt(digits, 10)) : '';
                updatePreview();
            }

            // Initialize price display
            if (elements.priceHidden.value) {
                elements.priceDisplay.value = nfID.format(parseInt(elements.priceHidden.value, 10));
            }

            elements.priceDisplay.addEventListener('input', syncPrice);
            elements.priceDisplay.addEventListener('blur', syncPrice);
        }

        // Duration converters
        function initDurationConverter(prefix) {
            const input = document.getElementById(prefix + '_display');
            const unit = document.getElementById(prefix + '_unit');
            const hidden = document.getElementById(prefix);

            if (!input || !unit || !hidden) return;

            const factors = { minute: 1, hour: 60, day: 1440 };

            function updateHidden() {
                const val = parseInt(input.value || '0', 10);
                const factor = factors[unit.value] || 1;
                const minutes = isNaN(val) ? '' : String(val * factor);
                hidden.value = minutes;
                updatePreview();
            }

            input.addEventListener('input', updateHidden);
            unit.addEventListener('change', updateHidden);
            updateHidden();
        }

        initDurationConverter('duration_min');
        initDurationConverter('duration_max');

        // Other form inputs
        if (elements.guarantee) {
            elements.guarantee.addEventListener('input', updatePreview);
        }

        if (elements.description) {
            elements.description.addEventListener('input', updatePreview);
        }

        // Image preview
        if (elements.foto && preview.image) {
            elements.foto.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.image.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Dynamic points management
        bindPointsEvents();
    }

    function bindPointsEvents() {
        if (!elements.pointsContainer || !elements.addPointBtn) return;

        // Add point button
        elements.addPointBtn.addEventListener('click', function() {
            const newRow = createPointRow('');
            elements.pointsContainer.appendChild(newRow);
        });

        // Remove point buttons (event delegation)
        elements.pointsContainer.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-point')) {
                const row = e.target.closest('div');
                if (elements.pointsContainer.children.length > 1) {
                    row.remove();
                    updatePreview();
                }
            }
        });

        // Bind existing point inputs
        document.querySelectorAll('.point-input').forEach(input => {
            input.addEventListener('input', updatePreview);
        });
    }

    function createPointRow(value = '') {
        const wrap = document.createElement('div');
        wrap.className = 'flex gap-2';
        wrap.innerHTML = `
            <input type="text" name="points[]"
                   class="w-full border border-gray-300 rounded-md px-3 py-2 defparagraf point-input"
                   value="${escapeHtml(value)}"
                   placeholder="Contoh: Selalu cek kebocoran sebelum isi freon">
            <button type="button"
                    class="px-3 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 remove-point">×</button>
        `;

        // Bind event listener to new input
        const pointInput = wrap.querySelector('.point-input');
        pointInput.addEventListener('input', updatePreview);

        return wrap;
    }

    // Initialize everything
    bindEvents();
    updatePreview();
}

// Export for potential external use
window.initArtikelPreview = initArtikelPreview;
