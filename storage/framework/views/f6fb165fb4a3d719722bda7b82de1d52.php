        <!-- navigation bottom -->
        <div class="fixed inset-x-0 bottom-0 max-w-[640px] z-50 bg-white shadow-sm mx-auto">
            <div class="flex items-center justify-between px-8 py-4">
                <a href="<?php echo e(route('index', $store->username)); ?>" class="flex flex-col items-center gap-2">

                    <?php if(Route::current()->getName() == 'index'): ?>
                    <img src="<?php echo e(asset('assets/images/icons/Home.svg')); ?>" class="w-[24px] h-[24px]" alt="icon">
                    <?php else: ?>
                    <img src="<?php echo e(asset('assets/images/icons/Home_Default.svg')); ?>" class="w-[24px] h-[24px]" alt="icon">
                    <?php endif; ?>
                    <p
                        class="<?php echo e(Route::current()->getName() == 'index' ? ' text-[#FF801A]' : 'text-[#606060]'); ?> font-[400] text-[12px]">
                        Home</p>

                </a>
                <a href="<?php echo e(route('cart', $store->username)); ?>" class="flex flex-col items-center gap-2">
                    <div class="relative">
                        <img src="<?php echo e(asset('assets/images/icons/Buy.svg')); ?>" class="w-[24px] h-[24px]" alt="icon">
                        <div
                            class="absolute top-[-4px] right-[-8px] flex items-center justify-center w-[16px] h-[16px] rounded-full bg-[#FF801A]">
                            <p class="text-white font-[400] text-[10px]" id="cart-count"></p>
                        </div>
                    </div>
                    <p class="text-[#606060] font-[400] text-[12px]">Cart</p>
                </a>
                <a href="<?php echo e(route('product.find', $store->username)); ?>" class="flex flex-col items-center gap-2 ">
                    <?php if(Route::current()->getName() == 'product.find' || Route::current()->getName() ==
                    'product.find.results'): ?>
                    <img src="<?php echo e(asset('assets/images/icons/Search.svg')); ?>" class="w-[24px] h-[24px]" alt="icon">
                    <?php else: ?>
                    <img src="<?php echo e(asset('assets/images/icons/Search_default.svg')); ?>" class="w-[24px] h-[24px]" alt="icon">
                    <?php endif; ?>
                    <p
                        class="<?php echo e(Route::current()->getName() == 'product.find' ? 'text-[#FF801A]' : 'text-[#606060'); ?> font-[400] text-[12px]">
                        Find</p>
                </a>
                <a href="index.html" class="flex flex-col items-center gap-2">
                    <img src="<?php echo e(asset('assets/images/icons/Profile.svg')); ?>" class="w-[24px] h-[24px]" alt="icon">
                    <p class="text-[#606060] font-[400] text-[12px]">Profile</p>
                </a>
            </div>
        </div><?php /**PATH /usr/www/E-Menu/resources/views/Layouts/navigation.blade.php ENDPATH**/ ?>