<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emenu - Solusi Digital Menu Restoran & Merchant</title>
    <meta name="description"
        content="Emenu adalah platform digital untuk restoran dan merchant yang memudahkan pelanggan melihat menu, memesan, dan melakukan pembayaran secara online. Tingkatkan pengalaman pelanggan dan efisiensi bisnis Anda dengan Emenu.">
    <meta name="keywords"
        content="Emenu, menu digital, restoran, merchant, pemesanan online, pembayaran digital, solusi restoran, aplikasi menu">
    <meta name="author" content="Emenu">
    <meta property="og:title" content="Emenu - Solusi Digital Menu Restoran & Merchant">
    <meta property="og:description"
        content="Platform digital untuk restoran dan merchant, memudahkan pelanggan melihat menu, memesan, dan membayar secara online.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:image" content="<?php echo e(asset('assets/images/emenu-og.png')); ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Emenu - Solusi Digital Menu Restoran & Merchant">
    <meta name="twitter:description"
        content="Platform digital untuk restoran dan merchant, memudahkan pelanggan melihat menu, memesan, dan membayar secara online.">
    <meta name="twitter:image" content="<?php echo e(asset('assets/images/emenu-og.png')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('assets/output.css')); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body>
    <div id="Content-Container"
        class="relative flex flex-col w-full max-w-[640px] min-h-screen mx-auto overflow-x-hidden pb-32">


        <?php echo $__env->yieldContent('content'); ?>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="<?php echo e(asset('assets/js/index.js')); ?>"></script>
    <?php echo $__env->yieldContent('script'); ?>
</body>

</html><?php /**PATH /usr/www/E-Menu/resources/views/Layouts/app.blade.php ENDPATH**/ ?>