<template>
  <div class="container mb-3">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card" style="background: #fdfffc">
          <div class="card-header bg-warning text-light">
            <h2 class="mb-0">Chat</h2>
          </div>
          <div class="card-body chat-app">
            <Conversation
              :selectedContact="selectedContact"
              :messages="messages"
              @newmessage="addNewMessage"
            />
            <ContactList :contacts="contacts" @selected="conversationWith" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Conversation from "./Conversation";
import ContactList from "./ContactList";
export default {
  components: {
    Conversation,
    ContactList,
  },
  props: {
    user: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      selectedContact: null,
      messages: [],
      contacts: [],
    };
  },
  mounted() {
    Echo
      .private(`messages.${this.user.id}`)
      .listen('NewMessageEvent', (e) => {
        this.handleIncoming(e.message);
    });
    axios.get("/chat/contacts").then((response) => {
      // console.log(response.data);
      this.contacts = response.data;
    });
  },
  methods: {
    conversationWith(contact) {
      axios.get("/chat/conversation/" + contact.id).then((response) => {
        // console.log(response.data);
        this.selectedContact = contact;
        this.messages = response.data;
      });
    },
    addNewMessage(newMessage){
        this.messages.push(newMessage);
    },
    handleIncoming(message){
      // mày là user 1
      // Nếu user 1 chat với user 2 thì
      // cái this.selectedContact này là của user 1 
      if(this.selectedContact && message.from == this.selectedContact.id){
          // console.log(this.selectedContact.id);
          this.messages.push(message);
      }
    }
  },
};
</script>
<style lang="scss" scoped>
.chat-app {
  display: flex;
}
.card-body {
  padding: 0;
}
</style>
