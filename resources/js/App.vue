<template>
<main>
    <Navbar />
    <b-container fluid>
        <b-row>
            <RouterView />
        </b-row>
    </b-container>
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
