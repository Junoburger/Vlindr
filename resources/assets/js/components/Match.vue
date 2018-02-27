<template>
    <div>
        <p class="text-center pull-left" v-if="loading">

    <i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
    <span class="sr-only">Loading...</span>

        </p>
        <p class="text-center" v-if="!loading">

            <a v-if="status == 0" @click="like_user">
                <span title="Ik vind je leuk" class="send-heart"></span>
            </a>
        <a href=""><span title="Ik vind jou ook leuk" class="pending" v-if="status == 'pending'" @click="mutual_like"></span></a>


            <a href="">
                <span title="Je vind deze persoon leuk" class="heart-send" v-if="status == 'waiting'"></span>
            </a>
           <a href="/messages">

                <span v-if="status == 'match'" title="Chatten" class="chat" style="position:relative;left:60px;top:105px;"></span>
            </a>

        </p>
    </div>
</template>

<script>
export default {
    mounted() {
        this.$http.get('/check_match_status/' + this.profile_user_id)
            .then((resp) => {
                console.log(resp)
                this.status = resp.body.status
                this.loading = false
            })
    },
    props: ['profile_user_id'],
    data() {
        return {
            status: '',
            loading: true
        }
    },
    methods: {
        like_user() {
            this.loading = true
            this.$http.get('/like_user/' + this.profile_user_id)
                .then((r) => {
                    if (r.body == 1)
                        this.status = 'waiting'

                    this.loading = false
                })
        },
        mutual_like() {
            this.loading = true
            this.$http.get('/mutual_like/' + this.profile_user_id)
                .then((r) => {
                    if (r.body == 1)
                        this.status = 'match'

                    this.loading = false
                })
        }
    }
}
</script>
