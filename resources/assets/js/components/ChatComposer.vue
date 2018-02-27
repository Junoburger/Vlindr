<template lang="html">
  <div class="chat-composer">

<input type="text" placeholder="Type hier uw bericht.." v-model="messageText" @keydown.enter="sendMessage">
<button class="btn btn-sm btn-md btn-lid"  style="font-size:12pt !important;" @click="sendMessage">Verstuur</button>

  </div>
</template>


<script>
export default {
data(){

    return{
        messageText: ''
    }

},
methods: {
    sendMessage() {
        this.$emit('messagesent', {
            message: this.messageText,
            user: {
                User: $('.navbar-right .dropdown-toggle').text()
            }
        });

        this.messageText = '';


            }
        }


}
</script>


<style lang="css">
.chat-composer{
    display: flex;
}
.chat-composer input{
    flex: 1 auto;
    padding: .5rem 1rem;
}
.chat-composer button{
    border-radius:0;
}

</style>