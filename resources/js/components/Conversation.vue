<template>
  <div class="conversation">
      <h1>{{ selectedContact ? selectedContact.name : "select a contact" }}</h1>
      <MessageList :selectedContact="selectedContact" :messages="messages"/>
      <MessageInput @send="sendMessage"/>
  </div>
</template>

<script>
import MessageList from './MessageList';
import MessageInput from './MessageInput';
export default {
    components:{
        MessageList, MessageInput
    },
    props:{
        selectedContact: {
            type: Object,
            default: null
        },
        messages: {
            type: Array,
            default: []
        }
    },
    methods:{
        sendMessage(text){
           if(!this.selectedContact){
            alert("Choose a selected contact to sent");
            return;
           };
            axios.post('/chat/conversation/send',{
                contact_id: this.selectedContact.id,
                text: text
            }).then(response => {
                console.log(response.data);
                this.$emit('newmessage', response.data);
            })
        },
    },
}
</script>

<style lang="scss" scoped>
    .conversation{
        flex: 5;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    h1 {
        font-size: 20px;
        padding: 10px;
        margin: 0;
        border-bottom: 1px solid #999999;
    }
</style>