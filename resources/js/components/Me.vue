<template>
<b-container fuild>
    <b-row>
        <b-col sm="12" md="12" offset-lg="1" lg="3">
            <div class="me-icon-around">
                <img :src="'/img/me.svg'" class="me-icon">
            </div>
        </b-col>
        <b-col sm="12" md="12" lg="7">
            <p class="me-write">
                こんにちは。Sorinajiと申します。<br>
                新卒でこの業界に入り、Androidアプリ作成から始まり、Webアプリの開発、
                サーバの構築に従事しております。
                <br><br>
                パンダより猫派です。
            </p>
        </b-col>
        <b-col cols="12" class="me-brand-links">
            <h2 class="text-center">Find me on the web!</h2>
            <b-row class="me-brand-links">
                <b-col sm="6" md="6" offset-lg="2" lg="2" class="text-center">
                    <a class="about-link" href="https://github.com/sori883" target="_blank">
                        <awesome-icon :icon="['fab', 'github']" class="me-brand-icon" />
                    </a>
                    <p>Github</p>
                </b-col>
                <b-col sm="6" md="6" lg="2" class="text-center">
                    <a class="about-link" href="https://twitter.com/sorinaji" target="_blank">
                        <awesome-icon :icon="['fab', 'twitter']" class="me-brand-icon" />
                    </a>
                    <p>Twitter</p>
                </b-col>
                <b-col sm="6" md="6" lg="2" class="text-center">
                    <a class="about-link" href="https://inframenma.com/" target="_blank">
                        <awesome-icon :icon="['fab', 'wordpress']" class="me-brand-icon" />
                    </a>
                    <p>Blog</p>
                </b-col>
                <b-col sm="6" md="6" lg="2" class="text-center">
                    <a class="about-link" href="https://www.youtube.com/channel/UCc-IKx00Rl62xSzmiLik-Bw/featured?disable_polymer=1" target="_blank">
                        <awesome-icon :icon="['fab', 'youtube']" class="me-brand-icon" />
                    </a>
                    <p>Youtube</p>
                </b-col>
            </b-row>
        </b-col>
    </b-row>
</b-container>
</template>

<script>
</script>
