document.addEventListener('DOMContentLoaded', () => {

    initSidebar();

    document.querySelector('body').addEventListener('click', checkSidebar);

    function initSidebar() {
        const sideBarEl = document.querySelector('.js-collapse-sidebar').closest('.sidebar');
        const sidebarLocalStorageVarName = sideBarEl.dataset.sidebar;
        if (localStorage.getItem(sidebarLocalStorageVarName)) {
            sideBarEl.classList.remove('open');
            sideBarEl.classList.add('collapsed');
            sideBarEl.querySelector('.js-collapse-icon').classList.remove('fa-chevron-circle-right');
            sideBarEl.querySelector('.js-collapse-icon').classList.add('fa-chevron-circle-left');

            toggleHiddenElements(false);

            updatePadding(sideBarEl.offsetWidth);
        }

    }

    function checkSidebar(e) {
        if (e.target.classList.contains('js-collapse-sidebar')) {
            e.preventDefault();
            const sideBarEl = e.target.closest('.sidebar');
            const sidebarLocalStorageVarName = sideBarEl.dataset.sidebar;

            e.target.querySelector('.js-collapse-icon').classList.toggle('fa-chevron-circle-left');
            e.target.querySelector('.js-collapse-icon').classList.toggle('fa-chevron-circle-right');

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

            updatePadding(sideBarEl.offsetWidth);
        }
    }

    function toggleHiddenElements(show = true) {
        document.querySelectorAll('[data-sidebar-hide]').forEach(el => {
            el.style.display = show ? '' : 'none';
        });
    }

    function updatePadding(sidebarWidth) {
        document.querySelectorAll('[data-sidebar-collapsible]').forEach(el => {
            el.style.paddingLeft = `${sidebarWidth}px`;
        });
    }
});
