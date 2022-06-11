document.addEventListener('DOMContentLoaded', () => {

    initSidebar();

    document.querySelector('body').addEventListener('click', checkSidebar);

    const mediaQuery = window.matchMedia('(max-width: 1024px)')
    function handleOrientationChange(evt) {
        if (evt.matches) {
            const sideBarToggleBtn = document.querySelector('.js-collapse-sidebar');
            const sideBarEl = sideBarToggleBtn.closest('.sidebar');
            sideBarEl.classList.remove('open');
            sideBarEl.classList.add('collapsed');
            sideBarToggleBtn.querySelector('svg').style.transform = 'rotate(90deg)';
            toggleHiddenElements(false);
            updatePadding(sideBarEl.offsetWidth);
        }
    }

    mediaQuery.addEventListener('change',handleOrientationChange);

    handleOrientationChange(mediaQuery);

    function initSidebar() {
        const sideBarToggleBtn = document.querySelector('.js-collapse-sidebar');
        const sideBarEl = sideBarToggleBtn.closest('.sidebar');
        const sidebarLocalStorageVarName = sideBarEl.dataset.sidebar;

        if(window.sidebarTopOffsetSelectors) {
            const sideBarEl = document.querySelector('.sidebar[data-sidebar]');
            let topOffset = 0;

            window.sidebarTopOffsetSelectors.forEach(selector => {
                document.querySelectorAll(selector).forEach(el => {
                    topOffset += el.offsetHeight;
                })
            })
            sideBarEl.style.top = `${topOffset}px`;
        }

        if (localStorage.getItem(sidebarLocalStorageVarName)) {
            sideBarEl.classList.remove('open');
            sideBarEl.classList.add('collapsed');
            sideBarToggleBtn.querySelector('svg').style.transform = 'rotate(90deg)';

            toggleHiddenElements(false);

            updatePadding(sideBarEl.offsetWidth);
        }
    }

    function checkSidebar(e) {
        if (e.target.classList.contains('js-collapse-sidebar')) {
            e.preventDefault();
            const sideBarEl = e.target.closest('.sidebar');
            const sidebarLocalStorageVarName = sideBarEl.dataset.sidebar;

            const transformStyle = e.target.querySelector('.js-collapse-icon').style.transform;

            if(transformStyle === 'rotate(90deg)') {
                e.target.querySelector('.js-collapse-icon').style.transform = 'rotate(-90deg)';
            } else {
                e.target.querySelector('.js-collapse-icon').style.transform = 'rotate(90deg)';
            }

            if (sideBarEl.classList.contains('open')) {
                sideBarEl.classList.remove('open');
                sideBarEl.classList.add('collapsed');
                localStorage.setItem(sidebarLocalStorageVarName, '1');

                toggleHiddenElements(false);

            } else {
                sideBarEl.classList.remove('collapsed');
                sideBarEl.classList.add('open');
                localStorage.removeItem(sidebarLocalStorageVarName);

                toggleHiddenElements();
            }

            let isMobile = false;
            if(mediaQuery.matches) {isMobile  = true; }
            updatePadding(sideBarEl.offsetWidth,isMobile);
        }
    }

    function toggleHiddenElements(show = true) {
        document.querySelectorAll('[data-sidebar-hide]').forEach(el => {
            el.style.display = show ? '' : 'none';
        });
    }

    function updatePadding(sidebarWidth,isMobile = false) {
        if(isMobile) { return; }
        document.querySelectorAll('[data-sidebar-collapsible]').forEach(el => {
            el.style.paddingLeft = `${sidebarWidth}px`;
        });
    }
});
