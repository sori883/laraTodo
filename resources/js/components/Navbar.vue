<template>
<nav class="navbar navbar-dark bg-dark navbar-expand-md sticky-top">
    <a class="navbar-brand" href="#">Laratodo</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navAlt" aria-controls="navbarNav" aria-expanded="false">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div id="navAlt" class="collapse navbar-collapse">
        <div class="navbar-nav ml-auto">
            <router-link :to="{name: 'login'}">
                <a class="nav-item nav-link text-white">ログイン</a>
            </router-link>
            <router-link :to="{name: 'register'}">
                <a class="nav-item nav-link text-white">ユーザ登録</a>
            </router-link>
            <button type="submit" class="btn  btn-link text-white">ログアウト</button>
        </div>
    </div>
</nav>
</template>
<script>
export default {

}
</script>
