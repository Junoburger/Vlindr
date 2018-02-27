
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.Vue = require('vue');

Vue.use(require('vue-resource'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('friend', require('./components/Friend.vue'));
Vue.component('match', require('./components/Match.vue'));
//Vue.component('chat-message', require('./components/ChatMessage.vue'));
//Vue.component('chat-log', require('./components/ChatLog.vue'));
//Vue.component('chat-composer', require('./components/ChatComposer.vue'));








const app = new Vue({
    el: '#app',
    data: {
        message: 'nieuw bericht',
        content: '',
        privateMessages: [],
        singleMessages: [],
        messageFrom: '',
        conID: '',
        friend_id: '',
        seen: false,
        newMessageFrom: ''

    },
    ready: function () {
        this.created();

    },

    created(){
        axios.get('http://vlindr.dev/index.php/getMessages')
        .then(response => {
            console.log(response.data);
            app.privateMessages = response.data;
        })
        .catch(function (error){
            console.log(error);
        });
    },

    methods:{

        messages: function(id){
            axios.get('http://vlindr.dev/index.php/getMessages/' + id)
                .then(response => {
                    console.log(response.data);
                    app.singleMessages = response.data;
                    app.conID = response.data[0].conversation_id
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
inputHandler(e){
  if(e.keyCode ===13 && !e.shiftKey){
    e.preventDefault();
    this.sendMessage();
  }
},

sendMessage(){
if(this.messageFrom){

axios.post('http://vlindr.dev/index.php/sendMessage',{
    conID: this.conID,
    message: this.messageFrom
})
.then(function (response) {
  console.log(response.data);
if(response.status===200){
  app.singleMessages = response.data;
}

})
.catch(function (error)
{
  console.log(error);
});

}

},

friendID: function(id){
    app.friend_id = id;
  },
  sendNewMessage(){
    axios.post('http://vlindr.dev/index.php/sendNewMessage', {
           friend_id: this.friend_id,
           message: this.newMessageFrom,
         })
         .then(function (response) {
           console.log(response.data); // show if success
           if(response.status===200){
             window.location.replace('http://vlindr.dev/index.php/messages');
             app.message = 'Bericht is verstuurd.';
           }

         })
         .catch(function (error) {
           console.log(error); // run if we have error
         });


       }

      }


});
