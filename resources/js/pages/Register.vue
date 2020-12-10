<template>
<div>
    <NavTop />
    <b-col sm="12" md="3" lg="3" xl="3" class="mx-auto">
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
