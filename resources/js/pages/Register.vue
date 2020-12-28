<template>
<div>
    <NavTop />
    <b-col sm="12" md="8" lg="7" xl="3" class="mx-auto mb-3">
        <div class="text-center formonly-intro">
            <img :src="'/img/icon-black.svg'">
            <p class="formonly-ttl">Sign up to laratodo</p>
        </div>
        <RegisterForm />
    </b-col>
</div>
</template>

<script>
import RegisterForm from '../components/form/RegisterForm.vue'
import NavTop from '../components/navbar/NavTop.vue'
export default {
    components: {
        RegisterForm,
        NavTop
    },
}
</script>
