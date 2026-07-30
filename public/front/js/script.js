document.addEventListener('DOMContentLoaded', function () {

    // select-pill filter controls
    (function () {
        const pills = document.querySelectorAll('.select-pill');
        if (!pills.length) return;

        function closeAll(except) {
            pills.forEach(p => {
                if (p !== except) {
                    p.classList.remove('open');
                    p.setAttribute('aria-expanded', 'false');
                    const ul = p.querySelector('.select-options');
                    if (ul) ul.setAttribute('hidden', '');
                }
            });
        }

        pills.forEach(pill => {
            const label = pill.querySelector('.select-label');
            const ul = pill.querySelector('.select-options');
            const options = ul ? Array.from(ul.querySelectorAll('[role="option"]')) : [];

            // Toggle open/close
            function toggle(open) {
                const isOpen = pill.classList.contains('open');
                const willOpen = typeof open === 'boolean' ? open : !isOpen;
                if (willOpen) {
                    closeAll(pill);
                    pill.classList.add('open');
                    pill.setAttribute('aria-expanded', 'true');
                    if (ul) ul.removeAttribute('hidden');
                    // focus first option for keyboard
                    setTimeout(() => options[0] && options[0].focus(), 30);
                } else {
                    pill.classList.remove('open');
                    pill.setAttribute('aria-expanded', 'false');
                    if (ul) ul.setAttribute('hidden', '');
                    pill.focus();
                }
            }

            pill.addEventListener('click', (e) => {
                // allow clicks on options to set value
                if (e.target.closest('[role="option"]')) return;
                toggle();
            });

            pill.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); toggle(); }
                if (e.key === 'Escape') toggle(false);
            });

            // Option click
            options.forEach(opt => {
                opt.addEventListener('click', () => {
                    label.textContent = opt.textContent;
                    pill.dataset.value = opt.dataset.value || opt.textContent;
                    toggle(false);
                });
                opt.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter') { e.preventDefault(); opt.click(); }
                    if (e.key === 'Escape') { e.preventDefault(); toggle(false); }
                });
            });
        });

        // close on outside click
        document.addEventListener('click', (e) => { if (!e.target.closest('.select-pill')) closeAll(); });
        document.addEventListener('focusin', (e) => { if (!e.target.closest('.select-pill')) closeAll(); });
    })();

});

/* Slick init moved inside DOMContentLoaded and guarded by checking for element & jQuery */

// Make arrow images next to labels clickable and keyboard-accessible — focus the related input
(function () {
    const arrows = document.querySelectorAll('.inputs_field .title_24 img');
    if (!arrows.length) return;

    arrows.forEach(img => {
        // make focusable and announceable
        img.tabIndex = 0;
        img.setAttribute('role', 'button');
        img.setAttribute('aria-label', 'Focus input');
        img.style.cursor = 'pointer';

        function focusInput() {
            const field = img.closest('.inputs_field');
            if (!field) return;
            const el = field.querySelector('input, textarea, select');
            if (el) el.focus();
        }

        img.addEventListener('click', focusInput);
        img.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                focusInput();
            }
        });
    });
})();