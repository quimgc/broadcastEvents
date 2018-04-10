<template>
<ul>
    <li v-for="message in messages"> {{message.body}}</li>
</ul>
</template>

<script>
    export default {

      data() {
        return {
          messages: [
            {body: 'missatge 1'},
            {body: 'missatge 2'},
            {body: 'missatge 3'},
            {body: 'missatge 4'}
          ]
        }
      },
        mounted() {
          Echo.private('new-message')
            .listen('ChatMessage', (event) => {
              console.log('He rebut un nou event de broadcast');
              console.log(event);

              this.messages.push({body: event.message});
            });
        }
    }
</script>
