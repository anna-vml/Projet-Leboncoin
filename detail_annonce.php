/* ===========================================================
   CAMPUS MARKET — STYLE.CSS
   Plateforme de petites annonces entre étudiants
   Palette : Bleu marine (#1a2456 / #243a7a) + Or (#d4a437)
=========================================================== */

:root {
    --cm-navy-dark: #16204f;
    --cm-navy: #1f2d63;
    --cm-navy-light: #2c3f8c;
    --cm-gold: #d9a93f;
    --cm-gold-light: #f0c869;
    --cm-bg: #f4f5fa;
    --cm-white: #ffffff;
    --cm-text: #2c2c34;
    --cm-text-muted: #6b6f7d;
    --cm-success: #2e9e5b;
    --cm-success-dark: #237e47;
    --cm-radius: 14px;
    --cm-shadow: 0 8px 24px rgba(22, 32, 79, 0.10);
}

* {
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', 'Segoe UI', Arial, sans-serif;
    background: var(--cm-bg);
    color: var(--cm-text);
    margin: 0;
}

/* ===========================================================
   NAVBAR
=========================================================== */
.navbar-cm {
    background: linear-gradient(135deg, var(--cm-navy-dark), var(--cm-navy-light));
    padding: 16px 0;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
}

.navbar-cm .container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
}

.navbar-brand-cm {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    color: var(--cm-white);
}

.navbar-brand-cm .logo-icon {
    font-size: 28px;
    color: var(--cm-gold-light);
}

.navbar-brand-cm .brand-text {
    display: flex;
    flex-direction: column;
    font-weight: 800;
    font-size: 22px;
    color: var(--cm-white);
    line-height: 1.2;
}

.navbar-brand-cm .brand-text small {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 1px;
    color: var(--cm-gold-light);
    text-transform: uppercase;
}

.navbar-links {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.btn-nav {
    background: rgba(255, 255, 255, 0.08);
    color: var(--cm-white);
    border: 1px solid rgba(255, 255, 255, 0.15);
    padding: 9px 18px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.2s ease;
}

.btn-nav:hover {
    background: rgba(255, 255, 255, 0.18);
    color: var(--cm-gold-light);
    transform: translateY(-1px);
}

.btn-nav-deco {
    background: linear-gradient(135deg, var(--cm-gold), var(--cm-gold-light));
    color: var(--cm-navy-dark);
    border: none;
}

.btn-nav-deco:hover {
    color: var(--cm-navy-dark);
    filter: brightness(1.05);
    transform: translateY(-1px);
}

/* ===========================================================
   BOUTON RETOUR (haut de page)
=========================================================== */
.btn-retour {
    display: inline-block;
    color: var(--cm-navy);
    font-weight: 600;
    text-decoration: none;
    font-size: 15px;
    transition: color 0.2s ease;
}

.btn-retour:hover {
    color: var(--cm-gold);
}

/* ===========================================================
   CARD DÉTAIL ANNONCE
=========================================================== */
.card-detail {
    background: var(--cm-white);
    border-radius: var(--cm-radius);
    box-shadow: var(--cm-shadow);
    overflow: hidden;
    border: 1px solid #eceef5;
}

.detail-image-wrapper {
    height: 100%;
    min-height: 360px;
    background: #eef0f7;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.detail-image {
    width: 100%;
    height: 100%;
    min-height: 360px;
    object-fit: cover;
    display: block;
    transition: transform 0.4s ease;
}

.card-detail:hover .detail-image {
    transform: scale(1.03);
}

.card-body-detail {
    padding: 40px 38px;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.badge-etat {
    display: inline-block;
    align-self: flex-start;
    background: rgba(217, 169, 63, 0.15);
    color: #a87a1f;
    font-weight: 700;
    font-size: 12.5px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 6px 14px;
    border-radius: 20px;
    margin-bottom: 16px;
}

.titre-annonce {
    font-weight: 800;
    font-size: 28px;
    color: var(--cm-navy-dark);
    margin-bottom: 10px;
    line-height: 1.25;
}

.prix {
    font-weight: 800;
    font-size: 32px;
    color: var(--cm-gold);
    margin-bottom: 18px;
}

.separateur {
    border: none;
    border-top: 1px solid #e8e9f0;
    margin: 18px 0 22px;
}

.section-label {
    font-weight: 700;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: var(--cm-navy);
    margin-bottom: 10px;
}

.description-text {
    color: var(--cm-text-muted);
    font-size: 15.5px;
    line-height: 1.7;
    flex-grow: 1;
}

/* ===========================================================
   BOUTONS D'ACTION
=========================================================== */
.boutons-action {
    display: flex;
    gap: 14px;
    margin-top: 24px;
    flex-wrap: wrap;
}

.btn-cm-secondary {
    background: var(--cm-white);
    color: var(--cm-navy);
    border: 2px solid var(--cm-navy);
    font-weight: 700;
    padding: 11px 24px;
    border-radius: 10px;
    text-decoration: none;
    transition: all 0.2s ease;
}

.btn-cm-secondary:hover {
    background: var(--cm-navy);
    color: var(--cm-white);
}

.btn-cm-success {
    background: linear-gradient(135deg, var(--cm-success), var(--cm-success-dark));
    color: var(--cm-white);
    font-weight: 700;
    padding: 11px 24px;
    border-radius: 10px;
    text-decoration: none;
    border: none;
    box-shadow: 0 4px 12px rgba(46, 158, 91, 0.3);
    transition: all 0.2s ease;
}

.btn-cm-success:hover {
    color: var(--cm-white);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(46, 158, 91, 0.4);
}

/* ===========================================================
   FOOTER
=========================================================== */
.footer-cm {
    text-align: center;
    padding: 22px 16px;
    color: var(--cm-text-muted);
    font-size: 13.5px;
    border-top: 1px solid #e5e6ee;
    margin-top: 40px;
}

/* ===========================================================
   RESPONSIVE
=========================================================== */
@media (max-width: 767px) {
    .detail-image-wrapper,
    .detail-image {
        min-height: 260px;
    }

    .card-body-detail {
        padding: 28px 24px;
    }

    .titre-annonce {
        font-size: 23px;
    }

    .prix {
        font-size: 26px;
    }

    .navbar-cm .container {
        flex-direction: column;
        align-items: flex-start;
    }
}
