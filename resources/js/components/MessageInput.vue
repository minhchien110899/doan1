<template>
  <div>
    <textarea
      v-model="text"
      v-on:keydown.enter.prevent="send"
      placeholder="Type message..."
    ></textarea>
  </div>
</template>

<script>
export default {
  data() {
    return {
      text: "",
    };
  },
  methods: {
    send() {
      if (this.text != "") {
        this.$emit("send", this.text);
        this.text = "";
      }
    },
  },
};
</script>

<style scoped>
textarea {
  width: 96%;
  margin: 10px;
  resize: none;
  border-radius: 3px;
  border: 1px solid lightgray;
  padding: 6px;
}
textarea:focus {
    outline: none !important;
    border:2px solid #8cbaff;
}

</style>