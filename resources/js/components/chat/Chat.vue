<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Pesan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#"></a>
              </li>
              <li class="">Pesan</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Messenger</h3>
                <div class="card-tools"></div>
              </div>
              <div class="card-body">
                <div class="chat-app">
                  <ContactsList :contacts="contacts" @selected="startConversationWith" />
                  <Conversation
                    :contact="selectedContact"
                    :messages="messages"
                    @new="saveNewMessage"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import Conversation from "./Conversation";
import ContactsList from "./ContactsList";

export default {
  components: { Conversation, ContactsList },
  data() {
    return {
      selectedContact: null,
      messages: [],
      contacts: [],
    };
  },
  mounted() {
    
    Echo.connector.pusher.config.auth.headers['Authorization'] = 'Bearer '+this.$auth.token()
    // console.log("mounted")
    Echo.private(`messages.${this.$auth.user().id}`).listen("NewMessage", (e) => {
      console.log("abc")
      this.handleIncoming(e.message);
    });

    axios.get("/chat/contact/list").then(response => {
      this.contacts = response.data.data;
    //   console.log(response.data.data);
    });
  },
  created() {
    //   const xsrf = localStorage.getItem('XSRF-TOKEN')
      // const token = localStorage.getItem('token')

      // console.log(this.$auth.token())
      // console.log(token)
  },
  methods: {
    startConversationWith(contact) {
      this.updateUnreadCount(contact, true);
      axios.get(`/chat/conversation/${contact.id}`).then(response => {
        this.messages = response.data;
        this.selectedContact = contact;
      });
    },
    saveNewMessage(message) {
      this.messages.push(message);
    },
    handleIncoming(message) {
      if (this.selectedContact && message.from == this.selectedContact.id) {
        this.saveNewMessage(message);
        return;
      }
      this.updateUnreadCount(message.from_contact, false);
    },
    updateUnreadCount(contact, reset) {
      this.contacts = this.contacts.map(single => {
        if (single.id !== contact.id) {
          return single;
        }
        if (reset) single.unread = 0;
        else single.unread += 1;
        return single;
      });
    }
  }
};
</script>
<style lang="scss" scoped>
.chat-app {
  display: flex;
  overflow: hidden;
}
</style>