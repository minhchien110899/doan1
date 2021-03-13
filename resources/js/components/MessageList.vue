<template>
  <div class="feed" ref="messagesContainer">
    <ul v-show="selectedContact">
      <li
        v-for="message in messages"
        :key="message.id"
        class="message"
        :class="{
          sent: message.to == selectedContact.id,
          received: message.from == selectedContact.id,
        }"
      >
        <div class="text">{{ message.text }}</div>
        <div>
          <small class="time">{{ getTime(message.created_at) }}</small>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    selectedContact: {
      type: Object,
      default: null,
    },
    messages: {
      type: Array,
      default: [],
    },
  },
  updated() {
    this.$nextTick(() => this.scrollToEnd());
  },
  methods: {
    getTime(time) {
      var time = new Date(time);
      return `${time.getHours()}:${time.getMinutes()} ${time.getDate()}/${
        time.getMonth() + 1
      }/${time.getFullYear()}`;
    },
    scrollToEnd() {
      var content = this.$refs.messagesContainer;
      content.scrollTop = content.scrollHeight;
    },
  },
};
</script>

<style lang="scss" scoped>
.feed {
  background:white;
  height: 100%;
  max-height: 470px;
  overflow-y: scroll;
  ul {
    list-style-type: none;
    padding: 5px;
    li {
      &.message {
        margin: 10px 0;
        width: 100%;
        .text {
          max-width: 200px;
          border-radius: 5px;
          padding: 12px;
          display: inline-block;
        }
        &.received {
          text-align: left;
          .text {
            background: #00bbf9;
            color:white
          }
        }
        &.sent {
          text-align: right;
          .text {
            background: #fb5607;
            color:white
          }
        }
        .time {
          font-size: 8px;
          font-style: italic;
          color: #c2c2c2;
        }
      }
    }
  }
}
</style>