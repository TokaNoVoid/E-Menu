<?php $__env->startSection('content'); ?>

<div id="TopNav" class="relative flex items-center justify-between px-5 py-3 bg-white">
    <a href="<?php echo e(route('product.find', $store->username)); ?>"
        class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-[#F0F1F3]">
        <img src="<?php echo e(asset('assets/images/icons/Arrow - Left.svg')); ?>" class="w-[28px] h-[28px]" alt="icon">
    </a>
    <p class="font-semibold">Search Results</p>
    <div class="dummy-btn w-12"></div>
</div>

<div id="Header" class="relative flex items-center justify-between gap-2 px-5 mt-[18px]">
    <div class="flex flex-col gap-[6px]">
        <h1 class="text-[20px]">Search Result</h1>

        <?php if($products->count()): ?>
        <p class="text-[#606060] text-[12px]">
            <?php echo e($products->count()); ?> menu ditemukan
            <?php if(request('search') ): ?>
            untuk kata kunci "<strong><?php echo e(request('search')); ?></strong>"
            <?php endif; ?>
        </p>
        <?php else: ?>
        <p class="text-[#606060] text-[12px]">
            Tidak ada menu
            <?php if(request('search')): ?>
            untuk kata kunci "<strong><?php echo e(request('search')); ?></strong>"
            <?php endif; ?>
        </p>
        <?php endif; ?>
    </div>
</div>

<!-- search result -->
<div id="SearchResult" class="flex flex-col gap-4 mt-[10px] px-5">
    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <a href="<?php echo e(route('product.show', ['username' => $store->username, 'id' => $product->id])); ?>" class="card">
        <div
            class="flex rounded-[8px] border border-[#F1F2F6] p-[12px] gap-4 bg-white hover:bg-[#FFF7F0] hover:border-[1px] hover:border-[#F3AF00] transition-all duration-300">
            <div class="w-[128px] h-[88px]">
                <img src="<?php echo e(asset('storage/' . $product->image)); ?>" class="w-full h-full object-cover rounded-[8px]"
                    alt="icon">
            </div>
            <div class="flex flex-col gap-1 w-full">
                <p class="text-[#F3AF00] font-[400] text-[12px]">
                    <?php echo e($product->productCategory->name); ?>

                </p>
                <h3 class="text-[#353535] font-[500] text-[14px]">
                    <?php echo e($product->name); ?>

                </h3>
                <p class="text-[#606060] font-[400] text-[10px]">
                    <?php echo e($product->description); ?>

                </p>

                <div class="flex items-center justify-between ">
                    <p class="text-[#FF001A] font-[600] text-[14px]">
                        Rp <?php echo e(number_format($product->price)); ?>

                    </p>
                    <button type="button"
                        class="flex items-center justify-center w-[24px] h-[24px] rounded-full bg-transparent"
                        data-id="<?php echo e($product->id); ?>" onclick="addToCart(this.dataset.id)">
                        <img src="<?php echo e(asset('assets/images/icons/ic_plus.svg')); ?>" class="w-full h-full" alt="icon">
                    </button>
                </div>
            </div>
        </div>
    </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <p class="text-[#606060] text-[14px]">Belum ada produk ditampilkan.</p>
    <?php endif; ?>
</div>

<?php echo $__env->make('Layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /usr/www/E-Menu/resources/views/Pages/result.blade.php ENDPATH**/ ?>