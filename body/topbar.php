<nav class="navbar mb-5">
  <style>
    .navbar {
      background: linear-gradient(45deg, #ff4d4d, #000);
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      display: flex;
      align-items: center;
      height: 80px;
    }
    .container-fluid {
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 100%;
    }
    .navbar::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: 
        radial-gradient(circle at 20% 50%, rgba(255, 165, 0, 0.5) 0%, transparent 50%),
        radial-gradient(circle at 80% 50%, rgba(255, 69, 0, 0.5) 0%, transparent 50%);
      filter: blur(20px);
      opacity: 0.7;
      animation: flicker 5s infinite alternate;
    }

    @keyframes flicker {
      0%, 100% { opacity: 0.7; }
      50% { opacity: 0.5; }
    }

    .navbar-brand {
      color: #fff;
      font-weight: bold;
      font-size: 24px;
      transition: transform 0.3s ease;
      position: relative;
      z-index: 1;
    }

    .navbar-brand:hover {
      transform: scale(1.1);
      text-shadow: 0 0 10px #ff4d4d;
    }

    .navbar-toggler {
      border: none;
      background: transparent;
      position: relative;
      z-index: 1;
    }

    .navbar-toggler-icon {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    .offcanvas {
      background: linear-gradient(135deg, #ff4d4d, #000);
    }

    .offcanvas-title {
      color: #fff;
    }

    .nav-link {
      color: #fff;
      position: relative;
      overflow: hidden;
      transition: all 0.3s ease;
      z-index: 1;
    }

    .nav-link::before {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 2px;
      background: linear-gradient(90deg, #ff4d4d, #ff8c00, #ff4d4d);
      transform: scaleX(0);
      transform-origin: right;
      transition: transform 0.3s ease;
    }

    .nav-link:hover::before {
      transform: scaleX(1);
      transform-origin: left;
    }

    .nav-link:hover {
      transform: translateY(-3px);
      text-shadow: 0 0 10px #ff4d4d;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .navbar-nav {
      animation: fadeIn 0.5s ease forwards;
    }

    /* Particules de feu */
    @keyframes rise {
      0% { transform: translateY(100%) scale(0); opacity: 0; }
      50% { opacity: 1; }
      100% { transform: translateY(-500%) scale(1); opacity: 0; }
    }

    .fire-particle {
      position: absolute;
      bottom: 0;
      background: radial-gradient(circle, #ff4d4d, #ff8c00);
      border-radius: 50%;
      pointer-events: none;
      z-index: 0;
    }

    .fire-particle:nth-child(1) { left: 10%; width: 8px; height: 8px; animation: rise 3s infinite; }
    .fire-particle:nth-child(2) { left: 30%; width: 6px; height: 6px; animation: rise 3.5s infinite 0.5s; }
    .fire-particle:nth-child(3) { left: 50%; width: 10px; height: 10px; animation: rise 4s infinite 1s; }
    .fire-particle:nth-child(4) { left: 70%; width: 7px; height: 7px; animation: rise 3.2s infinite 1.5s; }
    .fire-particle:nth-child(5) { left: 90%; width: 9px; height: 9px; animation: rise 3.8s infinite 0.7s; }
  </style>

  <div class="container-fluid">
    <a class="navbar-brand" href="#">BlogDeGazo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="index.php?page=home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=blog">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin">Connexion</a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Particules de feu -->
  <div class="fire-particle"></div>
  <div class="fire-particle"></div>
  <div class="fire-particle"></div>
  <div class="fire-particle"></div>
  <div class="fire-particle"></div>
</nav>