<style>
  .site_header .nav-link { text-transform: capitalize !important; font-weight: 500 !important; color: #111 !important; }
  .cb-cursor {display: none !important;}

  /* Mobile Navbar & Hamburger Button */
  .mobile_menu_btn {
    display: none !important;
    align-items: center !important;
    justify-content: center !important;
    width: 44px !important;
    height: 44px !important;
    min-width: 44px !important;
    min-height: 44px !important;
    padding: 0 !important;
    background: #ffffff !important;
    border: 1.5px solid #d5d5d8 !important;
    border-radius: 8px !important;
    cursor: pointer !important;
    transition: all 0.25s ease !important;
    outline: none !important;
    box-shadow: 0 2px 6px rgba(0,0,0,0.06) !important;
    position: relative !important;
    z-index: 1060 !important;
    -webkit-appearance: none !important;
    appearance: none !important;
  }
  .mobile_menu_btn:hover,
  .mobile_menu_btn:focus {
    background: #f8f8f9 !important;
    border-color: #ED1E24 !important;
  }
  .mobile_menu_btn .hamburger_box {
    width: 20px;
    height: 14px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    pointer-events: none;
  }
  .mobile_menu_btn .hamburger_bar {
    width: 100%;
    height: 2px;
    background-color: #111111;
    border-radius: 2px;
    transition: all 0.25s ease;
  }
  .mobile_menu_btn:hover .hamburger_bar {
    background-color: #ED1E24;
  }
  .mobile_menu_btn[aria-expanded="true"] {
    background: #ED1E24 !important;
    border-color: #ED1E24 !important;
  }
  .mobile_menu_btn[aria-expanded="true"] .hamburger_bar {
    background-color: #ffffff !important;
  }
  .mobile_menu_btn[aria-expanded="true"] .hamburger_bar:nth-child(1) {
    transform: translateY(6px) rotate(45deg);
  }
  .mobile_menu_btn[aria-expanded="true"] .hamburger_bar:nth-child(2) {
    opacity: 0;
  }
  .mobile_menu_btn[aria-expanded="true"] .hamburger_bar:nth-child(3) {
    transform: translateY(-6px) rotate(-45deg);
  }

  @media (max-width: 991.98px) {
    .mobile_menu_btn {
      display: inline-flex !important;
    }

    .site_header {
      position: sticky !important;
      top: 0 !important;
      z-index: 1040 !important;
      background: #ffffff !important;
      box-shadow: 0 2px 10px rgba(0,0,0,0.06);
    }
    .site_header .header_bottom {
      padding: 10px 0 !important;
    }
    .site_header .site_logo {
      max-width: 180px !important;
      width: auto !important;
    }
    .site_header .site_logo img {
      max-height: 40px !important;
      width: auto !important;
    }
    .main_menu {
      position: fixed !important;
      top: 60px !important;
      left: 0 !important;
      right: 0 !important;
      width: 100% !important;
      max-height: calc(100vh - 60px) !important;
      overflow-y: auto !important;
      -webkit-overflow-scrolling: touch;
      z-index: 1050 !important;
      padding: 0 !important;
    }
    .main_menu_inner {
      background: #ffffff !important;
      box-shadow: 0 15px 35px rgba(0,0,0,0.15) !important;
      border-top: 2px solid #ED1E24 !important;
      padding: 12px 16px 30px !important;
    }
    .main_menu_inner.show {
      animation: smartfitMobileMenuOpen 220ms ease-out both;
    }
    .main_menu_inner.mobile_menu_closing {
      animation: smartfitMobileMenuClose 220ms ease-in both;
      pointer-events: none !important;
    }
    .main_menu_list {
      padding: 0 !important;
      margin: 0 !important;
      display: flex !important;
      flex-direction: column !important;
      width: 100% !important;
    }
    .main_menu_list > li {
      width: 100% !important;
      border-bottom: 1px solid #f0f0f2 !important;
      display: block !important;
      margin: 0 !important;
    }
    .main_menu_list > li > a.nav-link {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      padding: 14px 8px !important;
      font-size: 16px !important;
      font-weight: 700 !important;
      color: #111111 !important;
      text-transform: capitalize !important;
    }
    .main_menu_list > li > a.nav-link:hover {
      color: #ED1E24 !important;
    }
  }

  @keyframes smartfitMobileMenuOpen {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
  }

  @keyframes smartfitMobileMenuClose {
    from { opacity: 1; transform: translateY(0); }
    to { opacity: 0; transform: translateY(-10px); }
  }

  @media (prefers-reduced-motion: reduce) {
    .main_menu_inner.show,
    .main_menu_inner.mobile_menu_closing {
      animation-duration: 0ms !important;
    }
  }
</style>

<header class="site_header sticky sticky-top" style="background:#fff !important; background-image:none !important; position: sticky; top: 0; z-index: 1030;">
  <div class="header_bottom" style="background:#fff !important; background-image:none !important; padding: 12px 0 !important;">
    <div class="container">
      <div class="d-flex align-items-center justify-content-between position-relative">
        
        <!-- 1. Brand Logo -->
        <div class="site_logo" style="width: auto; max-width: 220px; flex-shrink: 0;">
          <a class="site_link" href="/">
            <img class="smartfit_header_logo" src="{{ asset('assets/images/site_logo/logo_330_black.png') }}" alt="{{$chunker['default_picture_alt']}}" style="max-height: 42px; width: auto; height: auto; display: block;">
          </a>
        </div>

        <!-- 2. Desktop Navigation Menu -->
        <div class="meni_bg flex-grow-1" style="background:#fff !important; background-image:none !important;">
          <x-menu :$header />
        </div>

        <!-- 3. Actions / Mobile Hamburger Button -->
        <div class="d-flex align-items-center gap-2 flex-shrink-0">
          <div class="d-none d-md-block">
            <form action="/tyres" method="GET" class="position-relative" style="max-width: 170px;">
              <input type="search" name="manufacturer" class="form-control smartfit_light_input rounded-pill pe-4 ps-3 py-1" style="font-size: 13px; border: 1px solid #ddd; height: 32px;" placeholder="Search tyres...">
              <button type="submit" class="btn p-0 position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%); background: transparent; border: 0;">
                <i class="fa-solid fa-magnifying-glass text-danger" style="font-size: 12px;"></i>
              </button>
            </form>
          </div>

          <!-- Hamburger Toggle Button -->
          <button class="mobile_menu_btn d-lg-none" type="button" aria-expanded="false" aria-controls="main_menu_dropdown" aria-label="Toggle navigation" id="site_mobile_toggle_btn">
            <span class="hamburger_box">
              <span class="hamburger_bar"></span>
              <span class="hamburger_bar"></span>
              <span class="hamburger_bar"></span>
            </span>
          </button>
        </div>

      </div>
    </div>
  </div>
</header>
