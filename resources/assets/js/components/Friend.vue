<template>
    <div>
        <p class="text-center pull-right" style="position:relative;top:-30px;left:-15px;" v-if="loading">

    <i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
    <span class="sr-only">Loading...</span>

        </p>
        <p class="text-center" v-if="!loading">

    <a v-if="status == 0" @click="add_friend"><span title="Vriendschapsverzoek" class="add-friend"></span></a>

    <a href=""><span title="Vriendschap bevestigen" class="accept-friend" v-if="status == 'pending'" @click="accept_friend"></span></a>
    <a href=""><span title="wachten op een reactie" class="pending" v-if="status == 'waiting'"></span></a>
    <a href="newMessage"><span v-if="status == 0" title="Chatten" class="chat"></span></a>


        </p>
    </div>
</template>

<script>
export default {
    mounted() {
        this.$http.get('/check_relationship_status/' + this.profile_user_id)
            .then((r) => {
                console.log(r)
                this.status = r.body.status
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
        add_friend() {
            this.loading = true
            this.$http.get('/add_friend/' + this.profile_user_id)
                .then((r) => {
                    if (r.body == 1)
                        this.status = 'waiting'

                    this.loading = false
                })
        },
        accept_friend() {
            this.loading = true
            this.$http.get('/accept_friend/' + this.profile_user_id)
                .then((r) => {
                    if (r.body == 1)
                        this.status = 'friends'

                    this.loading = false
                })
        }
    }
}
</script>
