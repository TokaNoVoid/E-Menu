<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emenu</title>

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