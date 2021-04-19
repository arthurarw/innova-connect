<template>
    <div>
        <header-component/>
        <!-- Page Content -->
        <div class="container container-body">
            <preloader-component></preloader-component>

            <router-view></router-view>
        </div>

    </div>
</template>

<script>
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import HeaderComponent from './_partials/header';

export default {
    components: {
        HeaderComponent
    }
}
</script>
