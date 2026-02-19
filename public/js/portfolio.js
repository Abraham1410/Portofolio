// =============================================
// PORTFOLIO JS — Animations & Interactions
// =============================================

document.addEventListener('DOMContentLoaded', () => {

    // ---- NAVBAR SCROLL EFFECT ----
    const navbar = document.getElementById('navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 60);
        });
    }

    // ---- MOBILE NAV TOGGLE ----
    const toggle = document.getElementById('navToggle');
    if (toggle) {
        toggle.addEventListener('click', () => {
            const links = document.querySelector('.nav-links');
            if (links) {
                const isOpen = links.style.display === 'flex';
                links.style.cssText = isOpen
                    ? ''
                    : 'display:flex;flex-direction:column;position:absolute;top:70px;left:0;right:0;background:rgba(10,10,15,0.98);padding:24px 40px;gap:20px;border-bottom:1px solid rgba(255,255,255,0.08)';
            }
        });
    }

    // ---- SCROLL REVEAL ----
    const revealEls = document.querySelectorAll('[data-reveal]');
    if (revealEls.length) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('visible');
                    }, i * 80);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        revealEls.forEach(el => observer.observe(el));
    }

    // ---- SKILL BAR ANIMATION ----
    const skillBars = document.querySelectorAll('.skill-fill');
    if (skillBars.length) {
        const barObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                    barObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });

        skillBars.forEach(bar => barObserver.observe(bar));
    }

    // ---- PROJECT FILTER ----
    const filterBtns = document.querySelectorAll('.filter-btn');
    const projectCards = document.querySelectorAll('.project-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const filter = btn.dataset.filter;

            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            projectCards.forEach(card => {
                const cat = card.dataset.category;
                const show = filter === 'all' || cat === filter;
                card.style.opacity = show ? '1' : '0.2';
                card.style.transform = show ? '' : 'scale(0.97)';
                card.style.pointerEvents = show ? '' : 'none';
            });
        });
    });

    // ---- SMOOTH ANCHOR SCROLL ----
    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', (e) => {
            const target = document.querySelector(link.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                // Close mobile nav if open
                const links = document.querySelector('.nav-links');
                if (links && links.style.display === 'flex') {
                    links.style.cssText = '';
                }
            }
        });
    });

    // ---- COUNTER ANIMATION for hero stats ----
    const counters = document.querySelectorAll('.stat-num');
    if (counters.length) {
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const text = el.textContent;
                    const num = parseFloat(text);
                    if (!isNaN(num)) {
                        let start = 0;
                        const suffix = text.replace(/[\d.]/g, '');
                        const duration = 1200;
                        const step = (timestamp) => {
                            if (!start) start = timestamp;
                            const progress = Math.min((timestamp - start) / duration, 1);
                            el.textContent = Math.floor(progress * num) + suffix;
                            if (progress < 1) requestAnimationFrame(step);
                        };
                        requestAnimationFrame(step);
                    }
                    counterObserver.unobserve(el);
                }
            });
        }, { threshold: 0.5 });
        counters.forEach(el => counterObserver.observe(el));
    }

    // ---- CONTACT FORM UX ----
    const form = document.querySelector('.contact-form');
    if (form) {
        const submitBtn = form.querySelector('button[type="submit"]');
        form.addEventListener('submit', () => {
            if (submitBtn) {
                submitBtn.textContent = 'Mengirim...';
                submitBtn.disabled = true;
            }
        });
    }

    // ---- PARALLAX on hero orbs (subtle) ----
    const orbs = document.querySelectorAll('.hero-orb');
    if (orbs.length) {
        window.addEventListener('mousemove', (e) => {
            const cx = window.innerWidth / 2;
            const cy = window.innerHeight / 2;
            const dx = (e.clientX - cx) / cx;
            const dy = (e.clientY - cy) / cy;
            orbs.forEach((orb, i) => {
                const factor = (i + 1) * 12;
                orb.style.transform = `translate(${dx * factor}px, ${dy * factor}px)`;
            });
        });
    }

});
