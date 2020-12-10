<template>
<div>
    <NavTop />
    <b-col sm="12" md="3" lg="3" xl="3" class="mx-auto login-intro">
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
