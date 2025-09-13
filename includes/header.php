<?php
if (!isset($pageTitle)) {
    $pageTitle = 'DecorVista - Home Interior Design';
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Locomotive Scroll CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/locomotive-scroll@4.1.4/dist/locomotive-scroll.min.css">

    <style>
        .font-heading { font-family: 'Playfair Display', serif; }
        .font-body { font-family: 'Source Sans Pro', sans-serif; }
        
        /* Black & White nav hover underline */
        .nav-link {
            position: relative;
            font-weight: 500;
            transition: color 0.3s;
            color: #000;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0%;
            height: 2px;
            bottom: -3px;
            left: 0;
            background-color: #000;
            transition: width 0.3s;
        }
        .nav-link:hover::after {
            width: 100%;
        }

        /* Mobile menu slide-in */
        .mobile-menu-slide {
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
        }
        .mobile-menu-slide.active {
            transform: translateX(0);
        }

        /* Margin below fixed navbar */
        .navbar-spacer {
            height: 80px; /* Adjust to match navbar height */
        }
    </style>
</head>
<body class="font-body text-gray-900 bg-white">

<!-- Navigation -->
<nav class="fixed top-0 w-full z-50 bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">

            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="./index.php" class="text-2xl font-heading font-bold text-black hover:text-gray-700 transition">
                    DecorVista
                </a>
            </div>

            <!-- Desktop Menu -->
            <?php if (isLoggedIn() && !in_array($_SESSION['role'] ?? '', ['admin', 'designer'])): ?>
                <div class="hidden md:flex items-center space-x-8">
                    <?php
                    $links = [
                        'Home' => '/index.php',
                        'Products' => '/products.php',
                        'Gallery' => '/gallery.php',
                        'Designers' => '/designers.php',
                        'Blog' => '/blog.php',
                        'Contact' => '/contact.php'
                    ];
                    foreach ($links as $name => $url) {
                        echo '<a href="' . APP_URL . $url . '" class="nav-link">' . $name . '</a>';
                    }
                    ?>
                </div>
            <?php endif; ?>

            <!-- User & Cart Menu -->
            <div class="hidden md:flex items-center space-x-4">
                <?php if (isLoggedIn()): ?>
                    <?php if (!in_array($_SESSION['role'] ?? '', ['admin', 'designer'])): ?>
                        <a href="<?php echo APP_URL; ?>/cart.php" class="relative text-black hover:text-gray-700 transition transform hover:scale-110">
                            <i class="fas fa-shopping-cart text-xl"></i>
                            <span id="cart-count" class="absolute -top-1 -right-1 bg-black text-white text-xs rounded-full h-5 w-5 flex items-center justify-center shadow-md">0</span>
                        </a>
                    <?php endif; ?>
                    <span class="text-black text-sm">Hi, <?php echo htmlspecialchars($_SESSION['firstname'] ?? $_SESSION['username']); ?></span>
                    <a href="<?php echo APP_URL; ?>/dashboard.php" class="bg-black text-white px-4 py-2 rounded-xl hover:bg-gray-800 transition transform hover:scale-105 shadow">Dashboard</a>
                    <a href="<?php echo APP_URL; ?>/logout.php" class="text-black hover:text-gray-700 px-3 py-2 rounded-md transition">Logout</a>
                <?php else: ?>
                    <a href="<?php echo APP_URL; ?>/login.php" class="bg-black text-white px-4 py-2 rounded-xl hover:bg-gray-800 transition transform hover:scale-105 shadow">Login</a>
                    <a href="<?php echo APP_URL; ?>/register.php" class="bg-black text-white px-4 py-2 rounded-xl hover:bg-gray-800 transition transform hover:scale-105 shadow">Register</a>
                <?php endif; ?>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobile-menu-btn" class="text-black hover:text-gray-700 focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="fixed top-0 right-0 h-full w-64 bg-white shadow-lg mobile-menu-slide md:hidden z-50">
        <div class="p-6 flex flex-col space-y-4">
            <?php if (isLoggedIn() && !in_array($_SESSION['role'] ?? '', ['admin', 'designer'])): ?>
                <?php
                foreach ($links as $name => $url) {
                    echo '<a href="' . $url . '" class="text-black hover:text-gray-700 font-medium py-2">' . $name . '</a>';
                }
                ?>
                <hr class="border-gray-300 my-4">
                <a href="/cart.php" class="text-black hover:text-gray-700 py-2">Cart</a>
            <?php endif; ?>
            <?php if (isLoggedIn()): ?>
                <a href="/dashboard.php" class="text-black hover:text-gray-700 py-2">Dashboard</a>
                <a href="/logout.php" class="text-black hover:text-gray-700 py-2">Logout</a>
            <?php else: ?>
                <a href="/login.php" class="bg-black text-white px-4 py-2 rounded-xl hover:bg-gray-800 transition text-center">Login</a>
                <a href="/register.php" class="bg-black text-white px-4 py-2 rounded-xl hover:bg-gray-800 transition text-center">Register</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- Spacer below navbar -->
<div class="navbar-spacer"></div>

<!-- Mobile Menu Script -->
<script>
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('active');
    });
</script>