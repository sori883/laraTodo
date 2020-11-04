<template>
<main>
    <Navbar />
    <RouterView />
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
