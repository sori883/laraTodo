<template>
<b-col cols="12" sm="11" md="9" lg="7" xl="6" class="mx-auto">
    <h2 class="text-center">ログイン</h2>
    <LoginForm />
</b-col>
</template>

<script>
import LoginForm from '../components/form/LoginForm.vue'
export default {
    components: {
        LoginForm
    }
}
</script>
