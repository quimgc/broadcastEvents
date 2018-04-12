<template>
    <div>

        <ul>
            <li v-for="message in messages"> {{message.body}}</li>
        </ul>

        <input type="text" v-model="newMessage" @keydown="tapParticipants">
        <button @click="send">Enviar</button>
        <span v-if="activePeer"> User {{ activePeer.name}} is typing...</span>


        Active users:

        <ul>
            <li v-for="activeUser in activeUsers"> {{ activeUser.name }}</li>
        </ul>
    </div>
</template>

<script>
    export default {

      data() {
        return {
          activeUsers:[],
          activePeer: false,
          newMessage: '',
          messages: [
            {body: 'missatge 1'},
            {body: 'missatge 2'},
            {body: 'missatge 3'},
            {body: 'missatge 4'}
          ]
        }
      },
      methods: {
        tapParticipants () {
          console.log('User ' + user.name+' is typing')
            Echo.private('new-message')
              .whisper('typing', {
                name: user.name
              });
        },
        send() {
          axios.post('/chat_message',{
            'body': this.newMessage
          })
        }
      },
        mounted() {
        // s'indica que es de presencia amb un Echo.join
          Echo.join('new-message')
            .here ((users) => {
            this.activeUsers = users;
            console.log(users)
          })
            .joining((user) => {
                this.activeUsers.push(user);
                console.log('User added: ')
                console.log(user)
            })
            .leaving((user) => {
                console.log('adeu malparit')

                const findUser = this.activeUsers.find(function(u){
                  return u.id === user.id;
                });

                this.activeUsers.splice(this.activeUsers.indexOf(findUser),1)
            })
            .listen('ChatMessage', (event) => {
              console.log('He rebut un nou event de broadcast');
              console.log(event);

              this.messages.push({body: event.message});
            })
            .listenForWhisper('typing', (e) => {
              console.log(e.name);
              this.activePeer = {};
              this.activePeer.name = e.name;
              setTimeout(() =>{
                this.activePeer = false;
                }, 1000);
            });


        }
    }
</script>
