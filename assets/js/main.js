document.addEventListener('DOMContentLoaded', function() {
    
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    const menuItems = document.querySelectorAll('.nav-menu a');
    const tabs = document.querySelectorAll('.tab');
    const navLinks = document.querySelectorAll('.nav-link');
    const overlay = document.querySelector('.mobile-menu-overlay');
    const body = document.body;

    function updateActiveStates(targetTab) {
        tabs.forEach(tab => {
            tab.classList.remove('active');
            if (tab.dataset.tab === targetTab) {
                tab.classList.add('active');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.dataset.tab === targetTab) {
                link.classList.add('active');
            }
        });

        const announcement = document.getElementById('tab-announcement');
        if (announcement) {
            announcement.textContent = `${targetTab} tab selected`;
        }
    }

    function openMenu() {
        navMenu.classList.add('active');
        overlay.classList.add('active');
        mobileMenuToggle.setAttribute('aria-expanded', 'true');
        body.classList.add('menu-open');
        
        menuItems.forEach((item, index) => {
            if (navMenu.classList.contains('active')) {
                item.style.transitionDelay = `${index * 0.1}s`;
            } else {
                item.style.transitionDelay = '0s';
            }
        });
    }

    function closeMenu() {
        navMenu.classList.remove('active');
        overlay.classList.remove('active');
        mobileMenuToggle.setAttribute('aria-expanded', 'false');
        body.classList.remove('menu-open');
        
        menuItems.forEach(item => {
            item.style.transitionDelay = '0s';
        });
    }

    mobileMenuToggle.addEventListener('click', function() {
        if (navMenu.classList.contains('active')) {
            closeMenu();
        } else {
            openMenu();
        }
    });

    menuItems.forEach(item => {
        item.addEventListener('click', function() {
            closeMenu();
        });
    });

    overlay.addEventListener('click', closeMenu);

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && navMenu.classList.contains('active')) {
            closeMenu();
        }
    });

    navMenu.addEventListener('keydown', function(e) {
        if (e.key === 'Tab') {
            const focusableElements = navMenu.querySelectorAll('a, button');
            const firstElement = focusableElements[0];
            const lastElement = focusableElements[focusableElements.length - 1];

            if (e.shiftKey && document.activeElement === firstElement) {
                e.preventDefault();
                lastElement.focus();
            } else if (!e.shiftKey && document.activeElement === lastElement) {
                e.preventDefault();
                firstElement.focus();
            }
        }
    });

    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetTab = this.dataset.tab;
            
            updateActiveStates(targetTab);

            if (window.innerWidth <= 768) {
                navMenu.classList.remove('active');
                mobileMenuToggle.classList.remove('active');
                mobileMenuToggle.setAttribute('aria-expanded', 'false');
            }

            const searchSection = document.querySelector('.hero');
            if (searchSection) {
                searchSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const targetTab = this.dataset.tab;
            updateActiveStates(targetTab);
        });

        tab.addEventListener('keydown', function(e) {
            const currentIndex = Array.from(tabs).indexOf(this);
            let targetTab = null;
            
            switch(e.key) {
                case 'ArrowLeft':
                    targetTab = currentIndex === 0 ? tabs[tabs.length - 1] : tabs[currentIndex - 1];
                    break;
                case 'ArrowRight':
                    targetTab = currentIndex === tabs.length - 1 ? tabs[0] : tabs[currentIndex + 1];
                    break;
            }
            
            if (targetTab) {
                e.preventDefault();
                targetTab.focus();
                updateActiveStates(targetTab.dataset.tab);
            }
        });
    });

    const initialTab = new URLSearchParams(window.location.search).get('tab') || 'buy';
    updateActiveStates(initialTab);

    const filterTabs = document.querySelectorAll('.search-tabs .tab');

    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const filterValue = this.getAttribute('data-filter');
            
            filterTabs.forEach(tab => tab.classList.remove('active'));
            
            const correspondingTab = document.querySelector(`.tab[data-tab="${filterValue}"]`);
            if (correspondingTab) {
                correspondingTab.classList.add('active');
            }
        });
    });

    
    filterTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            filterTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });

    menuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            const tabValue = this.getAttribute('data-tab');
            
            if (!tabValue) {
                return;
            }
            
            e.preventDefault();
            
            menuItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');
            
            tabs.forEach(tab => {
                if (tab.getAttribute('data-tab') === tabValue) {
                    tabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                }
            });
        });
    });
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const tabValue = this.getAttribute('data-tab');
            
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            menuItems.forEach(item => {
                if (item.getAttribute('data-tab') === tabValue) {
                    menuItems.forEach(i => i.classList.remove('active'));
                    item.classList.add('active');
                }
            });
        });
    });

    const currentPath = window.location.pathname;
    menuItems.forEach(item => {
        if (item.getAttribute('href') === currentPath) {
            item.classList.add('active');
        }
    });
});

window.addEventListener('scroll', function() {
    const header = document.querySelector('.header');
    if (header) {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    }
});
