<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <style>
        h1{
            font-size: 50px;
            font-weight:bold;
            text-align: center;
        }
    </style>
    
    <section class="bg-white dark:bg-gray-900">
        <button onclick="history.back()" class="ms-5 inline-flex items-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-primary-900">
            &laquo; kembali
        </button>
        <h1>Rincian Event</h1>
        <div class="gap-8 py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
            <img class="w-full dark:hidden" src="<?php echo e(asset('storage/' . $event->foto)); ?>" alt="<?php echo e($event->foto); ?>">
            
            <div class="mt-4 md:mt-0">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white"><?php echo e($event->nama_event); ?></h2>
                <h4 class="mb-4 text-2xl tracking-tight font-extrabold text-gray-900 dark:text-white">Tanggal: <?php echo e(date('l, M-d-Y', strtotime($event->tanggal))); ?></h4>
                <h4 class="mb-4 text-2xl tracking-tight font-extrabold text-gray-900 dark:text-white">Lokasi: <?php echo e($event->lokasi); ?></h4>
                <p class="mb-6 text-gray-500 md:text-lg dark:text-gray-400"><?php echo e($event->deskripsi); ?></p>
            </div>
        </div>
    </section>
    

    
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\event\resources\views/event/show.blade.php ENDPATH**/ ?>