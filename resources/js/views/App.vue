<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <h2>High Solutions - Vladislav Chebotarev</h2>
            </div>
        </nav>
        <main class="py-4">
            <transition name="router-anim">
                <router-view class="view"></router-view>
            </transition>
        </main>
        <notifications group="foo"/>
    </div>
</template>

<style>
    .router-anim-enter-active {
        animation: coming .5s;
        animation-delay: .5s;
        opacity: 0;
    }

    .router-anim-leave-active {
        animation: going .5s;
    }

    @keyframes going {
        from {
            transform: translateX(0);
        }
        to {
            transform: translateX(-200px);
            opacity: 0;
        }
    }

    @keyframes coming {
        from {
            transform: translateX(200px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

</style>

<script>
    export default {}
</script>
