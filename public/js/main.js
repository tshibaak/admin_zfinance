
/* ============================================================
   HEADER SCROLL EFFECT
   ============================================================ */
const header = document.getElementById('header');

window.addEventListener('scroll', () => {
    if (window.scrollY > 20) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

/* ============================================================
   MOBILE MENU TOGGLE
   ============================================================ */
const burger = document.getElementById('burger');
const mobileNav = document.getElementById('mobileNav');

burger.addEventListener('click', () => {
    burger.classList.toggle('open');
    mobileNav.classList.toggle('open');
});

function closeMobileNav() {
    burger.classList.remove('open');
    mobileNav.classList.remove('open');
}

/* ============================================================
   SMOOTH SCROLL
   ============================================================ */
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            e.preventDefault();
            const headerHeight = header.offsetHeight;
            const targetPos = target.getBoundingClientRect().top + window.scrollY - headerHeight;
            window.scrollTo({ top: targetPos, behavior: 'smooth' });
        }
    });
});

/* ============================================================
   FADE-IN ON SCROLL (Intersection Observer)
   ============================================================ */
const fadeElements = document.querySelectorAll('.fade-in');

const fadeObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            fadeObserver.unobserve(entry.target);
        }
    });
}, {
    threshold: 0.1,
    rootMargin: '0px 0px -40px 0px'
});

fadeElements.forEach(el => fadeObserver.observe(el));

/* ============================================================
   ANIMATED COUNTER (Stats Section)
   ============================================================ */
function animateCounter(el, target, duration = 1800) {
    const prefix = el.dataset.prefix || '';
    const suffix = el.dataset.suffix || '';
    let start = 0;
    const step = target / (duration / 16);

    const timer = setInterval(() => {
        start += step;
        if (start >= target) {
            start = target;
            clearInterval(timer);
        }
        el.textContent = prefix + Math.floor(start) + suffix;
    }, 16);
}

const statsSection = document.getElementById('stats');
let statsAnimated = false;

const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting && !statsAnimated) {
            statsAnimated = true;
            document.querySelectorAll('.stat-number[data-target]').forEach(el => {
                const target = parseInt(el.dataset.target);
                animateCounter(el, target);
            });
        }
    });
}, { threshold: 0.3 });

if (statsSection) statsObserver.observe(statsSection);

/* ============================================================
   CONTACT FORM VALIDATION
   PHP INTEGRATION:
   Replace the JS submit handler with:
   <form method="POST" action="contact.php">
   And handle server-side in contact.php
   ============================================================ */
//const contactForm = document.getElementById('contactForm');

// function showError(fieldId, errorId, show) {
//     const field = document.getElementById(fieldId);
//     const error = document.getElementById(errorId);
//     if (show) {
//         field.classList.add('error');
//         if (error) { error.style.display = 'block'; }
//     } else {
//         field.classList.remove('error');
//         if (error) { error.style.display = 'none'; }
//     }
// }

// function validateEmail(email) {
//     return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
// }

// if (contactForm) {
//     contactForm.addEventListener('submit', function (e) {
//         e.preventDefault();

//         const nom = document.getElementById('nom').value.trim();
//         const email = document.getElementById('email').value.trim();
//         const sujet = document.getElementById('sujet').value;
//         const message = document.getElementById('message').value.trim();

//         let valid = true;

//         // Validate nom
//         if (!nom) {
//             showError('nom', 'nomError', true);
//             valid = false;
//         } else {
//             showError('nom', 'nomError', false);
//         }

//         // Validate email
//         if (!email || !validateEmail(email)) {
//             showError('email', 'emailError', true);
//             valid = false;
//         } else {
//             showError('email', 'emailError', false);
//         }

//         // Validate sujet
//         if (!sujet) {
//             showError('sujet', 'sujetError', true);
//             valid = false;
//         } else {
//             showError('sujet', 'sujetError', false);
//         }

//         // Validate message
//         if (!message || message.length < 10) {
//             showError('message', 'messageError', true);
//             valid = false;
//         } else {
//             showError('message', 'messageError', false);
//         }

//         // if (valid) {
//         //     const btn = this.querySelector('button[type="submit"]');
//         //     btn.disabled = true;
//         //     btn.textContent = 'Envoi en cours...';

//         //     fetch('api/contact.php', { method: 'POST', body: new FormData(this) })
//         //         .then(r => r.json())
//         //         .then(data => {
//         //             if (data && data.success) {
//         //                 document.getElementById('formSuccess').style.display = 'block';
//         //                 this.reset();
//         //                 setTimeout(() => {
//         //                     document.getElementById('formSuccess').style.display = 'none';
//         //                 }, 5000);
//         //             } else {
//         //                 alert((data && data.error) ? data.error : 'Erreur lors de l\'envoi');
//         //             }
//         //         })
//         //         .catch(() => { alert('Erreur réseau'); })
//         //         .finally(() => {
//         //             btn.disabled = false;
//         //             btn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg> Envoyer le message';
//         //         });
//         // }
//     });

//     // // Live validation
//     // ['nom', 'email', 'message'].forEach(id => {
//     //     const el = document.getElementById(id);
//     //     if (el) {
//     //         el.addEventListener('input', () => {
//     //             if (el.value.trim()) {
//     //                 el.classList.remove('error');
//     //                 const errEl = document.getElementById(id + 'Error');
//     //                 if (errEl) errEl.style.display = 'none';
//     //             }
//     //         });
//     //     }
//     // });
// }

/* ============================================================
   NEWSLETTER FORM
   ============================================================ */
// const newsletterForm = document.getElementById('newsletterForm');
// if (newsletterForm) {
//     newsletterForm.addEventListener('submit', function (e) {
//         e.preventDefault();
//         const emailVal = document.getElementById('newsletterEmail').value;
//         if (!validateEmail(emailVal)) return;
//         fetch('api/newsletter.php', {
//             method: 'POST',
//             headers: { 'Accept': 'application/json' },
//             body: new URLSearchParams({ email: emailVal })
//         })
//             .then(r => r.json())
//             .then(data => {
//                 if (data && data.success) {
//                     newsletterForm.innerHTML = '<p style="color:var(--blue-light6);font-size:0.82rem;">✓ Inscription confirmée !</p>';
//                 } else {
//                     alert((data && data.error) ? data.error : 'Erreur');
//                 }
//             }).catch(() => alert('Erreur réseau'));
//     });
// }

/* ============================================================
   HERO BARS ANIMATION
   ============================================================ */
const heroSection = document.getElementById('hero');
let barsAnimated = false;

const heroObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting && !barsAnimated) {
            barsAnimated = true;
            const bars = document.querySelectorAll('#heroBars .bar');
            bars.forEach((bar, i) => {
                setTimeout(() => {
                    bar.style.transition = 'height 0.8s ease';
                }, i * 80);
            });
        }
    });
}, { threshold: 0.5 });

if (heroSection) heroObserver.observe(heroSection);

/* ============================================================
   ACTIVE NAV LINK ON SCROLL
   ============================================================ */
const sections = document.querySelectorAll('section[id]');
const navLinks = document.querySelectorAll('.nav a');

window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach(section => {
        const sectionTop = section.offsetTop - header.offsetHeight - 60;
        if (window.scrollY >= sectionTop) {
            current = section.getAttribute('id');
        }
    });

    navLinks.forEach(link => {
        link.style.color = '';
        link.style.background = '';
        if (link.getAttribute('href') === '#' + current) {
            link.style.color = 'var(--blue-primary)';
            link.style.background = 'var(--blue-light9)';
        }
    });
});

document.addEventListener("DOMContentLoaded", () => {

    const popup = document.getElementById("popupOverlay");
    const closeBtn = document.querySelector(".close-popup");

    if(closeBtn){
        closeBtn.addEventListener("click", () => {
            popup.style.display = "none";
        });
    }

    // Fermeture automatique après 5 secondes
    if(popup){
        setTimeout(() => {
            popup.style.display = "none";
        }, 7000);
    }
});
