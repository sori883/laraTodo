<template>
<main>
    <header>
        <Navbar />
    </header>
    <div class="container-fluid">
        <div class="row">
            <RouterView />
        </div>
    </div>
</main>
</template>

<script>
import Navbar from './components/Navbar.vue'
export default {
    components: {
        Navbar
    }
}
</script>
