<template>
<div>
    <NavTop />
    <b-col sm="12" md="8" lg="7" xl="3" class="mx-auto login-intro mb-3">
        <div class="text-center formonly-intro">
            <img :src="'/img/icon-black.svg'">
            <p class="formonly-ttl">Sign in to laratodo</p>
        </div>
        <LoginForm />
    </b-col>
</div>
</template>

<script>
import LoginForm from '../components/form/LoginForm.vue'
import NavTop from '../components/navbar/NavTop.vue'
export default {
    components: {
        LoginForm,
        NavTop
    }
}
</script>
