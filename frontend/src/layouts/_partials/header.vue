<template>
    <div>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <RouterLink :to="{name: 'index'}" class="navbar-brand">
                    Innova Connect
                </RouterLink>
                <div class="d-flex">
                    <button type="button" class="btn btn-success"><i class="fas fa-plus-circle"></i> Add Person</button>
                </div>
            </div>
        </nav>
    </div>
</template>
