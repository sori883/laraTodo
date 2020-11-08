<template>
<b-col cols="12" sm="11" md="9" lg="7" xl="6" class="mx-auto">
    <h2 class="text-center">ユーザ登録</h2>
    <RegisterForm />
</b-col>
</template>

<script>
import RegisterForm from '../components/form/RegisterForm.vue'
export default {
    components: {
        RegisterForm
    },
}
</script>
