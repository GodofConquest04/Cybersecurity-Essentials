<?php
// header.php
?>
    <style>
.owasp-header {
  background: #000;
  color: #fff;
  width: 100%;
  box-sizing: border-box;
  position: sticky;
  top: 0;
  z-index: 1000;
  border-bottom: 2px solid rgba(255,255,255,0.05);
}

.owasp-header__inner {
  max-width: 1100px;
  margin: 0 auto;
  padding: 10px 16px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  position: relative; /* to position children relative to this */
  z-index: 5; /* base z-index for inner container */
}

.owasp-header__left {
  display: flex;
  align-items: center;
  gap: 10px;
  position: relative;
  z-index: 10; /* higher so it stays above header background */
}

.owasp-logo {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  background: transparent !important;
  border-radius: 0 !important;
  position: relative;
  z-index: 15; /* highest so logo is always on top */
  box-shadow: 0 0 8px rgba(0,0,0,0.5); /* subtle shadow for separation */
}

.owasp-logo img {
  height: 40px;
  width: auto;
  display: block;
  background: transparent;
  position: relative;
  z-index: 15;
}

.owasp-title {
  font-weight: 700;
  letter-spacing: 0.5px;
  color: #fff;
  font-size: 18px;
  position: relative;
  z-index: 11;
}

.owasp-header__right {
  display: flex;
  gap: 14px;
  align-items: center;
  position: relative;
  z-index: 10;
}

    </style>

<header class="owasp-header" role="banner" aria-label="OWASP TCET header">
  <div class="owasp-header__inner">
    <div class="owasp-header__left">
      <a href="https://owasp.tcetmumbai.in" class="owasp-logo" aria-label="OWASP TCET home link">
        <img src="/owasp-logo.svg" alt="OWASP TCET Logo" />
      </a>
      <span class="owasp-title">OWASP TCET</span>
    </div>

    <nav class="owasp-header__right" role="navigation" aria-label="Social links">
      <a href="https://in.linkedin.com/company/owasp-tcet" target="_blank" rel="noopener noreferrer" class="owasp-link" aria-label="LinkedIn">
        LinkedIn
      </a>
      <a href="https://www.instagram.com/tcet_owasp/" target="_blank" rel="noopener noreferrer" class="owasp-link" aria-label="Instagram">
        Instagram
      </a>
      <a href="https://www.meetup.com/owasp-tcet-chapter/" target="_blank" rel="noopener noreferrer" class="owasp-link" aria-label="Meetup">
        Meetup
      </a>
    </nav>
  </div>
</header>
